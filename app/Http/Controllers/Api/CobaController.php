<?php

namespace App\Http\Controllers\Api;

use App\Models\Friends;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CobaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $friends = Friends::orderBy('id', 'desc')->paginate();

        return response()->json([
            'success'=> true,
            'message'=> 'Daftar Data Teman',
            'data'=> $friends
        ], 200) ;
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
            'nama' => 'required|unique:friends|max:255',
            'no_hp' => 'required|numeric',
            'alamat'=> 'required',
        ]);

        $friends = Friends::create([
            'nama' => $request->nama,
            'no_hp' => $request->no_hp,
            'alamat' =>$request->alamat,

        ]);

        if ($friends){

            return response()->json([
                'success'=> true,
                'message'=> 'Teman Berhasil di tambahkan',
                'data'=> $friends
            ], 200) ;
        } else{
            return response()->json([
                'success'=> false,
                'message'=> 'Teman Gagal di tambahkan',
                'data'=> $friends
            ], 409) ;
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
        $friend = Friends::where('id', $id)->first();

        return response()->json([
            'success'=> true,
            'message'=> 'Detail Teman',
            'data'=> $friend
        ], 200) ;
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
        $friend = Friends::find($id)
        ->update([
            'nama' => $request->nama,
            'no_hp' => $request->no_hp,
            'alamat' =>$request->alamat,
        ]);
        
        return response()->json([
            'success'=> true,
            'message'=> 'Data Teman Berhasil Di Rubah',
            'data'=> $friend 
        ], 200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $friend = Friends::find($id)->delete();
        return response()->json([
            'success'=> true,
            'message'=> 'Data Teman Berhasil Di Hapus',
            'data'=> $friend 
        ], 200);

    }
}
