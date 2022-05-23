<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends Admin_Controller {

	public function index()
	{
		$this->load->model('users_model', 'users');
		$this->mViewData['count'] = array(
			'users' => $this->users->count_all(),
		);
				$users=$this->db->get('users')->result();

		$this->render('home');
	}

}
