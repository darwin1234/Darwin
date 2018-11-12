<?php
/**
 * @version    CVS: 1.0.0
 * @package    Com_Jobspro
 * @author     Darwin Sese <darwindevphone@gmail.com>
 * @copyright  2018 Darwin Sese
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 */
// No direct access
defined('_JEXEC') or die;


?>
<?php 
if(empty($this->item->positiontype) && empty($this->item->published) && empty($this->item->startdate) && empty($this->item->applicationdeadline) && empty($this->item->address) && empty($this->item->title)  && empty($this->item->description) ){ ?>
<?php header("location:index.php"); 
die(); ?>
<?php } else{ ?>
<style>
.jobspro{width:79%; margin:35px auto; padding:0;}
.jobspro .jobsidebar{float:left; width:25%; padding:0; margin:0; padding-top:10px;}
.jobspro .jobsdesc h2{color:#00aae7;}
.jobspro .jobsdesc{float:left; width:75%; padding:0; margin:0;}
@media only screen and (min-width:320px) and (max-width:812px){
	.jobspro{width:100%;}
	.jobspro .jobsidebar{width:100%; padding:0; margin:0;}
	.jobspro .jobsdesc{width:100%;}
	.widget{float:left; width:50%;}
	
}
@media only screen and (width:768px){
	.widget{float:left; width:25%;}
	
}
</style>
<div class="jobspro">
	<div class="jobsidebar">
		<div class='widget'>
		<h5>Position Type</h5>
		<p><?php echo $this->item->positiontype; ?></p>
		</div>
		<div class='widget'>
		<h5>Published</h5>
		<p><?php echo $this->item->published; ?></p>
		</div>
		<div class='widget'>
		<h5>Start Date</h5>
		<p><?php echo $this->item->startdate; ?></p>
		</div>
		<div class='widget'>
		<h5>Application Deadline</h5>
		<p><?php echo $this->item->applicationdeadline; ?></p>
		</div>
		<div class='widget'>
		<h5>Address</h5>
		<p><?php echo $this->item->address; ?></p>
		</div>
	</div>
	<div class="jobsdesc">
		<h2 style="color:#000!important;"><?php echo $this->item->title; ?></h2>
		<p> <?php echo  $this->item->description; ?></p>
	</div>
</div>
<?php } ?>