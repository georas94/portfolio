$(function () {
    let spanPMenu = $('.span-principal-menu');
    spanPMenu.on('mouseenter',function (event) {
        event.preventDefault();
        manageNavbar($(this))
    })
    spanPMenu.on('click tap touchstart',function (event) {
        event.preventDefault();
        manageNavbar($(this))
    })
    $('.menu-icon').on('click tap', function (event) {
        let selectors = spanPMenu.next('ul').find('div');
        selectors.each(function () {
            if ($(this).hasClass('show')){
                $(this).addClass('hidden');
            }
        })
    })

    $('.subscription-card').on('click tap', function (event) {
        $('.subscription-card').each(function () {
            if ($(this).hasClass('is-selected')){
                $(this).removeClass('is-selected');
            }
        });
        $(this).addClass('is-selected');
    });
    $('.payment-card').on('click tap', function (event) {
        $('.payment-card').each(function () {
            if ($(this).hasClass('is-selected')){
                $(this).removeClass('is-selected');
            }
        });
        $(this).addClass('is-selected');
    });
})

function manageNavbar(spanPrincipalMenu){
    let selector = spanPrincipalMenu.next('ul').find('div');
    let selectors = $('.span-principal-menu').next('ul').find('div');
    selectors.each(function () {
        if (!($(this).attr('class') === selector.attr('class'))){
            $(this).addClass('hidden');
        }
    })
    if (selector.hasClass('show') && !(selector.hasClass('show') && selector.hasClass('hidden'))){
        selector.removeClass('show');
        selector.addClass('hidden');
    }else if(selector.hasClass('show hidden')){
        selector.removeClass('hidden');
        selector.addClass('show');
    } else{
        selector.removeClass('hidden');
        selector.addClass('show');
    }
}
