$(document).ready(function () {

    // Caroussel
    $('.owl-carousel').owlCarousel({
        loop: true,
        margin: 10,
        responsiveClass: true,
        nav: true,
        responsive: {
            0: {
                items: 1,
            },
            600: {
                items: 1,
            },
            1000: {
                items: 3,
            }
        }
    })
    // FIN Caroussel

    // Formulaire recherche de bureau HOME
    $('#btn_to_access_search_center_by_zip_france').click(function () {
        $("#block_btn_to_access_search_center").hide()
        $("#form_search_center_home").show()
    })

    $('#btn_to_access_search_center_foreigner').click(function () {
        $("#block_btn_to_access_search_center").hide()
        $("#form_search_center_foreigner_home").show()
    })

    $("#formulaire_search_center_home").validate({
        rules: {
            "zip_search_center": {
                required: true,
                digits: true,
                remote: {
                    url: 'https://appli-dev.entheor.com/web/api/cities',
                    type: 'get',
                    contentType: "application/json",
                    data: {
                        zip: function () {
                            return $("#zip_search_center").val();
                        }
                    },
                    dataFilter: function (data) {
                        if (JSON.parse(data).length == 0){
                            return "false";
                        }
                        return "true";
                    }
                }
            }
        }
    })

    // Formulaire en étapes Home
    $("#btn_launch_form").click(function () {
        $("#form_vae_step").show();
        $("#btn_launch_form").hide()
        $('html,body').animate({scrollTop: $("#form_vae_step").offset().top}, 'slow');
    })
    $(".close-form").click(function () {
        $("#form_vae_step").hide();
        $("#btn_launch_form").show()

        // Effacer toutes les valeurs du form en le fermant
        clearForm($("#form_add_beneficiaire"));
        $("#form_add_beneficiaire .step").each(function () {
            $(this).addClass('d-none');
        });
        $("#form_add_beneficiaire #step_1").removeClass('d-none');
    })
    // FIN Formulaire en étapes Home

    // Afficher image de cover sur page de category ou article
    if ($('.cover_img').length > 0) {
        url_img_cover = $('.cover_img').attr('src')
        $('#block_header_photo_landing').css('background', 'url(' + url_img_cover + ') no-repeat center')
    }
    if ($('.cover_img img').length > 0) {
        url_img_cover = $('.cover_img img').attr('src')
        $('#block_header_photo_landing').css('background', 'url(' + url_img_cover + ') no-repeat center')
    }
    // FIN Afficher image de cover sur page de category ou article

    // Menu : afficher icone contact
    //url_start = document.location.origin+"/entheor_wordpress/"
    url_start = document.location.origin + "/entheor_wordpress_production/wordpress/"
    $("header nav li, #responsive-menu-container ul li").each(function () {
        if ($(this).find('a').text() == 'Contact') {
            $(this).find('a').text('')
            $(this).find('a').append('<img src="' + url_start + '/wp-content/themes/entheor/assets/image/icon_contact.png" width="24px" />')
        }
    })

    // Transformer mon menu en dropdown de boostrap lorsque j'ai un sous-menu
    $(document).ready(function () {
        $("ul.sub-menu").parent().addClass("dropdown");
        $("ul.sub-menu").addClass("dropdown-menu");
        $("ul#menuid li.dropdown a").addClass("dropdown-toggle");
        $("ul.sub-menu li a").removeClass("dropdown-toggle");
        $('.navbar .dropdown-toggle').append('');
        $('a.dropdown-toggle').attr('data-toggle', 'dropdown');
    });
    $(".menu-item").mouseover(function () {
        $(this).find(".sub-menu").show();
    })
    .mouseout(function () {
        $(this).find(".sub-menu").hide();
    });
    // FIN Menu : afficher icone contact

    // Avis : voir + ou - l'extrait
    $(".see_long_extract").click(function () {
        short_extract = $(this).parent('.short_extract')
        long_extract = $(this).closest('.extract').find('.long_extract')
        short_extract.hide()
        long_extract.show()
    })
    $(".see_short_extract").click(function () {
        long_extract = $(this).parent('.long_extract')
        short_extract = $(this).closest('.extract').find('.short_extract')
        long_extract.hide()
        short_extract.show()
    })
    // FIN Avis : voir + ou - l'extrait

    // Autocomplete code postal
    autocompleteZip($('#zip_search_center'));
    autocompleteZip($('#form_mer_zip'));
    autocompleteCity($('#city_search'), $('#country_search'));

    $("#form_mise_en_relation").validate({
        ignore: ":hidden:not(.my-item)",
        invalidHandler: function (form, validator) {
            var errors = validator.numberOfInvalids();
            if (errors) {
                if (!$(validator.errorList[0].element).is(":visible")) {

                }
            }
        }
    });
    $("#formulaire_search_center_foreigner_home").validate();

    $("#country_search").on('change', function () {
        $("#city_search").val("");
    });

    $("#city_search").on('keyup', function (e) {
        if (e.which != 9)
            $(this).attr("data-error", "true");
    });

    $("#email").rules("add", {
        required: true,
        email: true
    })

    $("#city_search").rules("add", {
        required: true,
        min: {
            param: 500,
            depends: function (element) {
                return $("#city_search").attr("data-error") == "true";
            }
        }
    });
    // FIN Autocomplete code postal

    // Message validation mise en relation
    if (window.location.hash != '' && window.location.hash == "#confirmation_mer") {
        $("#block_confirmation_mer").show()
        setTimeout(function () {
            $("#block_confirmation_mer").hide()
        }, 4000);
    }
    // FIN Message validation mise en relation

});

