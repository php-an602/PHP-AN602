<?php

/**
 * @link https://metamz.network/
 * @copyright Copyright (c) 2015 PHP-AN602, The 86it Developers Network, Yii, and H u m H u b
 * @license https://www.metamz.network/licences
 */

namespace an602\modules\user\assets;

use an602\assets\Select2Asset;
use an602\components\assets\AssetBundle;

class UserPickerAsset extends AssetBundle
{
    /**
     * @inheritdoc
     */
    public $sourcePath = '@user/resources';

    /**
     * @inheritdoc
     */
    public $js = [
        'js/an602.user.picker.js'
    ];

    /**
     * @inheritdoc
     */
    public $depends = [
        Select2Asset::class
    ];
}
