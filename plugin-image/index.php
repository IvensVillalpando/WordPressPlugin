<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>Plugin Image Analizer</title>
    <link href="style.css" rel="stylesheet" type="text/css" />
</head>
<body>
    <div class="container image-analizer">
        <div class="row mb-1">
            <div class="col-md-4">
                <div class="preview fixed-preview">
                    <img src="<?php echo plugins_url( 'media/images/paisaje.jpg', __FILE__ ); ?>" alt="Previsualizacion">
                </div>
                <small class="preview-small">Seleccione una medida para utilizar ver detalle de la imagen</small>
            </div>
            <div class="col-md-4">
                <div class="details-picture">
                    <div>
                        <span>Nombre Archivo</span>
                        <h4>...</h4>
                    </div>
                    <div>
                        <span>Tamaño (w x h)</span>
                        <h4>...</h4>
                    </div>
                    <div>
                        <span>Peso (bytes)</span>
                        <h4>...</h4>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <!-- Drag and Drop Images -->
                <form class="drop-pictures" id="upload" action="index.php" method="POST" enctype="multipart/form-data">
                    <div>
                        <input type="file" name="fileselect[]" accept="image/jpeg,image/x-png,image/x-portablebitmap" />
                        <div id="filedrag">
                            <img src="picture.png">
                            <span>Intentar con otra imagen</span>
                            <small class="hidden-xs">Arrastrar y Soltar</small>
                            <small class="visible-xs-block">Toca para seleccionar</small>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <!-- Item a repetir -->
            <div class="col-xs-6 col-sm-3 col-md-2">
                <div class="picture" data-size="20cm x 20cm">
                    <div class="thumb" style="background-image:url('paisaje.jpg');background-size:20cm 20cm;"></div>
                    <div class="status perfecta">Perfecta</div>
                    <div class="info">20 x 20<br/>527dpi</div>
                </div>
            </div>
            <!-- Fin item -->
            <div class="col-xs-6 col-sm-3 col-md-2">
                <div class="picture" data-size="30cm x 30cm">
                    <div class="thumb" style="background-image:url('paisaje.jpg');background-size:30cm 30cm;"></div>
                    <div class="status excelente">excelente</div>
                    <div class="info">30 x 30<br/>527dpi</div>
                </div>
            </div>
            <div class="col-xs-6 col-sm-3 col-md-2">
                <div class="picture" data-size="40cm x 40cm">
                    <div class="thumb" style="background-image:url('paisaje.jpg');background-size:40cm 40cm;"></div>
                    <div class="status superbien">Súper Bien</div>
                    <div class="info">40 x 40<br/>527dpi</div>
                </div>
            </div>
            <div class="col-xs-6 col-sm-3 col-md-2">
                <div class="picture" data-size="50cm x 50cm">
                    <div class="thumb" style="background-image:url('paisaje.jpg');background-size:50cm 50cm;"></div>
                    <div class="status muybien">Muy Bien</div>
                    <div class="info">50 x 50<br/>527dpi</div>
                </div>
            </div>
            <div class="col-xs-6 col-sm-3 col-md-2">
                <div class="picture" data-size="60cm x 60cm">
                    <div class="thumb" style="background-image:url('paisaje.jpg');background-size:60cm 60cm;"></div>
                    <div class="status bien">Bien</div>
                    <div class="info">60 x 60<br/>527dpi</div>
                </div>
            </div>
            <div class="col-xs-6 col-sm-3 col-md-2">
                <div class="picture" data-size="70cm x 70cm">
                    <div class="thumb" style="background-image:url('paisaje.jpg');background-size:70cm 70cm;"></div>
                    <div class="status mejorar">Puede Mejorar</div>
                    <div class="info">70 x 70<br/>527dpi</div>
                </div>
            </div>
            <div class="col-xs-6 col-sm-3 col-md-2">
                <div class="picture" data-size="80cm x 80cm">
                    <div class="thumb" style="background-image:url('paisaje.jpg');background-size:80cm 80cm;"></div>
                    <div class="status cambiarla">Intenta Cambiarla</div>
                    <div class="info">80 x 80<br/>527dpi</div>
                </div>
            </div>
            <div class="col-xs-6 col-sm-3 col-md-2">
                <div class="picture" data-size="90cm x 90cm">
                    <div class="thumb" style="background-image:url('paisaje.jpg');background-size:90cm 90cm;"></div>
                    <div class="status olvidalo">Olvidalo</div>
                    <div class="info">90 x 90<br/>527dpi</div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
