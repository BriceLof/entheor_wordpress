// Initialiser jquery ui Tab
$( function() {
    $( "#block_content_centre" ).tabs();
} );

// Cacher les details de localisation si on est pas sur la tab de description
$('#tab_list ul li a').click(function(){
    href = $(this).attr('href')
    if(href != '#tab_description'){
        $("#localisation").hide()
    }else{
        $("#localisation").show()
    }
})