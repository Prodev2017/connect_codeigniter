function addAddress2() {

        visibleAddresses(addresses);
        var addressId = "newAdd"+addresses.childElementCount;

        var address = document.createElement("div");
        address.setAttribute("name", "addresses["+addressId+"]");
        address.setAttribute("id", addressId);

        var removeButton = document.createElement("input");
        removeButton.setAttribute("type", "button");
        removeButton.setAttribute("onclick", "removeAddress("+addressId+")");
        removeButton.setAttribute("value", "Remove address");

        var address_type = document.createElement("input");
        address_type.setAttribute("name", "addresses["+addressId+"][address_type]");
        address_type.setAttribute("type", "text");

        var address_line1 = document.createElement("input");
        address_line1.setAttribute("name", "addresses["+addressId+"][address_line1]");
        address_line1.setAttribute("type", "text");

        var address_line2 = document.createElement("input");
        address_line2.setAttribute("name", "addresses["+addressId+"][address_line2]");
        address_line2.setAttribute("type", "text");

        var address_line3 = document.createElement("input");
        address_line3.setAttribute("name", "addresses["+addressId+"][address_line3]");
        address_line3.setAttribute("type", "text");

        var address_line4 = document.createElement("input");
        address_line4.setAttribute("name", "addresses["+addressId+"][address_line4]");
        address_line4.setAttribute("type", "text");

        var city = document.createElement("input");
        city.setAttribute("name", "addresses["+addressId+"][city]");
        city.setAttribute("type", "text");

        var postal_code = document.createElement("input");
        postal_code.setAttribute("name", "addresses["+addressId+"][postal_code]");
        postal_code.setAttribute("type", "text");

        var country = document.createElement("input");
        country.setAttribute("name", "addresses["+addressId+"][country]");
        country.setAttribute("type", "text");

        var county = document.createElement("input");
        county.setAttribute("name", "addresses["+addressId+"][county]");
        county.setAttribute("type", "text");

        var add_contact_card = document.getElementById("address-info-card-container");

        //address.appendChild(removeButton);
        $('.add-address').remove();
        $('<div class="md-input-wrapper"><input class="md-form-control" name="addresses['+addressId+'][address_type]" type="text"><label>Address Type:</label></div>').appendTo(add_contact_card);
        $('<div class="md-input-wrapper"><input class="md-form-control" name="addresses['+addressId+'][address_line1]" type="text"><label>Address Line 1:</label></div>').appendTo(add_contact_card);
        $('<div class="md-input-wrapper"><input class="md-form-control" name="addresses['+addressId+'][address_line2]" type="text"><label>Address Line 2:</label></div>').appendTo(add_contact_card);
        $('<div class="md-input-wrapper"><input class="md-form-control" name="addresses['+addressId+'][address_line3]" type="text"><label>Address Line 3:</label></div>').appendTo(add_contact_card);
        $('<div class="md-input-wrapper"><input class="md-form-control" name="addresses['+addressId+'][address_line4]" type="text"><label>Address Line 4:</label></div>').appendTo(add_contact_card);
        $('<div class="md-input-wrapper"><input class="md-form-control" name="addresses['+addressId+'][city]" type="text"><label >City:</label></div>').appendTo(add_contact_card);
        $('<div class="md-input-wrapper"><input class="md-form-control" name="addresses['+addressId+'][postal_code]" type="text"><label >Postal Code:</label></div>').appendTo(add_contact_card);
        $('<div class="md-input-wrapper"><input class="md-form-control" name="addresses['+addressId+'][country]" type="text"><label >Country:</label></div>').appendTo(add_contact_card);
        $('<div class="md-input-wrapper"><input class="md-form-control" name="addresses['+addressId+'][county]" type="text"><label >County:</label></div>').appendTo(add_contact_card);
        $('<input value="Save Address" class="save-address btn btn-primary waves-effect waves-light" type="button">').appendTo(add_contact_card);

        $( ".save-address" ).click(function() {
            $('.addresses-table tbody').append('<tr><td>'+$(this).parent().find("input[name*='type']").val()+'</td><td>'+$(this).parent().find("input[name*='line1']").val()+'</td><td>'+$(this).parent().find("input[name*='line2']").val()+'</td><td>'+$(this).parent().find("input[name*='line3']").val()+'</td><td>'+$(this).parent().find("input[name*='line4']").val()+'</td> <td>'+$(this).parent().find("input[name*='city']").val()+'</td><td>'+$(this).parent().find("input[name*='postal']").val()+'</td>'+$(this).parent().find("input[name*='country']").val()+'<td>'+$(this).parent().find("input[name*='country']").val()+'</td><td>'+$(this).parent().find("input[name*='county']").val()+'</td></tr>');
            $('.addresses-table').show();
            $(this).parent().hide();
            $( ".addresses-table" ).after('<div class="col-xs-12"><center><input onclick="addAddress()" value="Add another address" class="add-address btn btn-primary waves-effect waves-light" type="button"></</div>')
      });

}


