<?php

/**
 * @link https://www.php-an602.coders.exchange/
 * @copyright Copyright (c) 2015 Brandon Maintenance Management, LLC
 * @license https://www.php-an602.coders.exchange/licences
 */

namespace an602\modules\space\modules\manage\controllers;

use an602\modules\space\modules\manage\components\Controller;
use Yii;

/**
 * Space module management
 *
 * @author Luke
 */
class ModuleController extends Controller
{
    /**
     * Modules Administration Action
     */
    public function actionIndex()
    {
        $space = $this->getSpace();
        return $this->render('index', ['availableModules' => $space->moduleManager->getAvailable(), 'space' => $space]);
    }

    /**
     * Enables a space module
     *
     * @return string|array the output
     */
    public function actionEnable()
    {
        $this->forcePostRequest();

        $space = $this->getSpace();

        $moduleId = Yii::$app->request->get('moduleId', '');

        $space->moduleManager->enable($moduleId);

        if (!Yii::$app->request->isAjax) {
            return $this->redirect($space->createUrl('/space/manage/module'));
        } else {
            Yii::$app->response->format = 'json';
            return ['success' => true];
        }
    }

    /**
     * Disables a space module
     *
     * @return string|array the output
     */
    public function actionDisable()
    {
        $this->forcePostRequest();

        $space = $this->getSpace();

        $moduleId = Yii::$app->request->get('moduleId', '');

        $space->moduleManager->disable($moduleId);

        if (!Yii::$app->request->isAjax) {
            return $this->redirect($space->createUrl('/space/manage/module'));
        } else {
            Yii::$app->response->format = 'json';
            return ['success' => true];
        }

    }

}
