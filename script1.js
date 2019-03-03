function func() {
    username=localStorage.getItem('user');
    document.getElementById("greet").innerHTML="Hello "+username+"!";
}
$(window).scroll(function ()
{     
    if ( $(window).scrollTop() > 100)
    {
        $("#navbar").addClass("fixnav");
    }
    else  if ($(window).scrollTop() < 100)
    {
        $("#navbar").removeClass("fixnav");
    }
});
function action(){
    var val=document.getElementById("action");
    var selected=val.options[val.selectedIndex].value;
    if(selected =='logout')
    {
        window.location.href="login.php";
        username=localStorage.removeItem('user');
    }
    else if (selected =='change')
    {
        window.location.href="update.php";
    }
    else if (selected =='delete')
    {
        window.location.href="delete.php";
    }
}
function myMap() {
  var mapCanvas = document.getElementById("map");
  var mapOptions = {
    center: new google.maps.LatLng(13.554846, 80.027246), zoom: 15
  };
  var map = new google.maps.Map(mapCanvas, mapOptions);
}
function myFunction() {
  // Declare variables 
  var input, filter, table, tr, td, i;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("out");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 6; i < tr.length-5; i+=6) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
        tr[i+1].style.display = "";
        tr[i+2].style.display = "";
        tr[i+3].style.display = "";
        tr[i+4].style.display = "";
        tr[i+5].style.display = "";
      } else {
        tr[i].style.display = "none";
        tr[i+1].style.display = "none";
        tr[i+2].style.display = "none";
        tr[i+3].style.display = "none";
        tr[i+4].style.display = "none";
        tr[i+5].style.display = "none";
      }
    } 
  }
}
