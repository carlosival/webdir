/**
 * Created by carlos on 1/01/09.
 */



var $collectionHolder;
var $collectiontelfHolder;
var $collectionrespHolder;

// setup an "add a correo" link
var $addCorreoLink = $('<a href="#" class="add_correo_link">Adicionar correo</a>');
var $newLinkLi = $('<li class="add_correo"></li>').append($addCorreoLink);

// setup an "add a telefono" link
var $addTelfLink = $('<a href="#" class="add_telefono_link">Adicionar telefono</a>');
var $newLinkTelLi = $('<li class="add_telefono"></li>').append($addTelfLink);

// setup an "add a responsable" link

var $addRespLink = $('<a href="#" class="add_responsable_link">Adicionar Responsable</a>');
var $newLinkRespLi = $('<li class="add_responsable"></li>').append($addRespLink);

// opciones del selector de fecha.

datepickeroptiones={
    format:'yy-mm-dd',
    date: $('#date').val(),
    current: $('#date').val(),
    starts: 1,
    position: 'bottom',
    onBeforeShow: function(){
        $('#date').DatePickerSetDate($('#date').val(), true);
    },
    onChange: function(formated, dates){
        $('#date').val(formated);
    }
}



jQuery(document).ready(function() {

/* tema habilitar y desabilitar el selector de fecha */

//
//    $('.fecha').datepicker(datepickeroptiones);
//
//
//    $(document).on('click',function() {
//        //Cerrar el dialogo de fecha cundo se haga click en cualquier lugar del documento.
//        $('.fecha').datepicker("hide")
//
//    });

/* tema habilitar y desabilitar el selector de fecha */

// TEma de envio masivo de notificaciones de recogida de facturas//

    $("#notificar_recogida").on('click',function(event){
        event.preventDefault();


        $.ajax ({
            url : $(this).attr('href'),
            success: function( data ){

                alert('todo las notificaciones fueron enviadas')
            },
            error : function(data){
                alert('todo algo no anduvo bien')
                console.log( 'unable to process request');
            }

        });



    });

// TEma de envio masivo de notificaciones de recogida de facturas//



/* Todo el tema del cambio de factura y la cuenta dinamicamente */

    $("a[class*='cuenta']").on('click',function(event){
       event.preventDefault();
 var idcuenta ='#'+($(this).attr('class').toString());

//        alert(idcuenta);
        $.post($(this).attr('href'),$(this).attr('id'),function(data){

          $(idcuenta).empty().html(data);
        });

    });

    $("a[class*='factura']").on('click',function(event){
        event.preventDefault();
        var idfactura = '#'+($(this).attr('class').toString());
//        alert(idfactura);
        $.post($(this).attr('href'),$(this).attr('id'),function(data){

           $(idfactura).empty().html(data);
        });

    });



/* Todo el tema del cambio de factura dinamicamente */




//******hack para eliminar error de rendereo en el formulario empresa******//

//$('.crear_empresa div:not(.form-group)').remove();
//******hack para eliminar error de rendereo en el formulario empresa******//



    //Logica para eliminar correos,telefonos y responsables

    // Get the ul that holds the collection of tags
    $collectionHolder = $('.correos');
    $collectiontelfHolder = $('.telefonos');
    $collectionrespHolder = $('.responsables');

    // add the "add a tag" anchor and li to the tags ul
    $collectionHolder.append($newLinkLi);
    $collectiontelfHolder.append($newLinkTelLi);
    $collectionrespHolder.append($newLinkRespLi);


    // count the current form inputs we have (e.g. 2), use that as the new
    // index when inserting a new item (e.g. 2)

   var  $email_cant= $collectionHolder.find(':input').length ;

   var  $email_cant_tel= $collectiontelfHolder.find(':input').length ;

   var  $email_cant_resp= $collectionrespHolder.find(':input').length ;


    $collectionHolder.data('index', $email_cant);

    $collectiontelfHolder.data('index', $email_cant_tel);

    $collectionrespHolder.data('index', $email_cant_resp);

    $addCorreoLink.on('click', function(e) {
        // prevent the link from creating a "#" on the URL
        e.preventDefault();

        // add a new tag form (see next code block)
        addCorreoForm($collectionHolder, $newLinkLi);

    });


    $addTelfLink.on('click', function(e) {
        // prevent the link from creating a "#" on the URL
        e.preventDefault();

        // add a new tag form (see next code block)
        addTelefonoForm($collectiontelfHolder, $newLinkTelLi);

    });


    $addRespLink.on('click', function(e) {
        // prevent the link from creating a "#" on the URL
        e.preventDefault();

        // add a new tag form (see next code block)
        addResponsableForm($collectionrespHolder, $newLinkRespLi);

    });


    // add a delete link to all of the existing tag form li elements que no tengan clase add_correo
    $collectionHolder.find('li:not(.add_correo)').each(function() {
        addCorreoFormDeleteLink($(this));
    });

    // add a delete link to all of the existing tag form li elements que no tengan clase add_correo
    $collectiontelfHolder.find('li:not(.add_telefono)').each(function() {
        addTelefonoFormDeleteLink($(this));
    });

    // add a delete link to all of the existing tag form li elements que no tengan clase add_correo
    $collectionrespHolder.find('li:not(.add_responsable)').each(function() {
        addResponsableFormDeleteLink($(this));
    });

});


