<?php

/**
 * @link https://www.php-an602.coders.exchange/
 * @copyright Copyright (c) 2017 Brandon Maintenance Management, LLC
 * @license https://www.php-an602.coders.exchange/licences
 */

namespace an602\components;

use Yii;
use an602\libs\BaseSettingsManager;
use an602\modules\content\components\ContentContainerActiveRecord;
use an602\modules\content\components\ContentContainerSettingsManager;

/**
 * SettingsManager application component
 *
 * @since 1.1
 * @author Luke
 */
class SettingsManager extends BaseSettingsManager
{

    /**
     * @var ContentContainerSettingsManager[] already loaded content container settings managers
     */
    protected $contentContainers = [];

    /**
     * Returns content container
     *
     * @param ContentContainerActiveRecord $container
     * @return ContentContainerSettingsManager
     */
    public function contentContainer(ContentContainerActiveRecord $container)
    {
        if (isset($this->contentContainers[$container->contentcontainer_id])) {
            return $this->contentContainers[$container->contentcontainer_id];
        }

        $this->contentContainers[$container->contentcontainer_id] = new ContentContainerSettingsManager([
            'moduleId' => $this->moduleId,
            'contentContainer' => $container,
        ]);

        return $this->contentContainers[$container->contentcontainer_id];
    }


    /**
     * Clears runtime cached content container settings
     *
     * @param ContentContainerActiveRecord|null $container if null all content containers will be flushed
     */
    public function flushContentContainer(ContentContainerActiveRecord $container = null)
    {
        if ($container === null) {
            $this->contentContainers = [];
        } else {
            unset($this->contentContainers[$container->contentcontainer_id]);
        }
    }

    /**
     * Returns ContentContainerSettingsManager for the given $user or current logged in user
     * @return ContentContainerSettingsManager
     */
    public function user($user = null)
    {
        if (!$user) {
            $user = Yii::$app->user->getIdentity();
        }

        return $this->contentContainer($user);
    }

    /**
     * Returns ContentContainerSettingsManager for the given $space or current controller space
     * @return ContentContainerSettingsManager
     */
    public function space($space = null)
    {
        if ($space != null) {
            return $this->contentContainer($space);
        } elseif (Yii::$app->controller instanceof \an602\modules\content\components\ContentContainerController) {
            if (Yii::$app->controller->contentContainer instanceof \an602\modules\space\models\Space) {
                return $this->contentContainer(Yii::$app->controller->contentContainer);
            }
        }
    }

    /**
     * Indicates this setting is fixed in configuration file and cannot be
     * changed at runtime.
     *
     * @param string $name
     * @return boolean
     */
    public function isFixed($name)
    {
        return isset(Yii::$app->params['fixed-settings'][$this->moduleId][$name]);
    }

    /**
     * @inheritdoc
     */
    public function get($name, $default = null)
    {
        if ($this->isFixed($name)) {
            return Yii::$app->params['fixed-settings'][$this->moduleId][$name];
        }

        return parent::get($name, $default);
    }
}
