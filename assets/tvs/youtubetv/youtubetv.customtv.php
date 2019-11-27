<?php
/*
** youtubetv — custom TV for MODx Evolution
** Version 1.0 by ProjectSoft, projectsoft@studionions.com
*/
if (IN_MANAGER_MODE != 'true') {
 die('<h1>Error:</h1><p>Please use the MODx content manager instead of accessing this file directly.</p>');
}
$site_url = MODX_SITE_URL;
$includeOnce_ytv = <<<EOD
<style>
.iframe_block {
	padding-top:10px;
	position: relative;
	max-width: 600px;
}
.embed-responsive {
    position: relative;
    display: block;
    height: 0;
    padding: 0;
    overflow: hidden;
}
.embed-responsive-16by9 {
    padding-bottom: 56.25%;
}
.embed-responsive .embed-responsive-item, .embed-responsive iframe, .embed-responsive embed, .embed-responsive object, .embed-responsive video {
    position: absolute;
    top: 0;
    left: 0;
    bottom: 0;
    height: 100%;
    width: 100%;
    border: 0;
}
</style>

<script>
	var setIdVideo = function(tv){
		var el = document.getElementById(tv),
			span = document.getElementById("block_img_"+tv),
			div = document.getElementById("block_iframe_"+tv),
			errorLoad = function(e){
				e.preventDefault();
				this.onerror = null;
				this.parentElement.innerHTML = "";
				return !1;
			},
			img, iframe;
		span.innerHTML = div.innerHTML = "";
		
		var req = /^(?:http(?:s)?:\/\/)?(?:www\.)?(?:m\.)?(?:youtu\.be\/|youtube\.com\/(?:(?:watch)?\?(?:.*&)?v(?:i)?=|(?:embed|v|vi|user)\/))([^\?&\"\'>]+)/,
			val = el.value,
			match = req.exec(val);
		if(match){
			if(match.length){
				img = document.createElement("img");
				img.src = "{$site_url}assets/images/youtube/default/"+match[1]+".jpg";
				iframe = '<iframe class="embed-responsive-item" frameborder="0" allowfullscreen src="https://www.youtube.com/embed/'+match[1]+'?rel=0"></iframe>';
				span.appendChild(img);
				div.innerHTML = iframe;
				img.onerror = errorLoad;
				el.value = "https://www.youtube.com/watch?v="+match[1];
			}
		}
	};
</script>
EOD;
if(!defined('YOUTUBETV')) {
	echo $includeOnce_ytv;
	define('YOUTUBETV', 1);
}
$value = empty($row['value']) ? $row['default_text'] : $row['value'];
$id = $row['id'];
$output_YTv = <<<EOD
<input type="text" id="tv{$id}" name="tv{$id}" value="{$value}" style="width:300px;" onchange="setIdVideo('tv{$id}');documentDirty=true;"/>
&nbsp;<span id="block_img_tv{$id}" class=""></span><br />
<div class="iframe_block">
	<div id="block_iframe_tv{$id}" class="embed-responsive embed-responsive-16by9"></div>
</div>
<script>
setIdVideo("tv{$id}");
</script>
EOD;
echo $output_YTv;
?>
