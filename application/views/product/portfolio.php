<link href="css/glasscase.css" rel="stylesheet" type="text/css" />

<div class="container">

    <div class="row">
        <ol class="breadcrumb">
            <li><a href="user/home/<?php echo $site_user_name; ?>">Home</a></li>
        </ol>
        <div class="col-lg-12">
            <h1 class="page-header" style="margin-top: 0;"><?php echo $prod_sum_det->PROD_NAME; ?>
                <small><?php echo $prod_sum_det->PROD_SHORT_DESC; ?></small>
            </h1>
        </div>
    </div>


    <div class="row"> 

        <div class="col-md-7">
            <ul id='prod_preview' class='gc-start'>
                <?php
                $img_arr = explode(';', $prod_sum_det->PROD_IMAGES);
                $path = 'uploads/' . $prod_sum_det->MF_USER_ID . '/' . $prod_sum_det->PROD_ID . '/';
                foreach ($img_arr as $img) {
                    echo '<li><img src="' . $path . $img . '"  /></li>';
                }
                ?>
            </ul>
        </div>

        <div class="col-md-4">
            <h3>Rs. <?php echo $prod_sum_det->MF_TOTAL_PRICE; ?></h3>
            <h3>Project Description</h3>
            <p><?php echo $prod_sum_det->PROD_DESC; ?></p>
            <h3>Project Details</h3>
            <ul>
                <li>Lorem Ipsum</li>
                <li>Dolor Sit Amet</li>
                <li>Consectetur</li>
                <li>Adipiscing Elit</li>
            </ul>
        </div>

    </div>

    <div class="row">

        <div class="col-lg-12">
            <h3 class="page-header">Related Products</h3>
        </div>

        <div class="col-sm-3 col-xs-6">
            <a href="#">
                <img class="img-responsive portfolio-item" src="http://placehold.it/500x300">
            </a>
        </div>

        <div class="col-sm-3 col-xs-6">
            <a href="#">
                <img class="img-responsive portfolio-item" src="http://placehold.it/500x300">
            </a>
        </div>

        <div class="col-sm-3 col-xs-6">
            <a href="#">
                <img class="img-responsive portfolio-item" src="http://placehold.it/500x300">
            </a>
        </div>

        <div class="col-sm-3 col-xs-6">
            <a href="#">
                <img class="img-responsive portfolio-item" src="http://placehold.it/500x300">
            </a>
        </div>

    </div>

</div>
<!-- /.container -->


<script src="js/jquery.glasscase.min.js" type="text/javascript"></script>
<script type="text/javascript">
    $(function() {
        $("#prod_preview").glassCase({'isDownloadEnabled': 'false', 'colorActiveThumb': '#9b2c29', 'colorIcons': '#000', 'widthDisplay': '534', 'heightDisplay': '350'});
    });
</script>
