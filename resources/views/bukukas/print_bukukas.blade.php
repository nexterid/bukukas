<head>    
    <style>                  
        table {
            width: 100%;
            border-collapse: collapse;  
        } 	
        th {
            font-family: "Bookman Old Style";
            font-size:10px;
            height: 12px;
            padding: 4px;
        }
        td {            
            font-family: "Bookman Old Style";
            font-size:10px;
            height: 12px;
            padding: 4px;             
        }       
        .double_underline  {
            border-bottom: 1px double;

        }
        tr.bordered {
            border-bottom: 1px solid #000;
        }
    </style>
</head>
<body onLoad="window.print(); setTimeout(window.close, 0);">
<!-- <body> -->
    <section class='content'>
        <div class='row'>
            <div class="col-sm-12">
                <div class="box box-primary">
                    <div class="box-header">  
                        <table class="table ">
                            <tr>                                
                                <td style="text-align: center; padding: 1px;width:90%;font-size: 12px;height: 10px">
                                    BUKU KAS PEMBANTU PAMSIMAS
                                </td> 
                            </tr> 
                            <tr>                                
                                <td style="text-align: center; padding: 1px;width:90%;font-size: 12px;height: 10px">
                                    BULAN <?php echo strtoupper($bulan);?>
                                </td> 
                            </tr> 
                            <tr>
                                <td style="text-align: center; padding: 1px;width:90%;font-family:'Times New Roman';font-size: 13px">
                                    <strong>" <?php echo $profil['nama_bu'];?> "</strong>
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align: center;width:90%;padding: 1px;font-size: 12px;height: 10px">
                                    <?php echo $profil['alamat'];?>
                                </td>
                            </tr>
                        </table>   
                    </div>
                    <br>
                    <div class="box-body">
                        <div class="col-md-12"> 
                            <table style="font-size:10px" border="1">
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>Uraian</th>
                                    <th>Penerimaan <br> (Debet)</th>
                                    <th>Pengeluaran <br> (Kredit)</th>
                                    <th>Saldo</th>
                                </tr>
                                <?php
                                    $saldo_awal = $saldoawal['masuk']==null ? '0': $saldoawal['masuk'];
                                    $totalmasuk=0;
                                    $totalkeluar=0;
                                    $penerimaan = $pembayaran['total']+$saldoawal['masuk'];
                                    $saldo = $penerimaan;
                                    $no=3;
                                    echo '<tr>
                                                <td style="text-align:center">1</td>
                                                <td>-</td>
                                                <th>Saldo Awal Bulan Lalu </th>                        
                                                <th style="text-align:right">'.ribuan($saldoawal['masuk']).'</th>
                                                <th style="text-align:right">-</th>
                                                <th style="text-align:right">'.ribuan($saldoawal['masuk']).'</th>                        
                                        </tr>
                                        <tr>
                                            <td style="text-align:center">2</td>
                                            <td >'.tgl_lengkap($pembayaran['tanggal']).'</td>
                                            <td>Penerimaan dari Pembayaran Rekening Air Bulan '.bulan_tahun($tanggal).'</td>
                                            <td style="text-align:right">'.ribuan($pembayaran['total']).'</td>
                                            <td style="text-align:right">-</td>
                                            <td style="text-align:right">'.ribuan($penerimaan).'</td>
                                    </tr>';
                                    foreach($result as $r){
                                        $totalmasuk += $r->masuk;
                                        $totalkeluar += $r->keluar;
                                        $saldo += $r->masuk - $r->keluar;
                                        echo '<tr>
                                                <td style="text-align:center">'.$no++.'</td>
                                                <td>'.tgl_lengkap($r->tanggal).'</td>
                                                <td>'.$r->keterangan.'</td>
                                                <td style="text-align:right">'.ribuan($r->masuk).'</td>
                                                <td style="text-align:right">'.ribuan($r->keluar).'</td>
                                                <td style="text-align:right">'.ribuan($saldo).'</td>
                                        
                                        </tr>';   
                                    }
                                    echo '<tr bgcolor="#E5E5E5" style="height:35px">
                                        <th colspan="3" style="text-align:center"> Jumlah</th>
                                        <th style="text-align:right">Rp '.ribuan($totalmasuk+$pembayaran['total']+$saldoawal['masuk']).' <input type="hidden" id="val_pemasukan" value="'.($totalmasuk+$pembayaran['total']).'"></th>
                                        <th style="text-align:right">Rp '.ribuan($totalkeluar).' <input type="hidden" id="val_pengeluaran" value="'.$totalkeluar.'"></th>
                                        <th style="text-align:right">Rp '.ribuan($totalmasuk+$pembayaran['total']+$saldoawal['masuk']-$totalkeluar).'</th>
                                    </tr>
                                    <tr style="height:35px">
                                        <th colspan="5" style="text-align:right"> Saldo Awal <input type="hidden" id="val_saldoawal" value="'.$saldo_awal.'"></th>
                                        <th style="text-align:right">Rp '.ribuan($saldoawal['masuk']).'</th>
                                        
                                    </tr>
                                    <tr style="height:35px">
                                        <th colspan="5" style="text-align:right"> Saldo Akhir <input type="hidden" id="val_saldoakhir" value="'.($totalmasuk+$pembayaran['total']+$saldoawal['masuk']-$totalkeluar).'"</th>
                                        <th style="text-align:right">Rp '.ribuan($totalmasuk+$pembayaran['total']+$saldoawal['masuk']-$totalkeluar).'</th>               
                                    </tr>';    
                                ?>
                            </table>
                            <br>
                            <table>
                                <tr>  
                                    <td width="70%"></td>                                                        
                                    <td style="height:15px;font-size:12px;text-align:center">Tirto, <?php echo date('d-m-Y') ?></td>
                                    
                                </tr>  
                                <br>        
                                <tr>
                                    <td></td>
                                    <td style="text-align:center;width:50%;"><?php echo $profil['nama_bu'];?></td>
                                    
                                </tr>
                                <tr style="height:120px">
                                    <td></td>                                    
                                    <td style="text-align:center"><u><?php echo $profil['sekretaris'];?></u> <br>Sekretariat PAMS</td>
                                    
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
