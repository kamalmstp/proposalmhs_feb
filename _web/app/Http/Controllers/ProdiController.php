<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Prodi;

class ProdiController extends Controller
{
    public function __construct()
    {        
        $this->middleware('role:admin'); 
    }

    public function list()
    {    	
    	$prodi_list = Prodi::get();
        return view('prodi.list', compact('prodi_list'));
    }

    public function save(Request $request){
    	$input = $request->all();         
   	
		Prodi::create($input);		

		return redirect()->back()->with('sukses', $request['nama']. ' berhasil ditambah');
    }

    public function edit($id){
        $prodi = User::whereId($id)->firstOrFail(); 

        return view('prodi.edit', compact('$prodi'));
    }

    public function update(Request $request, $id){
        $prodi = Prodi::whereId($id)->firstOrFail(); 
        $input = $request->all();
        
        $prodi->update($input);

        return redirect()->route('prodi_list')->with('sukses', 'Data berhasil diperbaharui menjadi '.$request['nama']);        
    }

    public function delete($id)
    {
        $prodi = Prodi::whereId($id)->firstOrFail();
        $nama = $prodi->nama;

        $prodi->delete();

        return redirect()->route('prodi_list')->with('sukses', 'Data ' .$nama. ' berhasil dihapus.');
    }
    
}
