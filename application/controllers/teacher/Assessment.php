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
		$this->load->library('services/Extracurricular_services');
		$this->extracurricular = new Extracurricular_services;
		$this->load->model(array(
			'group_model',
			'courses_model',
			'category_model',
			'students_model',
			'classroom_model',
			'rating_test_model',
			'rating_mid_model',
			'rating_final_model',
			'assignment_model',
			'student_attitude_model',
			'absence_model',
			'attitude_model',
			'predicate_attitude_model',
			'rating_extracurricular_model',
			'extracurricular_model',
			'achievement_model'
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
				"url" => site_url( $this->current_page."guardianship"),
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
	public function guardianship()
	{
		$classroom_id = $this->input->get('classroom_id');
		
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
		$table = $this->services->get_table_guardianship_config( $this->current_page, ($pagination['start_record'] + 1), $this->school_id);
		$table[ "rows" ] = $this->students_model->students_by_classroom_id( $pagination['start_record'], $pagination['limit_per_page'], $classroom_id )->result();
		$table = $this->load->view('templates/tables/plain_table', $table, true);
		$this->data[ "contents" ] = $table;
		$add_menu = array(
			"name" => "Tambah Siswa",
			"modal_id" => "add_group_",
			"button_color" => "primary",
			"url" => site_url( $this->current_page."add_student/"),
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

		#################################################################3
		$alert = $this->session->flashdata('alert');
		$this->data["key"] = $this->input->get('key', FALSE);
		$this->data["alert"] = (isset($alert)) ? $alert : NULL ;
		$this->data["current_page"] = $this->current_page;
		$this->data["block_header"] = "Perwalian";
		$this->data["header"] = "Daftar Perwalian";
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
		if(!$id)
			redirect(site_url($this->current_page));
		$course_id = $this->input->get('course_id');
		if(!$course_id)
			redirect(site_url($this->current_page . 'assessment_course?id='. $id .'&course_id=1'));
		
		//Rating Test
		$table_assignment = $this->services->get_table_assignment_config( $this->current_page);
		$table_assignment[ "rows" ] = $this->assignment_model->assignment_by_student_id( $id, $course_id )->result();
		
		//guru
		$this->data['teacher'] = "";
		$user_id = 0;
		if(isset($table_assignment[ "rows" ][0]->user_id)){
			$user_id = $table_assignment[ "rows" ][0]->user_id;
			$teacher = $this->ion_auth_model->user($user_id)->row();
			$this->data['teacher'] = "Guru : " . $teacher->user_fullname;
		}
		if( $user_id != $this->ion_auth->get_user_id())
			unset($table_assignment['action']);

		$table_assignment = $this->load->view('templates/tables/plain_table', $table_assignment, true);
		$this->data[ "contents_assignment" ] = $table_assignment;

		$add_rating_assignment = array(
			"name" => "Tambah Tugas",
			"modal_id" => "add_assignment_",
			"button_color" => "primary",
			"url" => site_url( $this->current_page."add/"),
			"form_data" => array(
				'model' => array(
					'type' => 'hidden',
					'label' => "Siswa",
					'value' => 'assignment_model',
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
					'label' => "Tugas",
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

		$add_rating_assignment= $this->load->view('templates/actions/modal_form', $add_rating_assignment, true ); 
		if( $user_id == 0 || $user_id == $this->ion_auth->get_user_id())
			$this->data[ "header_button_assignment" ] =  $add_rating_assignment;
		
		//Rating Test
		$table_test = $this->services->get_table_test_config( $this->current_page);
		$table_test[ "rows" ] = $this->rating_test_model->rating_test_by_student_id( $id, $course_id )->result();
		if( $user_id != $this->ion_auth->get_user_id())
			unset($table_test['action']);
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

		if( $user_id == 0 || $user_id == $this->ion_auth->get_user_id())
			$this->data[ "header_button_test" ] =  $add_rating_test;

		// Rating Mid
		$table_mid = $this->services->get_table_mid_config( $this->current_page);
		$table_mid[ "rows" ] = $this->rating_mid_model->rating_mid_by_student_id( $id, $course_id )->result();
		if( $user_id != $this->ion_auth->get_user_id())
			unset($table_mid['action']);
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

		if( $user_id == 0 || $user_id == $this->ion_auth->get_user_id())
			$this->data[ "header_button_mid" ] =  $add_rating_mid;

		// Rating Final
		$table_final = $this->services->get_table_final_config( $this->current_page);
		$table_final[ "rows" ] = $this->rating_final_model->rating_final_by_student_id( $id, $course_id )->result();
		if( $user_id != $this->ion_auth->get_user_id())
			unset($table_final['action']);
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

		if( $user_id == 0 || $user_id == $this->ion_auth->get_user_id())
			$this->data[ "header_button_final" ] =  $add_rating_final;

		// attitude
		$list_attitude[''] = '-- Pilih Sikap --';
		$attitudes = $this->attitude_model->attitude_by_school_id( $this->school_id )->result();
			foreach ($attitudes as $key => $attitude) {
			$list_attitude[$attitude->id] = $attitude->name;
		}

		$list_predicate[''] = "-- Pilih Predikat --";
		$predicates = $this->predicate_attitude_model->predicate_attitude_by_school_id( $this->school_id )->result();
			foreach ($predicates as $key => $predicate) {
			$list_predicate[$predicate->id] = $predicate->name;
		}
		$table_attitude = $this->services->get_table_attitude_config( $this->current_page, 1, $this->school_id);
		$table_attitude[ "rows" ] = $this->student_attitude_model->student_attitudes( $id, $course_id )->result();
		if( $user_id != $this->ion_auth->get_user_id())
		{
			unset($table_attitude['action']);
		}
		$table_attitude = $this->load->view('templates/tables/plain_table', $table_attitude, true);
		$this->data[ "contents_attitude" ] = $table_attitude;

		$add_student_attitude = array(
			"name" => "Nilai Sikap",
			"modal_id" => "add_attitude_",
			"button_color" => "primary",
			"url" => site_url( $this->current_page."add/"),
			"form_data" => array(
				'model' => array(
					'type' => 'hidden',
					'label' => "Siswa",
					'value' => 'student_attitude_model',
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
				"attitude_id" => array(
					'type' => 'select',
					'label' => "Sikap",
					'options' => $list_attitude,
				),
				"predicate_id" => array(
					'type' => 'select',
					'label' => "Predikat",
					'options' => $list_predicate,
				),
			),
			'data' => NULL
		);

		$add_student_attitude= $this->load->view('templates/actions/modal_form', $add_student_attitude, true ); 

		if( $user_id == 0 || $user_id == $this->ion_auth->get_user_id())
			$this->data[ "header_button_student_attitude" ] =  $add_student_attitude;

		// absence
		$table_absence = $this->services->get_table_absence_config( $this->current_page);
		$table_absence[ "rows" ] = $this->absence_model->absences_by_student_id( $id )->result();
		$table_absence = $this->load->view('templates/tables/plain_table', $table_absence, true);
		$this->data[ "contents_absence" ] = $table_absence;

		$add_absence = array(
			"name" => "Input Ketidakhadiran",
			"modal_id" => "add_absence_",
			"button_color" => "primary",
			"url" => site_url( $this->current_page."add/"),
			"form_data" => array(
				'model' => array(
					'type' => 'hidden',
					'label' => "Siswa",
					'value' => 'absence_model',
				),
				"student_id" => array(
					'type' => 'hidden',
					'label' => "Siswa",
					'value' => $id,
				),
				"sick" => array(
					'type' => 'number',
					'label' => "Sakit",
					'value' => "",
				),
				"permission" => array(
					'type' => 'number',
					'label' => "Izin",
					'value' => "",
				),
				"without_explanation" => array(
					'type' => 'number',
					'label' => "Tanpa Keterangan",
					'value' => "",
				),
			),
			'data' => NULL
		);

		$add_absence= $this->load->view('templates/actions/modal_form', $add_absence, true ); 

		$this->data[ "header_button_absence" ] =  $add_absence;

		// Extracurricular
		$list_extracurricular[''] = '-- Pilih Ekstrakurikular --';
		$extracurriculars = $this->extracurricular_model->extracurriculars_by_school_id( 0, NULL, $this->school_id )->result();
			foreach ($extracurriculars as $key => $extracurricular) {
			$list_extracurricular[$extracurricular->id] = $extracurricular->name;
		}

		$table_extracurricular = $this->extracurricular->get_table_extracurricular_config( $this->current_page);
		$table_extracurricular[ "rows" ] = $this->rating_extracurricular_model->rating_extracurricular_by_student_id( $id )->result();
		$table_extracurricular = $this->load->view('templates/tables/plain_table', $table_extracurricular, true);
		$this->data[ "contents_extracurricular" ] = $table_extracurricular;
		$add_extracurricular = array(
			"name" => "Nilai Ekstrakurikular",
			"modal_id" => "add_extracurricular_",
			"button_color" => "primary",
			"url" => site_url( $this->current_page."add/"),
			"form_data" => array(
				'model' => array(
					'type' => 'hidden',
					'label' => "Siswa",
					'value' => 'rating_extracurricular_model',
				),
				"student_id" => array(
					'type' => 'hidden',
					'label' => "Siswa",
					'value' => $id,
				),
				"extracurricular_id" => array(
					'type' => 'select',
					'label' => "Ekstrakurikuler",
					'options' => $list_extracurricular,
				),
				"name" => array(
					'type' => 'text',
					'label' => "Predikat",
					'value' => "",
				),
				"description" => array(
					'type' => 'textarea',
					'label' => "Keterangan",
					'value' => "",
				),
			),
			'data' => NULL
		);

		$add_extracurricular= $this->load->view('templates/actions/modal_form', $add_extracurricular, true ); 

		$this->data[ "header_button_extracurricular" ] =  $add_extracurricular;

		// absence
		$table_achievement = $this->services->get_table_achievement_config( $this->current_page);
		$table_achievement[ "rows" ] = $this->achievement_model->achievement_by_student_id( $id )->result();
		$table_achievement = $this->load->view('templates/tables/plain_table', $table_achievement, true);
		$this->data[ "contents_achievement" ] = $table_achievement;

		$add_achievement = array(
			"name" => "Tambah Prestasi",
			"modal_id" => "add_achievement_",
			"button_color" => "primary",
			"url" => site_url( $this->current_page."add/"),
			"form_data" => array(
				'model' => array(
					'type' => 'hidden',
					'label' => "Siswa",
					'value' => 'achievement_model',
				),
				"student_id" => array(
					'type' => 'hidden',
					'label' => "Siswa",
					'value' => $id,
				),
				"name" => array(
					'type' => 'text',
					'label' => "Prestasi",
					'value' => "",
				),
				"description" => array(
					'type' => 'textarea',
					'label' => "Keterangan",
					'value' => "",
				),
			),
			'data' => NULL
		);

		$add_achievement= $this->load->view('templates/actions/modal_form', $add_achievement, true ); 

		$this->data[ "header_button_achievement" ] =  $add_achievement;
		#################################################################3
		$list_courses[''] = '-- Pilih Mata Pelajaran --';
		$courses = $this->courses_model->courses_by_school_id( $this->school_id )->result();
		foreach ($courses as $key => $course) {
		  $list_courses[$course->id] = $course->name;
		}
		$this->data['attr'] = array(
			'form_name' => 'course_id',
			'type' => 'select',
			'options' => $list_courses,
		);
		if($this->classroom_model->guardianship($this->ion_auth->get_user_id(), $id)->row() != NULL)
			$this->data['guardianship'] = 1;
		$alert = $this->session->flashdata('alert');
		$this->data["key"] = $this->input->get('key', FALSE);
		$this->data["alert"] = (isset($alert)) ? $alert : NULL ;
		$this->data["current_page"] = $this->current_page;
		$this->data["block_header"] = "Input Nilai";
		$this->data["header"] = "Input Nilai";
		$this->data["sub_header"] = 'Klik Tombol Action Untuk Aksi Lebih Lanjut';
		$this->render( "teacher/assessment" );
	}

	public function add_student(  )
	{
		if( !($_POST) ) redirect(site_url(  $this->current_page ));  

		// echo var_dump( $data );return;
		$this->form_validation->set_rules( 'name', 'Nama Siswa', 'required|trim' );
		$this->form_validation->set_rules( 'nis', 'NIS Siswa', 'required|trim' );
		$this->form_validation->set_rules( 'nisn', 'NISN Siswa', 'required|trim' );
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
		
		redirect( site_url($this->current_page) .'guardianship?classroom_id=' . $data['classroom_id'] );
	}

	public function add(  )
	{
		if( !($_POST) ) redirect(site_url(  $this->current_page ));  

		// echo var_dump( $_POST );return;
		$model = $this->input->post( 'model' );
		switch ($model) {
			case 'absence_model':
					$this->form_validation->set_rules( 'sick', 'Sakit', 'required' );
					$this->form_validation->set_rules( 'permission', 'Izin', 'required' );
					$this->form_validation->set_rules( 'without_explanation', 'Tanpa Keterangan', 'required' );
				break;

			case 'student_attitude_model':
				$this->form_validation->set_rules( 'attitude_id', 'Sikap', 'required' );
				$this->form_validation->set_rules( 'predicate_id', 'Predikat', 'required' );
				break;
			case 'rating_extracurricular_model':
			case 'achievement_model':
				$this->form_validation->set_rules( $this->services->validation_config() );
				break;
			default:
				$this->form_validation->set_rules( $this->services->validation_assessment_config() );
				break;
		}
        if ($this->form_validation->run() === TRUE )
        {
			switch ($model) {
				case 'absence_model':
					$data['user_id'] = $this->ion_auth->get_user_id();
					$data['student_id'] = $this->input->post( 'student_id' );
					$data['sick'] = $this->input->post( 'sick' );
					$data['permission'] = $this->input->post( 'permission' );
					$data['without_explanation'] = $this->input->post( 'without_explanation' );
					break;

				case 'student_attitude_model':
					$data['user_id'] = $this->ion_auth->get_user_id();
					$data['student_id'] = $this->input->post( 'student_id' );
					$data['course_id'] = $this->input->post( 'course_id' );
					$data['attitude_id'] = $this->input->post( 'attitude_id' );
					$data['predicate_id'] = $this->input->post( 'predicate_id' );
					break;

				case 'rating_extracurricular_model':
					$data['student_id'] = $this->input->post( 'student_id' );
					$data['extracurricular_id'] = $this->input->post( 'extracurricular_id' );
					$data['name'] = $this->input->post( 'name' );
					$data['description'] = $this->input->post( 'description' );
					break;
					
				case 'achievement_model':
					$data['student_id'] = $this->input->post( 'student_id' );
					$data['name'] = $this->input->post( 'name' );
					$data['description'] = $this->input->post( 'description' );
					break;

				default:
					$data['user_id'] = $this->ion_auth->get_user_id();
					$data['student_id'] = $this->input->post( 'student_id' );
					$data['course_id'] = $this->input->post( 'course_id' );
					$data['name'] = $this->input->post( 'name' );
					$data['value'] = $this->input->post( 'value' );
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
		
		redirect( site_url($this->current_page) .'assessment_course?id=' . $data['student_id'] . '&course_id=' . $data['course_id'] );
	}

	public function edit(  )
	{
		if( !($_POST) ) redirect(site_url(  $this->current_page ));  

		// echo var_dump( $_POST );return;
		$model = $this->input->post( 'model' );
		switch ($model) {
			case 'absence_model':
				$this->form_validation->set_rules( 'sick', 'Sakit', 'required' );
				$this->form_validation->set_rules( 'permission', 'Izin', 'required' );
				$this->form_validation->set_rules( 'without_explanation', 'Tanpa Keterangan', 'required' );
				break;
			
			case 'student_attitude_model':
				$this->form_validation->set_rules( 'attitude_id', 'Sikap', 'required' );
				$this->form_validation->set_rules( 'predicate_id', 'Predikat', 'required' );
			break;
			
			case 'rating_extracurricular_model':
			case 'achievement_model':
				$this->form_validation->set_rules( $this->services->validation_config() );
				break;
			default:
				$this->form_validation->set_rules( $this->services->validation_assessment_config() );
				break;
		}
        if ($this->form_validation->run() === TRUE )
        {
			$student_id = $this->input->post( 'student_id' );
			$course_id = $this->input->post( 'course_id' );

			switch ($model) {
				case 'absence_model':
					$data['sick'] = $this->input->post( 'sick' );
					$data['permission'] = $this->input->post( 'permission' );
					$data['without_explanation'] = $this->input->post( 'without_explanation' );
					break;

				case 'student_attitude_model':
					$data['attitude_id'] = $this->input->post( 'attitude_id' );
					$data['predicate_id'] = $this->input->post( 'predicate_id' );
					break;

				case 'rating_extracurricular_model':
				case 'achievement_model':
					$data['name'] = $this->input->post( 'name' );
					$data['description'] = $this->input->post( 'description' );
					break;

				default:
					$data['name'] = $this->input->post( 'name' );
					$data['value'] = $this->input->post( 'value' );
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

	public function export_raport($student_id)
	{
		//profil sekolah, guru, murid
		$this->data['school'] = '';
		$this->data['teacher'] = '';
		$this->data['student'] = '';

		//nilai pengetahuan
		$this->data['assignment'] = '';
		$this->data['final'] = '';
		$this->data['mid'] = '';
		$this->data['test'] = '';

		// nilai sikap, prestasi, ekskul, ketidakhadiran
		$this->data['attitude'] = '';
		$this->data['achievement'] = '';
		$this->data['extracurricular'] = '';
		$this->data['absence'] = $this->absence_model->absences_by_student_id($student_id)->row();
		
		$this->load->view('teacher/export/raport', $this->data);
		// redirect(site_url('teacher/assessment'));

		// $this->load->library('pdf');
		// $this->pdf->load_view('teacher/export/raport', $this->data);
		// $this->pdf->render();
		// $this->pdf->stream('welcome.pdf');
	}
}
