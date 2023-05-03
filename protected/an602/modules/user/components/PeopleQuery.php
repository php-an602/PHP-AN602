<?php
/**
 * @link https://www.php-an602.coders.exchange/
 * @copyright Copyright (c) 2021 Brandon Maintenance Management, LLC
 * @license https://www.php-an602.coders.exchange/licences
 */

namespace an602\modules\user\components;

use an602\modules\user\models\fieldtype\Select;
use an602\modules\user\models\Group;
use an602\modules\user\models\ProfileField;
use an602\modules\user\models\User;
use an602\modules\user\widgets\PeopleCard;
use an602\modules\user\widgets\PeopleFilters;
use Yii;
use yii\data\Pagination;
use yii\db\Expression;

/**
 * PeopleQuery is used to query User records on the People page.
 *
 * @author luke
 */
class PeopleQuery extends ActiveQueryUser
{
    /**
     * @var Group
     */
    public $filteredGroup;

    /**
     * @var Pagination
     */
    public $pagination;

    /**
     * @var int
     */
    public $pageSize = 25;

    /**
     * @inheritdoc
     */
    public function __construct($config = [])
    {
        parent::__construct(User::class, $config);
    }

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        $this->available();
        $this->filterInvisibleUsers();

        $this->filterByKeyword();
        $this->filterByGroup();
        $this->filterByConnection();
        $this->filterByProfileFields();

        $this->order();

        $this->paginate();
    }

    public function filterInvisibleUsers(): PeopleQuery
    {
        return $this->andWhere(['!=', 'user.visibility', User::VISIBILITY_HIDDEN]);
    }

    public function filterByKeyword(): PeopleQuery
    {
        $keyword = Yii::$app->request->get('keyword', '');

        return $this->search($keyword);
    }

    public function filterByProfileFields(): PeopleQuery
    {
        $fields = Yii::$app->request->get('fields', []);

        // Remove empty filters
        $fields = array_filter($fields, function($value) {
            return $value !== '';
        });

        if (empty($fields)) {
            return $this;
        }

        // Skip fields if they are not defined for directory filters
        $filteredProfileFields = ProfileField::find()
            ->where(['directory_filter' => 1])
            ->andWhere(['IN', 'internal_name', array_keys($fields)])
            ->all();
        $checkedFilteredFields = [];
        foreach ($filteredProfileFields as $filteredField) {
            /* @var $filteredField ProfileField */
            if (!isset($fields[$filteredField->internal_name])) {
                // Skip unknown field
                continue;
            }
            $checkedFilteredFields[$filteredField->internal_name] = [
                'value' => $fields[$filteredField->internal_name],
                'condition' => $filteredField->getFieldType() instanceof Select ? '=' : 'LIKE',
            ];
        }

        if (empty($checkedFilteredFields)) {
            return $this;
        }

        $this->joinWith('profile');

        foreach ($checkedFilteredFields as $field => $data) {
            $this->andWhere([$data['condition'], 'profile.' . $field, $data['value']]);
        }

        return $this;
    }

    public function filterByGroup(): PeopleQuery
    {
        $groupId = Yii::$app->request->get('groupId', 0);

        if ($groupId) {
            $group = Group::findOne(['id' => $groupId, 'show_at_directory' => 1]);
            if ($group) {
                $this->filteredGroup = $group;
                $this->isGroupMember($group);
            }
        }

        return $this;
    }

    public function filterByConnection(): PeopleQuery
    {
        switch (Yii::$app->request->get('connection')) {
            case 'followers':
                return $this->filterByConnectionFollowers();
            case 'following':
                return $this->filterByConnectionFollowing();
            case 'friends':
                return $this->filterByConnectionFriends();
            case 'pending_friends':
                return $this->filterByConnectionPendingFriends();
        }

        return $this;
    }

    public function filterByConnectionFollowers(): PeopleQuery
    {
        return $this->innerJoin('user_follow', 'user_follow.object_model = :user_class AND user_follow.user_id = user.id', [':user_class' => User::class])
            ->andWhere(['user_follow.object_id' => Yii::$app->user->id]);
    }

    public function filterByConnectionFollowing(): PeopleQuery
    {
        return $this->innerJoin('user_follow', 'user_follow.object_model = :user_class AND user_follow.object_id = user.id', [':user_class' => User::class])
            ->andWhere(['user_follow.user_id' => Yii::$app->user->id]);
    }

    public function filterByConnectionFriends(): PeopleQuery
    {
        if (!Yii::$app->getModule('friendship')->settings->get('enable')) {
            return $this;
        }

        return $this->innerJoin('user_friendship AS uf_current', 'uf_current.friend_user_id = user.id')
            ->andWhere(['uf_current.user_id' => Yii::$app->user->id])
            ->innerJoin('user_friendship AS uf_friend', 'uf_friend.user_id = user.id')
            ->andWhere(['uf_friend.friend_user_id' => Yii::$app->user->id]);
    }

    public function filterByConnectionPendingFriends(): PeopleQuery
    {
        if (!Yii::$app->getModule('friendship')->settings->get('enable')) {
            return $this;
        }

        return $this->innerJoin('user_friendship AS uf_current', 'uf_current.friend_user_id = user.id')
            ->andWhere(['uf_current.user_id' => Yii::$app->user->id])
            ->leftJoin('user_friendship AS uf_friend', 'uf_friend.user_id = user.id')
            ->andWhere(['IS', 'uf_friend.friend_user_id', new Expression('NULL')]);
    }

    public function isFilteredByGroup(): bool
    {
        return $this->filteredGroup instanceof Group;
    }

    public function order(): PeopleQuery
    {
        switch (PeopleFilters::getValue('sort')) {
            case 'firstname':
                $this->joinWith('profile');
                $this->addOrderBy('profile.firstname, profile.lastname, user.id');
                break;

            case 'lastname':
                $this->joinWith('profile');
                $this->addOrderBy('profile.lastname, profile.firstname, user.id');
                break;

            case 'lastlogin':
                $this->addOrderBy('last_login DESC, user.id');
                break;

            default:
                $defaultSortingGroupId = PeopleCard::config('defaultSortingGroup');
                if (empty($defaultSortingGroupId)) {
                    $this->addOrderBy('last_login DESC');
                } else {
                    $this->leftJoin('group_user AS top_group_sorting', 'top_group_sorting.user_id = user.id AND top_group_sorting.group_id = :defaultGroupId', [':defaultGroupId' => $defaultSortingGroupId]);
                    $this->addOrderBy('top_group_sorting.group_id DESC, last_login DESC, user.id');
                }
        }

        return $this;
    }

    public function paginate(): PeopleQuery
    {
        $countQuery = clone $this;
        $this->pagination = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => $this->pageSize]);

        return $this->offset($this->pagination->offset)->limit($this->pagination->limit);
    }

    public function isLastPage(): bool
    {
        return $this->pagination->getPage() == $this->pagination->getPageCount() - 1;
    }

}
