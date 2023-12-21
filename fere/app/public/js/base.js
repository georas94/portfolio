$(function () {
    let subMenuItemsDiv = $('.subMenuItems .items');
    $('.menu li').on('click',function (event) {
        event.preventDefault();
        let selector = $('.sub-'+$(this).attr('class'));
        if (selector.hasClass('show') && !(selector.hasClass('show') && selector.hasClass('hidden'))){
            selector.addClass('hidden');
            selector.removeClass('show');
        }else if(selector.hasClass('show hidden')){
            selector.removeClass('hidden');
            selector.addClass('show');
            if(subMenuItemsDiv.is(':visible')) {
                selector.css('position', 'fixed');
            }
        }else{
            selector.removeClass('hidden');
            selector.addClass('show');
            if(subMenuItemsDiv.is(':visible')) {
                selector.css('position', 'fixed');
            }
        }
        subMenuItemsDiv.each(function () {
            if (!($(this).attr('class') === selector.attr('class'))){
                $(this).addClass('hidden');
            }
        })
    })

    $('.menu-icon').on('click', function () {
        if (subMenuItemsDiv.is(':visible')){
            subMenuItemsDiv.addClass('hidden');
        }
    })

    $('.close-mobile-sub-menu-button').on('click',function (event) {
        event.preventDefault();
        $(this).parent().removeClass('show');
        $(this).parent().addClass('hidden');
    })
})
