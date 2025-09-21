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
            'isi'   => 'required',
        ]);

        Berita::create($request->all());

        return redirect()->route('berita.index')->with('success', 'Berita berhasil ditambahkan.');
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
        ]);

        $beritum->update($request->all());

        return redirect()->route('berita.index')->with('success', 'Berita berhasil diperbarui.');
    }

    // hapus berita
    public function destroy(Berita $beritum)
    {
        $beritum->delete();

        return redirect()->route('berita.index')->with('success', 'Berita berhasil dihapus.');
    }
}
