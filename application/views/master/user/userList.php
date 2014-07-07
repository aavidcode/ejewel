<script type="text/javascript" src="js/countries2.js"></script>

<script type='text/javascript'>
    $(function() {
        $('#userType').on('change', function() {
            var value = $(this).val();
            var url = window.location.href;
            params = url.split('/');
            var newUrl =  params[0]+"/"+params[1]+"/"+params[2]+"/"+params[3]+"/"+params[4]+"/"+params[5]+"/"+value;
            //console.log(newUrl);
            window.location.href = newUrl; // Finished, let's go!
        });
    });
</script>
<div class="contentpanel">
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading"><?php if($userRole == 2){echo "Manufacturers Users";} else if($userRole == 3){echo"Jewellers Users";} else{echo "All User List";} ?> List</div>
            <div class="col-sm-2">
                <select class="form-control input-sm mb15" id="userType">
                    <option value="2">All Users</option>
                    <option value="2" <?php if ($userRole == 2) echo 'selected'; ?>>Manufacturers Users</option>
                    <option value="3" <?php if ($userRole == 3) echo 'selected'; ?>>Jewellers Users</option>
                </select>
            </div>
            <?php
                if(sizeof($userArr) == 0) {
                    echo '<table class="center bold"><tr><td>No records found</td></tr></table>';
                }else{
            ?>
            <div class="panel-body">
                <table class="table table-success">
                    <thead>
                        <form name="searchForm" id="searchoFrm" action="master/searchUser/0" method="post">
                            <tr>
                                <th colspan="6">
                                    Search Options
                                </th>
                            </tr>
                            <tr>
                                <td>
                                    <div class="form-group">
                                        <input type="text" name="name" placeholder="Enter Name" id="exampleInputEmail2" class="form-control">
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <input type="text" name="company_name" placeholder="Enter Company Name" id="exampleInputEmail2" class="form-control">
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <input type="text" name="city" placeholder="Enter City" id="exampleInputEmail2" class="form-control">
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <select data-placeholder="Choose a State" name="state" id="stateSelect" class="chosen-select form-control required" name='state'>
                                        </select>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="form-group">
                                        <label>MEM GJEPC No</label>
                                        <select class="form-control" name="mem_gjepc_no">
                                            <option value=""></option>
                                            <option value="Y">Yes</option>
                                            <option value="N">No</option>
                                        </select>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <label>MEN GJF No</label>
                                        <select class="form-control" name="men_gjf_no">
                                            <option value=""></option>
                                            <option value="Y">Yes</option>
                                            <option value="N">No</option>
                                        </select>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <label>MEM LOC ASSO Name</label>
                                        <select class="form-control valid" name="mem_loc_ass_name">
                                            <option value=""></option>
                                            <option value="Y">Yes</option>
                                            <option value="N">No</option>
                                        </select>
                                    </div>
                                </td>
                                <td>
                                    <button class="btn btn-primary" type="submit" style="margin-top:25px;">Search</button>
                                </td>
                            </tr>
                        </form>
                        <tr>
                            <th></th>
                            <th>Name</th>
                            <th>Company Name</th>
                            <th>EMail Id</th>
                            <th>Mobile</th>
                            <th>City</th>
                        </tr>
                    </thead>
                    <?php echo form_open('', array('role' => 'form', 'autocomplete' => 'off')); ?>
                    <tbody>
                        <?php
                        foreach ($userArr as $user) {
                            $userId = $user->USER_ID;
                            echo '<tr>';
                            echo '<td><a href="javascript:;" class="accordion" data-id="' . $user->USER_ID . '"><i class="fa fa-plus-square-o" style="font-size:16px;"></i></a></td>';
                            echo '<td>' . ($user->FIRST_NAME . ' ' . $user->LAST_NAME) . '</td>';
                            echo '<td>' . $user->COMP_NAME . '</td>';
                            echo '<td>' . $user->EMAIL_ID . '</td>';
                            echo '<td>' . $user->MOBILE . '</td>';
                            echo '<td>' . $user->CITY . '</td>';
                            echo '</tr>';
                            echo '<tr id="inner_dets_' .$userId. '" class="hide">';
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
                                            <th>MEN GJF No</th>
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
                                            <td><?php echo $user->MEN_GJF_NO; ?></td>
                                            <td><?php echo $user->MEM_LOC_ASS_NAME; ?></td>
                                            <td><?php echo $user->MEM_LOC_ASS_CITY; ?></td>
                                        </tr>
                                    </thead>
                                </table>
                            </td>
                            </tr>
                            <?php }?>
                    </tbody>
                    <?php
                    form_close();
                    ?>
                </table>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
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
    });

</script>