// get users from list.php
get_users();
function get_users(){
  $.ajax({
    url: "php/list.php",
    method:"POST",         
    })
    .done(function( data ){
      var myArray = JSON.parse(data);
      var list_table = myArray.list_table;
      var genders = myArray.genders;
      var countries = myArray.countries;
      var cities = myArray.cities;
      
      $('table tbody').empty();
      if(list_table){
        for (let i = 0; i < list_table.length; i++) {
          var isChecked = list_table[i]["status"] == 1 ? "checked" : "";
          var html ="<tr><td>"+list_table[i]["id"]+"</td>"+
                    "<td>"+list_table[i]["user_name"]+"</td>"+
                    "<td>"+list_table[i]["prenom"]+"</td>"+    
                    "<td>"+list_table[i]["nom"]+"</td>"+  
                    "<td>"+list_table[i]["tel"]+"</td>"+    
                    "<td>"+list_table[i]["mot_passe"]+"</td>"+
                    "<td>"+list_table[i]["status"]+"<div class='form-check form-switch' id='switchValue'><input class='form-check-input' type='checkbox' id='flexSwitchCheckDefault' "+isChecked+" ></div></td>"+
                    "<td>"+list_table[i]["name_gender"]+"</td>"+
                    "<td>"+list_table[i]["country"]+"</td>"+
                    "<td>"+list_table[i]["city"]+"</td>"+
                    "<td><button class='btn btn-outline-primary m-1 update-init' name='update' data-id='"+list_table[i]["id"]+"'><i class='fa-solid fa-pen-to-square'></i></button>"+
                    '<button type="button" class="btn btn-outline-danger m-1 delete-init" name="delete" data-id="'+list_table[i]["id"]+'"><i class="fa-regular fa-trash-can" ></i></button>'+
                    "</tr>";
          $('table tbody').append(html);
        }}
      $("select").empty();
      for (let i = 0; i < genders.length; i++){
        var opt = "<option value='"+genders[i]['id']+"'>"+genders[i]['nom']+"</option>";
        $('#examplegender').append(opt);
      }
      for (let i = 0; i < countries.length; i++){
        var opti = "<option value='"+countries[i]['id']+"'>"+countries[i]['country']+"</option>";
        $('#examplecountry').append(opti);
      }
      for (let i = 0; i < cities.length; i++){
        var optio = "<option value='"+cities[i]['id']+"'>"+cities[i]['city']+"</option>";
        $('#examplecity').append(optio);
      }
    });
}

function delete_element(id){
  $('.my_input').val(id);
  }

function getUser(id){
  $.ajax({
    url:"php/read.php",
    method:"POST",
    data:{
    id:id,
    }
  })
  .done(function( data ){
    var myArray = JSON.parse(data);
    var read = myArray.read;
    var genders = myArray.genders;
    var countries = myArray.countries;
    var cities = myArray.cities;
    $("#exampleidUp").val(read.id);
    $("#exampleusernameUp").val(read.user_name);
    $("#examplenomUp").val(read.prenom);
    $("#exampleprenomUp").val(read.nom);
    $("#exampletelUp").val(read.tel);
    $("#examplepasswordUp").val(read.mot_passe);
    $("#flexSwitchCheckDefaultUp").val(read.status);
    $("#examplegenderUp").val(read.gender_id);
    $("#examplecountryUp").val(read.country_id);
    $("#examplecityUp").val(read.city_id);
    $("select").empty();
    for(let i = 0; i < genders.length; i++){
      var opt = "<option value='"+genders[i]['id']+"'>"+genders[i]['nom']+"</option>";
      $('#examplegenderUp').append(opt);
    }
    $('#examplegenderUp').val(read.gender_id);
    for(let i = 0; i < countries.length; i++){
      var opti = "<option value='"+countries[i]['id']+"'>"+countries[i]['country']+"</option>";
      $('#examplecountryUp').append(opti);
    }
    $('#examplecountryUp').val(read.country_id);
    for(let i = 0; i < cities.length; i++){
      var optio = "<option value='"+cities[i]['id']+"'>"+cities[i]['city']+"</option>";
      $('#examplecityUp').append(optio);
    }
    $('#examplecityUp').val(read.city_id);
  });
}

function updateUser(){
  var idUp = $('#exampleidUp').val();
  var usernameUp = $("#exampleusernameUp").val();
  var prenomUp = $("#exampleprenomUp").val();
  var nomUp = $("#examplenomUp").val();
  var telUp = $("#exampletelUp").val();
  var motdepasseUp = $("#examplepasswordUp").val();
  var statusUp = ($("#flexSwitchCheckDefaultUp").prop("checked")) ? 1 : 0;
  var genderUp = $("#examplegenderUp").val();
  var countryUp = $("#examplecountryUp").val();
  var cityUp = $("#examplecityUp").val();
  $.ajax({
    url:"php/update.php",
    method:"POST",
    data:{
      id_to_update:idUp,
      usernameSendUp:usernameUp,
      prenomSendUp:prenomUp,
      nomSendUp:nomUp,
      telSendUp:telUp,
      motdepasseSendUp:motdepasseUp,
      statusSendUp:statusUp,
      genderSendUp:genderUp,
      countrySendUp:countryUp,
      citySendUp:cityUp
    }
  })
  .done(function( data ){ 
    get_users();
  });
}

