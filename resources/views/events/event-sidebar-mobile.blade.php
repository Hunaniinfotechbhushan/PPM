<style type="text/css">
  .eventrange{
    --webkit-appearance: none !important;
border:none !important;
  }  
    
</style>
<style type="text/css">
    // Base Colors
$shade-10: #2c3e50 !default;
$shade-1: #d7dcdf !default;
$shade-0: #fff !default;
$teal: #1abc9c !default;

// Reset
* {
  &,
  &:before,
  &:after {
    box-sizing: border-box;
  }
}

body {
  font-family: sans-serif;
  padding: 60px 20px;
  
  @media (min-width: 600px) {
    padding: 60px;
  }
}

.range-slider {
  margin: 60px 0 0 0%;
}


// Range Slider
$range-width: 100% !default;

$range-handle-color: $shade-10 !default;
$range-handle-color-hover: $teal !default;
$range-handle-size: 20px !default;

$range-track-color: $shade-1 !default;
$range-track-height: 10px !default;

$range-label-color: $shade-10 !default;
$range-label-width: 60px !default;

  .range-slider {
    margin: 0px !important;
    display: flex;
    flex-direction: column-reverse;
}
.range-slider__range {
  -webkit-appearance: none;
  width: calc(100% - (#{$range-label-width + 13px}));
  height: $range-track-height;
  border-radius: 5px;
  background: $range-track-color;
  outline: none;
  padding: 0;
  margin: 0;

  // Range Handle
  &::-webkit-slider-thumb {
    appearance: none;
    width: $range-handle-size;
    height: $range-handle-size;
    border-radius: 50%;
    background: $range-handle-color;
    cursor: pointer;
    transition: background .15s ease-in-out;

    &:hover {
      background: $range-handle-color-hover;
    }
  }

  &:active::-webkit-slider-thumb {
    background: $range-handle-color-hover;
  }

  &::-moz-range-thumb {
    width: $range-handle-size;
    height: $range-handle-size;
    border: 0;
    border-radius: 50%;
    background: $range-handle-color;
    cursor: pointer;
    transition: background .15s ease-in-out;

    &:hover {
      background: $range-handle-color-hover;
    }
  }

  &:active::-moz-range-thumb {
    background: $range-handle-color-hover;
  }
  
  // Focus state
  &:focus {
    
    &::-webkit-slider-thumb {
      box-shadow: 0 0 0 3px $shade-0,
                  0 0 0 6px $teal;
    }
  }
}


// Range Label
.range-slider__value {
  display: inline-block;
  position: relative;
  width: $range-label-width;
  color: $shade-0;
  line-height: 20px;
  text-align: center;
  border-radius: 3px;
  background: $range-label-color;
  padding: 5px 10px;
  margin-left: 8px;

  &:after {
    position: absolute;
    top: 8px;
    left: -7px;
    width: 0;
    height: 0;
    border-top: 7px solid transparent;
    border-right: 7px solid $range-label-color;
    border-bottom: 7px solid transparent;
    content: '';
  }
}


// Firefox Overrides
::-moz-range-track {
    background: $range-track-color;
    border: 0;
}

input::-moz-focus-inner,
input::-moz-focus-outer { 
  border: 0; 
}
</style>
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
          <label for="city"> {{ (isset($citydata)) ? $citydata : '' }}</label>
        </li>
        <li class="locationFilterMap">
          <input type="radio" id="" name="" value="">
          <label for="city"> Other Locations</label><br> </li>        
        </ul>
        <input id="searchTextField_mobile" type="text" name="location" value="{{ (isset($selectedFilter['location'])) ? $selectedFilter['location'] : '' }}" placeholder="Enter a location" autocomplete="on">
      </div>
    </li>

      <li class="nav-item justify-content-between text-left select-drop-down">
      <p>Distance</p>
      <div class="distance-filter">
       <div class="distance-inner">
          @if(Request::get('distance'))<?php $distanceRange = Request::get('distance'); ?>@else <?php $distanceRange = '1000'; ?> @endif
          <div class="range-slider" style="margin:0;display: flex; flex-direction: column-reverse;">
          <input class="range-slider__range "  name="distance" type="range" value="" min="0" max="10000">
          <span class="range-slider__value">0 - {{ $distanceRange }} Miles</span>
          </div>
        </div>
       

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

      <select class="select-sidebar drop_mobile" name="created_at">

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


    



function showVal1(newVal){
//console.log(newVal);
  document.getElementById("valBox1").innerHTML=newVal;
  document.getElementById("distanceKM1").value=newVal;

}
</script>
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

  $(".drop_mobile").append("<option value="+ (date.getDate()) + "-" + (date.getMonth())+ "-" + date.getFullYear() +  ">" + (date.getDate()) + " " + (month[date.getMonth()])+ " " + date.getFullYear() + "   (" + weekday[date.getDay()] + ")</option>");
}

</script>

 <script type="text/javascript">
 
const settings={
  fill: '#FF0000',
  background: '#d7dcdf'
}


const sliders = document.querySelectorAll('.range-slider');


Array.prototype.forEach.call(sliders,(slider)=>{
 
  slider.querySelector('input').addEventListener('input', (event)=>{
   
    slider.querySelector('span').innerHTML = '0 - ' +event.target.value+ ' Miles';
  
    applyFill(event.target);
  });

  applyFill(slider.querySelector('input'));
});


function applyFill(slider) {
 
  const percentage = 100*(slider.value-slider.min)/(slider.max-slider.min);
 
  const bg = `linear-gradient(90deg, ${settings.fill} ${percentage}%, ${settings.background} ${percentage+0.1}%)`;
  slider.style.background = bg;
}
</script>
