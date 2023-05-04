<?php

/**
 * @link https://metamz.network/
 * @copyright Copyright (c) 2017 PHP-AN602, The 86it Developers Network, Yii, and H u m H u b
 * @license https://www.metamz.network/licences
 */

namespace an602\assets;

use an602\components\assets\AssetBundle;

/**
 * animate.css
 *
 * @author buddha
 */
class SwipedEventsAssets extends AssetBundle
{

    /**
     * @inheritdoc
     */
    public $sourcePath = '@npm/swiped-events/dist';

    /**
     * @inheritdoc
     */
    public $js = ['swiped-events.min.js'];

}
