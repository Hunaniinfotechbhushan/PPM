@extends('public-master')
@section('content')
<style type="text/css">
    
    .online_user_icon{

        position: absolute;
        right: 15px;
        top: 15px;
    }
</style>

<body id="page-top" class="lw-page-bg lw-public-master dashboard">

    <!-- Section -->

    <section class="pb-5">

      <div class="container-fluid">

         <div class="row pt-3 mt-3" id="lwUserFilterContainer">

             <div class="col-md-12"><h3>Featured Members</h3></div>

         </div> 
         <div class="row row-cols-sm-1 row-cols-md-2 row-cols-lg-4 pt-2" id="lwUserFilterContainer">
            @if(!__isEmpty($filterData))
            @foreach($filterData as $filters)
            
 <?php  //$imgURL = url('/').'/media-storage/users/'.$filters['uid'].'/'.$filters['profileImage']; 


 if($filters['profileImage']){
     $imgURL = url('/').'/media-storage/users/'.$filters['uid'].'/'.$filters['profileImage'];

 }else{
  
  $imgURL = url('/').'/imgs/default-image.png';
}


?>


<div class="col-6 col-sm-6 col-lg-3 col-md-3">

  <div class="card text-center lw-user-thumbnail-block p-0">

    <!-- show user online, idle or offline status -->

    <a href="{{ url('/member')}}/{{ $filters['uid'] }}">
     <div class="f-card-img">
        <img src="{{ $imgURL }}">
    </div>
</a>

<!-- /show user online, idle or offline status -->



<div class="card-title">

  <h5> <a class="text-secondary" href="{{ url('/member')}}/{{ $filters['uid'] }}"> {{ $filters['username'] }} </a> </h5>

  <div class=" d-flex justify-content-between align-items-center"><p><span>{{ $filters['userAge'] }}</span><span> {{ $filters['city'] }}</span></p><span><i class="fa-solid fa-camera"> {{ $filters['totalPhotto']}} </i></span></div>

</div>

</div>

</div>



@endforeach
@else
<!-- info message -->
<div class="col-sm-12 alert alert-info text-center">
    <?= __tr('There are no user.') ?>
</div>
<!-- / info message -->
@endif
</div>

<div class="row  px-3 my-3 search" id="serch">

 <div class="col-md-12"><a href="{{ url('/search')}}"><i class="fa-solid fa-magnifying-glass"></i>Search More </a></div>

</div> 

<hr>

</div>



<!--New Members-->

<div class="container-fluid">    

 <div class="row pt-3 mt-3" id="lwUserFilterContainer">

     <div class="col-md-12"><h3>New Members</h3></div>

 </div> 

 <div class="row row-cols-sm-1 row-cols-md-2 row-cols-lg-4 pt-2" id="lwUserFilterContainer">
    @if(!__isEmpty($filterDataNewUser))
    @foreach($filterDataNewUser as $filters)
    
    <?php  

    if($filters['profileImage']){
     $imgURL = url('/').'/media-storage/users/'.$filters['uid'].'/'.$filters['profileImage'];

 }else{
  
  $imgURL = url('/').'/imgs/default-image.png';
} 
?>

<div class="col-6 col-sm-6 col-lg-3 col-md-3">

  <div class="card text-center lw-user-thumbnail-block  p-0">

    <!-- show user online, idle or offline status -->
    <a href="{{ url('/member')}}/{{ $filters['uid'] }}">
     <div class="f-card-img">
        <img src="{{ $imgURL }}">
    </div>
</a>

<!-- /show user online, idle or offline status -->



<div class="card-title">

  <h5> <a class="text-secondary" href="{{ url('/member')}}/{{ $filters['uid'] }}"> {{ $filters['username'] }} </a> </h5>

  <div class=" d-flex justify-content-between align-items-center"><p><span>{{ $filters['userAge'] }}</span><span> {{ $filters['city'] }}</span></p><span><i class="fa-solid fa-camera"> {{ $filters['totalPhotto']}} </i></span></div>

</div>

</div>

</div>



@endforeach
@else
<!-- info message -->
<div class="col-sm-12 alert alert-info text-center">
    <?= __tr('There are no user.') ?>
</div>
<!-- / info message -->
@endif
</div>

<div class="row  px-3 my-3 search" id="serch">

 <div class="col-md-12"><a href="{{ url('/search')}}"><i class="fa-solid fa-magnifying-glass"></i>Search More </a></div>

</div> 

<hr>

</div>







<!--New Members-->

<div class="container-fluid">    

 <div class="row pt-3 mt-3" id="lwUserFilterContainer">

     <div class="col-md-12"><h3>Popular Members</h3></div>

 </div> 

 <div class="row row-cols-sm-1 row-cols-md-2 row-cols-lg-4 pt-2" id="lwUserFilterContainer">
   @if(!__isEmpty($filterDataPopularUser))
   @foreach($filterDataPopularUser as $filters)
   
   <?php  

   if($filters['profileImage']){
     $imgURL = url('/').'/media-storage/users/'.$filters['uid'].'/'.$filters['profileImage'];

 }else{
  
  $imgURL = url('/').'/imgs/default-image.png';
} 
?>

