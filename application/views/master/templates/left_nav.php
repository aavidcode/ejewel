
        <section>

            <div class="leftpanel">

                <div class="logopanel">
                    <h1><span>[</span> <?php echo $web_title; ?> <span>]</span></h1>
                </div><!-- logopanel -->

                
                <?php if (!isset($hide_left_menu)) { ?>
                <div class="leftpanelinner">

                    <!-- This is only visible to small devices -->
                    <div class="visible-xs hidden-sm hidden-md hidden-lg">   
                        <div class="media userlogged">
                            <img alt="" src="images/loggeduser.png" class="media-object">
                            <div class="media-body">
                                <h4>John Doe</h4>
                                <span>"Life is so..."</span>
                            </div>
                        </div>

                        <h5 class="sidebartitle actitle">Account</h5>
                        <ul class="nav nav-pills nav-stacked nav-bracket mb30">
                            <li><a href="profile.html"><i class="fa fa-user"></i> <span>Profile</span></a></li>
                            <li><a href=""><i class="fa fa-cog"></i> <span>Account Settings</span></a></li>
                            <li><a href=""><i class="fa fa-question-circle"></i> <span>Help</span></a></li>
                            <li><a href="signout.html"><i class="fa fa-sign-out"></i> <span>Sign Out</span></a></li>
                        </ul>
                    </div>

                    <h5 class="sidebartitle">Navigation</h5>
                    <ul class="nav nav-pills nav-stacked nav-bracket">
                        <li><a href="admin/dashboard/"><i class="fa fa-home"></i> <span>Dashboard</span></a></li>
                        <li><a href="email.html"><i class="fa fa-envelope-o"></i> <span>Email</span></a></li>
                        <li class="nav-parent nav-active active"><a href=""><i class="fa fa-edit"></i> <span>Product</span></a>
                            <ul class="children" style="display: block;">
                                <li><a href="admin/products/"><i class="fa fa-caret-right"></i> View All</a></li>
                                <li><a href="admin/products/add"><i class="fa fa-caret-right"></i> Add Product</a></li>
                            </ul>
                        </li>
                        
                    </ul>

                   

                </div><!-- leftpanelinner -->
                <?php } ?>
            </div><!-- leftpanel -->