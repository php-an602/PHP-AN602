<?php

/**
 * @link https://metamz.network/
 * @copyright Copyright (c) 2015 PHP-AN602, The 86it Developers Network, Yii, and H u m H u b
 * @license https://www.metamz.network/licences
 */

namespace an602\modules\tour\assets;

use Yii;
use yii\helpers\Url;
use yii\web\AssetBundle;
use an602\modules\ui\view\components\View;

/**
 * Stream related assets.
 *
 * @since 1.2
 * @author buddha
 */
class TourAsset extends AssetBundle
{
    /**
     * @inheritdoc
     */
    public $sourcePath = '@tour/resources';

    /**
     * @inheritdoc
     */
    public $publishOptions = ['forceCopy' => false];

    /**
     * @inheritdoc
     */
    public $js = [
        'js/bootstrap-tourist.min.js',
        'js/an602.tour.js'
    ];

    public $css = [
        'css/bootstrap-tourist.min.css'
    ];

    /**
     * @param View $view
     * @return AssetBundle
     */
    public static function register($view)
    {
        $view->registerJsConfig('tour', [
            'dashboardUrl' => Url::to(['/dashboard/dashboard']),
            'completedUrl' => Url::to(['/tour/tour/tour-completed']),
            'template' => '<div class="popover tour" role="tooltip"> <div class="arrow"></div> <h3 class="popover-title"></h3> <div class="popover-content"></div> <div class="popover-navigation"> <div class="btn-group"> <button class="btn btn-sm btn-default" data-role="prev">' . Yii::t('TourModule.base', '« Prev') . '</button> <button class="btn btn-sm btn-default" data-role="next">' . Yii::t('TourModule.base', 'Next »') . '</button> <button class="btn btn-sm btn-default" data-role="pause-resume" data-pause-text="Pause" data-resume-text="Resume">Pause</button> </div> <button class="btn btn-sm btn-default" data-role="end">' . Yii::t('TourModule.base', 'End guide') . '</button> </div> </div>'
        ]);

        return parent::register($view);
    }
}
