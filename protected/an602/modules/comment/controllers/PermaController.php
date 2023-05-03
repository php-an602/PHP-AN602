<?php
/**
 * @link https://www.php-an602.coders.exchange/
 * @copyright Copyright (c) 2021 Brandon Maintenance Management, LLC
 * @license https://www.php-an602.coders.exchange/licences
 */

namespace an602\modules\comment\controllers;

use an602\components\Controller;
use an602\modules\comment\models\Comment;
use yii\web\NotFoundHttpException;

/**
 * PermaController provides URL to view a Comment.
 *
 * @package an602.modules_core.comment.controllers
 * @since 1.10
 */
class PermaController extends Controller
{

    /**
     * Action to process comment permalink URL
     *
     * @param $id
     * @return \yii\console\Response|\yii\web\Response
     * @throws NotFoundHttpException
     */
    public function actionIndex($id)
    {
        $comment = Comment::findOne(['id' => $id]);

        if (!$comment || !$comment->content || !$comment->canRead()) {
            throw new NotFoundHttpException();
        }

        $content = $comment->content;
        if ($content->container !== null) {
            return $this->redirect($content->container->createUrl(null, [
                'contentId' => $comment->content->id,
                'commentId' => $comment->id,
            ]));
        }
        if (method_exists($content->getPolymorphicRelation(), 'getUrl')) {
            return $this->redirect($content->getPolymorphicRelation()->getUrl());
        }
    }

}
