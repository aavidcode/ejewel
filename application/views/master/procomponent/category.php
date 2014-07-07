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
                        <h4 class="panel-title">Price Type</h4>
                    </div>
                    <div class="table-responsive">
                        <table class="table mb30">
                            <thead>
                                <tr><td align="right" colspan="4"><a href="#" class="add_comp">Add New Price</a></td></tr>
                                <tr style="display: none;">
                                    <td colspan="4">
                                        <div>
                                            Price Name:
                                            <input type="text" name="comp_value" placeholder="Enter Price Name" />
                                            <a class="btn btn-info submit" href="#" data-col-name="PRICE_TYPE_NAME" data-req="price_type">Add</a>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Price Id</th>
                                    <th>Price Name</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($priceArr as $priceList) {
                                    echo '<tr>';
                                    echo '<td>' . $priceList->PRICE_TYPE_ID . '</td>';
                                    echo '<td><span class="edit" data-id="' . $priceList->PRICE_TYPE_ID . '" data-col-id="PRICE_TYPE_ID" data-col-name="PRICE_TYPE_NAME" data-req="price_type">' . $priceList->PRICE_TYPE_NAME . '</span></td>';
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
                        <h4 class="panel-title">Product Type</h4>
                    </div>
                    <div class="table-responsive">
                        <table class="table mb30">
                            <thead>
                                <tr><td align="right" colspan="4"><a href="#" class="add_comp">Add New Product</a></td></tr>
                                <tr style="display: none;">
                                    <td colspan="4">
                                        <div>
                                            Product Name:
                                            <input type="text" name="comp_value" placeholder="Enter Product Name" />
                                            <a class="btn btn-info submit" href="#" data-col-name="PROD_TYPE_NAME" data-req="prod_type">Add</a>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Pro Id</th>
                                    <th>Product Name</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($productArr as $productList) {
                                    echo '<tr>';
                                    echo '<td>' . $productList->PROD_TYPE_ID . '</td>';
                                    echo '<td><span class="edit" data-id="' . $productList->PROD_TYPE_ID . '" data-col-id="PROD_TYPE_ID" data-col-name="PROD_TYPE_NAME" data-req="prod_type">' . $productList->PROD_TYPE_NAME . '</span></td>';
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
                        <h4 class="panel-title">Tax</h4>
                    </div>
                    <div class="table-responsive">
                        <table class="table mb30">
                        </table>
                    </div>
                </div><!-- panel-default -->
            </form>
        </div><!-- col-md-6 --> 
    </div><!-- row -->
</div>