$(document).ready(function () {
    let $container = $('.btn-cart-add-container');
    let $quantity = $('.quantity-value');
    let input = $quantity;
    let minValue = parseInt(input.attr('min'));
    let maxValue = parseInt(input.attr('max'));

    $container.find('button').click(function (e) {
        e.preventDefault();
        let $productId = $(e.currentTarget)
        $.ajax({
            url: '/products/'+$productId.data('product-id')+'/add-to-cart',
            data: {quantity :  $quantity.val()},
            method: 'POST',
            success: function(){
                swal({
                    text: "Ajouté au panier!",
                    icon: "success",
                    buttons: false,
                    timer: 2000,
                });
            },
            error: function (data) {
                swal({
                    text: "Erreur! Regarde dans la console",
                    icon: "error",
                    buttons: false,
                    timer: 2000,
                });
                console.log(data);
            }
        })
    })
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
});
