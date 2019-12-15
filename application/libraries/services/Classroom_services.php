<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Classroom_services
{


  function __construct(){

  }

  public function __get($var)
  {
    return get_instance()->$var;
  }
  
  public function get_table_config( $_page, $start_number = 1, $classroom_id = NULL )
  {
      $table["header"] = array(
        'name' => 'Nama Siswa',
        'nis' => 'NIS Siswa',
        'nisn' => 'NISN Siswa',
      );
      $table["number"] = $start_number;
      $table[ "action" ] = array(
              array(
                "name" => 'Edit',
                "type" => "modal_form",
                "modal_id" => "edit_",
                "url" => site_url( $_page."edit/"),
                "button_color" => "primary",
                "param" => "id",
                "form_data" => array(
                    "id" => array(
                        'type' => 'hidden',
                        'label' => "id",
                    ),
                    "classroom_id" => array(
                      'type' => 'hidden',
                      'label' => "id",
                      'value' => $classroom_id,
                  ),
                    "name" => array(
                      'type' => 'text',
                      'label' => "Nama Siswa",
                    ),
                    "nis" => array(
                      'type' => 'text',
                      'label' => "NIS Siswa",
                    ),
                    "nisn" => array(
                      'type' => 'text',
                      'label' => "NISN Siswa",
                    ),
                ),
                "title" => "Mata Pelajaran",
                "data_name" => "name",
              ),
              array(
                "name" => 'X',
                "type" => "modal_delete",
                "modal_id" => "delete_",
                "url" => site_url( $_page."delete/"),
                "button_color" => "danger",
                "param" => "id",
                "form_data" => array(
                  "id" => array(
                    'type' => 'hidden',
                    'label' => "id",
                  ),
                ),
                "title" => "Group",
                "data_name" => "name",
              ),
    );
    return $table;
  }
  public function get_table_classroom_config( $_page, $start_number = 1 )
  {
    $teachers = $this->ion_auth->users( 5  )->result();
		$list_teacher[''] = '-- Pilih Wali Kelas --';
		foreach ($teachers as $key => $teacher) {
			$list_teacher[$teacher->id] = $teacher->user_fullname;
		}
      $table["header"] = array(
        'name' => 'Nama Kelas',
        'homeroom_teacher' => 'Wali Kelas',
        'description' => 'Deskripsi',
      );
      $table["number"] = $start_number;
      $table[ "action" ] = array(
        array(
          "name" => 'Tambah Siswa',
          "type" => "link",
          "url" => site_url( $_page."student/"),
          "button_color" => "success",
          "param" => "id",
          "title" => "Group",
          "data_name" => "name",
        ),
              array(
                "name" => 'Edit',
                "type" => "modal_form",
                "modal_id" => "edit_",
                "url" => site_url( $_page."edit_classroom/"),
                "button_color" => "primary",
                "param" => "id",
                "form_data" => array(
                    "id" => array(
                        'type' => 'hidden',
                        'label' => "id",
                    ),
                    "user_id" => array(
                      'type' => 'select',
                      'label' => "Wali Kelas",
                      'options' => $list_teacher
                    ),
                    "name" => array(
                        'type' => 'text',
                        'label' => "Nama Kelompok",
                    ),
                    "description" => array(
                        'type' => 'textarea',
                        'label' => "Deskripsi",
                    ),
                ),
                "title" => "Group",
                "data_name" => "name",
              ),
              array(
                "name" => 'X',
                "type" => "modal_delete",
                "modal_id" => "delete_",
                "url" => site_url( $_page."delete_category/"),
                "button_color" => "danger",
                "param" => "id",
                "form_data" => array(
                  "id" => array(
                    'type' => 'hidden',
                    'label' => "id",
                  ),
                ),
                "title" => "Group",
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
  public function validation_student_config( ){
    $config = array(
        array(
          'field' => 'name',
          'label' => 'name',
          'rules' =>  'trim|required',
        ),
        array(
          'field' => 'nis',
          'label' => 'nis',
          'rules' =>  'trim|required',
        ),
        array(
          'field' => 'nisn',
          'label' => 'nisn',
          'rules' =>  'trim|required',
        ),
    );
    
    return $config;
  }
}
?>
