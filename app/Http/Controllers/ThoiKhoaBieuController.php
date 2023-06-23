<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ThoiKhoaBieuController extends Controller
{
    function index(){
        return view('layouts.fe.thoikhoabieu');
    }
    function thoikhoabieu_giangvien(){
        return view('giangvien.thoikhoabieu');
    }
}
