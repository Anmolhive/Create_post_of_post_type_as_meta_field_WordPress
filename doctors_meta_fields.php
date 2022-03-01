<?php
/*
* Name        : Doctor List
* Discription : Add a meta field to post with Doctor's Post title and Doctor's Post ID from 'doctor' Post-Type, When we Get this meta field it returns Array of Selected Doctor's Post ID in an Array.
* Author      : Anmol Singh (Intern)
* version     : 1.0.3   
*/
function add_meta_data( )
{

    add_meta_box( 'doctor_list', 'Doctor List', 'doctors_category_callback', 'page', 'side', 'default' );

}


function doctors_category_callback( $post )
{

    $postID = $post->ID;
    wp_nonce_field( 'doctors_category_save', 'doctors_category_nonce' );

    $args = [ 'post_type' => 'doctor', 'numberposts' => -1, 'orderby' => 'title', 'order' => 'ASC' ];
    $the_query = get_posts( $args );
    $meta_data = get_post_meta( $postID, 'doctor_list', true );
    
    echo '<section id="doctors_category">';
    echo '<form method="post">';
    echo '<div class="doctors_category_label">';
    echo '<label><b>Used</b></label>';
    echo '</div>';
    echo '<div class="used_field">';

    $i = 0;
    foreach ( $the_query as $post ) : setup_postdata( $post );

        $checkBox = FALSE;
        if ( !empty( $meta_data ) ) {
            foreach ( $meta_data as $value ) {
                $value = ( int )$value;
                if ( $value == $post->ID ) {
                    $checkBox = TRUE;
                    $i++;
                }
            }
        }
        if ( $checkBox == TRUE ) {
            echo '<div class="doctor_checkbox">';
            echo '<input class="" type="checkbox" name="doctor_post[]" value="' . $post->ID . '" checked>';
            echo '<label><b>' . $post->post_title . '</b></label>';
            echo '</div>';
        }
    endforeach;
    if( $i == 0 )
    {
        echo '<div style="text-align: center; background-color: white; color: #C0C0C0;><label"><b>NO DOCTOR USED!<br>Please select First.</b></label></div>'; 
    }

    echo '</div>';
    echo '<div class="doctors_category_label">';
    echo '<label><b>Unused</b></label>';
    echo '</div>';
    echo '<div class="doctor_field">';

    foreach ( $the_query as $post ) : setup_postdata( $post );

        $checkBox = FALSE;
        if ( !empty( $meta_data ) ) {
            foreach ( $meta_data as $value ) {
                $value = ( int )$value;
                if ( $value == $post->ID ) {
                    $checkBox = TRUE;
                }
            }
        }
        if ( $checkBox != TRUE ) {
            echo '<div class="doctor_checkbox">';
            echo '<input class="" type="checkbox" name="doctor_post[]" value="' . $post->ID . '">';
            echo '<label>' . $post->post_title . '</label>';
            echo '</div>';
        } 

    endforeach;

    echo '</div>';
    echo '</form>';
    echo '<div class="creator"><p><i> ~ by ANMOL SINGH</i></p></div>';
    echo '</section>';

?>
    <style>
        .doctors_category_label {
            text-align: center;
            color: #0073aa;
            font-weight: 900;
            padding-bottom: 4px;
        }

        .doctors_category_menu {
            display: flex;
            margin: 0px;
            cursor: pointer;
        }

        .doctors_category_menu li {
            width: 50%;
            text-align: center;
            padding: 5px;
            margin: 0px;
        }

        .doctor_field::-webkit-scrollbar {
            width: 10px;
        }

        .doctor_field {
            height: 100%;
            -webkit-font-smoothing: antialiased;
            max-height: 200px;
            overflow-y: scroll;
            background-color: #f2f2f2;
            border: 2px #C0C0C0;
            border-radius: 6px;
        }

        .used_field {
            height: 100%;
            -webkit-font-smoothing: antialiased;
            max-height: auto;
            background-color: #f2f2f2;
            border: 2px #C0C0C0;
            border-radius: 6px;
        }

        .doctor_checkbox {
            padding: 3px;
        }

        .doctor_checkbox input {
            margin-bottom: -7px;
            margin-right: 10px;
            margin-left: 10px;
        }

        .doctor_checkbox label {
            font-weight: 400;
        }

        .doctor_checkbox label b {
            font-weight: 700;
        }

        .doctor_field::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        .doctor_field::-webkit-scrollbar-track {
            box-shadow: inset 0 0 10px #bfbfbf;
            border-radius: 6px;
        }

        .doctor_field::-webkit-scrollbar-thumb {
            background: #b3b3b3;
            border-radius: 6px;
        }

        .doctor_field::-webkit-scrollbar-thumb:hover {
            background: #595959;
        }

        .creator {
            margin: 0px;
            padding: 0px;
            text-align: right;
            cursor: none;
        }

        .creator p {
            margin: 0px;
            margin-top: 6px;
            padding-bottom: 0px;
        }

        

    </style>
<?php

    wp_reset_postdata( );

}
add_action( 'add_meta_boxes', 'add_meta_data' );


function doctors_category_save( $post_id )
{

    update_post_meta( $post_id, 'doctor_list', $_POST['doctor_post'] );
    
}
add_action( 'save_post', 'doctors_category_save' );

?>