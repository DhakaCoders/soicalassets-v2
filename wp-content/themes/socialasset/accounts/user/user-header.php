<?php  
global $umetas;
$user = wp_get_current_user();
$umetas = array_map( function( $a ){ return $a[0]; }, get_user_meta( $user->ID ) ); 
?>