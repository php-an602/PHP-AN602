<?php

/**
 * @link https://www.php-an602.coders.exchange/
 * @copyright Copyright (c) 2017 Brandon Maintenance Management, LLC
 * @license https://www.php-an602.coders.exchange/licences
 */

namespace an602\modules\space\controllers;

use an602\modules\content\components\ContentContainerController;
use an602\components\behaviors\AccessControl;
use an602\modules\content\widgets\WallCreateContentMenu;
use an602\modules\space\models\Space;
use an602\modules\space\widgets\Chooser;
use an602\modules\user\models\User;
use an602\modules\user\widgets\UserListBox;
use an602\modules\stream\actions\ContentContainerStream;
use an602\modules\space\widgets\Menu;
use Yii;
use yii\web\HttpException;
use yii\db\Expression;

/**
 * SpaceController is the main controller for spaces.
 *
 * It show the space itself and handles all related tasks like following or
 * memberships.
 *
 * @property-read Space $contentContainer
 *
 * @author Luke
 * @package an602.modules_core.space.controllers
 * @since 0.5
 */
class SpaceController extends ContentContainerController
{

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'acl' => [
                'class' => AccessControl::class,
                'guestAllowedActions' => ['index', 'home', 'stream', 'about'],
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'stream' => [
                'class' => ContentContainerStream::class,
                'contentContainer' => $this->contentContainer
            ],
        ];
    }

    /**
     * Generic Start Action for Profile
     * @throws \yii\base\InvalidConfigException
     */
    public function actionIndex()
    {
        $space = $this->getSpace();

        if (Yii::$app->request->get('tour') || Yii::$app->request->get('contentId')) {
            return $this->actionHome();
        }

        if (!$space->isMember()) {
            $defaultPageUrl = Menu::getGuestsDefaultPageUrl($space);
            if ($defaultPageUrl != null) {
                return $this->redirect($defaultPageUrl);
            }
        }

        $defaultPageUrl = Menu::getDefaultPageUrl($space);
        if ($defaultPageUrl != null) {
            return $this->redirect($defaultPageUrl);
        }

        return $this->actionHome();
    }

    /**
     * Default space homepage
     *
     * @return string the rendering result.
     * @throws \yii\base\InvalidConfigException
     */
    public function actionHome()
    {
        $space = $this->contentContainer;

        return $this->render('home', [
            'space' => $space,
            'canCreateEntries' => WallCreateContentMenu::canCreateEntry($space),
            'isMember' => $space->isMember(),
            'isSingleContentRequest' => !empty(Yii::$app->request->getQueryParam('contentId')),
        ]);
    }

    /**
     * Follows a Space
     */
    public function actionFollow()
    {
        if (Yii::$app->getModule('space')->disableFollow) {
            throw new HttpException(403, Yii::t('ContentModule.base', 'This action is disabled!'));
        }

        $this->forcePostRequest();
        $space = $this->getSpace();

        $success = false;

        if (!$space->isMember()) {
            // follow without notifications by default
            $success = $space->follow(null, false);
        }

        if (Yii::$app->request->isAjax) {
            return $this->asJson([
                'success' => $success,
                'space' => Chooser::getSpaceResult($space, true, ['isFollowing' => true]),
            ]);
        }

        return $this->redirect($space->getUrl());
    }

    /**
     * Unfollows a Space
     */
    public function actionUnfollow()
    {
        $this->forcePostRequest();
        $space = $this->getSpace();

        $success = $space->unfollow();

        if (Yii::$app->request->isAjax) {
            return $this->asJson([
                'success' => $success,
                'space' => $space->guid,
            ]);
        }

        return $this->redirect($space->getUrl());
    }

    /**
     * Modal to  list followers of a space
     */
    public function actionFollowerList()
    {
        if ($this->space->getAdvancedSettings()->hideFollowers) {
            throw new HttpException(403);
        }

        $query = User::find();
        $query->leftJoin('user_follow', 'user.id=user_follow.user_id AND object_model=:userClass AND user_follow.object_id=:spaceId', [':userClass' => Space::class, ':spaceId' => $this->getSpace()->id]);
        $query->orderBy(['user_follow.id' => SORT_DESC]);
        $query->andWhere(['IS NOT', 'user_follow.id', new Expression('NULL')]);
        $query->visible();

        $title = Yii::t('SpaceModule.base', '<strong>Space</strong> followers');

        return $this->renderAjaxContent(UserListBox::widget(['query' => $query, 'title' => $title]));
    }

    /**
     * About space page
     */
    public function actionAbout()
    {
        $space = $this->getSpace();

        return $this->render('about', [
            'space' => $space,
            'userGroups' => $space->getPrivilegedGroupUsers(),
        ]);
    }

}
