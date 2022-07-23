<script type="text/javascript">
$(function(){
    let urlLoadMasuk = '/kas/ajax/masuk';
    let urlLoadKeluar= '/kas/ajax/keluar';

    $('#bulan').datepicker({
        format: 'MM yyyy',
        viewMode: "months",
        minViewMode: "months",
        autoclose: true,
    });

    $(document).on('keyup',"#jumlah",function(){
        let val = $(this).val();
        let onlyAngka = val.replace(/[^\d]+/g,'')
        // getId('nominal').value = onlyAngka;
        $(this).val(formatRupiah($(this).val()));
    })

     $(document).on('change',"#bulan",function(){
        ajaxLoad();
     });

    const ajaxLoad = () => {
        let tanggal = $("#bulan").val();
        $('#tabel-masuk').dataTable({
            Processing: true,
            ServerSide: true,
            sDom: '<t<p>>',
            iDisplayLength: 25,
            bDestroy: true,
            autoWidth: false,
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
            ]
        });
        oTable = $("#tabel-masuk").DataTable();
        $("#term").keyup(function () {
            oTable.search($(this).val()).draw();
            $(".table").removeAttr("style");
        });
    };

    (() => {
        ajaxLoad()
    })();

});
</script>
