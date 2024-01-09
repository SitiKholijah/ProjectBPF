<?php

namespace App\Http\Controllers;

use App\Models\Makanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MakananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $makanan = Makanan::latest()->paginate(10);
        return view('admin.index', compact('makanan'));
    }

    public function indexCust()
    {
        return view('customer.index');
    }

    public function kategori1()
    {
        $makanan = Makanan::where('kategori', 'Keripik')->latest()->paginate(10);
        return view('admin.kategori1', compact('makanan'));
    }

    public function kategori2()
    {
        $makanan = Makanan::where('kategori', 'Snack')->latest()->paginate(10);
        return view('admin.kategori2', compact('makanan'));
    }


    public function kategori3()
    {
        $makanan = Makanan::where('kategori', 'Kue')->latest()->paginate(10);
        return view('admin.kategori3', compact('makanan'));
    }
    
    public function custkategori1()
    {
        $makanan = Makanan::where('kategori', 'Keripik')->latest()->paginate(10);
        return view('customer.kategori1', compact('makanan'));
    }

    public function custkategori2()
    {
        $makanan = Makanan::where('kategori', 'Snack')->latest()->paginate(10);
        return view('customer.kategori2', compact('makanan'));
    }


    public function custkategori3()
    {
        $makanan = Makanan::where('kategori', 'Kue')->latest()->paginate(10);
        return view('customer.kategori3', compact('makanan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.tambah');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    $foto = $request->file('foto');
    $foto->storeAs('public/makanan', $foto->hashName());

    $makanan = Makanan::create([
        "nama" => $request->nama,
        "foto" => $foto->hashName(),
        "kategori" => $request->kategori,
        "harga" => $request->harga,
    ]);

    if ($makanan) {
        return redirect()->route('homeAdmin')->with('success', 'Data Makanan berhasil ditambahkan!');
    } else {
        echo "error";
    }
    }

    /** 
     * Display the specified resource.
     */
    public function show(Makanan $makanan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
    $makanan = Makanan::find($id);

    return view('admin.edit', compact('makanan'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $makanan = Makanan::findOrFail($id);

        if ($request->file('foto')) {
            Storage::disk('local')->delete('public/makanan/' . $makanan->foto);

            $foto = $request->file('foto');
            $foto->storeAs('public/makanan', $foto->hashName());

            // Update data pegawai
            $makanan->update([
                'nama' => $request->nama,
                'foto' => $foto->hashName(),
                'kategori' => $request->kategori,
                'harga' => $request->harga,
            ]);
        } else {
            $makanan->update([
                'nama' => $request->nama,
                'kategori' => $request->kategori,
                'harga' => $request->harga,
            ]);
        }
        $makanan = Makanan::latest()->paginate(10);
        return redirect()->route('makanan.index')->with(['success' => 'Data Berhasil Diedit']);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $makanan = Makanan::findOrFail($id);
        Storage::disk('local')->delete('public/makanan/' . $makanan->gambar);
        $makanan->delete();

        if ($makanan) {
            return redirect()->route('makanan.index')->with(['success' => 'Data Berhasil Dihapus!']);
        } else {
            return redirect()->route('makanan.index')->with(['error' => 'Data Gagal Dihapus!']);
        }
    }
}
