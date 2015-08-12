$(document).ready(function(){
    $(".submenu").hide();
    var flag=1;
    $("#pull").click(function(){
        $(".submenu").toggle(300);
        if (flag==1) {$("#pullico").removeClass("glyphicon-chevron-down").addClass("glyphicon-chevron-up");flag=0;}
        else{$("#pullico").removeClass("glyphicon-chevron-up").addClass("glyphicon-chevron-down");flag=1;};
    });
    $("#huifu").click(function(){
        $(".submenu1").toggle(300);
    });

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
    subcat[0] = new Array('001','张芳芳','张芳芳');
    subcat[1] = new Array('001','李磊','李磊');
    subcat[2] = new Array('010','天使焦','天使焦');
    subcat[3] = new Array('010','海涛','海涛');
    subcat[4] = new Array('011','峰哥','峰哥');
    subcat[5] = new Array('011','王二狗','王二狗');
    subcat[6] = new Array('011','蛛丝马迹','蛛丝马迹');
    subcat[7] = new Array('100','大酒神','大酒神');
    for (var i=0; i<subcat.length; i++)
        $("#friends").append("<option value='"+subcat[i][1]+"'>"+subcat[i][2]+"</option>");

    $("#friendGroups").change(function(){
        $("#friends").empty();
        var id=$(this).children('option:selected').val();
        if(id != "") {
            $("#friends").empty();
            for (var i=0; i<subcat.length; i++)
            {
                if (subcat[i][0] == id)
                {
                    $("#friends").append("<option value='"+subcat[i][1]+"'>"+subcat[i][2]+"</option>");
                }
            }
        }
        else {
            for (var i=0; i<subcat.length; i++)
                $("#friends").append("<option value='"+subcat[i][1]+"'>"+subcat[i][2]+"</option>");

        }



    });
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







});