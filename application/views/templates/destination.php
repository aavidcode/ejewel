<div class="col-sm-<?= $size ?> col-lg-<?= $size ?> col-md-<?= $size ?>">
            <div class="thumbnail">
                <img src="/<?= $thumb ?>" alt="">
                <div class="caption">
                    <h4 class="pull-right">$<?= $price ?></h4>
                    <h4><a href="#"><?= $city ?></a>
                    </h4>
                    <p><?= $short_desc ?></p>
                </div>
                <div class="ratings">
                    <p class="pull-right"><?= $reviews ?> reviews</p>
                    <p>
                        <span class="glyphicon glyphicon-star<?= $rating1 ?>"></span>
                        <span class="glyphicon glyphicon-star<?= $rating2 ?>"></span>
                        <span class="glyphicon glyphicon-star<?= $rating3 ?>"></span>
                        <span class="glyphicon glyphicon-star<?= $rating4 ?>"></span>
                        <span class="glyphicon glyphicon-star<?= $rating5 ?>"></span>
                    </p>
                </div>
            </div>
        </div>