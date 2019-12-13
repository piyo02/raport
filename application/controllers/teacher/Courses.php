<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Courses extends Teacher_Controller {
	private $school_id = "";
	private $services = null;
    private $name = null;
    private $parent_page = 'teacher';
	private $current_page = 'teacher/courses/';
	
	public function __construct(){
		parent::__construct();
		$this->load->library('services/Courses_services');
		$this->services = new Courses_services;
		$this->load->model(array(
			'group_model',
			'courses_model',
			'category_model',
		));
		$this->school_id = $this->ion_auth->get_school_id();	
		$this->data['menu_list_id'] = 'courses_index';
	}
	public function index()
	{
		$page = ($this->uri->segment(4)) ? ($this->uri->segment(4) -  1 ) : 0;
		// echo $page; return;
        //pagination parameter
        $pagination['base_url'] = base_url( $this->current_page ) .'/index';
        $pagination['total_records'] = $this->category_model->record_count() ;
        $pagination['limit_per_page'] = 10;
        $pagination['start_record'] = $page*$pagination['limit_per_page'];
        $pagination['uri_segment'] = 4;
		//set pagination
		if ($pagination['total_records'] > 0 ) $this->data['pagination_links'] = $this->setPagination($pagination);
		#################################################################3
		$table = $this->services->get_table_category_config( $this->current_page );
		$table[ "rows" ] = $this->category_model->categories( $pagination['start_record'], $pagination['limit_per_page'] )->result();
		$table = $this->load->view('templates/tables/plain_table', $table, true);
		$this->data[ "contents" ] = $table;
		$add_menu = array(
			"name" => "Tambah Kelompok Mata Pelajaran",
			"modal_id" => "add_group_",
			"button_color" => "primary",
			"url" => site_url( $this->current_page."add_category/"),
			"form_data" => array(
				"school_id" => array(
					'type' => 'hidden',
					'label' => "Sekolah",
					'value' => $this->school_id,
				),
				"name" => array(
					'type' => 'text',
					'label' => "Nama Kelompok",
					'value' => "",
				),
				"description" => array(
					'type' => 'textarea',
					'label' => "Deskripsi",
					'value' => "-",
				),
			),
			'data' => NULL
		);

		$add_menu= $this->load->view('templates/actions/modal_form', $add_menu, true ); 

		$this->data[ "header_button" ] =  $add_menu;
		// return;
		#################################################################3
		$alert = $this->session->flashdata('alert');
		$this->data["key"] = $this->input->get('key', FALSE);
		$this->data["alert"] = (isset($alert)) ? $alert : NULL ;
		$this->data["current_page"] = $this->current_page;
		$this->data["block_header"] = "Kelompok Mata Pelajaran";
		$this->data["header"] = "Kelompok Mata Pelajaran";
		$this->data["sub_header"] = 'Klik Tombol Action Untuk Aksi Lebih Lanjut';
		$this->render( "templates/contents/plain_content" );
	}
	public function course($category_id)
	{
		$page = ($this->uri->segment(4 + 1)) ? ($this->uri->segment(4+1) -  1 ) : 0;
		// echo $page; return;
        //pagination parameter
        $pagination['base_url'] = base_url( $this->current_page ) .'/index';
        $pagination['total_records'] = $this->courses_model->record_count() ;
        $pagination['limit_per_page'] = 10;
        $pagination['start_record'] = $page*$pagination['limit_per_page'];
        $pagination['uri_segment'] = 4;
		//set pagination
		if ($pagination['total_records'] > 0 ) $this->data['pagination_links'] = $this->setPagination($pagination);
		#################################################################3
		$table = $this->services->get_table_config( $this->current_page );
		$table[ "rows" ] = $this->courses_model->courses_category_id( $pagination['start_record'], $pagination['limit_per_page'], $category_id )->result();
		$table = $this->load->view('templates/tables/plain_table', $table, true);
		$this->data[ "contents" ] = $table;
		$add_menu = array(
			"name" => "Tambah Mata Pelajaran",
			"modal_id" => "add_group_",
			"button_color" => "primary",
			"url" => site_url( $this->current_page."add/"),
			"form_data" => array(
				"school_id" => array(
					'type' => 'hidden',
					'label' => "Sekolah",
					'value' => $this->school_id,
				),
				"category_id" => array(
					'type' => 'hidden',
					'label' => "Kelompok",
					'value' => $category_id,
				),
				"name" => array(
					'type' => 'text',
					'label' => "Nama Mata Pelajaran",
					'value' => "",
				),
				"description" => array(
					'type' => 'textarea',
					'label' => "Deskripsi",
					'value' => "-",
				),
			),
			'data' => NULL
		);

		$add_menu= $this->load->view('templates/actions/modal_form', $add_menu, true ); 

		$this->data[ "header_button" ] =  $add_menu;
		// return;
		#################################################################3
		$alert = $this->session->flashdata('alert');
		$this->data["key"] = $this->input->get('key', FALSE);
		$this->data["alert"] = (isset($alert)) ? $alert : NULL ;
		$this->data["current_page"] = $this->current_page;
		$this->data["block_header"] = "Kelompok Mata Pelajaran";
		$this->data["header"] = "Kelompok Mata Pelajaran";
		$this->data["sub_header"] = 'Klik Tombol Action Untuk Aksi Lebih Lanjut';
		$this->render( "templates/contents/plain_content" );
	}


	public function add(  )
	{
		if( !($_POST) ) redirect(site_url(  $this->current_page ));  

		// echo var_dump( $data );return;
		$this->form_validation->set_rules( $this->services->validation_config() );
        if ($this->form_validation->run() === TRUE )
        {
			$data['category_id'] = $this->input->post( 'category_id' );
			$data['school_id'] = $this->input->post( 'school_id' );
			$data['name'] = $this->input->post( 'name' );
			$data['description'] = $this->input->post( 'description' );

			if( $this->courses_model->create( $data ) ){
				$this->session->set_flashdata('alert', $this->alert->set_alert( Alert::SUCCESS, $this->courses_model->messages() ) );
			}else{
				$this->session->set_flashdata('alert', $this->alert->set_alert( Alert::DANGER, $this->courses_model->errors() ) );
			}
		}
        else
        {
          $this->data['message'] = (validation_errors() ? validation_errors() : ($this->m_account->errors() ? $this->courses_model->errors() : $this->session->flashdata('message')));
          if(  validation_errors() || $this->courses_model->errors() ) $this->session->set_flashdata('alert', $this->alert->set_alert( Alert::DANGER, $this->data['message'] ) );
		}
		
		redirect( site_url($this->current_page) .'course/' . $data['category_id'] );
	}

	public function add_category(  )
	{
		if( !($_POST) ) redirect(site_url(  $this->current_page ));  

		// echo var_dump( $data );return;
		$this->form_validation->set_rules( $this->services->validation_config() );
        if ($this->form_validation->run() === TRUE )
        {
			$data['school_id'] = $this->input->post( 'school_id' );
			$data['name'] = $this->input->post( 'name' );
			$data['description'] = $this->input->post( 'description' );

			if( $this->category_model->create( $data ) ){
				$this->session->set_flashdata('alert', $this->alert->set_alert( Alert::SUCCESS, $this->courses_model->messages() ) );
			}else{
				$this->session->set_flashdata('alert', $this->alert->set_alert( Alert::DANGER, $this->courses_model->errors() ) );
			}
		}
        else
        {
          $this->data['message'] = (validation_errors() ? validation_errors() : ($this->m_account->errors() ? $this->courses_model->errors() : $this->session->flashdata('message')));
          if(  validation_errors() || $this->courses_model->errors() ) $this->session->set_flashdata('alert', $this->alert->set_alert( Alert::DANGER, $this->data['message'] ) );
		}
		
		redirect( site_url($this->current_page)  );
	}

	public function edit_category(  )
	{
		if( !($_POST) ) redirect(site_url(  $this->current_page ));  

		// echo var_dump( $data );return;
		$this->form_validation->set_rules( $this->services->validation_config() );
        if ($this->form_validation->run() === TRUE )
        {
			$data['name'] = $this->input->post( 'name' );
			$data['description'] = $this->input->post( 'description' );

			$data_param['id'] = $this->input->post( 'id' );

			if( $this->category_model->update( $data, $data_param  ) ){
				$this->session->set_flashdata('alert', $this->alert->set_alert( Alert::SUCCESS, $this->courses_model->messages() ) );
			}else{
				$this->session->set_flashdata('alert', $this->alert->set_alert( Alert::DANGER, $this->courses_model->errors() ) );
			}
		}
        else
        {
          $this->data['message'] = (validation_errors() ? validation_errors() : ($this->m_account->errors() ? $this->courses_model->errors() : $this->session->flashdata('message')));
          if(  validation_errors() || $this->courses_model->errors() ) $this->session->set_flashdata('alert', $this->alert->set_alert( Alert::DANGER, $this->data['message'] ) );
		}
		
		redirect( site_url($this->current_page)  );
	}
	public function edit(  )
	{
		if( !($_POST) ) redirect(site_url(  $this->current_page ));  

		// echo var_dump( $data );return;
		$this->form_validation->set_rules( $this->services->validation_config() );
        if ($this->form_validation->run() === TRUE )
        {
			$data['name'] = $this->input->post( 'name' );
			$data['description'] = $this->input->post( 'description' );

			$data_param['id'] = $this->input->post( 'id' );

			if( $this->courses_model->update( $data, $data_param  ) ){
				$this->session->set_flashdata('alert', $this->alert->set_alert( Alert::SUCCESS, $this->courses_model->messages() ) );
			}else{
				$this->session->set_flashdata('alert', $this->alert->set_alert( Alert::DANGER, $this->courses_model->errors() ) );
			}
		}
        else
        {
          $this->data['message'] = (validation_errors() ? validation_errors() : ($this->m_account->errors() ? $this->courses_model->errors() : $this->session->flashdata('message')));
          if(  validation_errors() || $this->courses_model->errors() ) $this->session->set_flashdata('alert', $this->alert->set_alert( Alert::DANGER, $this->data['message'] ) );
		}
		
		redirect( site_url($this->current_page)  );
	}

	public function delete(  ) {
		if( !($_POST) ) redirect( site_url($this->current_page) );
	  
		$data_param['id'] 	= $this->input->post('id');
		if( $this->courses_model->delete( $data_param ) ){
		  $this->session->set_flashdata('alert', $this->alert->set_alert( Alert::SUCCESS, $this->courses_model->messages() ) );
		}else{
		  $this->session->set_flashdata('alert', $this->alert->set_alert( Alert::DANGER, $this->courses_model->errors() ) );
		}
		redirect( site_url($this->current_page)  );
	}
	public function delete_category(  ) {
		if( !($_POST) ) redirect( site_url($this->current_page) );
	  
		$data_param['id'] 	= $this->input->post('id');
		if( $this->category_model->delete( $data_param ) ){
		  $this->session->set_flashdata('alert', $this->alert->set_alert( Alert::SUCCESS, $this->courses_model->messages() ) );
		}else{
		  $this->session->set_flashdata('alert', $this->alert->set_alert( Alert::DANGER, $this->courses_model->errors() ) );
		}
		redirect( site_url($this->current_page)  );
	}
}
