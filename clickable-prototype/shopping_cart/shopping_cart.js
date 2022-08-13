$(document).ready(function(){
    $(".td_input").prop('disabled', true);
    $(".td_input").css('border', 'none');

    $('.td_update').click(function() {
        // console.log($(this).parent().children().children().val())
        $(this).parent().children().children().prop('disabled', false);
        $(this).parent().children().children().css('border', '1px solid black');
    });

    $('.td_input').blur(function() {
        $(".td_input").prop('disabled', true);
        $(".td_input").css('border', 'none');
    });
});