<?php

namespace tests\codeception\unit\models;

use an602\modules\user\models\GroupPermission;
use tests\codeception\_support\An602DbTestCase;

class GroupPermissionTest extends An602DbTestCase
{
    public function testReturnTableName()
    {
        $this->assertEquals('group_permission', GroupPermission::tableName());
    }

    public function testReturnArrayOfRules()
    {
        $model = new GroupPermission();
        $this->assertTrue(is_array($model->rules()));
    }

    public function testReturnArrayOfAttributeLabels()
    {
        $model = new GroupPermission();
        $this->assertTrue(is_array($model->attributeLabels()));
    }
}
