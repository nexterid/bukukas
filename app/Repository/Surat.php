<?php

namespace App\Repository;
use DB;
use Auth;

class Surat
{
    protected $conn = "sqlsrv";

    //query dengan model
    public function getSuratMasuk($tanggal)
    {
        $role = Auth::user()->role;   
        $unit = Auth::user()->kode_unit;      
        $bulan= date('m', strtotime($tanggal));
        $tahun= date('Y', strtotime($tanggal));
        $result= DB::connection($this->conn)->table('tbl_agendasrtmasuk')
                    ->select('kode_klasifikasi','nomor_agenda','tanggal_agenda','asal_surat','nomor_surat','tanggal_surat','isi_surat','sifat_surat','disposisi_direktur','disposisi_direktur_ke','disposisi_wadir','disposisi_wadir_ke','nama_unit')
                    ->whereMonth('tanggal_agenda',$bulan)
                    ->whereYear('tanggal_agenda',$tahun)
                    ->orderBy('tanggal_agenda','DESC');
                    if($role=='Direktur'){
                        $result->where('tujuan_surat', '=','DIR');
                    }else if($role=='Wadir'){
                        $result->where('disposisi_direktur_unit',$unit)
                                ->orWhere('tujuan_surat',$unit);
                    }else if($role=='Unit'){                        
                        $result->where('disposisi_wadir_ke', $unit)
                                ->orWhere('disposisi_direktur_unit',$unit)
                                ->orWhere('tujuan_surat',$unit);
                    }                          
        return $result->get();        
    }

    public function getSuratMasukTanggal($tanggal)
    {
        $role = Auth::user()->role;   
        $unit = Auth::user()->kode_unit; 
        $result= DB::connection($this->conn)->table('tbl_agendasrtmasuk')
                    ->select('kode_klasifikasi','nomor_agenda','tanggal_agenda','asal_surat','nomor_surat','tanggal_surat','isi_surat','sifat_surat','disposisi_direktur','disposisi_direktur_ke','disposisi_wadir','disposisi_wadir_ke','nama_unit')
                    ->where('tanggal_agenda','=',$tanggal)
                    ->orderBy('tanggal_agenda','DESC');
                    if($role=='Direktur'){
                        $result->where('tujuan_surat', '=','DIR');
                    }else if($role=='Wadir'){
                        $result->where('disposisi_direktur_unit',$unit)
                                ->orWhere('tujuan_surat',$unit);
                    }else if($role=='Unit'){                        
                        $result->where('disposisi_wadir_ke', $unit)
                                ->orWhere('disposisi_direktur_unit',$unit)
                                ->orWhere('tujuan_surat',$unit);
                    }                            
        return $result->get();        
    }
    
    function countSuratMasukTgl()
    {
        $tanggal = date('Y-m-d');
        $suratmasuk = $this->getSuratMasukTanggal($tanggal);
        return count($suratmasuk);
    }

    public function getSuratKeluar($tanggal)
    {    
        $bulan= date('m', strtotime($tanggal));
        $tahun= date('Y', strtotime($tanggal));
        $result= DB::connection($this->conn)->table('tbl_agendasrtkeluar')
                    ->select('kode_klasifikasi','nomor_agenda','tanggal_agenda','kepada','isi_surat','pengolah','kode_rumpun','tanggal_surat','status_surat')
                    ->whereMonth('tanggal_agenda',$bulan)
                    ->whereYear('tanggal_agenda',$tahun)
                    ->orderBy('tanggal_agenda','DESC');
        return $result->get();
    }

    public function getUnitPegawai()
    {
        return DB::connection($this->conn)->table('tbl_unit')->select('kode_unit','nama_unit')->get();
    }

    public function getDisposisiDirektur($kode)
    {
        $getkode = explode(",",$kode);
		$kode_klasifikasi = $getkode[0];
		$no_agenda = $getkode[1];
		$tgl_agenda = $getkode[2];
        return DB::connection($this->conn)->table('tbl_agendasrtmasuk')
                    ->select('kode_klasifikasi', 'nomor_agenda', 'tanggal_agenda','disposisi_direktur_unit as kode_unit','disposisi_direktur_ke as disposisi_unit','tgl_disposisi_direktur as tgl_disposisi','disposisi_direktur as isi_disposisi')
                    ->where(['kode_klasifikasi'=>$kode_klasifikasi,'nomor_agenda'=>$no_agenda,'tanggal_agenda'=>$tgl_agenda])
                    ->first();
    }

    public function getDisposisiWadir($kode)
    {
        $getkode = explode(",",$kode);
		$kode_klasifikasi = $getkode[0];
		$no_agenda = $getkode[1];
		$tgl_agenda = $getkode[2];
        return DB::connection($this->conn)->table('tbl_agendasrtmasuk')
                    ->select('kode_klasifikasi', 'nomor_agenda', 'tanggal_agenda','disposisi_wadir_ke as kode_unit','nama_unit as disposisi_unit','tgl_disposisi_wadir as tgl_disposisi','disposisi_wadir as isi_disposisi')
                    ->where(['kode_klasifikasi'=>$kode_klasifikasi,'nomor_agenda'=>$no_agenda,'tanggal_agenda'=>$tgl_agenda])
                    ->first();
    }

    public function getDisposisiUnit($kode)
    {
        $getkode = explode(",",$kode);
		$kode_klasifikasi = $getkode[0];
		$no_agenda = $getkode[1];
		$tgl_agenda = $getkode[2];
        return DB::connection($this->conn)->table('tbl_agendasrtmasuk')
                ->select('kode_klasifikasi', 'nomor_agenda', 'tanggal_agenda','disposisi_wadir_ke as kode_unit','nama_unit as disposisi_unit','tgl_disposisi_unit as tgl_disposisi','disposisi_unit as isi_disposisi')
                ->where(['kode_klasifikasi'=>$kode_klasifikasi,'nomor_agenda'=>$no_agenda,'tanggal_agenda'=>$tgl_agenda])
                ->first();
    }

    public function saveDisposisi($primary_key,$data)
    {
       return DB::connection($this->conn)->table('tbl_agendasrtmasuk')->where($primary_key)->update($data);
    }

    public function getFileSuratMasuk($kode_file)
    {
        $getkode = explode(",",$kode_file);
		$kode_klasifikasi = $getkode[0];
		$no_agenda = $getkode[1];
		$tgl_agenda = $getkode[2];
        return DB::connection($this->conn)->table('file_masuk')
                ->select('file')
                ->where(['kode_klasifikasi'=>$kode_klasifikasi,'nomor_agenda'=>$no_agenda,'tanggal_agenda'=>$tgl_agenda])
                ->first();
    }

    public function getFileSuratKeluar($kode_file)
    {
       
        $getkode = explode(",",$kode_file);
		$kode_klasifikasi = $getkode[0];
		$no_agenda = $getkode[1];
		$tgl_agenda = $getkode[2];
        return DB::connection($this->conn)->table('file_keluar')
                ->select('file')
                ->where([
                    ['kode_klasifikasi',$kode_klasifikasi],
                    ['nomor_agenda',$no_agenda],
                    ['tanggal_surat',$tgl_agenda]
                ])
                ->first();
    }

}