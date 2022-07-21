<script type="text/javascript">
$(function(){
    let urlLoadData = '/kas/ajax/index';


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
        let onlyAngka = val.replace(/[^\d]+/g,'')
        // getId('nominal').value = onlyAngka;
        $(this).val(formatRupiah($(this).val()));
    })

    const ajaxLoad = () => {
        let tanggal = getId('bulan').value;
        $.ajax({
            type:"GET",
            dataType:"JSON",
            url:urlLoadData,
            data:{
                'tanggal':tanggal,
            },
            success:function(data){
            //    $('#tampildata').html(data);
            //     loadSaldoAkhir();
            }
        });
    };

    (() => {
        ajaxLoad()
    })();

});
</script>
