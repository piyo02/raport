<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Extracurricular_services
{


  function __construct(){

  }

  public function __get($var)
  {
    return get_instance()->$var;
  }
  
  public function get_table_config( $_page, $start_number = 1 )
  {
      $table["header"] = array(
        'name' => 'Nama Ekstrakulikuler',
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
                    "group_id" => array(
                        'type' => 'hidden',
                        'label' => "group_id",
                    ),
                    "name" => array(
                      'type' => 'text',
                      'label' => "Nama Ekstrakulikuler",
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
  public function get_table_group_config( $_page, $start_number = 1 )
  {
      $table["header"] = array(
        'name' => 'Nama Kelompok',
        'description' => 'Deskripsi',
      );
      $table["number"] = $start_number;
      $table[ "action" ] = array(
        array(
          "name" => 'Tambah Ekstrakulikuler',
          "type" => "link",
          "url" => site_url( $_page."extracurricular/"),
          "button_color" => "success",
          "param" => "id",
          "title" => "Group",
          "data_name" => "name",
        ),
              array(
                "name" => 'Edit',
                "type" => "modal_form",
                "modal_id" => "edit_",
                "url" => site_url( $_page."edit_group/"),
                "button_color" => "primary",
                "param" => "id",
                "form_data" => array(
                    "id" => array(
                        'type' => 'hidden',
                        'label' => "id",
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
                "url" => site_url( $_page."delete_group/"),
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
  public function get_table_extracurricular_config( $_page, $start_number = 1 )
  {
    $table["header"] = array(
      'extracurricular_name' => 'Ekstrakurikuler',
      'name' => 'Predikat',
      'description' => 'Keterangan',
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
          'student_id' => array(
            'type' => 'hidden',
            'label' => "Mata Pelajaran",
          ),
          'model' => array(
            'type' => 'hidden',
            'label' => "Model",
            'value' => 'rating_extracurricular_model'
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
            'value' => 'rating_extracurricular_model'
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
  public function validation_student_config( ){
    $config = array(
        array(
          'field' => 'name',
          'label' => 'name',
          'rules' =>  'trim|required',
        ),
    );
    
    return $config;
  }
}
?>
