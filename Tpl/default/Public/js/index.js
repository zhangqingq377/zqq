$(function(){
	$(".subMenu a").hover(function(){
		$(this).css("text-decoration","underline");
	},function(){
		$(this).css("text-decoration","none");
	});
	$(".subMenu").hover(function(){
		$(this).children("ul").slideDown();
	},function(){
		$(this).children("ul").hide();
	});
});
	