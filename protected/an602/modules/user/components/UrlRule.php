<?php

/**
 * @link https://metamz.network/
 * @copyright Copyright (c) 2017 PHP-AN602, The 86it Developers Network, Yii, and H u m H u b
 * @license https://www.metamz.network/licences
 */

namespace an602\modules\user\components;

use an602\components\ContentContainerUrlRule;
use an602\modules\content\components\ContentContainerActiveRecord;
use an602\modules\user\models\User;

/**
 * User Profile URL Rule
 *
 * @author luke
 */
class UrlRule extends ContentContainerUrlRule
{

    /**
     * @inheritdoc
     */
    protected $defaultRoute = 'user/profile';

    /**
     * @inheritdoc
     */
    protected $urlPrefix = 'u';

    /**
     * @inheritdoc
     */
    protected $routePrefixes = ['<contentContainer>', '<userContainer>'];

    /**
     * @inheritdoc
     */
    public static $containerUrlMap = [];

    /**
     * @inheritdoc
     */
    protected static function getContentContainerByUrl(string $url): ?ContentContainerActiveRecord
    {
        return User::find()->where(['username' => $url])->one();
    }

    /**
     * @inheritdoc
     */
    protected static function getContentContainerByGuid(string $guid): ?ContentContainerActiveRecord
    {
        return User::findOne(['guid' => $guid]);
    }

    /**
     * @inheritdoc
     */
    protected static function getUrlMapFromContentContainer(ContentContainerActiveRecord $contentContainer): ?string
    {
        return $contentContainer->username ?? null;
    }

    /**
     * @inheritdoc
     */
    protected static function isContentContainerInstance(ContentContainerActiveRecord $contentContainer): bool
    {
        return ($contentContainer instanceof User);
    }

}
