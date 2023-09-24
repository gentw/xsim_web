$(function () {
    /* Code to set sidebar li active */
    $('.page-sidebar-menu li').filter(function () {
        return $(this).hasClass('active');
    }).parent('ul').parent('li').addClass('active open');
    
    /**
     * Delete record from database
     */
    $(document).on('click', '.act-delete', function(e){
        e.preventDefault();
        var action = $(this).attr('href');
        bootbox.confirm('Are you sure! you want to delete this record?', function(res){
            if(res){
                $.ajax({
                    url: action,
                    type: 'DELETE',
                    dataType: 'json',
                    beforeSend:addOverlay,
                    data: {
                        _token: $('meta[name="csrf_token"]').attr('content')
                    },
                    success:function(r){
                        showMessage(r.status,r.message);
                        if (typeof oTable.draw !== "undefined")
                        { 
                            oTable.draw();
                        }
                        else if (typeof oTable.fnDraw !== "undefined")
                        { 
                            oTable.fnDraw();
                        }
                    },
                    complete:removeOverlay
                });
            }
        });
        
    });

    $(document).on('switchChange.bootstrapSwitch','.status-switch', function(event, state) {
        var $this = $(this);
        var customAct = typeof $(this).data('getaction') != 'undefined' ? $(this).data('getaction') : '';
        var val = state ? 'y' : 'n';
        var url = $(this).data('url');
        var action =  customAct != '' ? customAct : 'change_status'; 
        
        $.ajax({
            url: url,
            type: 'PUT',
            dataType: 'json',
            beforeSend:addOverlay,
            data: {
                _token: $('meta[name="csrf_token"]').attr('content'),
                action:action, 
                value:val
            },
            success:function(r){
                showMessage(r.status,r.message);
                if(r.status != 200){
                    $this.prop("checked", !$this.prop("checked"));
                }
                else {
                    if(oTable.attr('id') == 'device_table_DT'){
                        oTable.fnDraw();
                    }
                }
                removeOverlay();
            },
            complete:removeOverlay
        });
    });

    //start select all and delete records
    $(document).on('click', '.all_select', function () {
        console.log($(this).hasClass('allChecked'));
        if ($(this).hasClass('allChecked')) {
            $('.dataTable tbody input[class="small-chk"]').prop('checked', false);
        } else {
            $('.dataTable tbody input[class="small-chk"]').prop('checked', true);
        }
        $(this).toggleClass('allChecked');
    });

    $(document).on('click', '.dataTable tbody input[class=small-chk]', function () {
        var numberOfChecked = $('.dataTable tbody input[class="small-chk"]:checked').length;
        var totalCheckboxes = $('.dataTable tbody input[class="small-chk"]').length;

        if(numberOfChecked > 0){
            if(numberOfChecked == totalCheckboxes){
                $('.all_select').prop('indeterminate',false);
                $('.all_select').prop('checked', true);
                $('.all_select').addClass('allChecked');
            }else{
                if ($('.all_select').hasClass('allChecked')) {
                    $('.all_select').removeClass('allChecked');
                }
                $('.all_select').prop('indeterminate',true);
            }
        }
        else{
            $('.all_select').prop('indeterminate',false);
            $('.all_select').prop('checked', false);
        }
    });

    $(document).on("click",".delete_all_link", function (e) {
        $(".delete_all_link").attr("disabled", "disabled");
        e.preventDefault();
        var url = $(this).attr('href');
        var searchIDs =[];
        $(".dataTable tbody input[class='small-chk']:checked").each(function() {
            searchIDs.push($(this).val());
        });
        if(searchIDs.length > 0){
            var ids = searchIDs.join();
            bootbox.confirm("Are you sure you want to delete selected records?", function(result) {
                if(result)
                {
                    $.ajax({
                        url: url,
                        type: 'DELETE',
                        beforeSend: addOverlay,
                        dataType: 'json',
                        data: {
                            action:'delete_all',
                            ids:ids,
                            _token: $('meta[name="csrf_token"]').attr('content')
                        },
                        success:function(r){
                            showMessage(r.status,r.message);
                            if (typeof oTable.draw !== "undefined"){ 
                                oTable.draw();
                            }
                            else if (typeof oTable.fnDraw !== "undefined"){ 
                                oTable.fnDraw();
                            }
                            setTimeout(function(){ 
                              $('.all_select').prop('indeterminate',false);$('.all_select').prop('checked', false); 
                                if ($('.all_select').hasClass('allChecked')) {
                                $('.all_select').removeClass('allChecked');} }, 1000); 
                        },
                        complete:removeOverlay
                    }); 
                }
                $(".delete_all_link").removeAttr("disabled");
            });
        }else{
            bootbox.alert('please select at-least one record',function(){ 
                $('.all_select').prop('indeterminate',false);
                $(".delete_all_link").removeAttr("disabled"); 
            });
        }
    });
});
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
function addOverlay(){$('<div id="overlayDocument"><img src="' + GLOBAL_ASSET + '/images/loading.gif" /></div>').appendTo(document.body);}
function removeOverlay(){$('#overlayDocument').remove();}

/* start jquery validation methos */
jQuery.validator.addMethod("not_empty", function(value, element) {
    return this.optional(element) || /\S/.test(value);
}, "Only space is not allowed.");

jQuery.validator.addMethod("valid_email", function(value, element) {
    return this.optional(element) || /^([\w-\.]+@([\w-]+\.)+[\w-]{2,})?$/.test(value);
}, "Please enter a valid email address.");

jQuery.validator.addMethod("no_space", function(value, element) { 
    return value.indexOf(" ") < 0 && value != "";
}, "Space is not allowed.");

jQuery.validator.addMethod("alpha_numeric", function(value, element) {
    return this.optional(element) || /^[a-zA-Z0-9\s]+$/.test(value);
}, "This field may only contain letters, numbers and space.");

jQuery.validator.addMethod("lettersonly", function(value, element) {
  return this.optional(element) || /^[a-zA-Z\s]+$/.test(value);
}, "Please enter only letters"); 
/* end jquery validation methods */