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
        
        //For comp_type_id field thatsy used below function
        $('#colored_stone_type').on('change', function() {
            $(this).parents('tr').find('a.submit').attr('data-comp-type-val', $(this).val());
        });
        $('.submit').on('click', function(e) {
            e.preventDefault();
            var val = $(this).parents('tr').find('input[type="text"]').val();
            var cstone_type_id = $( "#colored_stone_type" ).val();
            //console.log(reqData);
            alert(cstone_type_id);
            if(cstone_type_id == 0){
                alert("Please select the Colored Stone Type");
            }
            else{
                var reqData = {
                req: $(this).data('req'),
                col_name: $(this).data('col-name'),
                comp_id: $(this).data('comp-id'),
                comp_id_val: $(this).data('comp-type-val'),
                val: val
                };
                $.ajax({
                    type: 'POST',
                    url: 'master/compAjaxAddCStone',
                    dataType: 'json',
                    data: reqData,
                    success: function(data) {
                        window.location.reload();
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown) {
                        alert(errorThrown);
                    }
                });
            }
        });
       
        //Without comp_type_id
        
        $('.submit1').on('click', function(e) {
            e.preventDefault();
            var val = $(this).parents('tr').find('input[type="text"]').val();
            var reqData = {
                    req: $(this).data('req'),
                    col_name: $(this).data('col-name'),
                    val: val
                };
                //console.log(reqData);
                $.ajax({
                    type: 'POST',
                    url: 'master/compAjaxAdd',
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
        
        // For Colored Stone Type
        $('.submit2').on('click', function(e) {
            e.preventDefault();
            var val = $(this).parents('tr').find('input[type="text"]').val();
            var reqData = {
                    req: $(this).data('req'),
                    col_name: $(this).data('col-name'),
                    comp_id: $(this).data('comp-id'),
                    comp_id_val: $(this).data('comp-id-val'),
                    val: val
                };
                console.log(reqData);
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
                <h4 class="panel-title">Colored Stone Type</h4>
              </div>
                <div class="table-responsive">
                    <table class="table mb30">
                      <thead>
                        <tr><td align="right" colspan="4"><a href="#" class="add_comp">Add New Type</a></td></tr>
                        <tr style="display: none;">
                            <td colspan="4">
                                <div>
                                    Type Name:
                                    <input type="text" name="comp_value" placeholder="Enter Type Name" />
                                    <a class="btn btn-info submit2" href="#" data-col-name="COMP_TYPE_NAME" data-req="component_type" data-comp-id="COMP_ID" data-comp-id-val="3">Add</a>
                                </div>
                            </td>
                        </tr>
                        <tr>
                          <th>Colored Stone Type Id</th>
                          <th>Colored Stone Type</th>
                        </tr>
                      </thead>
                      <tbody>
                       <?php
                            foreach ($cStoneTypeArr as $cStoneTypeList) {
                            echo '<tr>';
                            echo '<td>' . $cStoneTypeList->COMP_TYPE_ID . '</td>';
                            echo '<td><span class="edit" data-id="' . $cStoneTypeList->COMP_TYPE_ID . '" data-col-id="COMP_TYPE_ID" data-col-name="COMP_TYPE_NAME" data-req="component_type">' . $cStoneTypeList->COMP_TYPE_NAME . '</span></td>';
                            echo '</tr>';
                            }
                        ?>
                      </tbody>
                    </table>
                </div>
            </div><!-- panel-default -->
          </form>
        </div><!-- col-md-6 --> 
        <div class="col-md-6">         
          <form class="form-horizontal" id="form1">
            <div class="panel panel-default">
              <div class="panel-heading">
                <div class="panel-btns">
                  <a class="panel-close" href="">×</a>
                  <a class="minimize" href="">−</a>
                </div>
                <h4 class="panel-title">Colored Stone Category</h4>
              </div>
                <div class="table-responsive">
                    <table class="table mb30">
                      <thead>
                        <tr><td align="right" colspan="4"><a href="#" class="add_comp">Add New Category</a></td></tr>
                        <tr style="display: none;">
                            <td colspan="4">
                                <div>
                                    Colored Stone Type:
                                    <select id="colored_stone_type">
                                        <option value="0">Select Type</option>
                                            <?php
                                                foreach($cStoneTypeArr as $cStoneType){
                                                    $compTypeId = $cStoneType->COMP_TYPE_ID;
                                                    echo '<option value='.$cStoneType->COMP_TYPE_ID.'>'.$cStoneType->COMP_TYPE_NAME.'</option>';
                                                }
                                            ?>
                                        
                                    </select>
                                    Category Name:
                                    <input type="text" name="comp_value" placeholder="Enter Category Name" />
                                    <a class="btn btn-info submit" href="#" data-col-name="C_STONE_CAT_NAME" data-req="c_stone_category" data-comp-id="COMP_TYPE_ID" data-comp-type-val = ''>Add</a>
                                </div>
                            </td>
                        </tr>
                        <tr>
                          <th>Category Id</th>
                          <th>Category Name</th>
                        </tr>
                      </thead>
                      <tbody>
                       <?php
                            foreach ($cStoneCatArr as $cStoneCatList) {
                            echo '<tr>';
                            echo '<td>' . $cStoneCatList->C_STONE_CAT_ID . '</td>';
                            echo '<td><span class="edit" data-id="' . $cStoneCatList->C_STONE_CAT_ID . '" data-col-id="C_STONE_CAT_ID" data-col-name="C_STONE_CAT_NAME" data-req="c_stone_category">' . $cStoneCatList->C_STONE_CAT_NAME . '</span></td>';
                            echo '</tr>';
                            }
                        ?>
                      </tbody>
                    </table>
                </div>
            </div><!-- panel-default -->
          </form>
        </div><!-- col-md-6 --> 
      </div>
      <div class="row">
        <div class="col-md-6">         
          <form class="form-horizontal" id="form1">
            <div class="panel panel-default">
              <div class="panel-heading">
                <div class="panel-btns">
                  <a class="panel-close" href="">×</a>
                  <a class="minimize" href="">−</a>
                </div>
                <h4 class="panel-title">Colored Stone Color</h4>
              </div>
                <div class="table-responsive">
                    <table class="table mb30">
                      <thead>
                        <tr><td align="right" colspan="4"><a href="#" class="add_comp">Add New Color</a></td></tr>
                        <tr style="display: none;">
                            <td colspan="4">
                                <div>
                                    Color Name:
                                    <input type="text" name="comp_value" placeholder="Enter Color Name" />
                                    <a class="btn btn-info submit1" href="#" data-col-name="C_STONE_COL_NAME" data-req="c_stone_color">Add</a>
                                </div>
                            </td>
                        </tr>
                        <tr>
                          <th>Color Id</th>
                          <th>Color Name</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                            foreach ($cStoneColorArr as $cStoneList) {
                            echo '<tr>';
                            echo '<td>' . $cStoneList->C_STONE_COL_ID . '</td>';
                            echo '<td><span class="edit" data-id="' . $cStoneList->C_STONE_COL_ID . '" data-col-id="C_STONE_COL_ID" data-col-name="C_STONE_COL_NAME" data-req="c_stone_color">' . $cStoneList->C_STONE_COL_NAME . '</span></td>';
                            echo '</tr>';
                            }
                        ?>
                      </tbody>
                    </table>
                </div>
            </div><!-- panel-default -->
          </form>
        </div><!-- col-md-6 --> 
        <div class="col-md-6">         
          <form class="form-horizontal" id="form1">
            <div class="panel panel-default">
              <div class="panel-heading">
                <div class="panel-btns">
                  <a class="panel-close" href="">×</a>
                  <a class="minimize" href="">−</a>
                </div>
                <h4 class="panel-title">Colored Stone Cut</h4>
              </div>
                <div class="table-responsive">
                    <table class="table mb30">
                      <thead>
                        <tr><td align="right" colspan="4"><a href="#" class="add_comp">Add New Cut</a></td></tr>
                        <tr style="display: none;">
                            <td colspan="4">
                                <div>
                                    Cut Name:
                                    <input type="text" name="comp_value" placeholder="Enter Cut Name" />
                                    <a class="btn btn-info submit1" href="#" data-col-name="CUT_NAME" data-req="c_stone_cut">Add</a>
                                </div>
                            </td>
                        </tr>
                        <tr>
                          <th>Cut Id</th>
                          <th>Cut Name</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                            foreach ($cStoneCutArr as $cStoneCutList) {
                            echo '<tr>';
                            echo '<td>' . $cStoneCutList->CUT_ID . '</td>';
                            echo '<td><span class="edit" data-id="' . $cStoneCutList->CUT_ID . '" data-col-id="CUT_ID" data-col-name="CUT_NAME" data-req="c_stone_cut">' . $cStoneCutList->CUT_NAME . '</span></td>';
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