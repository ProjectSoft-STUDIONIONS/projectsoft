<?php
use Helpers\FS;

if (!defined('MODX_BASE_PATH')) {
    die('What are you doing? Get out of here!');
}

include_once(MODX_BASE_PATH . 'assets/lib/Helpers/FS.php');

$out = null;
$prefix = isset($prefix) ? $prefix : "";
if(!empty(trim($prefix)))
	$prefix .= "_";

$toPlaceholder = (bool)(isset($toPlaceholder) ? (int)$toPlaceholder : 0);

$fs = FS::getInstance();
$format = (isset($format) && is_string($format)) ? explode(',', $format) : true;
$arFile = array(
	$prefix . 'size'			=>	$fs->fileSize($file, false),
	$prefix . 'size_format'		=>	$fs->fileSize($file, $format),
	$prefix . 'dirname'			=>	$fs->takeFileDir($file),
	$prefix . 'basename'		=>	$fs->takeFileBasename($file),
	$prefix . 'filename'		=>	$fs->takeFileName($file),
	$prefix . 'extension'		=>	$fs->takeFileExt($file),
	$prefix . 'isfile'			=>	$fs->checkFile($file) ? 1 : 0,
	$prefix . 'isdir'			=>	$fs->checkDir($file) ? 1 : 0,
	$prefix . 'filemime'		=>	$fs->takeFileMIME($file),
	$prefix . 'relativepath'	=>	$fs->relativePath($file)
);
if($toPlaceholder):
	foreach ($arFile as $key => $value) {
		$placeholder = $prefix . $key;
		$modx->setPlaceholder($placeholder, $value);
	}
else:
	$tpl = isset($tpl) ? $tpl : '@CODE:
<p>' . $prefix . '</p>
<p>size - <span>[+' . $prefix . 'size+]</span></p>
<p>size_format - <span>[+' . $prefix . 'size_format+]</span></p>
<p>dirname - <span>[+' . $prefix . 'dirname+]</span></p>
<p>basename - <span>[+' . $prefix . 'basename+]</span></p>
<p>filename - <span>[+' . $prefix . 'filename+]</span></p>
<p>extension - <span>[+' . $prefix . 'extension+]</span></p>
<p>isfile - <span>[+' . $prefix . 'isfile+]</span></p>
<p>isdir - <span>[+' . $prefix . 'isdir+]</span></p>
<p>filemime - <span>[+' . $prefix . 'filemime+]</span></p>
<p>relativepath - <span>[+' . $prefix . 'relativepath+]</span></p>
	';
	$tpl = $modx->getTpl($tpl);
	$out = $modx->parseText($tpl, $arFile);
endif;
return $out;