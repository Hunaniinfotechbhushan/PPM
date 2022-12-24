@extends('public-master')
@section('content')

<link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css">
<script src="https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js"></script>

<style type="text/css">
	.activity-area .message-template {
		padding: 25px 0px 0px 0px;
		width: 100%;
	}
	.activity-area .activity_visitor {
		border-top: 1px solid #ccc;
	}
	.activity-area .message-template h3 {
		margin-bottom: 0;
	}
	.add_new_photo_template,.img-about {
		display: grid;
		grid-template-columns: 2fr 13fr;
		border-bottom: 1px solid #ccc;
		border-top: 1px solid #ccc;
		padding: 30px;
	}
	.activity-area .add_photo_header {
		padding: 10px 0px;
	}
	.activity-area .uploaded_video_picture {
		display: flex;
		justify-content: start;
		align-items: self-end;
		padding: 10px 10px 10px 0px;
		flex-wrap: wrap;
	}
	.uploaded_video_picture>img {
		max-width: 390px;
		width: 100%;
		max-height: 299px;
		height: 100%;
		margin-right: 45px;
	}
	span.post_time {
		color: #a2a2a2;
	}
	.activity_vist_link{
		text-decoration: underline;
		color: blue;
	}	
	.activity_uploaded_video_link{
		max-width: 390px;
		width: 100%;
		max-height: 299px;
		height: 100%;
		margin-right: 45px;
	}
	
	* { box-sizing: border-box; }

	body { font-family: sans-serif; }

	.carousel {
		background:none;
		left:-17px
	}
	.carousel-cell {
		position: relative;
		width: 100px;
		height: 100px;
		margin-right: 10px;
		border-radius: 100px;
		counter-increment: carousel-cell;
		background: #F21;
		display: flex;
		justify-content: center;
		align-items: center;

	}

	.carousel-cell img {
		vertical-align: middle;
		border-style: none;
		width: 90%;
		height: 90%;
		border-radius: 50%;
	}
	.carousel-cell span {
		position: absolute;
		bottom: -25px;
	}
/* cell number */
.flickity-button {
	position: absolute;
	background: hsla(0,0%,100%,.75);
	border: none;
	color: #333;
	display: none !important;
}
.flickity-page-dots {
	display: none;
}
.flickity-viewport {
	height: 134px !important;
}
.fa-plus-circle {
	color: blue;
	position: absolute;
	left: 62px;
	bottom: 0px;
	background-color: #fff;

}

.wrap-stories{
	display: flex;
	align-items: center;
}


@media screen and (max-width: 600px) {
	.carousel-cell {
		width: 80px;
		height: 80px;
	}
	.flickity-viewport {
		height: 114px !important;
	}
}

.something_add_button.is-selected {
	margin-top: 39px;
}
.flickity-slider {
/*	left: -25px !important;*/
/*	transform: translateX(0.72%) !important;*/
/*transform: none !important;*/

}
.carousel {
	margin-left: 50px;
}

@media only screen and (max-width: 1200px){
	.flickity-slider {
		left: -15px !important;
	}
}

