<div class="contentpanel">
    <div class="row">
        <div class="col-sm-11 col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="results-list">
                        <?php echo form_open('', array('id' => 'add_form', 'role' => 'form', 'autocomplete' => 'off')); ?>
                        <table class="table table-success">
                            <tbody>
                                <tr>
                                    <td><?php echo ucfirst($req); ?> List</td>
                            <div id="form_errors" class="alert alert-danger" style="display:none;"></div>
                            <td align="right">
                                <a href="#" class="add_brand">Add New <?php echo ucfirst($req); ?></a>
                            </td>
                            </tr>
                            <tr style="display: none;">
                                <td colspan="2">
                                    <div>
                                        <?php echo ucfirst($req); ?> Name:
                                        <input type="text" id="name" name="comp_value" placeholder="Enter Name" />
                                        <a style="margin-left: 10px;"class="btn btn-primary btn-xs submit" href="#">Add</a>
                                    </div>
                                </td>
                            </tr>

                            </tbody>
                        </table>
                        <input type="hidden" name="fields" value="<?php echo $fields; ?>" />
                        </form>

                        <table class="table table-success" id="details">
                            <thead>
                                <tr>
                                    <th> <?php echo ucfirst($req); ?> Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $fieldsArr = explode(',', $fields);
                                foreach ($settingArr as $setting) {
                                    $id = $setting->$fieldsArr[0];
                                    ?>
                                    <tr>
                                        <td>
                                            <span data-id="<?php echo $id; ?>" class="span_text" id="span_<?php echo $id; ?>"><?php echo ($setting->$fieldsArr[1]); ?></span>
                                            <input class="text_name" type="text" data-id="<?php echo $id; ?>" id="text_<?php echo $id; ?>" value="<?php echo ($setting->$fieldsArr[1]); ?>" name="text_<?php echo $id; ?>" style="display: none;"/>
                                            <span id="save_<?php echo $id; ?>" style="display: none;">
                                                <button class="btn btn-xs btn-primary save_form" type="button" data-id="<?php echo $id; ?>">Save</button>
                                                <button class="btn btn-xs btn-danger cancel_form" type="button" data-id="<?php echo $id; ?>">Cancel</button>
                                            </span>
                                        </td>
                                        <td>
                                            <a href="javascript:;" class="fa fa-edit edit_det" id="edit_btn_<?php echo $id; ?>" data-id="<?php echo $id; ?>"/><a>
                                        </td>
                                    </tr>
                                <?php }
                                ?>
                            </tbody>

                        </table>
                    </div>

                </div><!-- panel-body -->
            </div><!-- panel -->
        </div><!-- col-sm-8 -->
    </div><!-- row -->
</div>

<script type='text/javascript'>//<![CDATA[ 
    $(function() {
        $('.add_brand').on('click', function(e) {
            e.preventDefault();
            $(this).parents('tr').next().toggle();
        });
        //add function
        $('.submit').on('click', function(e) {
            e.preventDefault();
            var value = $('#name').val();
            if (value != '') {
                var formData = $('#add_form').serialize();
                $.ajax({
                    type: 'POST',
                    url: 'admin/save_prod_settings/<?php echo $req; ?>',
                    dataType: 'json',
                    data: formData,
                    success: function(data) {
                        if (data.error === false) {
                            var str = '<tr>\n\
                                <td>\n\
                                <span data-id="' + data.col_id + '" class="span_text" id="span_' + data.col_id + '">' + data.col_name + '</span>\n\
                                <input class="text_name" data-id="' + data.col_id + '" id="text_' + data.col_id + '" value="' + data.col_name + '" name="text_' + data.col_id + '" style="display: none;" type="text">\n\
                                </td>\n\
                                <td>\n\
                                <a href="javascript:;" class="fa fa-edit edit_det" id="edit_btn_' + data.col_id + '" data-id="' + data.col_id + '"></a><a>\n\
                                </a><div id="save_' + data.col_id + '" style="display: none;"><a>\n\
                                <button class="btn btn-xs btn-success save_form" type="button" data-id="' + data.col_id + '">Save</button>\n\
                            </a><a href="javascript:;" data-id="' + data.col_id + '" class="cancel_form"><i class="fa fa-undo"></i></a>\n\
                            </div>\n\
                            </td>\n\
                            </tr>';
                            $('#details > tbody').prepend(str);
                            $('[name="comp_value"]').val('');
                        } else {
                            $('#form_errors').text(data.message).show();
                            setTimeout(function() {
                                $('#form_errors').fadeOut('slow');
                            }, 3000);
                        }
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown) {
                        alert(errorThrown);
                    }
                });
            } else {
                $('#form_errors').text('Please Enter Name').show();
                setTimeout(function() {
                    $('#form_errors').fadeOut('slow');
                }, 3000);
            }
        });

        //edit function
        $(document).ready(function() {
            $('body').on('click', '.edit_det', function(e) {
                e.preventDefault();
                showFields($(this).data('id'), true);
            });
            $('body').on('dblclick', '.span_text', function(e) {
                e.preventDefault();
                showFields($(this).data('id'), true);
            });
            $('body').on('click', '.cancel_form', function(e) {
                e.preventDefault();
                showFields($(this).data('id'), false);
            });
            $('body').on('click', '.save_form', function() {
                var id = $(this).data('id');
                sendAjax(id);
            });
            $('body').on('keyup', '.text_name', function(e) {
                var id = $(this).data('id');
                if (e.keyCode == 13) {
                    sendAjax(id);
                } else if (e.keyCode == 27) {
                    showFields(id, false);
                }
            });
            function sendAjax(id) {
                var name = $('#text_' + id).val();
                var reqData = {
                    comp_id: id,
                    comp_value: name,
                    fields: '<?php echo $fields; ?>'
                };
                //console.log(reqData);
                $.ajax({
                    type: 'POST',
                    url: 'admin/edit_prod_settings/<?php echo $req; ?>',
                    dataType: 'json',
                    data: reqData,
                    success: function(data) {
                        if (data.error === false) {
                            $('#span_' + id).text($('#text_' + id).val());
                            showFields(id, false);
                        } else {
                            $('#form_errors').text(data.message).show();
                            setTimeout(function() {
                                $('#form_errors').fadeOut('slow');
                            }, 3000);
                        }
                    }
                });
            }

            function showFields(id, flag) {
                if (flag) {
                    $('#span_' + id).hide();
                    $('#text_' + id).show().focus().select();
                    $('#edit_btn_' + id).hide();
                    $('#save_' + id).show();
                } else {
                    $('#span_' + id).show();
                    $('#text_' + id).val($('#span_' + id).text()).hide();
                    $('#edit_btn_' + id).show();
                    $('#save_' + id).hide();
                }
            }

        });
    }); //]]>  

</script>
