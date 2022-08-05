<script type="text/javascript">
$(function(){
    let urlLoadMasuk = '/kas/ajax/masuk';
    let urlLoadKeluar= '/kas/ajax/keluar';
    let urlDelete = '/kas/ajax/delete'

    $('#bulan,#datepicker').datepicker({
        format: 'MM yyyy',
        viewMode: "months",
        minViewMode: "months",
        autoclose: true,
    });

    $(document).on('keyup',"#jumlah",function(){
        let val = $(this).val();
        // let onlyAngka = val.replace(/[^\d]+/g,'')
        // getId('nominal').value = onlyAngka;
        $(this).val(formatRupiah($(this).val()));
    })

    $(document).on('change',"#bulan",function(){
        ajaxLoad();
    });

    $(document).on('change',"#bulan-keluar",function(){
        ajaxLoad2();
    });

    const ajaxLoad = () => {
        let tanggal = $("#bulan").val();
        $('#tabel-masuk').dataTable({
            Processing: true,
            ServerSide: true,
            sDom: '<t<p>>',
            iDisplayLength: 15,
            bDestroy: true,
            autoWidth: false,
            targets: "no-sort",
            bSort: false,
            oLanguage: {
                sLengthMenu: "_MENU_ ",
                sInfo: "Showing <b>_START_ to _END_</b> of _TOTAL_ entries",
                sSearch: "Search Data :  ",
                sZeroRecords: "Tidak ada data",
                sEmptyTable: "Data tidak tersedia",
                sLoadingRecords: '<img src="../../ajax-loader.gif"> Loading...',
            },
            ajax: {
                url: urlLoadMasuk,
                type: "GET",
                data: {
                    tanggal : tanggal,
                },
            },
            columns: [
                { mData: "no" },
                { mData: "tanggal" },
                { mData: "keterangan" },
                { mData: "masuk" },
                { mData: "aksi" }
            ],
            footerCallback: function (row, data, start, end, display) {
                var api = this.api(),
                    data;
                // Remove the formatting to get integer data for summation
                var intVal = function (i) {
                    return typeof i === "string"
                        ? i.replace(/[\$,.]/g, "") * 1
                        : typeof i === "number"
                        ? i
                        : 0;
                };
                // Total tagihan
                var total = api
                    .column(3, { search: "applied" })
                    .data()
                    .reduce(function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);
                // Update footer
                $(api.column(3).footer()).html(ribuan(total));
                $("#sum-total").val(total);
            },
        });
        oTable = $("#tabel-masuk").DataTable();
        $("#term").keyup(function () {
            oTable.search($(this).val()).draw();
            $(".table").removeAttr("style");
        });
    };

    const ajaxLoad2 = () => {
        let tanggal = $("#bulan-keluar").val();
        $('#tabel-keluar').dataTable({
            Processing: true,
            ServerSide: true,
            sDom: '<t<p>>',
            iDisplayLength: 15,
            bDestroy: true,
            autoWidth: false,
            targets: "no-sort",
            bSort: false,
            oLanguage: {
                sLengthMenu: "_MENU_ ",
                sInfo: "Showing <b>_START_ to _END_</b> of _TOTAL_ entries",
                sSearch: "Search Data :  ",
                sZeroRecords: "Tidak ada data",
                sEmptyTable: "Data tidak tersedia",
                sLoadingRecords: '<img src="../../ajax-loader.gif"> Loading...',
            },
            ajax: {
                url: urlLoadKeluar,
                type: "GET",
                data: {
                    tanggal : tanggal,
                },
            },
            columns: [
                { mData: "no" },
                { mData: "tanggal" },
                { mData: "keterangan" },
                { mData: "keluar" },
                { mData: "aksi" }
            ],
            footerCallback: function (row, data, start, end, display) {
                var api = this.api(),
                    data;
                // Remove the formatting to get integer data for summation
                var intVal = function (i) {
                    return typeof i === "string"
                        ? i.replace(/[\$,.]/g, "") * 1
                        : typeof i === "number"
                        ? i
                        : 0;
                };
                // Total tagihan
                var total = api
                    .column(3, { search: "applied" })
                    .data()
                    .reduce(function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);
                // Update footer
                $(api.column(3).footer()).html(ribuan(total));
                $("#sum-total").val(total);
            },
        });
        oTable = $("#tabel-keluar").DataTable();
        $("#term2").keyup(function () {
            oTable.search($(this).val()).draw();
            $(".table").removeAttr("style");
        });
    };

    $("#tabel-masuk tbody").on("click", "tr td button#delete-list", function() {
        let parentRow = $(this).closest("tr");
        let data = oTable.row(parentRow).data();
        if (confirm("Data transaksi akan dihapus!?")) {
            console.log(data.kode);
            $.ajax({
                url: urlDelete,
                dataType: 'JSON',
                method: 'delete',
                data : {
                    kode : data.kode,
                    _token: '{{ csrf_token() }}',
                },
                success: function (res) {
                    if (res.code == 200) {
                        $("#tabel-masuk").DataTable().ajax.reload();
                    } else {
                        alert(res.message)
                    }
                }
            });
        }
    });

    $("#tabel-keluar tbody").on("click", "tr td button#delete-list-keluar", function() {
        let parentRow = $(this).closest("tr");
        let data = oTable.row(parentRow).data();
        if (confirm("Data transaksi akan dihapus!?")) {
            console.log(data.kode);
            $.ajax({
                url: urlDelete,
                dataType: 'JSON',
                method: 'delete',
                data : {
                    kode : data.kode,
                    _token: '{{ csrf_token() }}',
                },
                success: function (res) {
                    if (res.code == 200) {
                        $("#tabel-keluar").DataTable().ajax.reload();
                    } else {
                        alert(res.message)
                    }
                }
            });
        }
    });

    (() => {
        ajaxLoad();
        ajaxLoad2();
    })();

});
</script>
