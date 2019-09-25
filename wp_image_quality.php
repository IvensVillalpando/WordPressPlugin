<?php
	/*
	 * Plugin Name: WP Image Resolution Tool
	 * Description: Get information about your image and printing size suggestion.
	 * Version:     1.0
	 * Author:      Ivens Villalpando
	 * Security check
	 * Prevent direct access to the file.
	 */

	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	include plugin_dir_path( __FILE__ ) . 'class/formBuilder.php';
	defined( 'ABSPATH' ) or die( 'Don\'t bother with scripts' );
	define( 'WPCS_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
	define( 'WPCS_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );


	/**
	 * Register the Product post type with a Dashicon.
	 * @see register_post_type()
	 */

	add_action( 'init', 'functions_enqueuer');
	//Funciones que se agregan a general a WP
	//Scripts, CSS, AjaxFunction.
	function functions_enqueuer() {
		wp_enqueue_script( 'plugin_functions', plugin_dir_url(__FILE__) . 'media/js/function.js',array('jquery'));
		wp_enqueue_style( 'plugin_style', plugins_url( 'media/css/style.css', __FILE__ ) );

		$params = array ( 'ajaxurl' => admin_url( 'admin-ajax.php' ) );
		wp_localize_script( 'plugin_functions', 'myAjax', $params);
		wp_enqueue_script( 'plugin_functions' );
	}

	//Nombre del plugin
	add_action("add_meta_boxes", "wp_imagequality_box");
	function wp_imagequality_box(){
		add_meta_box("wp_image_quality_meta", "Image Resolution Tool", null, "post", "normal", "high", null );
	}

	//Shortcode que agregamos
	add_shortcode('img_quality', 'wp_imagequality_shortcode');
	function wp_imagequality_shortcode( $atts, $content = null)	{
		$html = '<div id="div_uploader" class="container-fluid">
		    <div class="row mb-1">
		      	<div class="col-md-12">
		            <!-- Drag and Drop Images -->
		            <form class="drop-pictures" id="uploadForm" method="POST" enctype="multipart/form-data">
						'.wp_nonce_field('form_upload_builder').'
		                <div>
		                    <input type="file" name="upfile" id="imgInput" accept="image/jpeg,image/x-png,image/x-portablebitmap" />
		                    <div id="filedrag">
		                        <img src="'.plugins_url( 'media/images/picture.png', __FILE__ ).'">
		                        <span>Agregue una imagen</span>
		                        <small class="hidden-xs">Arrastrar y Soltar</small>
		                        <small class="visible-xs-block">Toca para seleccionar</small>
		                    </div>
		                </div>
		            </form>
		        </div>
		    </div>
		</div>
		<div id="image_loader" style="display: none;" class="container-fluid">
		    <div class="row mb-1">
		        <div class="col-md-4">
		            <div class="picture preview fixed-preview">
		                <img id="img_preview" alt="Previsualizacion" style="max-height:none;">
		                <div class="status excelente">Calidad</div>
		                <div class="info">Medida<br>Resolución</div>
		            </div>
		            <small class="preview-small">Vista Previa</small>
		        </div>
		        <div class="col-md-8">
		            <div class="details-picture">
		                <div>
		                    <span>Tamaño (w x h)</span>
		                    <h4 id="fileSize">...</h4>
		                </div>
		            </div>
		        </div>
		    </div>
		    <div class="row mb-1 loadImages">
		    </div>
		    <div class="row mb-1">
		        <div class="col-md-12" style="text-align:center;">
		            <button class="et_pb_button" onclick="location.reload();">Subir otra fotografia</button>
		        </div>
		    </div>
		</div>';
		return $html;
	}

	//Funcion de ajax definida
	add_action("wp_ajax_upload_image", "upload_image");
	add_action( 'wp_ajax_nopriv_upload_image', 'upload_image' );
	function upload_image() {
		deleteFilesOnMediaFolder();
		test_handle_post();
		die();
	}

	//Fuciones predeterminadas de Wordpress
	register_activation_hook( __FILE__, 'wp_imagequality_install');
	function wp_imagequality_install(){
	    flush_rewrite_rules();
	}

	register_uninstall_hook(__FILE__, 'wp_imagequality_uninstall');
	function wp_imagequality_uninstall(){ }

	register_deactivation_hook( __FILE__, 'wp_imagequality_deactivation');
	function wp_imagequality_deactivation(){
		flush_rewrite_rules();
	}

?>
