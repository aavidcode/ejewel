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
                <h4 class="panel-title">Stone Type</h4>
              </div>
                <div class="table-responsive">
                    <table class="table mb30">
                      <thead>
                        <tr><td align="right" colspan="4"><a href="#" class="add_comp">Add New Type</a></td></tr>
                        <tr style="display: none;">
                            <td colspan="4">
                                <div>
                                    Stone Type Name:
                                    <input type="text" name="comp_value" placeholder="Enter Type Name" />
                                    <a class="btn btn-info submit2" href="#" data-col-name="COMP_TYPE_NAME" data-req="component_type" data-comp-id="COMP_ID" data-comp-id-val="2">Add</a>
                                </div>
                            </td>
                        </tr>
                        <tr>
                          <th>Stone Type Id</th>
                          <th>Stone Type Name</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                            foreach ($stoneTypeArr as $stoneTypeList) {
                            echo '<tr>';
                            echo '<td>' . $stoneTypeList->COMP_TYPE_ID . '</td>';
                            echo '<td><span class="edit" data-id="' . $stoneTypeList->COMP_TYPE_ID . '" data-col-id="COMP_TYPE_ID" data-col-name="COMP_TYPE_NAME" data-req="component_type" data-comp-id-val="2">' . $stoneTypeList->COMP_TYPE_NAME . '</span></td>';
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
                <h4 class="panel-title">Stone Clarity</h4>
              </div>
                <div class="table-responsive">
                    <table class="table mb30">
                      <thead>
                        <tr><td align="right" colspan="4"><a href="#" class="add_comp">Add New Clarity</a></td></tr>
                        <tr style="display: none;">
                            <td colspan="4">
                                <div>
                                    Clarity Name:
                                    <input type="text" name="comp_value" placeholder="Enter Clarity Name" />
                                    <a class="btn btn-info submit" href="#" data-col-name="CLARITY_NAME" data-req="stone_clarity">Add</a>
                                </div>
                            </td>
                        </tr>
                        <tr>
                          <th>Stone Id</th>
                          <th>Stone Clarity Name</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                            foreach ($stoneClarityArr as $stoneClarityList) {
                            echo '<tr>';
                            echo '<td>' . $stoneClarityList->CLARITY_ID . '</td>';
                            echo '<td><span class="edit" data-id="' . $stoneClarityList->CLARITY_ID . '" data-col-id="CLARITY_ID" data-col-name="CLARITY_NAME" data-req="stone_clarity">' . $stoneClarityList->CLARITY_NAME . '</span></td>';
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
      <div class="row">       
        <div class="col-md-6">         
          <form class="form-horizontal" id="form1">
            <div class="panel panel-default">
              <div class="panel-heading">
                <div class="panel-btns">
                  <a class="panel-close" href="">×</a>
                  <a class="minimize" href="">−</a>
                </div>
                <h4 class="panel-title">Stone Color</h4>
              </div>
                <div class="table-responsive">
                    <table class="table mb30">
                      <thead>
                        <tr><td align="right" colspan="4"><a href="#" class="add_comp">Add New Stone Color</a></td></tr>
                        <tr style="display: none;">
                            <td colspan="4">
                                <div>
                                    Color Name:
                                    <input type="text" name="comp_value" placeholder="Enter Color Name" />
                                    <a class="btn btn-info submit" href="#" data-col-name="COLOR_NAME" data-req="stone_color">Add</a>
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
                            foreach ($stoneColorArr as $stoneColorList) {
                            echo '<tr>';
                            echo '<td>' . $stoneColorList->COLOR_ID . '</td>';
                            echo '<td><span class="edit" data-id="' . $stoneColorList->COLOR_ID . '" data-col-id="COLOR_ID" data-col-name="COLOR_NAME" data-req="stone_color">' . $stoneColorList->COLOR_NAME . '</span></td>';
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
                <h4 class="panel-title">Stone Cut</h4>
              </div>
                <div class="table-responsive">
                    <table class="table mb30">
                      <thead>
                        <tr><td align="right" colspan="4"><a href="#" class="add_comp">Add New Stone Cut</a></td></tr>
                        <tr style="display: none;">
                            <td colspan="4">
                                <div>
                                    Cut Name:
                                    <input type="text" name="comp_value" placeholder="Enter Cut Name" />
                                    <a class="btn btn-info submit" href="#" data-col-name="CUT_NAME" data-req="stone_cut">Add</a>
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
                            foreach ($stoneCutArr as $stoneCutList) {
                            echo '<tr>';
                            echo '<td>' . $stoneCutList->CUT_ID . '</td>';
                            echo '<td><span class="edit" data-id="' . $stoneCutList->CUT_ID . '" data-col-id="CUT_ID" data-col-name="CUT_NAME" data-req="stone_cut">' . $stoneCutList->CUT_NAME . '</span></td>';
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
    <div class="row"> 
        <div class="col-md-6">         
          <form class="form-horizontal" id="form1">
            <div class="panel panel-default">
              <div class="panel-heading">
                <div class="panel-btns">
                  <a class="panel-close" href="">×</a>
                  <a class="minimize" href="">−</a>
                </div>
                <h4 class="panel-title">Stone Shape</h4>
              </div>
                <div class="table-responsive">
                    <table class="table mb30">
                      <thead>
                        <tr><td align="right" colspan="4"><a href="#" class="add_comp">Add New Stone Shape</a></td></tr>
                        <tr style="display: none;">
                            <td colspan="4">
                                <div>
                                    Shape Name:
                                    <input type="text" name="comp_value" placeholder="Enter Shape Name" />
                                    <a class="btn btn-info submit" href="#" data-col-name="SHAPE_NAME" data-req="stone_shape">Add</a>
                                </div>
                            </td>
                        </tr>
                        <tr>
                          <th>Shape Id</th>
                          <th>Shape Name</th>
                        </tr>
                      </thead>
                      <tbody>
                       <?php
                            foreach ($stoneShapeArr as $stoneShapeList) {
                            echo '<tr>';
                            echo '<td>' . $stoneShapeList->SHAPE_ID . '</td>';
                            echo '<td><span class="edit" data-id="' . $stoneShapeList->SHAPE_ID . '" data-col-id="SHAPE_ID" data-col-name="SHAPE_NAME" data-req="stone_shape">' . $stoneShapeList->SHAPE_NAME . '</span></td>';
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
                <h4 class="panel-title">Stone Fluorescence</h4>
              </div>
                <div class="table-responsive">
                    <table class="table mb30">
                      <thead>
                        <tr><td align="right" colspan="4"><a href="#" class="add_comp">Add New Fluorescence</a></td></tr>
                        <tr style="display: none;">
                            <td colspan="4">
                                <div>
                                    Fluorescence Name:
                                    <input type="text" name="comp_value" placeholder="Enter Name" />
                                    <a class="btn btn-info submit" href="#" data-col-name="FLU_NAME" data-req="stone_fluorescence">Add</a>
                                </div>
                            </td>
                        </tr>
                        <tr>
                          <th>Flu Id</th>
                          <th>Fluorescence Name</th>
                        </tr>
                      </thead>
                      <tbody>
                       <?php
                            foreach ($stoneFluorescenceArr as $stoneFluorescenceList) {
                            echo '<tr>';
                            echo '<td>' . $stoneFluorescenceList->FLU_ID . '</td>';
                            echo '<td><span class="edit" data-id="' . $stoneFluorescenceList->FLU_ID . '" data-col-id="FLU_ID" data-col-name="FLU_NAME" data-req="stone_fluorescence">' . $stoneFluorescenceList->FLU_NAME . '</span></td>';
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
    <div class="row"> 
        <div class="col-md-6">         
          <form class="form-horizontal" id="form1">
            <div class="panel panel-default">
              <div class="panel-heading">
                <div class="panel-btns">
                  <a class="panel-close" href="">×</a>
                  <a class="minimize" href="">−</a>
                </div>
                <h4 class="panel-title">Stone Placement</h4>
              </div>
                <div class="table-responsive">
                    <table class="table mb30">
                      <thead>
                        <tr><td align="right" colspan="4"><a href="#" class="add_comp">Add New Stone Placement</a></td></tr>
                        <tr style="display: none;">
                            <td colspan="4">
                                <div>
                                    Placement Name:
                                    <input type="text" name="comp_value" placeholder="Enter Placement Name" />
                                    <a class="btn btn-info submit" href="#" data-col-name="PLAC_NAME" data-req="stone_placement">Add</a>
                                </div>
                            </td>
                        </tr>
                        <tr>
                          <th>Placement Id</th>
                          <th>Placement Name</th>
                        </tr>
                      </thead>
                      <tbody>
                       <?php
                            foreach ($stonePlacementArr as $stonePlacementList) {
                            echo '<tr>';
                            echo '<td>' . $stonePlacementList->PLAC_ID . '</td>';
                            echo '<td><span class="edit" data-id="' . $stonePlacementList->PLAC_ID . '" data-col-id="PLAC_ID" data-col-name="PLAC_NAME" data-req="stone_placement">' . $stonePlacementList->PLAC_NAME . '</span></td>';
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
                <h4 class="panel-title">Stone Seiv Size From</h4>
              </div>
                <div class="table-responsive">
                    <table class="table mb30">
                      <thead>
                        <tr><td align="right" colspan="4"><a href="#" class="add_comp">Add New Size From</a></td></tr>
                        <tr style="display: none;">
                            <td colspan="4">
                                <div>
                                    Size From Name:
                                    <input type="text" name="comp_value" placeholder="Enter Size" />
                                    <a class="btn btn-info submit" href="#" data-col-name="SEIV_SIZE_FROM_NAME" data-req="stone_seiv_size_from">Add</a>
                                </div>
                            </td>
                        </tr>
                        <tr>
                          <th>Size Id</th>
                          <th>Size From Name</th>
                        </tr>
                      </thead>
                      <tbody>
                       <?php
                            foreach ($stoneSizeFromArr as $stoneSizeFromList) {
                            echo '<tr>';
                            echo '<td>' . $stoneSizeFromList->SEIV_SIZE_FROM_ID . '</td>';
                            echo '<td><span class="edit" data-id="' . $stoneSizeFromList->SEIV_SIZE_FROM_ID . '" data-col-id="SEIV_SIZE_FROM_ID" data-col-name="SEIV_SIZE_FROM_NAME" data-req="stone_seiv_size_from">' . $stoneSizeFromList->SEIV_SIZE_FROM_NAME . '</span></td>';
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
    <div class="row"> 
        <div class="col-md-6">         
          <form class="form-horizontal" id="form1">
            <div class="panel panel-default">
              <div class="panel-heading">
                <div class="panel-btns">
                  <a class="panel-close" href="">×</a>
                  <a class="minimize" href="">−</a>
                </div>
                <h4 class="panel-title">Stone Seiv Size To</h4>
              </div>
                <div class="table-responsive">
                    <table class="table mb30">
                      <thead>
                        <tr><td align="right" colspan="4"><a href="#" class="add_comp">Add New Size To</a></td></tr>
                        <tr style="display: none;">
                            <td colspan="4">
                                <div>
                                    Size To Name:
                                    <input type="text" name="comp_value" placeholder="Enter Size To" />
                                    <a class="btn btn-info submit" href="#" data-col-name="SEIV_SIZE_TO_NAME" data-req="stone_seiv_size_to">Add</a>
                                </div>
                            </td>
                        </tr>
                        <tr>
                          <th>Size Id</th>
                          <th>Size To Name</th>
                        </tr>
                      </thead>
                      <tbody>
                       <?php
                            foreach ($stoneSizeToArr as $stoneSizeToList) {
                            echo '<tr>';
                            echo '<td>' . $stoneSizeToList->SEIV_SIZE_TO_ID . '</td>';
                            echo '<td><span class="edit" data-id="' . $stoneSizeToList->SEIV_SIZE_TO_ID . '" data-col-id="SEIV_SIZE_TO_ID" data-col-name="SEIV_SIZE_TO_NAME" data-req="stone_seiv_size_to">' . $stoneSizeToList->SEIV_SIZE_TO_NAME . '</span></td>';
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
                <h4 class="panel-title">Stone Size</h4>
              </div>
                <div class="table-responsive">
                    <table class="table mb30">
                      <thead>
                        <tr><td align="right" colspan="4"><a href="#" class="add_comp">Add New Size</a></td></tr>
                        <tr style="display: none;">
                            <td colspan="4">
                                <div>
                                    Size Name:
                                    <input type="text" name="comp_value" placeholder="Enter Size" />
                                    <a class="btn btn-info submit" href="#" data-col-name="SIZE_NAME" data-req="stone_size">Add</a>
                                </div>
                            </td>
                        </tr>
                        <tr>
                          <th>Size Id</th>
                          <th>Size Name</th>
                        </tr>
                      </thead>
                      <tbody>
                       <?php
                            foreach ($stoneSizeArr as $stoneSizeList) {
                            echo '<tr>';
                            echo '<td>' . $stoneSizeList->SIZE_ID . '</td>';
                            echo '<td><span class="edit" data-id="' . $stoneSizeList->SIZE_ID . '" data-col-id="SIZE_ID" data-col-name="SIZE_NAME" data-req="stone_size">' . $stoneSizeList->SIZE_NAME . '</span></td>';
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