<?php

/**
 * @link https://metamz.network/
 * @copyright Copyright (c) 2017 PHP-AN602, The 86it Developers Network, Yii, and H u m H u b GmbH & Co. KG
 * @license https://www.metamz.network/licences
 */

namespace an602\modules\queue\driver;

use an602\modules\queue\interfaces\QueueInfoInterface;
use yii\queue\redis\Queue;

/**
 * Redis queue driver
 *
 * @since 1.2
 * @author Luke
 */
class Redis extends Queue implements QueueInfoInterface
{
    /**
     * @return int|null the number of waiting jobs in the queue
     */
    public function getWaitingJobCount()
    {
        return (int)$this->redis->llen($this->channel . ".waiting");
    }

    /**
     * @return int|null the number of delayed jobs in the queue
     */
    public function getDelayedJobCount()
    {
        return (int)$this->redis->zcount($this->channel . ".delayed", '-inf', '+inf');
    }

    /**
     * @return int|null the number of reserved jobs in the queue
     */
    public function getReservedJobCount()
    {
        return (int)$this->redis->zcount($this->channel . ".reserved", '-inf', '+inf');
    }

    /**
     * @return int|null the number of done jobs in the queue
     */
    public function getDoneJobCount()
    {
        $total = $this->redis->get($this->channel . ".message_id");
        return $total - $this->getWaitingJobCount() - $this->getDelayedJobCount() - $this->getReservedJobCount();
    }
}
