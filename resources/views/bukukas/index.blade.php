@extends('layouts.app')
@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12">
                <div class="breadcrumb-holder">
                    <h1 class="main-title float-left"  id="info"></h1>
                    <ol class="breadcrumb float-right">
                        <li class="breadcrumb-item">
                            <a href="{{ route('home') }}">Dasboard</a>
                        </li>
                        <li class="breadcrumb-item active">Laporan Buku Kas</li>
                    </ol>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
        <!-- end row -->
		<div class="row">
			<div class="col-xl-12">
                <div class="card mb-3">
                    <div class="card-header bg-secondary text-white">
                        <form action="" method="post">
                        <div class="row">
                            <div class="col-lg-8">
                                <h3 class='box-title'><i class="fa fa-book"></i> LAPORAN BUKU KAS </h3>
                            </div>
                            <div class="col-lg-2">
                                <input type="text" class="form-control" name="bulan" id="bulan" value="{{ date('F Y')}}" >
                            </div>
                            <div class="col-lg-2" id="btn_cetak">
                                <button type="submit" class="btn btn-warning"><i class="fa fa-print"></i> Cetak Buku Kas </button>
                            </div>
                        </div>
                        </form>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="mytable" class="table table-sm table-bordered display">
                                <thead>
                                    <tr bgcolor="#E5E5E5" style="height:45px;">
                                        <th style="width: 5%;text-align:center">No</th>
                                        <th style="width: 10%;text-align:center">Tanggal</th>
                                        <th style="width: 35%;text-align:center">Uraian</th>
                                        <th style="width: 15%;text-align:center">Penerimaan (Debet)</th>
                                        <th style="width: 15%;text-align:center">Pengeluaran (Kredit)</th>
                                        <th style="width: 15%;text-align:center">Saldo</th>
                                    </tr>
                                </thead>
                                <tbody id="tampildata">

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <h5 class='card-title' id="saldoakhir"></h5>
                            <h5 class="card-title">Saldo : <span class="text-primary" id="tampilsaldo"></span></h5>
                            <a href="#" class="btn btn-primary" onclick="tutupBukuKas()" data-toggle="modal" data-target="#myModalKas" data-backdrop="static" data-keyboard="false">Tutup Buku Kas</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script src="{{ asset('assets/plugins/datepicker/bootstrap-datepicker.min.js') }}"></script>
{{-- <script src="{{ asset('assets/plugins/datepicker/locales/bootstrap-datepicker.id.js') }}"></script> --}}
@include('bukukas.scripts')
@endpush
