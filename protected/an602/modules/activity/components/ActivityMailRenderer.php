<?php

/**
 * @link https://www.php-an602.coders.exchange/
 * @copyright Copyright (c) 2017 Brandon Maintenance Management, LLC
 * @license https://www.php-an602.coders.exchange/licences
 */

namespace an602\modules\activity\components;

use Yii;
use an602\components\rendering\MailLayoutRenderer;

/**
 * MailRenderer for Activity models
 *
 * @since 1.2
 * @author buddha
 */
class ActivityMailRenderer extends MailLayoutRenderer
{

    /**
     * @inheritdoc
     */
    public $subPath = 'mail';

    /**
     * @inheritdoc
     */
    public $layout = '@activity/views/layouts/mail.php';

    /**
     * @inheritdoc
     */
    public $textLayout = '@activity/views/layouts/mail_plaintext.php';

}
