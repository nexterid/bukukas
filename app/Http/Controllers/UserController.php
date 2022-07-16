<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repository\User;
use Validator;
use Auth;

class UserController extends Controller
{
    public function __construct()
    {
        $this->repoUser = new User();        
    }    
    
    public function index()
    {  
        return view('user.index');
    }

    public function view_data(Request $request) 
    {
        if($request->ajax()){
            $no = 1;
            $getdata = $this->repoUser->getMasterUser();
            foreach ($getdata as $q) {   
                $query[] = array(
                    'no' => $no++,
                    'username'=>$q->username,               
                    'nama_pengguna' => $q->nama, 
                    'kode_unit' => $q->kode_unit,   
                    'level' => $q->role,                     
                    'aksi' => '<a href="#" id="btn-update" data-kode="'.$q->id.'" data-username="'.$q->username.'" data-nama="'.$q->nama.'" data-role="'.$q->role.'" data-unit="'.$q->kode_unit.'" class="btn btn-warning btn-sm"><i class="fa fa-pencil-square-o " data-toggle="tooltip" title="Edit"></i></a> 
                                <button class="btn btn-sm btn-danger" id="btn-delete" data-id="'.$q->id.'" title="Hapus"><i class="fas fa fa-trash"></i><span class="text"></span></button>'
                );
            }
            $result = isset($query) ? array('data' => $query): array('data' => 0);
            return response()->json($result);
        }
        
    }

    function simpanData(Request $request)
	{		
		if($request->ajax()){
            $validator = Validator::make($request->all(), [
                'username' => 'required',
                'nama' => 'required',
                'role' => 'required',
                'kode_unit' => 'required',
            ]);

            if ($validator->passes()) {                
                $kode = $request->id;
                $data=[
                    'username' =>$request->username,
                    'nama' => $request->nama,
                    'role' =>$request->role,
                    'kode_unit' => $request->kode_unit
                ];
                if($kode!=null){	
                    $title='Update';	               
                    if($request->password!=null){
                        $data['password']= bcrypt($request->password);                    
                    }
                    $data['updated_at'] = date('Y-m-d H:i:s');	
                    $query = $this->repoUser->updateUser($kode,$data);
                }else{
                    $title='Simpan';
                    $data['password']= bcrypt($request->password);
                    $data['created_at'] = date('Y-m-d H:i:s');
                    $query = $this->repoUser->saveUser($data);
                }			
                if($query){
                    return response()->json(['pesan'=>'Data Berhasil disimpan','title'=>$title]);
                }			
            }
            return response()->json(['error'=>$validator->errors()->all()]);			
		}
	}

    function profile()
    {
        $data=[
            'username'=>Auth::user()->username,
            'nama' =>Auth::user()->nama,
            'role' =>Auth::user()->role,
            'kode_unit'=> Auth::user()->kode_unit
        ];
        return view('user.profile',compact('data'));
    }

    function updateProfile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'nama' => 'required',
            'role' => 'required',
            'kode_unit' => 'required',
        ]);

        if ($validator->passes()) { 
            $username = $request->username;
            $data=[
                'nama' => $request->nama,
                'kode_unit' => $request->kode_unit,
                'updated_at' =>date('Y-m-d H:i:s')
            ];
            
            if($request->password!=null){
                $data['password']= bcrypt($request->password);                    
            }	
            if(Auth::user()->role=='Admin'){
                $data['role'] = $request->role;
            }
            $this->repoUser->updateProfile($username,$data);
            return redirect()->route('user.profile')->with("type","success")->with("message","Profile Berhasil di update");    
            			
        }
        return redirect()->route('user.profile')->with("type","error")->with("message",$validator->errors()->all()); 
    }

    function deleteUser(Request $request)
    {
        if($request->ajax()){
            $query = $this->repoUser->deleteUser($request);
            if($query){
                return response()->json(['status'=>'success','pesan'=>"User Berhasil di delete"]); 
            }else{
                return response()->json(['status'=>'error','pesan'=>'Gagal delete User']);
            }
        }        
    }
   
}
