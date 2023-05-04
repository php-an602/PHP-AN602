<?php

/**
 * @link https://metamz.network/
 * @copyright Copyright (c) 2015 PHP-AN602, The 86it Developers Network, Yii, and H u m H u b
 * @license https://www.metamz.network/licences
 */

namespace an602\modules\content\assets;

use an602\components\assets\AssetBundle;

/**
 * Content container asset for shared user/space js functionality.
 *
 * @since 1.2
 * @author buddha
 */
class ContentContainerAsset extends AssetBundle
{

    /**
     * @inheritdoc
     */
    public $sourcePath = '@content/resources';

    /**
     * @inheritdoc
     */
    public $js = [
        'js/an602.content.container.js'
    ];

}
