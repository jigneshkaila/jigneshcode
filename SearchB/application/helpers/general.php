<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
define(SEEKTEAMMDDATAURL, 'http://alljob.org/sendData.php');
function SeekLocationData($query = null) {
    $data = array();
    $field_array = array('query' => $query,
        'token' => '4214240@@**%%#60D#$@#$@#$@DD557Z0S064'
    );
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, SEEKTEAMMDDATAURL);
    curl_setopt($ch, CURLOPT_POST, 2);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $field_array);
    $result = curl_exec($ch);
    curl_close($ch);
    unset($data);
    return json_decode($result);
}

?>
