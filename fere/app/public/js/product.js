$(function () {
    let input = $('.quantity-value');
    let minValue = parseInt(input.attr('min'));
    let maxValue = parseInt(input.attr('max'));

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
