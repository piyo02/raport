<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Assessment extends Teacher_Controller {
	private $school_id = "";
	private $classroom_id = "";
	private $services = null;
    private $name = null;
    private $parent_page = 'teacher';
	private $current_page = 'teacher/assessment/';
	
	public function __construct(){
		parent::__construct();
		$this->load->library('services/Assessment_services');
		$this->services = new Assessment_services;
		$this->load->model(array(
			'group_model',
			'courses_model',
			'category_model',
			'students_model',
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
		
		if(isset($this->classroom_id->id)){
			$add_menu = array(
				"name" => "Lihat Perwalian",
				// "modal_id" => "detail_",
				"button_color" => "primary",
				"url" => site_url( $this->current_page."add_classroom"),
				'get' => "?classroom_id=" . $this->classroom_id->id,
				'data' => NULL
			);
	
			$add_menu= $this->load->view('templates/actions/link', $add_menu, true ); 
	
			$this->data[ "header_button" ] =  $add_menu;
		}
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
		$table = $this->services->get_table_config( $this->current_page, ($pagination['start_record'] + 1), $this->school_id );
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

		// $this->data[ "header_button" ] =  $add_menu;
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
	public function assessment_course()
	{
		$id = $this->input->get('id');
		$course_id = $this->input->get('course_id');

		//Rating Test
		$table_test = $this->services->get_table_test_config( $this->current_page);
		$table_test[ "rows" ] = $this->rating_test_model->rating_test_by_student_id( $id, $course_id )->result();
		$table_test = $this->load->view('templates/tables/plain_table', $table_test, true);
		$this->data[ "contents_test" ] = $table_test;

		$add_rating_test = array(
			"name" => "Tambah Nilai",
			"modal_id" => "add_test_",
			"button_color" => "primary",
			"url" => site_url( $this->current_page."add/"),
			"form_data" => array(
				'model' => array(
					'type' => 'hidden',
					'label' => "Siswa",
					'value' => 'rating_test_model',
				),
				"student_id" => array(
					'type' => 'hidden',
					'label' => "Siswa",
					'value' => $id,
				),
				"course_id" => array(
					'type' => 'hidden',
					'label' => "Mata Pelajaran",
					'value' => $course_id,
				),
				"name" => array(
					'type' => 'text',
					'label' => "Ulangan Harian",
					'value' => "",
				),
				"value" => array(
					'type' => 'number',
					'label' => "Nilai",
					'value' => "",
				),
			),
			'data' => NULL
		);

		$add_rating_test= $this->load->view('templates/actions/modal_form', $add_rating_test, true ); 

		$this->data[ "header_button_test" ] =  $add_rating_test;

		// Rating Mid
		$table_mid = $this->services->get_table_mid_config( $this->current_page);
		$table_mid[ "rows" ] = $this->rating_mid_model->rating_mid_by_student_id( $id, $course_id )->result();
		$table_mid = $this->load->view('templates/tables/plain_table', $table_mid, true);
		$this->data[ "contents_mid" ] = $table_mid;

		$add_rating_mid = array(
			"name" => "Tambah Nilai",
			"modal_id" => "add_mid_",
			"button_color" => "primary",
			"url" => site_url( $this->current_page."add/"),
			"form_data" => array(
				'model' => array(
					'type' => 'hidden',
					'label' => "Siswa",
					'value' => 'rating_mid_model',
				),
				"student_id" => array(
					'type' => 'hidden',
					'label' => "Siswa",
					'value' => $id,
				),
				"course_id" => array(
					'type' => 'hidden',
					'label' => "Mata Pelajaran",
					'value' => $course_id,
				),
				"name" => array(
					'type' => 'text',
					'label' => "Mid",
					'value' => "",
				),
				"value" => array(
					'type' => 'number',
					'label' => "Nilai",
					'value' => "",
				),
			),
			'data' => NULL
		);

		$add_rating_mid= $this->load->view('templates/actions/modal_form', $add_rating_mid, true ); 

		$this->data[ "header_button_mid" ] =  $add_rating_mid;

		// Rating Final
		$table_final = $this->services->get_table_final_config( $this->current_page);
		$table_final[ "rows" ] = $this->rating_final_model->rating_final_by_student_id( $id, $course_id )->result();
		$table_final = $this->load->view('templates/tables/plain_table', $table_final, true);
		$this->data[ "contents_final" ] = $table_final;

		$add_rating_final = array(
			"name" => "Tambah Nilai",
			"modal_id" => "add_final_",
			"button_color" => "primary",
			"url" => site_url( $this->current_page."add/"),
			"form_data" => array(
				'model' => array(
					'type' => 'hidden',
					'label' => "Siswa",
					'value' => 'rating_final_model',
				),
				"student_id" => array(
					'type' => 'hidden',
					'label' => "Siswa",
					'value' => $id,
				),
				"course_id" => array(
					'type' => 'hidden',
					'label' => "Mata Pelajaran",
					'value' => $course_id,
				),
				"name" => array(
					'type' => 'text',
					'label' => "UAS",
					'value' => "",
				),
				"value" => array(
					'type' => 'number',
					'label' => "Nilai",
					'value' => "",
				),
			),
			'data' => NULL
		);

		$add_rating_final= $this->load->view('templates/actions/modal_form', $add_rating_final, true ); 

		$this->data[ "header_button_final" ] =  $add_rating_final;
		#################################################################3
		$alert = $this->session->flashdata('alert');
		$this->data["key"] = $this->input->get('key', FALSE);
		$this->data["alert"] = (isset($alert)) ? $alert : NULL ;
		$this->data["current_page"] = $this->current_page;
		$this->data["block_header"] = "Input Nilai";
		$this->data["header"] = "Input Nilai";
		$this->data["sub_header"] = 'Klik Tombol Action Untuk Aksi Lebih Lanjut';
		$this->render( "teacher/assessment" );
	}

	public function add(  )
	{
		if( !($_POST) ) redirect(site_url(  $this->current_page ));  

		// echo var_dump( $data );return;
		$this->form_validation->set_rules( $this->services->validation_assessment_config() );
        if ($this->form_validation->run() === TRUE )
        {
			$model = $this->input->post( 'model' );
			$data['student_id'] = $this->input->post( 'student_id' );
			$data['course_id'] = $this->input->post( 'course_id' );
			$data['name'] = $this->input->post( 'name' );
			$data['value'] = $this->input->post( 'value' );

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
		
		redirect( site_url($this->current_page) .'assessment_course?id=' . $data['student_id'] . '&course_id=' . $data['course_id'] );
	}

	public function edit(  )
	{
		if( !($_POST) ) redirect(site_url(  $this->current_page ));  

		// echo var_dump( $data );return;
		$this->form_validation->set_rules( $this->services->validation_assessment_config() );
        if ($this->form_validation->run() === TRUE )
        {
			$student_id = $this->input->post( 'student_id' );
			$course_id = $this->input->post( 'course_id' );

			$model = $this->input->post( 'model' );
			$data['name'] = $this->input->post( 'name' );
			$data['value'] = $this->input->post( 'value' );

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
		
		redirect( site_url($this->current_page) .'assessment_course?id=' . $student_id . '&course_id=' . $course_id  );
	}

	public function delete(  ) {
		if( !($_POST) ) redirect( site_url($this->current_page) );

		$student_id = $this->input->post( 'student_id' );
		$course_id = $this->input->post( 'course_id' );
		$model = $this->input->post( 'model' );
	  
		$data_param['id'] 	= $this->input->post('id');
		if( $this->$model->delete( $data_param ) ){
		  $this->session->set_flashdata('alert', $this->alert->set_alert( Alert::SUCCESS, $this->$model->messages() ) );
		}else{
		  $this->session->set_flashdata('alert', $this->alert->set_alert( Alert::DANGER, $this->$model->errors() ) );
		}
		redirect( site_url($this->current_page) .'assessment_course?id=' . $student_id . '&course_id=' . $course_id );
	}
}
