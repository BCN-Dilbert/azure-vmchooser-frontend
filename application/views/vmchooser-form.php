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

	$first = true;
	foreach ($results as $result) {
		$data = array();
		foreach($result as $key => $value) {
			$header[] = str_replace("'", "", $key);
			$key = str_replace("'", "", $key);
			if ($key == "Name") {
				$value = '<a href="' . base_url() . 'vmchooser/vmsize/' . $value . '/">' . $value . '</a>';
			}
			if (strpos($key, 'USD') !== FALSE) {
				$value = '<a href="https://www.bing.com/search?q='.$value.'+USD+to+euro">'.$value.'</a>';
			}
			$value = str_replace("-1", "n/a", $value);
			$value = str_replace("-2", "Not Supported", $value);
			$data[] = $value;
		}
		if ($first) {
			$CI->table->set_heading($header);
		}
		$CI->table->add_row($data);
		$first = false;
	}
	echo $CI->table->generate();

}

?>

<?php 
$attributes = array('class' => 'form-horizontal', 'id' => 'vmchooser');
echo form_open(base_url(), $attributes);
?>

<fieldset>
  <div class="form-group">
    <div class="col-lg-10 col-lg-offset-2">
	  <button type="submit" class="btn btn-primary">Let's try to match a VM t-shirt size for you!</button>
    </div>
  </div>
</fieldset>

