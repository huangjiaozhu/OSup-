/**
 * Created by 李洋 on 2015/8/1.
 */
$(document).ready(function(){
    var totalp=$(".rank p");
    var countp =0;
    var totalwidth = parseInt(totalp.css("width"));
    totalp.each(function(){
        countp+=parseInt($(this).text());
    });
    totalp.each(function (index,elem) {
        switch (index){
            case 0:
                $(this).css("background-color","red");
                break;
            case 1:
                $(this).css("background-color","orange");
                break;
            case 2:
                $(this).css("background-color","green");
                break;
            default :
                $(this).css("background-color","silver");
                break;
        }
        $(this).css("width","0px");
        $(this).animate({
            width:parseInt($(this).text())==0?"10px":parseInt($(this).text())/countp*totalwidth+"px",
            height:"20px"
        },1000);
        console.log(parseInt($(this).text())/countp*totalwidth+"px");
    });
    //console.log(totalwidth);
});