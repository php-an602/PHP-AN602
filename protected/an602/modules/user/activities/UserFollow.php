<?php

/**
 * @link https://www.php-an602.coders.exchange/
 * @copyright Copyright (c) 2015 Brandon Maintenance Management, LLC
 * @license https://www.php-an602.coders.exchange/licences
 */

namespace an602\modules\user\activities;

use an602\modules\activity\components\BaseActivity;
use an602\modules\activity\interfaces\ConfigurableActivityInterface;
use an602\modules\content\models\Content;
use Yii;

/**
 * Activity when somebody follows an object
 *
 * @author luke
 */
class UserFollow extends BaseActivity implements ConfigurableActivityInterface
{

    /**
     * @inheritdoc
     */
    public $moduleId = 'user';

    /**
     * @inheritdoc
     */
    public $viewName = "userFollow";

    /**
     * @inheritdoc
     */
    public $visibility = Content::VISIBILITY_PUBLIC;

    /**
     * @inheritdoc
     */
    public function getUrl()
    {
        return $this->source->target->getUrl();
    }

    /**
     * @inheritdoc
     */
    public function getTitle()
    {
        return Yii::t('UserModule.base', 'Following (User)');
    }

    /**
     * @inheritdoc
     */
    public function getDescription()
    {
        return Yii::t('UserModule.base', 'Whenever a user follows another user.');
    }
}
