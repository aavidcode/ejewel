<div class="signinpanel" style="margin:5% auto;">

    <div class="row">

        <div class="col-md-7">

            <div class="signin-info">

                <h5><strong>Welcome to e-commerce Jwella!</strong></h5>
                <!--<ul>
                    <li><i class="fa fa-arrow-circle-o-right mr5"></i> Fully Responsive Layout</li>
                    <li><i class="fa fa-arrow-circle-o-right mr5"></i> HTML5/CSS3 Valid</li>
                    <li><i class="fa fa-arrow-circle-o-right mr5"></i> Retina Ready</li>
                    <li><i class="fa fa-arrow-circle-o-right mr5"></i> WYSIWYG CKEditor</li>
                    <li><i class="fa fa-arrow-circle-o-right mr5"></i> and much more...</li>
                </ul>-->

            </div><!-- signin0-info -->

        </div><!-- col-sm-7 -->

        <div class="col-md-5">
            <?php echo form_open('', array('id' => 'loginForm', 'role' => 'form', 'autocomplete' => 'off')); ?>
            <h4 class="nomargin">Sign In</h4>
            <p class="mt5 mb20">Login to access your account.</p>
            <div id="form_errors"></div>
            <input type="text" class="form-control required uname" id="user_name" name="email_id" placeholder="Username">
            <input type="password" class="form-control required pword" id="inputPassword3" name="pass_word" placeholder="Password">
            <a href="" data-toggle="modal" data-target=".bs-example-modal-sm"><small>Forgot Your Password?</small></a>
            <input type="hidden" name="user_id" value="<?php echo $user_id; ?>" />
            <button type="submit" class="btn btn-primary ladda-button btn-block" id="p_login_submit" data-style="expand-left"><span class="ladda-label">Sign In</span></button>
            <?php echo form_close(); ?>
        </div><!-- col-sm-5 -->
    </div><!-- row -->
</div><!-- signin -->
<form id="forgotPasForm" name="forgetpassword" action="#" method="post">
    <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div id="form_errors"></div>
                <div class="modal-header">
                    <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                    <h4 class="modal-title">Forget Password</h4>
                </div>
                <div id="message"></div>
                <div class="modal-body">
                    <input type="text" class="form-control required" id="email_id" name="email_id" placeholder="Email"><br/>
                    <a  id="submit" class="btn btn-primary ladda-button btn-block" id="p_forget_submit" data-style="expand-left"><span class="ladda-label">Submit</span></a>
                </div>
            </div>
        </div>
    </div>
</form>
<script type="text/javascript">
    $(document).ready(function(e) {

        $("#loginForm").validate({
            submitHandler: ajaxLoginCall
        });
    });

    $('#submit').on('click', function(e) {
        e.preventDefault();
        var val = $('#email_id').val();
        if (val !== '') {
            $.ajax({
                type: 'POST',
                url: 'admin/forget_pwd',
                data: {email_id: $('#email_id').val()},
                success: function(data) {
                    if (data == 'ok') {
                        alert('Password has sent to your email provided')
                    } else {
                        alert(data);
                    }
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    alert(errorThrown);
                }
            });
        } else {
            alert('Please Enter Valid Email-id');
        }

    });

    function ajaxLoginCall() {
        ajaxSubmitForm('#loginForm', 'p_login', false);
    }

</script>
