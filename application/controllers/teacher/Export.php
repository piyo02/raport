<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH.'/third_party/spout/src/Spout/Autoloader/autoload.php';

use Box\Spout\Writer\WriterFactory;
use Box\Spout\Common\Type;
use Box\Spout\Writer\StyleBuilder;

class Export extends Teacher_Controller {
	private $school_id = "";
	private $classroom_id = "";
	private $services = null;
    private $name = null;
    private $parent_page = 'teacher/';
	private $current_page = 'teacher/export/';
	
	public function __construct(){
		parent::__construct();
		$this->load->library('services/Excel_services');
		$this->services = new Excel_services;
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
			'achievement_model',
			'schools_model',
			'teacher_profile_model',
			'rating_formula_model',
			'predicate_rating_model',
			'rating_skill_model',
		));
		$this->school_id = $this->ion_auth->get_school_id();	
		$this->classroom_id = $this->classroom_model->classroom_by_user_id( $this->session->userdata('user_id') )->row();
	}
	public function index( $student_id = NULL )
	{
		if(!$student_id)
			redirect($this->parent_page . 'assessment/');

		
		//profil sekolah, guru, murid
		$data['school'] = $this->schools_model->school( $this->school_id )->row();
		$data['teacher'] = $this->teacher_profile_model->Teacher_profile($this->ion_auth->get_user_id())->row();
		$data['student'] = $this->students_model->student( $student_id )->row();
		
		$class = explode(" ",$data['student']->classroom_name);
    
		if(date('m') > 6)
			$data['year'] = date('Y'). ' / ' . (date('Y')+1);
		else
			$data['year'] = (date('Y')-1) . ' / ' . date('Y');
		switch ($class[0]) {
			case 'XI':
				$data['semester'] = '3 (Tiga)';
				if(date('m') > 6)
				$data['semester'] = '4 (Empat)';
				break;
			case 'XII':
				$data['semester'] = '5 (Lima)';
				if(date('m') > 6)
				$data['semester'] = '6 (Enam)';
				break;
			default:
				$data['semester'] = '1 (Satu)';
				if(date('m') > 6)
				$data['semester'] = '2 (Dua)';
				break;
		}
		
		//rumus pengetahuan
		$data['formulas'] = $this->rating_formula_model->rating_formula_by_school_id( $this->school_id )->result();
		//predikat pengetahuan
		$data['predicate_knowledge'] = $this->predicate_rating_model->Predicate_rating_by_school_id( $this->school_id )->result();
		
		//mata pelajaran
		$data['category'] = $this->category_model->category_by_school_id( $this->school_id )->result();
		$data['courses'] = $this->courses_model->courses_by_school_id( $this->school_id )->result();
		$data['record_courses'] = $this->courses_model->record_category_courses_by_school_id( $this->school_id )->result();
		
		//nilai pengetahuan
		$assignment = $this->assignment_model->avg_assignment_student( $student_id )->result();
		$test = $this->rating_test_model->avg_test_student( $student_id )->result();
		$mid = $this->rating_mid_model->avg_mid_student( $student_id )->result();
		$final = $this->rating_final_model->avg_final_student( $student_id )->result();

		// var_dump($data['assignment']);
		// var_dump($data['test']);
		// var_dump($data['mid']);
		$data['knowledge'] = array();
		$value = 0;
		$bagi = 0;
		for ($i=0; $i < count($assignment); $i++) { 
			foreach($data['formulas'] as $key => $formula){
				$bagi += $formula->value; 
				$var = $formula->name;
				$value += $formula->value * $$var[$i]->result;
			}
			$value = $value/$bagi;
			$data['knowledge'][] = $value;
		}
		// var_dump($data['knowledge']);
		
		
		//nilai keterampilan
		$data['skill'] = $this->rating_skill_model->rating_skill_by_student_id( $student_id )->result();
		// var_dump($data['skill']);  die;
		
		
		// nilai sikap, prestasi, ekskul, ketidakhadiran
		$attitudes = $this->attitude_model->attitude_by_school_id( $this->school_id )->result();
		foreach ($attitudes as $key => $attitude) {
			$student_attitude[] = $this->student_attitude_model->result_student_attitude( $student_id, $attitude->id )->row();
		}
		$data['student_attitudes'] = $student_attitude;
		// var_dump($student_attitudes); die;

		//tambahan
		$data['achievement'] = $this->achievement_model->achievement_by_student_id( $student_id )->row();
		$data['extracurriculars'] = $this->rating_extracurricular_model->rating_extracurricular_by_student_id( $student_id )->result();
		$data['absence'] = $this->absence_model->absences_by_student_id($student_id)->row();
		
		$this->services->excel_config($data);
		// $this->load->view('teacher/export/knowledge', $this->data);
		// redirect(site_url('teacher/assessment'));
	}

}
