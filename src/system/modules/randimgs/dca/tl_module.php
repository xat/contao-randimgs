<?php if (!defined('TL_ROOT')) die('You cannot access this file directly!');
/**
 * Contao Open Source CMS
 *
 * Copyright (C) 2005-2012 Leo Feyer
 *
 * @package
 * @author    Simon Kusterer
 * @license   LGPL
 * @copyright Simon Kusterer 2013
 */

$GLOBALS['TL_DCA']['tl_module']['palettes']['randImgs'] = '{title_legend},name,headline,type;{source_legend},recursive,maxFiles,singleFolder;{protected_legend:hide},protected;{expert_legend:hide},guests,cssID,space';

$GLOBALS['TL_DCA']['tl_module']['fields']['singleFolder'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_module']['singleFolder'],
	'exclude'                 => true,
	'inputType'               => 'fileTree',
	'eval'                    => array('fieldType'=>'radio', 'files'=>false, 'filesOnly'=>false, 'mandatory'=>false, 'tl_class'=>'clr')
);

$GLOBALS['TL_DCA']['tl_module']['fields']['recursive'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_module']['recursive'],
	'exclude'                 => true,
	'inputType'               => 'checkbox',
);

$GLOBALS['TL_DCA']['tl_module']['fields']['maxFiles'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_module']['maxFiles'],
	'default'                 => 1,
	'exclude'                 => true,
	'inputType'               => 'text',
);