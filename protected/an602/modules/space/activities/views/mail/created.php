<?php

use yii\helpers\Html;
use an602\libs\Helpers;

echo Yii::t('ActivityModule.base', "{displayName} created the new space {spaceName}", [
    '{displayName}' => '<strong>' . Html::encode($originator->displayName) . '</strong>',
    '{spaceName}' => '<strong>' . Html::encode(Helpers::truncateText($source->name, 25)) . '</strong>'
]);
?>
<br/>
