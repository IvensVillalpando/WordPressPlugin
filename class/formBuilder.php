<?php

	/*
	 * Description: Funciones de procesado de imagenes y guardada de archivo en servidor
	 * Version:     1.0
	 * Author:      Ivens Villalpando
	 * Date:		22 June 2018
	 */


function deleteFilesOnMediaFolder(){
	$outputdir = preg_replace("[\\/]", DIRECTORY_SEPARATOR, plugin_dir_path(__FILE__)) . "media".DIRECTORY_SEPARATOR;
	$files = glob($outputdir.'*'); // get all file names
	foreach($files as $file){ // iterate files
	  if(is_file($file))
	    unlink($file); // delete file
	}
}

//Funcion que guarda la imagen en el servidor
function test_handle_post(){
    if(isset($_FILES['upfile'])){
    	try {
		    // Revisamos errores antes de subir el archivo
		    if (!isset($_FILES['upfile']['error']) ||is_array($_FILES['upfile']['error'])) {
		    	throw new RuntimeException('Invalid parameters.');
		    }
		    // Revisamos el valor que contiene el error
		    switch ($_FILES['upfile']['error']) {
		        case UPLOAD_ERR_OK:
		            break;
		        case UPLOAD_ERR_NO_FILE:
		            throw new RuntimeException('No file sent.');
		        case UPLOAD_ERR_INI_SIZE:
		        case UPLOAD_ERR_FORM_SIZE:
		            throw new RuntimeException('Exceeded filesize limit.');
		        default:
		            throw new RuntimeException('Unknown errors.');
		    }
		    //Obtenemos la extension y revisamos que sea una imagen.
		    $finfo = new finfo(FILEINFO_MIME_TYPE);
		    if (false === 
			    	$ext = array_search( $finfo -> file($_FILES['upfile']['tmp_name']),
			    	array(
			    		'jpg' => 'image/jpeg',
			    		'png' => 'image/png',
			    		'gif' => 'image/gif'
			    	),true)
		    	){
		        throw new RuntimeException('Invalid file format.');
		    }
		    //You should name it uniquely.
		    $outputdir = preg_replace("[\\/]", DIRECTORY_SEPARATOR, plugin_dir_path(__FILE__)) . "media".DIRECTORY_SEPARATOR;
		    //revisamos que tengamos un directorio creado para subir las imagenes
		    $filename = $_FILES["upfile"]["name"];
				if (!file_exists($outputdir)) {
        		mkdir($outputdir, 0777, true);
    		}
    		$outputdir .= $filename;
    		//Revisamos si podemos subir el archivo al servidor o no
		    if (!move_uploaded_file($_FILES['upfile']['tmp_name'], $outputdir) ) {
		        throw new RuntimeException('Failed to move uploaded file.');
		    }
		    //LLamamos la funcion que realiza los calculos
		    getInfoFromImages($outputdir,$filename);
		}catch (RuntimeException $e) {
		    echo $e->getMessage();
		}
	}
}



