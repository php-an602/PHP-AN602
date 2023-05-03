<?php
/**
 * @link https://www.php-an602.coders.exchange/
 * @copyright Copyright (c) 2018 Brandon Maintenance Management, LLC
 * @license https://www.php-an602.coders.exchange/licences
 *
 */

namespace an602\modules\stream\models\filters;


use an602\modules\content\models\Content;
use an602\modules\stream\models\ContentContainerStreamQuery;
use an602\modules\stream\models\StreamQuery;
use an602\modules\ui\filter\models\QueryFilter;

abstract class StreamQueryFilter extends QueryFilter
{
    /**
     * @var StreamQuery|ContentContainerStreamQuery
     */
    public $streamQuery;

    /**
     * @inheritDoc
     */
    public $autoLoad = self::AUTO_LOAD_GET;

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        if ($this->isLoaded && !parent::validate()) {
            $this->streamQuery->addErrors($this->getErrors());
        }
    }

    /**
     * @inheritDoc
     */
    public function formName()
    {
        return $this->formName ?: 'StreamQuery';
    }

    /**
     * This method allows the stream filter direct access to returned Content[] array.
     * e.g. additional entries can be injected
     *
     * @param Content[] $results
     */
    public function postProcessStreamResult(array &$results): void
    {
    }

}
