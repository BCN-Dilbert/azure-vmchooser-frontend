<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php echo validation_errors('<div class="alert alert-dismissible alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>', '</div>'); ?>

<?php

if (isset($results)) { 

	?>
	
	<div class="page-header">
	  <h1 id="navbar">Results</h1>
	</div>
	
	<?php

	$CI =& get_instance();
	$CI->load->library('table');

	$template = array(
			'table_open' => '<table class="table table-striped table-hover">'
	);
	$CI->table->set_template($template);
	print_r($results);

	foreach ($results as $key => $value) {
    $CI->table->add_row($key,$value);
  }

	echo $CI->table->generate();

}

?>

<?php 
$attributes = array('class' => 'form-horizontal', 'id' => 'vmchooser');
echo form_open(base_url()."vmchooser/disk", $attributes);
?>

<fieldset>
  <div class="form-group">
    <div class="col-lg-10 col-lg-offset-2">
	  <button type="submit" class="btn btn-primary">Let's try to match a disk configuration for you!</button>
    </div>
  </div>
</fieldset>

<ul class="nav nav-tabs">
  <li class="active"><a href="#basic" data-toggle="tab" aria-expanded="true">Requirements</a></li>
  <li class=""><a href="#options" data-toggle="tab" aria-expanded="false">Options</a></li>
