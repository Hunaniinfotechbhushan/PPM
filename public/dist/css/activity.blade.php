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
</style>
@extends('public-master')
@section('content')
<section class="pb-5">

	<div class="container-fluid p-0">

		<div class="row pt-2" id="lwUserFilterContainer activity-area">

			<div class="col-12 tab-content p-0">

				@forelse($user_activity as $key => $value)

				<!-- New Event Post -->
				@if($value->slug == 'event-added')
				<!-- End I visited Section -->
				<div class="activity_visitor activity_section">
					<div class="img-about ">
						<div class="vister-image-icon">
							<img class="vister-profile-image" src="{{ url('/') }}/media-storage/users/{{ $value->_uid }}/{{ $value->profile_picture }}">
							<i class="fa-solid fa-camera"></i>
						</div>
						<div class="message-template">
							<a href="{{ url('/') }}/member/{{ $value->_uid }}" class="activity_vist_link">{{ $value->username }}</a>
								<bold>Event Posted : </bold>
								<span>{{ $value->activity_log }}</span>
								<span class="post_time">{{ Carbon\Carbon::parse($value->activity_created_at)->format('g:i A | j F') }}</span>
							</div>
						</div>		
					</div>


					<!-- New User Added -->
					@elseif($value->slug == 'new-user-added')
					<!-- End I visited Section -->
					<div class="activity_visitor activity_section">
						<div class="img-about ">
							<div class="vister-image-icon">
								<img class="vister-profile-image" src="{{ url('/') }}/media-storage/users/{{ $value->_uid }}/{{ $value->profile_picture }}">
								<i class="fa-solid fa-camera"></i>
							</div>
							<div class="message-template">
								<h3><a href="{{ url('/') }}/member/{{ $value->_uid }}" class="activity_vist_link">{{ $value->username }}</a>
									<span><i class="fa fa-check-circle" aria-hidden="true" style="color:green"> </i></span>
									<!-- <bold>New Profile Added : </bold> -->
									<span>{{ $value->activity_log }}</span>
									<span class="post_time">{{ Carbon\Carbon::parse($value->activity_created_at)->format('g:i A | j F') }}</span></h3>
								</div>
							</div>		
						</div>

						<!-- Upload New Media -->
						@elseif($value->slug == 'user-media-upload')

						<?php 	 
						$getMediaFile = DB::table('user_photos')->where('_id',$value->activity_log)->first(); 
						$mediaTypeTitle = "Added New Photos";
						$mediaType = "image";
						?>
						@if($getMediaFile)

						@if($getMediaFile->extantion_type == 'mp4' || $getMediaFile->extantion_type == 'MOV' || $getMediaFile->extantion_type == 'wmv' || $getMediaFile->extantion_type == 'WMV' || $getMediaFile->extantion_type == '3gp' || $getMediaFile->extantion_type == '3GP' || $getMediaFile->extantion_type == 'avi' || $getMediaFile->extantion_type == 'AVI' || $getMediaFile->extantion_type == 'f4v' || $getMediaFile->extantion_type == 'f4v' || $getMediaFile->extantion_type == 'MP4' || $getMediaFile->extantion_type == 'mov' || $getMediaFile->extantion_type == 'webm' || $getMediaFile->extantion_type == 'mkv' || $getMediaFile->extantion_type == 'flv' || $getMediaFile->extantion_type == 'svi' || $getMediaFile->extantion_type == 'mpg'|| $getMediaFile->extantion_type == 'mpeg'|| $getMediaFile->extantion_type == 'amv')

						<?php 
						$mediaType = "video";
						$mediaTypeTitle = "Added New Video";
						?>
						@endif
						@endif

						<div class="add_new_photo_template">
							<div class="left_side_template">
								<img class="vister-profile-image" src="{{ url('/') }}/media-storage/users/{{ $value->_uid }}/{{ $value->profile_picture }}">
							</div>
							<div class="rigt_side_template">
								<div class="add_photo_header">
									<h3><a href="{{ url('/') }}/member/{{ $value->_uid }}" class="activity_vist_link">{{ $value->username }}</a>
										<!-- <bold>Event Posted : </bold> -->
										<span>{{ $mediaTypeTitle }}</span>
										<span class="post_time">{{ Carbon\Carbon::parse($value->activity_created_at)->format('g:i A | j F') }}</span></h3>

									</div>
									<div class="uploaded_video_picture">
										@if($mediaType == 'video')

										<div id="trigger_vdo" class="span4 proj-div videoplay trigger_vdo" dataivideo="{{ url('/') }}/media-storage/users/{{ $value->_uid }}/{{ $getMediaFile->file }}">

											<a href="{{ url('/') }}/media-storage/users/{{ $value->_uid }}/{{ $getMediaFile->file }}" class="glightbox4">
												<img class="activity_uploaded_video_link" src="{{ url('/') }}/media-storage/users/{{ $value->_uid }}/{{ $getMediaFile->video_thumbnail }}">

												<!-- <i class="fa fa-play" aria-hidden="true"></i> -->
											</a>
										</div>

										@else
										<img class="vister-profile-image" src="{{ url('/') }}/media-storage/users/{{ $value->_uid }}/{{ $getMediaFile->file }}">
										@endif


									</div>
								</div>
							</div>
							@else

							@endif


							@empty
							<p>No records founds.</p>
							@endforelse
<div class="activity-pagination text-right">
							{!! $user_activity->links()  !!}
					</div>

						</div>
					</div>
					</div>
				</section>


				@stop
