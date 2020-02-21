<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Student_attitude_model extends MY_Model
{
  protected $table = "student_attitude";

  function __construct() {
      parent::__construct( $this->table );
      parent::set_join_key( 'menu_id' );
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
    // if( !$this->delete_foreign( $data_param, ['menu_model'] ) )
    // {
    //   $this->set_error("gagal");//('group_delete_unsuccessful');
    //   return FALSE;
    // }
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
  public function student_attitude( $id = NULL  )
  {
      if (isset($id))
      {
        $this->where($this->table.'.id', $id);
      }

      $this->limit(1);
      $this->order_by($this->table.'.id', 'desc');

      $this->student_attitudes(  );

      return $this;
  }
  // /**
  //  * student_attitudes
  //  *
  //  *
  //  * @return static
  //  * @author madukubah
  //  */
  // public function student_attitudes(  )
  // {
      
  //     $this->order_by($this->table.'.id', 'asc');
  //     return $this->fetch_data();
  // }

  /**
   * student_attitudes
   *
   *
   * @return static
   * @author madukubah
   */
  public function student_attitudes( $student_id = NULL, $course_id = NULL )
  {
    $this->select($this->table . '.*');
    $this->select('attitude.name');
    $this->select('predicate_attitude.name AS predicate_name');
      if ( $student_id )
      {
        $this->where('student_id', $student_id );
      }
      if ($course_id)
      {
        $this->where('course_id', $course_id );
      }
      $this->join(
        'attitude',
        'attitude.id = student_attitude.attitude_id',
        'inner'
      );
      $this->join(
        'predicate_attitude',
        'predicate_attitude.id = student_attitude.predicate_id',
        'inner'
      );
      $this->order_by($this->table.'.id', 'asc');
      return $this->fetch_data();
  }
  public function result_student_attitude ($student_id = NULL, $attitude_id = NULL)
  { 
    $this->select('COUNT(predicate_id) AS total');
    $this->select('predicate_attitude.name AS predicate');
    $this->select('predicate_attitude.description AS description');
    $this->join(
      'predicate_attitude',
      'predicate_attitude.id = student_attitude.attitude_id',
      'inner'
    );
    $this->where('student_id', $student_id);
    $this->where('attitude_id', $attitude_id);
    return $this->fetch_data();
  }

}
?>
