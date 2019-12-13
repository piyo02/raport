<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class School_head_profile_model extends MY_Model
{
  protected $table = "school_head_profile";

  function __construct() {
      parent::__construct( $this->table );
      parent::set_join_key( 'school_head_id' );
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
  public function school_head( $id = NULL  )
  {
      if (isset($id))
      {
        $this->where($this->table.'.id', $id);
      }

      $this->limit(1);
      $this->order_by($this->table.'.id', 'desc');

      $this->school_heads(  );

      return $this;
  }
  // /**
  //  * school_heads
  //  *
  //  *
  //  * @return static
  //  * @author madukubah
  //  */
  // public function school_heads(  )
  // {
      
  //     $this->order_by($this->table.'.id', 'asc');
  //     return $this->fetch_data();
  // }

  /**
   * school_heads
   *
   *
   * @return static
   * @author madukubah
   */
  public function school_heads(  )
  {
      $this->select($this->table . '.*');
      $this->select('schools.name');
      $this->select('schools.address');
      $this->select('CONCAT( users.first_name, " ", users.last_name ) as school_head_name');
      $this->join(
        'schools',
        'schools.school_head_id = school_head_profile.user_id',
        'inner'
      );
      $this->join(
        'users',
        'users.id = school_head_profile.user_id',
        'inner'
      );
      $this->order_by($this->table.'.id', 'asc');
      return $this->fetch_data();
  }

}
?>
