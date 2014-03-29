(function($) {

	$(document).ready(function() {
		$(".child-content .entry-title a").each(function() {
			if ($(this).parents(".child-content").find(".entry-content").html() == "") {
				$(this).css("pointer-events","none").css("text-decoration","none");
			}
			$(this).click(function(ev) {
				ev.preventDefault();
				$(this).parents(".child-content").find(".entry-content").fadeToggle("fast",function() {
					if ($(this).parents(".child-content").find(".entry-content:visible").length > 0)
						$(this).parents(".child-content").addClass("visible");
					else
						$(this).parents(".child-content").removeClass("visible");
				});
				
				
			});
		});
		$(".child-contents").before("<div id='tte_expand_collapse_children'><a href='#' class='expand'>visa alla</a> <a href='#' class='collapse'>st&auml;ng alla</a></div>");
		$("#tte_expand_collapse_children a").click(function(ev) {
			ev.preventDefault();
			if ($(this).hasClass("expand")) {
				$(".child-content .entry-title a").each(function() {
					if ($(this).parents(".child-content").find(".entry-content").html() != "") {
						$(this).parents(".child-content").addClass("visible").find(".entry-content").fadeIn("fast");
					}
				});
			}
			else {
				$(".child-content .entry-title a").each(function() {
					if ($(this).parents(".child-content").find(".entry-content").html() != "") {
						$(this).parents(".child-content").removeClass("visible").find(".entry-content").fadeOut("fast");
					}
				});			
			}
		});
	});
})(jQuery);
