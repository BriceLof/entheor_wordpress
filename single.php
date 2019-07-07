<?php

get_header();

global $wp_query;

$post = get_post();
$category = get_the_category($post->ID);
?>
    <article>
        <div id="block_header_photo_landing">
            <div id="overlay"></div>
            <?php
            if ( function_exists('yoast_breadcrumb') ) {
                yoast_breadcrumb( '<p id="breadcrumbs">','</p>' );
            }
            ?>
            <h1><?php echo $post->post_title; ?></h1>
        </div>

        <section id="block_confirmation_mer" style="display: none">
            <p class="message_mail_sent">Votre diagnostic a bien été enregistré.<br>Un consultant vous contacte dans la journée.</p>
        </section>

        <section id="error" class="block_error_mer" style="display: none">
            <span class="closed_popup">×</span>
            <p class="message_error">Une erreur s'est produite lors de la validation du formulaire</p>
        </section>

        <section id="content" class="container">
            <div class="row">
                <div id="block_content_article" class="col-md-9 content">
                    <?php echo $post->post_content; ?>
                </div>
                <aside class="col-md-3">
                    <div class="row">
                        <p class="col-md-12" id="etre_rappele">Être rappelé</p>
                        <!-- Form : ajout beneficiaire (exception pour les landings 'Devenir accompagnateur VAE' et 'Entreprise')-->
                        <div id="form_mer" class="col-md-12">
                            <?php if($post->ID != 160 && $post->ID != 224) : ?>
                                <form id="form_mise_en_relation" action='<?php echo admin_url( 'admin-post.php' ); ?>' method="post">
                                    <?php get_template_part( 'template/form_mer'); ?>
                                </form>
                            <?php else: ?>
                                <?php if($post->ID == 160) : ?>
                                    <form id="form_mise_en_relation" action='<?php echo admin_url( 'admin-post.php' ); ?>' method="post">
                                        <?php get_template_part( 'template/form_devenir_accompagnateur'); ?>
                                    </form>
                                <?php elseif($post->ID == 224) : ?>
                                    <form id="form_mise_en_relation" action='<?php echo admin_url( 'admin-post.php' ); ?>' method="post">
                                        <?php get_template_part( 'template/form_vae_entreprise'); ?>
                                    </form>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>

                    </div>
                </aside>
            </div>
        </section>

        <section id="other_landings" class="container">
            <h2>
                <?php  if($category[0]->slug == 'actualites-vae') : ?>
                    Actualités VAE
                    <?php $articles = get_posts( array('category_name' => 'actualites-vae', 'posts_per_page' => 3, 'offset'=> 1)); ?>
                <?php elseif ($category[0]->slug == 'landing') : ?>
                    Nos autres prestations
                    <?php $articles = get_posts( array('category_name' => 'landing', 'posts_per_page' => 3, 'offset'=> 1)); ?>
                <?php else : ?>
                    Actualités VAE
                    <?php $articles = get_posts( array('posts_per_page' => 3, 'offset'=> 1)); ?>
                <?php endif; ?>
            </h2><span class="line"></span>
            <div class="row">
                <?php foreach($articles as $article) : ?>
                    <?php if (get_permalink($article->ID) != get_permalink()) : ?>
                        <article class="col-sm-6 col-md-4">
                            <div class="block_article">
                                <a href="<?php echo get_permalink($article->ID) ?>"><picture style="background: url(<?php echo get_the_post_thumbnail_url($article->ID) ?>) no-repeat center;background-size: cover;"></picture></a>
                                <?php  if($category[0]->slug == 'actualites-vae') : ?>
                                    <h3 class="h_article"><a href="<?php echo get_permalink($article->ID) ?>"><?php echo $article->post_title; ?></a></h3>
                                <?php else : ?>
                                    <h2><a href="<?php echo get_permalink($article->ID) ?>"><?php echo $article->post_title; ?></a></h2>
                                <?php endif; ?>
                                <p class="extract">
                                    <?php echo (strlen($article->post_excerpt) > 240 ) ? substr($article->post_excerpt, 0, 240).' ...' : $article->post_excerpt; ?>
                                </p>
                                <a href="<?php echo get_permalink($article->ID) ?>" class="btn center btn_see_more" id="">+ En savoir plus</a>
                            </div>
                        </article>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </section>

        <?php if($post->ID != 160) : ?>
            <section id="diagnostic" class="container-fluid">
                <div class="container text-center">
                    <h2 class="text-uppercase"><b>Votre diagnostic vae avec Enthéor</b></h2>
                    <p>
                        <b>Le présent questionnaire va nous permettre de diagnostiquer vos possibilités d'accès à un diplôme par la VAE. Il devra être suivi d'un <br>
                            entretien. Les données fournies resteront confidentielles et ne peuvent être transmises à aucune entité externe à ENTHEOR.
                        </b>
                    </p>
                    <button class="btn" id="btn_launch_form">Commencer</button>
                </div>
            </section>

            <section id="form_step_diagnostic" class="container-fluid">
                <!-- Form : ajout beneficiaire -->
                <?php get_template_part( 'template/form_add_beneficiaire' ); ?>
            </section>
        <?php endif; ?>
    </article>

<?php
// ... more ...
get_footer();