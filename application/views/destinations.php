<div class="col-md-12">
    <div class="row">

        <?php
        foreach ($results as $item) {

            for ($i = 1; $i <= 5; $i++) {
                if ($i <= $item['rating']) {
                    $item['rating' . $i] = '';
                } else {
                    $item['rating' . $i] = '-empty';
                }
            }

            $item['size'] = 3;
            
            extract($item);
           
            include ('templates/destination.php');
        }
        ?>
    </div>
</div>