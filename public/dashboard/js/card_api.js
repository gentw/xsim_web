function call_api(data, callback, overlay){
    if(overlay == undefined)
        overlay = true;
    var action = CARD_API_URL;
    return $.ajax({
        url: action,
        type: 'POST',
        dataType: 'json',
        async: true,
        beforeSend: function(){
            if(overlay)
                addOverlay();
        },
        data: {
            _token: $('meta[name="csrf_token"]').attr('content'),
            data: data,
        },
        success: callback,
        complete: function(){
            if(overlay)
                removeOverlay();
            if($(".history-list").length){
                $(".history-list").mCustomScrollbar();
            }
        }
    });
}
