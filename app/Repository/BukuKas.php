<?php

namespace App\Repository;

use DB;
use Auth;

class BukuKas
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
}
