<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DokumenLamaran;

class DokumenLamaranController extends Controller
{
    // Menampilkan semua dokumen lamaran
    public function Maxians()
    {
        $dokumenLamaran = DokumenLamaran::orderBy('created_at', 'desc')->get();
        return view('pages.perusahaan.dokumen_lamaran_maxians', compact('dokumenLamaran'));
    }

    // Preview PDF
    // In DokumenLamaranController.php

    public function previewPDF($type, $id_dokumen)
    {
        $dokumen = DokumenLamaran::findOrFail($id_dokumen);

        if ($type === 'cv') {
            $filePath = public_path('documents/' . $dokumen->cv);
        } elseif ($type === 'portfolio') {
            $filePath = public_path('documents/' . $dokumen->portofolio);
        } else {
            abort(404);
        }

        if (!file_exists($filePath)) {
            abort(404, 'File tidak ditemukan');
        }

        // Generate the correct URL
        $documentUrl = url('documents/' . basename($filePath));  // This gives the full URL

        return redirect()->away($documentUrl);  // Redirect to the new URL
    }
}
