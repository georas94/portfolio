$(function () {
    let errorDivUl = $('.shift-form-element-div div ul');
    if (errorDivUl.length > 0) {
        errorDivUl.addClass('field-errors');
        errorDivUl.parent().find('input').addClass('is-invalid');
    }
});
