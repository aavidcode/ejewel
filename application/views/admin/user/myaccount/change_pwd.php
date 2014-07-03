<div class="container">
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading">Change Password</div>
            <div class="panel-body">

                <?php echo form_open('', array('id' => 'changePwdForm', 'role' => 'form')); ?>
                <div class="row">
                    <div class="form-group col-lg-3">
                        <label for="code">New Password</label>
                        <input type="password" class="form-control required" name="pass_word" placeholder="Password" />
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-lg-3">
                        <label for="code">Confirmation Password</label>
                        <input type="password" class="form-control required" name="conf_password" placeholder="Confirmation Password" />
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-lg-3">
                        <button type="submit" class="btn btn-danger ladda-button" id="change_pwd_submit" data-style="expand-left"><span class="ladda-label">Change Password</span></button>
                    </div>
                </div>
                <?php echo form_close(); ?>

            </div>
        </div>
    </div>
</div>