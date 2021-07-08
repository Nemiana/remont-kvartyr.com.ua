//When DOM loaded insert link with image
$(document).ready(function(){
    $('body').append('<a href="#" id="go-top" title="Up"><img src="/images/go_top.png"></a>');
});
$(function() {
    $.fn.scrollToTop = function() {
        //Hide link
        $(this).hide().removeAttr("href");
        //If scroll is more than 200px, smoothly display the object
        if ($(window).scrollTop() >= "200") $(this).fadeIn("slow")
        var scrollDiv = $(this);
        //When page scroll, if scroll less than 200px, hide object, else - display
        $(window).scroll(function() {
            if ($(window).scrollTop() <= "200") $(scrollDiv).fadeOut("slow")
            else $(scrollDiv).fadeIn("slow")
        });
        //When click object, animate scroll to top
        $(this).click(function() {
            $("html, body").animate({scrollTop: 0}, "slow")
        })
    }
});
//Hang the handler on the link
$(function() {
    $("#go-top").scrollToTop();
});