<?php
/**
 * @version    CVS: 1.0.0
 * @package    Com_Talentpro
 * @author     Darwin Sese <darwindevphone@gmail.com>
 * @copyright  2018 Darwin Sese
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

// Include dependancies
jimport('joomla.application.component.controller');

JLoader::registerPrefix('Talentpro', JPATH_COMPONENT);
JLoader::register('TalentproController', JPATH_COMPONENT . '/controller.php');


// Execute the task.
$controller = JControllerLegacy::getInstance('Talentpro');
$controller->execute(JFactory::getApplication()->input->get('task'));
$controller->redirect();
