//script to copy the billing information to the shipping information with only one click

function FillShipping(f){
    if(f.shippingselect.checked == true){
        f.x_ship_to_first_name.value = f.x_first_name.value;
        f.x_ship_to_last_name.value = f.x_last_name.value;
        f.x_ship_to_company.value = f.x_company.value;
        f.x_ship_to_address.value = f.x_address.value;
        f.x_ship_to_city.value = f.x_city.value;
        f.x_ship_to_state.value = f.x_state.value;
        f.x_ship_to_zip.value = f.x_zip.value;
        f.x_ship_to_country.value = f.x_country.value;
        f.x_ship_to_email.value = f.x_email.value;
        f.x_ship_to_phone.value = f.x_phone.value;
        f.x_ship_to_fax.value = f.x_fax.value;        
    }
    if(f.shippingselect.checked == false){
                f.x_ship_to_first_name.value = '';
        f.x_ship_to_last_name.value = '';
        f.x_ship_to_company.value = '';
        f.x_ship_to_address.value = '';
        f.x_ship_to_city.value = '';
        f.x_ship_to_state.value = '';
        f.x_ship_to_zip.value = '';
        f.x_ship_to_country.value = '';
        f.x_ship_to_email.value = '';
        f.x_ship_to_phone.value = '';
        f.x_ship_to_fax.value = '';
    }
}