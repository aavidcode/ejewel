<script type='text/javascript'>
    $(function() {
        $('#userType').on('change', function() {
            var value = $(this).val();
            var url = window.location.href;
            params = url.split('/');
            var newUrl =  params[0]+"/"+params[1]+"/"+params[2]+"/"+params[3]+"/"+params[4]+"/"+params[5]+"/"+value+"/"+params[7];
            //console.log(newUrl);
            window.location.href = newUrl; // Finished, let's go!
        });
    });
</script>
<div class="contentpanel">
    <div class="row">
        <?php echo form_open('', array('role' => 'form', 'autocomplete' => 'off')); ?>
        <div class="panel panel-default">
            <div class="panel-heading">List of <?php echo ($status ? "Activate" : "Deactivate"); ?> <?php if ($userRole == 2) {
            echo "Manufacturers";
        } elseif ($userRole == 3) {
            echo"Jewellers";
        } else {
            echo "Users";
        } ?>
            </div>
            <div style="padding-right: 10px; padding-top:10px;">
                <div class="col-sm-2">
                    <select class="form-control input-sm mb15" id="userType">
                        <option value="2">All Users</option>
                        <option value="2" <?php if ($userRole == 2) echo 'selected'; ?>>Manufacturers Users</option>
                        <option value="3" <?php if ($userRole == 3) echo 'selected'; ?>>Jewellers Users</option>
                    </select>
                </div>
                <div class="t_right"><a class="btn btn-info" href="master/approval/<?php echo $userRole; ?>/<?php echo $status ? 0 : 1; ?>">List of <?php echo (!$status ? "Activated" : " Deactivated"); ?> Users</a></div>
            </div>
<?php
if (sizeof($userArr) == 0) {
    echo '<table class="center bold"><tr><td>No records found</td></tr></table>';
} else {
    ?>
                <div class="panel-body">
                    <table class="table table-success">
                        <thead>
                            <tr>
                                <th><input type="checkbox" name="selectAll" id="selecctall"/></th>
                                <th></th>
                                <th>Name</th>
                                <th>Company Name</th>
                                <th>EMail Id</th>
                                <th>Mobile</th>
                                <th>City</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($userArr as $user) {
                                $userId = $user->USER_ID;
                                echo '<tr>';
                                echo '<td><input type="checkbox" name="users[]" value="' . $userId . '" class="checkbox1" /></td>';
                                echo '<td><a href="javascript:;" class="accordion" data-id="' . $user->USER_ID . '"><i class="fa fa-plus-square-o" style="font-size:16px;"></i></a></td>';
                                echo '<td>' . ($user->FIRST_NAME . ' ' . $user->LAST_NAME) . '</td>';
                                echo '<td>' . $user->COMP_NAME . '</td>';
                                echo '<td>' . $user->EMAIL_ID . '</td>';
                                echo '<td>' . $user->MOBILE . '</td>';
                                echo '<td>' . $user->CITY . '</td>';
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
                            </tbody>
        <?php
    }
    ?>
                    </table>

                </div>
            </div>
            <div class="t_center">
                <button type="submit" class="btn btn-danger"><?php echo ($status ? "Disappove" : "Approve"); ?></button>
            </div>
<?php }form_close(); ?>
    </div>
</div>
<script type="text/javascript">

    $(document).ready(function() {
        //select All checkbox
        $('#selecctall').click(function(event) {  //on click
            if (this.checked) { // check select status
                $('.checkbox1').each(function() { //loop through each checkbox
                    this.checked = true;  //select all checkboxes with class "checkbox1"              
                });
            } else {
                $('.checkbox1').each(function() { //loop through each checkbox
                    this.checked = false; //deselect all checkboxes with class "checkbox1"                      
                });
            }
        });
        //onClick on plus button for more info
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
    });

</script>