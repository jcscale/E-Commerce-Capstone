$(document).ready(function(){
    console.log('ready')
    var table= $('#empTable').DataTable({
        "sDom":"ltipr",
        "searching": true,   // Search Box will Be Disabled
        "ordering": false,    // Ordering (Sorting on Each Column)will Be Disabled
        "info": false,         // Will show "1 to n of n entries" Text at bottom
        "lengthChange": false, // Will Disabled Record number per page
        "pageLength": 2,
        
    });

    $('#search_table').on( 'keyup', function () {
        table.search( this.value ).draw();
    } );


    
});

