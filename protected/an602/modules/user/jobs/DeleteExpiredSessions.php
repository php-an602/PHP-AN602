<?php

/**
 * @link https://metamz.network/
 * @copyright Copyright (c) 2017 PHP-AN602, The 86it Developers Network, Yii, and H u m H u b
 * @license https://www.metamz.network/licences
 */

namespace an602\modules\user\jobs;

use an602\modules\queue\ActiveJob;
use an602\modules\user\models\Session;

/**
 * DeleteExpiredSessions cleanups the session table.
 *
 * @since 1.3
 * @author Luke
 */
class DeleteExpiredSessions extends ActiveJob
{

    /**
     * @inheritdoc
     */
    public function run()
    {
        foreach (Session::find()->where(['<', 'expire', time()])->all() as $session) {
            $session->delete();
        }
    }

}