<div class="col-6 col-sm-6 col-lg-3 col-md-3">

  <div class="card text-center lw-user-thumbnail-block  p-0">

    <!-- show user online, idle or offline status -->

    <!-- /show user online, idle or offline status -->
    <a href="{{ url('/member')}}/{{ $filters['uid'] }}">
      <div class="f-card-img">
        <img src="{{ $imgURL }}">
    </div>
</a>




<div class="card-title">

  <h5> <a class="text-secondary" href="{{ url('/member')}}/{{ $filters['uid'] }}"> {{ $filters['username'] }} </a> </h5>

  <div class=" d-flex justify-content-between align-items-center"><p><span>{{ $filters['userAge'] }}</span><span> {{ $filters['city'] }}</span></p><span><i class="fa-solid fa-camera"> {{ $filters['totalPhotto']}} </i></span></div>

</div>

</div>

</div>

@endforeach
@else
<!-- info message -->
<div class="col-sm-12 alert alert-info text-center">
    <?= __tr('There are no user.') ?>
</div>
<!-- / info message -->
@endif

</div>

<div class="row  px-3 my-3 search" id="serch">

 <div class="col-md-12"><a href="{{ url('/search')}}"><i class="fa-solid fa-magnifying-glass"></i>Search More </a></div>

</div> 

<hr>

</div>



<!--New Members-->

<div class="container-fluid">    

 <div class="row pt-3 mt-3" id="lwUserFilterContainer">

     <div class="col-md-12"><h3>Most Recent Search</h3></div>

 </div> 

 <div class="row row-cols-sm-1 row-cols-md-2 row-cols-lg-4 pt-2" id="lwUserFilterContainer">
   @if(!__isEmpty($filterDataRecentUser))
   @foreach($filterDataRecentUser as $filters)
   
   <?php  

   if($filters['profileImage']){
     $imgURL = url('/').'/media-storage/users/'.$filters['uid'].'/'.$filters['profileImage'];

 }else{
  
  $imgURL = url('/').'/imgs/default-image.png';
} 
?>

<div class="col-6 col-sm-6 col-lg-3 col-md-3">

  <div class="card text-center lw-user-thumbnail-block  p-0">

    <!-- show user online, idle or offline status -->

    <!-- /show user online, idle or offline status -->
    <a href="{{ url('/member')}}/{{ $filters['uid'] }}">
      <div class="f-card-img">
        <img src="{{ $imgURL }}">
    </div>
</a>




<div class="card-title">

  <h5> <a class="text-secondary" href="{{ url('/member')}}/{{ $filters['uid'] }}"> {{ $filters['username'] }} </a> </h5>

  <div class=" d-flex justify-content-between align-items-center"><p><span> {{ $filters['userAge'] }}</span><span> {{ $filters['city'] }}</span></p><span><i class="fa-solid fa-camera"> {{ $filters['totalPhotto']}} </i></span></div>

</div>

</div>

</div>

@endforeach
@else
<!-- info message -->
<div class="col-sm-12 alert alert-info text-center">
    <?= __tr('There are no user.') ?>
</div>
<!-- / info message -->
@endif

</div>

<div class="row  px-3 my-3 search" id="serch">

 <div class="col-md-12"><a href="{{ url('/search')}}"><i class="fa-solid fa-magnifying-glass"></i>Search More </a></div>

</div> 

<hr>

</div>    



<!--Online Member-->

<div class="container-fluid">    

 <div class="row pt-3 mt-3" id="lwUserFilterContainer">

     <div class="col-md-12"><h3>Online Member</h3></div>

 </div> 

 <div class="row pt-2" id="lwUserFilterContainer">
   @if(!__isEmpty($filterDataOnline))
   @foreach($filterDataOnline as $filters)
   
   <?php  

   if($filters['profileImage']){
     $imgURL = url('/').'/media-storage/users/'.$filters['uid'].'/'.$filters['profileImage'];

 }else{
  
  $imgURL = url('/').'/imgs/default-image.png';
} 
?>

<div class="col-6 col-sm-6 col-lg-3 col-md-3">

  <div class="card text-center lw-user-thumbnail-block p-0 active">

    <!-- show user online, idle or offline status -->

    <div class="online_user_icon">

       <span class="lw-dot lw-dot-danger" title="Offline"></span> 

   </div>
   <a href="{{ url('/member')}}/{{ $filters['uid'] }}">
     <div class="f-card-img">
        <img src="{{ $imgURL }}">
    </div>
</a>

<!-- /show user online, idle or offline status -->




<div class="card-title">

  <h5> <a class="text-secondary" href="{{ url('/member')}}/{{ $filters['uid'] }}"> {{ $filters['username'] }} </a> </h5>

  <div class=" d-flex justify-content-between align-items-center"><p><span>{{ $filters['userAge'] }}</span><span> {{ $filters['city'] }}</span></p><span><i class="fa-solid fa-camera"> {{ $filters['totalPhotto']}} </i></span></div>

</div>
</div>

</div>
@endforeach
@else
<!-- info message -->
<div class="col-sm-12 alert alert-info text-center">
    <?= __tr('There are no user online.') ?>
</div>
<!-- / info message -->
@endif






</div>

<div class="row  px-3 my-3 search" id="serch">

 <div class="col-md-12"><a href="{{ url('/search')}}"><i class="fa-solid fa-magnifying-glass"></i>Search More </a></div>

</div> 

<hr>

</div>    





</section>


</div>

</body>


@stop