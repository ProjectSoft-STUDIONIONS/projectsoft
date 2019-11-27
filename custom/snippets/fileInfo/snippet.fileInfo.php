<?php
use Helpers\FS;

if (!defined('MODX_BASE_PATH')) {
    die('What are you doing? Get out of here!');
}

include_once(MODX_BASE_PATH . 'assets/lib/Helpers/FS.php');

$prefix = isset($prefix) ? $prefix : "fileinfo";

$fs = FS::getInstance();
$format = (isset($format) && is_string($format)) ? explode(',', $format) : true;
$arFile = array(
	'size'			=>	$fs->fileSize($file, false),
	'size_format'	=>	$fs->fileSize($file, $format),
	'dirname'		=>	$fs->takeFileDir($file),
	'basename'		=>	$fs->takeFileBasename($file),
	'filename'		=>	$fs->takeFileName($file),
	'extension'		=>	$fs->takeFileExt($file),
	'isfile'		=>	$fs->checkFile($file) ? 1 : 0,
	'isdir'			=>	$fs->checkDir($file) ? 1 : 0,
	'filemime'		=>	$fs->takeFileMIME($file),
	'relativepath'	=>	$fs->relativePath($file)
);
foreach ($arFile as $key => $value) {
	$placeholder = $prefix . "." . $key;
	$modx->setPlaceholder($placeholder, $value);
}
return "";