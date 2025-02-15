<?php

namespace App\Http\Controllers;

use App\Mail\SendEmployeeEmail;
use App\Models\Division;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class EmailController extends Controller
{
    /**
     * Menampilkan halaman form pengiriman email ke individu.
     */
    public function showIndividualForm()
    {
        $employees = Employee::all(); // Ambil semua karyawan
        return view('emails.send_individual', compact('employees'));
    }

    // Fungsi untuk mengirim email individu
    public function sendToIndividual(Request $request)
{
    $request->validate([
        'employee_id' => 'required|exists:employees,id',
        'subject' => 'required|string',
        'message' => 'required|string',
        'pdf' => 'nullable|mimes:pdf|max:2048',
    ]);

    // Ambil karyawan berdasarkan ID yang dipilih
    $employee = Employee::find($request->employee_id);

    // Ambil data dari form
    $data = [
        'subject' => $request->subject,
        'message' => $request->message,
    ];

    // Cek jika ada file PDF yang diunggah dan simpan file PDF ke storage
    $pdf = $request->file('pdf') 
    ? $request->file('pdf')->store('attachments') 
    : null;

    // Debugging untuk melihat data sebelum mengirim email
    // dd([
    //     'pdfPath' => $pdfPath,
    //     'fullPath' => $pdfFullPath,
    //     'exists' => file_exists($pdfFullPath),
    //     'isReadable' => is_readable($pdfFullPath)
    // ]);
    // Kirim email dengan lampiran PDF jika ada
    Mail::to($employee->user->email ?? $employee->email)->send(new SendEmployeeEmail(
        $data['subject'], 
        $data['message'],
        $pdf
    ));

    return redirect()->route('dashboard')->with('success', 'Email berhasil dikirim ke ' . $employee->name);
}

    

    /**
     * Menampilkan halaman form pengiriman email ke divisi.
     */
    public function showDivisionForm()
    {
        $divisions = Division::all();
        return view('emails.send_division', compact('divisions'));
    }

    /**
     * Mengirim email ke semua karyawan dalam satu divisi.
     */
    public function sendToDivision(Request $request)
    {
        $request->validate([
            'division_id' => 'required|exists:divisions,id',
            'subject' => 'required|string',
            'message' => 'required|string',
            'pdf' => 'nullable|mimes:pdf|max:2048',
        ]);
        
        $data = [
            'subject' => $request->subject,
            'message' => $request->message,
        ];
        
        $employees = Employee::where('division_id', $request->division_id)->get();
        
        // Cek apakah ada karyawan dalam divisi
        if ($employees->isEmpty()) {
            return back()->with('error', 'Tidak ada karyawan dalam divisi yang dipilih.');
        }
        
        // Ambil semua email karyawan yang tidak kosong
        $emails = $employees->pluck('email')->filter()->toArray();
        
        // Cek apakah ada email yang valid
        if (empty($emails)) {
            return back()->with('error', 'Tidak ada karyawan dengan email yang valid dalam divisi ini.');
        }
        
        // Simpan PDF jika ada
        $pdf = $request->file('pdf') 
        ? $request->file('pdf')->store('attachments') 
        : null;
        
        // Kirim email menggunakan Bcc
        Mail::bcc($emails)->send(new SendEmployeeEmail(
            $data['subject'], 
            $data['message'], 
            $pdf
        ));
        
        return redirect()->route('dashboard')->with('success', 'Email berhasil dikirim ke semua karyawan dalam unit karya.');
        
        
        
    }


    /**
     * Menampilkan halaman form pengiriman email ke unit dalam divisi.
     */
    public function showUnitForm()
    {
        $divisions = Division::with('unit_karyas')->get();
        return view('emails.send_unit', compact('divisions'));
    }

    /**
     * Mengirim email ke semua karyawan dalam satu unit karya di dalam divisi.
     */
    public function sendToUnit(Request $request)
{
    $request->validate([
        'division_id' => 'required|exists:divisions,id',
        'unit_id' => 'required|exists:unit_karyas,id',
        'subject' => 'required|string',
        'message' => 'required|string',
        'pdf' => 'nullable|mimes:pdf|max:2048', // Menambahkan file pdf sebagai opsional
    ]);

    // Ambil data dari form
    $data = [
        'subject' => $request->subject,
        'message' => $request->message,
    ];

    // Ambil karyawan yang ada di unit dan divisi yang dipilih
    $employees = Employee::where('division_id', $request->division_id)
                         ->where('unit_karya_id', $request->unit_id)
                         ->get();

    // Cek jika ada file PDF yang diunggah
    $pdf = $request->file('pdf') 
        ? $request->file('pdf')->store('attachments') 
        : null;
    // Kirim email ke setiap karyawan
    foreach ($employees as $employee) {
        Mail::to($employee->email)->send(new SendEmployeeEmail($data['subject'], $data['message'], $pdf));
    }

    // Kembali dengan notifikasi sukses
    return redirect()->route('dashboard')->with('success', 'Email berhasil dikirim ke semua karyawan dalam unit karya.');
}


}
