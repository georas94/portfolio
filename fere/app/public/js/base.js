$(document).ready(function () {
    $('.menu li').click(function (event) {
        event.preventDefault();
        let selector = $('.sub-'+$(this).attr('class'));
        if (selector.hasClass('show') && !(selector.hasClass('show') && selector.hasClass('hidden'))){
            selector.addClass('hidden');
            selector.removeClass('show');
        }else if(selector.hasClass('show hidden')){
            selector.removeClass('hidden');
            selector.addClass('show');
        }else{
            selector.removeClass('hidden');
            selector.addClass('show');
        }
        $('.subMenuItems div').each(function () {
            if (!($(this).attr('class') === selector.attr('class'))){
                $(this).addClass('hidden');
            }
        })
    })

    $('.close-mobile-sub-menu-button').click(function (event) {
        event.preventDefault();
        $(this).parent().removeClass('show');
        $(this).parent().addClass('hidden');
    })
})
