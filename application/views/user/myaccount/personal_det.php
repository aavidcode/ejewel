<div class="container">
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading">My Account Settings</div>
            <div class="panel-body">
                <?php echo form_open('', array('class' => 'form-horizontal', 'id' => 'updateUserForm', 'role' => 'form', 'autocomplete' => 'off')); ?>
                <p class="bg-info header">Personal Details</p>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-3 control-label">Full Name : </label>
                    <div class="row">
                        <div class="col-sm-3">
                            <input type="text" name="first_name" class="form-control" value="<?php echo $site_det->FIRST_NAME ; ?>">
                        </div>
                        <div class="col-sm-3">
                            <input type="text" name="last_name" class="form-control" value="<?php echo $site_det->LAST_NAME ; ?>">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-3 control-label">Email Address : </label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control required email" name="email_id" value="<?php echo $site_det->EMAIL_ID ; ?>"/>
                    </div>
                </div>


                <p class="bg-info header">Communication Details</p>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-3 control-label">Mobile : </label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control required" name="mobile" value="<?php echo $site_det->MOBILE ; ?>" onkeypress="return numbersonly(this, false);" />
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-3 control-label">Telephone : </label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control required" name="telephone" value="<?php echo $site_det->TELEPHONE ; ?>" onkeypress="return numbersonly(this, false);" />
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-3 control-label">Address : </label>
                    <div class="col-sm-3">
                        <textarea class="form-control required" name="address"><?php echo $site_det->ADDRESS ; ?></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-3 control-label">City : </label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control required" name="city" value="<?php echo $site_det->CITY ; ?>" />
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-3 control-label">State : </label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control required" name="state" value="<?php echo $site_det->STATE ; ?>" />
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-danger ladda-button" id="update_user_submit" data-style="expand-left"><span class="ladda-label">Update Details</span></button>
                    </div>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>