<?php

/**
 * @link https://www.php-an602.coders.exchange/
 * @copyright Copyright (c) 2017 Brandon Maintenance Management, LLC
 * @license https://www.php-an602.coders.exchange/licences
 */

namespace an602\commands;

use Yii;
use yii\helpers\Console;

/**
 * TestController provides some console tests
 *
 * @inheritdoc
 */
class TestController extends \yii\console\Controller
{

    /**
     * Sends a test e-mail to the given e-mail address
     *
     * @param string $address the e-mail address
     */
    public function actionEmail($address)
    {
        $message = "Console test message<br /><br />";

        $mail = Yii::$app->mailer->compose(['html' => '@an602/views/mail/TextOnly'], ['message' => $message]);
        $mail->setTo($address);
        $mail->setSubject('Test message');
        $mail->send();

        Console::output("Message successfully sent!");
    }
}
