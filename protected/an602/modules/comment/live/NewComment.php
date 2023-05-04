<?php

/**
 * @link https://metamz.network/
 * @copyright Copyright (c) 2017 PHP-AN602, The 86it Developers Network, Yii, and H u m H u b
 * @license https://www.metamz.network/licences
 */

namespace an602\modules\comment\live;

use an602\modules\live\components\LiveEvent;

/**
 * Live event for new comments
 *
 * @since 1.2
 */
class NewComment extends LiveEvent
{

    /**
     * @var int the id of the new comment
     */
    public $commentId;

    /**
     * @var int the id of the content
     */
    public $contentId;

}
