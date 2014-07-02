<div class="container" style="margin-top: 30px;">

    <div class="row">


        <div class="panel panel-default" id="login_form">
            <div class="panel-heading">Secure Login</div>
            <div class="panel-body">
                <div id="form_errors"></div>
                <?php echo form_open('', array('id' => 'loginForm', 'role' => 'form', 'autocomplete' => 'off')); ?>

                <div class="form-group">
                    <label for="user_name">UserName / Email Address</label>
                    <input type="text" class="form-control required" id="user_name" name="user_name" placeholder="UserName">

                </div>
                <div class="form-group">
                    <label for="inputPassword3">Password</label>
                    <input type="password" class="form-control required" id="inputPassword3" name="pass_word" placeholder="Password">

                </div>

                <div class="form-group t_center">
                    <button type="submit" class="btn btn-danger ladda-button" id="p_login_submit" data-style="expand-left"><span class="ladda-label">Sign In</span></button>
                </div>
                </form>
            </div>
        </div>

    </div>
</div>