<?php

/**
 * Config file for form validation
 * http://www.codeigniter.com/user_guide/libraries/form_validation.html (Under section "Creating Sets of Rules")
 */

$config = array(
	// school mailer
	'home/mailer' => array(
		array(
			'field'		=> 'vacancy_id',
			'label'		=> '開考編號<br>No. de recrutamento',
			'rules'		=> 'required',
		),
		array(
			'field'		=> 'vacancy_edu',
			'label'		=> 'Reciever Email',
			'rules'		=> 'required',
		),
	),

	/** Example: 
	'auth/login' => array(
		array(
			'field'		=> 'email',
			'label'		=> 'Email',
			'rules'		=> 'required|valid_email',
		),
		array(
			'field'		=> 'password',
			'label'		=> 'Password',
			'rules'		=> 'required',
		),
	),*/
);


/**
 * Google reCAPTCHA settings
 * https://www.google.com/recaptcha/
 */
$config['recaptcha'] = array(
	'site_key'		=> '6Lf7bJ4UAAAAANaeh1Br92Mb7SEuDpBZKbxn597D',
	'secret_key'	=> '6Lf7bJ4UAAAAAIe2df7MnhU3_3PKAXqOxnW_2Fkn'
);
