
 <!-- Heading -->
<form action="<?= route('user.read.events') ?>" id="event-serach-form">
    <input type="hidden" name="action" value ="filter">
<!--  <li class="nav-item justify-content-between text-left select-drop-down">

     <p>Location</p>

     <select class="select-sidebar" name="location">

         <option>City, Postel Code</option>

         <option value="London">London</option>

         <option value="France">France</option>

          <option value="France">Maxco</option>

     </select>

 </li> -->

 <li class="nav-item justify-content-between text-left select-drop-down">
    <p>Location</p>
    <div>
      <ul class="filter-ul" id="locationRd">
        <li class="locationFilterCity"> 
          <input type="radio" id ="" name ="" value="">
          <label for="city"> San Francisco, CA, USA</label>
        </li>
        <li class="locationFilterMap">
          <input type="radio" id="" name="" value="">
          <label for="city"> Other Locations</label><br> </li>        
        </ul>
        <input id="searchTextField_mobile" type="text" name="location" placeholder="Enter a location" autocomplete="on">
      </div>
    </li>


  

 <li class="nav-item justify-content-between text-left select-drop-down">

     <p>Meet Type</p>

     <select class="select-sidebar" name="meet_type">
        
        <option value="">Select Meet Type</option>
        <option value="Dinner/Lunch date">Dinner/Lunch date</option>
         <option value="Meet at your place">Meet at your place</option>
         <option value="Social meetup">Social meetup</option>
         <option value="Meet at my place">Meet at my place</option>
         <option value="Night out">Night out</option>
         <option value="Anything, anywhere">Anything, anywhere</option>
         <option value="Hotel meet">Hotel meet</option>
        <option value="Club meet">Club meet</option>

     </select>

 </li>

 <li class="nav-item justify-content-between text-left select-drop-down">

     <p>When</p>

      <select class="select-sidebar drop" name="created_at">

         <option value="">Any</option>

         

     </select>

 </li>

 <li class="nav-item justify-content-between text-left select-drop-down">

   <!--   <p>Profile</p>

     <select class="select-sidebar" name="title">

         <option>Jhone Deo, Honkin</option>

         <option value="Lumia Deni">Lumia Deni</option>

         <option value="">Lumia Deni</option>

     </select>
 -->
     <span class="d-flex justify-content-between align-items-center my-2"><button type="submit" class="web-button search-event-submit-btn">

         Search

      </button><p><a href="{{ url('/events') }}">Reset All</a></p></span>

 </li>
</form>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=<?= getStoreSettings('google_map_key') ?>&libraries=places&callback=initialize" async defer></script>


<script type="text/javascript">
     $(document).ready(function(){


         $('#searchTextField_mobile').hide();
    $('body').on('click','.locationFilterMap',function(){
      $('#searchTextField_mobile').show();
  });
     });
      function initialize() {
     var input = document.getElementById('searchTextField_mobile');
     var autocomplete = new google.maps.places.Autocomplete(input);
 }
 google.maps.event.addDomListener(window, 'load', initialize);
    
var weekday=new Array(7);
weekday[0]="Sunday";
weekday[1]="Monday";
weekday[2]="Tuesday";
weekday[3]="Wednesday";
weekday[4]="Thursday";
weekday[5]="Friday";
weekday[6]="Saturday";

    for (var i = 0; i <= 60; i++) {

  var date = new Date();
  date.setDate(date.getDate() + i);
 const month = ["January","February","March","April","May","June","July","August","September","October","November","December"];

  $(".drop").append("<option value="+ (date.getDate()) + "-" + (date.getMonth())+ "-" + date.getFullYear() +  ">" + (date.getDate()) + " " + (month[date.getMonth()])+ " " + date.getFullYear() + "   (" + weekday[date.getDay()] + ")</option>");
}

</script>
