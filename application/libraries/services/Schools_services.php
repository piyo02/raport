<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Schools_services
{
  private $school_admin_email = '';
  private $first_name	= '';
	private $last_name	= '';
	private $email    	= '';
	private $phone    	= '';
	private $school_head_name		= '';
	private $nip		    = '';
	private $id			    = '';
	private $school_id			    = '';
	private $address		= '';

  function __construct(){

  }

  public function __get($var)
  {
    return get_instance()->$var;
  }
  
  public function get_table_config( $_page, $start_number = 1 )
  {
      $table["header"] = array(
        'name' => 'Nama Sekolah',
        'address' => 'Alamat Sekolah',
        'school_head_name' => 'Kepala Sekolah',
        'nip' => 'NIP Kepala Sekolah',
      );
      $table["number"] = $start_number;
      $table[ "action" ] = array(
        array(
          "name" => 'Detail Admin',
          "type" => "modal_form_no_action",
          "modal_id" => "detail_",
          "url" => site_url( $_page."edit/"),
          "button_color" => "primary",
          "param" => "id",
          "form_data" => array(
              "id" => array(
                  'type' => 'hidden',
                  'label' => "id",
              ),
              "name" => array(
                  'type' => 'text',
                  'label' => "Nama Group",
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
              "name" => array(
                  'type' => 'text',
                  'label' => "Nama Group",
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
  public function get_form_data( $school_id = -1)
  {
    if( $school_id != -1 )
		{
      $school 				  = $this->schools_model->school( $school_id )->row();
      $this->first_name	= $school->first_name;
			$this->last_name	= $school->last_name;
			$this->email    	= $school->email;
			$this->school_head_name		= $school->school_head_name;
			$this->nip		    = $school->nip;
			$this->school_id			    = $school->school_id;
			$this->address		= $school->address;
		}
		// echo var_dump($user);

    $_data["form_data"] = array(
      "id" => array(
				'type' => 'hidden',
				'label' => "ID",
				'value' => $this->form_validation->set_value('id', $this->id),
      ),
      "school_id" => array(
				'type' => 'hidden',
				'label' => "SCHOOL ID",
				'value' => $this->form_validation->set_value('school_id', $this->school_id),
      ),
      "group_id" => array(
				'type' => 'hidden',
				'label' => "User group",
				'value' => 4,
      ),
			"first_name" => array(
			  'type' => 'text',
			  'label' => "Nama Depan Kepala Sekolah",
			  'value' => $this->form_validation->set_value('first_name', $this->first_name),
			),
			"last_name" => array(
        'type' => 'text',
			  'label' => "Nama Belakang Kepala Sekolah",
			  'value' => $this->form_validation->set_value('last_name', $this->last_name),
			  
			),
      "address" => array(
        'type' => 'text',
        'label' => "Alamat",
        'value' => $this->form_validation->set_value('address', $this->address),			  
      ),
      "email" => array(
        'type' => 'text',
        'label' => "Email",
        'value' => $this->form_validation->set_value('email', $this->email),			  
      ),
      "phone" => array(
			  'type' => 'number',
			  'label' => "Nomor Telepon",
			  'value' => $this->form_validation->set_value('phone', $this->phone),			  
			),
      "nip" => array(
        'type' => 'text',
        'label' => "NIP",
        'value' => $this->form_validation->set_value('email', $this->email),			  
      ),
      "name" => array(
			  'type' => 'text',
			  'label' => "Nama Sekolah",
			  'value' => $this->form_validation->set_value('first_name', $this->first_name),
      ),
      "school_admin_email" => array(
			  'type' => 'text',
			  'label' => "Email admin Sekolah",
			  'value' => $this->form_validation->set_value('school_admin_email', $this->school_admin_email),
			),
      "school_address" => array(
        'type' => 'text',
        'label' => "Alamat Sekolah",
        'value' => $this->form_validation->set_value('address', $this->address),			  
      ),
    );
		return $_data;
  }
}
?>
