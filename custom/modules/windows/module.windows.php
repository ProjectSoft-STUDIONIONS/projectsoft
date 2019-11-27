<?php
if (IN_MANAGER_MODE != 'true' || empty($modx) || !($modx instanceof DocumentParser)) {
    die('Please use the MODX Content Manager instead of accessing this file directly.');
}

$module_path = str_replace('\\','/',dirname(__FILE__)) . '/';
$managerPath = $modx->getManagerPath();

if (!$modx->hasPermission('exec_module')) {
    $modx->sendRedirect('index.php?a=106');
}

if (!is_array($modx->event->params)) {
    $modx->event->params = [];
}

function debugPrint($data)
{
	echo '<pre class="language-json"><code>
' . print_r($data, true) . '
</code></pre>';
};

$tbWindow = $modx->getFullTableName('school_windows');
$tbSoft = $modx->getFullTableName('school_windows_soft');
$tbs = $modx->db->config['table_prefix'] . 'school_windows';
$tbf = $modx->db->config['table_prefix'] . 'school_windows_soft';

$sql = 'SELECT COUNT(*)
FROM information_schema.tables 
WHERE table_schema=\''.trim($modx->db->config['dbase'], '`').'\' 
AND table_name=\'' . $tbs .'\'';
$res = $modx->db->query($sql);
if(!$modx->db->getValue( $res )){
	$sql = 'CREATE TABLE IF NOT EXISTS `' . $tbs . '` (
	  `id` int(10) NOT NULL auto_increment,
	  `computer_serial` varchar(255) NOT NULL default \'\',
	  `computer_name` varchar(255) NOT NULL default \'\',
	  `computer_os` varchar(255) NOT NULL default \'\',
	  `product_key` text NOT NULL default \'\',
	  `product_license` text NOT NULL default \'\',
	  `description` text NOT NULL default \'\',
	  PRIMARY KEY  (`id`)
	) ENGINE=MyISAM DEFAULT CHARSET=' . $modx->db->config['charset'] . ' COMMENT=\'Таблица общего списка компьютеров школы.\'';
	$modx->db->query($sql);
}
$sql = 'SELECT COUNT(*)
FROM information_schema.tables 
WHERE table_schema=\''.trim($modx->db->config['dbase'], '`').'\' 
AND table_name=\'' . $tbf .'\'';
$res = $modx->db->query($sql);
if(!$modx->db->getValue( $res )){
	$sql = 'CREATE TABLE IF NOT EXISTS `' . $tbf . '` (
	  `id` int(10) NOT NULL auto_increment,
	  `computer` int(10) NOT NULL default \'0\',
	  `soft_name` varchar(255) NOT NULL default \'\',
	  `soft_key` text NOT NULL default \'\',
	  `soft_license` text NOT NULL default \'\',
	  `description` text NOT NULL default \'\',
	  PRIMARY KEY  (`id`)
	) ENGINE=MyISAM DEFAULT CHARSET=' . $modx->db->config['charset'] . ' COMMENT=\'Таблица дополнительного софта установленного на компьютеры школы.\'';
	$modx->db->query($sql);
}
include_once MODX_MANAGER_PATH . 'includes/header.inc.php';

debugPrint($module_path);
debugPrint($managerPath);
debugPrint($modx->config);

$out = $modx->invokeEvent('OnUserFormRender', array());
if(is_array($out)){
	echo $out[0];
}
?>
<link rel="stylesheet" href="<?=$modx->config['site_url'];?>assets/templates/projectsoft/css/prism.css" />
<script src="<?=$modx->config['site_url'];?>assets/templates/projectsoft/js/prism.js"></script>
<?php
include_once MODX_MANAGER_PATH . 'includes/footer.inc.php';
?>