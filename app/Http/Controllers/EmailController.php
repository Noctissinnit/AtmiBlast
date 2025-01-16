<?php

namespace App\Http\Controllers;

use App\Imports\EmployeeImport;
use App\Mail\SendEmployeeEmail;
use App\Models\Division;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;

class EmailController extends Controller
{
    /**
     * Tampilkan halaman form pengiriman email.
     */
    public function create()
    {
        // Ambil semua divisi beserta karyawan mereka
        $divisions = Division::with('employees')->get();
        return view('emails.create', compact('divisions'));
    }

    /**
     * Proses pengiriman email.
     */
    public function sendEmail(Request $request)
{
    // Validasi form
    $request->validate([
        'subject' => 'required|string|max:255',
        'body' => 'required|string',
        'emails' => 'required|array',
        'emails.*' => 'email', // Validasi setiap email dalam array
        'pdf' => 'nullable|mimes:pdf|max:2048',
        'from_email' => 'nullable|email', // Custom alamat email pengirim
        'from_name' => 'nullable|string|max:255', // Custom nama pengirim
        'excel' => 'nullable|mimes:xlsx,xls' // Validasi file Excel
    ]);

    // Jika ada file Excel yang diunggah
    if ($request->hasFile('excel')) {
        // Mengimpor data karyawan
        Excel::import(new EmployeeImport, $request->file('excel'));

        // Beri pesan sukses
        session()->flash('success', 'Data karyawan berhasil diunggah!');
    }

    // Ambil data form
    $emails = $request->input('emails');
    $subject = $request->input('subject');
    $body = $request->input('body');
    $fromEmail = $request->input('from_email') ?? config('mail.from.address');
    $fromName = $request->input('from_name') ?? config('mail.from.name');
    $pdfPath = $request->file('pdf') ? $request->file('pdf')->store('attachments') : null;

    // Kirim email ke setiap email yang dipilih
    foreach ($emails as $email) {
        Mail::to($email)->send(
            new SendEmployeeEmail(
                $subject,
                $body,
                $pdfPath ? storage_path("app/{$pdfPath}") : null, // Path ke file PDF
                $fromEmail, // Alamat pengirim
                $fromName // Nama pengirim
            )
        );
    }

    // Redirect ke halaman dashboard dengan pesan sukses
    return redirect()->route('dashboard')->with('success', 'Email berhasil dikirim!');
}
 
}