function autocompleteCity(el, country) {
    $(el).autocomplete({
        source: function (requete, reponse) {
            $.ajax({
                url: 'https://appli.entheor.com/web/api/places',
                cache: true,
                type: 'GET',
                contentType: "application/json",
                data: {
                    "term": $(el).val(),
                    "region": $(country).val()
                },
                crossDomain: true,
                success: function (data) {
                    console.log(data);
                    reponse($.map(data, function (item) {
                        return {
                            value: function () {
                                city = item.city;
                                return item.name;
                            }
                        }
                    }));
                },
                error: function (data) {
                    console.log(data)
                }
            });
        },
        minLength: 3,
        select: function (event, ui) {
            event.preventDefault();
            $(el).val(city);
            $(el).attr("data-error", "false");
        },
        open: function () {
            console.log($(this).attr('id'));
            $('.ui-menu').outerWidth($(this).outerWidth());
            $('.ui-menu').css({
                "background-color": "white",
                "list-style": "none",
                "border-radius": "4px",
                "margin-top": "1px",
                "padding-left": "15px",
                "padding-top": "3px",
                "padding-bottom": "3px",
                "font-size": "17px",
                "border": "1px solid #97bd12"
            });
            $('.ui-menu li').css({
                "cursor": "pointer"
            });
            $('.ui-menu li:hover').css({
                "background-color": "aliceblue"
            })
        }
    });
}

function autocompleteZip(el) {
    $(el).autocomplete({
        source: function (requete, reponse) {
            $.ajax({
                url: 'https://appli.entheor.com/web/api/cities', // le nom du fichier indiqué dans le formulaire
                cache: true,
                type: 'GET',
                contentType: "application/json",
                data: {
                    "zip": $(el).val()
                },
                crossDomain: true,
                success: function (data) {
                    reponse($.map(data, function (item) {
                        return {
                            value: function () {
                                cp = item.cp;
                                return item.cp + " (" + item.nom + ")";
                            }
                        }
                    }));
                },
                error: function (data) {
                    console.log(data)
                }
            });
        },
        minLength: 3,
        select: function (event, ui) {
            event.preventDefault();
            $(el).val(cp);
        },
        change: function (event, ui) {
            console.log("this.value: " + this.value);
        },
        open: function () {
            console.log($(this).attr('id'));
            $('.ui-menu').outerWidth($(this).outerWidth());
            $('.ui-menu').css({
                "background-color": "white",
                "list-style": "none",
                "border-radius": "4px",
                "margin-top": "1px",
                "padding-left": "15px",
                "padding-top": "3px",
                "padding-bottom": "3px",
                "font-size": "17px",
                "border": "1px solid #97bd12"
            });
            $('.ui-menu li').css({
                "cursor": "pointer"
            });
            $('.ui-menu li:hover').css({
                "background-color": "aliceblue"
            })
        }
    });
}

function clearForm(form) {
    $("#progress_bar").css("width", "20%")
    // suppresion de toutes les valeurs input sauf un qui me sert pour la validation du form (lié au function.php)
    $(form).find("input").each(function () {
        if ($(this).attr('name') != 'action') {
            $(this).val("");
        }
    });
    $(form).find("select[name='metiers'] option").each(function (index) {
        if (index > 0) {
            $(this).remove()
        }
    })
    $(form).find(".field_choice p").each(function () {
        $(this).css('border', '1px solid #97bd12')
    })

    $(form).find("select").each(function () {
        $(this).find('option:selected').removeAttr('selected')
    })
}