function addAddress(){
  var addresses = document.getElementById("addresses");

  visibleAddresses(addresses);
  var addressId = "newAdd"+addresses.childElementCount;

  var address = document.createElement("div");
  address.setAttribute("name", "addresses["+addressId+"]");
  address.setAttribute("id", addressId);

  var removeButton = document.createElement("input");
  removeButton.setAttribute("type", "button");
  removeButton.setAttribute("onclick", "removeAddress("+addressId+")");
  removeButton.setAttribute("value", "Remove address");

  var address_type = document.createElement("input");
  address_type.setAttribute("name", "addresses["+addressId+"][address_type]");
  address_type.setAttribute("type", "text");

  var address_line1 = document.createElement("input");
  address_line1.setAttribute("name", "addresses["+addressId+"][address_line1]");
  address_line1.setAttribute("type", "text");

  var address_line2 = document.createElement("input");
  address_line2.setAttribute("name", "addresses["+addressId+"][address_line2]");
  address_line2.setAttribute("type", "text");

  var address_line3 = document.createElement("input");
  address_line3.setAttribute("name", "addresses["+addressId+"][address_line3]");
  address_line3.setAttribute("type", "text");

  var address_line4 = document.createElement("input");
  address_line4.setAttribute("name", "addresses["+addressId+"][address_line4]");
  address_line4.setAttribute("type", "text");

  var city = document.createElement("input");
  city.setAttribute("name", "addresses["+addressId+"][city]");
  city.setAttribute("type", "text");

  var postal_code = document.createElement("input");
  postal_code.setAttribute("name", "addresses["+addressId+"][postal_code]");
  postal_code.setAttribute("type", "text");

  var country = document.createElement("input");
  country.setAttribute("name", "addresses["+addressId+"][country]");
  country.setAttribute("type", "text");

  var county = document.createElement("input");
  county.setAttribute("name", "addresses["+addressId+"][county]");
  county.setAttribute("type", "text");

var used1 = $('#addresses-add-contacts tbody tr:first td:first').html();
var used2 = $('#addresses-add-contacts tbody tr:nth-child(2) td:first').html();

if ( !used1 && !used2 ) {
var used1 = $('#addresses-table tbody tr:first td:first').html();
var used2 = $('#addresses-table tbody tr:nth-child(2) td:first').html();
}

if ( used1 && used2 ) {

  alert('You have entered both addresses');

} else {

if (used1 == 'POBOX') {
  var options = '<option value="STREET">STREET</option>';
} else if (used1 == 'STREET') {
  var options = '<option value="POBOX">POBOX</option>';
} else {
   var options = '<option value="STREET">STREET</option><option value="POBOX">POBOX</option>';
}


  //address.appendChild(removeButton);
  $('.add-address').remove();
  $('<div class="md-input-wrapper"><label>Address Type:</label><select class="md-form-control" name="addresses['+addressId+'][address_type]" >'+options+'</select></div>').appendTo(address);
  $('<div class="md-input-wrapper"><input class="md-form-control" name="addresses['+addressId+'][address_line1]" type="text"><label>Address Line 1:</label></div>').appendTo(address);
  $('<div class="md-input-wrapper"><input class="md-form-control" name="addresses['+addressId+'][address_line2]" type="text"><label>Address Line 2:</label></div>').appendTo(address);
  $('<div class="md-input-wrapper"><input class="md-form-control" name="addresses['+addressId+'][address_line3]" type="text"><label>Address Line 3:</label></div>').appendTo(address);
  $('<div class="md-input-wrapper"><input class="md-form-control" name="addresses['+addressId+'][address_line4]" type="text"><label>Address Line 4:</label></div>').appendTo(address);
  $('<div class="md-input-wrapper"><input class="md-form-control" name="addresses['+addressId+'][city]" type="text"><label >City:</label></div>').appendTo(address);
  $('<div class="md-input-wrapper"><input class="md-form-control" name="addresses['+addressId+'][postal_code]" type="text"><label >Postal Code:</label></div>').appendTo(address);
  $('<div class="md-input-wrapper"><input class="md-form-control" name="addresses['+addressId+'][country]" type="text"><label >Country:</label></div>').appendTo(address);
  $('<div class="md-input-wrapper"><input class="md-form-control" name="addresses['+addressId+'][county]" type="text"><label >County:</label></div>').appendTo(address);
  $('<input value="Save Address" class="save-address btn btn-primary waves-effect waves-light" type="button">').appendTo(address);

  addresses.appendChild(address);

  $( ".save-address" ).click(function() {
      $('.addresses-table tbody').append('<tr><td>'+$(this).parent().find("select[name*='type']").val()+'</td><td>'+$(this).parent().find("input[name*='line1']").val()+'</td><td>'+$(this).parent().find("input[name*='line2']").val()+'</td><td>'+$(this).parent().find("input[name*='line3']").val()+'</td><td>'+$(this).parent().find("input[name*='line4']").val()+'</td> <td>'+$(this).parent().find("input[name*='city']").val()+'</td><td>'+$(this).parent().find("input[name*='postal']").val()+'</td>'+$(this).parent().find("input[name*='country']").val()+'<td>'+$(this).parent().find("input[name*='country']").val()+'</td><td>'+$(this).parent().find("input[name*='county']").val()+'</td></tr>');
      $('.addresses-table').show();
      $(this).parent().hide();
      $( ".addresses-table" ).after('<div class="col-xs-12"><center><input onclick="addAddress()" value="Add another address" class="add-address btn btn-primary waves-effect waves-light" type="button"></</div>')
});

}

}

