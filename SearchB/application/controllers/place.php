<?php

class Place extends CI_Controller {

    public function __construct() {
        parent:: __construct();
        $this->load->helper("url");
       $this->load->model("universityfind");
        $tableName = array_shift(explode(".",$_SERVER['HTTP_HOST']));
        switch ($tableName) {
				    case 'university':
				        $this->load->model('university');
				        $this->load->model('universityfind');
				        break;
				    case 'hotel':
				        $this->load->model('hotel');
				        $this->load->model('hotelfind');
				        break;
				    case 'restaurant':
				        $this->load->model('restaurant');
				        $this->load->model('restaurantfind');
				        break;
				}
        
       $this->load->library("pagination");
    }

    public function detail() {
    	$html = null;
      $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
      $tableName = array_shift(explode(".",$_SERVER['HTTP_HOST']));
        switch ($tableName) {
				    case 'university':
				        $data_result = $this->universityfind->Detailpage(urldecode($page));
				        break;
				    case 'hotel':
				        $data_result = $this->hotelfind->Detailpage(urldecode($page));
				        break;
				    case 'restaurant':
				        $data_result = $this->restaurantfind->Detailpage(urldecode($page));
				        break;
				}
      
      $data1 = $data_result[0];
     	$html = "<div class='row'><div class='col-lg-12'>"; 
      $html .="<div class='panel panel-default'>";
      $html .="<div class='panel-heading'>" . $data1->business_name . "</div>";
      $html .="<div class='panel-body'>";
      $html .="<div class='col-sm-5'>";
      
      if(empty($data1->lat)){
      	 $tableName = array_shift(explode(".",$_SERVER['HTTP_HOST']));
        switch ($tableName) {
				    case 'university':
				        $Result_set = $this->universityfind->getLatLong($data1->address);
				        break;
				    case 'hotel':
				        $Result_set = $this->hotelfind->getLatLong($data1->address);
				        break;
				    case 'restaurant':
				        $Result_set = $this->restaurantfind->getLatLong($data1->address);
				        break;
				}
    		
    		$postal_code = isset($Result_set['postal_code']) ? $Result_set['postal_code'] : '';
    		$Update_data = array('lat' => $Result_set['lat'], 'lang' => $Result_set['lng'], 'postal_code' => $postal_code);
    		$page  = str_replace(".html", "", $page);
    		 $tableName = array_shift(explode(".",$_SERVER['HTTP_HOST']));
        switch ($tableName) {
				    case 'university':
				        $this->db->update('university', $Update_data, array('place_title' => $page));
				        break;
				    case 'hotel':
				        $this->db->update('hotel', $Update_data, array('place_title' => $page));
				        break;
				    case 'restaurant':
				        $this->db->update('restaurant', $Update_data, array('place_title' => $page));
				        break;
				}
    		
    	}else{
    		$Result_set['lat'] = $data1->lat;
    		$Result_set['lng'] = $data1->lang;
    	}
          	
      if (isset($data1->address) && !empty($data1->address)) {
          $html .= $data1->address . "<br/><br/>";
      }
      if (isset($data1->phone_number) && !empty($data1->phone_number)) {
          $html .= $data1->phone_number . "<br/><br/>";
      }
      if (isset($data1->fax) && !empty($data1->fax)) {
          $html .= $data1->fax . "<br/><br/>";
      }
      if (isset($data1->website) && !empty($data1->website)) {
          $html .= $data1->website . "<br/><br/>";
      }
      if (isset($data1->email_id) && !empty($data1->email_id)) {
          $html .= $data1->email_id . "<br/><br/>";
      }
      if (isset($data1->g_review_count) && !empty($data1->g_review_count)) {
          $html .= "Total Reviws: " . $data1->g_review_count . "<br/><br/>";
      }
      if (isset($data1->rating_count) && !empty($data1->rating_count)) {
          $html .= "Rating: " . $data1->rating_count . "<br/><br/>";
      }
      $html .= "</div>";
      $html .= "<div class='col-sm-2'>";
      if (isset($data1->image_name) && !empty($data1->image_name)) {
          $image_url = "http://alljob.org/search_bussiness/image/" . $data1->image_name;
          $html .= "<a class=''><img src='" . $image_url . "' height='85' width='85'><br/></a>";
      } else {
          $image_url = "http://alljob.org/search_bussiness/image/NoImageAvailableLarge.jpg";
          $html .= "<a class=''><img src='" . $image_url . "' height='85' width='85'><br/></a>";
      }
      $html .= "</div>";
      $html .="</div></div></div>";
  		$this->load->library('googlemaps');
			$config['center'] = $Result_set['lat'] .",". $Result_set['lng'];
			$marker['places'] = TRUE;
			$this->googlemaps->initialize($config);
			$marker = array();
			$marker['position'] = $Result_set['lat'] .",". $Result_set['lng'];
			$marker['infowindow_content'] = $html;
			$this->googlemaps->add_marker($marker);
			$data['map'] = $this->googlemaps->create_map();
			$this->load->view('DetailPage', $data);
		}
}
