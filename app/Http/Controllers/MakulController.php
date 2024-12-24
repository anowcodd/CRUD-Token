<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Makul;

class MakulController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Makul::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'kode' => 'required|unique:makuls',
            'nama' => 'required',
            'sks' => 'required|integer',
        ]);

        $makul = Makul::create($request->all());
        return response()->json($makul, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Makul::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $makul = Makul::findOrFail($id);
        $makul->update($request->all());
        return response()->json($makul, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Makul::destroy($id);
        return response()->json(null, 204);
    }
    public function getDosensByMakul($kode_makul)
    {
        $makul = Makul::where('kode_makul', $kode_makul)->with('dosens')->first();

        if ($makul) {
            return response()->json($makul->dosens);
        }

        return response()->json(['message' => 'Mata kuliah tidak ditemukan'], 404);
    }
}
