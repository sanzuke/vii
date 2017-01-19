 <!-- Footer -->
    <div class="footer">
        <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <p>Copyright &copy; Your Website 2014</p>
            </div>
        </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="<?php echo base_url() . 'themes/tokoonline/' ?>js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url() . 'themes/tokoonline/' ?>js/bootstrap.min.js"></script>
    <script type="text/javascript">
    var url = 'http://' + document.location.hostname + '/babyshop/index.php/cart'
    t=typeof t!="undefined"?t:1;
    $.ajax({
        url: url,
        type:"post",
        dataType:"json",
        success:function(data){
            $(".success, .warning, .attention, .information, .error").remove();
            //e.redirect&&(location=e.redirect);
            /*if(e.success){
                $("#notification").html('<div class="success" style="display: none;">Item sudah masuk ke keranjang'+
                    '<i class="icon-cancel-circled close"></div>');
                $(".success").fadeIn("slow");
                //$("#cart-total").html(data.price);
                $("html, body").animate({scrollTop:0},"slow");

            //}*/
            var total = 0;
            //$.each(data, function(index,  value){
            for(i=0; i< data.length; i++){
                var value = data[i];
                var val = new Number(value.price);
                total = total + val;
                $(".empty").css("style","none");
            };
            console.log(data.length+' item(s) <strong>Rp '+total+'</strong>');
            $(".dasdasd").html(data.length+' item(s) <strong>Rp '+total.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,')+'</strong>');
            //$("#cart").html('');
        }
    });
</script>
</body>

</html>
