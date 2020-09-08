<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;

class EmailController extends Controller
{
    public function send()
    {
    	Mail::send(['text'=>'emails.proposal_baru'], [], function($message){
    		$message->to('firdaus48akmal@gmail.com', 'Kepada Akmal')->subject('Tes Email 2');
    		$message->from('firdaus48akmal@gmail.com', 'Firdaus');
    	});
    }
}