function visibleAddresses(){
  var addresses = document.getElementById("addresses");
  if(addresses.getAttribute("style") == "visibility:hidden"){
    addresses.setAttribute("style", "visibility:visible")
  }
}

function removeAddress(id){
  var addresses = document.getElementById("addresses");
  addresses.removeChild(id);

}
function removeAddressRow(id){
  $(id).remove();

}


function addPhone2() {


        var add_contact_card = document.getElementById("phone-info-card-container");
         var phoneId = "newPhone"+phones.childElementCount;
         var phone = document.createElement("div");
         phone.setAttribute("name", "phones["+phoneId+"]");
         phone.setAttribute("id", phoneId);

         var removeButton = document.createElement("input");
         removeButton.setAttribute("type", "button");
         removeButton.setAttribute("onclick", "removePhone("+phoneId+")");
         removeButton.setAttribute("value", "Remove phone");

         var phone_type = document.createElement("input");
         phone_type.setAttribute("name", "phones["+phoneId+"][phone_type]");
         phone_type.setAttribute("type", "text");

         var phone_number = document.createElement("input");
         phone_number.setAttribute("name", "phones["+phoneId+"][phone_number]");
         phone_number.setAttribute("type", "text");

         var phone_area_code = document.createElement("input");
         phone_area_code.setAttribute("name", "phones["+phoneId+"][phone_area_code]");
         phone_area_code.setAttribute("type", "text");

         var phone_country_code = document.createElement("input");
         phone_country_code.setAttribute("name", "phones["+phoneId+"][phone_country_code]");
         phone_country_code.setAttribute("type", "text");

         $('<div class="md-input-wrapper"><input class="md-form-control" name="phones['+phoneId+'][phone_type]" type="text"><label>Phone Type:</label></div>').appendTo(add_contact_card);
         $('<div class="md-input-wrapper"><input class="md-form-control" name="phones['+phoneId+'][phone_number]" type="text"><label>Phone Number:</label></div>').appendTo(add_contact_card);
         $('<div class="md-input-wrapper"><input class="md-form-control" name="phones['+phoneId+'][phone_area_code]" type="text"><label>Phone Area Code:</label></div>').appendTo(add_contact_card);
         $('<div class="md-input-wrapper"><input class="md-form-control" name="phones['+phoneId+'][phone_country_code]" type="text"><label>Phone Country Code:</label></div>').appendTo(add_contact_card);
         $('<input value="Save Phone Number" class="save-phone btn btn-primary waves-effect waves-light" type="button">').appendTo(add_contact_card);

         $( ".save-phone" ).click(function() {
            $('.phone-table tbody').append('<tr><td>'+$(this).parent().find("input[name*='type']").val()+'</td><td>'+$(this).parent().find("input[name*='number']").val()+'</td><td>'+$(this).parent().find("input[name*='area_code']").val()+'</td><td>'+$(this).parent().find("input[name*='country_code']").val()+'</td></tr>');
            $('.phone-table').show();
            $(this).parent().hide();
            $( ".phone-table" ).after('<div class="col-xs-12"><center><input onclick="addPhone()" value="Add another phone number" class="add-phone btn btn-primary waves-effect waves-light" type="button"></</div>')
            });
}



