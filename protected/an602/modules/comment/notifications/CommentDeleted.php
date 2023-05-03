<?php

/**
 * @link https://www.php-an602.coders.exchange/
 * @copyright Copyright (c) 2017 Brandon Maintenance Management, LLC
 * @license https://www.php-an602.coders.exchange/licences
 */

namespace an602\modules\comment\notifications;

use an602\modules\comment\models\Comment;
use an602\modules\content\components\ContentActiveRecord;
use an602\modules\content\widgets\richtext\converter\RichTextToShortTextConverter;
use an602\modules\notification\components\BaseNotification;
use an602\modules\notification\models\Notification;
use an602\modules\user\models\User;
use an602\modules\user\notifications\Mentioned;
use Yii;
use yii\bootstrap\Html;
use yii\helpers\Json;

/**
 * CommentDeletedNotification is fired when admin deletes a comment
 */
class CommentDeleted extends BaseNotification
{
    /**
     * @inheritdoc
     */
    public $requireSource = false;

    /**
     * @inheritdoc
     */
    public $moduleId = 'comment';

    /**
     * @inheritdoc
     */
    public function category()
    {
        return new CommentNotificationCategory();
    }

    /**
     * @inheritdoc
     */
    public function html()
    {
        return Yii::t('CommentModule.notifications', 'Your comment \'{commentText}\' has been deleted by {displayName} for \'{reason}\'', [
            'displayName' => Html::tag('strong', Html::encode($this->originator->displayName)),
            'commentText' => $this->payload['commentText'],
            'reason' => $this->payload['reason'],
        ]);
    }

}
