/********** Flash Message Script Start **********/
function getStatusText(code)
{
    sText = "";
    if(code !== undefined)
    {
        switch(code)
        {
            case 200:{ sText = 'Success'; break;}
            case 404:{ sText = 'Error';break;}
            case 403:{ sText = 'Error';break;}
            case 500:{ sText = 'Error';break;}
            case "success": { sText = "Success"; break;}
            case "danger":{ sText = 'Error';break;}
            case "warning":{ sText = 'Error';break;}
            default:{sText = 'Error';}
            
        }
    }
    return sText;
}

function showMessage(sType,sText){
    sType = getStatusText(sType);
    toastr[sType.toLowerCase()](sText);
}
/********** Flash Message Script Start **********/

/********** Overlay Script Start **********/
function addOverlay(){$('<div id="overlayDocument"><img src="' + GLOBAL_ASSET + '/images/loading.gif" /></div>').appendTo(document.body);}

function removeOverlay(){$('#overlayDocument').remove();}
/********** Overlay Script End **********/

/********** Jquery Validation Methods Start **********/
$.validator.addMethod("not_empty", function(value, element) {
    return this.optional(element) || /\S/.test(value);
}, "Only space is not allowed.");

$.validator.addMethod("valid_email", function(value, element) {
    return this.optional(element) || /^([\w-\.]+@([\w-]+\.)+[\w-]{2,})?$/.test(value);
}, "Please enter a valid email address.");

$.validator.addMethod("no_space", function(value, element) { 
    return value.indexOf(" ") < 0;
}, "Space is not allowed.");

$.validator.addMethod("alpha_numeric", function(value, element) {
    return this.optional(element) || /^[a-zA-Z0-9\s]+$/.test(value);
}, "This field may only contain letters, numbers and space.");

$.validator.addMethod("lettersonly", function(value, element) {
  return this.optional(element) || /^[a-zA-Z\s]+$/.test(value);
}, "Please enter only letters"); 

$.validator.addMethod('minImageWidth', function(value, element, minWidth) {
    return $(element).data('imageWidth') == minWidth || $(element).data('imageWidth') == undefined;
}, function(minWidth, element) {
    return "Image must be of 728 * 90 dimensions";
});

$.validator.addMethod('minImageHeight', function(value, element, minHeight) {
    return $(element).data('imageHeight') == minHeight || $(element).data('imageHeight') == undefined;
}, function(minHeight, element) {
    return "Image must be of 728 * 90 dimensions";
});



/********** Jquery Validation Methods End **********/