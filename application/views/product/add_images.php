<div class="container">
    <div class="row">
        <?php echo form_open_multipart('', array('id' => 'imageForm', 'class' => 'form-signin')); ?>
        <div>
            <label>Select Number of images to be upload : </label>
            <select name="img_count" class="input-block-level">
                <option value="">-</option>
                <?php
                for ($i = 1; $i <= 5; $i++) {
                    echo '<option value="' . $i . '">' . $i . '</option>';
                }
                ?>
            </select>
        </div>
        <div>
            <input type='checkbox' name="auto_thumb" checked="true"/> Create Auto Thumbnail
        </div>
        <div id="img_data"></div>
        <input type="submit" name="submit" class="btn btn-success" value="Upload Images">
        <?php echo form_close(); ?>
        <div class="progress progress-striped active">
            <div class="progress-bar"  role="progressbar" aria-valuenow="0" aria-valuemin="0" 
                 aria-valuemax="100" style="width: 0%">
                <span class="sr-only">0% Complete</span>
            </div>
        </div>
    </div>
</div>