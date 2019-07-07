// Initialiser jquery ui Tab
$( function() {
    $( "#block_content_centre" ).tabs();

    $("#moyenne_note a").click(function(){
        $(".tab").hide();
        $("#tab_review").show();
        $("#tab_list ul li").removeClass("ui-state-active");
        console.log($("#tab_list ul li").attr("aria-controls"));
        $("#tab_list ul li").each(function(){
            if($(this).attr("aria-controls") == 'tab_review'){
                $(this).addClass("ui-state-active")
            }
        })
    })

    $('.civility_choice').click(function(){
        $(".btn_submit_form_mer").removeAttr('disabled')
    })

} );

// Cacher les details de localisation si on est pas sur la tab de description
$('#tab_list ul li a').click(function(){
    href = $(this).attr('href');
    if(href != '#tab_description'){
        $("#localisation").hide()
    }else{
        $("#localisation").show()
    }
});

$(".btn_next_step_form").attr('disabled', 'disabled')