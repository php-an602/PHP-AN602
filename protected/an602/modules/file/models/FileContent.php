<?php

/**
 * @link https://metamz.network/
 * @copyright Copyright (c) 2016 PHP-AN602, The 86it Developers Network, Yii, and H u m H u b
 * @license https://www.metamz.network/licences
 */

namespace an602\modules\file\models;

/**
 * FileContent model is used to set a file by string
 * 
 * @author Luke
 * @inheritdoc
 * @since 1.2
 */
class FileContent extends File
{

    /**
     * @var string file content 
     */
    public $newFileContent = null;

    /**
     * @inheritdoc
     */
    public function beforeValidate()
    {
        if ($this->newFileContent && $this->size === null) {
            $this->setFileSize();
        }

        return parent::beforeValidate();
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        $rules = [
            [['newFileContent'], 'required'],
        ];

        return array_merge(parent::rules(), $rules);
    }

    /**
     * @inheritdoc
     */
    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);
        $this->store->setContent($this->newFileContent);
    }

    /**
     * Sets the file size by newFileContent
     */
    protected function setFileSize()
    {
        if (function_exists('mb_strlen')) {
            $this->size = mb_strlen($this->newFileContent, '8bit');
        } else {
            $this->size = strlen($this->newFileContent);
        }
    }

}
