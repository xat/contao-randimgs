<?php
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

class ModuleRandimgs extends Module
{
	/**
	 * Template
	 * @var string
	 */
	protected $strTemplate = 'mod_randimgs';

	/**
	 * Generate the module
	 */
	protected function compile()
	{
		$strFolder = $this->singleFolder;

		if (isset($GLOBALS['TL_HOOKS']['randimgs']) && is_array($GLOBALS['TL_HOOKS']['randimgs']))
		{
			foreach ($GLOBALS['TL_HOOKS']['randimgs'] as $callback)
			{
				$this->import($callback[0]);
				$this->$callback[0]->$callback[1]($strFolder);
			}
		}

		if (!empty($strFolder) && is_dir(TL_ROOT . '/' . $strFolder))
		{
			if (isset($this->recursive) && $this->recursive === '1')
			{
				$arrImages = $this->findImages($strFolder, true);
			} else
			{
				$arrImages = $this->findImages($strFolder, false);
			}

			shuffle($arrImages);
			$arrImages = array_slice($arrImages, 0, $this->maxFiles);

			if (!is_array($arrImages) || empty($arrImages))
			{
				return;
			}

			$arrTplImages = array();

			foreach ($arrImages as $arrImage)
			{
				$objImageTpl = new stdClass();
				$this->addImageToTemplate($objImageTpl, $arrImage['templateParams']);
				$arrTplImages[] = $objImageTpl;
			}

			$this->Template->images = $arrTplImages;
		}
	}

	/**
	 * Recursivly Walk through a Directory and get
	 * back Images as Array
	 *
	 * @param $strDir
	 * @param bool $blnRecursive
	 */
	protected function findImages($strDir, $blnRecursive = false)
	{
		$strDirPath = TL_ROOT . '/' . $strDir;
		$arrNodes  = scan($strDirPath);
		$arrImages = array();

		$this->parseMetaFile($strDir);

		foreach ($arrNodes as $strNode)
		{
			$strAbsolute  = TL_ROOT . '/' . $strDir . '/' . $strNode;
			$strRelative  = $strDir . '/' . $strNode;

			if ($blnRecursive && is_dir($strAbsolute))
			{
				$arrImages = array_merge($arrImages, $this->findImages($strRelative, $blnRecursive));
			} elseif (is_file($strAbsolute))
			{
				$objFile = new File($strRelative);
				$arrMeta = $this->arrMeta[$strNode];

				if ($objFile->isGdImage)
				{
					$arrImages[] = array
					(
						'object'            => $objFile,
						'templateParams'    => array
						(
							'name'      => $objFile->basename,
							'singleSRC' => $strRelative,
							'alt'       => $arrMeta[0],
							'imageUrl'  => $arrMeta[1],
							'caption'   => $arrMeta[2]
						)
					);
				}
			}
		}

		return $arrImages;
	}
}
