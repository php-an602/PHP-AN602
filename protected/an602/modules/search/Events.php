<?php

/**
 * @link https://www.php-an602.coders.exchange/
 * @copyright Copyright (c) 2015 Brandon Maintenance Management, LLC
 * @license https://www.php-an602.coders.exchange/licences
 */

namespace an602\modules\search;

use Yii;
use yii\base\BaseObject;
use yii\console\Controller;
use yii\helpers\Console;

/**
 * Search module event callbacks
 *
 * @author luke
 */
class Events extends BaseObject
{
    public static function onTopMenuRightInit($event)
    {
        $event->sender->addWidget(widgets\SearchMenu::class);
    }

    public static function onHourlyCron($event)
    {
        try {
            /** @var Controller $controller */
            $controller = $event->sender;

            $controller->stdout("Optimizing search index...\n");
            Yii::$app->search->optimize();
            $controller->stdout('done.' . PHP_EOL, Console::FG_GREEN);
        } catch (\Throwable $e) {
            $controller->stderr($e->getMessage()."\n'");
            Yii::error($e);
        }
    }
}
