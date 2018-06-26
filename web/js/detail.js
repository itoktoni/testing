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
    shares: ["email", "twitter", "googleplus", "linkedin", "pinterest", "whatsapp"],
    showCount: true,
});

