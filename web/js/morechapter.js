/**
 * Created by 李洋 on 2015/7/22.
 */
    //$(document).ready(function(){
    //
    //});
var morechaptercount = 0;
$("#morechapter").on('click', function () {
    var loading = "<div class='loading'><span class='fa fa-spin fa-spinner fa-4x'></span></div>";
    $.ajax({
        url:'?r=test/morechapter',
        type:'POST',
        dataType:'json',
        data:{chapterpage:morechaptercount},
        beforeSend:function(){
            $(loading).insertBefore($("#morechapter"));
        },
        success:function(json){
            var chapter = "";
            $(json).each(function(i,value){
                chapter+="<div class='chapter'>";
                chapter+="<div class='head'>";
                chapter+="<span id='idchapter"+value.id+"' class=' sr-only'>"+value.id+"</span>";
                if(value.author_img==""){
                    chapter+="<img class='userimg' src='./img/jiaozhu1.png'>";
                }
                else{
                    chapter+="<img class='userimg' src='"+value.author_img+"'>";
                }
                chapter+=value.author;
                chapter+="</div>";
                chapter+="<div class='describe'>";
                chapter+=value.describe;
                chapter+="</div>";
                chapter+="<div>";
                if(value.bodyimg!='')
                    chapter+="<img src='"+value.bodyimg+"' class='bodyimg'>";
                chapter+="</div>";
                if(value.bestanswer!="")
                {
                    chapter+="<div class='chat'>";
                    chapter+="<div class='bestanswer'>";
                    chapter+="<div class='nav' style='float: left'>";
                    chapter+="<span class='glyphicon glyphicon-star'></span>";
                    chapter+="<span>神回复</span>";
                    chapter+="</div>";
                    chapter+="<div class='nav' style='float: right'>";
                    chapter+="<span class='glyphicon glyphicon-user'></span>";
                    chapter+="<span>"+value.answername+"</span>";
                    chapter+="</div>";
                    chapter+="<!--            span是行内元素，不会另起一行-->";
                    chapter+="<!--            div是块级元素两个div会另起一行-->";
                    chapter+="</div>";
                    chapter+="<div class='chatmessage'>";
                    chapter+=value.bestanswer;
                    chapter+="</div>";
                    chapter+="</div>";
                }
                chapter+="<hr/>";
                chapter+="<div class='foot' style='min-width: 290px'>";
                chapter+="<div id='' class='nav count' style='float: left'>";
                chapter+="<a class='fa-2x good' href='javascript:void(0)'><span class='fa fa-smile-o'>&nbsp;</span><span class='line num'>"+value.countgood+"&nbsp;&nbsp;</span></a>";
                chapter+="<a class='fa-2x bad' href='javascript:void(0)'><span class='fa fa-meh-o'>&nbsp;</span><span class='num'>"+value.countbad+"&nbsp;&nbsp;</span></a>";
                chapter+="</div>";
                chapter+="<div class='nav' style='float: right'>";
                chapter+="<a class='fa-2x' href='?r=test/comment&id="+value.id+"'><span class='fa fa-comments-o'>&nbsp;</span><span>"+value.totalcomment+"&nbsp;&nbsp;</span></a>";
                chapter+="<a class='fa-2x href='javascript:void(0)'><span class='fa fa-share-square-o'>&nbsp;</span><span>分享</span></a>";
                chapter+="</div>";
                chapter+="</div>";
                chapter+="</div>";
            });
            $(".loading").remove();
            $(chapter).insertBefore($("#morechapter"));
            morechaptercount++;
            //console.log(chapter);
        },
        error:function(XMLHttpRequest,textStatus,errorThrown){
            console.log(XMLHttpRequest.status);
            console.log(XMLHttpRequest.readyState);
            console.log(textStatus);
        }
    });
    //$.post('?r=test/morechapter',{'chapterpage':morechaptercount}, function (data) {
    //    console.log(data);
    //});
});
