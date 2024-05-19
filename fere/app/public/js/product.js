$(function () {
    let input = $('.quantity-value');
    let minValue = parseInt(input.attr('min'));
    let maxValue = parseInt(input.attr('max'));
    let $container = $('.btn-cart-add-container');

    let rating = $('.seller-rating')
    for(let i = 0; i < rating.val(); i++) {
        $("#seller-star-" + (i+1) ).css('color', 'orange');
    }

    $('.plus').on('click', function () {
        let inputValue = input.val();
        if (inputValue < maxValue) {
            input.val(parseInt(inputValue) + 1);
        }
    });

    $('.minus').on('click', function () {
        let inputValue = input.val();
        if (inputValue <= maxValue) {
            if (inputValue > minValue) {
                input.val(parseInt(inputValue) - 1);
            }
        }
    });

    $container.find('button').on('click', function (e) {
        let $productId = $(e.currentTarget)
        let $quantity = $('.quantity-value');

        $.ajax({
            url: '/cart/product/'+$productId.data('product-id')+'/add-to-cart',
            data: {quantity :  $quantity.val()},
            method: 'POST',
            dataType: 'json',
            success: function(data){
                let cartCountSelector = $('.cart-count');
                let imgCartSelector = $('.img-cart');
                let cartCount = cartCountSelector.data('count');
                let quantity = parseInt(cartCount) + parseInt(data.quantity);
                cartCountSelector.text(quantity);
                cartCountSelector.data('count', quantity);
                if (sessionStorage.getItem('cart-quantity')){
                    sessionStorage.removeItem('cart-quantity');
                }
                cartCountSelector.css('color', '#68d021 !important')
                imgCartSelector.css('color', '#68d021 !important')
                cartCountSelector.animate({ 'zoom': 1.3}, 400);
                imgCartSelector.animate({ 'zoom': 1.8}, 400);
                cartCountSelector.animate({ 'zoom': 1}, 400);
                imgCartSelector.animate({ 'zoom': 1}, 400);
                window.setTimeout(animateBackToBlackColor, 2000);
                function animateBackToBlackColor() {
                    cartCountSelector.css('color', '#000 !important')
                    imgCartSelector.css('color', '#000 !important')
                }

                sessionStorage.setItem('cart-quantity', quantity.toString());
            },
            error: function (data) {
                swal({
                    text: "Error! More details in the console",
                    icon: "error",
                    buttons: false,
                    timer: 2000,
                });
                console.log(data);
            }
        })
    })
});
