<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PaguRequest;
use App\Pagu;

class PaguController extends Controller
{
    public function __construct()
    {        
        $this->middleware('role:wd3'); 
    }    

    public function list()
    {
    	$list_pagu  = Pagu::orderBy('created_at', 'DESC')->get();        
        return view('pagu.list', compact('list_pagu'));
    }

    public function save(PaguRequest $request){
    	$input = $request->all(); 
        $input['sisa'] = $request['pagu'];   	
   	
		Pagu::create($input);		

		return redirect()->back()->with('sukses', 'Pagu tahun ' .$request['tahun']. ' berhasil ditambah');
    }

    public function update(Request $request, $id){
    	$pagu = Pagu::whereId($id)->firstOrfail();
    	$input['pagu'] = $request['pagu'];

        $spagu_asal = str_replace(".", "", $pagu->pagu);
        $ipagu_asal = (int)$spagu_asal;
        $spagu_baru = str_replace(".", "", $input['pagu']);
        $ipagu_baru = (int)$spagu_baru;
        $selisih = $ipagu_baru - $ipagu_asal;

        $ssisa_asal = str_replace(".", "", $pagu->sisa);
        $isisa_asal = (int)$ssisa_asal;
        $sisa_baru = $isisa_asal + $selisih;
        $isisa_baru = number_format($sisa_baru, 0,'','.');
        $input['sisa'] = (string)$isisa_baru;

    	$pagu->update($input);

    	return redirect()->back()->with('sukses', 'Pagu tahun ' .$request['tahun']. ' berhasil diubah');	
    }



}