function addPhone(){
  var phones = document.getElementById("phones");

  visiblePhones(phones);
  var phoneId = "newPhone"+phones.childElementCount;

  var phone = document.createElement("div");
  phone.setAttribute("name", "phones["+phoneId+"]");
  phone.setAttribute("id", phoneId);

  var removeButton = document.createElement("input");
  removeButton.setAttribute("type", "button");
  removeButton.setAttribute("onclick", "removePhone("+phoneId+")");
  removeButton.setAttribute("value", "Remove phone");

  var phone_type = document.createElement("input");
  phone_type.setAttribute("name", "phones["+phoneId+"][phone_type]");
  phone_type.setAttribute("type", "text");

  var phone_number = document.createElement("input");
  phone_number.setAttribute("name", "phones["+phoneId+"][phone_number]");
  phone_number.setAttribute("type", "text");

  var phone_area_code = document.createElement("input");
  phone_area_code.setAttribute("name", "phones["+phoneId+"][phone_area_code]");
  phone_area_code.setAttribute("type", "text");

  var phone_country_code = document.createElement("input");
  phone_country_code.setAttribute("name", "phones["+phoneId+"][phone_country_code]");
  phone_country_code.setAttribute("type", "text");


var used1 = $('#phone-numbers-add-contacts tbody tr:first td:first').html();
var used2 = $('#phone-numbers-add-contacts tbody tr:nth-child(2) td:first').html();
var used3 = $('#phone-numbers-add-contacts tbody tr:nth-child(3) td:first').html();
var used4 = $('#phone-numbers-add-contacts tbody tr:nth-child(4) td:first').html();


if ( !used1 && !used2 && !used3 && !used4 ) {
var used1 = $('.phone-table tbody tr:first td:first').html();
var used2 = $('.phone-table tbody tr:nth-child(2) td:first').html();
var used3 = $('.phone-table tbody tr:nth-child(3) td:first').html();
var used4 = $('.phone-table tbody tr:nth-child(4) td:first').html();
}

if ( used1 && used2 && used3 && used4 ) {

  alert('You have entered all phones');

} else {


var options = ['DDI', 'DEFAULT', 'FAX', 'MOBILE'];

 options= jQuery.grep(options, function(value) {
  return value != used1;
});
 options= jQuery.grep(options, function(value) {
  return value != used2;
});
 options= jQuery.grep(options, function(value) {
  return value != used3;
});
 options= jQuery.grep(options, function(value) {
  return value != used4;
});

var store_options = '';
 $.each( options, function (index, value) {
 store_options = store_options+'<option value="'+value+'">'+value+'</option>';

});


  //phone.appendChild(removeButton);

  $('<div class="md-input-wrapper"><label>Phone Type:</label><select class="md-form-control"  name="phones['+phoneId+'][phone_type]">'+store_options+'</select></div>').appendTo(phone);
  $('<div class="md-input-wrapper"><input class="md-form-control" name="phones['+phoneId+'][phone_number]" type="text"><label>Phone Number:</label></div>').appendTo(phone);
  $('<div class="md-input-wrapper"><input class="md-form-control" name="phones['+phoneId+'][phone_area_code]" type="text"><label>Phone Area Code:</label></div>').appendTo(phone);
  $('<div class="md-input-wrapper"><input class="md-form-control" name="phones['+phoneId+'][phone_country_code]" type="text"><label>Phone Country Code:</label></div>').appendTo(phone);
  $('<input value="Save Phone Number" class="save-phone btn btn-primary waves-effect waves-light" type="button">').appendTo(phone);
  console.log(phoneId);
  $('.add-phone').remove();

  phones.appendChild(phone);

   $( ".save-phone" ).click(function() {
      $('.phone-table tbody').append('<tr><td>'+$(this).parent().find("select[name*='type']").val()+'</td><td>'+$(this).parent().find("input[name*='number']").val()+'</td><td>'+$(this).parent().find("input[name*='area_code']").val()+'</td><td>'+$(this).parent().find("input[name*='country_code']").val()+'</td></tr>');
      $('.phone-table').show();
      $(this).parent().hide();
      $( ".phone-table" ).after('<div class="col-xs-12"><center><input onclick="addPhone()" value="Add another phone number" class="add-phone btn btn-primary waves-effect waves-light" type="button"></</div>')
      });
}

}

