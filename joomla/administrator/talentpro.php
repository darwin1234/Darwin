<?php
/**
 * @version    CVS: 1.0.0
 * @package    Com_Talentpro
 * @author     MyCadena Solutions Team <info@mycadena.com>
 * @copyright  2018 Darwin Sese
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access
defined('_JEXEC') or die;

// Access check.
if (!JFactory::getUser()->authorise('core.manage', 'com_talentpro'))
{
	throw new Exception(JText::_('JERROR_ALERTNOAUTHOR'));
}

// Include dependancies
jimport('joomla.application.component.controller');

JLoader::registerPrefix('Talentpro', JPATH_COMPONENT_ADMINISTRATOR);
JLoader::register('TalentproHelper', JPATH_COMPONENT_ADMINISTRATOR . DIRECTORY_SEPARATOR . 'helpers' . DIRECTORY_SEPARATOR . 'talentpro.php');

$controller = JControllerLegacy::getInstance('Talentpro');
$controller->execute(JFactory::getApplication()->input->get('task'));
$controller->redirect();
