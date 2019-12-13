<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Classroom extends School_admin_Controller {
	private $school_id = "";
	private $services = null;
    private $name = null;
    private $parent_page = 'school_admin';
	private $current_page = 'school_admin/classroom/';
	
	public function __construct(){
		parent::__construct();
		$this->load->library('services/Classroom_services');
		$this->services = new Classroom_services;
		$this->load->model(array(
			'group_model',
			'courses_model',
			'category_model',
			'students_model',
			'classroom_model',
		));
		$this->school_id = $this->ion_auth->get_school_id();	
		$this->data['menu_list_id'] = 'classroom_index';
	}
	public function index()
	{
		$teachers = $this->ion_auth->users( 5  )->result();
		$list_teacher[''] = '-- Pilih Wali Kelas --';
		foreach ($teachers as $key => $teacher) {
			$list_teacher[$teacher->id] = $teacher->user_fullname;
		}
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
		$table = $this->services->get_table_classroom_config( $this->current_page );
		$table[ "rows" ] = $this->classroom_model->classrooms_by_school_id( $pagination['start_record'], $pagination['limit_per_page'], $this->school_id )->result();
		$table = $this->load->view('templates/tables/plain_table', $table, true);
		$this->data[ "contents" ] = $table;
		$add_menu = array(
			"name" => "Tambah Kelas",
			"modal_id" => "add_group_",
			"button_color" => "primary",
			"url" => site_url( $this->current_page."add_classroom/"),
			"form_data" => array(
				"school_id" => array(
					'type' => 'hidden',
					'label' => "Sekolah",
					'value' => $this->school_id,
				),
				"name" => array(
					'type' => 'text',
					'label' => "Nama Kelas",
					'value' => "",
				),
				"user_id" => array(
					'type' => 'select',
					'label' => "Wali Kelas",
					'options' => $list_teacher,
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
		$this->data["block_header"] = "Kelas";
		$this->data["header"] = "Daftar Kelas";
		$this->data["sub_header"] = 'Klik Tombol Action Untuk Aksi Lebih Lanjut';
		$this->render( "templates/contents/plain_content" );
	}
	public function student($classroom_id)
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
		$table = $this->services->get_table_config( $this->current_page, ($pagination['start_record'] + 1), $classroom_id );
		$table[ "rows" ] = $this->students_model->students_by_classroom_id( $pagination['start_record'], $pagination['limit_per_page'], $classroom_id )->result();
		$table = $this->load->view('templates/tables/plain_table', $table, true);
		$this->data[ "contents" ] = $table;
		$add_menu = array(
			"name" => "Tambah Siswa",
			"modal_id" => "add_group_",
			"button_color" => "primary",
			"url" => site_url( $this->current_page."add/"),
			"form_data" => array(
				"school_id" => array(
					'type' => 'hidden',
					'label' => "Sekolah",
					'value' => $this->school_id,
				),
				"classroom_id" => array(
					'type' => 'hidden',
					'label' => "Sekolah",
					'value' => $classroom_id,
				),
				"name" => array(
					'type' => 'text',
					'label' => "Nama Siswa",
					'value' => "",
				),
				"nis" => array(
					'type' => 'text',
					'label' => "NIS Siswa",
					'value' => "",
				),
				"nisn" => array(
					'type' => 'text',
					'label' => "NISN Siswa",
					'value' => "",
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
		$this->data["block_header"] = "Siswa";
		$this->data["header"] = "Daftar Siswa";
		$this->data["sub_header"] = 'Klik Tombol Action Untuk Aksi Lebih Lanjut';
		$this->render( "templates/contents/plain_content" );
	}


	public function add(  )
	{
		if( !($_POST) ) redirect(site_url(  $this->current_page ));  

		// echo var_dump( $data );return;
		$this->form_validation->set_rules( $this->services->validation_student_config() );
        if ($this->form_validation->run() === TRUE )
        {
			$data['classroom_id'] = $this->input->post( 'classroom_id' );
			$data['school_id'] = $this->input->post( 'school_id' );
			$data['name'] = $this->input->post( 'name' );
			$data['nis'] = $this->input->post( 'nis' );
			$data['nisn'] = $this->input->post( 'nisn' );

			if( $this->students_model->create( $data ) ){
				$this->session->set_flashdata('alert', $this->alert->set_alert( Alert::SUCCESS, $this->students_model->messages() ) );
			}else{
				$this->session->set_flashdata('alert', $this->alert->set_alert( Alert::DANGER, $this->students_model->errors() ) );
			}
		}
        else
        {
          $this->data['message'] = (validation_errors() ? validation_errors() : ($this->m_account->errors() ? $this->students_model->errors() : $this->session->flashdata('message')));
          if(  validation_errors() || $this->students_model->errors() ) $this->session->set_flashdata('alert', $this->alert->set_alert( Alert::DANGER, $this->data['message'] ) );
		}
		
		redirect( site_url($this->current_page) .'student/' . $data['classroom_id'] );
	}

	public function add_classroom(  )
	{
		if( !($_POST) ) redirect(site_url(  $this->current_page ));  

		// echo var_dump( $data );return;
		$this->form_validation->set_rules( $this->services->validation_config() );
        if ($this->form_validation->run() === TRUE )
        {
			$data['school_id'] = $this->input->post( 'school_id' );
			$data['name'] = $this->input->post( 'name' );
			$data['description'] = $this->input->post( 'description' );

			if( $this->classroom_model->create( $data ) ){
				$this->session->set_flashdata('alert', $this->alert->set_alert( Alert::SUCCESS, $this->classroom_model->messages() ) );
			}else{
				$this->session->set_flashdata('alert', $this->alert->set_alert( Alert::DANGER, $this->classroom_model->errors() ) );
			}
		}
        else
        {
          $this->data['message'] = (validation_errors() ? validation_errors() : ($this->m_account->errors() ? $this->classroom_model->errors() : $this->session->flashdata('message')));
          if(  validation_errors() || $this->classroom_model->errors() ) $this->session->set_flashdata('alert', $this->alert->set_alert( Alert::DANGER, $this->data['message'] ) );
		}
		
		redirect( site_url($this->current_page)  );
	}

	public function edit_classroom(  )
	{
		if( !($_POST) ) redirect(site_url(  $this->current_page ));  

		// echo var_dump( $data );return;
		$this->form_validation->set_rules( $this->services->validation_config() );
        if ($this->form_validation->run() === TRUE )
        {
			$data['name'] = $this->input->post( 'name' );
			$data['description'] = $this->input->post( 'description' );

			$data_param['id'] = $this->input->post( 'id' );

			if( $this->classroom_model->update( $data, $data_param  ) ){
				$this->session->set_flashdata('alert', $this->alert->set_alert( Alert::SUCCESS, $this->classroom_model->messages() ) );
			}else{
				$this->session->set_flashdata('alert', $this->alert->set_alert( Alert::DANGER, $this->classroom_model->errors() ) );
			}
		}
        else
        {
          $this->data['message'] = (validation_errors() ? validation_errors() : ($this->m_account->errors() ? $this->classroom_model->errors() : $this->session->flashdata('message')));
          if(  validation_errors() || $this->classroom_model->errors() ) $this->session->set_flashdata('alert', $this->alert->set_alert( Alert::DANGER, $this->data['message'] ) );
		}
		
		redirect( site_url($this->current_page)  );
	}
	public function edit(  )
	{
		if( !($_POST) ) redirect(site_url(  $this->current_page ));  

		// echo var_dump( $data );return;
		$this->form_validation->set_rules( $this->services->validation_student_config() );
        if ($this->form_validation->run() === TRUE )
        {
			$classroom_id = $this->input->post( 'classroom_id' );
			$data['name'] = $this->input->post( 'name' );
			$data['nis'] = $this->input->post( 'nis' );
			$data['nisn'] = $this->input->post( 'nisn' );

			$data_param['id'] = $this->input->post( 'id' );

			if( $this->students_model->update( $data, $data_param  ) ){
				$this->session->set_flashdata('alert', $this->alert->set_alert( Alert::SUCCESS, $this->students_model->messages() ) );
			}else{
				$this->session->set_flashdata('alert', $this->alert->set_alert( Alert::DANGER, $this->students_model->errors() ) );
			}
		}
        else
        {
          $this->data['message'] = (validation_errors() ? validation_errors() : ($this->m_account->errors() ? $this->students_model->errors() : $this->session->flashdata('message')));
          if(  validation_errors() || $this->students_model->errors() ) $this->session->set_flashdata('alert', $this->alert->set_alert( Alert::DANGER, $this->data['message'] ) );
		}
		
		redirect( site_url($this->current_page) . 'student/' . $classroom_id  );
	}

	public function delete(  ) {
		if( !($_POST) ) redirect( site_url($this->current_page) );
	  
		$data_param['id'] 	= $this->input->post('id');
		if( $this->students_model->delete( $data_param ) ){
		  $this->session->set_flashdata('alert', $this->alert->set_alert( Alert::SUCCESS, $this->students_model->messages() ) );
		}else{
		  $this->session->set_flashdata('alert', $this->alert->set_alert( Alert::DANGER, $this->students_model->errors() ) );
		}
		redirect( site_url($this->current_page)  );
	}
	public function delete_classroom(  ) {
		if( !($_POST) ) redirect( site_url($this->current_page) );
	  
		$data_param['id'] 	= $this->input->post('id');
		if( $this->classroom_model->delete( $data_param ) ){
		  $this->session->set_flashdata('alert', $this->alert->set_alert( Alert::SUCCESS, $this->classroom_model->messages() ) );
		}else{
		  $this->session->set_flashdata('alert', $this->alert->set_alert( Alert::DANGER, $this->classroom_model->errors() ) );
		}
		redirect( site_url($this->current_page)  );
	}
}
