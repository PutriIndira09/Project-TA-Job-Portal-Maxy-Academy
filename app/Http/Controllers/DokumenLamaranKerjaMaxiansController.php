<?php

namespace App\Http\Controllers;

use App\Models\DokumenLamaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DokumenLamaranKerjaMaxiansController extends Controller
{
    // Display the form to upload documents
    public function showForm()
    {
        return view('pages.maxians.dokumen_lamaran_kerja');
    }

    // Store the uploaded documents and data to the database
    public function store(Request $request)
    {
        // Validate the uploaded files and input
        $validated = $request->validate([
            'file_cv' => 'required|mimes:pdf|max:2048', // Max size 2MB
            'file_portofolio' => 'required|mimes:pdf|max:2048', // Max size 2MB
            'akun_instagram' => 'required|string',
            'akun_LinkedIn' => 'required|string',
        ]);

        try {
            // Create documents directory if not exists
            $documentsPath = public_path('documents');
            if (!file_exists($documentsPath)) {
                mkdir($documentsPath, 0777, true);
            }

            // Process CV file
            $cvFile = $request->file('file_cv');
            $cvFileName = time() . '_' . $cvFile->getClientOriginalName();
            $cvPath = 'documents/' . $cvFileName;
            $cvFile->move($documentsPath, $cvFileName);

            // Process Portfolio file
            $portfolioFile = $request->file('file_portofolio');
            $portfolioFileName = time() . '_' . $portfolioFile->getClientOriginalName();
            $portfolioPath = 'documents/' . $portfolioFileName;
            $portfolioFile->move($documentsPath, $portfolioFileName);

            // Save the data into the database
            DokumenLamaran::create([
                'cv' => $cvPath,
                'portofolio' => $portfolioPath,
                'link_instagram' => $request->input('akun_instagram'),
                'link_linkedin' => $request->input('akun_LinkedIn'),
            ]);

            // Redirect back with success message
            return redirect()->route('dokumen_lamaran_kerja')->with('success', 'Dokumen lamaran berhasil disimpan!');
        } catch (\Exception $e) {
            // Handle any errors
            return redirect()->route('dokumen_lamaran_kerja')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function showResults()
    {
        $dokumenLamaran = DokumenLamaran::orderBy('created_at', 'desc')->get();
        return view('pages.maxians.view_dokumen_lamaran_kerja', compact('dokumenLamaran'));
    }
}
