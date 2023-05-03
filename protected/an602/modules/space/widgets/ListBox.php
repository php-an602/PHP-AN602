<?php

/**
 * @link https://www.php-an602.coders.exchange/
 * @copyright Copyright (c) 2016 Brandon Maintenance Management, LLC
 * @license https://www.php-an602.coders.exchange/licences
 */

namespace an602\modules\space\widgets;

use yii\base\Widget;
use yii\data\Pagination;

/**
 * ListBox returns the content of the space list modal
 * 
 * Example Action:
 * 
 * ```php
 * public actionSpaceList() {
 *       $query = Space::find();
 *       $query->where(...);
 *        
 *       $title = "Some Spaces";
 *  
 *       return $this->renderAjaxContent(ListBox::widget(['query' => $query, 'title' => $title]));
 * }
 * ```
 * 
 * @since 1.1
 * @author luke
 */
class ListBox extends Widget
{

    /**
     * @var \yii\db\ActiveQuery
     */
    public $query;

    /**
     * @var string title of the box (not html encoded!)
     */
    public $title = 'Spaces';

    /**
     * @var int displayed users per page
     */
    public $pageSize = 25;

    /**
     * @inheritdoc
     */
    public function run()
    {
        $countQuery = clone $this->query;
        $pagination = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => $this->pageSize]);
        $this->query->offset($pagination->offset)->limit($pagination->limit);

        return $this->render('listBox', [
                    'title' => $this->title,
                    'spaces' => $this->query->all(),
                    'pagination' => $pagination
        ]);
    }

}
