<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;

class BeritaController extends Controller
{
    // menampilkan daftar berita
    public function index()
    {
        $beritas = Berita::latest()->paginate(5);
        return view('berita.index', compact('beritas'));
    }

    // menampilkan form tambah berita
    public function create()
    {
        return view('berita.create');
    }

    // menyimpan berita baru
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'gambar' => 'required|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        $berita = new Berita();
        $berita->judul = $request->judul;
        $berita->isi = $request->isi;

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            // Buat nama file unik, bisa pakai time() atau cara lain
            $filename = time() . '_' . $file->getClientOriginalName();
            // Pindahkan file ke public/img/news
            $file->move(public_path('img/news'), $filename);
            // Simpan path relatif ke DB
            $berita->gambar = 'img/news/' . $filename;
        }

        $berita->save();

        return redirect()->route('berita.show', $berita)->with('success', 'Berita berhasil ditambah!');
    }

    // menampilkan detail berita
    public function show(Berita $beritum)
    {
        return view('berita.show', compact('beritum'));
    }

    // menampilkan form edit
    public function edit(Berita $beritum)
    {
        return view('berita.edit', compact('beritum'));
    }

    // update berita
    public function update(Request $request, Berita $beritum)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'isi'   => 'required',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        $data = $request->only(['judul', 'isi']);

        // Kalau ada gambar baru diupload
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama
            if ($beritum->gambar && file_exists(public_path($beritum->gambar))) {
                unlink(public_path($beritum->gambar));
            }

            // Upload gambar baru
            $fileName = time() . '_' . $request->file('gambar')->getClientOriginalName();
            $request->file('gambar')->move(public_path('img/news'), $fileName);
            $data['gambar'] = 'img/news/' . $fileName;
        }

        $beritum->update($data);

        return redirect()->route('berita.index')->with('success', 'Berita berhasil diperbarui.');
    }


    // hapus berita
    public function destroy(Berita $beritum)
    {
        // Hapus file gambar jika ada
        if ($beritum->gambar && file_exists(public_path($beritum->gambar))) {
            unlink(public_path($beritum->gambar));
        }

        // Hapus data dari database
        $beritum->delete();

        return redirect()->route('berita.index')
                        ->with('success', 'Berita dan gambarnya berhasil dihapus.');
    }
}
