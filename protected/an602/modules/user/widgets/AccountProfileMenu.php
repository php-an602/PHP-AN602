<?php

/**
 * @link https://www.php-an602.coders.exchange/
 * @copyright Copyright (c) 2015 Brandon Maintenance Management, LLC
 * @license https://www.php-an602.coders.exchange/licences
 */

namespace an602\modules\user\widgets;

use Yii;
use an602\modules\ui\menu\MenuLink;
use an602\modules\ui\menu\widgets\TabMenu;

/**
 * Account Settings Tab Menu
 */
class AccountProfileMenu extends TabMenu
{

    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->addEntry(new MenuLink([
            'label' => Yii::t('UserModule.base', 'General'),
            'url' => ['/user/account/edit'],
            'sortOrder' => 100,
            'isActive' => MenuLink::isActiveState('user', 'account', 'edit')
        ]));

        $this->addEntry(new MenuLink([
            'label' => Yii::t('UserModule.base', 'Change Username'),
            'url' => ['/user/account/change-username'],
            'sortOrder' => 200,
            'isActive' => MenuLink::isActiveState('user', 'account', 'change-username'),
            'isVisible' => Yii::$app->user->getAuthClientUserService()->canChangeUsername()
        ]));

        $this->addEntry(new MenuLink([
            'label' => Yii::t('UserModule.base', 'Change Email'),
            'url' => ['/user/account/change-email'],
            'sortOrder' => 200,
            'isActive' => MenuLink::isActiveState('user', 'account', ['change-email', 'change-email-validate']),
            'isVisible' => Yii::$app->user->getAuthClientUserService()->canChangeEmail()
        ]));

        $this->addEntry(new MenuLink([
            'label' => Yii::t('UserModule.base', 'Change Password'),
            'url' => ['/user/account/change-password'],
            'sortOrder' => 400,
            'isActive' => MenuLink::isActiveState('user', 'account', 'change-password'),
            'isVisible' => Yii::$app->user->getAuthClientUserService()->canChangePassword()
        ]));

        $this->addEntry(new MenuLink([
            'label' => Yii::t('UserModule.base', 'Delete Account'),
            'url' => ['/user/account/delete'],
            'sortOrder' => 500,
            'isActive' => MenuLink::isActiveState('user', 'account', 'delete'),
            'isVisible' => Yii::$app->user->getAuthClientUserService()->canDeleteAccount()
        ]));

        parent::init();
    }
}
