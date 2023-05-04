<?php
/**
 * @link https://metamz.network/
 * @copyright Copyright (c) 2017 PHP-AN602, The 86it Developers Network, Yii, and H u m H u b GmbH & Co. KG
 * @license https://www.metamz.network/licences
 *
 */

/**
 * Created by PhpStorm.
 * User: buddha
 * Date: 26.07.2017
 * Time: 18:11
 */

namespace an602\modules\content\components;


use Yii;
use an602\components\access\StrictAccess;
use an602\modules\space\models\Membership;
use an602\modules\space\models\Space;
use an602\modules\user\models\User;

/**
 * Class ContentContainerControllerAccess
 *
 * Adds a container permission check to
 *
 * @package components
 */
class ContentContainerControllerAccess extends StrictAccess
{
    const RULE_SPACE_ONLY = 'space';
    const RULE_PROFILE_ONLY = 'profile';

    const RULE_USER_GROUP_ONLY = 'userGroup';
    const RULE_CONTAINER_ACCESS = 'containerAccess';

    /**
     * @var ContentContainerActiveRecord
     */
    public $contentContainer;

    private $_membership = false;

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        if (!$this->contentContainer && Yii::$app->controller instanceof ContentContainerController) {
            $this->contentContainer = Yii::$app->controller->contentContainer;
        }

        // overwrite default permission validator
        $this->registerValidator([ContentContainerPermissionAccess::class, 'contentContainer' => $this->contentContainer]);
        $this->registerValidator([self::RULE_SPACE_ONLY => 'validateSpaceOnlyRule']);
        $this->registerValidator([self::RULE_PROFILE_ONLY => 'validateProfileOnlyRule']);
        $this->registerValidator([UserGroupAccessValidator::class, 'contentContainer' => $this->contentContainer]);
        $this->registerValidator([self::RULE_CONTAINER_ACCESS => 'validateContainerAccess']);
    }

    /**
     * @return bool verifies 'spaceOnly' rules
     */
    public function validateSpaceOnlyRule()
    {
        return $this->isSpaceController();
    }

    /**
     * @return bool verifies 'userOnly' rules
     */
    public function validateProfileOnlyRule()
    {
        return $this->isProfileController();
    }

    /**
     * @return bool Additional ContentContainerActiveRecord specific checks
     */
    public function validateContainerAccess()
    {
        if($this->isSpaceController()) {
            return $this->canAccessSpace();
        } else {
            return $this->canAccessUser();
        }
    }

    /**
     * @return bool Space related access checks
     */
    private function canAccessSpace()
    {
        if($this->contentContainer->isVisibleFor(Space::VISIBILITY_ALL)) {
            return true;
        }

        // don't allow guests since visibility != VISIBILITY_ALL
        if($this->isGuest()) {
            $this->code = 401;
            return false;
        }

        if($this->user->isSystemAdmin()) {
            return true;
        }

        // @see SpaceModelMembership
        $membership = $this->getSpaceMembership();

        if ($membership) {
            return true;
        }

        if($this->isVisibleFor(Space::VISIBILITY_NONE)) {
            $this->code = 404;
            $this->reason = Yii::t('ContentModule.base', 'This space is not visible!');
            return false;
        }

        return true;
    }

    /**
     * @return Membership
     */
    private function getSpaceMembership()
    {
        if(!$this->isSpaceController() || $this->isGuest()) {
            return null;
        }

        if($this->_membership === false) {
            $this->_membership = $this->contentContainer->getMembership($this->user->id);
        }

        return $this->_membership;
    }

    /**
     * @return bool User related access checks
     */
    private function canAccessUser()
    {
        if($this->contentContainer->status == User::STATUS_NEED_APPROVAL) {
            $this->reason = Yii::t('UserModule.profile', 'This user account is not approved yet!');
            $this->code = 404;
            return false;
        }

        if($this->isGuest() && $this->contentContainer->isVisibleFor(User::VISIBILITY_ALL)) {
            $this->code = 401;
            $this->reason = Yii::t('UserModule.profile', 'You need to login to view this user profile!');
            return false;
        }

        //TODO: visibility + friendship check
    }

    /**
     * @inheritdoc
     */
    public function isAdmin()
    {
        if(parent::isAdmin()) {
            return true;
        }

        if ($this->contentContainer instanceof Space) {
            return $this->contentContainer->isAdmin($this->user);
        } elseif($this->contentContainer instanceof Space) {
            return $this->user && $this->user->is($this->contentContainer);
        }

        return false;
    }

    protected function isSpaceController()
    {
        return $this->contentContainer instanceof Space;
    }

    protected function isProfileController()
    {
        return $this->contentContainer instanceof User;
    }

}
