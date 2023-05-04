<?php

/**
 * @link https://metamz.network/
 * @copyright Copyright (c) 2017 PHP-AN602, The 86it Developers Network, Yii, and H u m H u b GmbH & Co. KG
 * @license https://www.metamz.network/licences
 */

namespace an602\components\rendering;

/**
 * Renderer interface used by render components to render Viewable instances.
 *
 * A Renderer implementation is responsible for rendering the viewable either by using it's viewName or
 * by converting it's data into a specific format.
 *
 * @author buddha
 * @since 1.2
 */
interface Renderer
{

    /**
     * Renders the given $viewable.
     *
     * The renderer  will usually use the $viewable->viewName to determine the target view and
     * forward the given $params to $viewable->getViewParams($params). By doing so, the
     * $params can be used to overwrite the default view parameter of $viewable.
     *
     * It is upon the renderer implementation to handle non existing views.
     * They could throw a yii\base\ViewNotFoundException, or provide a
     * default view.
     *
     * @param \an602\components\rendering\Viewable $viewable
     * @param type $params
     */
    public function render(Viewable $viewable, $params = []);
}
