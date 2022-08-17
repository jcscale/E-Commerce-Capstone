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


    var $table = $("table")
    rows = [],
    header = [];

    $table.find("thead th").each(function () {
        header.push($(this).html());
    });

    $table.find("tbody tr").each(function () {
        var row = {};
        
        $(this).find("td").each(function (i) {
            if($(this).find('input').val()) {

                var key = header[i],
                value = $(this).find('input').val();
                
            } else {
                var key = header[i],
                value = $(this).html();
            }  
            


            row[key] = value;
        });
        
        rows.push(row);
    });
        
    var hidden_json = JSON.stringify(rows)
    $('input#hidden_json').val(hidden_json)


    // console.log(JSON.stringify(rows));

});