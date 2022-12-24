<style type="text/css">
  .filter-ul li {
    list-style: none;
  }
  .progresss{
  background: linear-gradient(to right, #f51b1c 0%, #f51b1c 0%, #fff 0%, #fff 100%);  }

  input.range-slider__range {
    height: 20px;
    width: 100%;
    padding:6px 0 0 0 !important;
  
}
.dropdown-short option:hover {
    background-color: #F51B1C;
}
input.range-slider__range {
  height: 0px;
  padding: 4px 0 1px 0 !important
}
.distance-filter input {
  border:1px solid #929292 !important;
  margin-top: 15px !important;
}
li.nav-item.justify-content-between.text-center.search-title-filter {
    background-color: #f9f5f5;
    padding: 1px;
}
</style>


<ul class="navbar-nav sidebar  accordion" id="accordionSidebar">



<hr class="sidebar-divider mt-2 mb-2 d-sm-block d-md-none">

<!-- Heading -->


<li class="nav-item justify-content-between tex1t-left select-drop-down">

<div class="close_button_filter"><p>X</p></div>


  <span class="d-flex justify-content-between align-items-center my-2">
    <button type="submit" class="web-button search-filter-submit-btn">

     Search

   </button><p><a href="{{ url('/search') }}">Reset All</a></p></span>
 </li>
 @if(!__isEmpty($userDetails))
 <form action="<?= route('user.read.search') ?>" id="filter-serach-form">
   <input name="advance_filter" type="hidden" value="true" />

  <li class="nav-item justify-content-between text-center search-title-filter">
    <p><h4>Filters</h4></p>
    </li>



   <li class="nav-item justify-content-between text-left select-drop-down">
    <p>Location</p>
    <div>
      <ul class="filter-ul" id="locationRd">
        <li class="locationFilterCity"> 
          <input type="radio" id ="" name ="" value="{{ $userDetails->city }}">
          <label for="city"> {{ $userDetails->city }}</label>
        </li>
        <li class="locationFilterMap">
          <input type="radio" id="" name="" value="">
          <label for="city"> Other Locations</label><br> </li>        
        </ul>
        <input id="searchTextField" type="text" name="city" placeholder="Enter a location" autocomplete="on">
      </div>
    </li>

    <li class="nav-item justify-content-between text-left select-drop-down">
      <p>Distance</p>
      <div class="distance-filter">
        <div class="distance-inner">

          @if(Request::get('distance'))<?php $distanceRange = Request::get('distance'); ?>@else <?php $distanceRange = '500'; ?> @endif
          <input id="distanceKM" name="distance" type="hidden" value="" />
          <span>0 - </span><span id="valBox"><?= $distanceRange ?></span> Miles
        </div>
      
        <div class="custom-ranges">
                
      <input class="range-slider__range" type="range" value="<?= $distanceRange ?>" min="0" max="1000" onchange="showVal(this.value)">
        </div>

      </div>
    </li>



    <!-- Heading -->

    <li class="nav-item justify-content-between text-left select-drop-down">
     <div class="accordion_container">

      <div class="accordion_head">
        <div class="d-flex justify-content-between">
          <span>BODY TYPE</span><i class="fa-solid fa-caret-down"></i>
        </div>
      </div>
      <div class="accordion_body" style="display: none;">


       <ul class="filter-ul">
         @foreach($bodyType as $key => $bodytypeval)
         <li> 
          <?php $body_typechecked = false; if(isset($_GET['body_type'])){ foreach ($_GET['body_type'] as $body_typevalue) {if($body_typevalue == $bodytypeval['_id']){ $body_typechecked = true; break; }else{ $body_typechecked = false; }}} ?>
          <input <?php if($body_typechecked == true){ echo 'checked '; } ?>  type="checkbox" name="body_type[]" value="<?= $bodytypeval['_id'] ?>"><span class="css-3rrmd2"><?= $bodytypeval['name'] ?></span>
        </li> 
        @endforeach
      </ul> 

    </div>
    <div class="accordion_head"><div class="d-flex justify-content-between"><span>AGE</span><i class="fa-solid fa-caret-down"></i></div></div>
    <div class="accordion_body" style="display: none;">

     <!-- <input type="range" name="" min="0" max="100" onchange="updateTextInput(this.value);"> -->

     <div class="wrapper-range">
      <div class="values">
        <span id="range1">
          <?php if(isset($_GET['min_age'])){ echo $_GET['min_age']; }else{ echo "18"; } ?>
        </span>
        <span> &dash; </span>
        <span id="range2">
          <?php if(isset($_GET['max_age'])){ echo $_GET['max_age']; }else{ echo "60"; } ?>+
        </span>
      </div>
      <div class="container-range">
        <div class="slider-track"></div>
        <input type="range" name="min_age" min="18" max="60" value="<?php if(isset($_GET['min_age'])){ echo $_GET['min_age']; }else{ echo "18"; } ?>" id="slider-1" oninput="slideOne()">
        <input type="range" name="max_age" min="18" max="60" value="<?php if(isset($_GET['max_age'])){ echo $_GET['max_age']; }else{ echo "60"; } ?>" id="slider-2" oninput="slideTwo()"> 
      </div>
    </div>

  </div>
  <div class="accordion_head"><div class="d-flex justify-content-between"><span>ETHNICITY</span><i class="fa-solid fa-caret-down"></i></div></div>
  <div class="accordion_body" style="display: none;">

   <ul class="filter-ul">
     @foreach($ethnicity as $key => $ethnicityval)
     <li>
      <?php $ethnicitychecked = false; if(isset($_GET['ethnicity'])){ foreach ($_GET['ethnicity'] as $ethnicityvalue) {if($ethnicityvalue == $ethnicityval['_id']){ $ethnicitychecked = true; break; }else{ $ethnicitychecked = false; }}} ?>  
      <input <?php if($ethnicitychecked == true){ echo 'checked '; } ?> type="checkbox" name="ethnicity[]" value="<?= $ethnicityval['_id'] ?>"><span class="css-3rrmd2"><?= $ethnicityval['name'] ?></span>
    </li> 
    @endforeach
  </ul> 

</div>
<div class="accordion_head"><div class="d-flex justify-content-between"><span>HEIGHT</span><i class="fa-solid fa-caret-down"></i></div></div>
<div class="accordion_body" style="display: none;">

  <!-- <input type="range" name="" min="0" max="100" onchange="updateTextInput(this.value);"> -->
  <div class="wrapper-range">
    <div class="values-height">
      <span id="height1">
        <?php if(isset($_GET['min_height'])){ echo $_GET['min_height']; }else{ echo "137"; } ?> cm
      </span>
      <span> &dash; </span>
      <span id="height2">
        <?php if(isset($_GET['max_height'])){ echo $_GET['max_height']; }else{ echo "213"; } ?> cm
      </span>
    </div>
    <div class="container-range">
      <div class="slider-track-height"></div>
      <input type="range" name="min_height" min="137" max="213" value="<?php if(isset($_GET['min_height'])){ echo $_GET['min_height']; }else{ echo "137"; } ?>" id="slider-height1" oninput="slideOneHeight1()">
      <input type="range" name="max_height" min="137" max="213" value="<?php if(isset($_GET['max_height'])){ echo $_GET['max_height']; }else{ echo "213"; } ?>" id="slider-height2" oninput="slideTwoheight2()"> 
    </div>
  </div>
</div>
<div class="accordion_head"><div class="d-flex justify-content-between"><span>HAIR COLOR</span><i class="fa-solid fa-caret-down"></i></div></div>
<div class="accordion_body" style="display: none;">

 <ul class="filter-ul">
   @foreach($hairColor as $key => $hairColorVal)
   <li>
    <?php $hair_colorchecked = false; if(isset($_GET['hair_color'])){ foreach ($_GET['hair_color'] as $hair_colorvalue) {if($hair_colorvalue == $hairColorVal['_id']){ $hair_colorchecked = true; break; }else{ $hair_colorchecked = false; }}} ?> 
    <input <?php if($hair_colorchecked == true){ echo 'checked '; } ?> type="checkbox" name="hair_color[]" value="<?= $hairColorVal['_id'] ?>"><span class="css-3rrmd2"><?= $hairColorVal['name'] ?></span>
  </li> 
  @endforeach
</ul> 

</div>

<div class="accordion_head"><div class="d-flex justify-content-between"><span>EYE COLOR</span><i class="fa-solid fa-caret-down"></i></div></div>
<div class="accordion_body" style="display: none;">

 <ul class="filter-ul">
   @foreach($eyeColor as $key => $eyeColorVal)
   <li>
    <?php $eye_colorchecked = false; if(isset($_GET['eye_color'])){ foreach ($_GET['eye_color'] as $eye_colorvalue) {if($eye_colorvalue == $eyeColorVal['_id']){ $eye_colorchecked = true; break; }else{ $eye_colorchecked = false; }}} ?> 
    <input <?php if($eye_colorchecked == true){ echo 'checked '; } ?> type="checkbox" name="eye_color[]" value="<?= $eyeColorVal['_id'] ?>"><span class="css-3rrmd2"><?= $eyeColorVal['name'] ?></span>
  </li> 
  @endforeach
</ul> 

</div>




<div class="accordion_head"><div class="d-flex justify-content-between"><span>SMOKING</span><i class="fa-solid fa-caret-down"></i></div></div>
<div class="accordion_body" style="display: none;">


 <ul class="filter-ul">
  <?php 
  $smoking = array("Non Smoker", "Light Smoker", "Heavy Smoker");
  $length = count($smoking);
  for ($i = 0; $i < $length; $i++) {
    ?>
    <li>
      <?php $smokechecked = false; if(isset($_GET['smoke'])){ foreach ($_GET['smoke'] as $smokevalue) {if($smokevalue == $i){ $smokechecked = true; break; }else{ $smokechecked = false; }}} ?>  
      <input <?php if($smokechecked == true){ echo 'checked '; } ?> type="checkbox" name="smoke[]" value="<?= $i; ?>"><span class="css-3rrmd2"><?= $smoking[$i]; ?></span>
    </li> 
    <?php 
  }

  ?>

</ul> 

</div>
<div class="accordion_head"><div class="d-flex justify-content-between"><span>DRINKING</span><i class="fa-solid fa-caret-down"></i></div></div>
<div class="accordion_body" style="display: none;">

 <ul class="filter-ul">
  <?php 
  $drinking = array("Non Drinker", "Social Drinker", "Heavy Drinker");
  $length = count($drinking);
  for ($i = 0; $i < $length; $i++) {
    ?>
    <li>
      <?php $drinkchecked = false; if(isset($_GET['drink'])){ foreach ($_GET['drink'] as $drinkvalue) {if($drinkvalue == $i){ $drinkchecked = true; break; }else{ $drinkchecked = false; }}} ?> 
      <input <?php if($drinkchecked == true){ echo 'checked '; } ?> type="checkbox" name="drink[]" value="<?= $i; ?>"><span class="css-3rrmd2"><?= $drinking[$i]; ?></span>
    </li>
    <?php 
  }

  ?>

</ul> 

</div>
<div class="accordion_head"><div class="d-flex justify-content-between"><span>RELATIONSHIP STATUS</span><i class="fa-solid fa-caret-down"></i></div></div>
<div class="accordion_body" style="display: none;">

  <ul class="filter-ul">
   @foreach($relationshipStatus as $key => $relationshipStatusVal)
   <li> 
    <?php $relationchecked = false; if(isset($_GET['relationship_status'])){ foreach ($_GET['relationship_status'] as $relationship_statusvalue) {if($relationship_statusvalue == $relationshipStatusVal['_id']){ $relationchecked = true; break; }else{ $relationchecked = false; }}} ?> 
    <input <?php if($relationchecked == true){ echo 'checked '; } ?> type="checkbox" name="relationship_status[]" value="<?= $relationshipStatusVal['_id'] ?>"><span class="css-3rrmd2"><?= $relationshipStatusVal['name'] ?></span>
  </li> 
  @endforeach
</ul> 

</div>
<div class="accordion_head"><div class="d-flex justify-content-between"><span>EDUCATION</span><i class="fa-solid fa-caret-down"></i></div></div>
<div class="accordion_body" style="display: none;">

 <ul class="filter-ul">
   @foreach($education as $key => $educationVal)
   <li> 
    <?php $educationchecked = false; if(isset($_GET['education'])){ foreach ($_GET['education'] as $educationvalue) {if($educationvalue == $educationVal['_id']){ $educationchecked = true; break; }else{ $educationchecked = false; }}} ?> 
    <input <?php if($educationchecked == true){ echo 'checked '; } ?>  type="checkbox" name="education[]" value="<?= $educationVal['_id'] ?>"><span class="css-3rrmd2"><?= $educationVal['name'] ?></span>
  </li> 
  @endforeach
</ul> 
</div>
<div class="accordion_head"><div class="d-flex justify-content-between"><span>CHILDREN</span><i class="fa-solid fa-caret-down"></i></div></div>
<div class="accordion_body" style="display: none;">
 <ul class="filter-ul">
  <?php 
  $child = array("1", "2", "3","4", "5", "6+");
  $length = count($child);
  for ($i = 0; $i < $length; $i++) {
    ?>
    <li> 
      <?php $childchecked = false; if(isset($_GET['children'])){ foreach ($_GET['children'] as $childvalue) {if($childvalue == $i){ $childchecked = true; break; }else{ $childchecked = false; }}} ?> 
      <input <?php if($childchecked == true){ echo 'checked '; } ?> type="checkbox" name="children[]" value="<?= $i; ?>"><span class="css-3rrmd2"><?= $child[$i]; ?></span>
    </li>
    <?php
  }
  ?>

</ul> 
</div>
<div class="accordion_head"><div class="d-flex justify-content-between"><span>LANGUAGE</span><i class="fa-solid fa-caret-down"></i></div></div>
<div class="accordion_body" style="display: none;">

  <input <?php if(isset($_GET['vehicle1'])){ echo 'checked '; } ?>type="checkbox" id="vehicle1" name="vehicle1" value="Bike">
  <label for="vehicle1"> English</label><br>
  <input <?php if(isset($_GET['vehicle2'])){ echo 'checked '; } ?>type="checkbox" id="vehicle2" name="vehicle2" value="Car">
  <label for="vehicle2"> Español</label><br>


  
</div>
<div class="accordion_head"><div class="d-flex justify-content-between"><span>ANNUAL INCOME</span><i class="fa-solid fa-caret-down"></i></div></div>
<div class="accordion_body" style="display: none;">

 <ul class="filter-ul">
   @foreach($annualIncome as $key => $annualIncomeVal)
   <li>
    <?php $incomechecked = false; if(isset($_GET['income'])){ foreach ($_GET['income'] as $incomevalue) {if($incomevalue == $annualIncomeVal['_id']){ $incomechecked = true; break; }else{ $incomechecked = false; }}} ?> 
    <input <?php if($incomechecked == true){ echo 'checked '; } ?> type="checkbox" name="income[]" value="<?= $annualIncomeVal['_id'] ?>"><span class="css-3rrmd2"><?= $annualIncomeVal['name'] ?></span>
  </li> 
  @endforeach
</ul> 

</div>
<div class="accordion_head"><div class="d-flex justify-content-between"><span>NET WORTH</span><i class="fa-solid fa-caret-down"></i></div></div>
<div class="accordion_body" style="display: none;">

 <ul class="filter-ul">
   @foreach($netWorth as $key => $netWorthVal)
   <li> 
    <?php $net_worthchecked = false; if(isset($_GET['net_worth'])){ foreach ($_GET['net_worth'] as $net_worthvalue) {if($net_worthvalue == $netWorthVal['_id']){ $net_worthchecked = true; break; }else{ $net_worthchecked = false; }}} ?>
    <input <?php if($net_worthchecked == true){ echo 'checked '; } ?> type="checkbox" name="net_worth[]" value="<?= $netWorthVal['_id'] ?>"><span class="css-3rrmd2"><?= $netWorthVal['name'] ?></span>
  </li> 
  @endforeach
</ul> 

</div>



<div class="accordion_head"><div class="d-flex justify-content-between"><span>Profile Text</span></div></div>

<input placeholder="e.g. hiking, John Doe, shopping" type="text" name="profile_text" value="<?php if(isset($_GET['profile_text'])){ echo $_GET['profile_text']; } ?>">

<div class="accordion_head"><div class="d-flex justify-content-between">

  <span class="d-flex justify-content-between align-items-center my-2">
    <button type="submit" class="web-button">Search</button>
  </span>

</div>

</div>

</li>
</form>
@endif
</ul>

<div id="overlay_search">
  <div id="popup_search">
    <div class="main_grp_s">
      <div class="group-head">
        <h2>Save Search</h2>
        <div class="close_search">X</div>
      </div>  
      <div class="pop-sh-inner">  
        <form id="save-serach-form" method="post">
        <input name="save_url" type="hidden" value="{{ Request::fullUrl() }}">
        <input name="save_name" minlength="1" maxlength="20"  autocomplete="off" placeholder="Search Title" type="text" value="">
        <div class="search-btm-btn">
          <button type="button" class="btn cancel_btn close_search" >Cancel</button>
          <button type="submit" class="btn btn--action search_save">Save Search</button>
          </form>
        </div>
      </div>
    </div> 
  </div>
</div>


 

<style type="text/css">
  .wrapper-range {
    position: relative;
    width: 100%;
  }
  .container-range {
    position: relative;
    width: 100%;
    height: 50px;
  }
  #slider-1, #slider-2, #slider-height1, #slider-height2 {
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    width: 100%;
    outline: none;
    position: absolute;
    margin: auto;
    top: 4px;
    bottom: 0;
    background-color: transparent;
    pointer-events: none;
    font-size: 10px;
  }
  .slider-track , .slider-track-height{
    width: 100%;
    height: 5px;
    position: absolute;
    margin: auto;
    top: 0;
    bottom: 0;
    border-radius: 5px;
  }
  input[type="range"]::-webkit-slider-runnable-track {
    -webkit-appearance: none;
    height: 5px;
  }
  input[type="range"]::-moz-range-track {
    -moz-appearance: none;
    height: 5px;
  }
  input[type="range"]::-ms-track {
    appearance: none;
    height: 5px;
  }
  input[type="range"]::-webkit-slider-thumb {
    -webkit-appearance: none;
    height: 1.7em;
    width: 1.7em;
    background-color: #fff;
    cursor: pointer;
    margin-top: -9px;
    pointer-events: auto;
    border-radius: 50%;
  }
  input[type="range"]::-moz-range-thumb {
    -webkit-appearance: none;
    height: 1.7em;
    width: 1.7em;
    cursor: pointer;
    border-radius: 50%;
    background-color: #fff;
    pointer-events: auto;
    border: none;
  }
  input[type="range"]::-ms-thumb {
    appearance: none;
    height: 1.7em;
    width: 1.7em;
    cursor: pointer;
    border-radius: 50%;
    background-color: #fff;
    pointer-events: auto;
  }
  input[type="range"]:active::-webkit-slider-thumb {
    background-color: #ffffff;
    border: 1px solid #3264fe;
  }
  .wrapper-range .values {
    display: flex;
    flex-direction: row;
  }
  .container-range input {
    border: none;
    padding: 0;
  }
  .wrapper-range .values span ,.wrapper-range .values-height span {
    padding: 0 2px;
  }
  input[type="range"]::-moz-range-progress {
  background-color: transparent; 
}
input[type="range"]::-moz-range-track {  
  background-color: transparent;
}
/* IE*/
input[type="range"]::-ms-fill-lower {
  background-color: transparent; 
}
input[type="range"]::-ms-fill-upper {  
  background-color: transparent;
}
</style>
<script type="text/javascript">
  window.onload = function () {
    slideOne();
    slideTwo();
    slideOneHeight1();
    slideTwoheight2();
  };

  let sliderOne = document.getElementById("slider-1");
  let sliderTwo = document.getElementById("slider-2");
  let displayValOne = document.getElementById("range1");
  let displayValTwo = document.getElementById("range2");
  let minGap = 0;
  let sliderTrack = document.querySelector(".slider-track");
  let sliderMaxValue = document.getElementById("slider-1").max;

  let sliderOneheight = document.getElementById("slider-height1");
  let sliderTwoheight = document.getElementById("slider-height2");
  let displayValOneheight = document.getElementById("height1");
  let displayValTwoheight = document.getElementById("height2");
  let sliderTrackheight = document.querySelector(".slider-track-height");
  let sliderMaxValueheight = document.getElementById("slider-height1").max;

  function slideOne() {
    if (parseInt(sliderTwo.value) - parseInt(sliderOne.value) <= minGap) {
      sliderOne.value = parseInt(sliderTwo.value) - minGap;
    }
    displayValOne.textContent = sliderOne.value;
    fillColor();
  }
  function slideTwo() {
    if (parseInt(sliderTwo.value) - parseInt(sliderOne.value) <= minGap) {
      sliderTwo.value = parseInt(sliderOne.value) + minGap;
    }
    displayValTwo.textContent = sliderTwo.value + "+";
    fillColor();
  }

  function slideOneHeight1() {
    if (parseInt(sliderTwoheight.value) - parseInt(sliderOneheight.value) <= minGap) {
      sliderOneheight.value = parseInt(sliderTwoheight.value) - minGap;
    }
    displayValOneheight.textContent = sliderOneheight.value + "cm";;
    fillColorhight();
  }
  function slideTwoheight2() {
    if (parseInt(sliderTwoheight.value) - parseInt(sliderOneheight.value) <= minGap) {
      sliderTwoheight.value = parseInt(sliderOneheight.value) + minGap;
    }
    displayValTwoheight.textContent = sliderTwoheight.value + "cm";
    fillColorhight();
  }
  function fillColorhight() {
    min_val = sliderOneheight.value - 137;
    maxVal = sliderMaxValueheight - 137;
    max2_val = sliderTwoheight.value - 137;
    percent1 = (min_val / maxVal) * 100;
    percent2 = (max2_val / maxVal) * 100;
  // incVal = percent1 + 25;
  // decVal = percent1 - 45;
  // decVal2 = percent2 - 10;
  // sliderTrackheight.style.background = `linear-gradient(to right, rgb(208 59 80) 30%, rgb(207 42 65) 30%, rgb(213 80 22) 100%, rgb(208 59 80) 100%)`;
  sliderTrackheight.style.background = `linear-gradient(to right, #dadae5 ${percent1}% , #cf0404 ${percent1}% , #cf0404 ${percent2}%, #dadae5 ${percent2}%)`;
}
function fillColor() {
  min_val = sliderOne.value - 18;
  maxVal = sliderMaxValue - 18;
  max2_val = sliderTwo.value - 18;
  percent1 = (min_val / maxVal) * 100;
  percent2 = (max2_val / maxVal) * 100;
  sliderTrack.style.background = `linear-gradient(to right, #dadae5 ${percent1}% , #cf0404 ${percent1}% , #cf0404 ${percent2}%, #dadae5 ${percent2}%)`;
}


</script>
<script type="text/javascript">function showVal(newVal){
  console.log(newVal);
  document.getElementById("valBox").innerHTML=newVal;
  document.getElementById("distanceKM").value=newVal;
}</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=<?= getStoreSettings('google_map_key') ?>&libraries=places&callback=initialize" async defer></script>

<script type="text/javascript">
  $(document).ready(function(){
    $('.locationFilterCity input').attr('checked', true);
    $("#locationRd li").click(function(){
      $('#locationRd li input').attr('checked', false);
      $(this).find('input').attr('checked', true);
    });
  });
  function initialize() {
   var input = document.getElementById('searchTextField');
   var autocomplete = new google.maps.places.Autocomplete(input);
 }
 google.maps.event.addDomListener(window, 'load', initialize);
</script>

<script>

  $(document).ready(function() {
    $('#trigger_search').click(function() {
      $('#overlay_search').fadeIn(300);  
    });
    $('.close_search').click(function() {
      $('#overlay_search').fadeOut(300);
    });

    $('.search-filter-submit-btn').click(function() {
      $('#filter-serach-form').submit()
    });
  });
/* When the user clicks on the button, 
toggle between hiding and showing the dropdown content */
function mySerach() {
  document.getElementById("myDropdown_search").classList.toggle("show_search");
}

// Close the dropdown if the user clicks outside of it
window.onclick = function(event) {
  if (!event.target.matches('.dropbtn_search')) {
    var dropdowns = document.getElementsByClassName("dropdown-content_search");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show_search')) {
        openDropdown.classList.remove('show_search');
      }
    }
  }
}
</script>
<style>
  .dropbtn_search {
    display: flex;
    align-items: center;
    margin-top: 1rem;
    height: 40px;
    border-radius: 4px;
    background-color: #fff;
    border: 1px solid #c4c4c4;
    color: #4d4d4d;
    font-size: 16px;
    padding: 0 15px;
    cursor: pointer;
  }

  .dropbtn_search:hover, .dropbtn_search:focus {
    background-color: #fff;
    color: #000;
  }

  .dropdown_search {
    position: relative;
    display: inline-block;
    /*padding-bottom: 14px;*/
    border-bottom: 1px solid #d1c6c6;
    width: 100%;  
  }

  .dropdown-content_search {
    display: none;
    position: absolute;
    border-radius: 4px;
    background-color: #fff;
    border: 1px solid #c4c4c4;
    padding: 0.5rem 0 ;
    text-align: left;
    width: 100%;
    z-index: 1;
  }
  div#myDropdown_search ul li {
    list-style: none;
  }
  #myDropdown_search .list-item {
    padding: 3px 16px;
    font-size: 16px;
    font-weight: 400;
    color: #4d4d4d;
  }
  #myDropdown_search .main-title {
    font-size: 14px;
    font-weight: 400;
    color: #b4b6b5;
    padding: 5px 16px;
    cursor: default;
  }
  .dropdown-content_search a {
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
  }
  .show_search {display: block;}

  #trigger_search {
    cursor: pointer;
  }



  #overlay_search {
    position: fixed;
    height: 100%;
    width: 100%;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    background: rgba(0,0,0,0.8);
    display: none;
    z-index: 9
  }
  .main_grp_s{
    outline: none!important;
    border: 5px solid #e8e8e8!important;
    border-radius: 0!important;
    -moz-border-radius: 0!important;
    -webkit-border-radius: 0!important;
    -webkit-box-shadow: 1px 7px 24px -8px #464646!important;
    -moz-box-shadow: 1px 7px 24px -8px #464646!important;
    box-shadow: 1px 7px 24px -8px #464646!important;
  }
  #popup_search {
    font-family: 'source sans pro,HelveticaNeue,Helvetica,Arial,Sans';
    max-width: 600px;
    width: 80%;
    max-height: 300px;
    top: 100px; 
    height: auto;
    /*padding:0 20px 20px 20px;*/
    position: relative;
    background: #fff;
    margin: 20px auto;
  }
  .close_search {
    padding-right: 10px;
  }
  .group-head {
    display: flex;
    align-items: center;
    justify-content: space-between;
    border-bottom: 1px solid #d9d9d9;
  }
  .group-head h2 {
    text-align: center;
    width: 100%;
    font-weight: 100;
    margin-top: 10px;
    font-size: 1.3rem;  
  }
  #popup_search input[type="text"] {
    height: 40px;
    width: 100%;
    border-radius: 4px;
    background-color: #fff;
    border: solid 1px #c4c4c4;
    color: #4d4d4d;
    font-size: 16px;
    margin-top: 10px;
    padding: 0px 15px;
  }
  .pop-sh-inner {
    padding: 9px 20px 15px 20px;
  }
  .search-btm-btn .search_save {
    line-height: 1;
    text-align: center;
    padding: 0.75rem 1.25rem;
    font-size: 16px;
    vertical-align: middle;
    white-space: nowrap;
    cursor: pointer;
    font-weight: 700;
    text-decoration: none;
    color: #fff;
    background-color: #cf0404;
    border-color: #cf0404;
    border-radius: 3px;
  }
  button.btn.cancel_btn {
    display: inline-block;
    line-height: 1;
    text-align: center;
    padding: 0.75rem 1.25rem;
    font-size: 16px;
    vertical-align: middle;
    white-space: nowrap;
    cursor: pointer;
    font-weight: 700;
    text-decoration: none;
    color: CurrentColor;
    background: 0 0;
    border: none;
  }
  .search-btm-btn {
    display: flex;
    align-items: center;
    margin-top: 15px;
  }

  #save-serach-form .error {
    color: #cc180c;
    /* font-size: 7rem; */
    position: relative;
    line-height: 1;
    width: 14.5rem;
}
</style>
