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
$element = ModTalentproHelper::getItem($params);
?>

<?php if (!empty($element)) : ?>
	<div>
		<?php $fields = get_object_vars($element); ?>
		<?php foreach ($fields as $field_name => $field_value) : ?>
			<?php if (ModTalentproHelper::shouldAppear($field_name)): ?>
				<div class="row">
					<div class="span4">
						<strong><?php echo ModTalentproHelper::renderTranslatableHeader($params, $field_name); ?></strong>
					</div>
					<div
						class="span8"><?php echo ModTalentproHelper::renderElement($params->get('item_table'), $field_name, $field_value); ?></div>
				</div>
			<?php endif; ?>
		<?php endforeach; ?>
	</div>
<?php endif;
