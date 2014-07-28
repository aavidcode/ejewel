<link href="css/jquery.realperson.css" rel="stylesheet" />
<script type="text/javascript" src="js/jquery.realperson.js"></script>
<!--<script type="text/javascript" src="js/countries2.js"></script>-->
<script type="text/javascript" src="js/pwstrength.js"></script>

<style type="text/css">
    .progress {
        display: none;
    }
</style>
<?php
$phone = $userObj->TELEPHONE;
$std = explode('-', $phone);
?>
<div class="container">
    <div class="row clearfix">
        <div class="col-md-11 column" style="margin-top:20px;">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">Edit Personal Details</h4>
                </div>
                <div class="panel-body">
                    <div id="form_errors"></div>
                    <?php echo form_open('', array('class' => 'form-horizontal', 'id' => 'updateForm', 'role' => 'form', 'autocomplete' => 'off')); ?>

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
                            <span style="line-height: 30px;">+91</span><input type="text" style="float:right; display: inline-block; width:88%;" class="form-control required numbers-only" name="mobile" placeholder="Mobile Number" maxlength="10" value="<?php echo $userObj->MOBILE; ?>"/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-3 control-label">Telephone : </label>
                        <div class="col-sm-1">
                            <input type="text" maxlength="5" class="form-control numbers-only" name="stdcode" placeholder="022" value="<?php echo $std[0]; ?>"/>
                        </div>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" name="telephone" placeholder="Telephone Number" maxlength="8" value="<?php echo $phone; ?>"/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-3 control-label">Address : </label>
                        <div class="col-sm-4">
                            <textarea class="form-control" name="address" maxlength="100"><?php echo $userObj->ADDRESS; ?></textarea>
                        </div>
                    </div>

                    <!--<div class="form-group">
                        <label for="inputEmail3" class="col-sm-3 control-label">City : </label>
                        <div class="col-sm-4">
                            <input type="text" maxlength="30" class="form-control" name="city" placeholder="City" value="<?php echo $userObj->CITY; ?>" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-3 control-label">State <span class="m_f">*</span> : </label>
                        <div class="col-sm-4">
                            <select data-placeholder="Choose a State" id="stateSelect" class="form-control" name='state'>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-3 control-label">Country : </label>
                        <div class="col-sm-4">
                            <select id='countrySelect' class="form-control" name='country'>
                                <option value="">-select-</option>
                            </select>
                        </div>
                    </div>-->
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-3 control-label">State <span class="m_f">*</span> : </label>
                        <div class="col-sm-4">
                            <select data-placeholder="Choose a State" id="stateSelect" class="form-control required" name='state'>
                                <?php echo $state_opt; ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-3 control-label">City : </label>
                        <div class="col-sm-4">
                            <select class="form-control" id="city" name="city" data-chosen-search="true">

                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-3 control-label">Pin Code <span class="m_f">*</span> : <span class="m_f">*</span></label>
                        <div class="col-sm-3">
                            <input type="text" maxlength="6" class="form-control required numbers-only" name="pincode" placeholder="Pin Code" value="<?php echo $userObj->PINCODE; ?>"/>
                        </div>
                    </div>

                    <p class="bg-info header">Other Details</p>

                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-3 control-label">Website : </label>
                        <div class="col-sm-4">
                            <span style="line-height: 30px;">http://</span><input style="margin-left:5px; display: inline-block; width:70%;" type="text" class="form-control" name="website" placeholder="http://www.example.com" value="<?php echo str_replace('http://', '', $userObj->WEBSITE); ?>" />
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
                                <input type="text" name="gjf_mem_no" style="display: none;" class="form-control" placeholder="Membership No:" value="<?php echo $userObj->MEM_GJF_NO; ?>"/>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-3 control-label">Member of any other Local<br/> Association : </label>

                        <div class="row">
                            <div class="col-sm-2">
                                <select class="form-control required" name="local_ass" onchange="showHideMemNo(this);">
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
                                    <!--<input type="text" name="mem_loc_ass_city" class="form-control" placeholder="City" value="<?php echo $userObj->MEM_LOC_ASS_CITY; ?>"/>-->
                                    <select class="form-control" id="mem_loc_ass_city" name="mem_loc_ass_city" data-chosen-search="true">

                                    </select>
                                </div>
                            </div>

                        </div>
                    </div>

                    <input type="hidden" name="user_role" value="2" />
                    <input type="hidden" name="userId" value="<?php echo $userId ?>" />

                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-8 t_center">
                            <button type="submit" class="btn btn-danger ladda-button" id="p_update_submit" data-style="expand-left"><span class="ladda-label">Save</span></button>
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
        //var country_index = print_country('countrySelect', 'India');
        //print_state('stateSelect', country_index);

        $("[name='domain_name']").on("keyup", function() {
            $('#domain_text').html(toHandle($(this).val()));
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

        $("#updateForm").validate({
            rules: {
                pass_word: {
                    required: true, minlength: 6
                },
                conf_password: {
                    required: true, equalTo: "[name='pass_word']", minlength: 6
                },
                mobile: {
                    required: true, number: true, minlength: 10
                },
                stdcode: {
                    required: true, number: true, minlength: 3
                },
                telephone: {
                    number: true, minlength: 8
                },
                state: {
                    required: true
                },
                pincode: {
                    required: true, number: true, maxlength: 6
                }
            },
            debug: true,
            submitHandler: ajaxUpdateCall
        });
        set_form_fields();

    });

    function set_form_fields() {
        $("#stateSelect").val('<?php echo $userObj->STATE; ?>');
        setMemNo('gjepc', '<?php echo $userObj->MEM_GJEPC_NO; ?>');
        setMemNo('gjf', '<?php echo $userObj->MEM_GJF_NO; ?>');
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

    function set_local_ass(name, city) {
        $("[name='local_ass']").val((name != '' ? '1' : '0'));
        if (name != '') {
            $("[name='local_ass_mem_no']").show();
            $("[name='mem_loc_ass_name']").val(name);
            $("[name='mem_loc_ass_name']").addClass('required');
            $("[name='mem_loc_ass_city']").val(city);
            $("[name='mem_loc_ass_city']").addClass('required');
        }
    }

    function ajaxUpdateCall() {
        ajaxSubmitForm('#updateForm', 'p_update', false);
    }

    function setMemNo(id, val) {
        $("[name='" + id + "']").val((val != '' ? '1' : '0'));
        if (val != '') {
            $("[name='" + id + "_mem_no']").val(val).show();
        }
    }
    
    function showHideMemNo(id) {
        var val = $(id).attr('name');
        if ($(id).val() === '1') {
            $("[name='" + val + "_mem_no']").show().focus();
            $("[name='" + val + "_mem_no']").addClass('required');
        } else {
            $("[name='" + val + "_mem_no']").removeClass('required').hide();
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




        /*jQuery("#countrySelect").chosen({
            'width': '100%',
            'white-space': 'nowrap',
            disable_search: true
        });

        $('#stateSelect').chosen();*/
        $('#stateSelect').on('change', function() {
            ajaxCallUpdateCombo('', 'main/ajax/cities', 'stateSelect', 'city', 'cities', '<?php echo $userObj->CITY; ?>');
        });

        $(document).ajaxSuccess(function() {
            var $options = $("#city > option").clone();
            $('#mem_loc_ass_city').empty().append($options);
            $('#mem_loc_ass_city').val('<?php echo $userObj->MEM_LOC_ASS_CITY; ?>');
        });

        $('#stateSelect').trigger('change');


    });
</script>