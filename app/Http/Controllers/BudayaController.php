<?php

namespace App\Http\Controllers;

use App\Models\Budaya;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\File;
use Illuminate\Http\RedirectResponse;

use function PHPUnit\Framework\fileExists;

class BudayaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
       // Mulai query builder
        $query = Budaya::query();

        // Cek jika ada parameter 'kategori' di URL
        if ($request->has('kategori') && $request->kategori != '') {
            // Terapkan filter berdasarkan kategori
            $query->where('kategori', $request->kategori);
        }

        // Ambil data setelah difilter (atau semua data jika tidak ada filter)
        $budayas = $query->latest()->get(); // `latest()` untuk mengurutkan dari yang terbaru

        return view('budaya.index', compact('budayas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //tampilkan halaman tambah budaya
        return view('budaya.tambah-budaya');
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. Validasi input dari form
        $request->validate([
            'nama'      => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'kategori'  => 'required|string|max:255',
            'gambar'    => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validasi file gambar
        ]);


        // 2. Proses upload gambar
        $gambar     = $request->file('gambar');
        $namaGambar = time() . '.' . $gambar->getClientOriginalExtension();
        $gambar->move(public_path('img/budaya'), $namaGambar);

        // 3. Simpan data ke database
        Budaya::create([
            'nama'      => $request->nama,
            'deskripsi' => $request->deskripsi,
            'kategori'  => $request->kategori,
            'gambar'    => $namaGambar, // Simpan hanya nama file gambar
        ]);


         // 4. Redirect ke halaman lain dengan pesan sukses
        return redirect()->route('budaya.index')
                         ->with('success', 'Data kebudayaan berhasil ditambahkan.');
        }

    /**
     * Display the specified resource.
     */
    public function show(Budaya $budaya)
    {
         // Laravel secara otomatis akan mencari Budaya berdasarkan ID (Route Model Binding)
        return view('budaya.show', compact('budaya'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Budaya $budaya)
    {
        //
        return view('budaya.edit',compact('budaya'));
    }

    /**
     * Update the specified resource in storage.
     */
     public function update(Request $request, Budaya $budaya): RedirectResponse
    {
        // 1. Validasi data yang masuk dari form
        $request->validate([
            'nama'      => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'kategori'  => 'required|string',
            'gambar'    => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Gambar boleh kosong
        ]);

        // Siapkan data untuk diupdate
        $dataToUpdate = $request->except('gambar');

        // 2. Cek apakah ada file gambar baru yang diunggah
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            $pathGambarLama = public_path('img/budaya/' . $budaya->gambar);
            if (File::exists($pathGambarLama)) {
                File::delete($pathGambarLama);
            }

            // Upload gambar baru
            $gambar     = $request->file('gambar');
            $namaGambar = time() . '.' . $gambar->getClientOriginalExtension();
            $gambar->move(public_path('img/budaya'), $namaGambar);

            // Tambahkan nama gambar baru ke data yang akan diupdate
            $dataToUpdate['gambar'] = $namaGambar;
        }

        // 3. Update data di database
        $budaya->update($dataToUpdate);

        // 4. Arahkan kembali ke halaman index dengan pesan sukses
        return redirect()->route('budaya.index')
                         ->with('success', 'Data kebudayaan berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
   // app/Http/Controllers/BudayaController.php


// ...

public function destroy(Budaya $budaya): RedirectResponse
{
    // 1. Tentukan path lengkap ke file gambar
    $pathGambar = public_path('img/budaya/' . $budaya->gambar);

    // 2. Hapus file gambar jika ada di direktori public
    // Menggunakan File::exists() lebih disarankan
    if (File::exists($pathGambar)) {
        File::delete($pathGambar);
    }

    // 3. Hapus data dari database
    $budaya->delete();

    // 4. Redirect kembali ke halaman index dengan pesan sukses
    return redirect()->route('budaya.index')
                     ->with('success', 'Data kebudayaan berhasil dihapus.');
}
}
