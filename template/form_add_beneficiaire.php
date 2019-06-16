<div id="form_vae_step">
    <?php
    $domaines = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}domaine_vae ORDER BY nom_dom_vae ASC", OBJECT );
    ?>
    <form id="form_add_beneficiaire" action='<?php echo admin_url( 'admin-post.php' ); ?>' method="post">
        <input type='hidden' name='action' value='submitFormAddBeneficiaire'/>
        <div class="modal-header">
            <button type="button" class="close close-form" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div id="block_progress_bar"><div id="progress_bar"></div></div>

            <div id="step_1" class="step">
                <p class="title"></p>
                <input type="text" name="zip" placeholder="Code postal" maxlength="5" class=""/>
            </div>

            <div id="step_2" class="step d-none">
                <select name="domaine_activite">
                    <option value="">Votre domaine d'activité</option>
                    <?php foreach ($domaines as $domaine) : ?>
                        <option value="<?php echo $domaine->nom_dom_vae ?>" data-id="<?php echo $domaine->id_dom_vae ?>"><?php echo $domaine->nom_dom_vae ?></option>
                    <?php endforeach; ?>
                </select>
                <select name="metiers">
                    <option value="">Votre métier de réference</option>
                </select>
            </div>

            <div id="step_3" class="step d-none">
                <p class="title">Combien d'année d'expérience dans votre domaine d'activité</p>
                <div class="row" id="experience_block">
                    <div class="experience_choice col-md-6 field_choice"><p>Moins d'un an</p></div>
                    <div class="experience_choice col-md-6 field_choice"><p>1 à 3 ans</p></div>
                    <div class="experience_choice col-md-6 field_choice"><p>4 à 9 ans</p></div>
                    <div class="experience_choice col-md-6 field_choice"><p>10 ans et plus</p></div>
                </div>
                <input type="hidden" name="experience" value="" />
            </div>

            <div id="step_4" class="step d-none">
                <p class="title">Quel est votre statut ?</p>
                <div class="row" id="status_block">
                    <div class="status_choice col-md-6 field_choice"><p>Salarié(e) du privé</p></div>
                    <div class="status_choice col-md-6 field_choice"><p>Salarié(e) du public</p></div>
                    <div class="status_choice col-md-6 field_choice"><p>Dirigeant, Indépendant</p></div>
                    <div class="status_choice col-md-6 field_choice"><p>Demandeur d'emploi</p></div>
                </div>
                <input type="hidden" name="status" value=""/>
            </div>

            <div id="step_5" class="step d-none">
                <p class="title">Quel niveau de diplôme souhaitez-vous obtenir ?</p>
                <div class="row" id="degree_block">
                    <div class="degree_choice col-md-6 field_choice"><p>Bac, Titre professionnel</p></div>
                    <div class="degree_choice col-md-6 field_choice"><p>Bac +2</p></div>
                    <div class="degree_choice col-md-6 field_choice"><p>Bac +3</p></div>
                    <div class="degree_choice col-md-6 field_choice"><p>Master et plus</p></div>
                </div>
                <input type="hidden" name="degree" value=""/>
            </div>

            <div id="step_6" class="step d-none">
                <p class="title">Quel diplôme souhaitez-vous obtenir idéalement ?</p>
                <input type="text" name="degree_wanted" placeholder="Le diplôme souhaité"/>
            </div>

            <div id="step_7" class="step d-none">
                <p class="title">Pour quelle raison souhaitez-vous faire une VAE ?</p>
                <div class="row" id="reason_block">
                    <div class="reason_choice col-md-4 field_choice"><p>Sécuriser mon parcours</p></div>
                    <div class="reason_choice col-md-4 field_choice"><p>Evoluer dans l'entreprise</p></div>
                    <div class="reason_choice col-md-4 field_choice"><p>Revalorisation salariale</p></div>
                    <div class="reason_choice col-md-4 field_choice"><p>Utiliser mon temps libre</p></div>
                    <div class="reason_choice col-md-4 field_choice"><p>Etape dans mon projet</p></div>
                    <div class="reason_choice col-md-4 field_choice"><p>Diplôme nécessaire</p></div>
                    <div class="reason_choice col-md-12"><input type="text" name="reason_other" placeholder="Autre"/></div>
                </div>
                <input type="hidden" name="reason" value=""/>
            </div>

            <div id="step_8" class="step d-none">
                <p class="title">Renseignez vos coordonées, un consultant vous contact dans l'heure</p>
                <select name="civility">
                    <option>Civilité</option>
                    <option value="M.">M.</option>
                    <option value="Mme">Mme</option>
                    <option value="Mlle">Mlle</option>
                </select>
                <input type="text" name="name" placeholder="Nom"/>
                <input type="text" name="surname" placeholder="Prénom" />
                <select name="time_preference">
                    <option>Plage horaire préféré</option>
                    <option value="Avant 12 heures">Avant 12 heures</option>
                    <option value="Entre 12 et 14 heures">Entre 12 et 14 heures</option>
                    <option value="Entre 14 et 16 heures">Entre 14 et 16 heures</option>
                    <option value="Après 16 heures">Après 16 heures</option>
                    <option value="Indifférent">Indifférent</option>
                </select>
            </div>

            <div id="step_9" class="step d-none">
                <p class="title">Renseignez vos coordonées, un consultant vous contact dans l'heure</p>
                <input type="email" name="email" placeholder="Email"/>
                <input type="tel" name="telephone" placeholder="Téléphone" maxlength="10"/>
            </div>
        </div>
        <div class="modal-footer" >
            <button type="button" class="btn btn_next_step_form" disabled="disabled">Suivant</button>
            <input type="hidden" name="formulaire_add_beneficiaire"/>
        </div>
    </form>
</div>


