<?php

class Search extends CI_Controller {

    public function __construct() {
        parent:: __construct();
        $this->load->helper("url");
         $tableName = array_shift(explode(".",$_SERVER['HTTP_HOST']));
        switch ($tableName) {
				    case 'university':
				        $this->load->model("universityfind");
				        $this->load->model("university");
				        break;
				    case 'hotel':
				        $this->load->model("hotelfind");
				         $this->load->model("hotel");
				        break;
				    case 'restaurant':
				        $this->load->model("restaurantfind");
				         $this->load->model("restaurant");
				        break;
				}
       $this->load->library("pagination");
    }

    public function SearchByCategory($state_name) {
    	 $tableName = array_shift(explode(".",$_SERVER['HTTP_HOST']));
        switch ($tableName) {
				    case 'university':
				        $data["results"] = $this->university->findCityNameByStaeName();
				        break;
				    case 'hotel':
				        $data["results"] = $this->hotel->findCityNameByStaeName();
				        break;
				    case 'restaurant':
				        $data["results"] = $this->restaurant->findCityNameByStaeName();
				        break;
				}
        
        $this->load->view("GetCityNameByStateName", $data);
    }
    public function SearchByState($state_name) {
    	$tableName = array_shift(explode(".",$_SERVER['HTTP_HOST']));
        switch ($tableName) {
				    case 'university':
				        $data["results"] = $this->university->findCityNameByStaeName();
				        break;
				    case 'hotel':
				        $data["results"] = $this->hotel->findCityNameByStaeName();
				        break;
				    case 'restaurant':
				        $data["results"] = $this->restaurant->findCityNameByStaeName();
				        break;
				}
        
        $this->load->view("GetCityNameByStateName", $data);
    }
    public function findData(){
        $category['name'] = $this->input->post('Category');
        $CityParam['region_name'] = $this->input->post('State');
        $CityParam['name'] = $this->input->post('City');
        $resultArray = $this->SearchData($category['name'], $CityParam);
        //print_r($resultArray);
    }

