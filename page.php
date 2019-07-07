<?php
/**
 * Created by PhpStorm.
 * User: Brice
 * Date: 20/01/2019
 * Time: 19:13
 */
?>

<?php get_header(); ?>

<?php
$page = get_post();
if ($page->post_name == 'contact' ){
    while ( have_posts() ){
        ?>
        <div id="block_header_photo_landing" style="background: url(<?php echo get_the_post_thumbnail_url() ?>) no-repeat center;background-size: cover;">
            <div id="overlay"></div>
            <?php
            if ( function_exists('yoast_breadcrumb') ) {
                yoast_breadcrumb( '<p id="breadcrumbs">','</p>' );
            }
            ?>
            <h1>Contact</h1>
        </div>

        <section id="block_confirmation_mer" style="display: none">
            <p class="message_mail_sent">Message envoyé</p>
        </section>

        <section id="error" class="block_error_mer" style="display: none">
            <span class="closed_popup">×</span>
            <p class="message_error">Une erreur s'est produite lors de la validation du formulaire</p>
        </section>

        <section class="container" id="block_contact_form">
            <?php
            the_post();
            the_content();
            ?>
        </section>
        <?php
    }
}else{
    while ( have_posts() ){
        ?>
        <div id="block_header_photo_landing" style="background: url(<?php echo get_the_post_thumbnail_url() ?>) no-repeat center;background-size: cover;">
            <div id="overlay"></div>
            <?php
            if ( function_exists('yoast_breadcrumb') ) {
                yoast_breadcrumb( '<p id="breadcrumbs">','</p>' );
            }
            ?>
            <h1><?php echo $page->post_title; ?></h1>

        </div>
        <section class="container content" style="padding-top:40px">
            <?php
            the_post();
            the_content();

            ?>
        </section>

        <?php if(get_the_ID() == 249) : ?>
            <a class="btn" href="<?php echo get_permalink(get_post(90)->ID) ?>" style="margin: auto;width: 190px;display: block;margin-bottom: 25px;margin-top: 25px;">Contactez nous</a>
        <?php endif; ?>

        <?php
    }
}
?>

<?php get_footer(); ?>