<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProposalRequest;
use App\Http\Requests\EditProposalRequest;
use App\Proposal;
use App\Catatan;
use App\User;
use App\Role;
use App\Pagu;
use Auth;
use File;
use Mail;
use PDF;
use Validator;
use Carbon\Carbon;

class ProposalController extends Controller
{
    public function __construct()
    {    
        $this->middleware('auth');
    }
////////////////////////////  MAHASISWA  ////////////////////////////////////////
    public function list()
    {
        $list_proposal = Proposal::whereUser_id(Auth::user()->id)->orderBy('created_at', 'DESC')->get();                
         
        return view('proposal.list', compact('list_proposal'));
    }

    public function input()
    {
        return view('proposal.input');
    }

    public function save(ProposalRequest $request)
    {
        $input = $request->all();
        $input['user_id'] = Auth::user()->id;
        $input['anggaran_b'] = '';
        $input['dana'] = 'belum';      
        $input['status'] = 'Proses';
        $input['lpj'] = '';


        if ($request->hasFile('file'))
        {
            $proposal_all = Proposal::get();
            $idproposal = count($proposal_all);            
            $cproposal = Proposal::whereUser_id(Auth::user()->id)->get();
            $jproposal = count($cproposal);
            $tproposal = $jproposal+1;

            $nama_file = 'proposal_'.$input['user_id']. '_' 
                            .$idproposal. '_' .$tproposal. '.pdf';
            $save_path = 'upload/file/';
            $input['file']->move($save_path,$nama_file);
            $input['file'] = $save_path.$nama_file;
        }
        else
        {
            $input['file'] = '';
        }       
        
        Proposal::create($input);
        $listuser = User::whereIn('prodi',['Dekan','Wakil Dekan 3','Sub Bagian Umum'])->get();
        Mail::send(['text'=>'emails.proposal_baru'], [], function($message)use ($listuser){
            foreach ($listuser as $user) {
                $message->to($user->email, $user->prodi)
                ->from('siprofeb@gmail.com', 'SI Proposal FEB')
                    ->subject('Proposal Baru Masuk');
            }            
        });

        return redirect()->route('proposal_list', compact('listrole'))->with('sukses', 'Proposal berhasil dikirim.');
    }

    public function edit($id)
    {
        $proposal = Proposal::whereId($id)->firstOrFail();

        return view('proposal.edit', compact('proposal'));        
    }

    public function update(EditProposalRequest $request, $id){
        $proposal = Proposal::whereId($id)->firstOrFail(); 
        $input = $request->all();
        $input['user_id'] = Auth::user()->id;
        $input['status'] = 'Proses';            

        if ($request->hasFile('file')){            
            File::delete($proposal->file);

            $cproposal = Proposal::whereUser_id(Auth::user()->id)->get();
            $jproposal = count($cproposal);
            $tproposal = $jproposal+1;

            $nama_file = 'proposal_'.$input['user_id']. '_' 
                            .$id. '_' .$tproposal. '.pdf';
            $save_path = 'upload/file/';
            $input['file']->move($save_path,$nama_file);
            $input['file'] = $save_path.$nama_file;
        }
        
        $proposal->update($input);

        $listuser = User::whereIn('prodi',['Dekan','Wakil Dekan 3','Sub Bagian Umum'])->get();
        Mail::send(['text'=>'emails.proposal_revisifmhs'], [], function($message)use ($listuser){
            foreach ($listuser as $user) {
                $message->to($user->email, $user->prodi)
                ->from('siprofeb@gmail.com', 'SI Proposal FEB')
                    ->subject('Proposal Revisi Masuk');
            }            
        });

        return redirect()->route('proposal_list')->with('sukses', 'Data proposal berhasil diperbaharui dan dikirim kembali untuk diproses.');
    }

