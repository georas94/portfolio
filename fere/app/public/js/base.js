$(document).ready(function () {
    $('.menu li').click(function (event) {
        event.preventDefault();
        $('.menu div').each(function () {
                $(this).addClass('hidden');
        })
        let selector = $('.sub-'+$(this).attr('class'));
        if (selector.hasClass('show')){
            selector.addClass('hidden');
            selector.removeClass('show');
        }else{
            selector.removeClass('hidden');
            selector.addClass('show');
        }
    })
})
