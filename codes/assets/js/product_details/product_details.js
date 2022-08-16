$(document).ready(function(){
   

    $(".btn").click(function(e){
        var product_price = $("#product_price").text();
        var convert_to_float = parseFloat(product_price.slice(2,7))
        console.log(convert_to_float)

        var quantity = $("#product_quantity").val()
        console.log(quantity)
    });

    // $("#product_quantity").on("change keyup", function() {

    //     var quantity = $(this).val()
    //     var product_price = $(this).parent().find("#product_price").text();
    //     var convert_to_float = parseFloat(product_price.slice(2,7))
    //     var result = convert_to_float * quantity

    //     console.log(product_price)
        
    //     // $(this).parent().find("#product_price").text(result);
    //  });

    $("input[type='number']").on("change", function(e) {
        originalPrice = $(this).siblings("p").attr("orig-price");
        $(this).siblings("#product_price").text("($"+(originalPrice*$(this).val()).toFixed(2)+")");
    });
});