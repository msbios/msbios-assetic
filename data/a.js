/**
 * @access public
 * @author Judzhin Miles <info[woof-woof]msbios.com>
 */
alert("a");

(function () {

    /**
     *
     * @constructor
     */
    var A = function () {
        this._initComponent();
    };


    /**
     *
     * @type {{DEFAULTS: {}, _initComponent: _initComponent}}
     */
    A.prototype = {
        DEFAULTS: {},

        /**
         *
         * @private
         */
        _initComponent: function () {
            // ...
        }
    };

    /**
     *
     * @type {{ready: CPanel.ready, _init: {initA: CPanel._init.initA}}}
     */
    CPanel.prototype = {

        /**
         *
         * @param options
         */
        ready: function (options) {

            var thisRef = this, initializer = $.Deferred(function (deffered) {
                $(function () {
                    deffered.resolve.call(thisRef, deffered.options);
                });
            });

            this.options = $.extend({}, this.DEFAULTS, options);

            $.each(this._init, function (name) {
                if (name in thisRef.options) {
                    initializer.options = thisRef.options[name];
                    initializer.then(this, initializer.options);
                }
            });

        },

        _init: {
            /**
             *
             * @param options
             */
            initA: function (options) {
                new A(options);
            }
        }
    };

    CPanel = new CPanel();
    if (!('CPanel' in this)) this['CPanel'] = CPanel;

}).call(this);


CPanel.ready({
    initA: {
        // ...
    }
});