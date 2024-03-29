<?php

namespace App\Http\Controllers;

use App\Repository\RepoBukuKas;
use App\Models\BukuKas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BukuKasController extends Controller
{
    protected $bukukas;

    public function __construct()
    {
        $this->bukukas = new RepoBukuKas();
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
        return response()->json($result);
    }

    public function ajaxMasuk(Request $request)
    {
        $data['bulan'] = date('m', strtotime($request->tanggal));
        $data['tahun'] = date('Y', strtotime($request->tanggal));
        $data['jenis'] = 'Kas Masuk';
        $getdata = $this->bukukas->getBukuKasJenis($data);
        $hasil = [];
        $no = 1;
        foreach ($getdata as $val) {
            $hasil[] = [
                'no' => $no++,
                'kode' => $val->id,
                'tanggal' => tanggalIndo($val->tanggal),
                'jenis' => $val->jenis,
                'keterangan' => $val->keterangan,
                'masuk' => rupiah($val->masuk) ?? 0,
                'aksi' => '<button type="button" id="delete-list" class="btn btn-sm btn-outline-danger"><i class="fa fa-trash"></i></button>'
            ];
        }
        $result = isset($hasil) ? array('data' => $hasil) : array('data' => 0);
        return response()->json($result);
    }

    public function ajaxKeluar(Request $request)
    {
        $data['bulan'] = date('m', strtotime($request->tanggal));
        $data['tahun'] = date('Y', strtotime($request->tanggal));
        $data['jenis'] = 'Kas Keluar';
        $getdata = $this->bukukas->getBukuKasJenis($data);
        // dd($getdata);
        $hasil = [];
        $no = 1;
        foreach ($getdata as $val) {
            $hasil[] = [
                'no' => $no++,
                'kode' => $val->id,
                'tanggal' => tanggalIndo($val->tanggal),
                'jenis' => $val->jenis,
                'keterangan' => $val->keterangan,
                'keluar' => rupiah($val->keluar) ?? 0,
                'aksi' => '<button type="button" id="delete-list-keluar" class="btn btn-sm btn-outline-danger"><i class="fa fa-trash"></i></button>'
            ];
        }
        $result = isset($hasil) ? array('data' => $hasil) : array('data' => 0);
        return response()->json($result);
    }

    public function printBukuKas($bulan)
    {
        $data['bulan'] = date('m', strtotime($bulan));
        $data['tahun'] = date('Y', strtotime($bulan));
        $data['getdata'] = $this->bukukas->getBukuKasBulan($data);
        return view('bukukas.print-bukukas', compact('data'));
    }

    public function ajaxDelete(Request $request)
    {
        $delete = BukuKas::where('id', $request->kode)->delete();
        if ($delete) {
            return response()->json(['code' => 200, 'message' => 'data berhasil dihapus']);
        } else {
            return response()->json(['code' => 201, 'message' => 'data gagal dihapus']);
        }
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
