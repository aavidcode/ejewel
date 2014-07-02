<link href="css/jquery.realperson.css" rel="stylesheet" />
<script type="text/javascript" src="js/jquery.realperson.js"></script>
<script type="text/javascript" src="js/countries2.js"></script>
<script type="text/javascript" src="js/pwstrength.js"></script>

<style type="text/css">
    .progress {
        display: none;
    }
</style>

<div class="container">
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading">Registration</div>
            <div class="panel-body">
                <?php echo form_open('', array('class' => 'form-horizontal', 'id' => 'registerForm', 'role' => 'form', 'autocomplete' => 'off')); ?>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-3 control-label">Your Store Name <span class="m_f">*</span> : </label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control required" name="domain_name" placeholder="Your Store Name" />
                        <input type="hidden" name="domain_f_name" maxlength="20" />
                        <span id="domain_text" style="padding:10px; font-weight: bold;"></span>
                    </div>
                </div>

                <p class="bg-info header">Personal Details</p>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-3 control-label">Full Name <span class="m_f">*</span> : </label>
                    <div class="row">
                        <div class="col-sm-3">
                            <input type="text" maxlength="20" name="first_name" class="form-control required" placeholder="First Name">
                        </div>
                        <div class="col-sm-3">
                            <input type="text" maxlength="20" name="last_name" class="form-control required" placeholder="Last Name">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-3 control-label">Email Address <span class="m_f">*</span> : </label>
                    <div class="col-sm-3">
                        <input type="text" maxlength="30" class="form-control required email" name="email_id" placeholder="Email address"/>
                    </div>
                </div>

                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-3 control-label">Password <span class="m_f">*</span> : </label>
                    <div class="col-sm-3">
                        <input type="password" id="password" class="form-control required" name="pass_word" placeholder="Password" />
                    </div>
                </div>

                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-3 control-label">Confirmation Password <span class="m_f">*</span> : </label>
                    <div class="col-sm-3">
                        <input type="password" class="form-control required" name="conf_password" placeholder="Confirmation Password" />
                    </div>
                </div>

                <p class="bg-info header">Communication Details</p>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Company Name <span class="m_f">*</span> : </label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control required" name="comp_name" placeholder="Company Name"/>
                    </div>
                </div>

                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-3 control-label">Mobile <span class="m_f">*</span> : </label>
                    <div class="col-sm-3">
                        <span style="line-height: 30px;">+91</span><input type="text" style="float:right; display: inline-block; width:88%;" class="form-control required" name="mobile" placeholder="Mobile Number" maxlength="10" onkeypress="return numbersonly(this, false);"/>
                    </div>
                </div>

                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-3 control-label">Telephone : </label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" name="telephone" placeholder="Telephone Number" maxlength="10" onkeypress="return numbersonly(this, false);"/>
                    </div>
                </div>

                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-3 control-label">Address : </label>
                    <div class="col-sm-3">
                        <textarea class="form-control" name="address" maxlength="100"></textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-3 control-label">City : </label>
                    <div class="col-sm-3">
                        <input type="text" maxlength="30" class="form-control" name="city" placeholder="City" />
                    </div>
                </div>

                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-3 control-label">State <span class="m_f">*</span> : </label>
                    <div class="col-sm-3">
                        <select data-placeholder="Choose a State" id="stateSelect" class="chosen-select form-control required" name='state'>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-3 control-label">Country : </label>
                    <div class="col-sm-3">
                        <select id='countrySelect' class="chosen-select form-control" name='country'>
                            <option value="">-select-</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-3 control-label">Pin Code : </label>
                    <div class="col-sm-3">
                        <input type="text" maxlength="10" class="form-control" name="pincode" placeholder="Pin Code" onkeypress="return numbersonly(this, false);"/>
                    </div>
                </div>

                <p class="bg-info header">Other Details</p>

                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-3 control-label">Website : </label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" name="website" placeholder="http://www.example.com" />
                    </div>
                </div>

                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-3 control-label">Member of GJEPC <span class="m_f">*</span> : </label>

                    <div class="row">
                        <div class="col-sm-1">
                            <select class="form-control required" name="gjepc" onchange="showHideMemNo(this);">
                                <option value=""></option>
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                        </div>
                        <div class="col-sm-2">
                            <input type="text" name="gjepc_mem_no" style="display: none;" class="form-control" placeholder="Membership No:"/>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-3 control-label">Member of GJF <span class="m_f">*</span> : </label>

                    <div class="row">
                        <div class="col-sm-1">
                            <select class="form-control required" name="gjf" onchange="showHideMemNo(this);">
                                <option value=""></option>
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                        </div>
                        <div class="col-sm-2">
                            <input type="text" name="gjf_mem_no" style="display: none;" class="form-control" placeholder="Membership No:"/>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-3 control-label">Member of any other Local Association : </label>

                    <div class="row">
                        <div class="col-sm-1">
                            <select class="form-control" name="local_ass" onchange="showHideMemNo(this);">
                                <option value=""></option>
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                        </div>
                        <div name="local_ass_mem_no" style="display: none;">
                            <div class="col-sm-2">
                                <input type="text" name="mem_loc_ass_name" class="form-control" placeholder="Specify Name of Association"/>
                            </div>
                            <div class="col-sm-2">
                                <input type="text" name="mem_loc_ass_city" class="form-control" placeholder="City"/>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="form-group">
                    <div style="width:80%; margin: 30px auto;height:100px;" id="captcha_div">
                        <div style="float:left; font-size:12px; border-right:1px solid #e5e5e5;">
                            <div style="width:80%; margin: 0px auto;">
                                <div>Type the characters you see in the image</div>
                                <div style="font-size:10px;">Letters are Case-Sensitive</div>
                            </div>
                        </div>
                        <div style="float:left;">
                            <div style="margin-left:50px; margin-top:-17px; margin-bottom:20px;">
                                <label
                                    for="defaultReal"
                                    class="hasTip required"
                                    title="Captcha::Enter Captcha here."></label>

                                <input type="text" id="defaultReal" name="defaultReal"
                                       style="margin:0px auto; font-size:11px; width:140px; letter-spacing:5px;"
                                       placeholder="Captcha"/>
                            </div>
                        </div>

                    </div>
                </div>

                <input type="hidden" name="user_role" value="2" />

                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-danger ladda-button" id="p_register_submit" data-style="expand-left"><span class="ladda-label">Create Account</span></button>
                    </div>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('#defaultReal').realperson();
        var country_index = print_country('countrySelect', 'India');
        print_state('stateSelect', country_index);

        $("[name='domain_name']").on("keyup", function() {
            $('#domain_text').html(toHandle($(this).val()));
        });

        $("[name='domain_name']").on("blur", function() {
            var val = $(this).val();
            if (val !== '') {
                $('[name="domain_f_name"]').val($('#domain_text').html());
                var reqData = {
                    type: 'domain_name',
                    val: $('[name="domain_f_name"]').val()
                };
                ajaxCallCommonReqWithRef('user/check_data', reqData, 'domain_name', $(this));
            }
        });

        $("[name='email_id']").on("blur", function() {
            var val = $(this).val();
            if (val !== '' && !$(this).hasClass('error')) {
                var reqData = {
                    type: 'email',
                    val: val
                };
                ajaxCallCommonReqWithRef('user/check_data', reqData, 'email_val', $(this));
            }
        });
    });

    function showHideMemNo(id) {
        var val = $(id).attr('name');
        if ($(id).val() === '1') {
            $("[name='" + val + "_mem_no']").show().focus();
        } else {
            $("[name='" + val + "_mem_no']").val('').hide();
        }
    }

</script>


<script type="text/javascript">
    jQuery(document).ready(function() {
        "use strict";
        var options = {
            minChar: 6,
            bootstrap3: true,
            onKeyUp: function(evt) {
                $('.progress').show();
                $(evt.target).pwstrength("outputErrorList");
            }
        };
        $('#password').pwstrength(options);
    });
</script>