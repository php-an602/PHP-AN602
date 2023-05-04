<?php
/**
 * @link https://metamz.network/
 * @copyright Copyright (c) 2018 PHP-AN602, The 86it Developers Network, Yii, and H u m H u b
 * @license https://www.metamz.network/licences
 */

use an602\modules\ui\menu\MenuLink;
use an602\widgets\PoweredBy;
use yii\helpers\Html;

/* @var $this \an602\modules\ui\view\components\View */
/* @var $entries MenuLink[] */
/* @var $options array */
/* @var $menu \an602\widgets\FooterMenu */

?>

<?php if (!empty($entries)): ?>
    <div class="text-center footer-nav footer-nav-default">
        <small>
            <?php foreach ($entries as $k => $entry): ?>
                <?php if ($entry instanceof MenuLink): ?>
                    <?= Html::a($entry->getLabel(), $entry->getUrl(), $entry->getHtmlOptions()); ?>

                    <?php if (!PoweredBy::isHidden() || array_key_last($entries) !== $k): ?>
                        &nbsp;&middot;&nbsp;
                    <?php endif; ?>
                <?php endif; ?>
            <?php endforeach; ?>

            <?= PoweredBy::widget(); ?>
        </small>
    </div>
    <br/>
<?php endif; ?>