function con(){
  let user_id = $('.my_input').val();
  $.ajax({
    url: "php/delete.php",
    method:"POST",
    data:{
        id:user_id
    }
  })
  .done(function( data ){
    get_users();
  });
}

function adduser(){
  var usernameAdd = $("#exampleusername").val();
  var prenomAdd = $("#exampleprenom").val();
  var nomAdd = $("#examplenom").val();
  var telAdd = $("#exampletel").val();
  var motdepasseAdd = $("#examplepassword").val();
  var statusAdd = ($("#flexSwitchCheckDefaultin").prop("checked")) ? 1 : 0;
  //var statusAdd = $("#flexSwitchCheckDefaultin").val();
  var genderAdd = $("#examplegender").val();
  var countryAdd = $("#examplecountry").val();
  var cityAdd = $("#examplecity").val();
  $.ajax({
    url:"php/insertinto.php",
    method:"POST",
    data:{
      usernameSend:usernameAdd,
      prenomSend:prenomAdd,
      nomSend:nomAdd,
      telSend:telAdd,
      motdepasseSend:motdepasseAdd,
      statusSend:statusAdd,
      genderSend:genderAdd,
      countrySend:countryAdd,
      citySend:cityAdd
    }
  })
  .done(function( data ){
    $('#exampleusername').val('');
    $('#exampleprenom').val('');
    $('#examplenom').val('');
    $('#exampletel').val('');
    $('#examplepassword').val('');
    $("#modalinsert").modal('hide');
    $("#modalinsert2").modal('show');
    get_users(); 
  }); 
}

$(".insertnew").click(function(){
  $("#modalinsert").modal('show');
  $("#modalinsert2").modal('hide');
});

$(document).on('click',".update-init",function(){
   var id = $(this).attr('data-id');
   getUser(id);
   $("#modalupdate").modal("show");
 });

 $(document).on('click',".delete-init",function(){
   var id = $(this).attr('data-id');
   delete_element(id);
   $("#modaldelete").modal("show");
 });

 $(".insertts,.insertnew").click(function(){
   $(".select1,.select2,.select3").append("<option selected></option>")
   $("#examplegender>option").last().hide();
   $("#examplecountry>option").last().hide();
   $("#examplecity>option").last().hide();
});
//drop down country ansert
$('.select2').change(function() {
  var af = $(this).val()
  //console.log(af);
  $.ajax({
    url:"php/cities.php",
    method:"POST",
    data:{
      id:af
    }
  })
  .done(function(data){
    //console.log(data);
    var myArray = JSON.parse(data);
    var cities = myArray;
    $(".select3").empty();
    if(myArray){
    for (let i = 0; i < myArray.length; i++){
      var optio = "<option value='"+myArray[i]['id']+"'>"+myArray[i]['city']+"</option>";
      $('#examplecity').append(optio);
      $('#examplecityUp').append(optio);
    }}
  })
});

function searchUser() {
  var input, search, table, tr, td, i, txtValue;
  input = document.getElementById("inputSearch");
  search = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[1];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(search) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}

function repassword(){
  $.ajax({
    url: "php/password.php",
    method:"POST",         
    })
    .done(function( data ){
      $("#examplepassword").val(data);
      $("#examplepasswordUp").val(data);
    })
}

$(document).on('click',"#addcountry",function(){
  var countryAdd = $("#examplecountry1").val();//value input
  var inp = document.getElementById("examplecountry1").value;//declare input type coountry text
  var x = document.getElementById("examplecountry");// id select
  var option = document.createElement("option");
  $.ajax({
    url: "php/addoption.php",
    method:"POST",  
    data:{
      countrySend:countryAdd,
    }
    })
    .done(function( data ){
      $(".spa").html(data);
      var res = JSON.parse(data);
      console.log(res)
      if(res == false){
        $("#examplecountry1").css("backgroundColor","red");
      }else{
        alert("hello")
      }
      $('#examplecountry1').val('');
      option.text = inp;
      x.add(option);
      get_users(); 
    })
  });

$(document).on('click',"#addcityin",function(){
  var cityAdd = $("#examplecity1").val();//value input
  var countryAdd = $("#examplecountry").val();//id select country
  var inp = document.getElementById("examplecity1").value;//declare input type coountry text
  var x = document.getElementById("examplecity");// id select
  var option = document.createElement("option");
  $.ajax({
    url: "php/addoptioncity.php",
    method:"POST",  
    data:{
      citySend:cityAdd,
      countrySend:countryAdd,
  }
  })
  .done(function( data ){
    $('#examplecity1').val('');
    option.text = inp;
    x.add(option);
    get_users(); 
  })
})

$(document).on('change', '#flexSwitchCheckDefault', function() {
  var isChecked = $(this).is(':checked');
  var id = $(this).closest('tr').find('td:first').text();
  $.ajax({
    url: 'php/status.php',
    type: 'POST',
    data: {
      'id': id,
      'status': (isChecked ? 1 : 0)
    },
  })
  .done(function(data){
    location.reload();
  })
});


