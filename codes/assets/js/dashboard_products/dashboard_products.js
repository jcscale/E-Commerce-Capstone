$(document).ready(function(){
    $("#edit_modal").modal();
    // createPagination(0)

    // $('#products').on('click','.keychainify-checked',function(e){
    //   e.preventDefault(); 
    //   var pageNum = $(this).attr('data-ci-pagination-page');
    //   createPagination(pageNum);
    // });

    // function createPagination(pageNum) {
    //     $.get('/capstone/codes/dashboards/loadData/'+pageNum, function(res) {
    //       $('#products').html(res);
    //     });
    // }  

    // $(document).on('submit', 'form', function(e){
    //     e.preventDefault();
    //     $.post($(this).attr('action'), $(this).serialize(), function(data){
    //         console.log(data)
    //         $('#products').html(data);
    //     });
    //     return false;
    // });
    // $('form').submit();

    $(document).on('click', '#product_detail', function(e){
        e.preventDefault();
        $.get($(this).attr('href'), function(data) {
            console.log(data)   
            $('#edit_id').val(data.id);
            $('#edit_name').val(data.name);
            $('#edit_description').val(data.description);
            $('#edit_inventory_count').val(data.inventory_count);
            $('#edit_quantity_sold').val(data.quantity_sold);
        },'json');
    })
    



    $( function() {
        $( "#sortable" ).sortable();
    });

    $(".dropdown_input").prop('disabled', true);
    $(".dropdown_input").css('background-color', 'white');
    $(".dropdown_input").css('border', 'none');
    $('.pencil').css('visibility', 'hidden')
    $('.trash').css('visibility', 'hidden')
    // $('input#hide_id').val(123)
    // console.log( $('input#hide_id').val())

    $('.dropdown_li').each(function(){
        $(this).mouseover(function(e) {
            e.stopPropagation();
            $(this).css('background-color', 'yellow')
            $(this).find('input.dropdown_input').css('background-color', 'yellow')
            $(this).find('.pencil').css('visibility', 'visible')
            $(this).find('.trash').css('visibility', 'visible')
        }).mouseout(function(e) {
            e.stopPropagation();
            $(this).css("background-color", "white");
            $(this).find('input.dropdown_input').css('background-color', 'white')
            $(this).find('.pencil').css('visibility', 'hidden')
            $(this).find('.trash').css('visibility', 'hidden')
        });
    });

    $('.pencil').click(function() {
        $(this).parent().children().prop('disabled', false);
    });

    $('.dropdown_input').blur(function() {
        $(".dropdown_input").prop('disabled', true);
        $(".dropdown_input").css('border', 'none');
    });

    $('.dropdown_li').each(function(){
        $(this).click(function(e) {
            var category_name = $(this).find('input.dropdown_input').val();
            var category_id = $(this).find('input.hidden_id').val();
            $('#dropdownMenuButton1').text(category_name);
            $('input#hide_id').val(category_id);
            console.log( $('input#hide_id').val())
            e.stopPropagation();
        });
    });

    

});