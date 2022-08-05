@extends('layouts.app')
@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12">
                <div class="breadcrumb-holder">
                    <h1 class="main-title float-left">Form Kas Masuk</h1>
                    <ol class="breadcrumb float-right">
                        <li class="breadcrumb-item">
                            <a href="{{ route('home') }}">Dasboard</a>
                        </li>
                        <li class="breadcrumb-item">Transaksi</li>
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
                        <form action="{{ route('kasmasuk.store') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="userName">Tanggal <span class="text-danger">*</span> </label>
                                <input type="text" class="form-control"  name="tanggal" id="tanggal"  value="{{ date('d-m-Y') }}" required="" placeholder="Tanggal Transaksi" >
                            </div>
                            <div class="form-group">
                                <label for="userName">Jumlah<span class="text-danger">*</span> </label>
                                <input type="text" class="form-control" name="jumlah" id="jumlah" value="" data-parsley-trigger="change" required="" placeholder="Jumlah" >
                            </div>
                            <div class="text-primary pull-right m-b-10" id="jumlah_uang"></div>
                            <div class="form-group">
                                <label>Keterangan<span class="text-danger">*</span> </label>
                                <div>
                                    <textarea class="form-control" name="keterangan" required="" placeholder="keterangan" ></textarea>
                                </div>
                            </div>
                            <div class="form-group text-right m-b-0">
                                <button class="btn btn-primary" type="submit">Simpan</button>
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
<script src="{{ asset('assets/plugins/datepicker/bootstrap-datepicker.js') }}"></script>
<script src="{{ asset('assets/plugins/datepicker/locales/bootstrap-datepicker.id.js') }}"></script>
@include('bukukas.scripts-form')
@endpush
