<?php
if (IN_MANAGER_MODE != 'true') {
	die('<h1>Error:</h1><p>Please use the MODx content manager instead of accessing this file directly.</p>');
}
$site_url = MODX_SITE_URL;
$rgbcolor_path = str_replace("\\", "/", dirname(__FILE__)."/");
$rgbcolor_path = str_replace(MODX_BASE_PATH, "", $rgbcolor_path);
$includeColor = "
<link rel=\"stylesheet\" href=\"/${rgbcolor_path}css/bootstrap.colorpickersliders.min.css?" . filemtime( MODX_BASE_PATH . "${rgbcolor_path}css/bootstrap.colorpickersliders.min.css") . "\">
<link rel=\"stylesheet\" href=\"/${rgbcolor_path}css/main.css?" . filemtime( MODX_BASE_PATH . "${rgbcolor_path}css/main.css") . "\">
<script src=\"/${rgbcolor_path}js/tinycolor.js?" . filemtime( MODX_BASE_PATH . "${rgbcolor_path}js/tinycolor.js") . "\"></script>
<script src=\"/${rgbcolor_path}js/bootstrap.colorpickersliders.js?" . filemtime( MODX_BASE_PATH . "${rgbcolor_path}js/bootstrap.colorpickersliders.js") . "\"></script>
<script src=\"/${rgbcolor_path}js/main.js?" . filemtime( MODX_BASE_PATH . "${rgbcolor_path}js/main.js") . "\"></script>
<script>
jQuery(document).ready(function(e){
	jQuery('[data-plg=\"dtdt\"]').each(function(){
		var self = this,
			jq_input = jQuery('input[data-plugin=\"colorPicker\"]', self),
			connect = jQuery('input[type=\"button\"]', self),
			color = jq_input.val();
		jq_input.ColorPickerSliders({
			color: color,
			swatches: false,
			sliders: false,
			hsvpanel: true,
		});
	});
});
</script>
<div id=\"debcol\"></div>";

$default = empty($row['default_text']) ? "rgb(255, 255, 255)" : $row['default_text'];
$value = empty($row['value']) ? $default : $row['value'];
$id = $row['id'];

$output_rgbcolor = "
<div class=\"rgbcolor\">
	<div class=\"addon input-group\" data-plg=\"dtdt\">
		<input type=\"text\" id=\"tv${id}\" name=\"tv${id}\" value=\"${value}\" data-plugin=\"colorPicker\">
	</div>
</div>
";

echo $output_rgbcolor;

if(!defined('RGBCOLORTV')) {
	echo $includeColor;
	define('RGBCOLORTV', 1);
}