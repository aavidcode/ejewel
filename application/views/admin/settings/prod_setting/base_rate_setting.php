<script type="text/javascript">
    $(function() {
        $('.submit').on('click', function(e) {
            e.preventDefault();
            var formData = $('#add_base_rate_form').serialize();
            $.ajax({
                type: 'POST',
                url: 'admin/add_base_rate',
                dataType: 'json',
                data: formData,
                success: function(data) {
                    $('#form_errors').text(data.message).show();
                    setTimeout(function() {
                        $('#form_errors').fadeOut('slow');
                    }, 3000);
                }
            });
        });
    });
</script>

<div class="contentpanel">
    <div class="row">
        <div class="col-sm-11 col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <?php echo form_open('', array('id' => 'add_base_rate_form', 'role' => 'form', 'autocomplete' => 'off')); ?>
                    <table class="table table-success">
                        <div id="form_errors" class="alert alert-danger" style="display:none;"></div>
                        <thead>
                            <tr>
                                <th>
                                    Karat/Purity
                                </th>
                                <th>
                                    Values
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Base Cost</td>
                                <td><input type="text" name="brval" value="<?php echo getBRValue($baseDetArr, 'metal_cost'); ?>" /></td>
                            </tr>
                            <?php
                            if (sizeof($metalQulAry) > 0) {
                                foreach ($metalQulAry as $quality) {
                                    echo '<tr>';
                                    echo '<td>' . $quality->MQ_KARAT . '/' . $quality->MQ_PURITY . '</td>';
                                    echo '<td><input type="text" name="brtypeval_' . $quality->MQ_ID . '" value ="' . getBRValue($baseDetArr, $quality->MQ_ID) . '"/></td>';
                                    echo '</tr>';
                                }
                            }
                            ?>
                            <tr>
                                <td colspan="2" align='center'>
                                    <input class="btn btn-primary submit" type='Submit' value='Save' style="margin-right:10px;"/>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    </form>
                </div><!-- panel-body -->
            </div><!-- panel -->
        </div><!-- col-sm-8 -->
    </div><!-- row -->
</div>

<script type="text/javascript">

</script>


<?php

function getBRValue($baseDetArr, $type_id) {
    if (sizeof($baseDetArr) > 0) {
        foreach ($baseDetArr as $baseDet) {
            if ($baseDet->BR_TYPE == $type_id) {
                return $baseDet->BR_VALUE;
            }
        }
    }
    return '';
}
?>