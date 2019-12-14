<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Assessment extends School_admin_Controller {
	private $school_id = "";
	private $classroom_id = "";
	private $services = null;
    private $name = null;
    private $parent_page = 'school_admin';
	private $current_page = 'school_admin/assessment/';
	
	public function __construct(){
		parent::__construct();
		$this->load->library('services/Assessment_services');
		$this->services = new Assessment_services;
		$this->load->model(array(
			'group_model',
			'attitude_model',
			'predicate_attitude_model',
			'predicate_rating_model',
			'classroom_model',
			'rating_test_model',
			'rating_mid_model',
			'rating_final_model',
		));
		$this->school_id = $this->ion_auth->get_school_id();	
		$this->classroom_id = $this->classroom_model->classroom_by_user_id( $this->session->userdata('user_id') )->row();	
		$this->data['menu_list_id'] = 'assessment_index';
	}
	public function index()
	{
		// Sikap
		$table_attitude = $this->services->get_table_attitude_config( $this->current_page);
		$table_attitude[ "rows" ] = $this->attitude_model->attitude_by_school_id( $this->school_id )->result();
		$table_attitude = $this->load->view('templates/tables/plain_table', $table_attitude, true);
		$this->data[ "contents_attitude" ] = $table_attitude;

		$add_rating_attitude = array(
			"name" => "Tambah Sikap",
			"modal_id" => "add_attitude_",
			"button_color" => "primary",
			"url" => site_url( $this->current_page."add/"),
			"form_data" => array(
				'model' => array(
					'type' => 'hidden',
					'label' => "model",
					'value' => 'attitude_model',
				),
				"school_id" => array(
					'type' => 'hidden',
					'label' => "Id Sekolah",
					'value' => $this->school_id,
				),
				"name" => array(
					'type' => 'text',
					'label' => "Sikap",
					'value' => "",
				),
			),
			'data' => NULL
		);

		$add_rating_attitude= $this->load->view('templates/actions/modal_form', $add_rating_attitude, true ); 

		$this->data[ "header_button_attitude" ] =  $add_rating_attitude;

		// Predikat Sikap
		$table_predicate_attitude = $this->services->get_table_predicate_config( $this->current_page, 1, 'predicate_attitude_model');
		$table_predicate_attitude[ "rows" ] = $this->predicate_attitude_model->predicate_attitude_by_school_id( $this->school_id )->result();
		$table_predicate_attitude = $this->load->view('templates/tables/plain_table', $table_predicate_attitude, true);
		$this->data[ "contents_predicate_attitude" ] = $table_predicate_attitude;

		$add_rating_predicate_attitude = array(
			"name" => "Tambah Predikat Sikap",
			"modal_id" => "add_predicate_attitude_",
			"button_color" => "primary",
			"url" => site_url( $this->current_page."add/"),
			"form_data" => array(
				'model' => array(
					'type' => 'hidden',
					'label' => "model",
					'value' => 'predicate_attitude_model',
				),
				"school_id" => array(
					'type' => 'hidden',
					'label' => "Id Sekolah",
					'value' => $this->school_id,
				),
				"name" => array(
					'type' => 'text',
					'label' => "Predikat",
				),
				"description" => array(
					'type' => 'textarea',
					'label' => "Keterangan",
				),
			),
			'data' => NULL
		);

		$add_rating_predicate_attitude= $this->load->view('templates/actions/modal_form', $add_rating_predicate_attitude, true ); 

		$this->data[ "header_button_predicate_attitude" ] =  $add_rating_predicate_attitude;

		// Predikat Nilai
		$table_predicate_rating = $this->services->get_table_predicate_config( $this->current_page, 1, 'predicate_rating_model');
		$table_predicate_rating[ "rows" ] = $this->predicate_rating_model->Predicate_rating_by_school_id( $this->school_id )->result();
		$table_predicate_rating = $this->load->view('templates/tables/plain_table', $table_predicate_rating, true);
		$this->data[ "contents_predicate_rating" ] = $table_predicate_rating;

		$add_rating_predicate_rating = array(
			"name" => "Tambah Predikat Nilai",
			"modal_id" => "add_predicate_rating_",
			"button_color" => "primary",
			"url" => site_url( $this->current_page."add/"),
			"form_data" => array(
				'model' => array(
					'type' => 'hidden',
					'label' => "model",
					'value' => 'predicate_rating_model',
				),
				"school_id" => array(
					'type' => 'hidden',
					'label' => "Id Sekolah",
					'value' => $this->school_id,
				),
				"name" => array(
					'type' => 'text',
					'label' => "Predikat",
				),
				"description" => array(
					'type' => 'textarea',
					'label' => "Keterangan",
				),
			),
			'data' => NULL
		);

		$add_rating_predicate_rating= $this->load->view('templates/actions/modal_form', $add_rating_predicate_rating, true ); 

		$this->data[ "header_button_predicate_rating" ] =  $add_rating_predicate_rating;
		
		// return;
		#################################################################3
		$alert = $this->session->flashdata('alert');
		$this->data["key"] = $this->input->get('key', FALSE);
		$this->data["alert"] = (isset($alert)) ? $alert : NULL ;
		$this->data["current_page"] = $this->current_page;
		$this->data["block_header"] = "Kelas";
		$this->data["header"] = "Daftar Kelas";
		$this->data["sub_header"] = 'Klik Tombol Action Untuk Aksi Lebih Lanjut';
		$this->render( "school_admin/assessment" );
	}

	public function add(  )
	{
		if( !($_POST) ) redirect(site_url(  $this->current_page ));  

		// echo var_dump( $data );return;
		$this->form_validation->set_rules( 'name', 'Nama', 'required|trim' );
        if ($this->form_validation->run() === TRUE )
        {
			$model = $this->input->post( 'model' );
			$data['school_id'] = $this->input->post( 'school_id' );
			$data['name'] = $this->input->post( 'name' );

			switch ($model) {
				case 'predicate_attitude_model':
				case 'predicate_rating_model':
					$data['description'] = $this->input->post( 'description' );
					break;
				
				default:
					# code...
					break;
			}
			if( $this->$model->create( $data ) ){
				$this->session->set_flashdata('alert', $this->alert->set_alert( Alert::SUCCESS, $this->$model->messages() ) );
			}else{
				$this->session->set_flashdata('alert', $this->alert->set_alert( Alert::DANGER, $this->$model->errors() ) );
			}
		}
        else
        {
          $this->data['message'] = (validation_errors() ? validation_errors() : ($this->m_account->errors() ? $this->$model->errors() : $this->session->flashdata('message')));
          if(  validation_errors() || $this->$model->errors() ) $this->session->set_flashdata('alert', $this->alert->set_alert( Alert::DANGER, $this->data['message'] ) );
		}
		
		redirect( site_url($this->current_page) );
	}

	public function edit(  )
	{
		if( !($_POST) ) redirect(site_url(  $this->current_page ));  

		// echo var_dump( $data );return;
		$this->form_validation->set_rules( 'name', 'Nama', 'required|trim' );
        if ($this->form_validation->run() === TRUE )
        {

			$model = $this->input->post( 'model' );
			$data['name'] = $this->input->post( 'name' );
			switch ($model) {
				case 'predicate_attitude_model':
				case 'predicate_rating_model':
					$data['description'] = $this->input->post( 'description' );
					break;
				
				default:
					# code...
					break;
			}
			$data_param['id'] = $this->input->post( 'id' );

			if( $this->$model->update( $data, $data_param  ) ){
				$this->session->set_flashdata('alert', $this->alert->set_alert( Alert::SUCCESS, $this->$model->messages() ) );
			}else{
				$this->session->set_flashdata('alert', $this->alert->set_alert( Alert::DANGER, $this->$model->errors() ) );
			}
		}
        else
        {
          $this->data['message'] = (validation_errors() ? validation_errors() : ($this->m_account->errors() ? $this->$model->errors() : $this->session->flashdata('message')));
          if(  validation_errors() || $this->$model->errors() ) $this->session->set_flashdata('alert', $this->alert->set_alert( Alert::DANGER, $this->data['message'] ) );
		}
		
		redirect( site_url($this->current_page)  );
	}

	public function delete(  ) {
		if( !($_POST) ) redirect( site_url($this->current_page) );

		$model = $this->input->post( 'model' );
	  
		$data_param['id'] 	= $this->input->post('id');
		if( $this->$model->delete( $data_param ) ){
		  $this->session->set_flashdata('alert', $this->alert->set_alert( Alert::SUCCESS, $this->$model->messages() ) );
		}else{
		  $this->session->set_flashdata('alert', $this->alert->set_alert( Alert::DANGER, $this->$model->errors() ) );
		}
		redirect( site_url($this->current_page)  );
	}
}
