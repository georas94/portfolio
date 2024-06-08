$(function () {
    let cartCountSelector = $('.cart-count');
    let imgCartSelector = $('.img-cart');
    let cartQuantity = JSON.parse($.ajax({
        url: '/cart/quantity', method: 'POST', dataType: 'json', async: false
    }).responseText).quantity;
    cartCountSelector.text(cartQuantity);
    cartCountSelector.data('count', cartQuantity);

    $('#cart_clear').on('click tap touchstart', function () {
        cartCountSelector.css('color', '#FF0000FF !important')
        imgCartSelector.css('color', '#FF0000FF !important')
        cartCountSelector.animate({'zoom': 0.8}, 400);
        imgCartSelector.animate({'zoom': 0.6}, 400);
        cartCountSelector.animate({'zoom': 1}, 400);
        imgCartSelector.animate({'zoom': 1}, 400);
        window.setTimeout(animateBackToBlackColor, 2000);

        function animateBackToBlackColor() {
            cartCountSelector.css('color', '#000 !important')
            imgCartSelector.css('color', '#000 !important')
        }
    });
    $('.cart_items_remove').on('click tap touchstart', function () {
        cartCountSelector.css('color', '#FF0000FF !important')
        imgCartSelector.css('color', '#FF0000FF !important')
        cartCountSelector.animate({'zoom': 0.6}, 400);
        imgCartSelector.animate({'zoom': 0.8}, 400);
        cartCountSelector.animate({'zoom': 1}, 400);
        imgCartSelector.animate({'zoom': 1}, 400);
        window.setTimeout(animateBackToBlackColor, 2000);

        function animateBackToBlackColor() {
            cartCountSelector.css('color', '#000 !important')
            imgCartSelector.css('color', '#000 !important')
        }
    });

    let spanPMenu = $('.span-principal-menu');
    spanPMenu.on('click tap touchstart', function (event) {
        event.preventDefault();
        manageNavbar($(this))
    });
    $('.menu li ul li').on('mouseleave', function (event) {
        event.preventDefault();
        let selectors = spanPMenu.next('ul').find('div');
        selectors.each(function () {
            $(this).addClass('hidden');
        });
    });
    let timesClicked = 0;
    $('.menu-icon').on('click tap', function () {
        timesClicked++;
        let selectionSelector = $('.selection');
        if ((timesClicked % 2) === 0) {
            selectionSelector.addClass('hidden');
            selectionSelector.removeClass('show');
        } else if ((timesClicked % 2) === 1) {
            selectionSelector.removeClass('hidden');
            selectionSelector.addClass('show');
        }
        let selectors = spanPMenu.next('ul').find('div');
        selectors.each(function () {
            if ($(this).hasClass('show')) {
                $(this).addClass('hidden');
            }
        });
    });
});

function manageNavbar(spanPrincipalMenu) {
    let selector = spanPrincipalMenu.next('ul').find('div');
    let selectors = $('.span-principal-menu').next('ul').find('div');
    selectors.each(function () {
        if (!($(this).attr('class') === selector.attr('class'))) {
            $(this).addClass('hidden');
        }
    });
    if (selector.hasClass('show') && !(selector.hasClass('show') && selector.hasClass('hidden'))) {
        selector.removeClass('show');
        selector.addClass('hidden');
    } else if (selector.hasClass('show hidden')) {
        selector.removeClass('hidden');
        selector.addClass('show');
    } else {
        selector.removeClass('hidden');
        selector.addClass('show');
    }
}