</ul>
<div id="myTabContent" class="tab-content">
  <div class="tab-pane fade active in" id="basic">
  
	<fieldset>
		<legend>Basic requirements for your virtual machine</legend>
		<div class="form-group">
		  <label class="col-lg-2 control-label">Region</label>
		  <div class="col-lg-10">
			
			<?php 
				$regions = array(
					'asia-pacific-east' => 'Asia Pacific East', 
					'asia-pacific-southeast' => 'Asia Pacific South-East', 
					'australia-east' => 'Australia East', 
					'australia-southeast' => 'Australia South East',	
					'brazil-south' => 'Brazil South',	
					'canada-central' => 'Canada Central',	
					'canada-east' => 'Canada East', 
					'central-india' => 'India Central', 
					'west-india' => 'India West',
					'south-india' => 'India South',
					'europe-north' => 'Europe North',	
					'europe-west' => 'Europe West', 
					'germany-central' => 'Germany Central', 
					'germany-northeast' => 'Germany North East', 
					'japan-east' => 'Japan East', 
					'japan-west' => 'Japan West', 
					'korea-central' => 'Korea Central', 
					'korea-south' => 'Korea South', 
					'united-kingdom-south' => 'UK South', 
					'united-kingdom-west' => 'UK West', 
					'us-central' => 'US Central', 
					'us-east' => 'US East', 
					'us-east-2' => 'US East 2', 
					'usgov-arizona' => 'US Gov Arizona', 
					'usgov-iowa' => 'US Gov Iowa', 
					'usgov-texas' => 'US Gov Texas', 
					'usgov-virginia' => 'US Gov Virginia', 
					'us-north-central' => 'US North Central', 
					'us-south-central' => 'US South Central', 
					'us-west' => 'US West', 
					'us-west-2' => 'US West 2', 
					'us-west-central' => 'US West Central', 
					'all' => 'Just give me all options!'
				);
				echo form_dropdown('inputRegion', $regions, set_value('inputRegion[]','europe-west'), 'class="form-control" id="inputRegion"');
				?>
		  </div>
		</div>
		<div class="form-group">
		  <label class="col-lg-2 control-label">Disk Type</label>
		  <div class="col-lg-10">
			<div class="radio">
			  <label>
				<input type="radio" name="ssd" id="optionsRadios1" value="No" <?php echo  set_radio('ssd', 'No', TRUE); ?>>
				Standard disks only
			  </label>
			</div>
			<div class="radio">
			  <label>
				<input type="radio" name="ssd" id="optionsRadios2" value="Yes" <?php echo  set_radio('ssd', 'Yes', TRUE); ?>>
				I'll be needing Premiums disks (SSD)
			  </label>
			</div>
			<div class="radio">
			  <label>
				<input type="radio" name="ssd" id="optionsRadios2" value="All" <?php echo  set_radio('ssd', 'All', TRUE); ?>>
				Doesn't matter... Just gimme all options available!
			  </label>
			</div>
		  </div>
		</div>
		<div class="form-group">
		  <label for="inputData" class="col-lg-2 control-label">Capacity</label>
		  <div class="col-lg-10">
			<input type="text" class="form-control" name="inputData" id="inputData" value="<?php echo set_value('inputData[]'); ?>" placeholder="What's the minimum capacity / size (in GB) for this disk config?" autocomplete="off">
		  </div>
		</div>
	 
	 <div class="form-group">
		  <label for="inputIops" class="col-lg-2 control-label">IOPS</label>
		  <div class="col-lg-10">
			<input type="text" class="form-control" name="inputIops" id="inputIops" value="<?php echo set_value('inputIops[]'); ?>" placeholder="What's the minimum IOPS for this disk config?" autocomplete="off">
		  </div>
		</div>
		<div class="form-group">
		  <label for="inputThroughput" class="col-lg-2 control-label">Throughput</label>
		  <div class="col-lg-10">
			<input type="text" class="form-control" name="inputThroughput" id="inputThroughput" value="<?php echo set_value('inputThroughput[]'); ?>" placeholder="What's the minimum throughput (in MB) for this disk config?" autocomplete="off">
		  </div>
		</div>    
  
	</fieldset>
	
	</div>

	<div class="tab-pane fade" id="options">

	<fieldset>
		<legend>Options to tweak the results</legend>
		<div class="form-group">
		  <label for="inputResults" class="col-lg-2 control-label">Maximum Disks</label>
		  <div class="col-lg-10">
			<input type="text" class="form-control" name="inputMaxDisks" id="inputMaxDisks" value="<?php echo set_value('inputMaxDisks[]','64'); ?>" placeholder="What is the maximum disks you want to use" autocomplete="off">
		  </div>
		</div>
		<div class="form-group">
		  <label class="col-lg-2 control-label">Currency</label>
		  <div class="col-lg-10">
			
			<?php 
				$currency = array(
					'EUR' => 'Euro', 
					'USD' => 'US Dollar', 
					'GBP' => 'British Pound', 
					'AUD' => 'Australian Dollar', 
					'JPY' => 'Japanese Yen', 
					'CAD' => 'Canadian Dollar', 
					'DKK' => 'Danish Krone', 
					'CHF' => 'Swiss Franc', 
					'SEK' => 'Swedish Krona', 
					'IDR' => 'Indonesian Rupee', 
					'INR' => 'Indian Rupee'
				);
				echo form_dropdown('inputCurrency', $currency, set_value('inputCurrency[]','EUR'), 'class="form-control" id="inputCurrency"');
				?>
		  </div>
		</div>
	 </fieldset>
  
  </div>

</div>

<div class="alert alert-dismissible alert-info">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong>Please note...</strong> The <a href="https://azure.microsoft.com/en-us/pricing/details/virtual-machines/linux/" target="_blank" class="alert-link">pricing</a> is using the full flexible pricing for a Linux machine.. It only represents the "compute" cost and does not include <a href="https://azure.microsoft.com/en-us/pricing/details/managed-disks/" target="_blank" class="alert-link">managed disks</a>.
  Optimizations can be done by using <a href="https://azure.microsoft.com/en-us/overview/azure-for-microsoft-software/faq/" target="_blank" class="alert-link">CPP</a>. The details of the different VM sizes is based on the following <a href="https://docs.microsoft.com/en-us/azure/virtual-machines/windows/sizes" target="_blank" class="alert-link">documentation</a>. 
</div>


</form>

