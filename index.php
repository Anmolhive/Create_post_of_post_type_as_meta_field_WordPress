<?php 
$doctor_list = get_post_meta( $post->ID, 'doctor_list', true ); 
if( $doctor_list )
{
    print_r( $doctor_list );
}

// My OutPut
// Array ( [0] => 503 [1] => 527 [2] => 531 [3] => 525 [4] => 560 [5] => 539 [6] => 2239 [7] => 1382 [8] => 512 [9] => 553 )
?>

