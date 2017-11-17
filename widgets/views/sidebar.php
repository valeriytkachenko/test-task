 <!--Sidebar-->
<div class="col-md-4">
    <div class="widget-wrapper">
        <h3>Categories:</h3>
        <br>
        <div class="list-group">
        <!--<a href="#" class="list-group-item active">Woman</a>-->
            <?php  foreach ($categories as $category):?>
                <?php if($category->id === $currentCategory->id):?>
                    <a href="<?=\Yii::$app->request->BaseUrl?>/category/<?=$category->id?>" class="list-group-item active"><?=$category->name?></a>
                <?php else:?>
                    <a href="<?=\Yii::$app->request->BaseUrl?>/category/<?=$category->id?>" class="list-group-item"><?=$category->name?></a>
                <?php endif;?>
            <?php endforeach;?>
        </div>
    </div>  
</div>
<!--/.Sidebar-->