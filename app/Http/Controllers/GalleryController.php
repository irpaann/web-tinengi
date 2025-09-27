<?php

// app/Http/Controllers/GalleryController.php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class GalleryController extends Controller
{
    // Menampilkan semua foto di galeri
    public function index()
    {
        $galleries = Gallery::latest()->paginate(12); // Ambil data terbaru, 12 per halaman
        return view('gallery.index', compact('galleries'));
    }

    // Menampilkan form upload
    public function create()
    {
        // Cek batasan upload SEBELUM menampilkan form
        $uploadsToday = Gallery::where('user_id', Auth::id())
                                ->whereDate('created_at', today())
                                ->count();

        if ($uploadsToday >= 20) {
            return redirect()->route('galeri.index')
                             ->with('error', 'Anda sudah mencapai batas upload 2 foto hari ini.');
        }

        return view('gallery.upload');
    }

    // Menyimpan foto baru
    public function store(Request $request)
    {
        // 1. Validasi input
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // 2. Cek ULANG batasan upload saat proses penyimpanan
        $uploadsToday = Gallery::where('user_id', Auth::id())
                                ->whereDate('created_at', today())
                                ->count();
        
        if ($uploadsToday >= 20) {
            return back()->with('error', 'Gagal! Anda sudah mencapai batas upload 2 foto hari ini.');
        }

        // 3. Proses upload file
        $image      = $request->file('image');
        $imageName  = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('img/gallery'), $imageName);

        // 4. Simpan ke database
        Gallery::create([
            'user_id'    => Auth::id(),
            'image_path' => $imageName,
        ]);
        
        // 5. Redirect dengan pesan sukses
        return redirect()->route('galeri.index')
                         ->with('success', 'Foto berhasil diunggah!');
    }
    public function destroy(Gallery $gallery)
    {
        // 1. Otorisasi (opsional tapi disarankan): Pastikan yang menghapus adalah pemilik foto
        // if (auth()->user()->id !== $gallery->user_id) {
        //     abort(403, 'Anda tidak memiliki izin untuk menghapus foto ini.');
        // }

        // 2. Tentukan path ke file gambar
        $imagePath = public_path('img/gallery/' . $gallery->image_path);

        // 3. Hapus file gambar dari server jika ada
        if (File::exists($imagePath)) {
            File::delete($imagePath);
        }

        // 4. Hapus record dari database
        $gallery->delete();

        // 5. Redirect kembali dengan pesan sukses
        return redirect()->route('galeri.index')
                         ->with('success', 'Foto berhasil dihapus.');
    }

}