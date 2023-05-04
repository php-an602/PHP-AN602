<?php

/**
 * @link https://metamz.network/
 * @copyright Copyright (c) 2015 PHP-AN602, The 86it Developers Network, Yii, and H u m H u b
 * @license https://www.metamz.network/licences
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
