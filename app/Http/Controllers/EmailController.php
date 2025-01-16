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
        // Validasi awal
        $request->validate([
            'subject' => 'required|string|max:255',
            'body' => 'required|string',
            'emails' => 'nullable|array',
            'emails.*' => 'email',
            'pdf' => 'nullable|mimes:pdf|max:2048',
            'from_email' => 'nullable|email',
            'from_name' => 'nullable|string|max:255',
            'excel' => 'nullable|mimes:xlsx,xls',
            'emails_from_divisions' => 'nullable|string' // Tambahkan validasi untuk input hidden
        ]);
    
        // Ambil email dari Select2 dan checkbox divisi
        $emailsFromSelect = $request->input('emails', []);
        $emailsFromDivisions = json_decode($request->input('emails_from_divisions', '[]'), true);
    
        // Gabungkan email dari Select2 dan checkbox divisi
        $allEmails = array_unique(array_merge($emailsFromSelect, $emailsFromDivisions));
    
        if (empty($allEmails)) {
            return redirect()->back()->withErrors(['emails' => 'Minimal pilih satu karyawan atau divisi.'])->withInput();
        }
    
        $subject = $request->input('subject');
        $body = $request->input('body');
        $fromEmail = $request->input('from_email') ?? config('mail.from.address');
        $fromName = $request->input('from_name') ?? config('mail.from.name');
        $pdfPath = $request->file('pdf') ? $request->file('pdf')->store('attachments') : null;
    
        // Kirim email ke setiap penerima
        foreach ($allEmails as $email) {
            Mail::to($email)->send(
                new SendEmployeeEmail(
                    $subject,
                    $body,
                    $pdfPath ? storage_path("app/{$pdfPath}") : null,
                    $fromEmail,
                    $fromName
                )
            );
        }
    
        session()->flash('notification', 'Email berhasil dikirim ke semua penerima!');
    
        return redirect()->route('dashboard')->with('success', 'Email berhasil dikirim!');
    }
    
    
 
}