</style>
<section class="pb-5 pro-item">


	<div class="container-fluid px-0">
		<form method="POST" enctype="multipart/form-data" id="story_upload_form">
			@csrf
			<input type="file" name="media" id="storyUpload" style="display:none"/> 
			<input type="hidden" id="videoThumbnailFieldstory" name="videoThumbnail">

		</form>

		<div class="wrap-stories">
			<button class="something_add_button">+</button>

			@if($getUserStory->count() > 0)		

			<div class="carousel w-100" data-flickity='{ "groupCells": true }'>	 


				@forelse($getUserStory as $key=>$value)


				<a href="{{ url('/') }}/public/frontend/story/{{ $value->file }}" class="glightbox4">

					<div class="carousel-cell">					
						<span>{{ $value->username }}</span> 
						@if($value->type == 'image')
						<img class="story-media-src" src="{{ url('/') }}/public/frontend/story/{{ $value->file }}"alt="GeeksforGeeks logo">
						@else

						<img class="story-media-src test" src="{{ url('/') }}/public/frontend/story/video-icon-1.png"alt="GeeksforGeeks logo">

						@endif

					</div>
				</a>
				@empty
				@endforelse	
				@endif
			</div>

		</div>
		<div class="col-md-9 col-sm-12">

			<ul class="nav interest-tab activity-section-area" role="tablist">

				<li class="tab-filter-li active" role="LocalActivitieTab" data-toggle="tab" data-filter="viewedMeDropdown"><a href=".LocalActivitieTab" aria-controls="profile" role="tab" data-toggle="tab"><h3>Local Activities</h3></a>

				</li>


				<li class="tab-filter-li" role="FavouritedActivitieTab" data-toggle="tab" data-filter="FavouritedActivitieTab"><a href=".FavouritedActivitieTab" aria-controls="profile" role="tab" data-toggle="tab"><h3>Favourited Activities</h3></a></li>
			</ul>
		</div>


		<div class="row pt-2 mt-3 tab-content" id="lwUserFilterContainer activity-area">

			<div class="col-12 p-0 tab-pane active LocalActivitieTab">

				<div class="activity-desc-area add_new_photo_template">
					<p>Recent Activities by local people who match your account preferences and location data.</p>
				</div>



				@forelse($user_local_activity as $key => $value)

				@include('activity.activity-inner-content') 


				@empty
				@endforelse
				<div class="activity-pagination text-right">
					{!! $user_local_activity->links()  !!}
				</div>
			</div>

			<div class="col-12 p-0 tab-pane FavouritedActivitieTab">
				<div class="activity-desc-area add_new_photo_template">
					<p>Recent Activities by your favourites.</p>
				</div>

				@forelse($user_fav_activity as $key => $value)
				@include('activity.activity-inner-content') 

				@empty

				@endforelse
				<div class="activity-pagination text-right">
					{!! $user_fav_activity->links()  !!}
				</div>
			</div>
		</div>
	</div>
</section>


<script type="text/javascript">
	$(".activity-section-area li").on('click', function(e){
		$(".activity-section-area li.active").removeClass('active');
		$(this).addClass('active');
	});
</script>
<script type="text/javascript">

	  // Public Video Thumbnails Create 

	  document.getElementById('storyUpload').addEventListener('change', function(event) {
    //alert('kk');

    const fileCheck = this.files[0];
    const  fileType = fileCheck['type'];
    const validImageTypes = ['image/gif', 'image/jpeg', 'image/png', 'image/webp', 'image/apng', 'image/avif', 'image/svg+xml'];
 //console.log(fileType);
 if (!validImageTypes.includes(fileType)) {


 	var file = event.target.files[0];
 	var fileReader = new FileReader();
 	if (file.type.match('image')) {
 		fileReader.onload = function() {
 			var img = document.createElement('img');
 			img.src = fileReader.result;
 			document.getElementsByTagName('div')[0].appendChild(img);
 		};
 		fileReader.readAsDataURL(file);
 	} else {
 		fileReader.onload = function() {
 			var blob = new Blob([fileReader.result], {type: file.type});
 			var url = URL.createObjectURL(blob);
 			var video = document.createElement('video');
 			var timeupdate = function() {
 				if (snapImage()) {
 					video.removeEventListener('timeupdate', timeupdate);
 					video.pause();
 				}
 			};
 			video.addEventListener('loadeddata', function() {
 				if (snapImage()) {
 					video.removeEventListener('timeupdate', timeupdate);
 				}
 			});
 			var snapImage = function() {
 				var canvas = document.createElement('canvas');
 				canvas.width = video.videoWidth;
 				canvas.height = video.videoHeight;
 				canvas.getContext('2d').drawImage(video, 0, 0, canvas.width, canvas.height);
 				var image = canvas.toDataURL();
 				var success = image.length > 100000;
 				if (success) {
 					var img = document.createElement('img');
 					img.src = image;
      //console.log(image);

       //$('#videoThumbnailField').val(image);
       document.getElementById('videoThumbnailFieldstory').value = image;
       $('#videoThumbnailFieldstory').val(image);
     }
     return success;
   };
   video.addEventListener('timeupdate', timeupdate);
   video.preload = 'metadata';
   video.src = url;
      // Load video in Safari / IE11
      video.muted = true;
      video.playsInline = true;
      video.play();
    };
    fileReader.readAsArrayBuffer(file);
  }
}else{

	var file = event.target.files[0];
	var fileReader = new FileReader();
	if (file.type.match('image')) {
		fileReader.onload = function() {
			var img = document.createElement('img');

			img.src = fileReader.result;
          // document.getElementsByTagName('div')[0].appendChild(img);
          var urlimage =  img;


          $(".imageOrvideo-result").html(urlimage);
          $(".upload-input-file").hide();
        };
        fileReader.readAsDataURL(file);

      };


    }
  });
</script>

@stop
