
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <base href="<?php echo base_url(); ?>" />

        <title><?php echo $web_title; ?></title>

        <!-- Bootstrap Core CSS -->
        <link href="http://netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet" type="text/css">

        <!-- Fonts -->
        <link href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <link href='http://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>

        <!-- Custom Theme CSS -->
        <link href="css/home.css" rel="stylesheet">

    </head>

    <body id="page-top" data-spy="scroll" data-target=".navbar-custom">

        <nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
            <div class="container">
                <div class="navbar-header page-scroll">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">
                        <i class="fa fa-bars"></i>
                    </button>
                    <a class="navbar-brand" href="#page-top">
                        <i class="fa fa-play-circle"></i>  <?php echo $web_title; ?>
                    </a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
                    <ul class="nav navbar-nav">
                        <!-- Hidden li included to remove active class from about link when scrolled up past about section -->
                        <li class="hidden">
                            <a href="#page-top"></a>
                        </li>
                        <li class="page-scroll">
                            <a href="main/register"><i class="fa fa-user"></i> Register</a>
                        </li>
                    </ul>
                </div>
                <!-- /.navbar-collapse -->
            </div>
            <!-- /.container -->
        </nav>

        <section class="intro">
            <div class="intro-body">
                <div class="container">
<!--                    <div class="col12 signup-wrapper">
                        <noscript>&lt;div style="clear:both"&gt;&lt;div class="noscript-3field"&gt;Your web browser appears to have Javascript disabled. Please try Shopify on a browser that supports Javascript.&lt;/div&gt;&lt;/div&gt;</noscript>
                        <div id="signup" class="p30 inline-threefield">
                            <form action="https://app.shopify.com/services/signup/setup" method="POST" class="threefield">



                                <div class="field-container store-name">
                                    <input class="field-signup placeholder store-name signup-field__store-name" type="text" name="signup[shop_name]" value="" data-validate-store-name="true" data-validate-minlength="4" placeholder="Your store name" id="signup[shop_name]">
                                    <div class="tooltip validate-store-name">Please enter a store name<div class="tooltip-arrow"></div></div>
                                    <div class="tooltip validate-minlength">Your store name must be at least 4 characters<div class="tooltip-arrow"></div></div>
                                    <div class="tooltip validate-domain">A store with that name already exists, if you are the owner you can <a class="existing-shop-link" href="#" target="admin" tabindex="-1" style="pointer-events: auto">log in</a> here.<div class="tooltip-arrow"></div>
                                    </div>

                                    <div class="tooltip start-now">Start your free <br class="break-line">14-day trial today!<small>(you can change your <br class="break-line">store name afterwards)</small><div class="tooltip-arrow"></div></div>

                                </div>
                                <div class="field-container user">
                                    <input class="field-signup placeholder user signup-field__email" type="email" name="signup[email]" value="" data-validate-email="true" x-autocompletetype="email" placeholder="Email address">
                                    <div class="tooltip validate-email">Please enter a valid email address<div class="tooltip-arrow"></div></div>
                                    <div class="tooltip validate-mailcheck">Did you mean <span></span>?<div class="tooltip-arrow"></div></div>
                                </div>
                                <div class="field-container pass">
                                    <input class="field-signup placeholder pass signup-field__pass" type="password" name="signup[password]" value="" data-validate-minlength="5" data-validate-password="true" placeholder="Password">
                                    <div class="tooltip validate-minlength">Password must be at<br> least 5 characters<div class="tooltip-arrow"></div></div>
                                    <div class="tooltip validate-password">Password cannot contain spaces<div class="tooltip-arrow"></div></div>
                                </div>


                                <input class="button button-primary signup-modal btn-3-field-submit" type="submit" value="Try Shopify Free">




                                <label id="choose-subdomain" class="more-signup-options" for="signup[shop_name]"></label>

                                <div style="clear:both;"></div>

                                <input type="hidden" name="forwarded_host" value="www.shopify.com">
                                <input type="hidden" name="ssid" value="">
                                <input type="hidden" name="ref" value="">


                                <input type="hidden" name="source" value="">
                                <input type="hidden" name="signup_code" value="">


                                <input type="hidden" name="_y" value="7137891C-262F-469E-9C6A">
                                <input type="hidden" name="language" value="en">
                                <input type="hidden" name="country" value="com">






                            </form>

                        </div>

                        <p class="login-message tc">Already have an account? <strong><a href="/login">Log in here</a></strong></p>

                    </div>-->
                </div>
            </div>
        </section>


        <!-- Core JavaScript Files -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script src="http://netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>


    </body>

</html>
