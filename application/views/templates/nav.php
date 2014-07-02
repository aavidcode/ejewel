<?php
$header_title = (isset($site_det) && $site_det->HEADER_NAME) ? $site_det->HEADER_NAME : $web_title;
$logo = (isset($site_det) && $site_det->LOGO ? $site_det->LOGO : '');
?>
<nav class="navbar navbar-fixed-top startbootstrap-nav" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            
            <a class="navbar-brand" href="user/home/<?php echo $site_user_name; ?>">
                <?php 
                if ($logo != '') {
                    echo '<img src="'.$logo.'" class="logo"/>';
                }
                ?>
                <?php echo $header_title; ?>
            </a>
        </div>




        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">


            <ul class="nav navbar-nav navbar-right">
                <?php
                if (!isset($hide_menu)) {
                    if (!isset($ses_det['user_id'])) {
                        echo '<li><a class="hidden-sm" href="user/login"><i class="small fa fa-user"></i> Login</a></li>';
                    } else {
                        ?>

                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $ses_det['user_data']['first_name']; ?> <i class="fa fa-caret-down"></i></a>
                            <ul class="dropdown-menu">
                                <li><a href="admin/dashboard"><i class="fa fa-user fa-fw"></i> Dashboard</a></li>
                                <li><a href="user/per_det"><i class="fa fa-user fa-fw"></i> My Account</a></li>
                                <li><a href="user/change_pwd"><i class="fa fa-lock fa-fw"></i> Change Password</a></li>
                                <li><a href="user/settings"><i class="fa fa-gear fa-fw"></i> Settings</a></li>
                                <li class="divider"></li>
                                <li><a href="user/logout"><i class="fa fa-sign-out fa-fw"></i> Logout</a></li>
                            </ul>
                        </li>   
                        <?php
                    }
                }
                ?>

            </ul>

            <?php if (!isset($hide_menu)) { ?>
            <div class="col-sm-5 col-md-5 navbar-right">
                <div class="navbar-form">
                    <div class="input-group">
                        <div class="input-group-btn">
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">Search <span class="caret"></span></button>
                            <ul class="dropdown-menu">
                                <li><a href="#">Manufacturer</a></li>
                                <li><a href="#">Jeweller</a></li>
                                <li class="divider"></li>
                                <li><a href="#">Product</a></li>
                            </ul>

                        </div><!-- /btn-group -->
                        <input type="text" class="form-control" id="search_typeahead" placeholder="Search Product"/>
                        <div class="input-group-btn">
                            <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                        </div>
                    </div><!-- /input-group -->
                </div>
            </div><!-- /.col-lg-6 -->
            <?php } ?>
        </div><!-- /.navbar-collapse -->



    </div><!-- /.container -->
</nav>