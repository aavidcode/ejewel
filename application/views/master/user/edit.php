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
    <div class="row clearfix">
        <div class="col-md-11 column" style="margin-top:20px;">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">Edit User Details</h4>
                </div>
                <div class="panel-body">
                    <div id="form_errors"></div>
                    <?php echo form_open(); ?>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-3 control-label">Your Store Web Url <span class="m_f">*</span> : </label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control required" name="domain_name" placeholder="Your Store Name" value="<?php echo $userObj->USER_NAME; ?>" />
                            <input type="hidden" name="domain_f_name" maxlength="20" />
                            <span id="domain_text" style="padding:10px; font-weight: bold;"></span>
                        </div>
                    </div>

                    <p class="bg-info header">Personal Details</p>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-3 control-label">Full Name <span class="m_f">*</span> : </label>
                        <div class="row">
                            <div class="col-sm-3">
                                <input type="text" maxlength="20" name="first_name" class="form-control required" placeholder="First Name" value="<?php echo $userObj->FIRST_NAME; ?>">
                            </div>
                            <div class="col-sm-3">
                                <input type="text" maxlength="20" name="last_name" class="form-control required" placeholder="Last Name" value="<?php echo $userObj->LAST_NAME; ?>">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label">Email Address <span class="m_f">*</span> : </label>
                        <div class="col-sm-4">
                            <input type="text" maxlength="30" class="form-control required email" name="email_id" placeholder="Email address" value="<?php echo $userObj->EMAIL_ID; ?>"/>
                        </div>
                    </div>

                    <p class="bg-info header">Communication Details</p>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Company Name <span class="m_f">*</span> : </label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control required" name="comp_name" placeholder="Company Name" value="<?php echo $userObj->COMP_NAME; ?>"/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-3 control-label">Mobile <span class="m_f">*</span> : </label>
                        <div class="col-sm-4">
                            <span style="line-height: 30px;">+91</span><input type="text" style="float:right; display: inline-block; width:88%;" class="form-control required" name="mobile" placeholder="Mobile Number" maxlength="10" onkeypress="return numbersonly(this, false);" value="<?php echo $userObj->MOBILE; ?>"/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-3 control-label">Telephone : </label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="telephone" placeholder="Telephone Number" maxlength="10" onkeypress="return numbersonly(this, false);" value="<?php echo $userObj->TELEPHONE; ?>"/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-3 control-label">Address : </label>
                        <div class="col-sm-4">
                            <textarea class="form-control" name="address" maxlength="100"><?php echo $userObj->ADDRESS; ?></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-3 control-label">City : </label>
                        <div class="col-sm-4">
                            <input type="text" maxlength="30" class="form-control" name="city" placeholder="City" value="<?php echo $userObj->CITY; ?>" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-3 control-label">State <span class="m_f">*</span> : </label>
                        <div class="col-sm-4">
                            <select data-placeholder="Choose a State" id="stateSelect" class="chosen-select form-control required" name='state'>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-3 control-label">Country : </label>
                        <div class="col-sm-4">
                            <select id='countrySelect' class="chosen-select-dis-search form-control" name='country'>
                                <option value="">-select-</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-3 control-label">Pin Code : </label>
                        <div class="col-sm-3">
                            <input type="text" maxlength="10" class="form-control" name="pincode" placeholder="Pin Code" onkeypress="return numbersonly(this, false);" value="<?php echo $userObj->PINCODE; ?>"/>
                        </div>
                    </div>

                    <p class="bg-info header">Other Details</p>

                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-3 control-label">Website : </label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="website" placeholder="http://www.example.com" value="<?php echo $userObj->WEBSITE; ?>" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-3 control-label">Member of GJEPC <span class="m_f">*</span> : </label>

                        <div class="row">
                            <div class="col-sm-2">
                                <select class="form-control required" name="gjepc" onchange="showHideMemNo(this);">
                                    <option value=""></option>
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                            </div>
                            <div class="col-sm-3">
                                <input type="text" name="gjepc_mem_no" style="display: none;" class="form-control" placeholder="Membership No:" <?php echo $userObj->MEM_GJEPC_NO; ?>/>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-3 control-label">Member of GJF <span class="m_f">*</span> : </label>

                        <div class="row">
                            <div class="col-sm-2">
                                <select class="form-control required" name="gjf" onchange="showHideMemNo(this);">
                                    <option value=""></option>
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                            </div>
                            <div class="col-sm-3">
                                <input type="text" name="gjf_mem_no" style="display: none;" class="form-control" placeholder="Membership No:" value="<?php echo $userObj->MEN_GJF_NO; ?>"/>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-3 control-label">Member of any other Local<br/> Association : </label>

                        <div class="row">
                            <div class="col-sm-2">
                                <select class="form-control" name="local_ass" onchange="showHideMemNo(this);">
                                    <option value=""></option>
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                            </div>
                            <div name="local_ass_mem_no" style="display: none;">
                                <div class="col-sm-3">
                                    <input type="text" name="mem_loc_ass_name" class="form-control" placeholder="Specify Name of Association" value="<?php echo $userObj->MEM_LOC_ASS_NAME; ?>"/>
                                </div>
                                <div class="col-sm-3">
                                    <input type="text" name="mem_loc_ass_city" class="form-control" placeholder="City" value="<?php echo $userObj->MEM_LOC_ASS_CITY; ?>"/>
                                </div>
                            </div>

                        </div>
                    </div>

                    <input type="hidden" name="user_role" value="2" />
                    <input type="hidden" name="userId" value="<?php echo $userId ?>" />

                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-danger ladda-button" id="p_register_submit" data-style="expand-left"><span class="ladda-label">Save</span></button>
                        </div>
                    </div>
                <?php echo form_close(); ?>
                </div>
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
                    type: 'Domain Name',
                    val: $('[name="domain_f_name"]').val()
                };
                ajaxCallCommonReqWithRef('main/checkRegisterdata', reqData, 'domain_name', $(this));
            }
        });

        $("[name='email_id']").on("blur", function() {
            var val = $(this).val();
            if (val !== '' && !$(this).hasClass('error')) {
                var reqData = {
                    type: 'Email ID',
                    val: val
                };
                ajaxCallCommonReqWithRef('main/checkRegisterdata', reqData, 'email_id', $(this));
            }
        });

        set_form_fields();

    });

    function set_form_fields() {
        $("#stateSelect").val('<?php echo $userObj->STATE; ?>');
        setMemNo('gjepc', '<?php echo $userObj->MEM_GJEPC_NO; ?>');
        setMemNo('gjf', '<?php echo $userObj->MEN_GJF_NO; ?>');
        set_local_ass('<?php echo $userObj->MEM_LOC_ASS_NAME; ?>', '<?php echo $userObj->MEM_LOC_ASS_CITY; ?>');
    }

    function set_local_ass(name, city) {
        $("[name='local_ass']").val((name != '' ? '1' : '0'));
        if (name != '') {
            $("[name='local_ass_mem_no']").show();
            $("[name='mem_loc_ass_name']").val(name);
            $("[name='mem_loc_ass_city']").val(city);
        }
    }

    function setMemNo(id, val) {
        $("[name='" + id + "']").val((val != '' ? '1' : '0'));
        if (val != '') {
            $("[name='" + id + "_mem_no']").val(val).show();
        }
    }

    function ajaxRegisterCall() {
        ajaxSubmitForm('#registerForm', 'p_register', false);
    }

    function showHideMemNo(id) {
        var val = $(id).attr('name');
        if ($(id).val() === '1') {
            $("[name='" + val + "_mem_no']").show().focus();
        } else {
            $("[name='" + val + "_mem_no']").hide();
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