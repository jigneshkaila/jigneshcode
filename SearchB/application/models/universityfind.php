<?php

class Universityfind extends CI_Model {

    public function __construct() {
        parent::__construct();
	$this->load->helper('location_helper');
    }
    function count_SearchResult($CategoryName = '', $City_id = '', $State_id = '') {
        $this->db->select('id');
        if ($CategoryName != '') {
            $this->db->like('search_category', $CategoryName);
        }
        if ($City_id != '') {
            $this->db->where('city_id', $City_id);
        }
        if ($State_id != '') {
            $this->db->where('state_id', $State_id);
        }
        $query = $this->db->get('university');
        return $query->num_rows();
    }
    
    function Detailpage($page_name = null){
    	 $page_name = str_replace(".html","",$page_name);
    	 $this->db->select('*');
        if ($page_name != '') {
            $this->db->like('place_title ', urldecode($page_name));
        }
        $query = $this->db->get('university');
         if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        } else {
            return FALSE;
        }
        
    	
    }
    
    function getLatLong($address = null){
    	$Result_set = array();
			 $url ="http://maps.googleapis.com/maps/api/geocode/json?address=".urlencode($address)."&sensor=false";
			 $geocode = file_get_contents($url);
			 $json = json_decode($geocode, true);
			 if($json['status']=='OK'){
				    $Result_set['lat'] = $json['results'][0]['geometry']['location']['lat'];
				    $Result_set['lng'] = $json['results'][0]['geometry']['location']['lng'];
				    	foreach($json['results'][0]['address_components'] as $key => $JsonResult){
    						if($JsonResult['types'][0] == "postal_code"){
    							$Result_set['postal_code'] = $JsonResult['long_name'];    	 					}
    					}
				   return $Result_set;
				 }else{
				 	 return false;
				}
    }
    
    function get_SearchResult($CategoryName = '', $City_id = '', $State_id = '',$Perpage = '', $page = '') {
        $this->db->select('*');
        if ($CategoryName != '') {
            $this->db->like('search_category', $CategoryName);
        }
        if ($City_id != '') {
            $this->db->where('city_id', $City_id);
        }
        if ($State_id != '') {
            $this->db->where('state_id', $State_id);
        }

       // $this->db->order_by('name', 'asc');
        $query = $this->db->get('university',$Perpage, $page);

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        } else {
            return FALSE;
        }
    }
    function getCityIDByName($CityName) {
      
		$query = "SELECT * FROM `india_city` WHERE `name` LIKE CONVERT(_utf8 '". $CityName ."' USING latin1) COLLATE latin1_swedish_ci";
		$data = SeekLocationData($query);
		foreach($data as $dataRes){
			$RowRes[] = $dataRes;
		}
		$resultData['id'] = $data[0]->id;
            $resultData['region_id'] = $data[0]->region_id;
            return $resultData;
    }
}

?>