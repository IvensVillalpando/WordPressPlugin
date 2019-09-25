jQuery(document).ready( function($) {
    //Funcion que ejecuta automaticamente el sumbit al agregar imagen
    jQuery('#imgInput').change(function(e) {
        e.preventDefault();
        jQuery('#image_loader,#uploadForm').append('<div class="canvas-loading"><div><div class="pulse"></div><span>Espere un momento</span></div></div>');
        jQuery("#uploadForm").submit();
    });
    //Agregamos la otra vista.
    jQuery('.fixed-preview').removeClass('fixed-preview').clone().hide().appendTo('body');
    //funcion que procesa el subido de la imagen al servidor
    //Investigar WP Ajax como funciona.
    jQuery("#uploadForm").on('submit',(function(e) {
        e.preventDefault();
        var fd = new FormData();
        fd.append( "upfile", $('#imgInput')[0].files[0]);
        fd.append( "action", 'upload_image');
        //Ejecutamos ajax para procesar el formulario.
        jQuery.ajax({
            type: 'POST',
            url: myAjax.ajaxurl,
            data: fd,
            processData: false,
            contentType: false,
            success: function(data, textStatus, XMLHttpRequest) {
                jQuery('#div_uploader').remove();
                jQuery('#image_loader').show();
                jsonObject = JSON.parse(data);
                jQuery('#fileSize').text(jsonObject.file_measures+' pixeles');
                var medidas = jsonObject.file_measures.split('x');
                var ancho = parseInt(medidas[0]);
                var alto = parseInt(medidas[1]);
                var src1 = jsonObject.file_url;
                jQuery("#img_preview").attr("src", src1);
                let imageElements = jsonObject.process_res.medidas;
                var htmlToAdd = '';
                for (var i = 0; i < imageElements.length; i++){
                    var dpi = Math.floor(imageElements[i]['dpi']);
                    var img_size = imageElements[i]['size'].split('x');
                    var img_width = parseInt(img_size[0]);
                    var img_heigth = parseInt(img_size[1]);
                    var qualityStatus = '';
                    var classStatus = '';
                    if(dpi > 300){
                        qualityStatus = 'Perfecta';
                        classStatus   = 'perfecta';
                    }else if( (dpi >= 161)  && (dpi <= 300) ){
                        qualityStatus = 'Excelente';
                        classStatus   = 'excelente';
                    }else if( (dpi >= 131)  && (dpi <= 160) ){
                        qualityStatus = 'Súper bien';
                        classStatus   = 'superbien';
                    }else if( (dpi >= 91)   && (dpi <= 130) ){
                        qualityStatus = 'Muy bien';
                        classStatus   = 'muybien';
                    }else if( (dpi >= 61)   && (dpi <= 90) ){
                        qualityStatus = 'Bien';
                        classStatus   = 'bien';
                    }else if( (dpi >= 41)   && (dpi <= 60) ){
                        qualityStatus = 'Puede mejorar';
                        classStatus   = 'mejorar';
                    }else if( (dpi >= 21)   && (dpi <= 40) ){
                        qualityStatus = 'Intenta cambiarla';
                        classStatus   = 'cambiarla';
                    }else if( (dpi >= 0)    && (dpi < 20) ){
                        qualityStatus = 'Olvidalo';
                        classStatus   = 'olvidalo';
                    }
                    if(ancho > alto){
                        htmlToAdd += '<div class="col-xs-6 col-sm-4 col-md-3">'+
                            '<div class="picture" data-size="'+img_width+'cm x '+img_heigth+'cm">'+
                                '<div class="thumb" style="background-image:url(\''+src1+'\');background-size:'+img_width+'cm '+img_heigth+'cm;"></div>'+
                                '<div class="status '+classStatus+'">'+qualityStatus+'</div>'+
                                '<div class="info">'+img_width+'cm x '+img_heigth+'cm<br/>'+dpi+' dpi</div>'+
                            '</div>'+
                        '</div>';
                    }else{
                        htmlToAdd += '<div class="col-xs-6 col-sm-4 col-md-3">'+
                            '<div class="picture" data-size="'+img_heigth+'cm x '+img_width+'cm">'+
                                '<div class="thumb" style="background-image:url(\''+src1+'\');background-size:'+img_heigth+'cm '+img_width+'cm;"></div>'+
                                '<div class="status '+classStatus+'">'+qualityStatus+'</div>'+
                                '<div class="info">'+img_heigth+'cm x '+img_width+'cm<br/>'+dpi+' dpi</div>'+
                            '</div>'+
                        '</div>';
                    }

                }
                jQuery('.loadImages').html(htmlToAdd);
                //Se agregan las funciones despues de que se crean las thumbs
                var pixelToMove = 100;
                //Funcion de zoom cuando pasas el cursor
                jQuery(".preview > img").mousemove(function(e) {
                    if(!jQuery(this).hasClass('pause')) {
                        var divOS = jQuery(this).offset();
                        var width = jQuery(this).innerWidth();
                        var height = jQuery(this).innerHeight();
                        var newValueX = ((e.pageX-divOS.left) / width) * pixelToMove;
                        var newValueY = ((e.pageY-divOS.top) / height) * pixelToMove;
                        jQuery('.thumb').css('background-position', newValueX + '%' + ' ' + newValueY + '%');
                    }
                });

                jQuery(".preview > img").click(function(e) {
                    if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
                    } else {
                        jQuery(this).toggleClass('pause');
                    }
                });

                //Funcion que ejecuta automaticamente el sumbit al agregar imagen
                jQuery('#imgInput').change(function(e) {
                    e.preventDefault();
                    jQuery("#uploadForm").submit();
                });

                jQuery('#img_preview').load(function() {
                    jQuery('.canvas-loading').fadeOut('slow');
                });
            },
            error: function(MLHttpRequest, textStatus, errorThrown) {
                alert(errorThrown);
            }

        });
    }));

});
