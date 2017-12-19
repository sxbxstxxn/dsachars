<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'Sc.' . $_EXTKEY,
	'Pi',
	array(
		'Character' => 'list, show, new, create, edit, update, delete',
		
	),
	// non-cacheable actions
	array(
		'Character' => 'create, update, delete',
		
	)
);
