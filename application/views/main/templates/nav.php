<?php 
$header_title = ''; //(isset($site_det) && $site_det->HEADER_NAME) ? $site_det->HEADER_NAME : $web_title;
$logo = ''; //(isset($site_det) && $site_det->LOGO ? $site_det->LOGO : '');
?>


<div class="container">
    <div class="row clearfix">
        <div class="col-md-4 column"> <a href="index.html"><img src="images/temp/uglogo.png" class="img-responsive" id="logo" alt=""></a> </div>
        <div class="col-md-8 column">
            <div class="account">
                <?php if (!isset($hide_login)) { ?>
                    <a href="main/login/" class="btn-primary topbasketbutton"><span class="glyphicon glyphicon-pencil"></span> Login</a>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid darkgreen" >
    <div class="container" >
        <div class="row clearfix">
            <div class="col-md-12 column" >
                <?php if (!isset($top_menu)) { ?>
                    <nav class="navbar navbar-default" role="navigation">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse"
                                    data-target="#bs-example-navbar-collapse-1"><span
                                    class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span
                                    class="icon-bar"></span><span class="icon-bar"></span></button>
                        </div>
                        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                            <div class="col-md-9 column">
                                <ul class="nav navbar-nav">
                                    <li> <a href="index.html">HOME</a> </li>
                                    <li> <a href="typography.html">ABOUT US</a> </li>
                                    <li> <a href="productlist.html">PRODUCTS</a> </li>
                                    <li> <a href="typography.html">TYPOGRAPHY</a> </li>
                                    <li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown">DROPDOWN <b class="caret"></b></a>
                                        <ul class="dropdown-menu">
                                            <li><a href="#">Action</a></li>
                                            <li><a href="#">Another action</a></li>
                                            <li><a href="#">Something else here</a></li>
                                            <li class="divider"></li>
                                            <li><a href="#">Separated link</a></li>
                                            <li class="divider"></li>
                                            <li><a href="#">One more separated link</a></li>
                                        </ul>
                                    </li>
                                    <li> <a href="#">CONTACT US</a> </li>
                                </ul>
                            </div>
                            <div class="col-md-3 column">
                                <form class="navbar-form" role="search">
                                    <div class="input-group">
                                        <input type="text" class="form-control nav-search-box" placeholder="Search" name="q" style="padding:7px;">
                                        <div class="input-group-btn">
                                            <button class="btnsearch btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </nav>
                <?php } ?>
            </div>
        </div>
    </div>
</div>