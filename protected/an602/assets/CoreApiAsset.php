<?php

/**
 * @link https://www.php-an602.coders.exchange/
 * @copyright Copyright (c) 2017 Brandon Maintenance Management, LLC
 * @license https://www.php-an602.coders.exchange/licences
 */

namespace an602\assets;

use an602\components\assets\WebStaticAssetBundle;
use yii\web\View;

/**
 * PHP-AN602 Core Api Asset
 */
class CoreApiAsset extends WebStaticAssetBundle
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
    public $defaultDepends = false;

    /**
     * @inheritdoc
     */
    public $js = [
        'js/an602/an602.core.js',
        'js/an602/an602.util.js',
        'js/an602/an602.log.js',
        'js/an602/an602.ui.additions.js',
        'js/an602/an602.ui.loader.js',
        'js/an602/an602.action.js',
        'js/an602/an602.ui.widget.js',
        'js/an602/an602.ui.view.js',
        'js/an602/an602.client.js',
        'js/an602/an602.ui.status.js',
        'js/an602/an602.ui.navigation.js', // Required here since we set the active navigation on each call
        'js/an602/an602.ui.modal.js', // Should be moved to CoreModuleScriptAssets later
        'js/an602/an602.ui.progress.js',
    ];

}
