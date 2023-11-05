const $currency = 'Xof';
// this variable is the list in the dom, it's initialized when the document is ready
let $collectionHolder;
let $itemId = 1;
// the link which we click on to add new items
let $addNewItem = $('<a href="#" class="btn btn-secondary btn-expense-create-add-line mt-4">Ajouter une nouvelle ligne</a>');
$(document).ready(function() {
    if ( window.location.pathname == '/expense/accueil' ){
        window.location.href = window.location.pathname + '#menu';
    }else{
        $(".div-logo-without-letters").attr('style', 'visibility: visible !important; opacity: 1 !important; transition: visibility 0s linear 0s, opacity 500ms !important');
    }

    $("#button-open-menu").on('click', function () {
        $(".div-logo-without-letters").attr('style', 'visibility: hidden !important; opacity: 0 !important; transition: visibility 0s linear 500ms, opacity 300ms !important');
    });

    $("#button-close-menu").on('click', function () {
        $(".div-logo-without-letters").attr('style', 'visibility: visible !important; opacity: 1 !important; transition: visibility 0s linear 0s, opacity 500ms !important');
    });

    $('.total-amount-value').on('change click keyup input paste',(function () {
        $(this).val(function (index, value) {
            return $currency + ' ' + value.replace(/(?!\.)\D/g, "").replace(/(?<=\..*)\./g, "").replace(/(?<=\.\d\d).*/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, " ");
        });
        $(this).on('blur', function () {
           if (!/\d/.test($(this).val())){
               $(this).val('');
           }
        });

        $('#submit-expense-create').on('click', function () {
            $('.total-amount-value').val(function (index, value) {
                if (value !== '' && /\d/.test(value)){
                    return value.replace(/(?!\.)\D/g, "").replace(/(?<=\..*)\./g, "").replace(/(?<=\.\d\d).*/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, " ");
                }
            })
        });
    }));

    // Control of the hidden field when creating an expense
    $(document).on('click', '.expense-create-isAdvanceTaken-input', function(){
        if($(this).is(':checked')){
            $(this).parent().next('div').find('label').show();
            $(this).parent().next('div').find('input').show();
        }else{
            $(this).parent().next('div').find('label').hide();
            $(this).parent().next('div').find('input').hide();
        }
    });

    // get the collectionHolder, initialize the var by getting the list;
    $collectionHolder = $('#exp_list');
    // append the add new item link to the collectionHolder
    $collectionHolder.append($addNewItem);
    // add an index property to the collectionHolder which helps track the count of forms we have in the list
    $collectionHolder.data('index', $collectionHolder.find('.panel').length)
    // finds all the panels in the list and foreach one of them we add a remove button to it
    // add remove button to existing items
    $collectionHolder.find('.panel').each(function () {
        // $(this) means the current panel that we are at
        // which means we pass the panel to the addRemoveButton function
        // inside the function we create a footer and remove link and append them to the panel
        // more informations in the function inside
        addRemoveButton($(this));
    });
    // handle the click event for addNewItem
    $addNewItem.click(function (e) {
        // preventDefault() is your  homework if you don't know what it is
        // also look up preventPropagation both are usefull
        e.preventDefault();
        // create a new form and append it to the collectionHolder
        // and by form we mean a new panel which contains the form
        addNewForm($itemId);
        // Increment item id in order to keep in track each new item id
        $itemId++;
    });
});

/*
 * creates a new form and appends it to the collectionHolder
 */
function addNewForm(itemId) {
    //setting the color to have a different one for each new item (for user experience)
    let color1 = '#dedddd';
    let color = '#f5f1f1';
    if (itemId%2 === 0){
        color = color1;
    }
    // getting the prototype
    // the prototype is the form itself, plain html
    let prototype = $collectionHolder.data('prototype');
    // get the index
    // this is the index we set when the document was ready, look above for more info
    let index = $collectionHolder.data('index');
    // create the form
    let newForm = prototype;
    // replace the __name__ string in the html using a regular expression with the index value
    newForm = newForm.replace(/__name__/g, index);
    // incrementing the index data and setting it again to the collectionHolder
    $collectionHolder.data('index', index+1);
    // create the panel
    // this is the panel that will be appending to the collectionHolder
    let $panel = $('<div class="panel panel-warning expense-added" style="background: ' + color + '" ><div class="panel-heading"></div></div>');
    // create the panel-body and append the form to it
    let $panelBody = $('<div class="panel-body panel-body-id-' + itemId + '" id="panel-body-id-' + itemId + '"></div>').append(newForm);
    // append the body to the panel
    $panel.append($panelBody);
    // Append an info element to each new input file field
    let $info = '<div class="div-info-file-upload"><small class="info-file-upload"><i class="fa-solid fa-circle-info"></i><span>La taille maximum autorisée est de 2mb</span></small></div>';
    $panel.find('.expense-create-imageFile-label').parent().append($info);
    // append the removebutton to the new panel
    addRemoveButton($panel);
    // append the panel to the addNewItem
    // we are doing it this way to that the link is always at the bottom of the collectionHolder
    $addNewItem.before($panel);
}

/**
 * adds a remove button to the panel that is passed in the parameter
 * @param $panel
 */
function addRemoveButton ($panel) {
    // create remove button
    let $removeButton = $('<a href="#" class="btn btn-danger mt-4">Supprimer cette ligne</a>');
    // appending the removebutton to the panel footer
    let $panelFooter = $('<div class="panel-footer"></div>').append($removeButton);
    // handle the click event of the remove button
    $removeButton.click(function (e) {
        e.preventDefault();
        // gets the parent of the button that we clicked on "the panel" and animates it
        // after the animation is done the element (the panel) is removed from the html
        $(e.target).parents('.panel').slideUp(1000, function () {
            $(this).remove();
        })
    });
    // append the footer to the panel
    $panel.append($panelFooter);
}
