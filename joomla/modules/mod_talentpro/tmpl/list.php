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
$elements = ModTalentproHelper::getList($params);
?>

<?php if (!empty($elements)) : ?>
	<table class="table">
		<?php foreach ($elements as $element) : ?>
			<tr>
				<th><?php echo ModTalentproHelper::renderTranslatableHeader($params, $params->get('field')); ?></th>
				<td><?php echo ModTalentproHelper::renderElement(
						$params->get('table'), $params->get('field'), $element->{$params->get('field')}
					); ?></td>
			</tr>
		<?php endforeach; ?>
	</table>
<?php endif;
