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
        'emails.*' => 'email',
        'pdf' => 'nullable|mimes:pdf|max:2048',
        'from_email' => 'nullable|email',
        'from_name' => 'nullable|string|max:255',
        'excel' => 'nullable|mimes:xlsx,xls'
    ]);

    // Ambil semua email yang dipilih
    $emails = $request->input('emails');
    $subject = $request->input('subject');
    $body = $request->input('body');
    $fromEmail = $request->input('from_email') ?? config('mail.from.address');
    $fromName = $request->input('from_name') ?? config('mail.from.name');
    $pdfPath = $request->file('pdf') ? $request->file('pdf')->store('attachments') : null;

    // Daftar akun yang memiliki email @atmi.ac.id
    $accounts = [
        '1hrm@atmi.ac.id',
        '2hrm@atmi.ac.id',
        '3hrm@atmi.ac.id',
        '4hrm@atmi.ac.id',
        '5hrm@atmi.ac.id',
    ];

    // Hitung total email dan bagi ke 5 akun
    $totalEmails = count($emails);
    $emailsPerAccount = 50; // Maksimal 50 email per akun

    // Bagikan email ke akun yang ada
    $batches = array_chunk($emails, $emailsPerAccount);

    // Pastikan ada 5 batch atau lebih
    $batches = array_pad($batches, 5, []);

    // Kirim email dengan akun yang berbeda
    foreach ($batches as $index => $batch) {
        if (count($batch) > 0) {
            // Pilih akun berdasarkan index
            $fromEmail = $accounts[$index];
            foreach ($batch as $email) {
                Mail::to($email)->send(new SendEmployeeEmail(
                    $subject,
                    $body,
                    $pdfPath ? storage_path("app/{$pdfPath}") : null,
                    $fromEmail,
                    $fromName
                ));
            }
        }
    }

    // Redirect dan beri notifikasi sukses
    session()->flash('notification', 'Email berhasil dikirim ke semua penerima!');
    return redirect()->route('dashboard')->with('success', 'Email berhasil dikirim!');
}

    
    
 
}
