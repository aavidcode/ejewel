
<div class="signinpanel" style="margin:5% auto;">

    <div class="row">

        <div class="col-md-7">

            <div class="signin-info">

                <h5><strong>Welcome to e-commerce Jwella!</strong></h5>
                <ul>
                    <li><i class="fa fa-arrow-circle-o-right mr5"></i> Fully Responsive Layout</li>
                    <li><i class="fa fa-arrow-circle-o-right mr5"></i> HTML5/CSS3 Valid</li>
                    <li><i class="fa fa-arrow-circle-o-right mr5"></i> Retina Ready</li>
                    <li><i class="fa fa-arrow-circle-o-right mr5"></i> WYSIWYG CKEditor</li>
                    <li><i class="fa fa-arrow-circle-o-right mr5"></i> and much more...</li>
                </ul>

            </div><!-- signin0-info -->

        </div><!-- col-sm-7 -->

        <div class="col-md-5">

            <?php echo form_open('', array('id' => 'loginForm', 'role' => 'form', 'autocomplete' => 'off')); ?>
            <h4 class="nomargin">Sign In</h4>
            <p class="mt5 mb20">Login to access your account.</p>

            <input type="text" class="form-control required uname" id="user_name" name="email_id" placeholder="Username">
            <input type="password" class="form-control required pword" id="inputPassword3" name="pass_word" placeholder="Password">
            <a href=""><small>Forgot Your Password?</small></a>
            <input type="hidden" name="user_id" value="<?php echo $user_id; ?>" />
            <button type="submit" class="btn btn-primary ladda-button btn-block" id="p_login_submit" data-style="expand-left"><span class="ladda-label">Sign In</span></button>

            </form>
        </div><!-- col-sm-5 -->

    </div><!-- row -->



</div><!-- signin -->

<script type="text/javascript">
    $(document).ready(function(e) {

        $("#loginForm").validate({
            submitHandler: ajaxLoginCall
        });
    });

    function ajaxLoginCall() {
        ajaxSubmitForm('#loginForm', 'p_login', false);
    }

</script>
