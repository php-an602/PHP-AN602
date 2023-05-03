<?php

namespace an602\modules\comment;

use an602\modules\comment\models\Comment;
use an602\modules\comment\permissions\CreateComment;
use an602\modules\comment\notifications\NewComment;
use an602\modules\content\components\ContentActiveRecord;
use Yii;

/**
 * CommentModule adds the comment content addon functionalities.
 *
 * @package an602.modules_core.comment
 * @since 0.5
 */
class Module extends \an602\components\Module
{

    /**
     * Maximum comments to load at once
     *
     * @var int
     */
    public $commentsBlockLoadSize = 10;

    /**
     * @var int maximum comments to show initially
     */
    public $commentsPreviewMax = 2;

    /**
     * @var int Maximum comments to load at once on VIEW mode
     */
    public $commentsBlockLoadSizeViewMode = 25;

    /**
     * @var int Maximum comments to show initially on VIEW mode
     */
    public $commentsPreviewMaxViewMode = 25;

    /**
     * @inheritdoc
     */
    public function getPermissions($contentContainer = null)
    {
        if ($contentContainer) {
            return [
                new permissions\CreateComment()
            ];
        }

        return [];
    }

    /**
     * @inheritdoc
     */
    public function getName()
    {
        return Yii::t('CommentModule.base', 'Comments');
    }

    /**
     * @inheritdoc
     */
    public function getNotifications()
    {
        return [
            NewComment::class
        ];
    }

    /**
     * Checks if given content object can be commented by current user
     *
     * @param Comment|ContentActiveRecord $object
     * @return boolean can comment
     * @throws \yii\base\Exception
     * @throws \yii\base\InvalidConfigException
     */
    public function canComment($object)
    {
        if (Yii::$app->user->isGuest) {
            return false;
        }

        $content = $object->content;

        if ($content->container) {
            if (!$content->container->permissionManager->can(CreateComment::class)) {
                return false;
            }
        }

        if ($content->isLockedComments()) {
            return false;
        }

        if ($content->isArchived()) {
            return false;
        }

        return true;
    }
}