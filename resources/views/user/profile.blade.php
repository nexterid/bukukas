@extends('layouts.app')

@section('content')
<div class="content">            
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12">
                <div class="breadcrumb-holder">
                    <h1 class="main-title float-left">Update Profil</h1>
                    <ol class="breadcrumb float-right">
                        <li class="breadcrumb-item">Profil</li>
                        <li class="breadcrumb-item active">Form</li>
                    </ol>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
        <!-- end row -->
		<div class="row">
			<div class="col-xl-12">						
                <div class="card mb-3">  
                    <div class="col-xl-6">
                        <div class="card-body">	
                            <form action="{{ route('user.update') }}" method="post">
                            @csrf
                                <input type="hidden" name="id_user" id="id_user" value="" data-parsley-trigger="change" class="form-control" >
                                <div class="form-group">
                                    <label for="username">Username<span class="text-danger">*</span></label> 
                                    <input type="email" name="username" id="username" value="{{ $data['username'] }}" readonly data-parsley-trigger="change" required="" placeholder="username" class="form-control" >
                                </div>
                                <div class="form-group">
                                    <label for="nama_pengguna">Nama<span class="text-danger">*</span></label>
                                    <input type="text" name="nama" id="nama" value="{{ $data['nama'] }}"  required="" placeholder="Nama Pengguna" class="form-control" >
                                </div>
                                <div class="form-group">
                                    <label for="password">Password <span class="text-danger">Kosongkan jika tidak akan merubah password</span></label>
                                    <input type="password" name="password" id="password" value="" data-parsley-trigger="change" placeholder="Password" class="form-control" >
                                </div> 
                                <div class="form-group">
                                    <label for="nama_pengguna">Kode Unit<span class="text-danger">*</span></label>
                                    <select class="form-control select2" name="kode_unit" id="kode_unit">
                                        <option value="">- Pilih Unit -</option>
                                    </select>
                                </div>
                                @if(Auth::user()->role=='Admin')
                                <div class="form-group">
                                    <label for="nama_pengguna">Role<span class="text-danger">*</span></label>
                                    <select class="form-control" name="role" id="role">
                                        <option value="">- Pilih Level -</option>
                                        <option value="Admin">Admin</option>
                                        <option value="Direktur">Direktur</option>
                                        <option value="Wadir">Wadir</option>
                                        <option value="Unit">Unit</option>
                                    </select>
                                </div>
                                @else
                                <div class="form-group">
                                    <label for="nama_pengguna">Role<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="role" readonly value="{{ $data['role'] }}">
                                </div>
                                @endif
                                <input type="hidden" id="kode" value="{{ $data['kode_unit'] }}">
                                <input type="hidden" id="role_level" value="{{ $data['role'] }}">
                                <div class="form-group text-right m-b-0">
                                    <button class="btn btn-primary" type="submit">Update</button>
                                    <a href="javascript:history.back()" class="btn btn-secondary m-l-5">Cancel</a>                                    
                                </div>
                            </form>
                        </div>
                    </div> 
                </div>                        
            </div>														
        </div>	
    </div>			
</div>
@endsection
@push('scripts')
<script src="{{ asset('assets/plugins/select2/js/select2.min.js') }}"></script>
<script>
    $(document).ready(function () {
        var kode = $('#kode').val();
        var role = $('#role_level').val();
        $('[name="role"]').val(role);
        getKodeUnit(kode)
    });

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
                    width: '100%'
                });
            },
            
        });      
    }
</script>
@endpush