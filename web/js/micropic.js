/**
 * Created by 李洋 on 2015/7/22.
 */
$(document).ready(function () {
    var allowext = ['jpg','gif','bmp','png','jpeg'];
    $("#publish-img").on('change',function(){
        var files = !!this.files ? this.files:[];
        if(!files.length||!window.FileReader)
        return;
        if(/^image/.test(files[0].type)){
            var reader = new FileReader();
            reader.readAsDataURL(files[0]);
            reader.onloadend = function(){
                var parentwidth = parseInt($("#uploadimg").parent().css("width"))*2/3;
                var parentheight = parentwidth;
                //console.log("width"+parentwidth+"height"+parentheight);
                $("#uploadimg").css("width",parentwidth).css("height",parentheight).addClass("microimg").css("background-image","url("+this.result+")");
            }
        }
        //var file = $(this);
        //var content = $("#uploadimg");
        ////console.log($(this)+"###"+content);
        //try{
        //    micropic(file,content);
        //}catch (e){
        //    alert(e);
        //}
    });
});
//function micropic(file,content) {
//    var height = 0;
//    var width = 0;
//    var ext  = ';';
//    var size = 0;
//    var name = '';
//    var path = '';
//    var self = this;
//    if(file){
//        name = file.val();
//        console.log(name);
//        if(window.navigator.userAgent.indexOf("MSIE")>=1){
//            file.select();
//            path = document.selection.createRange().text;
//        }else if(window.navigator.userAgent.indexOf("FireFox")>=1){
//            if(file.files){
//                path = file.files.item(0).getAsDataURL();
//            }else{
//                path = file.value;
//            }
//        }
//    }else{
//        throw "pic error";
//    }
//    ext = name.substr(name.lastIndexOf("."),name.length);
//    if(container.tagName.toLowerCase()!='img'){
//        throw "container is not a valid img label";
//        container.visibility = 'hidden';
//    }
//    container.src = path;
//    container.alt = name;
//    container.style.visibility = "visible";
//    height = container.height;
//    width = container.width;
//    size = container.fileSize;
//
//    this.get = function(name){
//        return self[name];
//    };
//    this.isValid = function () {
//        if(allowext.indexOf(self.ext) !==-1){
//            throw "not allow file";
//            return false;
//        }
//    }
//}