<?php

/* ======================================================================

    Disable Admin Bar v1.0
    A script to disable the admin bar for all users.

 * ====================================================================== */

function my_function_admin_bar(){
    return false;
}
add_filter( 'show_admin_bar' , 'my_function_admin_bar');

?>
