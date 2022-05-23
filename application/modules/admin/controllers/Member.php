<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Member extends Admin_Controller {

	public function index()
	{
		$crud=$this->generate_crud('match_shooters');
		$this->render_crud();
	}

}
