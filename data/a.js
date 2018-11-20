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

    CPanel.prototype = {

        /**
         *
         * @param options
         */
        initA: function (options) {
            new A(options);
        }
    };

    CPanel = new CPanel();
    if (!('CPanel' in this)) this['CPanel'] = CPanel;

}).call(this);


CPanel.initA({});