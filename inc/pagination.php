<?php if(isset($data) && array_key_exists('pages', $data)): ?>
    <?php if($data['pages'] > 1): ?>
        <?php $currentPage = isset($_GET['page'])? $_GET['page']:1 ?>
        <?php
        $order='';
        if(isset($_GET['order']))
            $order = '&'.$_GET['order'];
        ?>
        <ul class="uk-pagination uk-flex-center" uk-margin>
            <?php if($currentPage > 1): ?>
                <li><a href="/<?php echo $adminPanel?><?php echo $order?>"><span uk-pagination-previous></span></a></li>
            <?php endif ?>
            <?php for ($i = 1; $i <= $data['pages']; $i++): ?>

                <?php if($currentPage == $i): ?>
                    <li class="uk-active"><span><?php echo $i ?></span></li>
                <?php else: ?>
                    <li><a href="/<?php echo $adminPanel?>?page=<?php echo $i ?><?php echo $order?>"><?php echo $i ?></a></li>
                <?php endif?>

            <?php endfor ?>
            <?php if($currentPage < $data['pages']): ?>
                <li><a href="/<?php echo $adminPanel?>?page=<?php echo $data['pages'] ?><?php echo $order?>"><span uk-pagination-next></span></a></li>
            <?php endif ?>
        </ul>
    <?php endif ?>
<?php endif ?>
