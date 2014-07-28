<script type="text/javascript" src="js/countries2.js"></script>

<script type='text/javascript'>
    $(function() {
        $('#userType').on('change', function() {
            var value = $(this).val();
            var url = window.location.href;
            params = url.split('/');
            var newUrl = params[0] + "/" + params[1] + "/" + params[2] + "/" + params[3] + "/" + params[4] + "/" + params[5] + "/" + value;
            //console.log(newUrl);
            window.location.href = newUrl; // Finished, let's go!
        });
    });
</script>



<div class="pageheader">
    <h2><i class="fa fa-search"></i> Search Results <span>Subtitle goes here...</span></h2>
</div>
<div class="contentpanel">

    <div class="row">
        <div class="col-sm-3 col-md-2">
            <form name="searchForm" id="searchoFrm" action="master/searchUserDetail/0" method="post">
                <h4 class="subtitle mb5">User Type</h4>
                <select class="form-control" id="userType">
                    <option value="2">All Users</option>
                    <option value="2" <?php if ($userRole == 2) echo 'selected'; ?>>Manufacturers Users</option>
                    <option value="3" <?php if ($userRole == 3) echo 'selected'; ?>>Jewellers Users</option>
                </select>

                <div class="mb20"></div>

                <input type="text" name="name" placeholder="Enter Name" id="exampleInputEmail2" class="form-control">
                <div class="mb20"></div>
                <input type="text" name="company_name" placeholder="Enter Company Name" id="exampleInputEmail2" class="form-control">
                <div class="mb20"></div>
                <input type="text" name="city" placeholder="Enter City" id="exampleInputEmail2" class="form-control">
                <div class="mb20"></div>
                <select data-placeholder="Choose a State" name="state" id="stateSelect" class="chosen-select form-control required" name='state'>
                </select>
                <div class="mb20"></div>

                <select class="form-control" name="mem_gjepc_no">
                    <option value="">Member GJEPC</option>
                    <option value="Y">Yes</option>
                    <option value="N">No</option>
                </select>
                <div class="mb20"></div>
                <select class="form-control" name="men_gjf_no">
                    <option value="">MEN GJF?</option>
                    <option value="Y">Yes</option>
                    <option value="N">No</option>
                </select>
                <div class="mb20"></div>
                <select class="form-control valid" name="mem_loc_ass_name">
                    <option value="">MEM LOC ASSO Name</option>
                    <option value="Y">Yes</option>
                    <option value="N">No</option>
                </select>
                <div class="mb20"></div>
                <button class="btn btn-primary" type="submit" style="margin-top:25px;">Search</button>
                <br>
            </form>
        </div><!-- col-sm-4 -->
        <div class="col-sm-9 col-md-10">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">Search results for "<?php
                        if ($userRole == 2) {
                            echo "Manufacturer Users";
                        } else if ($userRole == 3) {
                            echo"Jeweller Users";
                        } else {
                            echo "All User ";
                        }
                        ?> List"</h4>
                    <p>About <?php echo sizeof($userArr); ?> results (0.13 seconds)</p>
                </div><!-- panel-heading -->
                <div class="panel-body">


                    <div class="results-list">
                        <?php
                        if (sizeof($userArr) == 0) {
                            echo '<div class="alert alert-success" style="margin-top:20px;">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                        No Records Found.
                                      </div>';
                        } else {
                            ?>
                            <?php echo form_open('', array('role' => 'form', 'autocomplete' => 'off')); ?>
                            <table class="table table-success">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Name</th>
                                        <th>Company Name</th>
                                        <th>Email Id</th>
                                        <th>Mobile</th>
                                        <th>City</th>
                                        <th>Verified</th>
                                        <th>Activate</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                    foreach ($userArr as $user) {
                                        $userId = $user->USER_ID;
                                        if ($user->IS_VERIFIED) {
                                            $varified = '<span class="glyphicon glyphicon-ok"></span>';
                                        } else {
                                            $varified = '<span class="fa fa-minus"></span>';
                                        }
                                        if ($user->IS_ACTIVE) {
                                            $activated = '<span class="glyphicon glyphicon-ok"></span>';
                                        } else {
                                            $activated = '<span class="fa fa-minus"></span>';
                                        }
                                        echo '<tr>';
                                        echo '<td><a href="javascript:;" class="accordion" data-id="' . $user->USER_ID . '"><i class="fa fa-plus-square-o" style="font-size:16px;"></i></a></td>';
                                        echo '<td>' . ($user->FIRST_NAME . ' ' . $user->LAST_NAME) . '</td>';
                                        echo '<td>' . $user->COMP_NAME . '</td>';
                                        echo '<td>' . $user->EMAIL_ID . '</td>';
                                        echo '<td>' . $user->MOBILE . '</td>';
                                        echo '<td>' . $user->CITY . '</td>';
                                        echo '<td>' . $varified . '</td>';
                                        echo '<td>' . $activated . '</td>';
                                        echo '<td><a href="master/edit/' . $userId . '" class="fa fa-edit"/><a></td>';
                                        echo '</tr>';
                                        echo '<tr id="inner_dets_' . $userId . '" class="hide">';
                                        ?> 
                                    <td colspan="10">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th></th>
                                                    <th></th>
                                                    <th>Address</th>
                                                    <th>Pincode</th>
                                                    <th>State</th>
                                                    <th>Telephone</th>
                                                    <th>User Name</th>
                                                    <th>Website</th>
                                                    <th>MEM GJEPC No</th>
                                                    <th>MEM GJF No</th>
                                                    <th>MEM LOC ASS Name</th>
                                                    <th>MEM LOC ASS City</th>
                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td><?php echo $user->ADDRESS; ?></td>
                                                    <td><?php echo $user->PINCODE; ?></td>
                                                    <td><?php echo $user->STATE; ?></td>
                                                    <td><?php echo $user->TELEPHONE; ?></td>
                                                    <td><?php echo $user->USER_NAME; ?></td>
                                                    <td><?php echo $user->WEBSITE; ?></td>
                                                    <td><?php echo $user->MEM_GJEPC_NO; ?></td>
                                                    <td><?php echo $user->MEM_GJF_NO; ?></td>
                                                    <td><?php echo $user->MEM_LOC_ASS_NAME; ?></td>
                                                    <td><?php echo $user->MEM_LOC_ASS_CITY; ?></td>
                                                </tr>
                                            </thead>
                                        </table>
                                    </td>
                                    </tr>

                                <?php }
                                ?>
                                </tbody>
                            </table>
                            </form>
                        <?php }
                        ?>
                    </div>

                </div><!-- panel-body -->
            </div><!-- panel -->
        </div><!-- col-sm-8 -->
    </div><!-- row -->

</div>


<script type="text/javascript">
    $(document).ready(function() {
        $('.accordion').on('click', function(e) {
            e.preventDefault();
            var userId = $(this).data('id');
            if (!$('#inner_dets_' + userId).is(':visible')) {
                $(this).find('i').addClass('fa-minus-square-o');
                $(this).find('i').removeClass('fa-plus-square-o');
                $('#inner_dets_' + userId).removeClass('hide');
            } else {
                $(this).find('i').addClass('fa-plus-square-o');
                $(this).find('i').removeClass('fa-minus-square-o');
                $('#inner_dets_' + userId).addClass('hide');
            }
        });
        var country_index = 104;
        print_state('stateSelect', country_index);
        jQuery('.menutoggle').trigger('click');
    });

</script>