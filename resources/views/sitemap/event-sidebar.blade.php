
 <!-- Heading -->
<form action="<?= route('user.read.events') ?>" id="event-serach-form">
    <input type="hidden" name="action" value ="filter">

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
        <input id="searchTextField" type="text" name="location" value="{{ (isset($selectedFilter['location'])) ? $selectedFilter['location'] : '' }}" placeholder="Enter a location" autocomplete="on">
      </div>
    </li>


  

 <li class="nav-item justify-content-between text-left select-drop-down">

     <p>Meet Type</p>

     <select class="select-sidebar" name="meet_type">
         <option value="">Select Meet Type</option>

        <option value="Dinner/Lunch date" @if(isset($selectedFilter['meet_type'])) @if($selectedFilter['meet_type'] == 'Dinner/Lunch date') selected @endif @endif>Dinner/Lunch date</option>
         <option value="Meet at your place" @if(isset($selectedFilter['meet_type'])) @if($selectedFilter['meet_type'] == 'Social meetup') selected @endif @endif>Meet at your place</option>
         <option value="Social meetup" @if(isset($selectedFilter['meet_type'])) @if($selectedFilter['meet_type'] == 'Social meetup') selected @endif @endif>Social meetup</option>
         <option value="Meet at my place" @if(isset($selectedFilter['meet_type'])) @if($selectedFilter['meet_type'] == 'Meet at my place') selected @endif @endif>Meet at my place</option>
         <option value="Night out" @if(isset($selectedFilter['meet_type'])) @if($selectedFilter['meet_type'] == 'Night out') selected @endif @endif>Night out</option>
         <option value="Anything, anywhere" @if(isset($selectedFilter['meet_type'])) @if($selectedFilter['meet_type'] == 'Anything, anywhere') selected @endif @endif>Anything, anywhere</option>
         <option value="Hotel meet" @if(isset($selectedFilter['meet_type'])) @if($selectedFilter['meet_type'] == 'Hotel meet') selected @endif @endif>Hotel meet</option>
        <option value="Club meet" @if(isset($selectedFilter['meet_type'])) @if($selectedFilter['meet_type'] == 'Club meet') selected @endif @endif>Club meet</option>


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


<script type="text/javascript">
    
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

  $(".drop").append("<option value="+ (date.getDate()) + "-" + (month[date.getMonth()]) + "-" + date.getFullYear() +  ">" + (date.getDate()) + " " + (month[date.getMonth()])+ " " + date.getFullYear() + "   (" + weekday[date.getDay()] + ")</option>");
}

</script>
