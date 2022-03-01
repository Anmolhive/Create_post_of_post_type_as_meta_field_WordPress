# Create_post_of_post_type_as_meta_field_WordPress
We are going to make all post of any post-type as a category of page in Wordpress

Hi, This is Anmol Singh.

Today I am going to Make all the posts of a specific post_type as a category of Page in WordPress Back-End and Show you how to Call it in the Front-End.

So, Let us Assume that we have a post_type in WordPress name "doctor" and we want to Create page with Some Doctor that we can manipulate from Back-End.

Now, Let's Dive in logic:-

1. We need a meta field with all the Doctor's post ID.
2. We need to select it with checkBox.
3. Now, We need to save our Selection in Data-base.
4. And, Lastly we need to call it on the page and make it Mark whenever Back-end Opens, So we know which are selected before.

Now, Let's Jump to Code:-
Here, I discuss only Logic.
For Full Cade See attached file doctor_meta_fields.php

You can Make a Plugin with this Code or Simply add it in Them's Function File

1. Write a function to add Meta box in Page,
   To know about add_meta_box() : [click here](https://developer.wordpress.org/reference/functions/add_meta_box/)
   
  function add_meta_data( )
  {

    add_meta_box( 'doctor_blog', 'Doctor Blog', 'doctors_category_callback', 'page', 'side', 'default' );

  }

2. Now Add a Call back Function to call Data From Post Type:

  function doctors_category_callback( $post )
  {
    // Add your Call Back
  }
  
3. In This Function We are Going to Call Posts from Post type with get_posts() :  [click here](https://developer.wordpress.org/reference/functions/get_posts/)

4. Then Pass Data with post Form Type.

5. And than Save it With update_post_meta() : [click here](https://developer.wordpress.org/reference/functions/update_post_meta/)
   function doctors_category_save( $post_id )
   {
      update_post_meta( $post_id, 'doctor_list', $_POST['doctor_post'] ) 
   }
   add_action( 'save_post', 'doctors_category_save' );


