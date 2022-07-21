<?php

namespace App\Http\Controllers;

use App\Models\BukuKas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function masuk()
    {
        return view('bukukas.form-masuk');
    }

    public function keluar()
    {
        return view('bukukas.form-keluar');
    }

    public function ajaxIndex(Request $request)
    {
        dd($request->all());
    }
    public function masukStore(Request $request)
    {
        $this->validate($request, [
            'tanggal' => 'required|date',
            'jumlah' => 'required|numeric',
            'keterangan' => 'required'
        ]);

        $data = [
            'tanggal' => date('Y-m-d', strtotime($request->tanggal)),
            'masuk' => str_replace(".", "", $request->jumlah),
            'jenis' => 'Kas Masuk',
            'keterangan' => $request->keterangan,
            'user' => Auth::user()->id
        ];
        $insert = BukuKas::create($data);
        return redirect('/home');
    }

    public function keluarStore(Request $request)
    {
        $this->validate($request, [
            'tanggal' => 'required|date',
            'jumlah' => 'required|numeric',
            'keterangan' => 'required'
        ]);

        $data = [
            'tanggal' => date('Y-m-d', strtotime($request->tanggal)),
            'keluar' => str_replace(".", "", $request->jumlah),
            'jenis' => 'Kas Keluar',
            'keterangan' => $request->keterangan,
            'user' => Auth::user()->id
        ];
        $insert = BukuKas::create($data);
        return redirect('/home');
    }
}
