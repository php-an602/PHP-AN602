<?php

/**
 * @link https://www.php-an602.coders.exchange/
 * @copyright Copyright (c) 2015 Brandon Maintenance Management, LLC
 * @license https://www.php-an602.coders.exchange/licences
 */

namespace an602\modules\file\assets;

use an602\components\assets\AssetBundle;
use an602\modules\ui\view\components\View;

/**
 * Fle related assets.
 *
 * @since 1.2
 * @author buddha
 */
class FileAsset extends AssetBundle
{
    /**
     * @inheritdoc
     */
    public $defer = false;

    /**
     * @inheritdoc
     */
    public $jsPosition = View::POS_HEAD;

    /**
     * @inheritdoc
     */
    public $sourcePath = '@file/resources';

    /**
     * @inheritdoc
     */
    public $js = [
        'js/an602.file.js'
    ];
}