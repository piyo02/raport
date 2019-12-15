<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Assessment_services
{


  function __construct(){

  }

  public function __get($var)
  {
    return get_instance()->$var;
  }
  
  public function get_table_config( $_page, $start_number = 1, $school_id = NULL )
  {
    $list_course[''] = '-- Pilih Mata Pelajaran --';
    $this->load->model('courses_model');
    $courses = $this->courses_model->courses_category_id(0, null, null, $school_id)->result();
    foreach ($courses as $key => $course) {
      $list_course[$course->id] = $course->name;
    }

    $table["header"] = array(
      'name' => 'Siswa',
      'nisn' => 'NISN',
    );
    $table["number"] = $start_number;
    $table[ "action" ] = array(
      array(
        "name" => 'Input Nilai',
        "type" => "modal_form_get",
        "modal_id" => "add_assessment_",
        "url" => site_url( $_page."assessment_course"),
        "button_color" => "primary",
        "param" => "id",
        "form_data" => array(
          'id' => array(
            'type' => 'hidden',
            'label' => "Mata Pelajaran",
          ),
          "course_id" => array(
              'type' => 'select',
              'label' => "Mata Pelajaran",
              'options' => $list_course
          ),
        ),
        "title" => "Mata Pelajaran",
        "data_name" => "name",
      ),
    );
    return $table;
  }
  public function get_table_guardianship_config( $_page, $start_number = 1, $school_id = NULL )
  {
    $this->load->model('courses_model');
    $list_courses[''] = '-- Pilih Mata Pelajaran --';
    $courses = $this->courses_model->courses_by_school_id( $school_id )->result();
    foreach ($courses as $key => $course) {
      $list_courses[$course->id] = $course->name;
    }
    $table["header"] = array(
      'name' => 'Siswa',
      'nisn' => 'NISN',
    );
    $table["number"] = $start_number;
    $table[ "action" ] = array(
      array(
        "name" => 'Lihat Nilai',
        "type" => "modal_form_get",
        "modal_id" => "add_assessment_",
        "url" => site_url( $_page."assessment_course"),
        "button_color" => "primary",
        "param" => "id",
        "form_data" => array(
          'id' => array(
            'type' => 'hidden',
            'label' => "Mata Pelajaran",
          ),
          'course_id' => array(
            'type' => 'select',
            'label' => "Mata Pelajaran",
            'options' => $list_courses
          ),
        ),
        "title" => "Mata Pelajaran",
        "data_name" => "name",
      ),
      array(
        "name" => 'Cetak Raport',
        "type" => "link",
        "modal_id" => "print_",
        "url" => site_url( $_page."export_raport/"),
        "button_color" => "success",
        "param" => "id",
        "title" => "Mata Pelajaran",
        "data_name" => "name",
      ),
    );
    return $table;
  }
  public function get_table_assignment_config( $_page, $start_number = 1 )
  {
    $table["header"] = array(
      'name' => 'Tugas',
      'value' => 'Nilai',
    );
    $table["number"] = $start_number;
    $table[ "action" ] = array(
      array(
        "name" => 'Edit',
        "type" => "modal_form",
        "modal_id" => "edit_assignment_",
        "url" => site_url( $_page."edit"),
        "button_color" => "primary",
        "param" => "id",
        "form_data" => array(
          'id' => array(
            'type' => 'hidden',
            'label' => "Mata Pelajaran",
          ),
          'student_id' => array(
            'type' => 'hidden',
            'label' => "Mata Pelajaran",
          ),
          'course_id' => array(
            'type' => 'hidden',
            'label' => "Mata Pelajaran",
          ),
          'model' => array(
            'type' => 'hidden',
            'label' => "Model",
            'value' => 'assignment_model'
          ),
          "name" => array(
            'type' => 'text',
            'label' => "Tugas",
          ),
          "value" => array(
            'type' => 'number',
            'label' => "Nilai",
          ),
        ),
        "title" => "Ulangan Harian",
        "data_name" => "name",
      ),
      array(
        "name" => 'X',
        "type" => "modal_delete",
        "modal_id" => "delete_assignment_",
        "url" => site_url( $_page."delete"),
        "button_color" => "danger",
        "param" => "id",
        "form_data" => array(
          'id' => array(
            'type' => 'hidden',
            'label' => "Mata Pelajaran",
          ),
          'student_id' => array(
            'type' => 'hidden',
            'label' => "Mata Pelajaran",
          ),
          'course_id' => array(
            'type' => 'hidden',
            'label' => "Mata Pelajaran",
          ),
          'model' => array(
            'type' => 'hidden',
            'label' => "Model",
            'value' => 'assignment_model'
          ),
        ),
        "title" => "Ulangan Harian",
        "data_name" => "name",
      ),
    );
    return $table;
  }
  public function get_table_test_config( $_page, $start_number = 1 )
  {
    $table["header"] = array(
      'name' => 'Ulangan Harian',
      'value' => 'Nilai',
    );
    $table["number"] = $start_number;
    $table[ "action" ] = array(
      array(
        "name" => 'Edit',
        "type" => "modal_form",
        "modal_id" => "edit_test_",
        "url" => site_url( $_page."edit"),
        "button_color" => "primary",
        "param" => "id",
        "form_data" => array(
          'id' => array(
            'type' => 'hidden',
            'label' => "Mata Pelajaran",
          ),
          'student_id' => array(
            'type' => 'hidden',
            'label' => "Mata Pelajaran",
          ),
          'course_id' => array(
            'type' => 'hidden',
            'label' => "Mata Pelajaran",
          ),
          'model' => array(
            'type' => 'hidden',
            'label' => "Model",
            'value' => 'rating_test_model'
          ),
          "name" => array(
            'type' => 'text',
            'label' => "Ulangan Harian",
          ),
          "value" => array(
            'type' => 'number',
            'label' => "Nilai",
          ),
        ),
        "title" => "Ulangan Harian",
        "data_name" => "name",
      ),
      array(
        "name" => 'X',
        "type" => "modal_delete",
        "modal_id" => "delete_test_",
        "url" => site_url( $_page."delete"),
        "button_color" => "danger",
        "param" => "id",
        "form_data" => array(
          'id' => array(
            'type' => 'hidden',
            'label' => "Mata Pelajaran",
          ),
          'student_id' => array(
            'type' => 'hidden',
            'label' => "Mata Pelajaran",
          ),
          'course_id' => array(
            'type' => 'hidden',
            'label' => "Mata Pelajaran",
          ),
          'model' => array(
            'type' => 'hidden',
            'label' => "Model",
            'value' => 'rating_test_model'
          ),
        ),
        "title" => "Ulangan Harian",
        "data_name" => "name",
      ),
    );
    return $table;
  }
  public function get_table_mid_config( $_page, $start_number = 1 )
  {
    $table["header"] = array(
      'name' => 'UTS',
      'value' => 'Nilai',
    );
    $table["number"] = $start_number;
    $table[ "action" ] = array(
      array(
        "name" => 'Edit',
        "type" => "modal_form",
        "modal_id" => "edit_mid_",
        "url" => site_url( $_page."edit"),
        "button_color" => "primary",
        "param" => "id",
        "form_data" => array(
          'id' => array(
            'type' => 'hidden',
            'label' => "Mata Pelajaran",
          ),
          'student_id' => array(
            'type' => 'hidden',
            'label' => "Mata Pelajaran",
          ),
          'course_id' => array(
            'type' => 'hidden',
            'label' => "Mata Pelajaran",
          ),
          'model' => array(
            'type' => 'hidden',
            'label' => "Model",
            'value' => 'rating_mid_model'
          ),
          "name" => array(
            'type' => 'text',
            'label' => "Ulangan Harian",
          ),
          "value" => array(
            'type' => 'number',
            'label' => "Nilai",
          ),
        ),
        "title" => "Ulangan Harian",
        "data_name" => "name",
      ),
      array(
        "name" => 'X',
        "type" => "modal_delete",
        "modal_id" => "delete_mid_",
        "url" => site_url( $_page."delete"),
        "button_color" => "danger",
        "param" => "id",
        "form_data" => array(
          'id' => array(
            'type' => 'hidden',
            'label' => "Mata Pelajaran",
          ),
          'student_id' => array(
            'type' => 'hidden',
            'label' => "Mata Pelajaran",
          ),
          'course_id' => array(
            'type' => 'hidden',
            'label' => "Mata Pelajaran",
          ),
          'model' => array(
            'type' => 'hidden',
            'label' => "Model",
            'value' => 'rating_mid_model'
          ),
        ),
        "title" => "Ulangan Harian",
        "data_name" => "name",
      ),
    );
    return $table;
  }
  public function get_table_final_config( $_page, $start_number = 1 )
  {
    $table["header"] = array(
      'name' => 'UAS',
      'value' => 'Nilai',
    );
    $table["number"] = $start_number;
    $table[ "action" ] = array(
      array(
        "name" => 'Edit',
        "type" => "modal_form",
        "modal_id" => "edit_final_",
        "url" => site_url( $_page."edit"),
        "button_color" => "primary",
        "param" => "id",
        "form_data" => array(
          'id' => array(
            'type' => 'hidden',
            'label' => "Mata Pelajaran",
          ),
          'student_id' => array(
            'type' => 'hidden',
            'label' => "Mata Pelajaran",
          ),
          'course_id' => array(
            'type' => 'hidden',
            'label' => "Mata Pelajaran",
          ),
          'model' => array(
            'type' => 'hidden',
            'label' => "Model",
            'value' => 'rating_final_model'
          ),
          "name" => array(
            'type' => 'text',
            'label' => "Ulangan Harian",
          ),
          "value" => array(
            'type' => 'number',
            'label' => "Nilai",
          ),
        ),
        "title" => "Ulangan Harian",
        "data_name" => "name",
      ),
      array(
        "name" => 'X',
        "type" => "modal_delete",
        "modal_id" => "delete_final_",
        "url" => site_url( $_page."delete"),
        "button_color" => "danger",
        "param" => "id",
        "form_data" => array(
          'id' => array(
            'type' => 'hidden',
            'label' => "Mata Pelajaran",
          ),
          'student_id' => array(
            'type' => 'hidden',
            'label' => "Mata Pelajaran",
          ),
          'course_id' => array(
            'type' => 'hidden',
            'label' => "Mata Pelajaran",
          ),
          'model' => array(
            'type' => 'hidden',
            'label' => "Model",
            'value' => 'rating_final_model'
          ),
        ),
        "title" => "Ulangan Harian",
        "data_name" => "name",
      ),
    );
    return $table;
  }
  public function get_table_classroom_config( $_page, $start_number = 1 )
  {
      $table["header"] = array(
        'name' => 'Nama Kelas',
        'description' => 'Deskripsi',
      );
      $table["number"] = $start_number;
      $table[ "action" ] = array(
        array(
          "name" => 'Input Nilai Siswa',
          "type" => "link",
          "url" => site_url( $_page."student/"),
          "button_color" => "success",
          "param" => "id",
          "title" => "Group",
          "data_name" => "name",
        ),
    );
    return $table;
  }
  public function get_table_attitude_config( $_page, $start_number = 1, $school_id = NULL )
  {
    $this->load->model('attitude_model');
    $this->load->model('predicate_attitude_model');

    $list_attitude[''] = '-- Pilih Sikap --';
		$attitudes = $this->attitude_model->attitude_by_school_id( $school_id )->result();
			foreach ($attitudes as $key => $attitude) {
			$list_attitude[$attitude->id] = $attitude->name;
		}

    $list_predicate[''] = "-- Pilih Predikat --";
    $predicates = $this->predicate_attitude_model->predicate_attitude_by_school_id( $school_id )->result();
    foreach ($predicates as $key => $predicate) {
      $list_predicate[$predicate->id] = $predicate->name;
    }
    $table["header"] = array(
      'name' => 'Sikap',
      'predicate_name' => 'Predikat',
    );
    $table["number"] = $start_number;
    $table[ "action" ] = array(
      array(
        "name" => 'Edit',
        "type" => "modal_form",
        "modal_id" => "edit_attitude_",
        "url" => site_url( $_page."edit"),
        "button_color" => "primary",
        "param" => "id",
        "form_data" => array(
          'id' => array(
            'type' => 'hidden',
            'label' => "Mata Pelajaran",
          ),
          'student_id' => array(
            'type' => 'hidden',
            'label' => "Mata Pelajaran",
          ),
          'course_id' => array(
            'type' => 'hidden',
            'label' => "Mata Pelajaran",
          ),
          'model' => array(
            'type' => 'hidden',
            'label' => "Model",
            'value' => 'student_attitude_model'
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
        "title" => "Ulangan Harian",
        "data_name" => "name",
      ),
      array(
        "name" => 'X',
        "type" => "modal_delete",
        "modal_id" => "delete_attitude_",
        "url" => site_url( $_page."delete"),
        "button_color" => "danger",
        "param" => "id",
        "form_data" => array(
          'id' => array(
            'type' => 'hidden',
            'label' => "Mata Pelajaran",
          ),
          'student_id' => array(
            'type' => 'hidden',
            'label' => "Mata Pelajaran",
          ),
          'course_id' => array(
            'type' => 'hidden',
            'label' => "Mata Pelajaran",
          ),
          'model' => array(
            'type' => 'hidden',
            'label' => "Model",
            'value' => 'student_attitude_model'
          ),
        ),
        "title" => "Ulangan Harian",
        "data_name" => "name",
      ),
    );
    return $table;
  }
  public function get_table_predicate_config( $_page, $start_number = 1, $model = 'predicate_attitude_model' )
  {
    $table["header"] = array(
      'name' => 'Predikat',
      'description' => 'Keterangan',
    );
    $table["number"] = $start_number;
    $table[ "action" ] = array(
      array(
        "name" => 'Edit',
        "type" => "modal_form",
        "modal_id" => "edit_".$model."_",
        "url" => site_url( $_page."edit"),
        "button_color" => "primary",
        "param" => "id",
        "form_data" => array(
          'id' => array(
            'type' => 'hidden',
            'label' => "Mata Pelajaran",
          ),
          'model' => array(
            'type' => 'hidden',
            'label' => "Model",
            'value' => $model
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
        "title" => "Ulangan Harian",
        "data_name" => "name",
      ),
      array(
        "name" => 'X',
        "type" => "modal_delete",
        "modal_id" => "delete_".$model."_",
        "url" => site_url( $_page."delete"),
        "button_color" => "danger",
        "param" => "id",
        "form_data" => array(
          'id' => array(
            'type' => 'hidden',
            'label' => "Mata Pelajaran",
          ),
          'model' => array(
            'type' => 'hidden',
            'label' => "Model",
            'value' => $model
          ),
        ),
        "title" => "Ulangan Harian",
        "data_name" => "name",
      ),
    );
    return $table;
  }
  public function get_table_formula_config( $_page, $start_number = 1 )
  {
    $table["header"] = array(
      'name' => 'Penilaian',
      'value' => 'Bobot',
    );
    $table["number"] = $start_number;
    $table[ "action" ] = array(
      array(
        "name" => 'Edit',
        "type" => "modal_form",
        "modal_id" => "edit_rating_formula_",
        "url" => site_url( $_page."edit"),
        "button_color" => "primary",
        "param" => "id",
        "form_data" => array(
          'id' => array(
            'type' => 'hidden',
            'label' => "Mata Pelajaran",
          ),
          'model' => array(
            'type' => 'hidden',
            'label' => "Model",
            'value' => 'rating_formula_model'
          ),
          "name" => array(
            'type' => 'select',
            'label' => "Penilaian",
            'options' => array(
              'assignment' => 'Tugas',
              'test' => 'Ulangan Harian',
              'mid' => 'UTS',
              'final' => 'UAS',
            )
          ),
          "value" => array(
            'type' => 'number',
            'label' => "Bobot",
          ),
        ),
        "title" => "Ulangan Harian",
        "data_name" => "name",
      ),
      array(
        "name" => 'X',
        "type" => "modal_delete",
        "modal_id" => "delete_rating_formula_",
        "url" => site_url( $_page."delete"),
        "button_color" => "danger",
        "param" => "id",
        "form_data" => array(
          'id' => array(
            'type' => 'hidden',
            'label' => "Mata Pelajaran",
          ),
          'model' => array(
            'type' => 'hidden',
            'label' => "Model",
            'value' => 'rating_formula_model'
          ),
        ),
        "title" => "Ulangan Harian",
        "data_name" => "name",
      ),
    );
    return $table;
  }
  public function get_table_absence_config( $_page, $start_number = 1 )
  {
    $table["header"] = array(
      'sick' => 'Sakit',
      'permission' => 'Izin',
      'without_explanation' => 'Tanpa Keterangan',
    );
    $table["number"] = $start_number;
    $table[ "action" ] = array(
      array(
        "name" => 'Edit',
        "type" => "modal_form",
        "modal_id" => "edit_absence_",
        "url" => site_url( $_page."edit"),
        "button_color" => "primary",
        "param" => "id",
        "form_data" => array(
          'id' => array(
            'type' => 'hidden',
            'label' => "Mata Pelajaran",
          ),
          'model' => array(
            'type' => 'hidden',
            'label' => "Model",
            'value' => 'absence_model'
          ),
          "sick" => array(
            'type' => 'number',
            'label' => "Sakit",
          ),
          "permission" => array(
            'type' => 'number',
            'label' => "Izin",
          ),
          "without_explanation" => array(
            'type' => 'number',
            'label' => "Tanpa Keterangan",
          ),
        ),
        "title" => "Ulangan Harian",
        "data_name" => "name",
      ),
      array(
        "name" => 'X',
        "type" => "modal_delete",
        "modal_id" => "delete_absence_",
        "url" => site_url( $_page."delete"),
        "button_color" => "danger",
        "param" => "id",
        "form_data" => array(
          'id' => array(
            'type' => 'hidden',
            'label' => "Mata Pelajaran",
          ),
          'student_id' => array(
            'type' => 'hidden',
            'label' => "Mata Pelajaran",
          ),
          'model' => array(
            'type' => 'hidden',
            'label' => "Model",
            'value' => 'absence_model'
          ),
        ),
        "title" => "Ulangan Harian",
        "data_name" => "name",
      ),
    );
    return $table;
  }
  public function get_table_achievement_config( $_page, $start_number = 1 )
  {
    $table["header"] = array(
      'name' => 'Prestasi',
      'description' => 'Keterangan',
    );
    $table["number"] = $start_number;
    $table[ "action" ] = array(
      array(
        "name" => 'Edit',
        "type" => "modal_form",
        "modal_id" => "edit_achievement_",
        "url" => site_url( $_page."edit"),
        "button_color" => "primary",
        "param" => "id",
        "form_data" => array(
          'id' => array(
            'type' => 'hidden',
            'label' => "Mata Pelajaran",
          ),
          'model' => array(
            'type' => 'hidden',
            'label' => "Model",
            'value' => 'achievement_model'
          ),
          'student_id' => array(
            'type' => 'hidden',
            'label' => "Mata Pelajaran",
          ),
          "name" => array(
            'type' => 'text',
            'label' => "Prestasi",
          ),
          "description" => array(
            'type' => 'textarea',
            'label' => "Keterangan",
          ),
        ),
        "title" => "Ulangan Harian",
        "data_name" => "name",
      ),
      array(
        "name" => 'X',
        "type" => "modal_delete",
        "modal_id" => "delete_achievement_",
        "url" => site_url( $_page."delete"),
        "button_color" => "danger",
        "param" => "id",
        "form_data" => array(
          'id' => array(
            'type' => 'hidden',
            'label' => "Mata Pelajaran",
          ),
          'student_id' => array(
            'type' => 'hidden',
            'label' => "Mata Pelajaran",
          ),
          'model' => array(
            'type' => 'hidden',
            'label' => "Model",
            'value' => 'achievement_model'
          ),
        ),
        "title" => "Ulangan Harian",
        "data_name" => "name",
      ),
    );
    return $table;
  }
  public function validation_config( ){
    $config = array(
        array(
          'field' => 'name',
          'label' => 'name',
          'rules' =>  'trim|required',
        ),
        array(
          'field' => 'description',
          'label' => 'description',
          'rules' =>  'trim|required',
        ),
    );
    
    return $config;
  }
  public function validation_assessment_config( ){
    $config = array(
        array(
          'field' => 'name',
          'label' => 'name',
          'rules' =>  'trim|required',
        ),
        array(
          'field' => 'value',
          'label' => 'value',
          'rules' =>  'trim|required',
        ),
    );
    
    return $config;
  }
}
?>
