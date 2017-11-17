<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\widgets\LinkPager;
use app\widgets\SidebarWidget;
$this->title = 'MyHomeLib';
?>
<div class="site-index">
    <div class="body-content">
        <!--Main layout-->
        <div class="container">
            <div class="row">

                <?= SidebarWidget::widget([
                    'categories' => $categories,
                    'currentCategory' => $currentCategory,
                ]);?>

                <!--Main column-->
                <div class="col-md-8">
                    <!--First row-->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="divider-new">
                                <h2 class="h2-responsive">Library</h2>
                            </div>
                            
                        </div>
                    </div>
                    <!--/.First row-->
                    <br>
                    <hr class="extra-margins">
                    
                    <div class="row text-center row-flex">
                        <?php  foreach ($books as $book):?>
                            <div class="col-lg-4 col-md-6 mb-4">
                                <div class="card">
                                    <img class="card-image" src="<?=\Yii::$app->request->BaseUrl?>/uploads/images/<?=$book->image?>" alt="<?=$book->name?>">
                                    <div class="card-body">
                                        <h4 class="card-title"><?=$book->name?></h4>
                                       <p class="card-author"><?=$book->author?></p>
                                        <p class="card-text"><?=mb_substr($book->description,0,100,'UTF-8').'...'?></p>
                                    </div>
                                    <div class="card-footer">
                                        <a href="#" class="btn btn-primary">More</a>
                                    </div>
                                </div>
                            </div>
                        <?php  endforeach;?>
                    </div>

                    <div class="text-center">
                        <?php echo LinkPager::widget(['pagination' => $pages]);?>
                    </div>

                </div>
                <!--/.Main column-->
            </div>
        </div>
        <!--/.Main layout-->
    </div>
</div>
