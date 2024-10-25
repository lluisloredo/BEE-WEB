/*

TemplateMo 559 Zay Shop

https://templatemo.com/tm-559-zay-shop

*/

'use strict';
$(document).ready(function() {
    // Accordion
    var all_panels = $('.templatemo-accordion > li > ul').hide();

    $('.templatemo-accordion > li > a').click(function() {
        console.log('Hello world!');
        var target =  $(this).next();
        if(!target.hasClass('active')){
            all_panels.removeClass('active').slideUp();
            target.addClass('active').slideDown();
        }
      return false;
    });
    // End accordion

    // Product detail
    $('.product-links-wap a').click(function(){
      var this_src = $(this).children('img').attr('src');
      $('#product-detail').attr('src',this_src);
      return false;
    });
    $('#btn-minus').click(function(){
      var val = $("#var-value").html();
      val = (val=='1')?val:val-1;
      $("#var-value").html(val);
      $("#product-quanity").val(val);
      return false;
    });
    /*
    $('#btn-plus').click(function(){
      var val = $("#var-value").html();
      val++;
      $("#var-value").html(val);
      $("#product-quanity").val(val);
      return false;
    });
    */
    
    $('.btn-size').click(function(){
      var this_val = $(this).html();
      $("#product-size").val(this_val);
      $(".btn-size").removeClass('btn-secondary');
      $(".btn-size").addClass('btn-success');
      $(this).removeClass('btn-success');
      $(this).addClass('btn-secondary');
      return false;
    });
    // End roduct detail


    //Inputs alta de producto
    $('#producto').on('input', function() {
      var maxInput=40;  
      var valor = $(this).val();
        if (valor.length > maxInput) {
            $(this).val(valor.substring(0, maxInput)); // Limita a 15 caracteres
        }
    });
    $('#producto').on('input',function(){
      $(this).val($(this).val().replace(/[^a-zA-ZáéíóúÁÉÍÓÚñÑ ]/g, ''));
    })


    $('#cantidad').on('keydown', function(event) {
      if (event.key === '.' || event.key === '-' || event.key === '+') {
        event.preventDefault(); // Evitar que el carácter se ingrese
      }
    });
    $('#cantidad').on('input',function(){
      var maxInput=4;
      var valor=$(this).val();
      if(valor.length > maxInput){
        $(this).val(valor.substring(0, maxInput));
      }
    })

    $('#costo').on('keydown',function(event){
      if(event.key === '-' || event.key === '+'){
        event.preventDefault();
      }
    })
    $('#costo').on('input',function(){
      var maxInput=5;
      var valor=$(this).val();
      if(valor.length > maxInput){
        $(this).val(valor.substring(0, maxInput));
      }
    })
    

    $('#message').on('input', function() {
      var maxInput=150;  
      var valor = $(this).val();
        if (valor.length > maxInput) {
            $(this).val(valor.substring(0, maxInput)); // Limita a 15 caracteres
        }
    });
    $('#message').on('input', function() {
      $(this).val($(this).val().replace(/[^a-zA-Z0-9áéíóúÁÉÍÓÚñÑ,. ]/g, ''));
    });

    //Ends inputs alta producto



});
