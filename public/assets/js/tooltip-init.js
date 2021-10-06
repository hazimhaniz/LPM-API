(function($) {
	"use strict";
	var tooltip_init = {
		init: function() {
			$("button").tooltip();
			$("a").tooltip();
			$("input").tooltip();
			$("img").tooltip();
		}
	};
    tooltip_init.init()

    $('.example-popover').popover({
        container: 'body'
    });
    var dcolor = $(".example-popover").attr("data-theme");
    if(dcolor == "dark") {
        $(".popover").addClass("bg-dark");
    }
})(jQuery);