<ul class="nav nav-tabs">
  <li class="active"><a href="#basic" data-toggle="tab" aria-expanded="true">Requirements</a></li>
  <li class=""><a href="#advanced" data-toggle="tab" aria-expanded="false">Advanced</a></li>
  <li class=""><a href="#rightsizing" data-toggle="tab" aria-expanded="false">Rightsizing</a></li>
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
					'france-central' => 'France Central',
					'france-south' => 'France South',
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
		  <label for="inputCores" class="col-lg-2 control-label">Number of Cores</label>
		  <div class="col-lg-10">
			<input type="text" class="form-control" name="inputCores" id="inputCores"  value="<?php echo set_value('inputCores[]'); ?>" placeholder="What's the minimum of cores this VM needs?" autocomplete="off">
		  </div>
		</div>
		<div class="form-group">
		  <label for="inputMemory" class="col-lg-2 control-label">Amount of Memory</label>
		  <div class="col-lg-10">
			<input type="text" class="form-control" name="inputMemory" id="inputMemory" value="<?php echo set_value('inputMemory[]'); ?>" placeholder="What's the minimum amount of memory (in GB) this VM needs?" autocomplete="off">
		  </div>
		</div>
		<div class="form-group">
		  <label for="inputNics" class="col-lg-2 control-label">Number of NICs</label>
		  <div class="col-lg-10">
			<input type="text" class="form-control" name="inputNics" id="inputNics" value="<?php echo set_value('inputNics[]'); ?>" placeholder="What's the minimum number of network interfaces this this VM needs?" autocomplete="off">
		  </div>
		</div>
		<div class="form-group">
		  <label for="inputData" class="col-lg-2 control-label">Minimum disk size</label>
		  <div class="col-lg-10">
			<input type="text" class="form-control" name="inputData" id="inputData" value="<?php echo set_value('inputData[]'); ?>" placeholder="What's the minimum disk size (in TB) needed? (excluding the OS disk)" autocomplete="off">
		  </div>
		</div>
	 </fieldset>
    
  </div>
  <div class="tab-pane fade" id="advanced">
  
	<fieldset>
		<legend>Advanced requirements for your virtual machine</legend>
		<div class="form-group">
		  <label class="col-lg-2 control-label">Tier</label>
		  <div class="col-lg-10">
			<div class="radio">
			  <label>
				<input type="radio" name="inputTier" id="optionsRadios1" value="standard" <?php echo  set_radio('inputTier', 'standard', TRUE); ?>>
				Standard
			  </label>
			</div>
			<div class="radio">
			  <label>
				<input type="radio" name="inputTier" id="optionsRadios2" value="lowpriority" <?php echo  set_radio('inputTier', 'lowpriority', FALSE); ?>>
				Low Priority
			  </label>
			</div>
			<div class="radio">
			  <label>
				<input type="radio" name="inputTier" id="optionsRadios2" value="basic" <?php echo  set_radio('inputTier', 'basic', FALSE); ?>>
				Basic
			  </label>
			</div>
		  </div>
		</div>
		<div class="form-group">
		  <label class="col-lg-2 control-label">Contract</label>
		  <div class="col-lg-10">
			<div class="radio">
			  <label>
				<input type="radio" name="inputContract" id="optionsRadios1" value="PAYG" <?php echo  set_radio('inputContract', 'PAYG', TRUE); ?>>
				Pay-As-You-Go
			  </label>
			</div>
			<div class="radio">
			  <label>
				<input type="radio" name="inputContract" id="optionsRadios2" value="RI1Y" <?php echo  set_radio('inputContract', 'RI1Y', FALSE); ?>>
				Reserved Instances - 1 Year
			  </label>
			</div>
			<div class="radio">
			  <label>
				<input type="radio" name="inputContract" id="optionsRadios2" value="RI3Y" <?php echo  set_radio('inputContract', 'RI3Y', FALSE); ?>>
				Reserved Instances - 3 Years
			  </label>
			</div>
		  </div>
		</div>
		<div class="form-group">
		  <label class="col-lg-2 control-label">Hyperthreaded Core</label>
		  <div class="col-lg-10">
			<div class="radio">
			  <label>
				<input type="radio" name="inputHt" id="optionsRadios1" value="Yes" <?php echo  set_radio('inputHt', 'Yes', FALSE); ?>>
				Yes
			  </label>
			</div>
			<div class="radio">
			  <label>
				<input type="radio" name="inputHt" id="optionsRadios2" value="No" <?php echo  set_radio('inputHt', 'No', FALSE); ?>>
				No
			  </label>
			</div>
			<div class="radio">
			  <label>
				<input type="radio" name="inputHt" id="optionsRadios2" value="All" <?php echo  set_radio('inputHt', 'All', TRUE); ?>>
				Don't care... 
			  </label>
			</div>
		  </div>
		</div>
		<div class="form-group">
		  <label class="col-lg-2 control-label">Burstable</label>
		  <div class="col-lg-10">
			<div class="radio">
			  <label>
				<input type="radio" name="inputBurstable" id="optionsRadios1" value="Yes" <?php echo  set_radio('inputBurstable', 'Yes', FALSE); ?>>
				Yes
			  </label>
			</div>
			<div class="radio">
			  <label>
				<input type="radio" name="inputBurstable" id="optionsRadios2" value="No" <?php echo  set_radio('inputBurstable', 'No', FALSE); ?>>
				No
			  </label>
			</div>
			<div class="radio">
			  <label>
				<input type="radio" name="inputBurstable" id="optionsRadios2" value="All" <?php echo  set_radio('inputBurstable', 'All', TRUE); ?>>
				Don't care... 
			  </label>
			</div>
		  </div>
		</div>
		<div class="form-group">
		  <label class="col-lg-2 control-label">Isolated</label>
		  <div class="col-lg-10">
			<div class="radio">
			  <label>
				<input type="radio" name="inputIsolated" id="optionsRadios1" value="Yes" <?php echo  set_radio('inputIsolated', 'Yes', FALSE); ?>>
				Yes
			  </label>
			</div>
			<div class="radio">
			  <label>
				<input type="radio" name="inputIsolated" id="optionsRadios2" value="No" <?php echo  set_radio('inputIsolated', 'No', FALSE); ?>>
				No
			  </label>
			</div>
			<div class="radio">
			  <label>
				<input type="radio" name="inputIsolated" id="optionsRadios2" value="All" <?php echo  set_radio('inputIsolated', 'All', TRUE); ?>>
				Don't care... 
			  </label>
			</div>
		  </div>
		</div>
		<div class="form-group">
		  <label for="inputPcores" class="col-lg-2 control-label">Number of "pCores"</label>
		  <div class="col-lg-10">
			<input type="text" class="form-control" name="inputPcores" id="inputPcores"  value="<?php echo set_value('inputPcores[]'); ?>" placeholder="What's the minimum equivalent of physical cores this VM needs?" autocomplete="off">
		  </div>
		</div>
		<div class="form-group">
		  <label for="inputAcu" class="col-lg-2 control-label">ACU</label>
		  <div class="col-lg-10">
			<input type="text" class="form-control" name="inputAcu" id="inputAcu" value="<?php echo set_value('inputAcu[]'); ?>" placeholder="What's the minimum ACU (azure compute unit) you expect for this VM?" autocomplete="off">
		  </div>
		</div>
		<div class="form-group">
		  <label for="inputIops" class="col-lg-2 control-label">IOPS</label>
		  <div class="col-lg-10">
			<input type="text" class="form-control" name="inputIops" id="inputIops" value="<?php echo set_value('inputIops[]'); ?>" placeholder="What's the minimum IOPS, for the non-OS disk(s), this VM needs?" autocomplete="off">
		  </div>
		</div>
		<div class="form-group">
		  <label for="inputThroughput" class="col-lg-2 control-label">Throughput</label>
		  <div class="col-lg-10">
			<input type="text" class="form-control" name="inputThroughput" id="inputThroughput" value="<?php echo set_value('inputThroughput[]'); ?>" placeholder="What's the minimum throughput (in MB), for the non-OS disk(s), this VM needs?" autocomplete="off">
		  </div>
		</div>
		<div class="form-group">
		  <label for="inputTemp" class="col-lg-2 control-label">Minimum temp disk size</label>
		  <div class="col-lg-10">
			<input type="text" class="form-control" name="inputTemp" id="inputTemp" value="<?php echo set_value('inputTemp[]'); ?>" placeholder="What's the minimum size (in GB) for the temp disk?" autocomplete="off">
		  </div>
		</div>
	 </fieldset>
    
  </div>
  <div class="tab-pane fade" id="rightsizing">

	<fieldset>
		<legend>Rightsizing your virtual machine</legend>
		<div class="form-group">
		  <label for="inputAvgcpupeak" class="col-lg-2 control-label">Peak CPU Usage</label>
		  <div class="col-lg-10">
			<input type="text" class="form-control" name="inputAvgcpupeak" id="inputAvgcpupeak" value="<?php echo set_value('inputAvgcpupeak[]'); ?>" placeholder="What's the peak CPU usage (in %) when checking the metrics of your VM on a 95pct curve?" autocomplete="off">
		  </div>
		</div>
		<div class="form-group">
		  <label for="inputAvgmempeak" class="col-lg-2 control-label">Peak Memory Usage</label>
		  <div class="col-lg-10">
			<input type="text" class="form-control" name="inputAvgmempeak" id="inputAvgmempeak" value="<?php echo set_value('inputAvgmempeak[]'); ?>" placeholder="What's the peak Memory usage (in %) when checking the metrics of your VM on a 95pct curve?" autocomplete="off">
		  </div>
		</div>
	 </fieldset>

	 </div>

	<div class="tab-pane fade" id="options">

	<fieldset>
		<legend>Options to tweak the results</legend>
		<div class="form-group">
		  <label for="inputResults" class="col-lg-2 control-label">Maximum Results</label>
		  <div class="col-lg-10">
			<input type="text" class="form-control" name="inputResults" id="inputResults" value="<?php echo set_value('inputResults[]'); ?>" placeholder="How many results do you want to see? (Default: 5)" autocomplete="off">
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