function visiblePhones(){
  var phones = document.getElementById("phones");
  if(phones.getAttribute("style") == "visibility:hidden"){
    phones.setAttribute("style", "visibility:visible")
  }
}

function removePhone(id){
  var phones = document.getElementById("phones");
  phones.removeChild(id);
}
function removePhoneRow(id){
  $(id).remove();
}

function readEditAddress(id){
  $('.addresses-table').hide();
  $('.add-address').hide();
  $(id).show();
  var nodes = id.childNodes;
  var i = nodes.length;
  while(--i>1){
    var node = nodes[i];
    if(node == "[object HTMLInputElement]"){
      if(i != 3){
        if(node.getAttribute("readonly") == "true"){
          node.removeAttribute("readonly");
        }
        else{
          node.setAttribute("readonly", "true");
        }
      }
      else{
        if(node.getAttribute("value") == "Edit"){
          node.setAttribute("value", "Done");
        }
        else{
          node.setAttribute("value", "Edit");
        }
      }
    }
  }
}

function readEditPhone(id){
  $('.phone-table').hide();
  $('.add-phone').hide();
  $(id).show();
  var nodes = id.childNodes;
  var i = nodes.length;
  while(--i>1){
    var node = nodes[i];
    if(node == "[object HTMLInputElement]"){
      if(i != 3){
        if(node.getAttribute("readonly") == "true"){
          node.removeAttribute("readonly");
        }
        else{
          node.setAttribute("readonly", "true");
        }
      }
      else{
        if(node.getAttribute("value") == "Edit"){
          node.setAttribute("value", "Done");
        }
        else{
          node.setAttribute("value", "Edit");
        }
      }
    }
  }
}

function saveEdit(id){
$('#formAddContact').submit();
}

