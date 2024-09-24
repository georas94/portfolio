$(function () {
    let quantity = $('.quantity-available');
    let tankSaveButton = $('#tank_form_save');
    let tankFormQuantityAvailable = $('#tank_form_quantityAvailable');
    let tankFormVolume = $('#tank_form_volume');
    let menuList = $('.mdc-list .mdc-drawer-link');
    menuList.on('click', function () {
        $(this).removeClass('content--active');
    });

    quantity.each( function () {
        let volume = $(this).parent().parent().parent().find('.volume').data('volume');
        let quantityAvailable = $(this).data('quantity-available');
        let percentage = (quantityAvailable / volume) * 100;
        $(this).parent().parent().parent().find('.percentage').text(percentage.toFixed(1) + ' %')
        // Appeler la fonction avec le pourcentage défini
        fillTank(percentage, $(this).parent().parent().parent().find('.fill'));
    });

    tankSaveButton.on('click', function (e) {
        if (parseFloat(tankFormQuantityAvailable.val()) > parseFloat(tankFormVolume.val())) {
            e.preventDefault();
            e.stopPropagation();
            $('.my-custom-class-for-errors').html('  ' +
                '      <div class="d-flex justify-content-end">\n' +
                '            <div class="alert text-center" style="background: #ff0000!important;font-weight: 900 !important;">\n' +
                '                La quantité disponible ne peut pas être supérieure au volume veuillez vérifier votre saisie \n' +
                '            </div>\n' +
                '        </div>\n')
        }else {
            $('.my-custom-class-for-errors').empty();
            e.currentTarget.submit();
        }
    });

    function fillTank(percentage, element) {
        if (percentage >= 0 && percentage <= 100) {
            element.css('height', percentage + '%');
        } else {
            console.error('Le pourcentage doit être entre 0 et 100');
        }
    }
});
