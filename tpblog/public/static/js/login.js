$(function(){

    var rules = {
        username: {
            required: true,
        },
        password: {
            required: true,
        },
    }
    var messages = {
        username: {
            required: '用户名不能为空',
        },
        password: {
            required: '密码不能为空',
        },
    }
    $(".login-form").validate({
        rules: rules,
        messages: messages,
        submitHandler: function() {
            $.ajax({
                url: $(".login-form").attr('action'),
                type: 'POST',
                dataType: 'json',
                data: $(".login-form").serialize(),
            })
            .done(function(response) {
                if (response.error) {
                    alert(response.error);
                    return false;
                }

                window.location.href = response.url;
            })
        }
    });
})