<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Courses_model extends MY_Model
{
  protected $table = "courses";

  function __construct() {
      parent::__construct( $this->table );
      parent::set_join_key( 'course_id' );
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
  public function course( $id = NULL  )
  {
      if (isset($id))
      {
        $this->where($this->table.'.id', $id);
      }

      $this->limit(1);
      $this->order_by($this->table.'.id', 'desc');

      $this->courses(  );

      return $this;
  }
  // /**
  //  * courses
  //  *
  //  *
  //  * @return static
  //  * @author madukubah
  //  */
  // public function courses(  )
  // {
      
  //     $this->order_by($this->table.'.id', 'asc');
  //     return $this->fetch_data();
  // }

  /**
   * courses
   *
   *
   * @return static
   * @author madukubah
   */
  public function courses( $start = 0 , $limit = NULL )
  {
      if (isset( $limit ))
      {
        $this->limit( $limit );
      }
      $this->offset( $start );
      $this->order_by($this->table.'.id', 'asc');
      return $this->fetch_data();
  }
  public function courses_category_id( $start = 0 , $limit = NULL, $category_id = NULL, $school_id = NULL )
  {
      if (isset( $limit ))
      {
        $this->limit( $limit );
      }
      if ( $category_id )
        $this->where('category_id', $category_id);
      if ( $school_id )
        $this->where('school_id', $school_id);

      $this->offset( $start );
      $this->order_by($this->table.'.id', 'asc');
      return $this->fetch_data();
  }
  public function courses_by_school_id( $school_id = NULL )
  {
      if ( $school_id )
        $this->where('school_id', $school_id);
      $this->order_by($this->table.'.id', 'asc');
      $this->order_by($this->table.'.category_id', 'asc');
      return $this->fetch_data();
  }
  public function record_category_courses_by_school_id( $school_id = NULL )
  {
    $this->select('count(id) AS total');
    if ( $school_id )
      $this->where('school_id', $school_id);
    $this->order_by('category_id', 'asc');
    $this->db->group_by('category_id');
    return $this->fetch_data();
  }
}
?>
