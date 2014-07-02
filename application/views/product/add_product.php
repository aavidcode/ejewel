<div class="container">
    <div class="row">
        <form class="form-signin" method="POST" action="<?php echo base_url(); ?>product/add">
            <h2 class="form-signin-heading">Create New Product</h2>
            <div>
                <label>Product Name:</label><br />
                <input type="text" class="input-block-level required" name="prod_name" />
            </div>

            <div>
                <label>Short Description:</label><br />
                <textarea class="input-block-level required" name="prod_short_desc"></textarea>
            </div>

            <div>
                <label>Long Description:</label><br />
                <textarea class="input-block-level required" name="prod_desc"></textarea>
            </div>

            <div>
                <label>Category:</label><br />
                <select class="input-block-level required" name="category">
                    <?php echo $category; ?>
                </select>
            </div>

            <div>
                <label>Product Type:</label><br />
                <select class="input-block-level required" name="prod_type">
                    <?php echo $prod_type; ?>
                </select>
            </div>

            <div>
                <label>Price Type:</label><br />
                <select class="input-block-level required" name="price_type" id="price_type">
                    <?php echo $price_type; ?>
                </select>
            </div>

            <div style='display: none' id="price_div">
                <label>Product Price:</label><br />
                <input type="text" class="input-block-level" name="prod_price" />
                <input type="text" class="input-block-level" name="prod_dis" placeholder="Discount" style="display: none;"/>
            </div>
            <button class="btn btn-warning" name="submit" type="submit">Create Product</button>
        </form>
    </div>
</div>