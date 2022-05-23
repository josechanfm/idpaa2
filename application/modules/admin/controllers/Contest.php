<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contest extends Admin_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_builder');
		$this->load->model('contests_model','contests');
	}
	public function list(){
		$this->add_script('/assets/dist/vue/axios.min.js',FALSE,'head');
		$this->add_script('/assets/dist/vue/vue.min.js',FALSE,'head');
		$this->add_script('/assets/dist/vue/contest_list.js');
		//$this->add_stylesheet('/assets/dist/vue/demo_vue.css');
		$this->render('contest/create');
	}
	public function create(){
		$this->add_script('/assets/dist/vue/axios.min.js',FALSE,'head');
		$this->add_script('/assets/dist/vue/vue.min.js',FALSE,'head');
		$this->add_script('/assets/dist/vue/contest_create.js');
		$form = $this->form_builder->create_form('','multipart',array('class'=>'form-horizontal'));
		//$this->add_stylesheet('/assets/dist/vue/demo_vue.css');
		$this->mViewData['form']=$form;
		$this->render('contest/create');
	}
	public function create_contest(){
		$_POST=json_decode(file_get_contents("php://input"),true);
		$data=array(
			'title_zh'=>$_POST['title_zh'],
			'date'=>$_POST['date'],
			'description'=>$_POST['description']
		);
		$insertedId=$this->contests->insert($data);
		echo $insertedId;
		//echo json_encode($data);
	}
	public function test(){
		$arr=Array(
				Array(
		            'interval' => '2014-10-26',
		            'leads' => 0,
		            'name' => 'CarEnquiry',
		            'status' => 'NEW',
		            'appointment' => 0,
		        ),
				Array(
		            'interval' => '2014-10-26',
		            'leads' => 0,
		            'name' => 'CarEnquiry',
		            'status' => 'CALL1',
		            'appointment' => 0,
		        ),
			    Array(
		            'interval' => '2014-10-26',
		            'leads' => 0,
		            'name' => 'Finance',
		            'status' => 'CALL2',
		            'appointment' => 0,
		        ),
			    Array(
		            'interval' => '2014-10-26',
		            'leads' => 0,
		            'name' => 'Partex',
		            'status' => 'CALL3',
		            'appointment' => 0,
		        )
			);

			$new = array_filter($arr, function ($var) {
    			return ($var['name'] == 'CarEnquiry');
			});
			echo json_encode($new);

	}
	public function save_categories(){
		$_POST=json_decode(file_get_contents("php://input"),true);
		$contest_id=$_POST['contest']['id'];
		$stages=$_POST['stages'];
		foreach($stages as $stage){
			if($stage['id']==''){
				$this->db->insert('contest_stages',['contest_id'=>$contest_id, 'name_zh'=>$stage['name']]);

			}
		}
		$filter='';
		$newStages=array_filter($stages, function($s){
			return $s['id']=='';
		});
		echo json_encode($stages);
	}
	public function index()
	{
		$crud=$this->generate_crud('contests');
    	$crud->add_action('Stages', '', $this->mModule.'/'.$this->mCtrler.'/stage','fa fa-cubes');
    	$crud->add_action('Category', '', $this->mModule.'/'.$this->mCtrler.'/category','fa fa-clone');		
    	$crud->add_action('More', '', $this->mModule.'/'.$this->mCtrler.'/shooter','fa fa-users');
		$this->render_crud();
	}
	public function category($contestId=1){
		$crud=$this->generate_crud('contests_categories');
		$crud->where('contest_id',$contestId);
		$crud->set_relation('contest_id','contests','name_zh');
		$crud->set_relation_n_n('Stages','contests_categories_stages','contests_stages','category_id','stage_id','name_zh','priority',array('contest_id'=>$contestId));
		$crud->set_relation_n_n('Shooters','contests_categories_shooters','contests_shooters','shooter_id','category_id','name_zh','priority');
		$this->render_crud();

	}
	public function stage($contestId=1){
		$crud=$this->generate_crud('contests_stages');
		$crud->where('contest_id',$contestId);
		$crud->set_relation('contest_id','contests','title_zh');
		$crud->add_action('Edit','','admin/contest/stage_editor','fa fa-bullseye');
		$crud->unset_texteditor('targets');
		$crud->unset_edit();
		$crud->unset_delete();
		$crud->unset_clone();
		$crud->unset_read();
		$this->render_crud();

	}
	public function stage_editor($stageId=3){
		$form = $this->form_builder->create_form('','multipart',array('class'=>'form-horizontal'));
		if ($form->validate())
		{
			$data=array(
				'id'=>$_POST['stage_id'],
				'match_id'=>$matchId,
				'name'=>$_POST['stage_name'],
				'popeye'=>$_POST['popeye'],
				'no_shoot'=>$_POST['no_shoot'],
				'targets'=>implode(',',$_POST['target']),
			);
			if(isset($_POST['group_id'])){
				$data['group_id']=$_POST['group_id'];
			}
			if($_POST['stage_id']>0){
				$this->db->where('id',$_POST['stage_id']);
				$this->db->update('match_stages',$data);

			}else{
				$this->db->insert('match_stages',$data);
			}
			refresh();
		}
		$stage=$this->db->where('id',$stageId)
				->get('contests_stages')->row();
		//$categories=$this->db->where('contest_id',$stage->contest_id)
				// ->get('contests_categories')->result();
		$contest=$this->db->where('id',$stage->contest_id)->get('contests')->row();
		$this->mViewData['stage']=$stage;
		//$this->mViewData['categories']=$categories;
		$this->mViewData['contest']=$contest;
		$this->mViewData['form'] = $form;
		$this->render('contest/stage','empty');
	}
	public function shooter($contestId=1){
		$crud=$this->generate_crud('shooters');
		$crud->set_relation('member_id','members','name_zh');
		$this->render_crud();

	}

	public function score($contestId=1){
		$contest=$this->db->where('id',$contestId)->get('contests')->row();
		$categories=$this->db->where('contest_id',$contestId)->get('contests_categories')->result();
		$stages=$this->db->where('contest_id',$contestId)->get('contests_stages')->result();
		$this->mViewData['contest']=$contest;
		$this->mViewData['categories']=$categories;
		$this->mViewData['stages']=$stages;
		$this->render($this->mCtrler.'/score');
	}


}
