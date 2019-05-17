<input type='hidden' name='action' value='submitFormDevenirAccompagnateur'/>
<div class="row" id="civility_block">
    <div class="civility_choice col-md-6"><p data-civility="Mme">Madame</p></div>
    <div class="civility_choice col-md-6"><p data-civility="M.">Monsieur</p></div>
</div>
<input type="hidden" name="civility" value="" required/>

<input type="text" name="name" placeholder="Nom" required/>
<input type="text" name="surname" placeholder="Prénom" required/>

<input type="email" name="email" placeholder="Email" required/>
<input type="tel" name="telephone" placeholder="Téléphone" maxlength="10" required/>


<select name="status" required>
    <option value="">Statut</option>
    <option value="Salarié(e) du privé">Salarié(e) du privé</option>
    <option value="Salarié(e) du public">Salarié(e) du public</option>
    <option value="Dirigeant, Indépendant">Dirigeant, Indépendant</option>
    <option value="Demandeur d'emploi">Demandeur d'emploi</option>
</select>

<textarea name="objectif" required rows="5" cols="33" placeholder="Contexte et Objectif de votre démarche ? ">
</textarea>

<input type="submit" class="btn btn_submit_form_mer" value="Valider">
<p style="font-size: 11px;text-align: center;margin-top: 6px;">gratuit & sans engagement</p>
<input type="hidden" name="formulaire_devenir_accompagnateur"/>


