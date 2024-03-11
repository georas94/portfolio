$(function () {
   let divDeliveryLocationSelector = $('.div-delivery-location');
   let divDeliveryOfficeSelector = $('.div-delivery-office');
    $('.span-delivery-location').on('click', function () {
        if (divDeliveryLocationSelector.is(":hidden")){
            divDeliveryLocationSelector.show();
        }else{
            divDeliveryLocationSelector.hide();
        }
    })
    $('.span-delivery-office').on('click', function () {
        if (divDeliveryOfficeSelector.is(":hidden")){
            divDeliveryOfficeSelector.show();
        }else{
            divDeliveryOfficeSelector.hide();
        }
    })
})
