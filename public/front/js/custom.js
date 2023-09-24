var isMobile = {
    Android: function() {
        return navigator.userAgent.match(/Android/i);
    },
    BlackBerry: function() {
        return navigator.userAgent.match(/BlackBerry/i);
    },
    iOS: function() {
        return navigator.userAgent.match(/iPhone|iPad|iPod/i);
    },
    Opera: function() {
        return navigator.userAgent.match(/Opera Mini/i);
    },
    Windows: function() {
        return navigator.userAgent.match(/IEMobile/i);
    },
    any: function() {
        return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
    }
};


function call_api(data, callback){
    var action = CARD_API_URL;
    return $.ajax({
        url: action,
        type: 'POST',
        dataType: 'json',
        async: true,
        beforeSend: addOverlay,
        data: {
            _token: $('meta[name="csrf_token"]').attr('content'),
            data: data,
        },
        success: callback,
        complete: removeOverlay
    });
}

function check_captcha(value, callback){
    var action = CAPTCHA_URL;
    return $.ajax({
        url: action,
        type: 'POST',
        dataType: 'json',
        async: true,
        beforeSend: addOverlay,
        data: {
            _token: $('meta[name="csrf_token"]').attr('content'),
            data: value,
        },
        success: callback,
        complete: removeOverlay
    });
}

function check_login(data, callback){
    var action = CHECK_LOGIN_URL;
    return $.ajax({
        url: action,
        type: 'POST',
        dataType: 'json',
        async: true,
        beforeSend: addOverlay,
        data: {
            _token: $('meta[name="csrf_token"]').attr('content'),
            data: data,
        },
        success: callback,
        complete: removeOverlay
    });
}

function check_register(data, callback){
    var action = CHECK_REGISTER_URL;
    return $.ajax({
        url: action,
        type: 'POST',
        dataType: 'json',
        async: true,
        beforeSend: addOverlay,
        data: {
            _token: $('meta[name="csrf_token"]').attr('content'),
            data: data,
        },
        success: callback,
        complete: removeOverlay
    });
}
function apply_coupon(data, callback){
    var action = APPLY_COUPON_URL;
    return $.ajax({
        url: action,
        type: 'POST',
        dataType: 'json',
        async: true,
        beforeSend: addOverlay,
        data: {
            _token: $('meta[name="csrf_token"]').attr('content'),
            data: data,
        },
        success: callback,
        complete: removeOverlay
    });
}