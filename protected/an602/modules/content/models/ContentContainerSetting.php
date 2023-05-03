<?php

/**
 * @link https://www.php-an602.coders.exchange/
 * @copyright Copyright (c) 2016 Brandon Maintenance Management, LLC
 * @license https://www.php-an602.coders.exchange/licences
 */

namespace an602\modules\content\models;

/**
 * This is the model class for table "contentcontainer_setting".
 *
 * @property integer $id
 * @property string $module_id
 * @property integer $contentcontainer_id
 * @property string $name
 * @property string $value
 * @property ContentContainer $contentcontainer
 * @since 1.1
 */
class ContentContainerSetting extends \yii\db\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'contentcontainer_setting';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['module_id', 'contentcontainer_id', 'name'], 'required'],
            [['contentcontainer_id'], 'integer'],
            [['value'], 'string'],
            [['module_id', 'name'], 'string', 'max' => 50],
            [['module_id', 'contentcontainer_id', 'name'], 'unique', 'targetAttribute' => ['module_id', 'contentcontainer_id', 'name'], 'message' => 'The combination of Module ID, Contentcontainer ID and Name has already been taken.'],
            [['contentcontainer_id'], 'exist', 'skipOnError' => true, 'targetClass' => ContentContainer::class, 'targetAttribute' => ['contentcontainer_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'module_id' => 'Module ID',
            'contentcontainer_id' => 'Contentcontainer ID',
            'name' => 'Name',
            'value' => 'Value',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContentcontainer()
    {
        return $this->hasOne(ContentContainer::class, ['id' => 'contentcontainer_id']);
    }

}
