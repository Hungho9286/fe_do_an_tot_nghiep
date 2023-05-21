<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ThoiKhoaBieuController extends Controller
{
    function index(){
        return view('layouts.fe.thoikhoabieu');
    }
}
