<?php

namespace App\Repository;

use Auth;
use Illuminate\Support\Facades\DB;

class RepoBukuKas
{
    public function getBukuKasBulan($params)
    {
        return DB::table('buku_kas')
            ->select('id', 'tanggal', 'jenis', 'masuk', 'keluar', 'keterangan', 'user')
            ->whereMonth('tanggal', $params['bulan'])
            ->whereYear('tanggal', $params['tahun'])
            ->orderBy('tanggal', 'ASC')
            ->get();
    }

    public function getBukuKasJenis($params)
    {
        return DB::table('buku_kas')
            ->select('id', 'tanggal', 'jenis', 'masuk', 'keluar', 'keterangan', 'user')
            ->whereMonth('tanggal', $params['bulan'])
            ->whereYear('tanggal', $params['tahun'])
            ->where('jenis', $params['jenis'])
            ->orderBy('tanggal', 'ASC')
            ->get();
    }
}
