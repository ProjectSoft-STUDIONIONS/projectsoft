<?php
/**
 * @name        youtubeimage
 * @description Get YouTube thumbnails and save assets/images/youtube
 *
 * @released    21 10, 2015
 *
 * @required    MODX 0.9.6.3
 *
 * @confirmed   MODX Evolution 1.0.15
 *
 * @author      ProjectSoft 
 */
if(!defined('MODX_BASE_PATH')) die('What are you doing? Get out of here!');
global $pagetitle;
/**
** Типы перевьюшек   
**/
$save_thimbs = (isset($save_thimbs) ? explode(",", $save_thimbs) : array("default"));
$type_array = array("maxresdefault","sddefault","hqdefault","mqdefault","default");
$type_array = array_uintersect($type_array, $save_thimbs, "strcasecmp");
$type_array = (!in_array("default", $type_array)) ? array_merge($type_array, array("default")) : $type_array;
/**
** Пересохранять перевьюшки
**/
$cache_thumbnail = (isset($cache_thumbnail) ? $cache_thumbnail : 'true');
/**
** Удалять ковычки и заменять их на «»
**/
$remove_sc = (isset($remove_sc) ? $remove_sc : 'true');

$e =& $modx->event;
$regexp = "/^(?:http(?:s)?:\/\/)?(?:www\.)?(?:m\.)?(?:youtu\.be\/|youtube\.com\/(?:(?:watch)?\?(?:.*&)?v(?:i)?=|(?:embed|v|vi|user)\/))([^\?&\"'>]+)/";
$urlimg = 'http://i2.ytimg.com/vi/%idvideo%/%typeimage%.jpg';
$dir = MODX_BASE_PATH."assets/images/youtube/";

switch ($e->name ) {
    case 'OnBeforeDocFormSave':
		/* 
		* Замена ковычек " в pagetitle
		*/
		if($remove_sc == 'true'){
			$req = '%(")(.*)(")%Usi';
			$pagetitle = preg_replace($req, "«$2»", $pagetitle);
			$pagetitle = trim(preg_replace('%"%', "", $pagetitle));
		}
		foreach($_POST as $key=>$value){
			$url = is_string($value) ? trim($value) : "";
			/*
			* Проверяем все $_POST параметры на присутствие ссылки на видео YouTube
			*/
			preg_match($regexp, $url, $matches);
			if(count($matches)){
				$idvideo = $matches[1];
				foreach($type_array as $k=>$typeimage){
					/*
					* Получить файл и сохранить
					*/
					if(!file_exists($dir.$typeimage."/".$idvideo.".jpg") || $cache_thumbnail == 'true') {
						@mkdir($dir.$typeimage, 0755, true);
						$url = str_replace(array("%idvideo%","%typeimage%"), array($idvideo, $typeimage), $urlimg);
						$image = @file_get_contents($url);
						if($image) @file_put_contents($dir.$typeimage."/".$idvideo.".jpg", $image);
					}
				}
				
			}
		}
	break;
}
?>