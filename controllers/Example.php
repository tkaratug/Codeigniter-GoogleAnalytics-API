<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Example extends CI_Controller {
	
	function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{
		$this->load->config('gapi');
		$params = [ 'client_email' => $this->config->item('account_email'), 'key_file' => $this->config->item('p12_key') ];
		$this->load->library('gapi', $params);
		
		$this->gapi->requestReportData($this->config->item('ga_profile_id'), array('day'), array('sessions','users','pageviews','organicSearches','bounceRate'), 'day', '', date('Y-m-01'), date('Y-m-d'), 1, 500);
		$data['totalSessions']	= $this->gapi->getSessions();
		$data['totalUsers']		= $this->gapi->getUsers();
		$data['totalPageViews']	= $this->gapi->getPageviews();
		$data['totalOrganik']	= $this->gapi->getOrganicSearches();
		$data['totalBounce']	= $this->gapi->getBounceRate();
		
		$this->load->view('exampla_view',$data);
	}
	
}