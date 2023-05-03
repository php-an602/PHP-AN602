<?php

/**
 * @link https://www.php-an602.coders.exchange/
 * @copyright Copyright (c) 2015 Brandon Maintenance Management, LLC
 * @license https://www.php-an602.coders.exchange/licences
 */

namespace an602\modules\stream\assets;

use an602\assets\CoreExtensionAsset;
use an602\components\assets\AssetBundle;
use an602\modules\content\assets\ContentAsset;
use an602\modules\content\assets\ContentContainerAsset;
use an602\modules\ui\filter\assets\FilterAsset;
use an602\modules\user\assets\UserAsset;


/**
 * Stream related assets.
 *
 * @since 1.2
 * @author buddha
 */
class StreamAsset extends AssetBundle
{
    /**
     * @inheritdoc
     */
    public $sourcePath = '@stream/resources';

    /**
     * @inheritdoc
     */
    public $js = [
        'js/an602.stream.StreamEntry.js',
        'js/an602.stream.StreamRequest.js',
        'js/an602.stream.Stream.js',
        'js/an602.stream.wall.js',
        'js/an602.stream.SimpleStream.js',
        'js/an602.stream.js',
    ];

    public $depends = [
        ContentAsset::class,
        ContentContainerAsset::class,
        FilterAsset::class,
        UserAsset::class,
        CoreExtensionAsset::class
    ];


}
