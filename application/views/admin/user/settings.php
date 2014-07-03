<div class="container">
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading">Settings</div>
            <div class="panel-body" style="padding:20px 34px">
                <form class="form-signin" action="user/settings" method="post" id="myForm" enctype="multipart/form-data">
                    <div class="row section description first-section">
                        <div class="col-sm-5">
                            <div class="span6 section-summary">
                                <div>
                                    <h1>Upload Logo</h1>
                                    <p>Upload and edit images of banners. <span data-hideif="imageUploadInProgress">You can also <a class="plain st" data-modal="products/fetch_product_images_modal" data-modal-view="FetchProductImagesModalView" href="#">add images from the web</a>.</span> Drag to reorder images.</p>
                                </div>
                                <div id="queue"></div>
                                <input type="file" name="logo" id="file" />
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="span6 section-summary" style="margin-top:20px;">
                                <div class="row">
                                    <?php
                                    if ($site_det->LOGO != '') {
                                        ?>

                                        <div class="col-xs-6 col-md-3">
                                            <a href="#" class="thumbnail">
                                                <img src="<?php echo $site_det->LOGO ?>" style="width:160px;">
                                            </a>
                                        </div>    

                                        <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row section description first-section">
                        <div class="col-sm-5">
                            <div class="span6 section-summary">
                                <div>
                                    <h1>Store Settings</h1>
                                    <p>Upload and edit images of banners. <span data-hideif="imageUploadInProgress">You can also <a class="plain st" data-modal="products/fetch_product_images_modal" data-modal-view="FetchProductImagesModalView" href="#">add images from the web</a>.</span> Drag to reorder images.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="span6 section-summary" style="margin-top:20px;">
                                <div class="col-sm-6" style="padding-left: 0;">
                                    <label>Store Title</label><br />
                                    <div style="margin-top:7px;">
                                        <input type="text" class="form-control" name="store_title" value="<?php echo (isset($site_det->HEADER_NAME) ? $site_det->HEADER_NAME : ''); ?>"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="progress progress-striped active">
                            <div class="progress-bar"  role="progressbar" aria-valuenow="0" aria-valuemin="0" 
                                 aria-valuemax="100" style="width: 0%">
                                <span class="sr-only">0% Complete</span>
                            </div>
                        </div>
                        <div class="col-sm-3 margin_10" style="float:right;">
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <input type="submit" name="submit" class="btn btn-success" value="Update Settings">
                                </div>
                            </div>
                        </div>
                    </div>
                </form>


                <div class="row section description first-section" style="border-top:1px dashed #e5e5e5; border-bottom:none;padding:20px 28px;">
                    <div class="col-sm-5">
                        <div class="span6 section-summary">
                            <div>
                                <h1>Banners</h1>
                                <p>Upload and edit images of banners. <span data-hideif="imageUploadInProgress">You can also <a class="plain st" data-modal="products/fetch_product_images_modal" data-modal-view="FetchProductImagesModalView" href="#">add images from the web</a>.</span> Drag to reorder images.</p>
                            </div>
                            <div id="queue"></div>
                            <input id="file_upload" name="file_upload" type="file" multiple="true">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="span6 section-summary" style="margin-top:20px;">
                            <div class="row" id="image_view">
                                <?php
                                $path = 'uploads/' . $ses_det['user_id'] . '/';
                                $full_path = $path . 'banner/';
                                if ($site_det->BANNERS != '') {
                                    $imgArr = explode(';', $site_det->BANNERS);
                                    foreach ($imgArr as $img) {
                                        ?>
                                        <div class="col-xs-6 col-md-3">
                                            <a href="<?php echo $full_path . $img; ?>" class="example-image-link thumbnail" data-lightbox="example-set">
                                                <img class="example-image" src="<?php echo $full_path . $img; ?>" style="width:160px;">
                                            </a>
                                            <div class="right"><a href="#" class="del_banner_img" data-ref="<?php echo $img; ?>"><img src="images/icon_delete13.gif" alt="Delete Banner image" title="Delete Banner Image" /></a></div>
                                        </div>    
                                        <?php
                                    }
                                }
                                ?>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>



        <script type="text/javascript">
<?php $timestamp = time(); ?>
            $(function() {
                $('#file_upload').uploadify({
                    formData: {
                        'timestamp': '<?php echo $timestamp; ?>',
                        'token': '<?php echo md5('unique_salt' . $timestamp); ?>',
                        'change_name': '1',
                        'thumb': '0',
                        'path': '<?php echo $path; ?>'
                    },
                    swf: 'images/uploadify.swf',
                    uploader: '<?php echo base_url(); ?>admin/upload_banner/',
                    onUploadSuccess: function(file, data, response) {
                        if (response) {
                            var str = '<div class="col-xs-6 col-md-3">\n\
                                    <a href="#" class="thumbnail">\n\
                                        <img src="<?php echo $full_path; ?>' + data + '" style="width:160px;">\n\
                                    </a>\n\
                                    <div class="right"><a href="#" class="del_prod_img" data-ref="' + data + '"><img src="images/icon_delete13.gif" alt="Delete Product image" title="Delete Product Image" /></a></div>\n\
                                </div>';
                            $("#image_view").append(str);
                        }
                    }
                });
            });
        </script>    