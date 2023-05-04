<?php

/**
 * @link https://metamz.network/
 * @copyright Copyright (c) 2017 PHP-AN602, The 86it Developers Network, Yii, and H u m H u b GmbH & Co. KG
 * @license https://www.metamz.network/licences
 */

namespace an602\modules\space;

use yii\base\Event;

/**
 * MemberEvent
 *
 * @since 1.2
 * @author Luke
 */
class MemberEvent extends Event
{

    /**
     * @var models\Space
     */
    public $space;

    /**
     * @var \an602\modules\user\models\User
     */
    public $user;

}