    public function SearchData($category = null, $CityParam = null) {
        $bussinessData = array();
        $pageCounter = 0;
        $count = 0;
        $falgval = 0;
        do {

            if ($pageCounter == 0 || $falgval == 1) {
                $strUrl = "https://maps.google.co.in/maps?q=" . strip_tags($category['name']) . " near " . strip_tags($CityParam['name']) . "," . strip_tags($CityParam['region_name']) . "&start=" . $pageCounter;
                //echo $strUrl.'<br/>';
                //print_r($category['name']);
                $strUrl = str_replace(' ', '%20', $strUrl);
                $Html = file_get_contents($strUrl);
                $arrPart = $this->arr_GetArray($Html, '<div class="lsicon">', '<div class="actbar-local-wrapper">', true);
                foreach ($arrPart as $key => $part) {

                    if ($this->find_string('<span class="actbar-local-wrapper">', $part)) {
                        $businessname = $this->str_GetSubString($part, '<span class="pp-place-title">', '</span>');
                        $bussinessData[$count][$key]['businessname'] = strip_tags($businessname);
                    } else {
                        $bussinessData[$count][$key]['businessname'] = '';
                    }
                    $bussinessData[$count][$key]['category_id'] = strip_tags($category['id']);
                    $bussinessData[$count][$key]['city'] = $CityParam['id'];
                    $bussinessData[$count][$key]['state'] = $CityParam['region_id'];
                    $bussinessData[$count][$key]['search_category'] = $category['name'];
                    if ($this->find_string('<span class="pp-headline-item pp-headline-address">', $part)) {
                        $address = $this->str_GetSubString($part, '<span class="pp-headline-item pp-headline-address">', '</span>');
                        $bussinessData[$count][$key]['address'] = strip_tags($address);
                    } else {
                        $bussinessData[$count][$key]['address'] = '';
                    }
                    if ($this->find_string('<span class="pp-headline-item pp-headline-phone">', $part)) {
                        $phone = $this->str_GetSubString($part, '<span class="pp-headline-item pp-headline-phone">', '</nobr>');
                        $bussinessData[$count][$key]['phone'] = strip_tags($phone);
                    } else {
                        $bussinessData[$count][$key]['phone'] = '';
                    }
                    if ($this->find_string('<span class="pp-headline-item pp-headline-authority-page">', $part)) {
                        $website = $this->str_GetSubString($part, '<span class="pp-headline-item pp-headline-authority-page">', '</span>');
                        $bussinessData[$count][$key]['website'] = strip_tags($website);
                    } else {
                        $bussinessData[$count][$key]['website'] = '';
                    }
                    if ($this->find_string('Category:', $part)) {
                        $category_res = $this->str_GetSubString($part, 'Category:', '</span>');
                        $bussinessData[$count][$key]['category'] = strip_tags($category_res);
                    } else {
                        $bussinessData[$count][$key]['category'] = '';
                    }
                    if ($this->find_string('<div class="pp-coverphoto">', $part)) {
                        $imaes = $this->str_GetSubString($part, '<div class="photo-border">', '</div>');
                        $doc = new DOMDocument();
                        $doc->loadHTML($imaes);
                        $xpath = new DOMXPath($doc);
                        $src = $xpath->evaluate("string(//img/@src)"); # "/images/image.jpg"
                        if (isset($src) && !empty($src)) {
                            $img = "/home/content/66/10440266/html/place/assets/image/" . str_replace(' ', '_', $bussinessData[$count][$key]['businessname']) . ".jpg";
                            file_put_contents($img, file_get_contents($src));
                            $bussinessData[$count][$key]['image'] = str_replace(' ', '_', $bussinessData[$count][$key]['businessname']) . ".jpg";
                        } else {
                            $bussinessData[$count][$key]['image'] = '';
                        }
                    } else {
                        $bussinessData[$count][$key]['image'] = '';
                    }
                    if ($this->find_string('<span id="pp-reviews-headline">', $part)) {
                        $star = $this->str_GetSubString($part, '<span id="pp-reviews-headline">', '</span>');
                        $bussinessData[$count][$key]['star'] = strip_tags($star);
                    } else {
                        $bussinessData[$count][$key]['star'] = '';
                    }
                    if ($this->find_string('<span><a class="pp-more-content-link"', $part)) {
                        $review_url = $this->str_GetSubString($part, '<span><a class="pp-more-content-link"', '</span></a></span>');
                        $review = strip_tags($review_url);
                        $review = $this->str_GetSubString($review_url, 'href="', '" target="_blank">');
                        $bussinessData[$count][$key]['review_url'] = $this->str_GetSubString($review_url, 'href="', '" target="_blank">');
                        $review = str_replace($review, "", $review_url);
                        $review = str_replace('href=""', "", $review);
                        $review = strip_tags($review);
                        $bussinessData[$count][$key]['review'] = str_replace('target="_blank">', "", $review);
                    } else {
                        $bussinessData[$count][$key]['review'] = '';
                        $bussinessData[$count][$key]['review_url'] = '';
                    }
                }
                if (count($bussinessData[$count]) > 9) {
                    $falgval = 1;
                }
            }
            $count = $count + 1;
            $pageCounter = $pageCounter + 10;
        } while ($pageCounter <= 19);
        return $bussinessData;
    }

