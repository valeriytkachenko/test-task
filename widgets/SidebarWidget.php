<?php
namespace app\widgets;
use yii\base\Widget;

/**
* Sidebar widget
*/
class SidebarWidget extends Widget
{
    public $categories;
    public $currentCategory;
    
    function run()
    {   
        return $this->render(
            'sidebar',
        [
            'categories' => $this->categories,
            'currentCategory' => $this->currentCategory,
        ]);
    }
}