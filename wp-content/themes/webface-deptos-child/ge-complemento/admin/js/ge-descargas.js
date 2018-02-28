$(document).ready(function() {

   var marco;
   var btnMarco = $('#btn-marco');
    
   btnMarco.on('click', function(){
       
       if( marco ){
          marco.open();
          return;
       }else{
           
           var marco = wp.media({
               frame: 'select',
               title: 'Selecciona un archivo',
               button: {
                   text: 'Usar este archivo'
               },
               library: {
                   order: 'ASC',
                   orderby: 'title',
                   type: 'application'
               }
           });
           
           marco.on('select', function(){
               var elemento = marco.state().get( 'selection' ).first().toJSON();
               
               $('#size-human-descarga').val(elemento.filesizeHumanReadable);
               $('#icono-descarga').val(elemento.icon);
               $('#titulo-descarga').val(elemento.title);
               $('#fecha-descarga').val(elemento.dateFormatted);
               $('#enlace-descarga').val(elemento.url);
           });
           
           marco.open();
           
       }
       
       
   });
    
    
});