$(function () {
    if (sessionStorage.getItem('cart-quantity')){
        let cartCountSelector = $('.cart-count');
        cartCountSelector.text( parseInt(sessionStorage.getItem('cart-quantity')));
        cartCountSelector.data('count', parseInt(sessionStorage.getItem('cart-quantity')));
    }
    $('#cart_clear').on('click tap touchstart',function () {
        sessionStorage.removeItem('cart-quantity');
    })
    $('.logout').on('click tap touchstart',function () {
        sessionStorage.removeItem('cart-quantity');
    })
    $('.cart_items_remove').on('click tap touchstart',function () {
        var suffix = this.id.match(/\d+/);
        let quantityToSub = parseInt($('#cart_items_' + suffix + '_quantity').val());
        let actualQuantity = sessionStorage.getItem('cart-quantity') ? parseInt(sessionStorage.getItem('cart-quantity')) : 0;
        let calculatedQuantity = (actualQuantity - quantityToSub) >= 0 ? (actualQuantity - quantityToSub) : 0;
        sessionStorage.removeItem('cart-quantity');

        sessionStorage.setItem('cart-quantity', calculatedQuantity.toString());
    })

    let spanPMenu = $('.span-principal-menu');
    spanPMenu.on('mouseenter',function (event) {
        event.preventDefault();
        manageNavbar($(this))
    })
    spanPMenu.on('click tap touchstart',function (event) {
        event.preventDefault();
        manageNavbar($(this))
    })
    $('.menu li ul li').on('mouseleave',function (event) {
        event.preventDefault();
        let selectors = spanPMenu.next('ul').find('div');
        selectors.each(function () {
            $(this).addClass('hidden');
        })
    })
    let timesClicked = 0;
    $('.menu-icon').on('click tap', function () {
        timesClicked++;
        let selectionSelector = $('.selection');
        if ((timesClicked%2) === 0) {
            selectionSelector.addClass('hidden');
            selectionSelector.removeClass('show');
        }else if((timesClicked%2) === 1) {
                selectionSelector.removeClass('hidden');
                selectionSelector.addClass('show');
        }
        let selectors = spanPMenu.next('ul').find('div');
        selectors.each(function () {
            if ($(this).hasClass('show')){
                $(this).addClass('hidden');
            }
        })
    })
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
