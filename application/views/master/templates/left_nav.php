<div class="leftpanel">
        <div class="logopanel">
            <h1><span>[</span> <?php echo $web_title; ?> <span>]</span></h1>
        </div><!-- logopanel -->
        <?php if (!isset($hide_left_menu)) { ?>
            <div class="leftpanelinner">
                <h5 class="sidebartitle">Menu</h5>
                <ul class="nav nav-pills nav-stacked nav-bracket">
                    <li class="active"><a href="master/dashboard/"><i class="fa fa-home"></i> <span>Dashboard</span></a></li>
                    <li class="nav-parent"><a href=""><i class="fa fa-edit"></i> <span>Users</span></a>
                        <ul class="children" style="display: block;">
                            <li><a href="master/approval/0/0"><i class="fa fa-caret-right"></i>Active/Deactive Users</a>
                                <!--<ul class="children" style="display: block;">
                                    <li><a href="master/approval/0/2"><i class="fa fa-caret-right"></i>Manufacturers</a></li>
                                    <li><a href="master/approval/0/3"><i class="fa fa-caret-right"></i>Jewellers</a></li>
                                </ul>-->
                            </li>
                            <li><a href="master/listAll/0"><i class="fa fa-caret-right"></i>View All</a>
                                <!--<ul class="children" style="display: block;">
                                    <li><a href="master/listAll/2"><i class="fa fa-caret-right"></i>Manufacturers</a></li>
                                    <li><a href="master/listAll/3"><i class="fa fa-caret-right"></i>Jewellers</a></li>
                                </ul>-->
                            </li>
                        </ul>
                    </li>
                    <li class="nav-parent"><a href=""><i class="fa fa-file-text"></i> <span>Component</span></a>
                        <ul class="children" style="display: block;">
                            <li><a href="master/generalComponent/"><i class="fa fa-caret-right"></i>General</a></li>
                            <li><a href="master/metalComponent"><i class="fa fa-caret-right"></i>Metal</a></li>
                            <li><a href="master/diamondComponent"><i class="fa fa-caret-right"></i>Diamond</a></li>
                            <li><a href="master/coloredStoneComponent"><i class="fa fa-caret-right"></i>Colored Stone</a></li>
                        </ul>
                    </li>
                </ul>
            </div><!-- leftpanelinner -->
        <?php } ?>
    </div><!-- leftpanel -->
    