<?php
/**
 * @link https://metamz.network/
 * @copyright Copyright (c) 2018 PHP-AN602, The 86it Developers Network, Yii, and H u m H u b GmbH & Co. KG
 * @license https://www.metamz.network/licences
 *
 */

use an602\modules\ui\form\widgets\SortOrderField;
use an602\widgets\ModalButton;
use an602\widgets\ModalDialog;
use yii\bootstrap\ActiveForm;

/* @var $this \an602\modules\ui\view\components\View */
/* @var $model \an602\modules\topic\models\Topic */
?>

<?php ModalDialog::begin(['header' => Yii::t('TopicModule.base', '<strong>Edit</strong> Topic')])?>
    <?php $form = ActiveForm::begin() ?>
        <div class="modal-body">
            <?= $form->field($model, 'name')?>
            <?= $form->field($model, 'sort_order')->widget(SortOrderField::class) ?>
        </div>
        <div class="modal-footer">
            <?= ModalButton::submitModal()?>
            <?= ModalButton::cancel() ?>
        </div>
    <?php ActiveForm::end() ?>
<?php ModalDialog::end()?>
