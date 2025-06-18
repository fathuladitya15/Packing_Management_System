 
  $("body").on('.stfg_total').keyup(function () {
 
    // initialize the sum (total price) to zero
    var sum = 0;
   
     
    // we use jQuery each() to loop through all the textbox with 'price' class
    // and compute the sum for each loop
    $('.stfg_total').each(function() {
        sum += Number($(this).val());
    });
     
    // set the computed value to 'totalPrice' textbox
    $('#total').val(sum);
     
});
