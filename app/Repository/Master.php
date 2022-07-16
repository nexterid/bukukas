<?php

namespace App\Repository;
use DB;

class Master
{
    protected $conn = "sqlsrv";

    //function query unit
    public function getMasterUnit()
    {       
        return DB::connection($this->conn)->table('tbl_unit')->select('kode_unit','nama_unit')->get();
    }

    public function saveMasterUnit($data)
    {        
        return DB::connection($this->conn)->table('tbl_unit')->insert($data);
    }

    public function updateMasterUnit($data)
    {
        $kode = $data['kode_unit'];
        return DB::connection($this->conn)->table('tbl_unit')->where('kode_unit',$kode)->update(['nama_unit'=>$data['nama_unit']]);
    }

    //function query Klasifikasi
    public function getMasterKlasifikasi()
    {       
        return DB::connection($this->conn)->table('tbl_klasifikasi_arsip as k')
                    ->select('k.kode_klasifikasi','k.keterangan as nama','k.kode_rumpun','r.keterangan as rumpun')
                    ->join('tbl_rumpun as r','k.kode_rumpun','=','r.kode_rumpun')
                    ->get();
    }

    public function getRumpun()
    {
        return DB::connection($this->conn)->table('tbl_rumpun')->select('kode_rumpun','keterangan as rumpun')->get();
    }  
    
    public function saveMasterKlasifikasi($data)
    {    
        $maxID = DB::connection($this->conn)->table('tbl_klasifikasi_arsip')->max('idx');
        $datainsert =[
            'kode_klasifikasi' =>$data['kode_klasifikasi'],
            'keterangan' => $data['keterangan'],
            'kode_rumpun' => $data['kode_rumpun'],
            'idx' => (int)$maxID+1
        ];
        return DB::connection($this->conn)->table('tbl_klasifikasi_arsip')->insert($datainsert);
    }

    public function updateMasterKlasifikasi($data)
    {
        $kode = $data['kode_klasifikasi'];
        return DB::connection($this->conn)->table('tbl_klasifikasi_arsip')->where('kode_klasifikasi','=',$kode)->update(['keterangan'=>$data['keterangan'],'kode_rumpun'=>$data['kode_rumpun']]);
    }

    

}