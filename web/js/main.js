$('#province').change(function() {
    var id = $('#province option:selected').val();
    var city = $('#city');
    $.ajax({
        url: "http://localhost:8080/ongkir/city",
        data: {province: id},
        type: "GET",
        success: function(data) {
            city.empty();
            $('#city').val([]);
              city.append('<option value="">Select City..</option>');
            $.each(JSON.parse(data), function(key, val) {
                city.append('<option value="' + val.city_id + '">' + val.type + ' ' + val.city_name + '</option>');
            })
        }
    });
});

//$('#city').change(function() {
//    var id = $('#city option:selected').val();
//    var sub = $('#sub');
//    $.ajax({
//        url: "http://localhost:8080/ongkir/sub",
//        data: {city: id},
//        type: "GET",
//        success: function(data) {
//            sub.empty();
//            sub.append('<option value=""></option>');
//            $.each(JSON.parse(data), function(key, val) {
//                sub.append('<option value="' + val.subdistrict_id + '">' + val.subdistrict_name + '</option>');
//            })
//        }
//    });
//});

$('#courier').change(function() {
    var id = $('#courier option:selected').val();
    var destination = $('#city option:selected').val();
    var weight = $('#weight').val();
    var service = $('#service');

    if (weight) {
        $.ajax({
            url: "http://localhost:8080/ongkir/cost",
            data: {destination: destination, weight: weight * 1000, courier: id},
            type: "GET",
            success: function(data) {
                service.empty();
                service.append('<option value="">Select Service..</option>');
                $.each(JSON.parse(data), function(key, val) {
                    service.append('<option value="' + val.id + '">' + val.text + '</option>');
                })
            }
        });
    }
    else{
        alert('qty must filled');
    }
});

$('#service').change(function() {
    var id = $('#service option:selected').val();
    var price = $('#price');
    
    var split = id.split('#');
    
    var ongkos = split[0];
    var jasa = split[1];

    var ongkir = $('#total').text();
    $('#total').text("");
    $('#total').text('$'+(parseInt(ongkos)+parseInt(ongkir)));
    
    price.val(parseInt(ongkos)+parseInt(ongkir));
    
});

$(document).ready(function() {
    $(".select").each(function(){
        $(this).select2();
    });

    $('#checkout').click(function(e){
        var id;
            Stripe.card.createToken({
              number: $('#card').val(),
              cvc: $('#cvc').val(),
              exp_month: $('#month').val(),
              exp_year: $('#year').val()
            }, function(status, response){

                if (response.error) { // Problem!

                   new Noty({
                        text: response.error.message,
                        theme: 'metroui',
                        layout: 'topRight',
                        timeout: 2000,
                        closeWith: ['button'],
                        type: 'error',
                    }).show();

                  } else { // Token was created!

                    $('#payment').append('<input type="hidden" value="'+response.id+'" name="stripeToken">');
                    $('#payment').append('<input type="hidden" value="checkout" name="checkout">');

                    $('#payment').submit();
                  }
            });
         return false;
        });

        var socket = io.connect('http://localhost:8890');

        socket.on('notification', function (data) {

            var message = JSON.parse(data);

            $("#notifications").prepend("<p><strong>" + message.name + "</strong>: " + message.message + "</p>");

        });

    });
