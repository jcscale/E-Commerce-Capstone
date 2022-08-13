$(document).ready(function() {
    $( function() {
        $( "#sortable" ).sortable();
    });

    $('.dropdown_li').mouseover(function() {
        $(this).css('background-color', 'yellow')
        $(this).children('.pencil').css('visibility', 'visible')
        $(this).children('a').css('visibility', 'visible')
        
    }).mouseout(function() {
        $(this).css("background-color", "white");
        $(this).children('.pencil').css('visibility', 'hidden')
        $(this).children('a').css('visibility', 'hidden')
    });

    $('.dropdown_li').click(function(e) {
        var category_name = $(this).children().text();
        $('#dropdownMenuButton1').text(category_name);
        e.stopPropagation();
    })

    $('.pencil').click(function() {
        $(this).parent().children('.dropdown_p').hide()
        // $(this).parent().children('.dropdown_input').css('visibility', 'visible')
        $(this).parent().children('.dropdown_input').prop('type', 'text')
    });

    $('.dropdown_input').blur(function(){
        console.log('lost')
        $(this).parent().children('.dropdown_p').show()
        $(this).parent().children('.dropdown_input').prop('type', 'hidden')
        // $(this).parent().children('.dropdown_input').css('visibility', 'hidden')
    });

   
});