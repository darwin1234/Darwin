<?php

/**
 * @version     CVS: 1.0.0
 * @package     com_talentpro
 * @subpackage  mod_talentpro
 * @author      MyCadena Solutions Team <info@mycadena.com>
 * @copyright   2018 Darwin Sese
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
defined('_JEXEC') or die;

// Include the syndicate functions only once
JLoader::register('ModTalentproHelper', dirname(__FILE__) . '/helper.php');

$doc = JFactory::getDocument();

/* */
$doc->addStyleSheet(JURI::base() . '/media/mod_talentpro/css/style.css');

/* */
$doc->addScript(JURI::base() . '/media/mod_talentpro/js/script.js');

require JModuleHelper::getLayoutPath('mod_talentpro', $params->get('content_type', 'blank'));