function addCorreoForm($collectionHolder, $newLinkLi) {
    // Get the data-prototype explained earlier
    var prototype = $collectionHolder.data('prototype');

    // get the new index
    var index = $collectionHolder.data('index');

    // Replace '__name__' in the prototype's HTML to
    // instead be a number based on how many items we have
    var newForm = prototype.replace(/__name__/g, index);

    // increase the index with one for the next item
    $collectionHolder.data('index', index + 1);

    // Display the form in the page in an li, before the "Add a Correo" link li
    var $newFormLi = $('<li></li>').append(newForm);
    $newLinkLi.before($newFormLi);

    // add a delete link to the new form
    addCorreoFormDeleteLink($newFormLi);

}


function addTelefonoForm($collectiontelfHolder, $newLinkTelLi)
{
    // Get the data-prototype explained earlier
    var prototype = $collectiontelfHolder.data('prototype');

    // get the new index
    var index = $collectiontelfHolder.data('index');

    // Replace '__name__' in the prototype's HTML to
    // instead be a number based on how many items we have
    var newForm = prototype.replace(/__name__/g, index);

    // increase the index with one for the next item
    $collectiontelfHolder.data('index', index + 1);

    // Display the form in the page in an li, before the "Add a Correo" link li
    var $newFormLi = $('<li></li>').append(newForm);
    $newLinkTelLi.before($newFormLi);

    // add a delete link to the new form
    addTelefonoFormDeleteLink($newFormLi);

}

function addResponsableForm( $collectionrespHolder, $newLinkRespLi   )
{

    // Get the data-prototype explained earlier
    var prototype = $collectionrespHolder.data('prototype');

    // get the new index
    var index = $collectionrespHolder.data('index');

    // Replace '__name__' in the prototype's HTML to
    // instead be a number based on how many items we have
    var newForm = prototype.replace(/__name__/g, index);

    // increase the index with one for the next item
    $collectionrespHolder.data('index', index + 1);

    // Display the form in the page in an li, before the "Add a Correo" link li
    var $newFormLi = $('<li></li>').append(newForm);
    $newLinkRespLi.before($newFormLi);

    // add a delete link to the new form
    addResponsableFormDeleteLink($newFormLi);


}


function addTelefonoFormDeleteLink($tagFormLi) {
    var $removeFormA = $('<a class="delete_link" href="#"> Eliminar </a>');
    $tagFormLi.append($removeFormA);

    $removeFormA.on('click', function(e) {
        // prevent the link from creating a "#" on the URL
        e.preventDefault();

        // remove the li for the tag form
        $tagFormLi.remove();
    });
}



function addCorreoFormDeleteLink($tagFormLi) {
    var $removeFormB = $('<a class="delete_link"  href="#"> Eliminar </a>');
    $tagFormLi.append($removeFormB);

    $removeFormB.on('click', function(e) {
        // prevent the link from creating a "#" on the URL
        e.preventDefault();

        // remove the li for the tag form
        $tagFormLi.remove();
    });
}

function addResponsableFormDeleteLink($tagFormLi) {
    var $removeFormA = $('<a class="delete_link"  href="#"> Eliminar </a>');
    $tagFormLi.append($removeFormA);

    $removeFormA.on('click', function(e) {
        // prevent the link from creating a "#" on the URL
        e.preventDefault();

        // remove the li for the tag form
        $tagFormLi.remove();
    });
}











