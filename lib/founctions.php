<?php


function C( $k ){
    global $db;
    $row = $db->get("select * from settings where k='{$k}'");
    if( $row ){
        return $row['v'];
    }
    return false;
    
}
