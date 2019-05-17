<?php
/**
 * Template Name: Avis
 */
get_header();

// pour afficher la cover image de la page (qui est display none par defaut)
echo get_post()->post_content;
?>

<section id="reviews_page" class="category_page reviews">
    <div id="block_header_photo_landing" style="">
        <div id="overlay"></div>
        <h1>Ils racontent leur accompagnement VAE avec Enthéor</h1>
    </div>

    <div class="container">
        <div class="row">
            <?php
            
            $url = "https://appli.entheor.com/web/api/advices";

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

            <?php foreach($result as $avis) : ?>
                <?php //var_dump($avis) ?>
                <article class="block_review col-sm-6 col-md-4">
                    <div class="block_article">
                        <?php
                        $datePublishRaw = $avis->date;
                        $datePublishFinal = new DateTime($datePublishRaw);
                        ?>
                        <p class="date"><i>Avis publié le <?php echo $datePublishFinal->format('d/m/Y') ?></i></p>

                        <!--<picture>
                            <img class="block_profile_img" src="" alt="Photo de la personne témoignant"/>
                        </picture>-->
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
                            <?php if(strlen($avis->commentaireGeneral) > 200) : ?>
                                <i class="short_extract">"<?php echo substr($avis->commentaireGeneral, 0, 200); ?> ..."
                                    <br><span class="see_long_extract">Voir +</span>
                                </i>
                                <i class="long_extract" style="display: none">"<?php echo $avis->commentaireGeneral; ?> "
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
</section>

<?php get_footer(); ?>