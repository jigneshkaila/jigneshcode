<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('SeekLocationData'))
{
   function SeekLocationData($query = null){
		if(!empty($query)){
			$field_array = array('query' => $query,
			'token' => '4214240@@**%%#60D#$@#$@#$@DD557Z0S064'
			);
			$ch = curl_init();
			curl_setopt($ch,CURLOPT_URL,'http://alljob.org/sendData.php');
			curl_setopt($ch,CURLOPT_POST,2);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch,CURLOPT_POSTFIELDS,$field_array);
			$result = curl_exec($ch);
			curl_close($ch);
			return json_decode($result);
		}
	}
}


