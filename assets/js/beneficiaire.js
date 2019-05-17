$( function() {
    // formulaire de mise en relation Home + Bureau
    form = $("#form_add_beneficiaire")

    block_zipcode = form.find('#step_1')
    block_domaine_metier = form.find('#step_2')
    block_experience = form.find('#step_3')
    block_statut = form.find('#step_4')
    block_diplome = form.find('#step_5')
    block_diplome_ideal = form.find('#step_6')
    block_raison = form.find('#step_7')
    block_coordonnee_part1 = form.find('#step_8')
    block_coordonnee_part2 = form.find('#step_9')

    // 1 : Zipcode
    form.find('#step_1 input').keyup(function() {
        if($(this).val().length == 5){
            $(".btn_next_step_form").removeAttr('disabled')
            // 2 : Domaine et métier
            $(".btn_next_step_form").click(function(){
                $("#progress_bar").css("width", "20%")
                $(".btn_next_step_form").attr('disabled', 'disabled')

                $('.step').addClass('d-none')

                block_domaine_metier.removeClass('d-none')

                domaine_activite = ''
                metier = ''
                // je me sert du unbind() car sinon l'ajax est lancé 2 fois et je ne sais pas pourquoi mais ça résout le soucis
                $("#step_2 select").unbind("change").change(function() {

                    if($(this).attr('name') == 'domaine_activite')
                    {
                        $('select[name=metiers]').empty().append('<option>Votre métier de réference</option>');
                        domaine_activite = $(this).find('option:selected').val()
                        id_domaine_vae = $(this).find('option:selected').data('id')
                        jQuery.post(
                            ajaxurl,
                            {
                                'action': 'domaine_metier_vae_ajax',
                                'id_domaine_vae': id_domaine_vae
                            },
                            function(response){
                                result = JSON.parse(response)
                                console.log(result);
                                for (i = 0; i < result.length; i++) {
                                    $('select[name=metiers]').append(
                                        '<option value="'+result[i].name_metier+'">'+result[i].name_metier+'</option>'
                                    )
                                }
                            }
                        );
                    }
                    if($(this).attr('name') == 'metiers')
                    {
                        metier = $(this).find('option:selected').val()
                    }

                    // 3 : Expérience
                    if(domaine_activite != '' && metier != '')
                    {
                        $(".btn_next_step_form").removeAttr('disabled')

                        $(".btn_next_step_form").click(function(){
                            $("#progress_bar").css("width", "20%")
                            $(".btn_next_step_form").attr('disabled', 'disabled')

                            $('.step').addClass('d-none')

                            block_experience.removeClass('d-none')
                            block_experience.find('.experience_choice').click(function(){
                                block_experience.find('.experience_choice p').css('border', '1px solid #97bd12')
                                $(".btn_next_step_form").removeAttr('disabled')

                                $(this).find('p').css('border', '3px solid #97bd12')

                                experience = $(this).text()
                                $('input[name=experience]').val(experience)

                                // 4 : Statut
                                $(".btn_next_step_form").click(function(){
                                    $(".btn_next_step_form").attr('disabled', 'disabled')

                                    $('.step').addClass('d-none')

                                    block_statut.removeClass('d-none')
                                    block_statut.find('.status_choice').click(function(){
                                        block_statut.find('.status_choice p').css('border', '1px solid #97bd12')
                                        $(".btn_next_step_form").removeAttr('disabled')

                                        $(this).find('p').css('border', '3px solid #97bd12')

                                        statut = $(this).text()
                                        $('input[name=status]').val(statut)
                                    })

                                    // 5 : Diplome
                                    $(".btn_next_step_form").click(function(){
                                        $("#progress_bar").css("width", "50%")
                                        $(".btn_next_step_form").attr('disabled', 'disabled')

                                        $('.step').addClass('d-none')

                                        block_diplome.removeClass('d-none')
                                        block_diplome.find('.degree_choice').click(function(){
                                            block_diplome.find('.degree_choice p').css('border', '1px solid #97bd12')
                                            $(".btn_next_step_form").removeAttr('disabled')

                                            $(this).find('p').css('border', '3px solid #97bd12')

                                            diplome = $(this).text()
                                            $('input[name=degree]').val(diplome)

                                        })

                                        // 6 : Diplome ideal
                                        $(".btn_next_step_form").click(function(){
                                            $("#progress_bar").css("width", "50%")
                                            $(".btn_next_step_form").attr('disabled', 'disabled')

                                            $('.step').addClass('d-none')

                                            block_diplome_ideal.removeClass('d-none')

                                            block_diplome_ideal.find('input').keyup(function(){
                                                if($(this).val().length > 0){
                                                    $(".btn_next_step_form").removeAttr('disabled')

                                                }
                                            })

                                            // 7 : Raison pour faire VAE
                                            $(".btn_next_step_form").click(function(){
                                                $("#progress_bar").css("width", "75%")
                                                $(".btn_next_step_form").attr('disabled', 'disabled')

                                                $('.step').addClass('d-none')

                                                block_raison.removeClass('d-none')

                                                block_raison.find('.reason_choice').click(function(){
                                                    $("#progress_bar").css("width", "75%")
                                                    block_raison.find('.reason_choice p').css('border', '1px solid #97bd12')
                                                    $(".btn_next_step_form").removeAttr('disabled')

                                                    $(this).find('p').css('border', '3px solid #97bd12')

                                                    raison = $(this).text()
                                                    $('input[name=reason]').val(raison)

                                                })

                                                block_raison.find('input').keyup(function(){
                                                    if($(this).val().length > 0){
                                                        $(".btn_next_step_form").removeAttr('disabled')

                                                        raison = $(this).val()
                                                        $('input[name=reason]').val(raison)
                                                    }
                                                })

                                                // 8 : Coordonnée part 1
                                                $(".btn_next_step_form").click(function() {
                                                    $("#progress_bar").css("width", "100%")
                                                    $(".btn_next_step_form").attr('disabled', 'disabled')

                                                    $('.step').addClass('d-none')

                                                    block_coordonnee_part1.removeClass('d-none')

                                                    civilite = ''
                                                    plage_horaire = ''
                                                    $("#step_8 select").change(function () {
                                                        if ($(this).attr('name') == 'civility') {
                                                            civilite = $(this).find('option:selected').val()
                                                        }
                                                        if ($(this).attr('name') == 'time_preference') {
                                                            plage_horaire = $(this).find('option:selected').val()
                                                        }

                                                        // 9 : Coordonnée part 2
                                                        if (civilite != '' && plage_horaire != '') {
                                                            $(".btn_next_step_form").removeAttr('disabled')

                                                            $(".btn_next_step_form").click(function() {
                                                                $(".btn_next_step_form").attr('disabled', 'disabled')

                                                                $('.step').addClass('d-none')

                                                                block_coordonnee_part2.removeClass('d-none')

                                                                email = ''
                                                                telephone = ''
                                                                block_coordonnee_part2.find('input').keyup(function(){

                                                                    if($(this).attr('name') == 'email')
                                                                    {
                                                                        email = $(this).val()
                                                                    }
                                                                    if($(this).attr('name') == 'telephone')
                                                                    {
                                                                        telephone = $(this).val()
                                                                    }

                                                                    if (email != '' && telephone != '') {

                                                                        $(".btn_next_step_form").text('Valider')
                                                                        $(".btn_next_step_form").removeAttr('disabled')

                                                                        // Final : validation du formulaire
                                                                        $(".btn_next_step_form").click(function() {
                                                                            $( "#form_add_beneficiaire" ).submit();
                                                                        })


                                                                    }
                                                                })
                                                            })
                                                        }
                                                    })
                                                })
                                            })
                                        })
                                    })
                                })
                            })
                        })
                    }
                });
            })
        }
    });


    // formulaire de mise en relation  Bureau
    form_mer = $("#form_mer")
    form_mer.find('.civility_choice').click(function(){
        form_mer.find('p').removeClass('selected')
        $(this).find('p').addClass('selected')
        civility = $(this).find('p').data('civility')
        $('input[name=civility]').val(civility)
    })
});