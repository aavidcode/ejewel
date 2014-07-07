<link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet"/>
<script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/js/bootstrap-editable.min.js"></script>

<script type='text/javascript'>//<![CDATA[ 
    $(function() {
        // setting defaults for the editable
        $.fn.editable.defaults.mode = 'inline';
        $.fn.editable.defaults.showbuttons = false;

        $('.edit').editable({
            type: 'text',
            title: 'Enter username',
            success: function(response, newValue) {

                var reqData = {
                    req: $(this).data('req'),
                    id: $(this).data('id'),
                    col_id: $(this).data('col-id'),
                    col_name: $(this).data('col-name'),
                    val: newValue
                };
                //console.log(reqData);
                $.ajax({
                    type: 'POST',
                    url: 'master/compAjaxUpdate',
                    dataType: 'json',
                    data: reqData,
                    success: function(data) {
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown) {
                        alert(errorThrown);
                    }
                });

            }
        });

        $('.add_comp').on('click', function(e) {
            e.preventDefault();
            $(this).parents('tr').next().toggle();
        });
        
        $('.submit').on('click', function(e) {
            e.preventDefault();
            var val = $(this).parents('tr').find('input[type="text"]').val();
            var reqData = {
                    req: $(this).data('req'),
                    col_name: $(this).data('col-name'),
                    comp_id: $(this).data('comp-id'),
                    comp_id_val: $(this).data('comp-id-val'),
                    val: val
                };
                //console.log(reqData);
                $.ajax({
                    type: 'POST',
                    url: 'master/compAjaxAddMetal',
                    dataType: 'json',
                    data: reqData,
                    success: function(data) {
                        window.location.reload();
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown) {
                        alert(errorThrown);
                    }
                });
        });

    });//]]>  

</script>
<div class="contentpanel">     
      <div class="row">
        <div class="col-md-6">         
          <form class="form-horizontal" id="form1">
            <div class="panel panel-default">
              <div class="panel-heading">
                <div class="panel-btns">
                  <a class="panel-close" href="">×</a>
                  <a class="minimize" href="">−</a>
                </div>
                <h4 class="panel-title">Metal Type</h4>
              </div>
                <div class="table-responsive">
                    <table class="table mb30">
                      <thead>
                        <tr><td align="right" colspan="4"><a href="#" class="add_comp">Add New Metal</a></td></tr>
                        <tr style="display: none;">
                            <td colspan="4">
                                <div>
                                    Metal Name:
                                    <input type="text" name="comp_value" placeholder="Enter Metal Name" />
                                    <a class="btn btn-info submit" href="#" data-col-name="COMP_TYPE_NAME" data-req="component_type" data-comp-id="COMP_ID" data-comp-id-val="1">Add</a>
                                </div>
                            </td>
                        </tr>
                        <tr>
                          <th>Metal Id</th>
                          <th>Metal Name</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                            foreach ($metalArr as $metalList) {
                            echo '<tr>';
                            echo '<td>' . $metalList->COMP_TYPE_ID . '</td>';
                            echo '<td><span class="edit" data-id="' . $metalList->COMP_TYPE_ID . '" data-col-id="COMP_TYPE_ID" data-col-name="COMP_TYPE_NAME" data-req="component_type">' . $metalList->COMP_TYPE_NAME . '</span></td>';
                            echo '</tr>';
                            }
                        ?>
                      </tbody>
                    </table>
                </div>
            </div><!-- panel-default -->
          </form>
        </div><!-- col-md-6 -->       
    </div><!-- row -->
</div>