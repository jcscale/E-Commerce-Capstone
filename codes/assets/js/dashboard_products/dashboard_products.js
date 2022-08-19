$(document).ready(function(){

    var table= $('#empTable').DataTable({
        "sDom":"ltipr",
        "searching": true,   // Search Box will Be Disabled
        "ordering": false,    // Ordering (Sorting on Each Column)will Be Disabled
        "info": false,         // Will show "1 to n of n entries" Text at bottom
        "lengthChange": false, // Will Disabled Record number per page
        "pageLength": 10
        
    });

    $('#search_table').on( 'keyup', function () {
        table.search( this.value ).draw();
    } );


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
        console.log($(this).attr('href'))
        $.get($(this).attr('href'), function(data) {
            console.log(data)
            // data = JSON.stringify(data);
            // console.log(data)
            var sor = ""
            for(var i in data.images) {
                // console.log(data.images[i])
                sor += '<li class="ui-state-default"><span class="ui-icon ui-icon-grip-solid-horizontal ms-3"></span><img class="ms-3 me-3" src="'+ 'http://localhost/capstone/codes/uploads/'+ data.images[i].filename +'" alt="" width="50" height="50">'+ data.images[i].filename +'<span class="ui-icon ui-icon-trash ms-5"></span></li>'
                // $("ul#sortable").append('<li class="ui-state-default"><span class="ui-icon ui-icon-grip-solid-horizontal ms-3"></span><img class="ms-3 me-3" src="'+ 'http://localhost/capstone/codes/uploads/'+ data.images[i].filename +'" alt="" width="50" height="50">'+ data.images[i].filename +'<span class="ui-icon ui-icon-trash ms-5"></span></li>')
            }

            $("ul#sortable").html(sor)
            $('#edit_id').val(data.res.id);
            $('#edit_name').val(data.res.name);
            $('#edit_description').val(data.res.description);
            $('#edit_price').val(data.res.price);
            $('#edit_inventory_count').val(data.res.inventory_count);
            $('#edit_quantity_sold').val(data.res.quantity_sold);
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

        // $("#search_word").blur(function() {
    //     // console.log($(this).parent().parent().attr('action'))
    //     $.post($(this).parent().parent().attr('action'), $(this).parent().parent().serialize(), function(data) {
    //         console.log(data);
    //         $('.product_list').html(data)
    //     })
    // });

    // console.log('ready')
    // $("#add_new_category").blur(function(){
    //     var form = $(this).parent().parent()
    //     $.post(form.attr('action'), form.serialize(), function(data) {
    //         console.log(data)
    //     })
    // });

});