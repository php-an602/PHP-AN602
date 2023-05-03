<?php

/**
 * @link https://www.php-an602.coders.exchange/
 * @copyright Copyright (c) 2016 Brandon Maintenance Management, LLC
 * @license https://www.php-an602.coders.exchange/licences
 */

namespace an602\modules\file\actions;

use an602\libs\Html;
use an602\modules\file\libs\ImageHelper;
use Yii;
use yii\base\Action;
use yii\web\UploadedFile;
use an602\libs\Helpers;
use an602\modules\file\models\FileUpload;
use an602\modules\file\libs\FileHelper;
use an602\modules\file\models\File;
use an602\modules\content\components\ContentActiveRecord;
use an602\modules\content\components\ContentAddonActiveRecord;

/**
 * UploadAction provides an Ajax/JSON way to upload new files
 *
 * @since 1.2
 * @author Luke
 */
class UploadAction extends Action
{

    /**
     * The record to whom this files belongs to.
     * Optional, since "free" files can also attached to a record later.
     *
     * @var \an602\components\ActiveRecord the records
     */
    public $record = null;

    /**
     * @var string the file model (you may want to overwrite this for own validations)
     */
    protected $fileClass = 'an602\modules\file\models\FileUpload';

    /**
     * @var string scenario for file upload validation
     */
    protected $scenario = null;

    /**
     * @var string
     */
    public $uploadName = 'files';

    /**
     * @inheritdoc
     */
    public function init()
    {
        Yii::$app->response->format = 'json';
        $this->loadRecord();
    }

    /**
     * @inheritdoc
     */
    public function run()
    {
        $files = [];
        $hideInStream = $this->isHideInStreamRequest();
        foreach (UploadedFile::getInstancesByName($this->uploadName) as $cFile) {
            $files[] = $this->handleFileUpload($cFile, $hideInStream);
        }

        return ['files' => $files];
    }

    /**
     * Handles the file upload for are particular UploadedFile
     */
    protected function handleFileUpload(UploadedFile $uploadedFile, $hideInStream = false)
    {
        /* @var $file FileUpload */
        $file = Yii::createObject($this->fileClass);

        if ($this->scenario !== null) {
            $file->scenario = $this->scenario;
        }

        $file->setUploadedFile($uploadedFile);

        if ($hideInStream) {
            $file->show_in_stream = false;
        }

        if ($file->save()) {
            if ($this->record !== null) {
                $this->record->fileManager->attach($file);
            }
            $this->afterFileUpload($file);
            return array_merge(['error' => false], FileHelper::getFileInfos($file));
        } else {
            return $this->getErrorResponse($file);
        }
    }

    protected function isHideInStreamRequest()
    {
        return (Yii::$app->request->post('hideInStream') == 1) || (Yii::$app->request->get('hideInStream') == 1);
    }


    /**
     * Is called after a file has been successfully uploaded and saved.
     *
     * @param File $file
     * @since 1.7
     */
    protected function afterFileUpload(File $file)
    {
        ImageHelper::downscaleImage($file);
    }

    /**
     * Loads the target record by request parameter if defined.
     * The default implementation only supports uploads to ContentActiveRecord or ContentAddonActiveRecords.
     */
    protected function loadRecord()
    {
        if (Yii::$app->request->get('objectModel')) {
            $model = Yii::$app->request->get('objectModel');
            $pk = Yii::$app->request->get('objectId');
        } else {
            $model = Yii::$app->request->post('objectModel');
            $pk = Yii::$app->request->post('objectId');
        }


        if ($model != '' && $pk != '' && Helpers::CheckClassType($model, \yii\db\ActiveRecord::class)) {

            $record = $model::findOne(['id' => $pk]);
            if ($record !== null && ($record instanceof ContentActiveRecord || $record instanceof ContentAddonActiveRecord)) {
                if ($record->content->canEdit()) {
                    $this->record = $record;
                }
            }
        }
    }

    /**
     * Returns the error response for a file upload as array
     *
     * @param File $file
     * @return array the upload error information
     */
    protected function getErrorResponse(File $file)
    {
        $errorMessage = Yii::t('FileModule.base', 'File {fileName} could not be uploaded!', ['fileName' => Html::encode($file->file_name)]);

        if ($file->getErrors()) {
            $errorMessage = $file->getErrors('uploadedFile');
        }

        return [
            'error' => true,
            'errors' => $errorMessage,
            'name' => Html::encode($file->file_name),
            'size' => Html::encode($file->size)
        ];
    }

}
