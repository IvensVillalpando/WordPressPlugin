<div id='div_uploader' class="container-fluid">
    <div class="row mb-1">
      	<div class="col-md-12">
            <!-- Drag and Drop Images -->
            <form class="drop-pictures" id="uploadForm" method="POST" enctype="multipart/form-data">
                <?php echo wp_nonce_field('form_upload_builder'); ?>
                <div>
                    <input type="file" name="upfile" id="imgInput" accept="image/jpeg,image/x-png,image/x-portablebitmap" />
                    <div id="filedrag">
                        <img src="<?php echo plugins_url( '../../media/images/picture.png', __FILE__ ); ?>">
                        <span>Agregue una imagen</span>
                        <small class="hidden-xs">Arrastrar y Soltar</small>
                        <small class="visible-xs-block">Toca para seleccionar</small>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
