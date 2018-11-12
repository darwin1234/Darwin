<?php
/**
 * @version    CVS: 1.0.0
 * @package    Com_Talentpro
 * @author     Darwin Sese <darwindevphone@gmail.com>
 * @copyright  2018 Darwin Sese
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 */
// No direct access
defined('_JEXEC') or die;

//header("location:index.php"); 
//die();
JHtml::addIncludePath(JPATH_COMPONENT . '/helpers/html');
JHtml::_('bootstrap.tooltip');
JHtml::_('behavior.multiselect');
JHtml::_('formbehavior.chosen', 'select');

$user       = JFactory::getUser();
$userId     = $user->get('id');
$listOrder  = $this->state->get('list.ordering');
$listDirn   = $this->state->get('list.direction');
$canCreate  = $user->authorise('core.create', 'com_talentpro') && file_exists(JPATH_COMPONENT . DIRECTORY_SEPARATOR . 'models' . DIRECTORY_SEPARATOR . 'forms' . DIRECTORY_SEPARATOR . 'jobform.xml');
$canEdit    = $user->authorise('core.edit', 'com_talentpro') && file_exists(JPATH_COMPONENT . DIRECTORY_SEPARATOR . 'models' . DIRECTORY_SEPARATOR . 'forms' . DIRECTORY_SEPARATOR . 'jobform.xml');
$canCheckin = $user->authorise('core.manage', 'com_talentpro');
$canChange  = $user->authorise('core.edit.state', 'com_talentpro');
$canDelete  = $user->authorise('core.delete', 'com_talentpro');
$doc = JFactory::getDocument();

/* */
$doc->addStyleSheet(JURI::base() . '/media/mod_talentpro/css/style.css');

