;
(function($) {
	$.fn.ShowMask = function(options) {
		var defaults = {
			top : $(window).height()/2-10,
			left : $(window).width()/2
		}
		var options = $.extend(defaults, options);
		$("html")
				.append(
						'<div id="ui-mask"></div><div id="ui-mask-div" style="z-index: 99999;position: fixed;top:'
								+ options.top
								+ 'px;left:'
								+ options.left
								+ 'px;"><span>loading......</span></div>')
		_this_ = $("#ui-mask");

		_this_.height($(document).height())
		_this_.show();
	};
	$.fn.HideMask = function(options) {
		_this_ = $("#ui-mask");
		_this_.remove();
	};
})(jQuery);
