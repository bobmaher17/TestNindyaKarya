<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use Illuminate\Support\Facades\Storage;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $barangs = Barang::latest()->paginate(10);
        return view('barang.index', compact('barangs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('barang.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'nm_brg'        => 'required',
            'jml'           => 'required',
            'merk'          => 'required'
        ]);
    
        $barang = Barang::create([
            'nm_brg'        => $request->nm_brg,
            'jml'           => $request->jml,
            'merk'          => $request->merk,
        ]);
    
        if($barang){
            //redirect dengan pesan sukses
            return redirect()->route('barang.index')->with(['success' => 'Data Berhasil Disimpan!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('barang.index')->with(['error' => 'Data Gagal Disimpan!']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Barang $barang)
    {
        return view('barang.edit', compact('barang'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Barang $barang)
    {
        $this->validate($request, [
            'nm_brg'        => 'required',
            'jml'           => 'required',
            'merk'          => 'required'
        ]);
    
        //get data Barang by ID
        $barang = Barang::findOrFail($barang->id);
    
            $barang->update([
                'nm_brg'        => $request->nm_brg,
                'jml'           => $request->jml,
                'merk'          => $request->merk,
            ]);
    
        if($barang){
            //redirect dengan pesan sukses
            return redirect()->route('barang.index')->with(['success' => 'Data Berhasil Diupdate!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('barang.index')->with(['error' => 'Data Gagal Diupdate!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $barang = Barang::findOrFail($id);
        $barang->delete();

        if($barang){
            //redirect dengan pesan sukses
            return redirect()->route('barang.index')->with(['success' => 'Data Berhasil Dihapus!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('barang.index')->with(['error' => 'Data Gagal Dihapus!']);
        }
    }
}
