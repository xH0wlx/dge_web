$(document).ready(function() {

   var marco;
   var btnMarco = $('#btn-imagen-taxonomia');
   var btnQuitar = $('#btn-imagen-taxonomia-limpiar');
    
   btnMarco.on('click', function(){
       
       if( marco ){
          marco.open();
          return;
       }else{
           
           var marco = wp.media({
               frame: 'select',
               title: 'Seleccione una Imágen',
               button: {
                   text: 'Usar esta Imágen'
               },
               library: {
                   order: 'ASC',
                   orderby: 'title',
                   type: 'image'
               }
           });
           
           marco.on('select', function(){
               var elemento = marco.state().get( 'selection' ).first().toJSON();
               
               $('#imagen-taxonomia').val(elemento.url);
           });
           
           marco.open();
           
       }
       
       
   });
    
   btnQuitar.on('click', function(){
     $('#imagen-taxonomia').val("");
   });
    
    
});