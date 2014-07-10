
<div class="container-fluid sliderback">
    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel"> 
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
            <li data-target="#carousel-example-generic" data-slide-to="1"></li>
            <li data-target="#carousel-example-generic" data-slide-to="2"></li>
            <li data-target="#carousel-example-generic" data-slide-to="3"></li>
        </ol>

        <!-- Wrapper for slides -->
        <div class="carousel-inner">
            <div class="item active"> <img src="images/temp/slide1.png" alt="...">
                <div class="carousel-caption"> </div>
            </div>
            <div class="item"> <img src="images/temp/slide2.png" alt="...">
                <div class="carousel-caption"> </div>
            </div>
            <div class="item"> <img src="images/temp/slide3.png" alt="...">
                <div class="carousel-caption"> </div>
            </div>
            <div class="item"> <img src="images/temp/slide4.png" alt="...">
                <div class="carousel-caption"> </div>
            </div>
        </div>
        <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left"></span> </a> 
        <a class="right carousel-control" href="#carousel-example-generic" data-slide="next"> <span class="glyphicon glyphicon-chevron-right"></span> </a> 
    </div>
</div>

<div class="container">
    <div class="row clearfix">
        <div class="col-md-3 column">
            <ul class="nav nav-pills nav-stacked">
                <li class="active"><a href="categories.html"><span class="glyphicon glyphicon-chevron-right"></span> Home</a></li>
                <li><a href="categories.html"><span class="glyphicon glyphicon-chevron-right"></span> Catergory 1</a></li>
                <li><a href="categories.html" class="active2"><span class="glyphicon glyphicon-chevron-right"></span> Catergory 2</a></li>
                <li><a href="categories.html"><span class="glyphicon glyphicon-chevron-right"></span> Catergory 3</a></li>

                <li class="submenu"><a href="categories.html"><span class="glyphicon glyphicon-plus"></span> Sub Catergory </a><a href="categories.html"><span class="glyphicon glyphicon-plus"></span> Sub Catergory </a><a href="categories.html"><span class="glyphicon glyphicon-plus"></span> Sub Catergory</a></li>
                <li><a href="categories.html"><span class="glyphicon glyphicon-chevron-right"></span> Catergory 4</a></li>
                <li><a href="categories.html"><span class="glyphicon glyphicon-chevron-right"></span> Catergory 5</a> </li>
            </ul>



            <div class="feature">	
                <img src="images/temp/world.png" class="img-responsive" alt="" />
                <h4>WORLDWIDE <strong>DELIVERY</strong></h4>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>									
            </div><div class="feature">	
                <img src="images/temp/fast.png" class="img-responsive" alt="" />
                <h4>FAST <strong>SERVICE</strong></h4>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>									
            </div>

        </div>
        <div class="col-md-9 column">
            <?php
            if (sizeof($products) == 0) {
                echo '<div class="col-md-8 mb20"><h4>No Products Available</h4></div>';
            } else {
                foreach ($products as $prod) {
                    ?>
                    <div class="col-md-4 column productbox"> <img src="uploads/<?php echo ($site_user_id.'/'.$prod->PROD_ID.'/'.$prod->PROD_DEF_THUMB)?>" class="img-responsive" alt="Product Image">
                        <div class="producttitle"><?php echo $prod->PROD_NAME; ?></div>
                        <div class="productprice">
                            <div class="pull-right"><a href="product.html" class="btn btn-danger btn-sm" role="button"><span class="glyphicon glyphicon-shopping-cart"></span> Request</a></div>
                            <div class="pricetext">Rs. <?php echo number_format($prod->MF_TOTAL_PRICE, 2); ?></div>
                        </div>
                    </div>
                    <?php
                }
            }
            ?>


            <div class="row">
                <div class="col-md-12 p_0">
                    <div class="col-md-8 column productbox">
                        <h1>Welcome</h1>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque mattis tortor arcu, quis molestie tortor dictum et. Etiam rhoncus in nibh sed lobortis. Aliquam euismod ligula turpis, nec auctor eros lacinia vitae.<br>
                        <br>
                        Curabitur aliquam, quam a feugiat gravida, tortor risus pulvinar velit, ut faucibus lectus ligula eget magna. Vivamus et nisi at urna condimentum vehicula non eget nibh. Phasellus ut viverra nunc, sed pellentesque massa. Nulla consectetur lobortis iaculis. Mauris luctus dolor libero, eu iaculis dolor tempus id. In hac habitasse platea dictumst. Quisque fermentum odio ut urna gravida cursus. <br>
                        <br>
                        Cras rutrum, nisl nec pharetra rutrum, erat enim rutrum metus, varius commodo sapien eros mattis dolor. Vestibulum suscipit nunc eu metus auctor dignissim. Cras a purus consequat, porta nunc sed, viverra nibh. Aliquam erat volutpat. </div>
                    <div class="col-md-4 column productbox">
                        <h1>News</h1>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque mattis tortor arcu, quis molestie tortor dictum et. Etiam rhoncus in nibh sed lobortis. Aliquam euismod ligula turpis, nec auctor eros lacinia vitae.<br>
                        <br>
                        Curabitur aliquam, quam a feugiat gravida, tortor risus pulvinar velit, ut faucibus lectus ligula eget magna. Vivamus et nisi at urna condimentum vehicula non eget nibh. Phasellus ut viverra nunc. </div>
                </div>
            </div>
        </div>
    </div>
</div>