/* */
$doc->addScript(JURI::base() . '/media/mod_talentpro/js/script.js');
// Add styles
$style = "
	.jobs_wrap{width: 80%; margin: 40px auto;}
	.jobs_wrap h1{margin-bottom:20px;}
	.dsjobs{list-style:none; width:100%; clear:both; margin-top:60px;}
	.dssearchwarp{width: 74%;  overflow: auto; margin:0 auto;}
	.dssearchwarp .dscategory{float:left;}
	.dssearchwarp .dscategory .catsearch {border:0; margin-top:0!important;}
	.dssearchwarp .dscategory .catsearch:hover{color:#000!important; }
	.dssearchwarp #dsearch{width:570px; margin:30px auto; }
	.dssearchwarp #dsearch .dsfilter{width:500px;}
	.dscount{width:100%; clear:both;}
	.dsimage{display:none!important;}
	#submitsearch{margin-top: 1px; width: 108px; padding: 8px; height: 41px; background: #551a8b; color: #fff!important;  border-radius: 0!important; margin-left: 10px;}
	#filter_search{float:left; width:460px; margin:0; display:block;}
	.categoryfilter{width:700px; margin: -35px auto;}
	.dspaginate{list-style:none; overflow: auto; width: 500px; margin: auto}
	.dspaginate li{float:left; margin:4px; width:50px; text-align:center; background:#A3A3A3;}
	.dspaginate li.active{background:#551A8B; color:#fff;}
	.dspaginate li a{text-decoration:none;}
	
	#paging p{font-size:15px; text-align:left; }
	#dsfilterwrap{width:65%; margin: auto; margin-top:30px; margin-bottom:20px;}
	.chzn-container{margin:0 auto; display:block;}
	
	
	.dscategory .catsearch {border:0;}
	.dscategory .catsearch:hover{color:#000!important;}

	.dspagination{float:left; list-style:none;  width:50%;}
	.dspagination a{float:left; padding:5px; width:30px; background:#551A8B; margin:2px; text-align:center}
	.dspagination span{float:left; padding:5px; width:30px; background:#551A8B; color:#fff; margin:2px; text-align:center}
	.dspagination  a{color:#fff; text-align:center; text-decoration:none;}
	/*.dspagination li.dsactive {background:#551A8B;} */
	@media screen and (min-width:360px) and (max-width:812px){
		.dspagination{float:left; list-style:none;  width:100%;}
		.jobs_wrap{width: 100%; margin: 8px auto;}
		.dssearchwarp #dsearch{width:100%!important;}
		.categoryfilter{width:100%!important; margin: -35px auto;}
		.dssearchwarp #dsearch .dsfilter{width:100%!important;}
		#submitsearch {margin-top: 15px; padding: 8px; background: #551a8b; color: #fff!important; width: 100%;}
		.dscategory{width:50%; margin-bottom:0px!important;}
		.dscategory .catsearch{width:100%;}
		.dsjobs{width:90%;}
		.catlabel{display:none;}
		.jobResult .catwrap{line-height:30px!important; }
		#dsfilterwrap {width: 100%; margin: 18px auto;}
		.dssearchwarp{width:100%!important;}
		#filter_search{width:100%;}
		#submitsearch {margin-left: 0;}
		#filter_category{width:100%!important;}
		.chzn-container{width:100%!important;}
		.chzn-container-single .chzn-single{width:100%;}
		.dscategory{width:50%; margin-bottom:0px!important;}
		.dscategory .catsearch{width:100%;}
	}
";
				
$doc->addStyleDeclaration($style);

		//$app = JFactory::getApplication();
		//$menuitem   = $app->getMenu()->getActive(); // get the active item
		//$menuitem   = $app->getMenu()->getItem($menuitem->id); // or get item by ID
		//$params = $menuitem->params; // get the params
		//print_r($params); // print all params as overview
		//echo $params->get('menu_image');
		//$dsAlias =  $menuitem->alias;
		$talentpro =  $this->params;
?>
<div class="jobs_wrap"> 
		<h1><span style="font-size: 36pt;"><?php echo $talentpro->get("page_title"); ?></span></h1>
		
		<?php if(!empty($talentpro->get('talentbanner'))){ ?>
			<img class="qx-img " src="<?php echo $talentpro->get('talentbanner');?>" width="1044px" height="397px">
		<?php } ?>
		<form action="<?php echo htmlspecialchars(JUri::getInstance()->toString()); ?>" method="post"
			  name="adminForm" id="adminForm">
			  <?php echo JLayoutHelper::render('default_filter', array('view' => $this), dirname(__FILE__)); ?>
				
		
		<ul class="dsjobs">
			<?php foreach ($this->items as $i => $item) : ?>
				<li>
					<div class="jobResult"> 
						<span class='catwrap' style="#551A8B; line-height:60px; font-size:14px; font-weight:bold;">
							<?php 
								 $category = explode(',',$item->category);
								 if(!empty($category))
								 {
									echo "<span class='catlabel'>Category: </span> ";
									foreach($category as $cat){echo "<span style='background:#551A8B; color:#fff; padding:4px; margin:5px;'>".$cat."</span>";}
								 }
							?>
						</span>
						
						<h4><a href="<?php echo JRoute::_('index.php?option=com_talentpro&view=job&id='.(int) $item->id); ?>"><?php echo $item->title; ?></a></h4>
						<p style="margin-bottom:0;"><?php echo strip_tags(substr($item->description,0,500));?> ...</p>
						<span style="margin-top:-20px; font-weight:bold;"><?php echo !empty($item->address) ? $item->address : ""; ?></span><br>
						<hr>
					</div>
				</li>
			<?php endforeach; ?>
		</ul>
				
			<div class="dspagination"><?php echo strip_tags($this->pagination->getPagesLinks(),"<a><span>");?></div>
			<div class="dscount"><?php echo $this->pagination->getPagesCounter();?></div>
			<input type="hidden" name="task" value=""/>
			<input type="hidden" name="boxchecked" value="0"/>
			<input type="hidden" name="filter_order" value="<?php echo $listOrder; ?>"/>
			<input type="hidden" name="filter_order_Dir" value="<?php echo $listDirn; ?>"/>
			<?php echo JHtml::_('form.token'); ?>
		</form>
<?php 
	
	/*FUTURE PURPOSES!*/
	/*$total = dspagination();

	$counter = 0;
	
    // How many items to list per page
    $limit = 5;

	$increment = 0;

    // How many pages will there be
	$pages = ceil($total / $limit);
	
	$page       = ( isset( $_GET['start'] ) ) ? $_GET['start'] : 1;
    $links      = 7;
   
	
	$last       = ceil( $total / $limit );
 
    $start      = ( ( $page - $links ) > 0 ) ? $page - $links : 1;
    $end        = ( ( $page + $links ) < $last ) ? $page + $links : $last;
 
    $html       = '<ul class="dspaginate">';
 
    $class      = ( $page == 1 ) ? "disabled" : "";
	if($page == 1){
		 $html       .= '<li class="' . $class . '"><a href="'. $dsAlias .'?start=1">&laquo;</a></li>';
	}else{
		$html       .= '<li class="' . $class . '"><a href="'. $dsAlias .'?start=' . ( $page - 1 ) . '">&laquo;</a></li>';
	}
    if ( $start > 1 ) {
        $html   .= '<li><a href="'. $dsAlias .'?start=' . $page . '">1</a></li>';
        $html   .= '<li class="disabled"><span>...</span></li>';
    }
 
    for ( $i = $start ; $i <= $end; $i++ ) {
        
		$class  = ( $page == $i ) ? "dsactive" : "";	
		
		if($counter == 4){
			$html   .= '<li>....</li>';
			$increment +=1;
		}elseif($counter < 4 || ($counter > $pages) -4 ){
		
			if($page >=4){
				$html   .= '<li class="' . $class . '"><a href="'. $dsAlias .'?start=' . (int)($i+1). '">' .(int)($i+$page-4). '</a></li>'; 
			}else{
				
				$html   .= '<li class="' . $class . '"><a href="'. $dsAlias .'?start=' . $i. '">' .$i. '</a></li>'; 
			}
		}

		$counter++;
	}
 
    if ( $end < $last ) {
        $html   .= '<li class="disabled"><span>...</span></li>';
        $html   .= '<li><a href="'. $dsAlias .'?start=' . $limit . '">' . $last . '</a></li>';
    }
 
    $class      = ( $page == $last ) ? "disabled" : "";
    $html       .= '<li class="' . $class . '"><a href="'. $dsAlias .'?start=' .(int)($page + 1) . '">&raquo;</a></li>';
 
    $html       .= '</ul>';
	
	echo   $html;
	
	
	/*
	
	$numbers = array(1,2,3,4,5,6,7,8,9,10,11,12);

		$output = '';

		$counter = 1;

		foreach ($numbers as $number){



		if($counter == 4){

		$output .= ' ...';

		}elseif($counter < 4 || $counter > (count($numbers) -3)){

		$output .= ' ' . $number;

		}

		$counter++;

		}
		echo $output;*/


?>
