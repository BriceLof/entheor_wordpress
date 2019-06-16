<?php
/**
 * Template Name: Bureau
 */
get_header();

// Permet de recuperer param dans url
global $wp_query;
$idBureau = $wp_query->query_vars['id_bureau'];

global $wp;
$currentUrl = home_url( $wp->request );

// Permet de communiquer avec la BDD
global $wpdb;


// Lancement Curl pour récupérer le bureau
$url = "https://appli.entheor.com/web/api/offices/".$idBureau;

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
    //var_dump($result);
}

?>
    <input type="hidden" value="<?php echo $currentUrl ?>" name="current_url">
    <article>
        <div id="block_header_photo" style="background: url(https://appli.entheor.com/web/uploads/bureau/<?php echo $result->banner ?>) no-repeat center;background-size: cover;">
            <div id="overlay"></div>
            <?php
            if ( function_exists('yoast_breadcrumb') ) {
                yoast_breadcrumb( '<p id="breadcrumbs">','</p>' );
            }
            ?>
            <h1>Accompagnement VAE à <?php echo ucfirst(strtolower($result->ville->nom)); ?></h1>
            <h2>avec le cabinet ENTHEOR</h2>
            <div id="note">
                <?php
                $notesTotal = 0;
                $nombreBeneficiaire = count($result->beneficiaires);
                $nombreAvis = 0;
                foreach($result->beneficiaires as $beneficiaire){
                    if(count($beneficiaire->avis) > 0){
                        $noteBeneficiaire = $beneficiaire->avis[0]->noteGlobale;
                        $notesTotal = $notesTotal + $noteBeneficiaire;
                        $nombreAvis++;
                    }else{
                        $nombreBeneficiaire = $nombreBeneficiaire - 1;
                    }
                }

                $noteToDisplay = 0;
                if($notesTotal > 0){
                    $noteToDisplay = $notesTotal / $nombreBeneficiaire;
                }
                ?>

                <div id="moyenne_note_stars" class="stars">
                    <?php for ($i = 0; $i < 5 ; $i++) : ?>
                        <?php if ($i < ((int)$noteToDisplay/1)) : ?>
                            <span class="star on"></span>
                        <?php elseif ( round($noteToDisplay) == ($i + 1) ): ?>
                            <span class="star half"></span>
                        <?php else: ?>
                            <span class="star"></span>
                        <?php endif; ?>
                    <?php endfor; ?>
                </div>
                <p id="moyenne_note"><?php echo ($noteToDisplay > 0) ? round($noteToDisplay, 1).'/5 sur '.$nombreAvis.' <a href="#tab_review">avis</a>' : '' ?></p>
            </div>
        </div>

        <section id="content" class="container">
            <div class="row">
                <div id="block_content_centre" class="col-md-9">
                    <div class="row">
                        <nav id="tab_list">
                            <ul>
                                <li><a href="#tab_description"><?php echo $result->nombureau ?></a></li>
                                <li><a href="#tab_trainer">L'équipe</a></li>
                                <li><a href="#tab_review">Avis VAE</a></li>
                            </ul>
                        </nav>
                    </div>
                    <div class="row">
                        <div id="content_block" class='col-md-12'>
                            <div id="tab_description" class="content tab">
                                <p><?php echo $result->intro ?></p>
                                <p><?php echo $result->content ?></p>
                                <div class="row">
                                    <?php if(!is_null($result->firstImage) && $result->firstImage != '') : ?>
                                        <div class="col-md-8 col-sm-12 img_focus">
                                            <img class="" width="100%" src="https://appli.entheor.com/web/uploads/bureau/<?php echo $result->firstImage ?>" />
                                        </div>

                                    <?php endif; ?>

                                    <div class="col-md-4 col-sm-12 block_img_then">
                                        <div class="row">
                                            <?php if(!is_null($result->secondImage) && $result->secondImage != '') : ?>
                                                <div class="col-md-12">
                                                    <img class="" width="100%" src="https://appli.entheor.com/web/uploads/bureau/<?php echo $result->secondImage ?>" />
                                                </div>

                                            <?php endif; ?>
                                            <?php if(!is_null($result->thirdImage) && $result->thirdImage != '') : ?>
                                                <div class="col-md-12">
                                                    <img class="" width="100%" src="https://appli.entheor.com/web/uploads/bureau/<?php echo $result->thirdImage ?>" />
                                                </div>

                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div id="tab_trainer" class="tab">
                                <p id="title">Nos consultants vous reçoivent pour votre projet VAE</p>
                                <?php foreach($result->consultants as $consultant) : ?>
                                    <article style="overflow: hidden;">
                                        <div class="row">
                                            <?php if($consultant->image != '' && !is_null($consultant->image)) : ?>
                                                <div class="img_profile_trainer col-md-3" style="background: url(https://appli.entheor.com/web/uploads/profile/<?php echo $consultant->id.'/'.$consultant->image ?>) no-repeat center;background-size: cover;"></div>
                                            <?php endif; ?>
                                            <div class="description_trainer <?php echo ($consultant->image != '' && !is_null($consultant->image)) ? 'col-md-9' : 'col-md-12' ?>">
                                                <p class="trainer_name"><?php echo $consultant->prenom.' '.$consultant->nom ?></p>
                                                <p class="trainer_detail"><?php echo $consultant->description ?></p>
                                            </div>
                                        </div>
                                    </article>
                                <?php endforeach; ?>
                            </div>

                            <div id="tab_review" class="tab">
                                <?php foreach($result->beneficiaires as $beneficiaire) : ?>
                                    <?php //var_dump($beneficiaire) ?>
                                    <?php if(count($beneficiaire->avis) > 0) : ?>
                                        <article>
                                            <?php
                                            $datePublishRaw = $beneficiaire->avis[0]->date;
                                            $datePublishFinal = new DateTime($datePublishRaw);
                                            ?>
                                            <p class="date">Avis VAE publié le <?php echo $datePublishFinal->format('d/m/Y') ?></p>
                                            <div class="note stars">
                                                <?php for ($j = 0; $j < 5; $j++) : ?>
                                                    <?php if ($j < $beneficiaire->avis[0]->noteGlobale) : ?>
                                                        <span class="star on"></span>
                                                    <?php else : ?>
                                                        <span class="star"></span>
                                                    <?php endif; ?>
                                                <?php endfor; ?>
                                            </div>
                                            <p class="reviewer">
                                                <i>
                                                    <b>
                                                        <span class="name"><?php echo $beneficiaire->prenomConso ?></span>,
                                                        <span class="reviewer_domain">VAE <?php echo $beneficiaire->domaineVae ?></span>
                                                    </b>
                                                </i>
                                            </p>

                                            <p class="detail_review">
                                                <i>"<?php echo $beneficiaire->avis[0]->commentaireGeneral ?>"</i>
                                            </p>
                                        </article>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <aside class="col-md-3">
                    <div class="row">
                        <p class="col-md-12" id="etre_rappele">Être rappelé</p>
                        <!-- Form : ajout beneficiaire -->
                        <div id="form_mer">
                            <form id="form_mise_en_relation" action='<?php echo admin_url( 'admin-post.php' ); ?>' method="post">
                                <input type="hidden" name="bureau" value="<?php echo $result->id ?>"/>
                                <?php
                                set_query_var( 'idOffice', $result->id );
                                get_template_part( 'template/form_mer');
                                ?>
                            </form>
                        </div>

                    </div>
                </aside>
            </div>
            <div class="row" id="localisation">
                <div id="block_map" class="col-md-9">
                    <div id="map"></div>
                </div>
                <aside class="col-md-3">
                    <div class="row">
                        <div id="information_place" class="col-md-12">
                            <p class="text-uppercase title">adresse</p>
                            <ul>
                                <li class=""><?php echo $result->adresse."<br>".ucfirst(strtolower($result->ville->cp." ".$result->ville->dpt)); ?></li>
                            </ul>
                            <?php if($result->acces != '' && !is_null($result->acces)) : ?>
                                <p class="text-uppercase title">accès</p>
                                <ul>
                                    <li class=""><?php echo $result->acces ?></li>
                                </ul>
                            <?php endif; ?>
                        </div>
                    </div>
                </aside>
            </div>
        </section>
    </article>

    <section id="diagnostic" class="container-fluid">
        <div class="container text-center">
            <h3 class="text-uppercase"><b>Votre diagnostic vae avec <?php echo $result->nombureau ?></b></h3>
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
        <?php include 'form_add_beneficiaire.php'; ?>
    </section>

    <script>
        var adress = {lat: <?php echo $result->ville->latitude ?>, lng: <?php echo $result->ville->longitude ?>};
        function initMap() {
            // The location of Uluru

            // The map, centered at Uluru
            var map = new google.maps.Map(
                document.getElementById('map'), {zoom: 13, center: adress});
            // The marker, positioned at Uluru
            var marker = new google.maps.Marker({position: adress, map: map});
        }
    </script>

<?php
// ... more ...
get_footer();