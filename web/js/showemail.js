/**
 * Created by 李洋 on 2015/7/3.
 */
$(document).ready(function(){
    $("td a").on('click',function() {
        var text = $(this).parent().siblings().find("#text").text();
        var sender = $(this).parent().siblings().find("#sender").text();
        var subject = $(this).text();
        var sendtime = $(this).parent().siblings().find("#sendtime").text();
        var id = $(this).parent().siblings().find("#id").text();

        //alert(id+"#"+text);
        $("#content").empty();

        var panel="";


        var panel = "<div class='panel panel-default'> <div class='panel-heading'> <h3 class='panel-title'>详细信息 </h3>";
        panel+="</div><div class='panel-body'> <div id='mailmsgbk'> <div id='mailmsg'> <h3 class='mailtt'>";
        panel+=subject;
        panel+="<button type='button' rel='rs-dialog' data-target='myModal1' id='distribute' class='btn btn btn-primary btn-lg pull-right'><span  class='sr-only'>";
        panel+=id+"</span>分发</button> </br> </h3><div><span class='mailmst'>发件人:</span> ";
        panel+=sender;
        panel+="</div> <div><span class='mailmst'>时　间:</span>";
        panel+=sendtime;
        panel+="</div><div><spanclass='mailmst'>附　件:</span>无</div>";

        panel+="<div >";
        panel+="</div> </div></div>";
            panel+="<div>";
            panel+=text;
            panel+="</div> </div> <div class='panel-footer'> <div><h4><span class='label label-default'>附件信息：</span></h4></div>";
            panel+="</div> </div>";
        $("#content").append(panel);
        $('body').append('<div class="rs-overlay" />');
        $("button[rel='rs-dialog']").each(function(){
            var trigger 	= $(this);
            var rs_dialog 	= $('#' + trigger.data('target'));
            var rs_box 		= rs_dialog.find('.rs-dialog-box');
            var rs_close 	= rs_dialog.find('.close');
            var rs_overlay 	= $('.rs-overlay');
            if( !rs_dialog.length ) return true;

            // Open dialog
            trigger.click(function(){
                //Get the scrollbar width and avoid content being pushed
                var w1 = $(window).width();
                $('html').addClass('dialog-open');
                var w2 = $(window).width();
                c = w2-w1 + parseFloat($('body').css('padding-right'));
                if( c > 0 ) $('body').css('padding-right', c + 'px' );

                rs_overlay.fadeIn('fast');
                rs_dialog.show( 'fast', function(){
                    rs_dialog.addClass('in');
                });
                return false;
            });

            // Close dialog when clicking on the close button
            rs_close.click(function(e){
                rs_dialog.removeClass('in').delay(150).queue(function(){
                    rs_dialog.hide().dequeue();
                    rs_overlay.fadeOut('slow');
                    $('html').removeClass('dialog-open');
                    $('body').css('padding-right', '');
                });
                return false;
            });

            // Close dialog when clicking outside the dialog
            rs_dialog.click(function(e){
                rs_close.trigger('click');
            });
            rs_box.click(function(e){
                e.stopPropagation();
            });
        });
        var subcat = new Array();
        var temp = $("#user").find("li");
        var length=temp.length;
        //console.log(length);
        for(var i=0;i<length;i++)
        {
            subcat[i]= new Array(0,temp[i].innerHTML,temp[i].innerHTML)
        }
        for (var i=0; i<subcat.length; i++)
            $("#friends").append("<option value='"+subcat[i][1]+"'>"+subcat[i][2]+"</option>");
        console.log(subcat);
        console.log($("#friends"));
        //$("#friendGroups").change(function(){
        //    $("#friends").empty();
        //    var id=$(this).children('option:selected').val();
        //    if(id != "") {
        //        $("#friends").empty();
        //        for (var i=0; i<subcat.length; i++)
        //        {
        //            if (subcat[i][0] == id)
        //            {
        //                $("#friends").append("<option value='"+subcat[i][1]+"'>"+subcat[i][2]+"</option>");
        //            }
        //        }
        //    }
        //    else {
        //        for (var i=0; i<subcat.length; i++)
        //            $("#friends").append("<option value='"+subcat[i][1]+"'>"+subcat[i][2]+"</option>");
        //
        //    }
        //
        //
        //
        //});
        $("#friends").change(function(){

            var allname = $("#allName").val();
            var flag = 1;
            name=$(this).children('option:selected').val();
            if(allname.length>0) {
                var arrname = allname.split(';');
                for(var i=0;i<arrname.length;i++) {

                    if(arrname[i] == name) {
                        flag = 0;
                        break;
                    }
                }
            }
            if(flag==1)
                $("#allName").val($("#allName").val()+name+";");

        });
        var to = $("#allName").val();
        console.log(to);
        //$.post("?r=distribute/handle",{to:to}, function (data) {
            //alert(data);
        //});
        //$("#mailmsg").delegate('button','click', function () {
        //    //console.log("click");
        //    var id = $(this).find("span").text();
        //    var userid = $(":selected").val();
            //var temp = $(this);
            //console.log(id);
            //$.post("?r=distribute/handle",{id:id}, function (data) {
            //    //alert(data);
            //    //temp.remove();
            //});
            //$.post("?r=distribute/insert",{userid:userid,emailid:id},function(data)
            //{
            //    alert(data);
            //});
        });
    })