    public function index() {
        $data['Category'] = $this->input->post('Category');
        $config["base_url"] = base_url() . "/Search/index";
        $data['State'] = $this->input->post('State');
        $data['City'] = $this->input->post('City');
        $config = array();
        $config["base_url"] = base_url() . "/Search/index";
        $config["per_page"] = 20;
        $config["uri_segment"] = 3;
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul><!--pagination-->';
        $config['first_link'] = '&laquo;';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['last_link'] = 'Last &raquo;';
        $config['last_tag_open'] = '<li class="next page">';
        $config['last_tag_close'] = '</li>';
        $config['next_link'] = 'Next &rarr;';
        $config['next_tag_open'] = '<li class="next page">';
        $config['next_tag_close'] = '</li>';
        $config['prev_link'] = '&larr; Previous';
        $config['prev_tag_open'] = '<li class="prev page">';
        $config['prev_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li class="page">';
        $config['num_tag_close'] = '</li>';
        $this->pagination->initialize($config);
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
         $tableName = array_shift(explode(".",$_SERVER['HTTP_HOST']));
        switch ($tableName) {
				    case 'university':
				         $Location = $this->universityfind->getCityIDByName($data['City']);
				        break;
				    case 'hotel':
				        $Location = $this->hotelfind->getCityIDByName($data['City']);
				        break;
				    case 'restaurant':
				       $Location = $this->restaurantfind->getCityIDByName($data['City']);
				        break;
				}
      
        if(isset($data['Category']) && !empty($data['Category'])){
        	 $tableName = array_shift(explode(".",$_SERVER['HTTP_HOST']));
        switch ($tableName) {
				    case 'university':
				        $config["total_rows"] = $this->universityfind->count_SearchResult($data['Category'], $Location['id'], $Location['region_id']);
				        break;
				    case 'hotel':
				        $config["total_rows"] = $this->hotelfind->count_SearchResult($data['Category'], $Location['id'], $Location['region_id']);
				        break;
				    case 'restaurant':
				        $config["total_rows"] = $this->restaurantfind->count_SearchResult($data['Category'], $Location['id'], $Location['region_id']);
				        break;
				}
        $tableName = array_shift(explode(".",$_SERVER['HTTP_HOST']));
        switch ($tableName) {
				    case 'university':
				        $data["results"] = $this->universityfind->get_SearchResult($data['Category'], $Location['id'], $Location['region_id'], $config["per_page"], $page);
				        break;
				    case 'hotel':
				       $data["results"] = $this->hotelfind->get_SearchResult($data['Category'], $Location['id'], $Location['region_id'], $config["per_page"], $page);
				        break;
				    case 'restaurant':
				        $data["results"] = $this->restaurantfind->get_SearchResult($data['Category'], $Location['id'], $Location['region_id'], $config["per_page"], $page);
				        break;
				}
        
        $data["links"] = $this->pagination->create_links();
      }
        //print_r($data["results"]);
        $this->load->view("Search", $data);
    }
    public function geturl($url) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; rv:1.7.3) Gecko/20041001 Firefox/0.10.1");
        curl_setopt($ch, CURLOPT_URL, $url);
        //curl_setopt( $ch, CURLOPT_COOKIEJAR, $cookie );
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_ENCODING, "");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_AUTOREFERER, true);
        //	curl_setopt( $ch, CURLOPT_CONNECTTIMEOUT, $timeout );
        //curl_setopt( $ch, CURLOPT_TIMEOUT, $timeout );
        curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
        $html = curl_exec($ch);
        curl_close($ch);
        return $html;
    }


    function curl_download($url) {

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://mbjdir.com");
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $output = curl_exec($ch);
        return $output;
        curl_close($ch); // Returning the data from the function
    }

    public function match_all_key_value($regex, $str, $keyIndex = 1, $valueIndex = 2) {
        $arr = array();
        preg_match_all($regex, $str, $matches, PREG_SET_ORDER);
        foreach ($matches as $m) {
            $arr[$m[$keyIndex]] = $m[$valueIndex];
        }
        return $arr;
    }

    public function match_all($regex, $str, $i = 0) {
        if (preg_match_all($regex, $str, $matches) === false)
            return false;
        else
            return $matches[$i];
    }

    public function match($regex, $str, $i = 0) {
        if (preg_match($regex, $str, $match) == 1)
            return $match[$i];
        else
            return false;
    }

    public function find_string($checkstring = null, $wholestring = null) {
        $pos = strpos($wholestring, $checkstring);

        if ($pos === false) {
            return false;
        } else {
            return true;
        }
    }

    public function str_GetSubString($strSource, $startstr, $endstr) {

        $startPos = strpos($strSource, $startstr) + strlen($startstr);
        $endsPos = strpos($strSource, $endstr, $startPos);
        $strValue = substr($strSource, $startPos, $endsPos - $startPos);
        return $strValue;
    }

    public function arr_GetArray($strSource, $startstr, $endstr, $duplicateAllowed) {

        $arrValue = array();
        $strCount = substr_count($strSource, $startstr);

        for ($i = 0; $i < $strCount; $i++) {
            $strValue = $this->str_GetSubString($strSource, $startstr, $endstr);
            if (strlen($strValue) > 0) {

                if (!(!$duplicateAllowed && in_array($strValue, $arrValue))) {
                    $arrValue[$i] = $strValue;
                }
                $strSource = substr($strSource, strpos($strSource, $endstr) + strlen($endstr));
            }
        }
        return $arrValue;
    }

    public function str_matchStr($strPattern, $strSource) {
        try {
            $strValue = "";
            $str = preg_match($strPattern, $strSource, $regs, PREG_OFFSET_CAPTURE);
            if ($str > 0) {
                $strValue = $regs[0];
            }
        } catch (Exception $e) {
            
        }
        return $strValue;
    }

    public function RemoveHtmlTag($strSource) {
        $strValue = strip_tags($strSource);
        return $strValue;
    }

    public function RemoveExtracChars($strSource) {
        $strSource = str_replace('\t', '', $strSource);
        $strSource = str_replace('\n', '', $strSource);
        $strSource = str_replace('\r', '', $strSource);
        $strSource = str_replace('  ', '', $strSource);
        return $strSource;
    }

    public function writeFile6($fp, $str1, $str2, $str3, $str4, $str5, $str6) {
        $valueAll = "\"" . $str1 . "\",\"" . $str2 . "\",\"" . $str3 . "\",\"" . $str4 . "\",\"" . $str5 . "\",\"" . $str6 . "\"";
        //$valueAll = strip_tags( $valueAll );
        $valueAll = str_replace('""', '"', $valueAll);
        $arrOutput = array($valueAll);
        foreach ($arrOutput as $fields) {
            fwrite($fp, $fields . "\r\n");
        }
    }

    public function writeFileHeader6($fp, $str1, $str2, $str3, $str4, $str5, $str6) {
        $HeaderValue = "\"$str1\",\"$str2\",\"$str3\",\"$str4\",\"$str5\",\"$str6\"";
        fwrite($fp, $HeaderValue . "\r\n");
    }

    public function getEmail($strSource) {
        $strvalue = $this->str_matchStr('([a-zA-Z0-9\-\._\+]+@[a-z0-9A-Z\-\._]+\.[a-zA-Z]+)', $strSource);
        return $strvalue;
    }

    public function get_EmailFromWebsite($website) {
        $steEmail = "";
        try {

            $strWebsiteSource = file_get_contents($website);
            $strSourcelength = strlen($strWebsiteSource);
            if ($strSourcelength > 0) {
                $steEmail = $this->getEmail($strWebsiteSource);
                $strCount = strlen($steEmail);
                if ($strCount == 0) {
                    $strUrl = $this->str_matchStr('(href=\"[^>]*>Contact (.*)[^>]*>)', $strWebsiteSource);
                    //$strUrl = $this->str_matchStr('(href="[^>]*>Con(.t)*[^<]*)',$strWebsiteSource);
                    if (strlen($strUrl) == 0) {
                        $strUrl = $this->str_matchStr('(href=\"[^>]*>contact (.*)[^>]*>)', $strWebsiteSource);
                    }
                    if (strlen($strUrl) == 0) {
                        $strUrl = $this->str_matchStr('(href=\"[^>]*>Contact[^>]*>)', $strWebsiteSource);
                    }
                    if (strlen($strUrl) == 0) {
                        $strUrl = $this->str_matchStr('(href=\"[^>]*>contact[^>]*>)', $strWebsiteSource);
                    }
                    if (strlen($strUrl) > 0) {
                        $strUrl = $this->str_matchStr('(href=\"[^\"]*)', $strUrl);
                        $strUrl = str_replace('href=', '', $strUrl);
                        $strUrl = str_replace('"', '', $strUrl);
                        $strUrl = $website . $strUrl;
                        $strUrl = $this->RemoveHtmlTag($strUrl);
                        $strPageSource = file_get_contents($strUrl);
                        $steEmail = $this->getEmail($strPageSource);
                    }
                }
            }
        } catch (Exception $e) {
            echo 'Message: ' . $e->getMessage();
        }
        return $steEmail;
    }

}
