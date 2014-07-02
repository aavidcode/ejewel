<link href="css/ion.rangeSlider.css" rel="stylesheet" />
<link href="css/ion.rangeSlider.skinNice.css" rel="stylesheet" />
<script type="text/javascript" src="js/ion.rangeSlider.js"></script>
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
                    <a class="navbar-brand" href="#">Collections</a>
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

        <div class="col-md-3">
            <div class="panel-group" id="accordion">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                                Metal
                            </a><i class="indicator glyphicon glyphicon-chevron-down  pull-right"></i>
                        </h4>
                    </div>
                    <div id="collapseOne" class="panel-collapse collapse in">
                        <ul class="filter_block">
                            <?php
                            foreach ($category as $cat) {
                                echo '<li data-brand-id="2"><span>' . $cat->CAT_NAME . '</span></li>';
                            }
                            ?>
                        </ul>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                                Type
                            </a><i class="indicator glyphicon glyphicon-chevron-down  pull-right"></i>
                        </h4>
                    </div>
                    <div id="collapseTwo" class="panel-collapse collapse in">
                        <ul class="filter_block">
                            <?php
                            foreach ($prod_type as $pt) {
                                echo '<li data-brand-id="2"><span>' . $pt->PROD_TYPE_NAME . '</span></li>';
                            }
                            ?>
                        </ul>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                                Price   
                            </a><i class="indicator glyphicon glyphicon-chevron-down pull-right"></i>
                        </h4>
                    </div>
                    <div id="collapseThree" class="panel-collapse collapse in">
                        <div class="panel-body">
                            <input type="text" id="price" name="price" value="" />
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="col-md-9">



            <div class="row" id="grid_items">

                <script id="template-grid-item" type="text/x-handlebars-template">
                    <?php $this->load->view('product/prod_template'); ?>
                </script>

            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    productAjaxLoad('site');

    $(document).ready(function() {
        $(".filter_block").niceScroll();
        $("#price").ionRangeSlider({
            min: 0,
            max: 100000,
            type: 'double',
            prefix: "₹",
            maxPostfix: "+",
            prettify: false,
            hasGrid: true
        });
    });

    $('#myCollapsible').collapse({
        toggle: false
    });

</script>