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

     $(document).on('change',"#bulan",function(){
        ajaxLoad();
     });

    const ajaxLoad = () => {
        let tanggal = getId('bulan').value;
        $.ajax({
            type:"GET",
            dataType:"JSON",
            url:urlLoadData,
            data:{
                'tanggal':tanggal,
            },
            success:function(res){
                console.log(res.data)
                let data = res.data;
                let html ="";
                let no=1;
                let saldo =0;
                for(let i in data){
                    saldo +=data[i].masuk - data[i].keluar;
                    html +='<tr>'
                        html +='<td style="text-align:center">'+ no++
                        html +='<td>'+data[i].tanggal
                        html +='<td>'+data[i].keterangan
                        html +='<td>'+data[i].masuk
                        html +='<td>'+data[i].keluar
                        html +='<td>'+saldo
                    html +='</tr>'
                }
               $('#tampildata').html(html);
            //     loadSaldoAkhir();
            }
        });
    };

    (() => {
        ajaxLoad()
    })();

});
</script>
