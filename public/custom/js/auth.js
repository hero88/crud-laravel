jQuery(function () {
    if (jQuery('#frm_auth').length) {
        jQuery('#frm_auth').on('submit', function (e) {
            e.preventDefault();
            jsauth();
        });
    }

    if (jQuery('#frm_forgot').length) {
        jQuery('#frm_forgot').on('submit', function (e) {
            e.preventDefault();
            jsforgot();
        });
    }

    if (jQuery('#frm_reset').length) {
        jQuery('#frm_reset').on('submit', function (e) {
            e.preventDefault();
            jsreset();
        });
    }
});
//auth
function jsauth() {
    var frm = jQuery('#frm_auth');

    if (frm.find('input[id="action"]').val() === 'login')
        jslogin(frm)
    else jssignup(frm);

}

function jslogin(frm) {
    const emailRegex = new RegExp(/^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/);
    if(!frm.find('input[id="email"]').val() || !emailRegex.test(frm.find('input[id="email"]').val())) {
        frm.find('.coolinput.email').append('<div class="text-danger">The email you entered is not in the correct format. </div>');
        if(!frm.find('input[id="password"]').val()) {
            frm.find('.coolinput.password').append('<div class="text-danger">Please fill password.</div>');
        }
        return;
    }

    frm.find('.frm_button button').hide();
    frm.find('.frm_button').append('<div class="loading"><div class="loading__bar"></div></div>');
    // frm[0].submit();
}

function jssignup() {
    // if()

}

function jsforgot() {
    var frm = jQuery('#frm_forgot');
    frm.find('.error_message').addClass('hidden');
    frm.find('.frm_button button').hide();
    frm.find('.frm_button').append(gks.htmlLoading);

    jQuery.ajax({
        url: gks.baseURL + '/auth/do-forgot',
        type: 'post',
        data: {
            _token: gks.authAJ,
            email: frm.find('input[name=email]').val().trim(),
        },
        success: function (response) {
            if (response.VALID) {
                frm.find('.error_message .alert').text("Hệ thống đã gửi cho bạn 1 email. Vui lòng truy cập email và thực hiện theo các bước.")
                    .addClass('alert-success')
                    .removeClass('alert-danger');
            } else {
                if (response.ERR === 'INVALID') {
                    frm.find('.error_message .alert').text(gks.tsNoFound);
                } else if (response.ERR === 'NOT_FOUND') {
                    frm.find('.error_message .alert').text("Không tìm thấy email trong hệ thống.");
                } else if (response.ERR === 'BLOCKED') {
                    frm.find('.error_message .alert').text("Tài khoản của bạn đã bị chặn truy cập.");
                } else if (response.ERR === 'NOT_ALLOWED') {
                    frm.find('.error_message .alert').text(gks.tsNoAccess);
                }

                frm.find('.error_message .alert')
                    .removeClass('alert-success')
                    .addClass('alert-danger');
            }

            frm.find('.error_message').removeClass('hidden');
            frm.find('.frm_button button').show();
            frm.find('.js_loading').remove();
        }
    });
}
function jsreset() {
    var frm = jQuery('#frm_reset');
    frm.find('.error_message').addClass('hidden');
    var pass1 = frm.find('input[name=password]').val();
    var pass2 = frm.find('input[name=password_confirm]').val();

    if (!(pass1 === pass2)) {
        frm.find('.error_message .alert').text("[Mật khẩu mới] và [Xác nhận mật khẩu] không giống nhau.")
            .removeClass('alert-success')
            .addClass('alert-danger');

        frm.find('.error_message').removeClass('hidden');
        return false;
    }

    frm.find('.frm_button button').hide();
    frm.find('.frm_button').append(gks.htmlLoading);

    jQuery.ajax({
        url: gks.baseURL + '/auth/do-reset',
        type: 'post',
        data: {
            _token: gks.authAJ,
            value: pass1,
            key: frm.find('input[name=user]').val().trim(),
        },
        success: function (response) {
            if (response.VALID) {
                frm.find('.error_message .alert').text(gks.tsOkChange)
                    .addClass('alert-success')
                    .removeClass('alert-danger');
            } else {
                if (response.ERR === 'INVALID') {
                    frm.find('.error_message .alert').text(gks.tsNoFound);
                }

                frm.find('.error_message .alert')
                    .removeClass('alert-success')
                    .addClass('alert-danger');
            }

            frm.find('.error_message').removeClass('hidden');
            frm.find('.frm_button button').show();
            frm.find('.js_loading').remove();
        }
    });
}






