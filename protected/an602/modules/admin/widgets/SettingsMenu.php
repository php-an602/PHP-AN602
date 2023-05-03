<?php

/**
 * @link https://www.php-an602.coders.exchange/
 * @copyright Copyright (c) 2017 Brandon Maintenance Management, LLC
 * @license https://www.php-an602.coders.exchange/licences
 */

namespace an602\modules\admin\widgets;

use Yii;
use an602\modules\ui\menu\MenuLink;
use an602\modules\ui\menu\widgets\TabMenu;
use an602\modules\admin\permissions\ManageSettings;

/**
 * Group Administration Menu
 */
class SettingsMenu extends TabMenu
{

    /**
     * @inheritdoc
     */
    public function init()
    {
        $canEditSettings = Yii::$app->user->can(ManageSettings::class);

        $this->addEntry(new MenuLink([
            'label' => Yii::t('AdminModule.base', 'General'),
            'url' => ['/admin/setting/index'],
            'sortOrder' => 100,
            'isActive' => MenuLink::isActiveState('admin', 'setting', 'basic'),
            'isVisible' => $canEditSettings
        ]));

        $this->addEntry(new MenuLink([
            'label' => Yii::t('AdminModule.base', 'Appearance'),
            'url' => ['/admin/setting/design'],
            'sortOrder' => 200,
            'isActive' => MenuLink::isActiveState('admin', 'setting', 'design'),
            'isVisible' => $canEditSettings
        ]));

        $this->addEntry(new MenuLink([
            'label' => Yii::t('AdminModule.base', 'Notifications'),
            'url' => ['/notification/admin/defaults'],
            'sortOrder' => 400,
            'isActive' => MenuLink::isActiveState('notification', 'admin', 'defaults'),
            'isVisible' => $canEditSettings
        ]));

        $this->addEntry(new MenuLink([
            'label' => Yii::t('AdminModule.base', 'Advanced'),
            'url' => ['/admin/setting/advanced'],
            'sortOrder' => 1000,
            'isVisible' => $canEditSettings
        ]));

        parent::init();
    }

}