<?php

/**
 * @link https://metamz.network/
 * @copyright Copyright (c) 2017 PHP-AN602, The 86it Developers Network, Yii, and H u m H u b
 * @license https://www.metamz.network/licences
 */

/* @var $this yii\web\View */
/* @var $viewable an602\modules\space\notifications\ApprovalRequestApproved */
/* @var $url string */
/* @var $date string */
/* @var $isNew boolean */
/* @var $isNew boolean */
/* @var $originator \an602\modules\user\models\User */
/* @var source yii\db\ActiveRecord */
/* @var contentContainer \an602\modules\content\components\ContentContainerActiveRecord */
/* @var space an602\modules\space\models\Space */
/* @var record \an602\modules\notification\models\Notification */
/* @var html string */
/* @var text string */
?>

<?php $this->beginContent('@notification/views/layouts/mail.php', $_params_); ?>
    <table width="100%" border="0" cellspacing="0" cellpadding="0" align="left">
        <tr>
            <td style="font-size: 14px; line-height: 22px; font-family:Open Sans,Arial,Tahoma, Helvetica, sans-serif; color:<?= Yii::$app->view->theme->variable('text-color-highlight', '#555555') ?>; font-weight:300; text-align:center;">
                <?= $viewable->html(); ?>
            </td>
        </tr>
        <tr>
            <td height="20"></td>
        </tr>
        <tr>
            <td>
                <?=

                \an602\widgets\mails\MailButtonList::widget(['buttons' => [
                        an602\widgets\mails\MailButton::widget(['url' => $url, 'text' => Yii::t('SpaceModule.notification', 'View Online')])
                ]]);

                ?>
            </td>
        </tr>
    </table>
<?php $this->endContent();
