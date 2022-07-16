<?php

namespace App\Repository;
use DB;
use Auth;

class Home
{
    protected $conn = "sqlsrv";

    function countAbsensiTgl()
    {
        $tanggal = date('Y-m-d');
        $data = DB::connection($this->conn)
                ->table('absensi as a')
                ->select('a.tanggal','a.kd_pegawai')
                ->groupBy('a.tanggal','a.kd_pegawai')
                ->whereDate('a.tanggal', '=', $tanggal)
                ->get()->count(); 
        return $data;
    }

    function countTotalPegawai()
    {
        $data = DB::connection($this->conn2)
                ->table('pegawai as peg')
                ->select('peg.kd_pegawai','peg.nip','peg.nama_pegawai','peg.gelar_depan','peg.gelar_belakang','peg.jns_kel','peg.alamat','unit.nama_sub_unit','jnspeg.jns_pegawai')
                ->join('sub_unit as unit','peg.kd_sub_unit','=','unit.kd_sub_unit')
                ->join('jenis_pegawai as jnspeg','peg.kd_jns_pegawai','=','jnspeg.kd_jns_pegawai')
                ->where('peg.status_pegawai','=',1)
                ->get()->count();
        return $data;
    }

    public function countUserdevice()
    {
        return DB::connection($this->conn)->table('akun')->get()->count();
    }

}