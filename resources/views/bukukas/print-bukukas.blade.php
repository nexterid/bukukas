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
                                    LAPORAN BUKU KAS
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align: center; padding: 1px;width:90%;font-size: 12px;height: 10px">
                                    BULAN {{ strtoupper(bulan($data['bulan']).' '.$data['tahun'])}}
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
                                @php
                                    $no=1;
                                    $saldo=0;
                                    $totalMasuk =0;
                                    $totalKeluar=0;
                                @endphp
                                @foreach ($data['getdata'] as $val)
                                    @php
                                        $saldo += ($val->masuk - $val->keluar);
                                    @endphp
                                    <tr>
                                        <td style="text-align: center">{{ $no++ }}</td>
                                        <td style="text-align: center">{{ tanggalIndo($val->tanggal) }}</td>
                                        <td>{{ $val->keterangan }}</td>
                                        <td style="text-align: right">{{ rupiah($val->masuk) }}</td>
                                        <td style="text-align: right">{{ rupiah($val->keluar) }}</td>
                                        <td style="text-align: right">{{ rupiah($saldo) }}</td>
                                    </tr>
                                    @php
                                        $totalMasuk +=$val->masuk;
                                        $totalKeluar +=$val->keluar;
                                    @endphp
                                @endforeach
                                <tr>
                                    <th colspan="3" style="text-align: center">TOTAL</th>
                                    <th style="text-align: right">{{ rupiah($totalMasuk) }}</th>
                                    <th style="text-align: right">{{ rupiah($totalKeluar) }}</th>
                                    <th style="text-align: right">{{ rupiah($totalMasuk-$totalKeluar) }}</th>
                                </tr>
                            </table>
                            <br>
                            <table>
                                <tr>
                                    <td></td>
                                    <td style="text-align:center;width:50%;">Pekalongan, {{ date('d-m-Y H:i')}}</td>
                                </tr>
                                <tr style="height:100px">
                                    <td></td>
                                    <td style="text-align:center"><u><br>Admin Buku Kas</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
