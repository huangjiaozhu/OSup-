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
        var panel = "<div class='panel panel-default'> <div class='panel-heading'> <h3 class='panel-title'>详细信息 </h3>";
        panel+="</div><div class='panel-body'> <div id='mailmsgbk'> <div id='mailmsg'> <h3 class='mailtt'>";
        panel+=subject;
        panel+="<div class='btn-group pull-right'>";
        panel+="<button type='button' id='distribute' class='btn btn btn-info btn-lg'>已阅<span  class='sr-only'>";
        panel+=id;
        panel+="</button>";
        panel+="<button type='button' class='btn btn btn-primary btn-lg' onclick='window.location.href=\"?r=mail\"'>回复</button>";
        panel+="<button type='button' class='btn btn btn-success btn-lg'>转发</button>";
        panel+="</div>";
        panel+="</br> </h3><div><span class='mailmst'>发件人:</span> ";
        panel+=sender;
        panel+="</div> <div><span class='mailmst'>时　间:</span>";
        panel+=sendtime;
        panel+="</div><div><spanclass='mailmst'>附　件:</span>无</div>";
        //panel+="<div ><span class='mailmst'>分发至:</span><select>";
        //panel+="<option>1</option> <option>2</option> <option>3</option> <option>4</option> <option>5</option> <option>6</option> <option>7</option> <option>8</option> <option>9</option> <option>10</option> </select> </div> " +
        panel+="</div></div>";

        //
        //var panel = "<div class='panel panel-default'><div class='panel-heading'>";
        //    panel += "<h3 class='panel-title' style='font-weight:bold;'>";
        //    panel+="<span class='label label-default'>主题</span>";
        //    panel+="<i class='glyphicon glyphicon-th-list'></i>";
        //    panel+=subject;
        //    panel+="<button type='button' class='btn btn btn-primary pull-right'>分发</button>";
        //    panel+="</h3> </div> <div class='panel-body'>";
        //    panel+="<div><label class='label-warning'>发件人:</label>"+sender+"</div>";
        //    panel+="<div><label class='label-danger'>时间:</label>"+sendtime+"</div>";
        //    panel+="<div><label class='label-success'>附件:</label>无</div>";
        panel+="<div>";
        panel+=text;
        panel+="</div> </div> <div class='panel-footer'> <div><h4><span class='label label-default'>附件信息：</span></h4></div>";
        panel+="</div> </div>";
        $("#content").html(panel);
        //$("#mailmsg").delegate('button','click', function () {
        //    //console.log("click");
        //    var id = $(this).find("span").text();
        //    var userid = $(":selected").val();
        //    //var temp = $(this);
        //    //console.log(id);
        //    $.post("http://localhost/index.php/?r=distribute/handle",{id:id}, function (data) {
        //        //alert(data);
        //        //temp.remove();
        //    });
        //    $.post("http://localhost/index.php/?r=distribute/insert",{userid:userid,emailid:id},function(data)
        //    {
        //        alert(data);
        //    });
        //});
    });

});
