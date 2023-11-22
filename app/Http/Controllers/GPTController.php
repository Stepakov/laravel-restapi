<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GPTController extends Controller
{
    public function index()
    {
        return view( 'gpt' );
    }
}
