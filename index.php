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
// Permet de communiquer avec la BDD
global $wpdb;
?>

    <div style="height:600px;overflow: hidden">
        <section id="search_block" class="text-uppercase"
                 style="background:url(<?php echo get_template_directory_uri() ?>/assets/image/img-principal.jpg) center no-repeat;background-size:cover;height: 1000px !important;">
            <!--    <img src="-->
            <?php //echo get_template_directory_uri() ?><!--/assets/image/img-principal.jpg" alt="Faire une validation des acquis professionnels avec Enthéor c’est trouver le bon accompagnement VAE" width="100%" />-->
            <div id="text_button_search" class="container text-uppercase">
                <div class="block_intro_search">
                    <p>Pour chaque projet VAE, un interlocuteur dédié.<br>
                        Trouvez le vôtre :
                    </p>
                </div>
                <p id="block_btn_to_access_search_center">
                    <button class="btn my-2 text-uppercase" id="btn_to_access_search_center_by_zip_france">En France
                    </button>
                    <button class="btn my-2 text-uppercase btn_to_access_search_bureau_a_distance"
                            id="btn_to_access_search_center_foreigner">A l'étranger
                    </button>
                </p>

                <div id="form_search_center_home" style="display: none;">
                    <form id="formulaire_search_center_home" action="<?php echo admin_url('admin-post.php'); ?>"
                          method="post">
                        <input type='hidden' name='action' value='searchCenter'/>
                        <input type="text" name="zip_search_center" id="zip_search_center"
                               placeholder="Code Postal (5 chiffres)" class="col-md-3" maxlength="5" required="required">
                        <input type="submit" name="search_center" value="Rechercher" id="zip_search_center_submit"
                               class="btn">
                    </form>
                    <p id="erreur_post_form" class="text-lowercase"
                       style="display: none;margin-right: 34%;font-size: 12px;">5 chiffres obligatoire</p>
                </div>

                <div id="form_search_center_foreigner_home" style="display: none;">
                    <form id="formulaire_search_center_foreigner_home"
                          action="<?php echo admin_url('admin-post.php'); ?>" method="post">
                        <input type='hidden' name='action' value='searchCenterForeigner'/>
                        <?php
                        // Lancement Curl pour récupérer liste des pays
                        $url = BASE_URL."api/countries";
                        $auth = "devEntheo:3E5_yu*C";
                        $curl = curl_init();
                        curl_setopt_array($curl, array(
                            CURLOPT_URL => $url,
                            CURLOPT_RETURNTRANSFER => true,
                            CURLOPT_ENCODING => "",
                            CURLOPT_MAXREDIRS => 10,
                            CURLOPT_TIMEOUT => 30,
                            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                            CURLOPT_CUSTOMREQUEST => "GET",
                            CURLOPT_POSTFIELDS => "",
                            CURLOPT_USERPWD => $auth,
                            CURLOPT_HTTPAUTH => CURLAUTH_BASIC,
                            CURLOPT_SSL_VERIFYHOST => false,
                            CURLOPT_SSL_VERIFYPEER => false
                        ));
                        $response = curl_exec($curl);
                        $err = curl_error($curl);
                        curl_close($curl);
                        if ($err) {
                            echo "cURL Error #:" . $err;
                        } else {
                            $result = (array)json_decode($response);
                        }
                        ?>

                        <select name="country" id="country_search" required>
                            <option value="">Pays</option>
                            <?php foreach ($result as $key => $name): ?>
                                <option value="<?php echo $key ?>"><?php echo $name ?></option>
                            <?php endforeach; ?>
                        </select>
                        <input type="text" name="city" id="city_search" required placeholder="Ville"/>
                        <input type="submit" name="search_center_foreigner" value="Rechercher"
                               id="zip_search_center_submit_2" class="btn">
                    </form>
                </div>

            </div>
        </section>
    </div>

    <section id="confirmation_mer" class="block_confirmation_mer" style="display: none">
        <span class="closed_popup">×</span>
        <p class="message_mail_sent">Votre demande d’information a bien été enregistrée.<br>Un consultant vous contacte dans la journée.</p>
    </section>

    <section id="three_step">
        <div class="container text-center">
            <h1 class="text-uppercase">Votre diplôme par la VAE en 3 étapes</h1>
            <p class="introduction">La VAE est un droit qui vous permet de faire valider les acquis de votre expérience
                en vue d'obtenir un diplôme, un titre ou un certificat de qualification. L'accompagnement à la VAE peut
                se dérouler pendant le temps de travail ou hors temps de travail, en présentiel ou à distance et est
                ouverte aux expatriés.</p>
            <div class="row">
                <div class="col-sm-6 col-md-4">
                    <picture>
                        <img src="<?php echo get_template_directory_uri() ?>/assets/image/icone-cv.png"
                             alt="Un accompagnement vae pour la rédaction de votre dossier vae livret 1"/>
                    </picture>
                    <p class="description_img"><span class="text-uppercase title">Livret 1 : votre cv </span><br><span
                                class="sub_title">Rendez votre démarche VAE officielle</span></p>
                </div>
                <div class="col-sm-6 col-md-4">
                    <picture>
                        <img src="<?php echo get_template_directory_uri() ?>/assets/image/icone-livret2.png"
                             alt="Justifiez de votre expérience professionnelle grâce au dossier vae livret 2"/>
                    </picture>
                    <p class="description_img"><span class="text-uppercase title">Livret 2 : vos compétences cv</span>
                        <br><span class="sub_title">Rendez votre démarche VAE officielle</span></p>
                </div>
                <div class="col-sm-6 col-md-4">
                    <picture>
                        <img src="<?php echo get_template_directory_uri() ?>/assets/image/icone-jury.png"
                             alt="Décrochez votre validation des acquis (VAE)"/>
                    </picture>
                    <p class="description_img"><span class="text-uppercase title">Passage devant le jury</span>
                        <br><span class="sub_title">Présenter votre dossier aux jurés</span></p>
                </div>
            </div>
            <button class="btn" id="btn_launch_form">+ Demande d'information</button>
        </div>
        <!-- Form : ajout beneficiaire -->
        <?php get_template_part('template/form_add_beneficiaire'); ?>

    </section>

    <section id="numbers">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6 col-md-3 numbers_detail">
                    <p>+ 40 consultants <br><span>à votre service</span></p>
                </div>
                <div class="col-sm-6 col-md-3 numbers_detail">
                    <p>500 diplômés <br><span>chaque année</span></p>
                </div>
                <div class="col-sm-6 col-md-3 numbers_detail">
                    <p>Réussite > 90% <br><span>Pourquoi pas vous ?</span></p>
                </div>
                <div class="col-sm-6 col-md-3 numbers_detail">
                    <p>15 bureaux <br><span>ou à distance</span></p>
                </div>
            </div>
        </div>
    </section>

    <section id="reviews" class="reviews">
        <div class="container">
            <h2 class="text-center">Ils racontent leur accompagnement VAE avec Enthéor</h2>
            <div class="row">
                <?php
                // Lancement Curl pour récupérer le bureau
                $url = BASE_URL."api/advices?limit=6";
                $auth = "devEntheo:3E5_yu*C";
                $curl = curl_init();
                curl_setopt_array($curl, array(
                    CURLOPT_URL => $url,
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => "",
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 30,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => "GET",
                    CURLOPT_POSTFIELDS => "",
                    CURLOPT_USERPWD => $auth,
                    CURLOPT_HTTPAUTH => CURLAUTH_BASIC,
                    CURLOPT_SSL_VERIFYHOST => false,
                    CURLOPT_SSL_VERIFYPEER => false
                ));
                $response = curl_exec($curl);
                $err = curl_error($curl);
                curl_close($curl);
                if ($err) {
                    echo "cURL Error #:" . $err;
                } else {
                    $result = json_decode($response);
                }
                ?>
                <div class="owl-carousel">
                    <?php foreach ($result as $avis) : ?>
                        <?php //var_dump($avis) ?>
                        <article class="block_review">
                            <div class="block_article">
                                <?php
                                $datePublishRaw = $avis->date;
                                $datePublishFinal = new DateTime($datePublishRaw);
                                ?>
                                <p class="date">
                                    <i>Avis VAE publié le <?php echo $datePublishFinal->format('d/m/Y') ?><br>
                                        Diplôme visé : <?php echo $avis->beneficiaire->diplomeVise ?>
                                    </i>
                                </p>
                                <p class="info_review">
                                    <i>
                                        <b>
                                            <span class="name"><?php echo $avis->beneficiaire->prenomConso ?></span><br>
                                            <span class="domain">VAE <?php echo $avis->beneficiaire->domaineVae ?></span>
                                        </b>
                                    </i>
                                </p>
                                <div class="note stars">
                                    <?php for ($j = 0; $j < 5; $j++) : ?>
                                        <?php if ($j < $avis->noteGlobale) : ?>
                                            <span class="star on"></span>
                                        <?php else : ?>
                                            <span class="star"></span>
                                        <?php endif; ?>
                                    <?php endfor; ?>
                                </div>
                                <p class="extract">
                                    <?php if (strlen($avis->commentaireGeneral) > 200) : ?>
                                        <i class="short_extract">"<?php echo substr($avis->commentaireGeneral, 0, 200); ?>
                                            ..."
                                            <br><span class="see_long_extract">Voir +</span>
                                        </i>
                                        <i class="long_extract"
                                           style="display: none">"<?php echo $avis->commentaireGeneral; ?> "
                                            <br><span class="see_short_extract">Voir -</span>
                                        </i>
                                    <?php else : ?>
                                        <i>"<?php echo substr($avis->commentaireGeneral, 0, 200); ?> "</i>
                                    <?php endif; ?>
                                </p>
                            </div>
                        </article>
                    <?php endforeach; ?>
                </div>
            </div>
            <div id="block_btn_more_reviews">
                <?php
                $category_id = get_cat_ID('temoignages');
                $category_link = get_category_link($category_id);
                ?>
                <a href="<?php echo home_url('/') ?>temoignages-vae" class="btn center" id="btn_more_reviews">+ Tous les
                    avis VAE</a>
            </div>
        </div>
    </section>

    <section id="trainer"
             style="background:url(<?php echo get_template_directory_uri() ?>/assets/image/accompagnateur-vae.jpg) center no-repeat;background-size:cover;">
        <?php $articleAccompagnateur = get_post(160); ?>
        <div id="block_trainer_text" class="container">
            <div class="col-md-8 offset-md-4 col-sm-12 offset-sm-0">
                <h2 class="text-uppercase">Devenez conseiller/accompagnateur VAE</h2>
                <p>
                    Vous avez le goût de l’humain, de l’accompagnement.
                    Vous avez acquis une posture d’accompagnant.
                    Nous vous proposons une nouvelle opportunité, celle d’accompagnée des candidats à la VAE. C’est
                    aujourd’hui une expertise rare, recherchée par les organismes de formation car la démarche VAE se
                    développe et encore peu de personnes formées aujourd’hui à cet outil.
                    <br><br>
                    Entheor propose une formation éligible au CPF, alliant théorie et pratique en 7 jours
                    <br><br>
                    Nous proposons 3 à 4 sessions par an, qui ont lieu sur Lyon ou Paris.
                    Après une approche théorique de la VAE sur 2 jours, vous êtes rapidement confronté à la réalité,
                    avec des premiers accompagnements, supervisés par un consultant expert.
                </p>
                <!--            <p>--><?php //echo $articleAccompagnateur->post_excerpt ?><!--</p>-->
                <a href="<?php echo get_permalink($articleAccompagnateur->ID) ?>" class="btn center" id="">+ Découvrez
                    le programme</a>
            </div>
        </div>
    </section>

    <section id="article_focus">
        <div class="container">
            <div class="row">
                <div class="owl-carousel">
                    <?php $articles = get_posts(array('category_name' => 'landing', 'post__in' => array(44, 42, 40))); ?>
                    <?php foreach ($articles as $article) : ?>
                        <article>
                            <div class="block_article">
                                <h2>
                                    <a href="<?php echo get_permalink($article->ID) ?>"><?php echo $article->post_title; ?></a>
                                </h2>
                                <a href="<?php echo get_permalink($article->ID) ?>">
                                    <picture
                                            style="background: url(<?php echo get_the_post_thumbnail_url($article->ID) ?>) no-repeat center;background-size: cover;"></picture>
                                </a>
                                <p class="extract">
                                    <?php echo (strlen($article->post_excerpt) > 240) ? substr($article->post_excerpt, 0, 240) . ' ...' : $article->post_excerpt; ?>
                                </p>
                                <a href="<?php echo get_permalink($article->ID) ?>" class="btn center btn_see_more"
                                   id="">+ En savoir plus</a>
                            </div>
                        </article>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>

    <section id="vae_distance"
             style="background:url(<?php echo get_template_directory_uri() ?>/assets/image/vae-distance-expat.jpg) center no-repeat;background-size:cover;">
        <div id="vae_distance_text" class="container">
            <div class="text-center">
                <h2 class="text-uppercase">VAE À DISTANCE & EXPATRIÉS</h2>
                <p>
                    Validez votre expérience professionnelle acquise à l’étranger.<br> Enthéor vous propose un
                    accompagnement VAE à distance.
                </p>
                <button class="btn center text-uppercase btn_to_access_search_bureau_a_distance">+ Faire un diagnostic
                    vae
                </button>
            </div>
        </div>
    </section>

    <section id="program"
             style="background:url(<?php echo get_template_directory_uri() ?>/assets/image/entheor-corporate.jpg) center no-repeat;background-size:cover;">
        <div id="block_program_text" class="container">
            <div class="col-md-8">
                <?php $articleVaeEntreprise = get_post(224); ?>
                <img src="<?php echo get_template_directory_uri(); ?>/assets/image/logo-entheor.png" alt="Logo Entheor"
                     width="90px"/>
                <h2 class="text-uppercase">LE PROGRAMME POUR<br> ACCOMPAGNER VOS COLLABORATEURS</h2>
                <p>
                    Pour les entreprises, la Valorisation des Acquis de l’Expérience (VAE) permet de valoriser son personnel en lui reconnaissant des savoirs et compétences acquis dans leurs métiers.<br>
                    La VAE est un outil de professionnalisation, un levier d’évolution et une marque de reconnaissance individuelle.
                </p>
                <a href="<?php echo get_permalink($articleVaeEntreprise->ID) ?>" class="btn center">+ Découvrez le
                    programme</a>
            </div>
        </div>
    </section>

    <section id="actu">
        <div class="container">
            <h2>Actualités VAE à la une</h2>
            <div class="row">
                <?php $actus_vae = get_posts(array('category_name' => 'actualites-vae', 'posts_per_page' => 3)); ?>
                <?php foreach ($actus_vae as $actu_vae) : ?>
                    <article class="col-sm-6 col-md-4">
                        <div class="block_article">
                            <a href="<?php echo get_permalink($actu_vae->ID) ?>">
                                <picture
                                        style="background: url(<?php echo get_the_post_thumbnail_url($actu_vae->ID) ?>) no-repeat center;background-size: cover;"></picture>
                            </a>
                            <h3>
                                <a href="<?php echo get_permalink($actu_vae->ID) ?>"><?php echo $actu_vae->post_title; ?></a>
                            </h3>
                            <p class="extract">
                                <?php echo (strlen($actu_vae->post_excerpt) > 240) ? substr($actu_vae->post_excerpt, 0, 240) . ' ...' : $actu_vae->post_excerpt; ?>
                            </p>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
            <?php
            // Get the ID of a given category
            $category_id = get_cat_ID('Actualités vae');
            // Get the URL of this category
            $category_link = get_category_link($category_id);
            ?>
            <a href="<?php echo $category_link ?>" class="btn center" id="btn_voir_plus_actu">+ Voir les actualités
                VAE</a>
        </div>
    </section>

    <section id="contact_us"
             style="background:url(<?php echo get_template_directory_uri() ?>/assets/image/contact-entheor.jpg) center no-repeat;background-size:cover;background-position-y: 100%;">
        <div id="contact_us_text" class="container">
            <div class="">
                <h2 class="text-uppercase">NOUS SOMMES LÀ POUR VOUS ACCOMPAGNER</h2>
                <p>Nos équipes vous répondent dans l’heure</p>
                <a href="<?php echo get_permalink(90) ?>" class="btn center">+ Envoyer un message</a>
            </div>
        </div>
    </section>

    <section id="best_degree" class="container-fluid">
        <div class="container">
            <h2 class="text-uppercase">Les diplômes les plus demandés par la vae</h2>
            <p class="introduction">
                Vous avez l’expérience mais n’avez pas le diplôme équivalent ? Offrez-vous cette chance grâce à la
                validation des acquis de l’expérience ! Trouvez parmi ces domaines, celui qui correspond à votre métier.
            </p>

            <div class="row">
                <?php $reviews = get_posts(array('category_name' => 'diplome-plus-demandes')); ?>
                <div class="owl-carousel" id="best_degree_block">
                    <?php foreach ($reviews as $review) : ?>
                        <div class="best_degree_by_domain_block">
                            <div class="best_degree_by_domain">
                                <h3><?php echo $review->post_title ?></h3>
                                <p><?php echo $review->post_content ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>

    <section id="training_around_you" class="container-fluid">
        <div class="container">
            <h2 class="text-uppercase">Un accompagnement à la vae près de chez vous ?</h2>
            <p class="introduction">
                ENTHEOR vous propose également un accompagnement VAE à distance et à destination des expatriés.
            </p>
            <div class="row">
                <?php $reviews = get_posts(array('category_name' => 'vae-pres-de-chez-vous')); ?>
                <div class="owl-carousel" id="training_around_you_block">
                    <?php
                    // Lancement Curl pour récupérer le bureau
                    $url = BASE_URL."api/offices";
                    $auth = "devEntheo:3E5_yu*C";
                    $curl = curl_init();
                    curl_setopt_array($curl, array(
                        CURLOPT_URL => $url,
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => "",
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 30,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => "GET",
                        CURLOPT_POSTFIELDS => "",
                        CURLOPT_USERPWD => $auth,
                        CURLOPT_HTTPAUTH => CURLAUTH_BASIC,
                        CURLOPT_SSL_VERIFYHOST => false,
                        CURLOPT_SSL_VERIFYPEER => false
                    ));
                    $response = curl_exec($curl);
                    $err = curl_error($curl);
                    curl_close($curl);
                    if ($err) {
                        echo "cURL Error #:" . $err;
                    } else {
                        $result = json_decode($response);
                    }
                    foreach ($result as $office) {
                        $regions[$office->ville->region][] = $office;
                    }
                    ?>
                    <?php foreach ($regions as $key => $offices) : ?>
                        <div class="training_around_you_by_city_block">
                            <div class="training_around_you_by_city">
                                <h3><?php echo $key ?></h3>
                                <?php foreach ($offices as $office) : ?>
                                    <p>
                                        <a href="/vae-<?php echo $office->ville->slugVille . "/" . $office->id ?>/"><?php echo ucfirst(strtolower($office->ville->nom)); ?></a>
                                    </p>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>

<?php get_footer(); ?>