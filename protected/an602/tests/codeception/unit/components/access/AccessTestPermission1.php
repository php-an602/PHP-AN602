<?php
/**
 * @link https://metamz.network/
 * @copyright Copyright (c) 2017 PHP-AN602, The 86it Developers Network, Yii, and H u m H u b
 * @license https://www.metamz.network/licences
 *
 */

/**
 * Created by PhpStorm.
 * User: buddha
 * Date: 27.07.2017
 * Time: 00:06
 */

namespace an602\tests\codeception\unit\components\access;


use an602\libs\BasePermission;

class AccessTestPermission1 extends BasePermission
{
    public $moduleId = 'content';

    public $id = 'content-test-permission2';

}
