<?php
# Load
if ( empty($GLOBALS['Application']) ) {
	# Bootstrap
	require_once(
		implode(
			DIRECTORY_SEPARATOR,
			array(
				dirname(__FILE__),
				'..',
				'..',
				'scripts',
				'bootstrapr.php'
			)
		)
	);
	$Bootstrapr = Bootstrapr::getInstance();
}
else {
	$Bootstrapr = Bootstrapr::getInstance();
}

# Bootstrap
$Bootstrapr->bootstrap('zend-application');
$Application->bootstrap('balphp');
$Application->bootstrap('config');

# Requires
require_once(implode(
	DIRECTORY_SEPARATOR,
	array(
		BALPHP_PATH,
		'core',
		'functions',
		'_image.funcs.php'
	)
));
require_once(implode(
	DIRECTORY_SEPARATOR,
	array(
		BALPHP_PATH,
		'core',
		'functions',
		'_files.funcs.php'
	)
));

# Fetch Paths
$media_path			= Bal_App::getConfig('media_path');
$media_url			= Bal_App::getConfig('media_url');
$images_path		= Bal_App::getConfig('media_images_path');
$images_url			= Bal_App::getConfig('media_images_url');
$default_quality	= Bal_App::getConfig('media.resize.default.quality', 90);
$resize_supported	= Bal_App::getConfig('media.resize.supported', array());

# Fetch
$image_location = ltrim($_GET['image'], DIRECTORY_SEPARATOR);
$height = intval(!empty($_GET['height']) ? $_GET['height'] : (!empty($_GET['h']) ? $_GET['h'] : 0));
$width = intval(!empty($_GET['width']) ? $_GET['width'] : (!empty($_GET['w']) ? $_GET['w'] : 0));
$quality = intval(!empty($_GET['quality']) ? $_GET['quality'] : (!empty($_GET['q']) ? $_GET['q'] : $default_quality));

# Check
function check_resize_support ( $list, $value ) {
	return !$value || in_array($value,$list);
}
if ( 
		!check_resize_support($resize_supported['height'], $height)
	||	!check_resize_support($resize_supported['width'], $width)
	||	!check_resize_support($resize_supported['quality'], $quality)
) {
	throw new Exception('An unsupported combination of width, height and quality was specified. Please adjust your configuration.');
}

# Prepare
$image_path = realpath($media_path . DIRECTORY_SEPARATOR . $image_location); // we hope that the image path is good
if ( strpos($image_path, $media_path) !== 0 ) {
	throw new Exception('Invalid image location was attempted. <' . $image_path . ' | ' . $image_location . '>');
}
$image_filename_new = get_filename($image_location, true) . '-' . $height . 'x' . $width . 'q' . $quality . '.' . get_extension($image_location);
$image_path_new = $images_path . DIRECTORY_SEPARATOR . $image_filename_new;
$image_url_new = $images_url . '/' . rawurlencode($image_filename_new);

# URL
$image_url = $media_url . '/' . $image_location;

# Prepare
$image_url_to_use = $image_url_new;

# Check
if ( is_file($image_path_new) ) {
	# Done already
} else {
	# Create
	

	# Arguments
	$image_args = array('image' => $image_path, 'resize_mode' => 'area', 'width_new' => $width, 'height_new' => $height, 'quality' => $quality);
	
	# Resize
	$image = @image_remake($image_args);
	if ( !$image ) {
		# Failed
		$image_url_to_use = $image_url;
	} else {
		# Save
		file_put_contents($image_path_new, $image);
	}
}

# Redirect
header('Location: ' . $image_url_to_use);
die();
