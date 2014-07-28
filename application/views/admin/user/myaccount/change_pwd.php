<div class="container">
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading">Change Password</div>
            <div class="panel-body">
                <div id="form_errors"></div>
                <?php echo form_open('', array('id' => 'changePwdForm', 'role' => 'form')); ?>
                <div class="row">
                    <div class="form-group col-lg-6">
                        <label for="code">New Password</label>
                        <input type="password" class="form-control required" name="pass_word" placeholder="Password" />
                    </div>
                </div><br/>
                <div class="row">
                    <div class="form-group col-lg-6">
                        <label for="code">Confirmation Password</label>
                        <input type="password" class="form-control required" name="conf_password" placeholder="Confirmation Password" />
                    </div>
                </div><br/>
                <div class="row">
                    <div class="form-group col-lg-6">
                        <button type="submit" class="btn btn-danger ladda-button" id="change_pwd_submit" data-style="expand-left"><span class="ladda-label">Change Password</span></button>
                    </div>
                </div>
                <?php echo form_close(); ?>

            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $("#changePwdForm").validate({
            rules: {
                pass_word: {
                    required: true, minlength: 6
                },
                conf_password: {
                    required: true, equalTo: "[name='pass_word']", minlength: 6
                }
            },
            debug: true,
            submitHandler: ajaxchangePwdCall
        });

    });

    function ajaxchangePwdCall() {
        ajaxSubmitForm('#changePwdForm', 'change_pwd', false);
    }
</script>