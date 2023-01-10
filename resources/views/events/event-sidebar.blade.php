<style type="text/css">
  .eventrange{
    --webkit-appearance: none !important;
border:none !important;
  }  
    
</style>
<style type="text/css">
    // Base Colors
$shade-10: #d7dcdf !default;
$shade-1: #FF0000 !default;
$shade-0: #fff !default;
$teal: #1abc9c !default;

// Range Slider
$range-width: 100% !default;

$range-handle-color: $shade-10 !default;
$range-handle-color-hover: $teal !default;
$range-handle-size: 20px !default;

$range-track-color: $shade-1 !default;
$range-track-height: 10px !default;

$range-label-color: $shade-10 !default;
$range-label-width: 60px !default;

  .distance-filter  .range-slider {
    margin: 0px !important;
    display: flex;
    flex-direction: column-reverse;

}

.distance-filter input {
    height: 7px;
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

 <li class="nav-item justify-content-between text-left select-drop-down">
    <p>Location</p>
    <div>
      <ul class="filter-ul" id="locationRd">
        <li class="locationFilterCity"> 
          <input type = "radio" name = "location" id = "locationfirst">
          <label for="city"> {{ (isset($citydata)) ? $citydata : '' }}</label>
        </li>
        <li class="locationFilterMap">
        <input type = "radio" name = "location" id = "locationsec">
          <label for="city">Other Locations</label><br> </li>        
        </ul>
        <input id="searchTextField" type="text"   name="location" class="map-input" value="{{ (isset($selectedFilter['location'])) ? $selectedFilter['location'] : '' }}" placeholder="Enter a location" autocomplete="on">
      </div>
    </li>

     <li class="nav-item justify-content-between text-left select-drop-down">
      <p>Distance</p>
      <div class="distance-filter">
       <div class="distance-inner">
          @if(Request::get('distance'))
            <?php $distanceRange = Request::get('distance'); ?>
          @else 
            <?php $distanceRange = '1000'; ?> 
          @endif
          <div class="range-slider" style="margin:0;display: flex; flex-direction: column-reverse;">
          <input class="range-slider__range "  name="distance" type="range" value="{{ $distanceRange }}" min="0" max="1000">
          <span class="range-slider__value">0 - {{ $distanceRange }} Miles</span>
          </div>
        </div>
      </div>      
    </li>

    <li class="nav-item justify-content-between text-left select-drop-down">
      <p>Options</p>
        <ul class="filter-ul">
          <?php 
          $option = array("Verified users only");
          $length = count($option);
          for ($i = 0; $i < $length; $i++) {
            $lowerName = strtolower($option[$i]);
            $nameVal = str_replace(" ","_",$lowerName);

            if(isset($_GET[$nameVal])){
              $checkedBox = "checked";
            }else{
               $checkedBox = "";
            }
            ?>
            <li> 
              <input type="checkbox" name="<?= $nameVal; ?>" {{ $checkedBox }}><span class="css-3rrmd2"><?= $option[$i]; ?></span>
            </li>
              
            <?php 
          }
          ?> 
        </ul>

      
    </li>

 
 <li class="nav-item justify-content-between text-left select-drop-down">

     <p>Meet Type</p>

     <select class="select-sidebar" name="meet_type">
         <option value="">Any</option>

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

<script src="https://maps.googleapis.com/maps/api/js?key=<?= getStoreSettings('google_map_key') ?>&libraries=places&callback=initialize" async defer></script>


<script type="text/javascript">
   
     const locationInputs = document.getElementsByClassName("map-input");


    const autocompletes = [];
    const geocoder = new google.maps.Geocoder;


    $('#searchTextField-popup').on('click', function(e) {
       const locationInputsAddress = document.getElementById("searchTextField-popup").value;
       geocoder.geocode({'address': locationInputsAddress}, function (results, status) {
        if (status === google.maps.GeocoderStatus.OK) {
            const lat = results[0].geometry.location.lat();
            const lng = results[0].geometry.location.lng();

            document.getElementById("address-latitude").value = lat;
            document.getElementById("address-longitude").value = lng;

        }
    });
   });
</script>

<script type="text/javascript">



function showVal(newVal){
console.log('newVal',newVal);
  document.getElementById("valBox").innerHTML=newVal;
  document.getElementById("distanceKM").value=newVal;
}

</script>
<script type="text/javascript">

     $(document).ready(function(){
      $('.locationFilterCity input').attr('checked', true);
              $("#locationfirst").click(function(){
              $('.locationFilterMap input').attr('checked', false);
              $('.pac-target-input').hide();
          // $(this).find('input').attr('checked', false);
      });

   // $('.locationFilterCity input').attr('checked', true);
    // $("#locationRd li").click(function(){
      
    //   $('.main_radio').attr('checked', false);
    //   $(this).find('input').attr('checked', true);
    // });
  });
    
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


