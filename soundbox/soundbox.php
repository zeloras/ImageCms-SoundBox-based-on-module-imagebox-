<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Image CMS
 *
 * Module Sample
 */

class Soundbox extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->module('core');
	}

	// Index function
	function index()
	{
        //code
	}


    // Install 
    function _install()
    {
        if( $this->dx_auth->is_admin() == FALSE) exit;

        $this->db->where('name', 'soundbox');
        $this->db->update('components', array('autoload' => '1'));
    }

}

/* End of file sample_module.php */
