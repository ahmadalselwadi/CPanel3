
/*! common */

function reload_captcha(){
    
    var captchaImg = $("img[id=captcha]");
    
    var seqId = Math.floor(Math.random()*1000);
    
    captchaImg.replaceWith('<img id="captcha" src="'+g_root_url+'captcha.php?seqId='+seqId+'" alt="captcha text" />');
    
}

Date.prototype.getFormatted = function() {
   var yyyy = this.getFullYear().toString();
   var mm   = (this.getMonth()+1).toString(); // getMonth() is zero-based
   var dd   = this.getDate().toString();
   return yyyy + '-' + (mm[1]?mm:"0"+mm[0]) + '-' + (dd[1]?dd:"0"+dd[0]); // padding
};

//d = new Date();
//d.getFormatted();

//function get_string(str_param){
//
//    var str_output = ( str_param == null ) ? "" : str_param;
//
//    return str_output;
//}