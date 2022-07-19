<div class="content">            
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12">
                <div class="breadcrumb-holder">
                    <h1 class="main-title float-left">Form Kas Masuk</h1>
                    <ol class="breadcrumb float-right">
                        <li class="breadcrumb-item">
                            <?php echo anchor('home', 'Dashboard'); ?>
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
                        <form action="<?php echo $action; ?>" method="post">
                            <?php echo form_hidden($this->security->get_csrf_token_name(), $this->security->get_csrf_hash()); ?>
                            <div class="form-group">
                                <label for="userName">No Transaksi<span class="text-danger">*</span> <?php echo form_error('no_transaksi') ?></label> 
                                <input type="text" name="no_transaksi" id="no_transaksi" value="<?= $no_transaksi; ?>" data-parsley-trigger="change" <?= !empty($no_transaksi) ? "readonly" : ""?> placeholder="No Transaksi" class="form-control" >
                            </div>
                            <div class="form-group">
                                <label for="userName">Tanggal <span class="text-danger">*</span> <?php echo form_error('tgl') ?></label>
                                <input  type="text" name="tgl" id="datepicker"  value="<?= $tgl; ?>"data-parsley-trigger="change" required="" placeholder="Tanggal Daftar" class="form-control" >
                            </div> 
                            <div class="form-group">
                                <label for="userName">Jumlah<span class="text-danger">*</span> <?php echo form_error('jumlah') ?></label>
                                <input type="number" name="jumlah" id="jumlah" value="<?= $jumlah; ?>" data-parsley-trigger="change" required="" placeholder="Jumlah" class="form-control" oninput="toRibuan()">
                            </div>  
                            <div class="text-primary pull-right m-b-10" id="jumlah_uang">0</div>                          
                            <div class="form-group">
                                <label>Keterangan<span class="text-danger">*</span> <?php echo form_error('keterangan') ?></label>
                                <div>
                                    <textarea name="keterangan" required="" placeholder="keterangan" class="form-control"><?= $keterangan;?></textarea>
                                </div>
                            </div>  
                            <div class="form-group text-right m-b-0">
                                <button class="btn btn-primary" type="submit"><?= $button;?></button>
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
<script src="<?php echo base_url('assets/plugins/datatables/jQuery-2.1.4.min.js') ?>"></script>
<script>
    $(document).ready(function () {
        $('.table').removeAttr('style');
        var jumlah = document.getElementById ("jumlah");
        jumlah.focus();        
    });

    function toRibuan(){
        var jumlah = $('#jumlah').val();
        if(jumlah==""){
            $('#jumlah_uang').text(0);
        }else{
            $('#jumlah_uang').text(to_ribuan(parseInt(jumlah)));
        }
        console.log(jumlah);
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

</script>