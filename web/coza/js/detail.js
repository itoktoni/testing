$("#love").click(function(){
   var love = $("#love").val();
   var id = $("#cart-product_id");
   
   $.ajax({
       url: window.location.href,
       data : {product:id, value:love},
       type: "POST",
       success: function(data){
           alert(data);
       }
   });
});

$("#share").jsSocials({
    shares: ["email", "twitter", "googleplus", "linkedin", "pinterest", "whatsapp"]
});


$('#like').click(function(data){
  var like = $(this).val();
  var product = $('#cart-product_id').val();

  $.ajax({
    type: 'POST',
    data : {value : like, product : product},
    success : function(data){

        if(like == 0){
    
          $('#like').removeClass().addClass('btn btn-danger');
          $('#like').val(1);
        }
        else{
          
          $('#like').removeClass().addClass('btn btn-secondary');
          $('#like').val(0);
        }
    }
  });
});

var client = algoliasearch('TP8H76V4RK', '2301f1d5e0f4569f9820e31d870e1aab');
  var index = client.initIndex('product_NAME');
  //initialize autocomplete on search input (ID selector must match)
  $('#aa-search-input').autocomplete(
    {hint: false}, [
    {
      source: $.fn.autocomplete.sources.hits(index, { hitsPerPage: 5 }),
      //value to be displayed in input control after user's suggestion selection
      displayKey: 'name',
      //hash of templates used when rendering dataset
      templates: {
        //'suggestion' templating function used to render a single suggestion
        suggestion: function(suggestion) {
          // return '<span>' + suggestion._highlightResult.firstname.value + '</span><span>' + suggestion._highlightResult.lastname.value + '</span>';
          return '<span>'+suggestion._highlightResult.product_name.value+'</span>';
        }
      }
    }
  ]).on('autocomplete:selected', function(event, suggestion, dataset) {
    window.location.href = suggestion.product_url;
    console.log(suggestion);
  });