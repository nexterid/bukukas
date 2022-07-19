<div class="content">            
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12">
                <div class="breadcrumb-holder">
                    <h1 class="main-title float-left"  id="info"></h1>
                    <ol class="breadcrumb float-right">
                        <li class="breadcrumb-item">
                            <?php echo anchor('home', 'Dashboard'); ?>
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
                        <?php echo form_open('laporanbukukas/cetakbuku',array('target'=>'_blank')); ?>
                        <div class="row">
                            <div class="col-lg-8">                
                                <h3 class='box-title'><i class="fa fa-book"></i> BUKU KAS PEMBANTU PAMSIMAS  </h3>  
                            </div>         
                            <div class="col-lg-2">
                                <select name="bulan" id="bulan" class="form-control" onchange="ajaxLoad()">
                                    <?php 
                                        $start = strtotime('first day of this month');
                                        for ($i = 0; $i <= 12; ++$i) {
                                            $time = strtotime(sprintf('-%d months', $i), $start);
                                            $value = date('Y-m-d', $time);
                                            $label = date('Y-m', $time);
                                            echo "<option value='$value'>".tgl_lengkap($label)."</option>";
                                        }  
                                    ?>
                                </select>
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
                                        <th style="width: 15%;text-align:center">Penerimaa (Debet)</th>
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
<div class="modal fade" id="myModalKas" tabindex="-1" role="dialog" aria-labelledby="customModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel2">Form Tutup Buku Kas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body"> 
                <form action="#" id="form">
                    <input type="hidden" class="txt_csrfname" id="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                    <div class="m-t-10"> 
                        <div class="input-group mb-2 mr-sm-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text width-100">Saldo Awal Bulan</div>
                                <span class="input-group-text bg-success text-white">Rp.</span>
                            </div>
                            <input type="text" readonly="readonly" class="form-control text-right" id="saldo_awal" placeholder="Saldo Awal">
                        </div>                       
                        <div class="input-group mb-2 mr-sm-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text width-100">Jumlah Penerimaan</div>
                                <span class="input-group-text bg-success text-white">Rp.</span>
                            </div>
                            <input type="text" readonly="readonly" class="form-control text-right" id="jml_masuk" placeholder="Jumlah Penerimaan">
                        </div>
                        <div class="input-group mb-2 mr-sm-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text width-100">Jumlah Pengeluaran</div>
                                <span class="input-group-text bg-success text-white">Rp.</span>
                            </div>
                            <input type="text" readonly="readonly" class="form-control text-right" id="jml_keluar" placeholder="Jumlah Pengeluaran">
                        </div>
                        <div class="input-group mb-2 mr-sm-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text width-100">Saldo Akhir Bulan</div>
                                <span class="input-group-text bg-success text-white">Rp.</span>
                            </div>
                            <input type="text" readonly="readonly" class="form-control text-right" name="saldo_akhir" id="saldo_akhir" placeholder="Saldo Akhir" >
                        </div>                        
                        <div class="input-group mb-2 mr-sm-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text width-100">Tutup Buku</div>
                                <span class="input-group-text bg-success text-white">Bln</span>
                            </div>
                            <input type="text" readonly="readonly" class="form-control text-right" id="tutupbuku_bln" placeholder="Bulan Tutup Buku" >
                        </div>                        
                        <input type="hidden" name="saldo_akhir_tutupbuku" id="saldo_akhir_tutupbuku">
                        <input type="hidden" name="tgl_tutupbuku" id="tgl_tutupbuku">
                    </div>                   
                </form>
            </div>
            <div class="modal-footer">
                <button type="submit" id="simpankas" class="btn btn-primary" onclick="simpanSaldo()"><i class="fa fa-gear"></i> Proses</button>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo base_url('assets/plugins/datatables/jQuery-2.1.4.min.js') ?>"></script>
