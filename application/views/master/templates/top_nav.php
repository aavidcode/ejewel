

            <div class="mainpanel">

                <div class="headerbar">

                    <a class="menutoggle"><i class="fa fa-bars"></i></a>

                    <!--<form class="searchform" action="index.html" method="post">
                        <input type="text" class="form-control" name="keyword" placeholder="Search here..." />
                    </form>-->

                    <div class="header-right">
                        <ul class="headermenu">
                            
                            
                            <li>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                        <img src="images/loggeduser.png" alt="" />
                                        <?php echo $ses_det['user_data']['first_name']; ?>
                                        <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-usermenu pull-right">
                                        <!--<li><a href="user/per_det"><i class="glyphicon glyphicon-user"></i> My Profile</a></li>
                                        <li><a href="user/settings"><i class="glyphicon glyphicon-cog"></i> Account Settings</a></li>-->
                                        <li><a href="master/logout"><i class="glyphicon glyphicon-log-out"></i> Log Out</a></li>
                                    </ul>
                                </div>
                            </li>
<!--                            <li>
                                <button id="chatview" class="btn btn-default tp-icon chat-icon">
                                    <i class="glyphicon glyphicon-comment"></i>
                                </button>
                            </li>-->
                        </ul>
                    </div><!-- header-right -->

                </div><!-- headerbar -->