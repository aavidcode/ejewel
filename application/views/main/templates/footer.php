
<?php if (!isset($footer_menu)) { ?>
<div class="container-fluid bottomback margintop10">
        <div class="container"> </div>
    </div>


<div class="container">
    <div class="row clearfix">
        <div class="col-md-3 column">
            <h3>ONLINE SHOP</h3>
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque mattis tortor arcu, quis molestie tortor dictum et. </div>
        <div class="col-md-3 column">
            <h3>FOLLOW US</h3>
            <a href="#"><span class="fa-stack fa-lg"> <i class="fa fa-square-o fa-stack-2x"></i> <i class="fa fa-twitter fa-stack-1x"></i> </span> Twitter</a><br>
            <a href="#"><span class="fa-stack fa-lg"> <i class="fa fa-square-o fa-stack-2x"></i> <i class="fa fa-facebook fa-stack-1x"></i> </span> Facebook</a><br>
            <a href="#"><span class="fa-stack fa-lg"> <i class="fa fa-square-o fa-stack-2x"></i> <i class="fa fa-google-plus fa-stack-1x"></i> </span> Google+</a><br>
        </div>
        <div class="col-md-3 column">
            <h3>CONTACT INFO</h3>
            <?php echo ($site_det->ADDRESS.', '.$site_det->CITY.', '.$site_det->STATE); ?>
            <br>
            <br>

            <strong>Telephone:</strong> <?php echo $site_det->TELEPHONE; ?> <br>
            <strong>Mobile:</strong> <?php echo $site_det->MOBILE; ?> <br>
            <strong>E-Mail:</strong> <?php echo $site_det->EMAIL_ID; ?>
        </div>
        <div class="col-md-3 column">

            <h3>MAILING LIST</h3>

            <form action="#" method="post">
                <div class="input-prepend"><span class="add-on"><i class="icon-envelope"></i></span>
                    <input type="text" id="email" name="" placeholder="your@email.com">
                </div>
                <br />
                <input type="submit" value="Subscribe Now!" class="btn" />
            </form>


        </div>
    </div>
</div>
<?php } ?>
<div class="container-fluid bottomfooter">
    <div class="container"> Terms of Service  - Privacy Policy  -   Contact Us  -  Support & FAQ </div>
</div>

</body>
</html>


