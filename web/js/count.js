/**
 * Created by 李洋 on 2015/7/21.
 */
$(document).ready(function(){
    var flag = false;//定义动画是否进行
    //异步加载绑定事件父元素必须是已经存在的元素。。。
    $(".content .count").on('click',"a",function(){
        //console.log($(this).parents(".chapter"));
        var userid = $("#sessionuser").find("span").text();
        if(userid==""){
            alert("需要登录");
            return;
        }else{
            var selectedchapter = parseInt($(this).parents(".chapter").find(".sr-only").text());
            var str = "good";
            var savethis = $(this);
            var type = ($(this).attr("class")).indexOf(str)!=-1?1:0;
            //console.log(type);
            var count = parseInt(savethis.find(".num").text());
            //console.log("count:"+count);
            //console.log('选中的段落'+selectedchapter);
            $.post(
                "?r=test/click",
                {
                    //userid:userid,
                    chapterid:selectedchapter,
                    type:type
                },
                function(result){
                    var message = "<div><span class='msg'>您已经表过态了！</span></div>";
                    if(result=="isclick"){
                        if(flag)
                            return;
                        else{
                            flag=true;
                            if(savethis.parents(".foot").length>0)
                                $(message).insertAfter(savethis.parents(".foot").siblings(".head"));
                            else
                                $(message).appendTo(savethis.parents(".head"));
                            $(".msg").animate({'opacity':'1.0'},2000, function () {
                                $(".msg").parent().remove();
                                flag=false;
                            });
                        }
                    }
                    else {
                        var changespan=savethis.find((".num"));
                        changespan.html(count+1+"&nbsp;&nbsp;");
                    }
                }
            );
        }
    });
});
