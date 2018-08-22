function append_error(form_group,error_msg) {
	form_group.addClass('has-error');
	form_group.find('.error-msg').remove();
	form_group.append('<span class="help-block error-msg"> + error_msg + <span>');
}

function remove_error(form_group) {
	form_group.removeClass('has-error');
    form_group.find('.error-msg').remove();
}