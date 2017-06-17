<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vmchooser extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		
		$this->load->helper(array('form', 'url'));

		$this->load->library('form_validation');
		$this->form_validation->set_rules('inputCores', 'Number of Cores', 'numeric');
		$this->form_validation->set_rules('inputMemory', 'Amount of Memory', 'numeric');
		$this->form_validation->set_rules('inputNics', 'Number of NICs', 'numeric');
		$this->form_validation->set_rules('inputData', 'Minimum disk size', 'numeric');
		$this->form_validation->set_rules('inputIops', 'IOPS', 'numeric');
		$this->form_validation->set_rules('inputThroughput', 'Throughput', 'numeric');
		$this->form_validation->set_rules('inputTemp', 'Minimum temp disk size', 'numeric');

		if ($this->form_validation->run() == FALSE)
		{
				// NOK
				$this->load->view('vmchooser-form');
		}
		else
		{
			// Form Query
			print_r($_POST);
			// xss_clean();
			
			// Do API Call
			$this->load->library('guzzle');
			$api_url = getenv('VMCHOOSERAPI');
			$client     = new GuzzleHttp\Client();
			
			try {
				$response = $client->request( 'POST', 
											   $api_url, 
											  [ 'form_params' 
													=> [ 'processId' => '2' ] 
											  ]
											);
				$json =  $response->getBody()->getContents();
			} catch (GuzzleHttp\Exception\BadResponseException $e) {
				$response = $e->getResponse();
				$responseBodyAsString = $response->getBody()->getContents();
				//print_r($responseBodyAsString);
				echo "Something went wrong :-(";
			}
			
			// Prep Results
			$array = json_decode($json);
			$i=0;
			foreach ($array as $result) {
			  $temp = (array) $result;
			  $results[$i] = $temp;
			  $i++;
			}
		
			// OK
			$data['results'] = $results;
			$this->load->view('vmchooser-form',$data);
				
				
		}
}
}
