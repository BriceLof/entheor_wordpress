<?php get_header(); ?>

<?php $current_category = get_the_category();
$category_description = $current_category[0]->description;
echo $category_description;
?>

<div id="category_page" class="category_page">
    <div id="block_header_photo_landing" style="background-size: cover;">
        <div id="overlay"></div>
        <?php
            if ( function_exists('yoast_breadcrumb') ) {
                yoast_breadcrumb( '<p id="breadcrumbs">','</p>' );
            }
        ?>
        <h1><?php echo $current_category[0]->name ?></h1>
    </div>

    <div class="container">
        <div class="row">
            <?php $posts = get_posts( array('category_name' => $current_category[0]->slug)); ?>
            <?php foreach($posts as $post) : ?>
                <article class="col-sm-6 col-md-4">
                    <div class="block_article">
                        <a href="<?php echo get_permalink($post->ID) ?>"><picture style="background: url(<?php echo get_the_post_thumbnail_url($post->ID) ?>) no-repeat center;background-size: cover;"></picture></a>
                        <h3><a href="<?php echo get_permalink($post->ID) ?>"><?php echo $post->post_title; ?></a></h3>
                        <p class="extract">
                            <?php echo $post->post_excerpt; ?>
                        </p>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>
    </div>

</div>

<?php get_footer(); ?>
