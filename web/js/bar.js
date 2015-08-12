/**
 * Created by 李洋 on 2015/8/9.
 */
$(document).ready(function () {
    $(".item-content").on('mouseover', function () {

        $(this).find(".icon").stop().animate({
            top:"-70px"
        },1000);
        $(this).find(".text").stop().animate({
            top:"8px"
        },1000);
        $(this).siblings().find(".bar-img").stop().animate({
            width:"144px",
            opacity:1
        },1000);
    });
    $(".item-content").on('mouseout', function () {
        $(this).siblings().find(".bar-img").stop().animate({
            width:"1.44px",
            opacity:0
        },1000);
        $(this).find(".icon").stop().animate({
            top:"0px"
        },1000);
        $(this).find(".text").stop().animate({
            top:"70px"
        },1000);
    });
});