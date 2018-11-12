<?php

/**
 * @version    CVS: 1.0.0
 * @package    Com_Talentpro
 * @author     Darwin Sese <darwindevphone@gmail.com>
 * @copyright  2018 Darwin Sese
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('JPATH_BASE') or die;

$data = $displayData;

// Receive overridable options
$data['options'] = !empty($data['options']) ? $data['options'] : array();

// Check if any filter field has been filled
$filters       = false;
$filtered      = false;
$search_filter = false;

if (isset($data['view']->filterForm))
{
	$filters = $data['view']->filterForm->getGroup('filter');
}

// Check if there are filters set.
if ($filters !== false)
{
	$filterFields = array_keys($filters);
	$filled       = false;

	foreach ($filterFields as $filterField)
	{
		$filterField = substr($filterField, 7);
		$filter      = $data['view']->getState('filter.' . $filterField);

		if (!empty($filter))
		{
			$filled = $filter;
		}

		if (!empty($filled))
		{
			$filtered = true;
			break;
		}
	}

	$search_filter = $filters['filter_search'];
	unset($filters['filter_search']);
}

$options = $data['options'];

// Set some basic options
$customOptions = array(
	'filtersHidden'       => isset($options['filtersHidden']) ? $options['filtersHidden'] : empty($data['view']->activeFilters) && !$filtered,
	'defaultLimit'        => isset($options['defaultLimit']) ? $options['defaultLimit'] : JFactory::getApplication()->get('list_limit', 20),
	'searchFieldSelector' => '#filter_search',
	'orderFieldSelector'  => '#list_fullordering'
);

$data['options'] = array_unique(array_merge($customOptions, $data['options']));

$formSelector = !empty($data['options']['formSelector']) ? $data['options']['formSelector'] : '#adminForm';

// Load search tools
JHtml::_('searchtools.form', $formSelector, $data['options']);
?>
<?php 

	function dscategory(){
		
	
		$db = JFactory::getDbo();
        $query = $db->getQuery(true);

        $query
			->select("DISTINCT a.id, a.title")
            ->from('#__categories a') //'#__categories
			->join('INNER', $db->quoteName('#__jobspro_', 'b'))
            ->where('FIND_IN_SET(a.id, b.category) AND extension = "com_talentpro.joblist"');
			
			

        $db->setQuery($query);
        return $db->loadObjectList();
		
		
		
	}

	function catcount($id){
		$db = JFactory::getDbo();
        $query = $db->getQuery(true);

        $query
			->select('a.id,a.title,a.category')
			->from('#__jobspro_ a')
			->where('FIND_IN_SET( "'.$id.'", a.category) AND state=1 AND applicationdeadline > NOW()');
			
			
		$db->setQuery($query);
		return $db->loadObjectList();
		
	}
	
	function dspagination(){
		
		$db = JFactory::getDbo();
        $query = $db->getQuery(true);

        $query
			->select('ID')
			->from('#__jobspro_ ')
			->where('state=1 AND applicationdeadline > NOW()');
		$db->setQuery($query);
		return count($db->loadObjectList());
	}
	$dscategory = dscategory();
?>
<div id="dsfilterwrap">
<?php echo $search_filter->input; ?>
<button type="submit" class="btn hasTooltip" id="submitsearch" title="" data-original-title="<?php echo JText::_('COM_TALENTPRO_SEARCH_FILTER_SUBMIT'); ?>">
	<?php echo JText::_('COM_TALENTPRO_SEARCH_FILTER_SUBMIT'); ?>
</button>
</div>
<?php if ($filters) : ?>
	<?php foreach ($filters as $fieldName => $field) : ?>
			<div class="js-stools-field-filter">
				<?php  echo  ($field->renderField(array('hiddenLabel' => true))); ?>
			</div>
					
	<?php endforeach; ?> 
<?php endif; ?>

<div class="dssearchwarp">
		<div class="dscategory"><button type="submit"  class="catsearch" name="filter[category]" onchange="this.form.submit();" value="" >All (<?php echo dspagination();?>)</button></div>
		<?php for($i = 0; $i<count($dscategory); $i++){ ?> 
			<div class="dscategory"><button type="submit" class="catsearch" name="filter[category]" onchange="this.form.submit();"  value="<?php echo $dscategory[$i]->id;?>" ><?php  echo $dscategory[$i]->title;?> (<?php echo count(catcount($dscategory[$i]->id));?>)</button></div>
		<?php }?>
</div>
<div class="js-stools clearfix">
			
	<div class="clearfix" style="display:none;">
		<div class="js-stools-container-bar">
			<label for="filter_search"  style="display:none;" class="element-invisiblearia-invalid="false"><?php echo JText::_('COM_TALENTPRO_SEARCH_FILTER_SUBMIT'); ?></label>
		
			
			<?php if ($filters): ?>
				<div class="btn-wrapper hidden-phone" style="display:none;">
					<button type="button" class="btn hasTooltip js-stools-btn-filter"  title=""
						data-original-title="<?php echo JText::_('COM_TALENTPRO_SEARCH_TOOLS_DESC'); ?>">
						<?php echo JText::_('COM_TALENTPRO_SEARCH_TOOLS'); ?> <i class="caret"></i>
					</button>
				</div>
			<?php endif; ?>

			<div class="btn-wrapper" style="display:none;">
				<button type="button" class="btn hasTooltip js-stools-btn-clear" title=""
					data-original-title="<?php echo JText::_('COM_TALENTPRO_SEARCH_FILTER_CLEAR'); ?>"
					onclick="jQuery(this).closest('form').find('input').val('');">
					<?php echo JText::_('COM_TALENTPRO_SEARCH_FILTER_CLEAR'); ?>
				</button>
			</div>
		</div>
	</div>
	<!-- Filters div -->
	<div class="js-stools-container-filters hidden-phone clearfix" style="">
		<?php // Load the form filters ?>
		
	</div>
</div>