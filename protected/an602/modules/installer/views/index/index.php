<?php

use yii\helpers\Html;
use yii\helpers\Url;
?>

<div class="panel panel-default animated fadeIn">

    <div class="panel-body text-center">
        <br>
        <br>
        <p class="lead"><?php echo Yii::t('InstallerModule.base', '<strong>Welcome</strong> to an602<br>Your Social Network Toolbox'); ?></p>
        <p><?php echo Yii::t('InstallerModule.base', 'This wizard will install and configure your own an602 instance.<br><br>To continue, click Next.'); ?></p>
        <br>
        <hr>
        <br>
        <?php echo Html::a(Yii::t('InstallerModule.base', "Next") . ' <i class="fa fa-arrow-circle-right"></i>', Url::to(['go']), ['class' => 'btn btn-lg btn-primary', 'data-ui-loader' => '']); ?>
        <br>
        <br>
    </div>


</div>

<?php echo an602\widgets\LanguageChooser::widget(); ?>