<script>
    $(document).ready(function () {
      $('.table').removeAttr('style');
      ajaxLoad();
    });
   
    function ajaxLoad(){
        var tanggal =$('#bulan').val();
        loadInfo();
        $.ajax({
            type:"GET",
            dataType:"html",
            url:"<?php echo site_url('laporanbukukas/getBukuKas');?>",
            data:{
                'tanggal':tanggal,
            },
            success:function(data){                
               $('#tampildata').html(data);               
                loadSaldoAkhir();
            }
        });     
    }

    function cetakBukuKas(){
        var tanggal =$('#bulan').val();
        $.ajax({
            type:"GET",
            dataType:"html",
            url:"<?php echo site_url('laporanbukukas/cetakBukuKas');?>",
            data:{
                'tanggal':tanggal,
            },
            success:function(data){                
              
            }
        });     
    }

    function loadSaldoAkhir(){
        var tanggal =$('#bulan').val();
        var saldoakhir = $('#val_saldoakhir').val();
        $.ajax({
            type:"GET",
            dataType:"json",
            url:"<?php echo site_url('laporanbukukas/getSaldoAkhir');?>",
            data:{
                'tanggal':tanggal,
                'saldoakhir' : saldoakhir
            },
            success:function(response){  
               $('#tampilsaldo').text(response.data);
               if(response.status=='enable'){
                    $('#btn_cetak').show();
               }else{
                    $('#btn_cetak').hide();
               }
            }
        });    
    }

    function tutupBukuKas(){
        var tanggal = document.getElementById('bulan');
        var bulan = tanggal.options[tanggal.selectedIndex].text;
        var tgl =$('#bulan').val();
        var pemasukan = $('#val_pemasukan').val();
        var pengeluaran = $('#val_pengeluaran').val();
        var saldoawal = $('#val_saldoawal').val();
        var saldoakhir = $('#val_saldoakhir').val();

        $('#saldo_awal').val(to_ribuan(saldoawal));
        $('#saldo_akhir').val(to_ribuan(saldoakhir));
        $('#jml_masuk').val(to_ribuan(pemasukan));
        $('#jml_keluar').val(to_ribuan(pengeluaran));
        $('#tutupbuku_bln').val(bulan);
        $('#saldo_akhir_tutupbuku').val(saldoakhir);
        $('#tgl_tutupbuku').val(tgl);
    }

    function simpanSaldo(){
        $('#simpankas').prop('disabled', true);
        $('#simpankas').text('... Proses Simpan');
        var csrfName = $('#txt_csrfname').attr('name'); 
        var csrfHash = $('#txt_csrfname').val(); 
        var tanggal = $('#tgl_tutupbuku').val();
        var saldoakhir = $('#saldo_akhir_tutupbuku').val();
        $.ajax({
            type:"POST",
            dataType:"json",
            url:"<?php echo site_url('laporanbukukas/simpankas');?>",
            data:{
                [csrfName] : csrfHash,
                'saldoakhir' : saldoakhir,
                'tanggal' : tanggal
            },
            success:function(data){ 
               if(data.status == true){   
                    $('#myModalKas').modal('hide'); 
                    $('#simpankas').prop('disabled', false);
                    $('#simpankas').text('Simpan');  
                    $('.txt_csrfname').val(data.token);
                    loadSaldoAkhir();                    
                }else{
                    alert(data.pesan);
                }   
            }
        });    
    }

    function to_ribuan(angka){
        var rev     = parseInt(angka, 10).toString().split('').reverse().join('');
        var rev2    = '';
        for(var i = 0; i < rev.length; i++){
            rev2  += rev[i];
            if((i + 1) % 3 === 0 && i !== (rev.length - 1)){
                rev2 += '.';
            }
        }
        return rev2.split('').reverse().join('');
    }

    function loadInfo(){
        var tanggal = document.getElementById('bulan');
        var info = tanggal.options[tanggal.selectedIndex].text;
        var tanggalVal = $('#bulan').val();        
        $.ajax({
            type:"GET",
            dataType:"html",
            url:"<?php echo site_url('laporanbukukas/getBulanLalu');?>",
            data:{
                'tanggal':tanggalVal,
            },
            success:function(data){                
                $('#saldoakhir').text('Saldo Akhir Tutup Buku Bulan '+data)
            }
        });     
        $('#info').text('Laporan Buku Kas Bulan : '+info)
        
    }

</script>