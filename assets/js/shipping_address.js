$(document).ready(function(){
    $("#shipping_address_form").validate({
        rules:{
            shipping_full_name:{required: true},
            shipping_address_line1:{required: true},
            shipping_country:{required: true},
            shipping_state:{required: true},
            shipping_city:{required: true},
            shipping_zipcode:{required: true},
        },
        messages: {
            shipping_full_name:{required: "Please enter a Name"},
            shipping_address_line1:{required: "please enter an address"},
            shipping_country:{required: "Please choose a country"},
            shipping_state:{required: "Please choose a State"},
            shipping_city:{required: "Please enter a City"},
            shipping_zipcode:{required: "Please enter a Zipcode"},
        },
        errorElement: 'span',
        errorPlacement: function(error, element) {
            error.addClass('error');
            error.insertAfter(element);
        },
        submitHandler: function(form){
            $.ajax({
                url: form.action,
                type: form.method,
                dataType: 'json',
                data: $(form).serialize(),
                success: function(response) {
                    if(response.status == 1) {
                        Swal.fire('Good job!',response.message,'success');
                        loadUserAddresses();
                    } else if(response.status == 2) {
                        $(".error_message").html(response.message);
                    } else {
                        Swal.fire('Opps!',response.message,'warning');
                    }
                }            
            });		
        }
    });
    
    // load all shipping addresses
    function loadUserAddresses()
    {
        $.ajax({
            url: 'action.php',
            type: "POST",
            dataType: 'json',
            data: {class:"AddressController", action_method: "fetch"},
            success: function(response) {
                var address_html = "";
                if (response.status == 1) {
                    $.each(response.data, function( index, address ) {
                        var is_default = address.is_default == 1 ? 'checked' : '';
                        var address_line_2 = address.address_line_2 != "" ? address.address_line_2 + "<br>" : '';
                        address_html += `<div class="col-sm-4 address-box">
                                            <label>
                                                <input type="radio" name="shiiping_address" value="${address.id}" ${is_default} />
                                                <p>${address.full_name}<br>
                                                ${address.address_line_1}<br>
                                                ${address_line_2}
                                                ${address.city},${address.state_name}, ${address.country_name}
                                            </label>
                                        </div>`;
                    });
                    $("#shipping_address_area").html(address_html);
                }
            }            
        });	
    }
});