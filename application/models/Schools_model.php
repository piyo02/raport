<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Schools_model extends MY_Model
{
  protected $table = "schools";

  function __construct() {
      parent::__construct( $this->table );
      parent::set_join_key( 'schools_id' );
  }

  /**
   * create
   *
   * @param array  $data
   * @return static
   * @author madukubah
   */
  public function create( $data )
  {
      // Filter the data passed
      $data = $this->_filter_data($this->table, $data);

      $this->db->insert($this->table, $data);
      $id = $this->db->insert_id($this->table . '_id_seq');
    
      if( isset($id) )
      {
        $this->set_message("berhasil");
        return $id;
      }
      $this->set_error("gagal");
          return FALSE;
  }
  /**
   * update
   *
   * @param array  $data
   * @param array  $data_param
   * @return bool
   * @author madukubah
   */
  public function update( $data, $data_param  )
  {
    $this->db->trans_begin();
    $data = $this->_filter_data($this->table, $data);

    $this->db->update($this->table, $data, $data_param );
    if ($this->db->trans_status() === FALSE)
    {
      $this->db->trans_rollback();

      $this->set_error("gagal");
      return FALSE;
    }

    $this->db->trans_commit();

    $this->set_message("berhasil");
    return TRUE;
  }
  /**
   * delete
   *
   * @param array  $data_param
   * @return bool
   * @author madukubah
   */
  public function delete( $data_param  )
  {
    //foreign
    //delete_foreign( $data_param. $models[]  )
    if( !$this->delete_foreign( $data_param, ['menu_model'] ) )
    {
      $this->set_error("gagal");//('group_delete_unsuccessful');
      return FALSE;
    }
    //foreign
    $this->db->trans_begin();

    $this->db->delete($this->table, $data_param );
    if ($this->db->trans_status() === FALSE)
    {
      $this->db->trans_rollback();

      $this->set_error("gagal");//('group_delete_unsuccessful');
      return FALSE;
    }

    $this->db->trans_commit();

    $this->set_message("berhasil");//('group_delete_successful');
    return TRUE;
  }

    /**
   * group
   *
   * @param int|array|null $id = id_groups
   * @return static
   * @author madukubah
   */
  public function school( $id = NULL  )
  {
    $this->select('schools.*');
    $this->select('school_head_profile.nip');
    $this->select('CONCAT( users.first_name, " ", users.last_name ) as user_fullname');
      if (isset($id))
      {
        $this->where($this->table.'.id', $id);
      }
      $this->join(
        'users',
        'users.id = schools.school_head_id',
        'inner'
      );
      $this->join(
        'school_head_profile',
        'school_head_profile.user_id = schools.school_head_id',
        'inner'
      );
      $this->limit(1);
      $this->order_by($this->table.'.id', 'desc');

      $this->schools(  );

      return $this;
  }
  public function school_by_user_id( $user_id = NULL  )
  {
      if (isset($id))
      {
        $this->where($this->table.'.user_id', $user_id);
      }

      $this->limit(1);
      $this->order_by($this->table.'.user_id', 'desc');

      $this->schools(  );

      return $this;
  }
  // /**
  //  * schools
  //  *
  //  *
  //  * @return static
  //  * @author madukubah
  //  */
  // public function schools(  )
  // {
      
  //     $this->order_by($this->table.'.id', 'asc');
  //     return $this->fetch_data();
  // }

  /**
   * schools
   *
   *
   * @return static
   * @author madukubah
   */
  public function schools( $start = 0 , $limit = NULL )
  {
      if (isset( $limit ))
      {
        $this->limit( $limit );
      }
      $this->offset( $start );
      $this->order_by($this->table.'.id', 'asc');
      return $this->fetch_data();
  }

}
?>
