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
  public function get_table_attitude_config( $_page, $start_number = 1 )
  {
    $table["header"] = array(
      'name' => 'Sikap',
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
          'model' => array(
            'type' => 'hidden',
            'label' => "Model",
            'value' => 'attitude_model'
          ),
          "name" => array(
            'type' => 'text',
            'label' => "Sikap",
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
          'model' => array(
            'type' => 'hidden',
            'label' => "Model",
            'value' => 'attitude_model'
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
