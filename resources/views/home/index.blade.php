@extends('layouts.app')

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12">
                <div class="breadcrumb-holder">
                    <h1 class="main-title float-left">Quick Menu</h1>
                    <ol class="breadcrumb float-right">
                        <li class="breadcrumb-item">Home</li>
                        <li class="breadcrumb-item active">Dashboard </li>
                    </ol>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
        <!-- end row -->
        <div class="row">
                <div class="col-xs-12 col-md-6 col-lg-6 col-xl-3">
                    <a href="{{ route('bukukas.masuk') }}">
                        <div class="card-box noradius noborder bg-default">
                            <i class="fa fa-cloud-download float-right text-white"></i>
                            <h6 class="text-white text-uppercase m-b-20">KAS </h6>
                            <h1 class="m-b-20 text-white ">Masuk
                            </h1>
                        </div>
                    </a>
                </div>

                <div class="col-xs-12 col-md-6 col-lg-6 col-xl-3">
                    <a href="{{ route('bukukas.keluar') }}">
                        <div class="card-box noradius noborder bg-warning">
                            <i class="fa fa-cloud-upload float-right text-white"></i>
                            <h6 class="text-white text-uppercase m-b-20">KAS</h6>
                            <h1 class="m-b-20 text-white ">Keluar
                            </h1>
                        </div>
                    </a>
                </div>

                <div class="col-xs-12 col-md-6 col-lg-6 col-xl-3">
                    <a href="">
                        <div class="card-box noradius noborder bg-danger">
                            <i class="fa fa-database float-right text-white"></i>
                            <h6 class="text-white text-uppercase m-b-20">Master</h6>
                            <h1 class="m-b-20 text-white counter">Data</h1>
                        </div>
                    </a>
                </div>

                <div class="col-xs-12 col-md-6 col-lg-6 col-xl-3">
                    <a href="{{ route('user') }}">
                        <div class="card-box noradius noborder bg-success">
                            <i class="fa fa-user float-right text-white"></i>
                            <h6 class="text-white text-uppercase m-b-120">Master</h6>
                            <h1 class="m-b-20 text-white counter">User</h1>
                        </div>
                    </a>
                </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-6">
                <div class="card mb-3">
                    <div class="card-header bg-success text-white">
                        <h3>
                            <i class="fa fa-paper-plane"></i> Transkasi Masuk
                            <span class="pull-right">
                                <div class="input-group date " id="datepicker">
                                    <div class="input-group-append">
                                        <span class="input-group-text input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control" readonly id="bulan" value="{{ date('M Y') }}" placeholder="bulan" name="bulan">
                                </div>
                            </span>
                        </h3>
                    </div>
                    <div class="card-body">
                        <table width="100%" id="tabel-masuk" class="table table-sm table-responsive-xl">
                            @csrf
                            <thead>
                                <tr bgcolor="#E5E5E5" style="height:45px;">
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>Keterangan</th>
                                    <th>Masuk</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- END container-fluid -->
</div>
@endsection
@push('scripts')
<script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datepicker/bootstrap-datepicker.min.js') }}"></script>
@include('home.scripts')
@endpush
