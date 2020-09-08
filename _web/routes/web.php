<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'HomeController@index')->name('home');

Auth::routes();
Route::get('/proposal/login', 'LogoutController@logout')->name('logout');

// Route::get('/mail', 'EmailController@send');

Route::get('/list', ['middleware' => ['permission:proposal_mhs'],
						'uses' => 'ProposalController@list'])->name('proposal_list');
Route::get('/masuk', ['middleware' => ['permission:proposal_masuk'],
						'uses' => 'ProposalController@masuk'])->name('proposal_masuk');		
Route::get('/revisi', ['middleware' => ['permission:proposal_revisi'],
						'uses' => 'ProposalController@revisi'])->name('proposal_revisi');
Route::get('/disetujui', ['middleware' => ['permission:proposal_disetujui'],
						'uses' => 'ProposalController@disetujui'])->name('proposal_disetujui');
Route::get('/ditolak', ['middleware' => ['permission:proposal_ditolak'],
						'uses' => 'ProposalController@ditolak'])->name('proposal_ditolak');
Route::get('/rekap', ['middleware' => ['permission:proposal_masuk'],
						'uses' => 'ProposalController@rekap'])->name('proposal_rekap');
Route::post('/rekap', ['middleware' => ['permission:proposal_masuk'],
						'uses' => 'ProposalController@rekapshow'])->name('proposal_rekapshow');
Route::post('/rekap/pdf',['middleware' => ['permission:proposal_disetujui'],
						'uses' => 'ProposalController@pdf'])->name('proposal_pdf');

Route::patch('/disetujui/{id}',['middleware' => ['permission:status_dana'],
						'uses' => 'ProposalController@status_dana'])->name('status_dana');

Route::get('/input', ['middleware' => ['permission:input_proposal'],
						'uses' => 'ProposalController@input'])->name('proposal_input');
Route::post('/input', 'ProposalController@save')->name('proposal_save');

Route::get('/list/{id}/edit', ['middleware' => ['permission:edit_proposal'],
						'uses' => 'ProposalController@edit'])->name('proposal_edit');
Route::patch('/list/{id}/edit', 'ProposalController@update')->name('proposal_update');
Route::patch('/list/{id}', 'ProposalController@upload_lpj')->name('upload_lpj');

Route::patch('/persetujuan/{id}', 'ProposalController@persetujuan')->name('proposal_persetujuan');
Route::get('/list/{id}/catatan', 'ProposalController@catatan_list')->name('catatan_list');
Route::post('/list/{id}/catatan', 'ProposalController@catatan_save')->name('catatan_save');

Route::get('/users/staff_list', 'UserController@staff_list')->name('staff_list');
Route::get('/users/mahasiswa_list', 'UserController@mahasiswa_list')->name('mahasiswa_list');
Route::get('/users/{id}/edit', 'UserController@edit')->name('user_edit');
Route::patch('/users/{id}', 'UserController@update')->name('user_update');
Route::delete('/users/{id}', 'UserController@delete')->name('user_delete');

Route::get('/prodi/list', 'ProdiController@list')->name('prodi_list');
Route::post('/prodi/list', 'ProdiController@save')->name('prodi_save');
Route::get('/prodi/{id}/edit', 'ProdiController@edit')->name('prodi_edit');
Route::patch('/prodi/list/{id}', 'ProdiController@update')->name('prodi_update');
Route::delete('/prodi/{id}', 'ProdiController@delete')->name('prodi_delete');


Route::get('/pagu/list', 'PaguController@list')->name('pagu_list');
Route::post('/pagu/list', 'PaguController@save')->name('pagu_save');
Route::patch('/pagu/list/{id}', 'PaguController@update')->name('pagu_update');