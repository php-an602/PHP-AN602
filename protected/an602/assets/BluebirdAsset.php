<?php

/**
 * @link https://metamz.network/
 * @copyright Copyright (c) 2017 PHP-AN602, The 86it Developers Network, Yii, and H u m H u b GmbH & Co. KG
 * @license https://www.metamz.network/licences
 */

namespace an602\assets;

use an602\components\assets\AssetBundle;
use an602\modules\ui\view\components\View;

/**
 * bluebird promis library
 *
 * @author luke
 */
class BluebirdAsset extends AssetBundle
{
    /**
     * @inheritdoc
     */
    public $defaultDepends = false;

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
    public $sourcePath = '@npm/bluebird';

    /**
     * @inheritdoc
     */
    public $js = ['js/browser/bluebird.min.js'];
}
