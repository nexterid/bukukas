<?php

namespace App\Repository;
use DB;
use Auth;

class User
{
    protected $conn = "sqlsrv";

    public function getMasterUser()
    {       
        return DB::connection($this->conn)->table('user_access')
                ->select('id','username','password','nama','role','kode_unit')
                ->where('id','<>',1)
                ->get();
    }

    public function saveUser($data)
    {
        return DB::connection($this->conn)->table('user_access')->insert($data);
    }

    public function updateUser($kode,$data)
    {       
        return DB::connection($this->conn)->table('user_access')->where('id','=',$kode)->update($data);
    }

    public function updateProfile($username,$data)
    {       
        return DB::connection($this->conn)->table('user_access')->where('username','=',$username)->update($data);
    }

    public function deleteUser($request)
    {
        return DB::connection($this->conn)->table('user_access')->where('id','=',$request->id)->delete();
    }
}