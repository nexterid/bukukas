<script type="text/javascript">
$(function(){
    $('#tanggal').datepicker({
        autoclose: true,
    });

    $('#bulan').datepicker({
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
});
</script>