    public function upload_lpj(Request $request, $id){
        $proposal = Proposal::whereId($id)->firstOrFail(); 
        $input['lpj'] = $request['lpj'];
        $input['user_id'] = Auth::user()->id;

        if ($proposal->lpj) {
            File::delete($proposal->lpj);
        }
        
        if ($request['lpj'] == '') {
            return redirect()->back()->with('gagal', 'Isian file LPJ tidak boleh kosong');
        }
        
        $validator = Validator::make($request->all(), [                
            'lpj' => 'mimes:pdf',
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $clpj = Proposal::whereUser_id(Auth::user()->id)->get();
        $jlpj = count($clpj);
        $tlpj = $jlpj+1;

        $nama_file = 'lpj_'.$input['user_id']. '_' 
                            .$id. '_' .$tlpj. '.pdf';
        $save_path = 'upload/file/';
        $input['lpj']->move($save_path,$nama_file);
        $input['lpj'] = $save_path.$nama_file;
        
        $proposal->update($input);

        $listuser = User::whereIn('prodi',['Dekan','Wakil Dekan 3','Sub Bagian Umum'])->get();
        Mail::send(['text'=>'emails.upload_lpj'], [], function($message)use ($listuser){
            foreach ($listuser as $user) {
                $message->to($user->email, $user->prodi)
                ->from('siprofeb@gmail.com', 'SI Proposal FEB')
                    ->subject('File Upload LPJ');
            }            
        });

        return redirect()->back()->with('sukses', 'File LPJ berhasil diupload');

    }

////////////////////////////  STAFF  ////////////////////////////////////////
    public function masuk()
    {
       $list_proposal = Proposal::whereStatus('Proses')
                            ->orderBy('created_at', 'DESC')->get();                    

        return view('proposal.list', compact('list_proposal'));
    }

    public function revisi()
    {
       $list_proposal = Proposal::whereStatus('Revisi')
                            ->orderBy('created_at', 'DESC')->get();                    

        return view('proposal.list', compact('list_proposal'));
    }

    public function disetujui()
    {
       $current_year = date('Y');                    
       $current_year = (int)$current_year;        

       $list_proposal = Proposal::whereStatus('Disetujui')
                            ->orderBy('created_at', 'DESC')->get();
       $current_pagu = Pagu::whereTahun($current_year)->first();
       

        return view('proposal.list', compact('list_proposal', 'current_year', 'current_pagu'));
    }

    public function ditolak()
    {
       $list_proposal = Proposal::whereStatus('Ditolak')
                            ->orderBy('created_at', 'DESC')->get();                    

        return view('proposal.list', compact('list_proposal'));
    } 

    public function catatan_list($id)
    {
        $proposal = Proposal::whereId($id)->firstOrFail();
        $catatan_list = Catatan::whereProposal_id($id)->orderBy('created_at', 'desc')->get();

        return view('proposal.catatan', compact('proposal', 'catatan_list'));
    }

    public function catatan_save(Request $request, $id)
    {
        $input = $request->all();        
        
        Catatan::create($input);

        $proposal = Proposal::whereid($id)->firstOrFail();
        Mail::send(['text'=>'emails.catatan'], [], function($message)use ($proposal){            
            $message->to($proposal->user->email, $proposal->user->name)
            ->from('siprofeb@gmail.com', 'SI Proposal FEB')
                ->subject('Catatan Proposal');            
        });

        return redirect()->route('catatan_list', $id); 
    }

    public function persetujuan(Request $request, $id)
    {
        $proposal = Proposal::whereId($id)->firstOrFail();
        $persetujuan = $request->only('anggaran_b', 'status');
        $catatan['catatan'] = $request['catatan'];        
        
        if($request['anggaran_b'] == ''){
            $persetujuan['anggaran_b'] = '';
        }        
        
        if ($request['catatan']) {
            $catatan['proposal_id'] = $proposal->id; 
            Catatan::create($catatan);
            $scatatan = 'Ada';
        
        }else{
            $scatatan = 'Tidak ada';
        }

        $proposal->update($persetujuan);

        if ($request['status'] == 'Revisi') {
            Mail::send(['text'=>'emails.proposal_revisitmhs'], ["scatatan"=>$scatatan], function($message)use ($proposal){
                $message->to($proposal->user->email, $proposal->user->name)
                ->from('siprofeb@gmail.com', 'SI Proposal FEB')
                    ->subject('Revisi Proposal');            
            });

            $listuser = User::whereIn('prodi',['Dekan','Sub Bagian Umum'])->get();
            Mail::send(['text'=>'emails.proposal_revisitstf'], ["scatatan"=>$scatatan], function($message)use ($listuser){
                foreach ($listuser as $user) {
                    $message->to($user->email, $user->prodi)
                    ->from('siprofeb@gmail.com', 'SI Proposal FEB')
                        ->subject('Revisi Proposal');
                }            
            });
        }
        elseif($request['status'] == 'Disetujui'){
            Mail::send(['text'=>'emails.proposal_disetujuitmhs'], ["scatatan"=>$scatatan], function($message)use ($proposal){
                $message->to($proposal->user->email, $proposal->user->name)
                ->from('siprofeb@gmail.com', 'SI Proposal FEB')
                    ->subject('Proposal Disetujui');            
            });

            $listuser = User::whereIn('prodi',['Dekan', 'Wakil Dekan 2', 'Sub Bagian Umum'])->get();
            Mail::send(['text'=>'emails.proposal_disetujuitstf'], ["scatatan"=>$scatatan], function($message)use ($listuser){
                foreach ($listuser as $user) {
                    $message->to($user->email, $user->prodi)
                    ->from('siprofeb@gmail.com', 'SI Proposal FEB')
                        ->subject('Proposal Disetujui');
                }            
            });
        }
        elseif ($request['status'] == 'Ditolak') {
            Mail::send(['text'=>'emails.proposal_ditolaktmhs'], ["scatatan"=>$scatatan], function($message)use ($proposal){
                $message->to($proposal->user->email, $proposal->user->name)
                ->from('siprofeb@gmail.com', 'SI Proposal FEB')
                    ->subject('Proposal Ditolak');            
            });

            $listuser = User::whereIn('prodi',['Dekan','Sub Bagian Umum'])->get();
            Mail::send(['text'=>'emails.proposal_ditolaktstf'], ["scatatan"=>$scatatan], function($message)use ($listuser){
                foreach ($listuser as $user) {
                    $message->to($user->email, $user->prodi)
                    ->from('siprofeb@gmail.com', 'SI Proposal FEB')
                        ->subject('Proposal Ditolak');
                }            
            });
        }

        return redirect()->back()->with('sukses', 'Status proposal berhasil diubah menjadi ' .$request['status']);
    }

    public function rekap()
    {
        $list_proposal = 0;
        $tahun  = '';
        $status = '';
        return view('proposal.rekap', compact('list_proposal', 'tahun', 'status'));
    }

    public function rekapshow(Request $request)
    {
        $tahun = $request['tahun'];
        $status = $request['status'];



        $list_proposal = Proposal::whereStatus($status)
                                    ->whereBetween('created_at', [$tahun.'-01-01 00:00:00', $tahun.'-12-31 23:59:59'])
                                        ->get();                    

        $jproposal = count($list_proposal);
        if ($jproposal != 0) {           
            $tanggaran = 0;
            if ($status == 'Disetujui') {
                $pagu  = Pagu::whereTahun($tahun)->firstOrFail();
                $sisapagu = $pagu->sisa;

                foreach ($list_proposal as $proposal) {
                    $sanggaran = str_replace(".", "",$proposal->anggaran_b);
                    $anggaran = (int)$sanggaran;            
                    $tanggaran += $anggaran;  
                }
            }        
        }
        
        return view('proposal.rekap', 
            compact('list_proposal', 'status', 'tanggaran', 'tahun', 'sisapagu'));
    }

    public function pdf(Request $request){
        $tanggaran = $request['tanggaran'];
        $tahun = $request['tahun'];        
        $status = $request['status'];
        $sisapagu = $request['sisapagu'];

        $list_proposal = Proposal::whereStatus($status)
                                    ->whereBetween('created_at', [$tahun.'-01-01 00:00:00', $tahun.'-12-31 23:59:59'])
                                        ->orderBy('created_at', 'ASC')->get();
        $wd3 = User::whereProdi('Wakil Dekan 3')->firstOrFail();                               
        $pdf = PDF::loadView('proposal.pdf', 
                compact('list_proposal', 'status', 'tanggaran', 'tahun', 
                        'pagutahun', 'sisapagu','wd3'))
                ->setPaper('a4', 'landscape');
        return $pdf->stream('Rekap Proposal '.$tahun.'.pdf');
    }

    public function status_dana(Request $request, $id){
        $proposal = Proposal::whereId($id)->firstOrFail();
        $status_dana = $proposal->dana;
        
        $tahun = $proposal->created_at->year;
        $pagu = Pagu::whereTahun($tahun)->firstOrFail();
        
        $anggaran = (int)(str_replace(".", "",$proposal->anggaran_b));
        $sisapagu = (int)(str_replace(".", "",$pagu->sisa));
        
        if ($status_dana == 'belum') {
            $status['dana'] = 'sudah';
            $sisa_baru = $sisapagu - $anggaran;
            $isisa_baru = number_format($sisa_baru, 0,'','.');
            $updatepagu['sisa'] = (string)$isisa_baru;
            
            Mail::send(['text'=>'emails.status_dana'], [], function($message)use ($proposal){
                $message->to($proposal->user->email, $proposal->user->name)
                ->from('siprofeb@gmail.com', 'SI Proposal FEB')
                    ->subject('Upload LPJ');            
            });

        }else{
            $status['dana'] = 'belum';
            $sisa_baru = $sisapagu + $anggaran;
            $isisa_baru = number_format($sisa_baru, 0,'','.');
            $updatepagu['sisa'] = (string)$isisa_baru;
        }
        
        $pagu->update($updatepagu);
        $proposal->update($status);

        return redirect()->back()->with('sukses', 'Status dana berhasil diubah menjadi ' .$status['dana']. ' diterima');
    }


}
