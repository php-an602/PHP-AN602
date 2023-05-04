<?php
/**
 * @link https://metamz.network/
 * @copyright Copyright (c) 2015 PHP-AN602, The 86it Developers Network, Yii, and H u m H u b
 * @license https://www.an602.org/licences
 */

use yii\db\Migration;

class m170224_100937_fix_default_modules extends Migration
{
    public function up()
    {
        $this->alterColumn('space_module', 'space_id', $this->integer()->null());
        $this->alterColumn('user_module', 'user_id', $this->integer()->null());

        $this->update('space_module', ['space_id' => new \yii\db\Expression('NULL')], ['space_id' => 0]);
        $this->update('user_module', ['user_id' => new \yii\db\Expression('NULL')], ['user_id' => 0]);

        // TODO: All all to null
    }

    public function down()
    {
        echo "m170224_100937_fix_default_modules cannot be reverted.\n";

        return false;
    }
}
