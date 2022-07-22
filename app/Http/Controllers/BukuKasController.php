<?php

namespace App\Http\Controllers;

use App\Repository\BukuKas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BukuKasController extends Controller
{
    protected $bukukas;

    public function __construct()
    {
        $this->bukukas = new BukuKas();
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
        $data['bulan'] = date('m', strtotime($request->tanggal));
        $data['tahun'] = date('Y', strtotime($request->tanggal));
        $getdata = $this->bukukas->getBukuKasBulan($data);
        // dd($getdata);
        $hasil = [];
        foreach ($getdata as $val) {
            $hasil[] = [
                'tanggal' => tanggalIndo($val->tanggal),
                'jenis' => $val->jenis,
                'keterangan' => $val->keterangan,
                'masuk' => $val->masuk ?? 0,
                'keluar' => $val->keluar ?? 0
            ];
        }
        $result = isset($hasil) ? array('data' => $hasil) : array('data' => 0);
        return json_encode($result);
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
