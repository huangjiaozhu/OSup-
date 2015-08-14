/**
 * Created by 李洋 on 2015/8/13.
 */
$(document).ready(function () {
    $(".re-recomment").on("click", function () {
        $(this).parents().find(".recomment-hide").hide();
        $(this).parent().next().show();
    });
    $(".createcomment").on("click", function () {
        $(this).parents(".comment").siblings().find(".comment-add .recomment-hide").hide();
        $(this).parent().next().show();
    });
});