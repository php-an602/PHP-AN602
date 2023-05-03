<?php

/**
 * @link https://www.php-an602.coders.exchange/
 * @copyright Copyright (c) 2015 Brandon Maintenance Management, LLC
 * @license https://www.php-an602.coders.exchange/licences
 */

namespace an602\modules\admin\events;

use yii\base\Event;

/**
 * This event is used when an object is added to search index
 *
 * @author luke
 * @since 0.21
 */
class FetchReloadableScriptsEvent extends Event
{

    /**
     * @var array Reference to the currently added search attributes
     */
    public $urls = [];

    public function addScriptUrl($urls)
    {
        $this->urls[] = $urls;
    }

}
