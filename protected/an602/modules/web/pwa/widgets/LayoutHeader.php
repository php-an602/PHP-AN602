<?php

/**
 * @link https://metamz.network/
 * @copyright Copyright (c) 2019 PHP-AN602, The 86it Developers Network, Yii, and H u m H u b
 * @license https://www.metamz.network/licences
 */

namespace an602\modules\web\pwa\widgets;

use Yii;
use yii\base\WidgetEvent;
use yii\helpers\Url;
use an602\components\Widget;
use an602\modules\web\Module;
use an602\modules\ui\view\components\View;

/**
 * Class LayoutHeader
 *
 * @package an602\modules\ui\widgets
 */
class LayoutHeader extends Widget
{

    /**
     * Registers mobile app related Head Tags
     *
     * @param View $view
     */
    public static function registerHeadTags(View $view)
    {

        $view->registerMetaTag(['name' => 'theme-color', 'content' => Yii::$app->view->theme->variable('primary')]);
        $view->registerMetaTag(['name' => 'application-name', 'content' => Yii::$app->name]);

        // Apple/IOS headers
        // https://developer.apple.com/library/archive/documentation/AppleApplications/Reference/SafariWebContent/ConfiguringWebApplications/ConfiguringWebApplications.html
        $view->registerMetaTag(['name' => 'apple-mobile-web-app-title', 'content' => Yii::$app->name]);
        $view->registerMetaTag(['name' => 'apple-mobile-web-app-capable', 'content' => 'yes']);
        $view->registerMetaTag(['name' => 'apple-mobile-web-app-status-bar-style', 'content' => Yii::$app->view->theme->variable('primary')]);

        $view->registerLinkTag(['rel' => 'manifest', 'href' => Url::to(['/web/pwa-manifest/index'])]);

        /** @var Module $module */
        $module = Yii::$app->getModule('web');
        if ($module->enableServiceWorker !== false) {
            static::registerServiceWorker($view);
        }
    }

    private static function registerServiceWorker(View $view)
    {
        $cacheId = Yii::$app->cache->getOrSet('service-worker-cache-id', function () {
            return time();
        });
        $serviceWorkUrl = Url::to(['/web/pwa-service-worker/index', 'v' => $cacheId]);
        $rootPath = Yii::getAlias('@web') . '/';

        $view->registerJs(<<<JS
            if ('serviceWorker' in navigator) {
                navigator.serviceWorker.register('$serviceWorkUrl', { scope: '$rootPath' })
                    .then(function (registration) {
                        if (typeof afterServiceWorkerRegistration === "function") {
                            // Allow Modules like `fcm-push` to register after registration
                            afterServiceWorkerRegistration(registration);
                        }
                    })
            }
JS
            , View::POS_READY, 'serviceWorkerInit');

    }

}
