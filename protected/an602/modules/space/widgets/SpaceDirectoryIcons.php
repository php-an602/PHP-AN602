<?php
/**
 * @link https://www.php-an602.coders.exchange/
 * @copyright Copyright (c) 2021 Brandon Maintenance Management, LLC
 * @license https://www.php-an602.coders.exchange/licences
 */

namespace an602\modules\space\widgets;

use an602\components\Widget;
use an602\modules\space\models\Membership;
use an602\modules\space\models\Space;
use an602\modules\user\models\User;
use Yii;

/**
 * SpaceDirectoryIcons shows footer icons for spaces cards
 *
 * @since 1.9
 * @author Luke
 */
class SpaceDirectoryIcons extends Widget
{

    /**
     * @var Space
     */
    public $space;

    /**
     * @inheritdoc
     */
    public function run()
    {
        if ($this->space->getAdvancedSettings()->hideMembers) {
            return '';
        }

        $membership = $this->space->getMembership();
        $membersCountQuery = Membership::getSpaceMembersQuery($this->space)->active();
        if (Yii::$app->user->isGuest) {
            $membersCountQuery->andWhere(['!=', 'user.visibility', User::VISIBILITY_HIDDEN]);
        } else {
            $membersCountQuery->visible();
        }

        return $this->render('spaceDirectoryIcons', [
            'space' => $this->space,
            'membersCount' => Yii::$app->formatter->asShortInteger($membersCountQuery->count()),
            'canViewMembers' => $membership && $membership->isPrivileged(),
        ]);
    }

}