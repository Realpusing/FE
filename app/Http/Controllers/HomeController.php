<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('home');
    }
    public function arsip()
    {
        return view('home');
    }
    public function klasifikasi()
    {
        return view('klasifikasi');
    }
    public function dashboard()
    {
        return view('dashbord');
    }
}
