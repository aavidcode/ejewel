<div class="container">

    <div class="row">

        <!-- Static navbar -->
        <div class="navbar navbar-default" role="navigation">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="product/collections">Collections</a>
                </div>
                <div class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="#">Diamond Jewellary</a></li>
                        <li><a href="#">Gold Jewellary</a></li>
                        <li><a href="#">Wedding Jewellary</a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="#">Action</a></li>
                                <li><a href="#">Another action</a></li>
                                <li><a href="#">Something else here</a></li>
                                <li class="divider"></li>
                                <li class="dropdown-header">Nav header</li>
                                <li><a href="#">Separated link</a></li>
                                <li><a href="#">One more separated link</a></li>
                            </ul>
                        </li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="./"><img src="images/1373555776_facebook.png" style="width:20px"/></a></li>
                        <li><a href="../navbar-static-top/"><img src="images/1373555806_twitter.png" style="width:20px" /></a></li>
                    </ul>
                </div><!--/.nav-collapse -->
            </div><!--/.container-fluid -->
        </div>

        <div class="row carousel-holder">

            <div class="col-md-12">
                <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                        <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                        <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                    </ol>

                    <div class="carousel-inner">
                        <?php
                        if ($site_det->BANNERS != '') {
                            $path = 'uploads/' . $ses_det['site_user_id'] . '/';
                            $full_path = $path . 'banner/';

                            $imgArr = explode(';', $site_det->BANNERS);
                            $count = 0;
                            foreach ($imgArr as $img) {
                                ?>
                                <div class="item <?php echo ($count == 0 ? 'active' : ''); ?>">
                                    <img class="slide-image" src="<?php echo $full_path . $img; ?>" alt="">
                                </div>
                                <?php
                                $count++;
                            }
                        } else {
                            ?>
                            <div class="item active">
                                <img class="slide-image" src="images/800x300.gif" alt="">
                            </div>
                            <div class="item">
                                <img class="slide-image" src="images/800x300.gif" alt="">
                            </div>
                            <div class="item">
                                <img class="slide-image" src="images/800x300.gif" alt="">
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                    <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left"></span>
                    </a>
                    <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right"></span>
                    </a>
                </div>
            </div>

        </div>

        



        

    </div>

</div>
<!-- /.container -->