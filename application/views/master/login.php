<section>
    <div class="center" style="width:30%; margin: 160px auto;">
        <div class="">
            <div class="panel panel-default" id="login_form">
                <div class="panel-heading">Administrator Login</div>
                <div class="panel-body">
                    <div id="form_errors"></div>
                    <?php echo form_open('', array('id' => 'loginForm', 'role' => 'form', 'autocomplete' => 'off')); ?>
                        <div class="form-group">
                            <label for="user_name">UserName</label>
                            <input type="text" class="form-control uname required" id="user_name" name="email_id" placeholder="UserName">
                        </div>
                        <div class="form-group">
                            <label for="inputPassword3">Password</label>
                            <input type="password" class="form-control pword required" id="inputPassword3" name="pass_word" placeholder="Password">
                        </div>
                        <div class="form-group t_center">
                            <input type="hidden" name="user_id" value="1" />
                            <button type="submit" class="btn btn-danger ladda-button" id="p_login_submit" data-style="expand-left"><span class="ladda-label">Sign In</span></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
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