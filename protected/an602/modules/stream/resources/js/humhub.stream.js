/**
 * Core module for managing Streams and StreamItems
 * @type Function
 */

an602.module('stream', function (module, require, $) {
    var event = require('event');

    var unload = function() {
        event.off('.stream');
    };

    module.export({
        unload: unload,
    });
});
