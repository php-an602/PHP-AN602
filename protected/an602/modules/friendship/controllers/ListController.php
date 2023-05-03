<?php

/**
 * @link https://www.php-an602.coders.exchange/
 * @copyright Copyright (c) 2016 Brandon Maintenance Management, LLC
 * @license https://www.php-an602.coders.exchange/licences
 */

namespace an602\modules\friendship\controllers;

use Yii;
use yii\web\HttpException;
use an602\modules\user\models\User;
use an602\modules\friendship\models\Friendship;
use an602\components\Controller;
use an602\modules\user\widgets\UserListBox;

/**
 * ListController
 *
 * @since 1.1
 * @author luke
 */
class ListController extends Controller
{

    /**
     * Returns an list of all friends of a user
     *
     * @throws HttpException
     * @throws \Exception
     */
    public function actionPopup()
    {
        $user = User::findOne(['id' => Yii::$app->request->get('userId')]);
        if ($user === null) {
            throw new HttpException(404, 'Could not find user!');
        }

        $query = Friendship::getFriendsQuery($user);

        $title = '<strong>' . Yii::t('FriendshipModule.base', 'Friends') . '</strong>';

        return $this->renderAjaxContent(UserListBox::widget(['query' => $query, 'title' => $title]));
    }

}
