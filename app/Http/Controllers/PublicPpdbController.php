<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PublicPpdbController extends Controller
{
    // halaman info PPDB untuk pengunjung umum
    public function index()
    {
        return view('ppdb.index');
    }
}
