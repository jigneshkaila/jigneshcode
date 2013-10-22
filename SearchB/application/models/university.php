<?php

class University extends CI_Model {

    public function __construct() {
        parent::__construct();

    }
    public function record_count() {
        return $this->db->count_all('university');
    }

    public function findCityNameByStaeName() {
        $this->db->select('name');
        $query = $this->db->get("india_city");
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row->name;
            }
            return $data;
        }
        return false;
    }

    public function fetch_Data($limit, $start) {
        $this->db->limit($limit, $start);
        $query = $this->db->get('university');

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }

}

?>