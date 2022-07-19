<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BukuKasController extends Controller
{
    public function __construct()
    {
        // $this->repoUser = new User();
    }

    public function index()
    {
        return view('bukukas.index');
    }
}