var companyLocationIndex = 0;
function showAddCompanyContact() {

        var add_contact_card = document.getElementById("new-contact-info-card-block");




var used1 = $('.addresses-table tbody tr:first td:first').html();
var used2 = $('.addresses-table tbody tr:nth-child(2) td:first').html();

if ( !used1 && !used2 ) {
var used1 = $('#addresses-table tbody tr:first td:first').html();
var used2 = $('#addresses-table tbody tr:nth-child(2) td:first').html();
}

if ( used1 && used2 ) {

  alert('You have entered both addresses');

} else {

if (used1 == 'POBOX') {
  var options = '<option value="STREET">STREET</option>';
} else if (used1 == 'STREET') {
  var options = '<option value="POBOX">POBOX</option>';
} else {
   var options = '<option value="STREET">STREET</option><option value="POBOX">POBOX</option>';
}


var used1 =  $('*[id*=phoneid]:first').html();
var used2 = $('#phone-numbers-add-contacts tbody tr:nth-child(2) td:first').html();
var used3 = $('#phone-numbers-add-contacts tbody tr:nth-child(3) td:first').html();
var used4 = $('#phone-numbers-add-contacts tbody tr:nth-child(4) td:first').html();


if ( !used1 && !used2 && !used3 && !used4 ) {
var used1 = $('.phone-table tbody tr:first td:first').html();

}




var optionsp = ['DDI', 'DEFAULT', 'FAX', 'MOBILE'];

 optionsp= jQuery.grep(optionsp, function(value) {
  return value != used1;
});

var store_options = '';
 $.each( optionsp, function (index, value) {
 store_options = store_options+'<option value="'+value+'">'+value+'</option>';

});



        //location
        $('<div class="compContact'+companyLocationIndex+'" id="compContact'+companyLocationIndex+'">').appendTo(add_contact_card);
        $('</div>').appendTo(add_contact_card);
        var contactCard = document.getElementById('compContact'+companyLocationIndex);
          $('<div class="md-input-wrapper"><label>Address Type:</label><select class="md-form-control" name="locations['+companyLocationIndex+'][address][address_type]" >'+options+'</select></div>').appendTo(contactCard);
        $('<div class="md-input-wrapper"><input class="md-form-control" name="locations['+companyLocationIndex+'][address][address_line1]" type="text"/><label>Address Line 1:</label></div>').appendTo(contactCard);
        $('<div class="md-input-wrapper"><input class="md-form-control" name="locations['+companyLocationIndex+'][address][address_line2]" type="text"/><label>Address Line 2:</label></div>').appendTo(contactCard);
        $('<div class="md-input-wrapper"><input class="md-form-control" name="locations['+companyLocationIndex+'][address][address_line3]" type="text"/><label>Address Line 3:</label></div>').appendTo(contactCard);
        $('<div class="md-input-wrapper"><input class="md-form-control" name="locations['+companyLocationIndex+'][address][address_line4]" type="text"/><label>Address Line 4:</label></div>').appendTo(contactCard);
        $('<div class="md-input-wrapper"><input class="md-form-control" name="locations['+companyLocationIndex+'][address][city]" type="text"/><label >City:</label></div>').appendTo(contactCard);
        $('<div class="md-input-wrapper"><input class="md-form-control" name="locations['+companyLocationIndex+'][address][postal_code]" maxlength="50" type="text"/><label >Postal Code:</label></div>').appendTo(contactCard);
        $('<div class="md-input-wrapper"><input class="md-form-control" name="locations['+companyLocationIndex+'][address][county]" type="text"/><label >Country:</label></div>').appendTo(contactCard);
        $('<div class="md-input-wrapper"><input class="md-form-control" name="locations['+companyLocationIndex+'][address][country]" type="text"/><label >County:</label></div>').appendTo(contactCard);
        //phone number


        $('<div class="md-input-wrapper"><label>Phone Type:</label><select class="md-form-control"  name="locations['+companyLocationIndex+'][phone][phone_type]">'+store_options+'</select></div>').appendTo(contactCard);


        $('<div class="md-input-wrapper"><input class="md-form-control" name="locations['+companyLocationIndex+'][phone][phone_number]"onkeypress="return event.charCode >= 48 && event.charCode <= 57" type="text" maxlength="50"><label>Phone Number:</label></div>').appendTo(contactCard);
        $('<div class="md-input-wrapper"><input class="md-form-control" name="locations['+companyLocationIndex+'][phone][phone_area_code]" type="text" maxlength="10"><label>Phone Area Code:</label></div>').appendTo(contactCard);
        $('<div class="md-input-wrapper"><input class="md-form-control" name="locations['+companyLocationIndex+'][phone][phone_country_code]" type="text" maxlength="50"><label>Phone Country Code:</label></div>').appendTo(contactCard);
        //button
        $('<input value="Save" class="save-btn btn btn-primary waves-effect waves-light" type="button">').appendTo(contactCard);
        //
        //hide the add location button to prevent multiple being opened in the add container
        $('#add-location-btn').hide();

        $( ".save-btn" ).click(function() {
           $('.addresses-table tbody').append('<tr id="locations'+companyLocationIndex+'">' + '<td id="addressid'+companyLocationIndex+'">'+$(contactCard).find("select[name*='type']").val()+'</td><td>'+$(contactCard).find("input[name*='line1']").val()+'</td><td>'+$(contactCard).find("input[name*='line2']").val()+'</td><td>'+$(contactCard).find("input[name*='line3']").val()+'</td><td>'+$(contactCard).find("input[name*='line4']").val()+'</td> <td>'+$(contactCard).find("input[name*='city']").val()+'</td><td>'+$(contactCard).find("input[name*='postal']").val()+'</td>'+$(contactCard).find("input[name*='country']").val()+'<td>'+$(contactCard).find("input[name*='country']").val()+'</td><td>'+$(contactCard).find("input[name*='county']").val()+'</td>'
            + '<td id="phoneid'+companyLocationIndex+'">' + $(contactCard).find("select[name*='phone']").val()+'</td><td>'+$(contactCard).find("input[name*='number']").val()+'</td><td>'+$(contactCard).find("input[name*='area_code']").val()+'</td><td>'+$(contactCard).find("input[name*='country_code']").val()+'</td></tr>');
           $('.addresses-table').show();


           //hide the input
           //$('.compContact' + companyLocationIndex).css('display','none');
           $('.compContact' + companyLocationIndex).hide();
           companyLocationIndex++;
           $('#add-location-btn').show();


           });
}

}

function checkLocationInputError() {
        if($('.compContact'+companyLocationIndex).css('display') != 'none')
        {
                $('.compContact'+companyLocationIndex).empty();
                $('.compContact'+companyLocationIndex).remove();
                $('#add-location-btn').show();
        }
}
