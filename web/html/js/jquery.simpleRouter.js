/**
 * User: xiaoge
 * At: 13-6-12 7:12
 * Email: abraham1@163.com
 */
(function($) {
    var route_table = [];
    var check = function() {
        var href = window.location.hash;

        var para = href.substr(1);
        for(var i=0;i<route_table.length;i++) {
            var m = para.match(route_table[i].regex);
            if(m!==null && typeof route_table[i].func === 'function') {
                route_table[i].func.apply(window, m);
                return;
            }
        }
    };
    $.Router = {
        register : function(table) {
            for(var rule in table) {
                var reg = new RegExp(rule);
                route_table.push({
                    'regex' : reg,
                    'func' : table[rule]
                });
            }
            return this;
        },

        start : function() {
            $(window).on('hashchange', check);
            check();
            return this;
        }
    }
})(jQuery);