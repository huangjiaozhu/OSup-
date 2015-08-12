/**
 * Created by 李洋 on 2015/7/26.
 */
$(document).ready(function () {
    $(".commentsubmit").on('click',function(){
        var id = $(".addcomment").find("span").text();
        var comment = $("#addcomment").val();
        var replyer = $("#sessionuser").find("a").text();
        var userid = $("#sessionuser").find("span").text();
        //console.log("id:"+id+"commnet:"+comment+"replyer:"+replyer);
        if(comment!=""&&userid!=""){
            $.ajax({
                url: '?r=test/addcomment',
                type: 'POST',
                dataType: 'json',
                data: {id: id,comment:comment,replyer:replyer,userid:userid},
                success: function (data) {
                    console.log(data);
                    var addcomment = "";
                    var spanid = 'id'+id;
                    addcomment+="<div class='head' style='position: relative'>";
                    addcomment+="<div class='count' style='position: relative'>";
                    addcomment+="<span id=spanid class='sr-only'>id</span>";
                    addcomment+="<img style='vertical-align: middle' class='userimg' src='./img/jiaozhu1.png'>";
                    addcomment+="<span><strong>"+replyer+"</strong></span>";
                    addcomment+="<span style='position: absolute;right: 5px;top: 40%'>";
                    addcomment+="<a href='javascript:void(0)'><span class='glyphicon glyphicon-thumbs-up'>&nbsp;</span></a><span>12&nbsp;&nbsp;</span>";
                    addcomment+="</span>";
                    addcomment+="</div>";
                    addcomment+="</div>";
                    addcomment+="<div class='comment' style='clear: both'>";
                    addcomment+="<span>"+comment+"</span>";
                    addcomment+="</div>";
                    addcomment+="<hr/>";
                    //console.log(addcomment);
                    $(".comments").prepend(addcomment);
                    $("#addcomment").val("");
                },
                error:function(XMLHttpRequest,textStatus,errorThrown){
                    console.log(XMLHttpRequest.status);
                    console.log(XMLHttpRequest.readyState);
                    console.log(textStatus);
                }
            });
        }
        else if(comment==""){
            alert("评论不能为空!");
        }
        else{
            alert("请先登录");
        }
    });
});