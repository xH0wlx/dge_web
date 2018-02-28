$(document).ready(function() {

    var max_fields      = 10; //maximum input boxes allowed
    var wrapper         = $(".input_fields_wrap"); //Fields wrapper
    var add_button      = $(".add_field_button"); //Add button ID
    
    var x = 1; //initlal text box count
    $(add_button).click(function(e){ //on add input button click
        e.preventDefault();
        if(x < max_fields){ //max input box allowed
            x++; //text box increment
            $(wrapper).append('<div class="input-group mb-3">' +
                                  '<input name="ge_funcionario[profesion][]" type="text" class="form-control profesion_o_grado" value="">' +
                                  '<div class="input-group-append">' +
                                    '<button class="btn btn-danger remove_field" type="button"> -&nbsp;  </button>' +
                                  '</div>' +
                                '</div>'); //add input box
        }
    });
    
    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent('div').parent('div').remove(); x--;
    })
    
   
   var post_type_key = "ge_funcionarios";
    
   var ge_checkbox = $("#ge_rolchecklist [name='tax_input[ge_rol][]']");

    var banderaAcademico = false;
    var banderaDirectivo = false;
    var banderaAdministrativo = false;
    
    // Bucle inicial
    $(ge_checkbox).each(function() {
           var rol = $.trim($(this).parent().text().toLowerCase());

           if( rol == "académicos" && $(this).is(':checked') ){
               banderaAcademico = true;
           }else if( rol == "directivos" && $(this).is(':checked') ){
               banderaDirectivo = true;
           }
           else if( rol == "administrativos" && $(this).is(':checked') ){
               banderaAdministrativo = true;
           }
    });
    
    if(banderaDirectivo){
           $("#cargo_departamento_box").show().addClass('bg-animado');
       }else{
           $("#cargo_departamento_box").hide();
           $("#jerarquia_departamento").val("");
           $("#cargo_departamento").val("");
       }
       
       if(banderaAcademico){
           $("#" + post_type_key + "_ponencias").show().addClass('bg-animado');
           $("#" + post_type_key + "_proyectos").show().addClass('bg-animado');
           $("#" + post_type_key + "_trabajo_actualidad").show().addClass('bg-animado');
           $("#tagsdiv-ge_area_investigacion").show().addClass('bg-animado');
       }else{
           $("#" + post_type_key + "_ponencias").hide();
           $("#" + post_type_key + "_proyectos").hide();
           $("#" + post_type_key + "_trabajo_actualidad").hide();
           $("#tagsdiv-ge_area_investigacion").hide();
       }
    
    
    
   ge_checkbox.change( function(){
       var banderaAcademico = false;
       var banderaDirectivo = false;
       var banderaAdministrativo = false;
       
       $(ge_checkbox).each(function() {
           var rol = $.trim($(this).parent().text().toLowerCase());

           if( rol == "académicos" && $(this).is(':checked') ){
               banderaAcademico = true;
           }else if( rol == "directivos" && $(this).is(':checked') ){
               banderaDirectivo = true;
           }
           else if( rol == "administrativos" && $(this).is(':checked') ){
               banderaAdministrativo = true;
           }
       });
    if(banderaDirectivo){
           $("#cargo_departamento_box").show().addClass('bg-animado');
       }else{
           $("#cargo_departamento_box").hide();
           $("#jerarquia_departamento").val("");
           $("#cargo_departamento").val("");
       }
       
       if(banderaAcademico){
           $("#" + post_type_key + "_ponencias").show().addClass('bg-animado');
           $("#" + post_type_key + "_proyectos").show().addClass('bg-animado');
           $("#" + post_type_key + "_trabajo_actualidad").show().addClass('bg-animado');
           $("#tagsdiv-ge_area_investigacion").show().addClass('bg-animado');
       }else{
           $("#" + post_type_key + "_ponencias").hide();
           $("#" + post_type_key + "_proyectos").hide();
           $("#" + post_type_key + "_trabajo_actualidad").hide();
           $("#tagsdiv-ge_area_investigacion").hide();
       }
    }); // Fin change event
    
    
    
    
    
});