function getInfoFromImages($pathToFile,$filename){
	$resource = new Imagick($pathToFile);
	$imgWidth = $resource->getImageWidth();
	$imgHeight = $resource->getImageHeight();
	if($imgWidth > $imgHeight){
		$Result = $imgWidth/$imgHeight;
	}else{
		$Result = $imgHeight/$imgWidth;
	}
	if($Result < 1.16667){
		$resultadoOperacion = array(
			'resolution'	=> '1:1',
			'medidas'		=> array(
				0 =>	array(
					'size' 	=> '20x20',
					'dpi'	=> $imgWidth/(20*0.3937)
				),
				1 =>	array(
					'size' 	=> '25x25',
					'dpi'	=> $imgWidth/(25*0.3937)
				),
				2 =>	array(
					'size' 	=> '30x30',
					'dpi'	=> $imgWidth/(30*0.3937)
				),
				3 =>	array(
					'size' 	=> '40x40',
					'dpi'	=> $imgWidth/(40*0.3937)
				),
				4 =>	array(
					'size' 	=> '50x50',
					'dpi'	=> $imgWidth/(50*0.3937)
				),
				5 =>	array(
					'size' 	=> '60x60',
					'dpi'	=> $imgWidth/(60*0.3937)
				),
				6 =>	array(
					'size' 	=> '70x70',
					'dpi'	=> $imgWidth/(70*0.3937)
				),
				7 =>	array(
					'size' 	=> '80x80',
					'dpi'	=> $imgWidth/(80*0.3937)
				),
				8 =>	array(
					'size' 	=> '90x90',
					'dpi'	=> $imgWidth/(90*0.3937)
				),
				9 =>	array(
					'size' 	=> '100x100',
					'dpi'	=> $imgWidth/(100*0.3937)
				),
				10 =>	array(
					'size' 	=> '120x120',
					'dpi'	=> $imgWidth/(120*0.3937)
				)
			)
		);
	}else if( (1.16667 <= $Result) && ($Result < 1.416667) ){
		$resultadoOperacion = array(
			'resolution'	=> '4:3',
			'medidas'		=> array(
				0 =>	array(
					'size' 	=> '40x30',
					'dpi'	=> $imgWidth/(40*0.3937)
				),
				1 =>	array(
					'size' 	=> '80x60',
					'dpi'	=> $imgWidth/(80*0.3937)
				),
				2 =>	array(
					'size' 	=> '120x90',
					'dpi'	=> $imgWidth/(120*0.3937)
				)
			)
		);
	}else if( (1.416667<=$Result) && ($Result < 1.75) ){
		$resultadoOperacion = array(
			'resolution'	=> '3:2',
			'medidas'		=> array(
				0 =>	array(
					'size' 	=> '30x20',
					'dpi'	=> $imgWidth/(30*0.3937)
				),
				1 =>	array(
					'size' 	=> '45x30',
					'dpi'	=> $imgWidth/(45*0.3937)
				),
				2 =>	array(
					'size' 	=> '60x40',
					'dpi'	=> $imgWidth/(60*0.3937)
				),
				3 =>	array(
					'size' 	=> '75x50',
					'dpi'	=> $imgWidth/(75*0.3937)
				),
				4 =>	array(
					'size' 	=> '90x60',
					'dpi'	=> $imgWidth/(90*0.3937)
				),
				5 =>	array(
					'size' 	=> '120x80',
					'dpi'	=> $imgWidth/(120*0.3937)
				)
			)
		);
	}else if( (1.75 <= $Result) && ($Result < 2.5) ){
		$resultadoOperacion = array(
			'resolution'	=> '2:1',
			'medidas'		=> array(
				0 =>	array(
					'size' 	=> '40x20',
					'dpi'	=> $imgWidth/(40*0.3937)
				),
				1 =>	array(
					'size' 	=> '60x30',
					'dpi'	=> $imgWidth/(60*0.3937)
				),
				2 =>	array(
					'size' 	=> '80x40',
					'dpi'	=> $imgWidth/(80*0.3937)
				),
				3 =>	array(
					'size' 	=> '100x50',
					'dpi'	=> $imgWidth/(100*0.3937)
				)
			)
		);
	}else if( (2.5 <= $Result) && ($Result < 3.5) ){
		$resultadoOperacion = array(
			'resolution'	=> '3:1',
			'medidas'		=> array(
				0 =>	array(
					'size' 	=> '60x20',
					'dpi'	=> $imgWidth/(60*0.3937)
				),
				1 =>	array(
					'size' 	=> '90x30',
					'dpi'	=> $imgWidth/(90*0.3937)
				),
				2 =>	array(
					'size' 	=> '120x40',
					'dpi'	=> $imgWidth/(120*0.3937)
				)
			)
		);
	}else{
		$resultadoOperacion = array(
			'resolution'	=> '4:1',
			'medidas'		=> array(
				0 =>	array(
					'size' 	=> '80x20',
					'dpi'	=> $imgWidth/(80*0.3937)
				),
				1 =>	array(
					'size' 	=> '120x30',
					'dpi'	=> $imgWidth/(120*0.3937)
				)
			)
		);
	}
	$result = array(
		'file_url'		=> plugins_url().'/wp_image_quality/class/media/'.$filename,
		'file_name' 	=> $filename,
		'file_measures' => $imgWidth.'x'.$imgHeight,
		'file_size' 	=> $resource->getImageSize(),
		'process_res'	=> $resultadoOperacion
	);
	//El response se envia a media/js/function.js es un arreglo
	//con lo contenido en las lineas anteriores.
	echo json_encode($result);
	die();
}

?>