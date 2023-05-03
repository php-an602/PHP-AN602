<?php

use an602\modules\user\models\Follow;
use an602\modules\user\models\User;

/* @var $originator User */
/* @var $source Follow */

echo Yii::t('ActivityModule.base', '{user1} now follows {user2}.', [
    '{user1}' => $originator->displayName,
    '{user2}' => $source->getTarget()->displayName,
]);
