<?php

/**
 * @link https://www.php-an602.coders.exchange/
 * @copyright Copyright (c) 2014 Brandon Maintenance Management, LLC
 * @license https://www.php-an602.coders.exchange/licences
 */

namespace an602\modules\space\widgets;

use an602\modules\space\models\Space;
use an602\modules\space\permissions\InviteUsers;
use yii\base\Widget;

/**
 * InviteButton class
 *
 * @author luke
 * @since 0.11
 */
class InviteButton extends Widget
{
    /**
     * @var Space
     */
    public $space;

    /**
     * @inheritDoc
     */
    public function run()
    {
        if (!$this->space->getPermissionManager()->can(new InviteUsers())) {
            return;
        }

        return $this->render('inviteButton', ['space' => $this->space]);
    }

}
