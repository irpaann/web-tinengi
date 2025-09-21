<?php

namespace App\Http\Controllers;
use App\Models\Budaya;
use Illuminate\Http\Request;

class BudayaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // 1. Ambil semua data dari model Budaya, urutkan dari yang terbaru
        $budayas = Budaya::latest()->get();

        // 2. Kirim data tersebut ke view
        return view('budaya.index', compact('budayas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
