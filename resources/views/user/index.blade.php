@extends('layouts.app')

@section('content')
<div class="content">            
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12">
                <div class="breadcrumb-holder">
                    <h1 class="main-title float-left">Daftar Pengguna</h1>
                    <ol class="breadcrumb float-right">
                        <li class="breadcrumb-item">Master</li>
                        <li class="breadcrumb-item active">User</li>
                    </ol>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
        <!-- end row -->
		<div class="row">
			<div class="col-xl-12">						
                <div class="card mb-3">
                    <div class="card-header">                    
                        <h3 class='box-title'>
                            <button class="btn btn-sm btn-primary" id="btn-tambah"><i class="fa fa-plus"> </i> Tambah Data</button>
                        </h3>
                    </div>                        
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="mytable" class="table table-sm table-bordered table-hover display">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Username</th>
                                        <th>Nama</th> 
                                        <th>Unit</th> 
                                        <th>Level</th>                                       
                                        <th>Aksi</th>
                                    </tr>
                                </thead>										
                                <tbody>                                   
                                
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>                        
            </div>														
        </div>	
    </div>			
</div>
<div class="modal fade custom-modal" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="customModal" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-info" role="document">
        <div class="modal-content">
            <div class="modal-header"> 
                <h4 class="modal-title" id="exampleModalLabel2">Master User Akses</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>          
            </div>
            <form class="form-horizontal" method="post" id="form-data" action="#"> 
                @csrf
                <input type="hidden" id="id" name="id">               
                <div class="modal-body">  
                    <div class="alert alert-danger print-error-msg" style="display:none">
                        <ul></ul>
                    </div>             
                  <div class="form-group row">
                    <label class="col-md-3 col-form-label" for="text-input">Username</label>
                    <div class="col-md-8">
                        <input type="text" class="form-control" id="username" name="username" placeholder="Username">            
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-md-3 col-form-label" for="text-input">Nama Pengguna</label>
                    <div class="col-md-8">
                        <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Pengguna">         
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-md-3 col-form-label" for="text-input">Password</label>
                    <div class="col-md-8">
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-md-3 col-form-label" for="text-input">Unit</label>
                    <div class="col-md-8">
                        <select class="form-control select2" name="kode_unit" id="kode_unit">
                            <option value="">- Pilih Unit -</option>
                        </select>          
                    </div>
                  </div>     
                  <div class="form-group row">
                    <label class="col-md-3 col-form-label" for="text-input">Hak Akses</label>
                    <div class="col-md-8">
                        <select class="form-control" name="role" id="role">
                            <option value="">- Pilih Level -</option>
                            <option value="Admin">Admin</option>
                            <option value="Direktur">Direktur</option>
                            <option value="Wadir">Wadir</option>
                            <option value="Unit">Unit</option>
                        </select>          
                    </div>
                  </div>            
                </div>
                <div class="modal-footer">                   
                    <button class="btn btn-primary" type="button" id="btn-submit">Simpan</button>
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/plugins/select2/js/select2.min.js') }}"></script>
<script>
    $(document).ready(function () {
        ajaxLoad();
    });

    function ajaxLoad(){
        $.fn.dataTable.ext.errMode = 'throw';
        $('#mytable').dataTable({
            "Processing": true,
            "ServerSide": true,
            "iDisplayLength": 25,
            "bDestroy": true,
            "oLanguage": {
                "sSearch": "Search Data :  ",
                "sZeroRecords": "No records to display",
                "sEmptyTable": "No data available in table"
            },
            "ajax": "{{ route('user.getdata') }}",
            "columns": [
                {"mData": "no"},                    
                {"mData": "username"},
                {"mData": "nama_pengguna"},
                {"mData": "kode_unit"},
                {"mData": "level"},
                {"mData": "aksi"},
            ]
        });
    }

    function getKodeUnit(kode)
    {
        $.ajax({
            url : "{{ route('unit.getkodeunit') }}",
            type: "GET",
            dataType: "JSON",            
            success: function(data)
            {          
                var html = '';
                html +='<option value="">- Pilih Unit -</option>';
                for(var i=0; i<data.length; i++){                    
                    html += '<option value="'+data[i].kode_unit+'">('+data[i].kode_unit+') '+data[i].nama_unit+'</option>';
                }  
                $('#kode_unit').html(html);
                if(kode){
                     $('#kode_unit option[value="'+kode+'"]').attr('selected','selected');
                }
                $(".select2").select2({
                    dropdownParent:  $('#modal-form'),
                    width: '100%'
                });
            },
            
        });      
    }

    $(document).on('click','#btn-tambah',function(e){       
        $('#form-data')[0].reset();
        $('#modal-form').modal('show');         
        $('#btn-submit').text('Simpan');
        document.getElementById('username').readOnly = false;
        getKodeUnit(null);
    });

    $(document).on('click','#btn-update',function(e){
        var id = $(this).data('kode');
        var username = $(this).data('username');
        var nama = $(this).data('nama');
        var unit = $(this).data('unit');
        var role = $(this).data('role');
        $('#form-data')[0].reset();
        $('#modal-form').modal('show'); 
        $('[name="id"]').val(id);
        $('[name="username"]').val(username);
        $('[name="nama"]').val(nama);
        $('[name="kode_unit"]').val(unit);
        $('[name="role"]').val(role);
        document.getElementById('username').readOnly = true;
        getKodeUnit(unit);        
        $('#btn-submit').text('Update');
    });

    $(document).on('click','#btn-submit',function(e){
        var formdata = $('#form-data').serialize();
        $('#btn-submit').prop('disabled', true);
        $('#btn-submit').text('... Proses Simpan');
        $.ajax({
            url : "{{ route('user.simpan') }}",
            type:"POST",
            dataType: "json",
            data : formdata,
            success: function(data)
            {    
                if($.isEmptyObject(data.error)){                                        
                    $('#modal-form').modal('hide');
                    toastr.success(data['pesan'], data['title']);
                    ajaxLoad();
                }else{
                    printErrorMsg(data.error);
                }
                $('#btn-submit').prop('disabled', false);
                $('#btn-submit').text('Simpan');                                
            }
        });   
    });

    function printErrorMsg (msg) {
        $(".print-error-msg").find("ul").html('');
        $(".print-error-msg").css('display','block');
        $.each( msg, function( key, value ) {
            $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
        });
    }

    $(document).on('click','#btn-delete',function(e){
        var konfirm = confirm("Data Akan Dihapus ?");
        if (konfirm) {
            var kode = $(this).data('id');
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                type:"POST",
                url:"{{ route('user.delete') }}",        
                dataType:'json',
                data : {
                    '_token' : CSRF_TOKEN,
                    '_method' : 'delete',
                    'id' : kode
                },
                success: function (result) {
                    console.log(result);
                    if(result['status']=='success'){
                        toastr.success(result['pesan']);
                    }else{
                        toastr.pesan(result['pesan']);
                    }
                    ajaxLoad();
                }
            });
        }        
    });

</script>
@endpush