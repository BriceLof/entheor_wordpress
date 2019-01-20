<?php
/**
 * Created by PhpStorm.
 * User: Brice
 * Date: 20/01/2019
 * Time: 23:15
 */

wp_enqueue_style( 'header', get_template_directory_uri() . '/css/header.css',false,'1.0','all');

function add_meta_tags() {
    echo '<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">';
}
add_action('wp_head', 'add_meta_tags');

function add_bootstrap_css(){
    echo '<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">';
}
add_action('wp_head', 'add_bootstrap_css');

function add_bootstrap_js(){
    echo '
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
    ';
}
add_action('wp_footer', 'add_bootstrap_js');