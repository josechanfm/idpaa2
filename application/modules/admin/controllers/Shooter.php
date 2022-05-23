<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Shooter extends Admin_Controller {

	public function index()
	{
		$shooters=$this->db->get('match_shooters')->result();
		$this->mViewData['shooters']=$shooters;
		$this->render('shooter');
	}

	public function is_member($id){
		$this->db->set('is_member',1);
		$this->db->where('id',$id);
		$this->db->update('match_shooters');
	}

}
