<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Process_model extends CI_Model {

    public function __construct(){
        parent::__construct();
    }

 
    public function get_data($ref = '')
      {

        $this->db->select('*');
        $this->db->from('owner');
        $this->db->where('owner_refferal', $ref);
        $this->db->where('deleted','N');

        $data = $this->db->get()->result();

        return $data;
      }




    

    // End Core Model
}

/* End of file m_global.php */
/* Location: ./application/modules/global/models/m_global.php */