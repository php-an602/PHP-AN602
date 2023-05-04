<?php
/**
 * @link https://metamz.network/
 * @copyright Copyright (c) 2022 PHP-AN602, The 86it Developers Network, Yii, and H u m H u b
 * @license https://www.metamz.network/licences
 *
 */

namespace an602\modules\ui\filter\widgets;

use DateTime;
use an602\modules\ui\form\widgets\DatePicker;
use Yii;
use yii\helpers\FormatConverter;

class DatePickerFilterInput extends FilterInput
{
    /**
     * @inheritdoc
     */
    public $type = 'date-picker';
    
    /**
     * @var array Options for the DatePicker widget
     */
    private $datePickerOptions = [];

    /**
     * @var string data-action-click handler of the input event
     */
    public $changeAction = 'inputChange';

    /**
     * @inheritdoc
     */
    protected function initFromRequest()
    {
        $filter = Yii::$app->request->get($this->category);
        $this->value = $filter;

        if (!isset($this->options['placeholder'])) {
            $this->options['placeholder'] = (new DateTime())
                ->format(FormatConverter::convertDateIcuToPhp(Yii::$app->formatter->dateInputFormat));
        }
    }

    /**
     * @inheritdoc
     */
    public function run()
    {
        $this->prepareOptions();

        return DatePicker::widget($this->datePickerOptions);
    }

    /**
     * @inheritdoc
     */
    public function prepareOptions()
    {
        parent::prepareOptions();
        $this->options['data-action-change'] = $this->changeAction;
        $this->datePickerOptions['options'] = $this->options;
        $this->datePickerOptions['value'] = $this->value;
    }
}
