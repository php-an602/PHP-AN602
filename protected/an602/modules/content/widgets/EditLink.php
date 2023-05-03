<?php

/**
 * @link https://www.php-an602.coders.exchange/
 * @copyright Copyright (c) 2015 Brandon Maintenance Management, LLC
 * @license https://www.php-an602.coders.exchange/licences
 */

namespace an602\modules\content\widgets;

use an602\libs\BasePermission;

/**
 * Edit Link for Wall Entries
 *
 * This widget will attached to the WallEntryControlsWidget and displays
 * the "Edit" Link to the Content Objects.
 *
 * @package an602.modules_core.wall.widgets
 * @since 0.10
 */
class EditLink extends \yii\base\Widget
{

    /**
     * @var \an602\modules\content\components\ContentActiveRecord
     */
    public $model = null;

    /**
     * @var string edit route.
     */
    public $url;
    
    /**
     * @var defines the edit type of the wallentry
     */
    public $mode;


    /**
     * Executes the widget.
     */
    public function run()
    {
        if(!$this->url) {
            return;
        }

        if ($this->model->content->canEdit()) {
            return $this->render('editLink', [
                        'editUrl' => $this->url,
                        'mode' => $this->mode
            ]);
        }
    }

}

?>