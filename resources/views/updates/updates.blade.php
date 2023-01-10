@extends('public-master')
@section('content')
<style>
	@media screen and (max-width: 425px){
		.interest-tab li>a>h3 {
			font-size: 11px !important;
		}
	}
	@media screen and (max-width: 380px){
		#lwUserFilterContainer .col-md-9.col-sm-12 {
			padding: 0;
		}
		#lwUserFilterContainer ul.interest-tab li {
			margin: 0px 9px 10px;
		}
	}
	@media screen and (max-width: 340px){
		#lwUserFilterContainer ul.interest-tab li {
			margin: 0px 5px 10px;
		}
		.interest-tab li>a>h3 {
			font-size: 11px !important;
		}
	}
</style>
<section class="pb-5">
	<div class="container-fluid px-0">
		<div class="row interest-tab-bar px-3 py-3 bg-gray my-3 align-items-center" id="lwUserFilterContainer">

			<div class="col-md-9 col-sm-12">

				<ul class="nav interest-tab" role="tablist">

					<li class="tab-filter-li active" role="viewedMeTab" data-toggle="tab" data-filter="viewedMeDropdown"><a href=".viewedMeTab" aria-controls="profile" role="tab" data-toggle="tab"><h3>My visitors</h3></a></li>

					<li class="tab-filter-li" role="iVisited" data-toggle="tab" data-filter="iVisitedDropdown"><a href=".iVisited" aria-controls="profile" role="tab" data-toggle="tab"><h3>I visited</h3></a></li>

					<li class="tab-filter-li" role="favoritesTab" data-toggle="tab" data-filter="favoritesDropdown"><a href=".favoritesTab" aria-controls="profile" role="tab" data-toggle="tab"><h3>Favorited</h3></a></li>

					<li class="tab-filter-li" role="favoritesMeTab" data-toggle="tab" data-filter="favoritesMeDropdown"><a href=".favoritesMeTab" aria-controls="profile" role="tab" data-toggle="tab"><h3>Favorited me</h3></a></li>


				</ul>

			</div>


			<div class="col-md-3 col-sm-12 text-right intrest-input">

				<div class="tab-content">

					<div class="filter-dropdown tab-pane active viewedMeDropdown">
						<div class="select custom_select">
							<i class="fa-solid fa-caret-down"></i>
							<select class="viewSelect updateSelectChange" data-action="view">
								<option value="1">When Viewed</option>
								<option value="2">Last Active</option>
							</select>
						</div>
					</div>


					<div class="filter-dropdown tab-pane iVisitedDropdown" >
						<div class="select custom_select">
							<i class="fa-solid fa-caret-down"></i>
							<select class="visitSelect updateSelectChange" data-action="visit">
								<option value="1">When Visited</option>
								<option value="2">Last Active</option>
							</select>
						</div>
					</div>


					<div class="filter-dropdown tab-pane favoritesDropdown">
						<div class="select custom_select" >
							<i class="fa-solid fa-caret-down"></i>
							<select class="favoritesSelect updateSelectChange" data-action="favorites">
								<option value="1">When Favorited</option>
								<option value="2">Last Active</option>
							</select>
						</div>
					</div>


					<div  class="filter-dropdown tab-pane favoritesMeDropdown">
						<div class="select custom_select">
							<i class="fa-solid fa-caret-down"></i>
							<select class="favoritesMeSelect updateSelectChange" data-action="favoritesMe">
								<option value="1">When Favorited me</option>
								<option value="2">Last Active</option>
							</select>
						</div>
					</div>

				</div>

			</div>
		</div> 


		<?php 
		
		?>
		<div class="row pt-2" id="lwUserFilterContainer">
			<div class="col-12 tab-content">
				<div role="tabpanel" class="tab-pane active viewedMeTab" id="viewedMeTab">
					@if($myVisitor)
					@forelse($myVisitor as $key=>$filter)
					@if(Auth::user()->_id != $filter['user_id'])

					<?php $Blockuser = \App\Exp\Components\User\Models\UserBlock::where('to_users__id', $filter['user_id'])->where('by_users__id', Auth::user()->_id)->first(); 

					
					?>

					@if(empty($Blockuser))  
					<div class="vister d-flex justify-content-between pb-3 py-2">
						<div class="img-about d-flex align-items-flex-start">
							<div class="vister-image-icon">
								<img class="vister-profile-image" src="{{ $filter['profileImage'] }}" class="lw-user-thumbnail lw-lazy-img">
								<i class="fa-solid fa-camera"></i>
							</div>
							<div>
								<a href="{{ url('member') }}/{{ $filter['user_uid'] }}">

									<p class="user-name">
										
										@if($filter['userOnlineStatus'])

										@if($filter['userOnlineStatus'] == 1)
										<span class="lw-dot lw-dot-success" title="Online"></span>
										@elseif($filter['userOnlineStatus'] == 2)
										<span class="lw-dot lw-dot-warning" title="Idle"></span>
										@elseif($filter['userOnlineStatus'] == 3)
										<span class="lw-dot lw-dot-danger" title="Offline"></span>
										@endif

										@endif
										<!--  -->
										<?= $filter['username'] ?>

										<?php if($filter['userLikeDislike'] == 1)
										{
											$hasLike = "like_true";
											$hasLikeTitle = "Favorite";
										}else{
											$hasLike = "";
											$hasLikeTitle = "Favorited";
										} 
										?>
									</p>
								</a>
								<p class="location"><?= substr_replace($filter['heading'], "...", 50) ?></p>
								<p class=" adress"><?= $filter['city'] ?></p>
								<div class="d-flex"><a href="{{ url('member/') }}/{{ $filter['user_uid'] }}"><p class="send"><i class="fa-solid fa-comment-dots"></i>Send Message</p></a>
									<p>
										<a href data-action="<?= route('user.write.like_dislike', ['toUserUid' => $filter['user_id'],'like' => 1]) ?>" data-method="post" data-callback="onLikeCallback" title="Like" class="lw-ajax-link-action lw-like-action-btn" id="lwLikeBtn"> 
											<i class="fa-solid fa-heart {{ $hasLike }} "></i> <span>{{ $hasLikeTitle }}</span></a>
										</p>

									</div>
								</div>
							</div>
							<div class="d-none d-md-block mt-2">
								<div class="about-vistor">
									<p class="height"><b>Height : </b><?= $filter['height'] ?>cm</p>
									<p class="body"><b>Body : </b><?= $filter['user_body_type'] ?></p>
									<p class="ethnicty"><b>Ethncity : </b><?= $filter['user_ethnicity'] ?></p>
								</div>
							</div>
							<div class="time">
								<p class="timing"><?= $filter['timeAgo'] ?></p> 
								
							</div>
						</div>
						@endif
						@endif
						@empty
						<div class="vister d-flex justify-content-between pb-3 py-2">
							<p>No records found.</p>
						</div>
						@endforelse
						@else
						<div class="col-sm-12 alert alert-info">
						There are no records found.</div>
						@endif
					</div>


					<!-- I visited Section -->

					<div role="tabpanel" class="tab-pane iVisited" id="iVisited">
						@if($iVisitedOnPrev)
						@forelse($iVisitedOnPrev as $key=>$filter)
						@if(Auth::user()->_id != $filter['user_id'])
						<?php $Blockuser = \App\Exp\Components\User\Models\UserBlock::where('to_users__id', $filter['user_id'])->where('by_users__id', Auth::user()->_id)->first(); 

						
						?>

						@if(empty($Blockuser))  
						<div class="vister d-flex justify-content-between pb-3 py-2">
							<div class="img-about d-flex align-items-flex-start">
								<div class="vister-image-icon">
									<img class="vister-profile-image" src="{{ $filter['profileImage'] }}" class="lw-user-thumbnail lw-lazy-img">
									<i class="fa-solid fa-camera"></i>
								</div>
								<div>
									<a href="{{ url('member') }}/{{ $filter['user_uid'] }}">
										<p class="user-name">

											@if($filter['userOnlineStatus'])

											@if($filter['userOnlineStatus'] == 1)
											<span class="lw-dot lw-dot-success" title="Online"></span>
											@elseif($filter['userOnlineStatus'] == 2)
											<span class="lw-dot lw-dot-warning" title="Idle"></span>
											@elseif($filter['userOnlineStatus'] == 3)
											<span class="lw-dot lw-dot-danger" title="Offline"></span>
											@endif

											@endif
											<!--  -->
											<?= $filter['username'] ?>

											<?php if($filter['userLikeDislike'] == 1)
											{
												$hasLike = "like_true";
												$hasLikeTitle = "Favorite";
											}else{
												$hasLike = "";
												$hasLikeTitle = "Favorited";
											} 
											?>
										</p>
									</a>
									<p class="location"><?= substr_replace($filter['heading'], "...", 50) ?></p>
									<p class=" adress"><?= $filter['city'] ?></p>

									<div class="d-none d-md-block mt-2">
										<div class="about-vistor">
											<p class="height"><b>Height : </b><?= $filter['height'] ?>cm</p>
											<p class="body"><b>Body : </b><?= $filter['user_body_type'] ?></p>
											<p class="ethnicty"><b>Ethncity : </b><?= $filter['user_ethnicity'] ?></p>
										</div>
									</div>
									
								</div>
							</div>
							
							<div class="time">
								<p class="timing"><?= $filter['timeAgo'] ?></p> 
								<div class="d-flex">
									<a href="{{ url('member/') }}/{{ $filter['user_uid'] }}">
										<p class="send"><i class="fa-solid fa-comment-dots"></i>Send Message</p>
									</a>

									<p>
										<a href data-action="<?= route('user.write.like_dislike', ['toUserUid' => $filter['user_id'],'like' => 1]) ?>" data-method="post" data-callback="onLikeCallback" title="Like" class="lw-ajax-link-action lw-like-action-btn" id="lwLikeBtn"> 
											<i class="fa-solid fa-heart {{ $hasLike }} "></i> 
											<span>{{ $hasLikeTitle }}</span>
										</a>
									</p>
								</div>
								
							</div>
							

						</div>
						@endif
						@endif
						@empty
						<div class="vister d-flex justify-content-between pb-3 py-2">
							<p>No records found.</p>
						</div>
						@endforelse		
						@else
						<div class="col-sm-12 alert alert-info">
						There are no records found.</div>					
						@endif
					</div>

					<!-- End I visited Section -->


					<!-- Favorite Section -->
					<div role="tabpanel" class="tab-pane favoritesTab" id="favoritesTab">
						@if($userFavData)
						@forelse($userFavData as $key=>$favData)
						@if(Auth::user()->_id != $favData['user_id'])

						<?php $Blockuser = \App\Exp\Components\User\Models\UserBlock::where('to_users__id', $favData['user_id'])->where('by_users__id', Auth::user()->_id)->first(); ?>

						@if(empty($Blockuser)) 
						<div class="vister d-flex justify-content-between pb-3 py-2">
							<div class="img-about d-flex align-items-flex-start">
								<div class="vister-image-icon">
									<img class="vister-profile-image" src="{{ $favData['profileImage'] }}" class="lw-user-thumbnail lw-lazy-img">
									<i class="fa-solid fa-camera"></i>
								</div>
								<div>
									<a href="{{ url('member') }}/{{ $favData['user_uid'] }}">
										<p class="user-name">

											@if($favData['userOnlineStatus'])

											@if($favData['userOnlineStatus'] == 1)
											<span class="lw-dot lw-dot-success" title="Online"></span>
											@elseif($favData['userOnlineStatus'] == 2)
											<span class="lw-dot lw-dot-warning" title="Idle"></span>
											@elseif($favData['userOnlineStatus'] == 3)
											<span class="lw-dot lw-dot-danger" title="Offline"></span>
											@endif

											@endif
											<!--  -->
											<?= $favData['username'] ?> 

											<?php if($favData['userLikeDislike'] == 1)
											{
												$hasLike = "like_true";
												$hasLikeTitle = "Favorite";
											}else{
												$hasLike = "";
												$hasLikeTitle = "Favorited";
											} 
											?>
										</p>
									</a>
									<p class="location"><?= substr_replace($favData['heading'], "...", 50) ?></p>
									<p class=" adress"><?= $favData['city'] ?></p>
									<div class="d-flex"><a href="{{ url('member/') }}/{{ $favData['user_uid'] }}"><p class="send"><i class="fa-solid fa-comment-dots"></i>Send Message</p></a>

										<p>
											<a href data-action="<?= route('user.write.like_dislike', ['toUserUid' => $favData['user_id'],'like' => 1]) ?>" data-method="post" data-callback="onLikeCallback" title="Like" class="lw-ajax-link-action lw-like-action-btn" id="lwLikeBtn"> 
												<i class="fa-solid fa-heart {{ $hasLike }} "></i> <span>{{ $hasLikeTitle }}</span></a>
											</p>


										</div>
									</div>
								</div>
								<div class="d-none d-md-block mt-2">
									<div class="about-vistor">
										<p class="height"><b>Height : </b><?= $favData['height'] ?>cm</p>
										<p class="body"><b>Body : </b><?= $favData['user_body_type'] ?></p>
										<p class="ethnicty"><b>Ethncity : </b><?= $favData['user_ethnicity'] ?></p>
									</div>
								</div>
								<div class="time">
									<p class="timing"><?= $filter['timeAgo'] ?></p> 
								</div>
							</div>
							@endif
							@endif
							@empty
							<div class="vister d-flex justify-content-between pb-3 py-2">
								<p>No records found.</p>
							</div>
							@endforelse
							@else
							<div class="col-sm-12 alert alert-info">
							There are no records found.</div>
							@endif
						</div>

						<!-- End Favorite Section -->

						<!-- Favorite Me Section -->

						<div role="tabpanel" class="tab-pane favoritesMeTab" id="favoritesMeTab">
							@if($userFavMeData)
							@forelse($userFavMeData as $key=>$favData)
							@if(Auth::user()->_id != $favData['user_id'])
							<?php $Blockuser = \App\Exp\Components\User\Models\UserBlock::where('to_users__id', $favData['user_id'])->where('by_users__id', Auth::user()->_id)->first(); ?>
							@if(empty($Blockuser)) 
							<div class="vister d-flex justify-content-between pb-3 py-2">
								<div class="img-about d-flex align-items-flex-start">
									<div class="vister-image-icon">
										<img class="vister-profile-image" src="{{ $favData['profileImage'] }}" class="lw-user-thumbnail lw-lazy-img">
										<i class="fa-solid fa-camera"></i>
									</div>
									<div>
										<a href="{{ url('member') }}/{{ $favData['user_uid'] }}">
											<p class="user-name">

												@if($favData['userOnlineStatus'])

												@if($favData['userOnlineStatus'] == 1)
												<span class="lw-dot lw-dot-success" title="Online"></span>
												@elseif($favData['userOnlineStatus'] == 2)
												<span class="lw-dot lw-dot-warning" title="Idle"></span>
												@elseif($favData['userOnlineStatus'] == 3)
												<span class="lw-dot lw-dot-danger" title="Offline"></span>
												@endif

												@endif
												<!--  -->
												<?= $favData['username'] ?>

												<?php if($favData['userLikeDislike'] == 1)
												{
													$hasLike = "like_true";
													$hasLikeTitle = "Favorite";
												}else{
													$hasLike = "";
													$hasLikeTitle = "Favorited";
												} 
												?>
											</p>
										</a>
										<p class="location"><?= substr_replace($favData['heading'], "...", 50) ?></p>
										<p class=" adress"><?= $favData['city'] ?></p>
										<div class="d-flex"><a href="{{ url('member/') }}/{{ $favData['user_uid'] }}"><p class="send"><i class="fa-solid fa-comment-dots"></i>Send Message</p></a>


											<p>
												<a href data-action="<?= route('user.write.like_dislike', ['toUserUid' => $favData['user_id'],'like' => 1]) ?>" data-method="post" data-callback="onLikeCallback" title="Like" class="lw-ajax-link-action lw-like-action-btn" id="lwLikeBtn"> 
													<i class="fa-solid fa-heart {{ $hasLike }} "></i> <span>{{ $hasLikeTitle }}</span></a>
												</p>

											</div>
										</div>
									</div>
									<div class="d-none d-md-block mt-2">
										<div class="about-vistor">
											<p class="height"><b>Height : </b><?= $favData['height'] ?>cm</p>
											<p class="body"><b>Body : </b><?= $favData['user_body_type'] ?></p>
											<p class="ethnicty"><b>Ethncity : </b><?= $favData['user_ethnicity'] ?></p>
										</div>
									</div>
									<div class="time">
										<p class="timing"><?= $filter['timeAgo'] ?></p> 
									</div>
								</div>
								@endif
								@endif
								@empty
								<div class="vister d-flex justify-content-between pb-3 py-2">
									<p>No records found.</p>
								</div>
								@endforelse
								@else
								<div class="col-sm-12 alert alert-info">
								There are no records found.</div>
								@endif
							</div>
							<!-- End Favorite Me Section -->


						</div>
					</div>

				</div>

			</div>

		</section>

		<script type="text/javascript">

// Nav bar active
// $('.filter-dropdown').hide();
$(".tab-filter-li").on('click', function(e){
	$('.filter-dropdown').hide();
	$('.'+$(this).attr('data-filter')).show();

	  // $('li a').removeClass("active");
   //  $(this).addClass("active");

});

$(".interest-tab li").on('click', function(e){

	$(".interest-tab li.active").removeClass('active');
	$(this).addClass('active');
});
// Like Dislike color change
$(".lw-like-action-btn").on('click', function() {
	if ($(this).find('i').hasClass("like_true")) {
		$(this).find('i').removeClass("like_true");
		$(this).find('span').html("Favorited");
	}else{
		$(this).find('i').addClass("like_true");
		$(this).find('span').html("Favorite");
	}

});



 //on like Callback function
 function onLikeCallback(response) {
 	var requestData = response.data;
        //check reaction code is 1 and status created or updated and like status is 1
        if (response.reaction == 1 && requestData.likeStatus == 1 && (requestData.status == "created" || requestData.status == 'updated')) {
        	__DataRequest.updateModels({
                'userLikeStatus'    : '<?= __tr('Liked') ?>', //user liked status
                'userDislikeStatus' : '<?= __tr('Dislike') ?>', //user dislike status
            });
            //add class
            $(".lw-animated-like-heart").toggleClass("lw-is-active");
            //check if updated then remove class in dislike heart
            if (requestData.status == 'updated') {
            	$(".lw-animated-broken-heart").toggleClass("lw-is-active");
            }
        }
        //check reaction code is 1 and status created or updated and like status is 2
        if (response.reaction == 1 && requestData.likeStatus == 2 && (requestData.status == "created" || requestData.status == 'updated')) {
        	__DataRequest.updateModels({
                'userLikeStatus'    : '<?= __tr('Like') ?>', //user like status
                'userDislikeStatus' : '<?= __tr('Disliked') ?>', //user disliked status
            });
            //add class
            $(".lw-animated-broken-heart").toggleClass("lw-is-active");
            //check if updated then remove class in like heart
            if (requestData.status == 'updated') {
            	$(".lw-animated-like-heart").toggleClass("lw-is-active");
            }
        }
        //check reaction code is 1 and status deleted and like status is 1
        if (response.reaction == 1 && requestData.likeStatus == 1 && requestData.status == "deleted") {
        	__DataRequest.updateModels({
                'userLikeStatus'    : '<?= __tr('Like') ?>', //user like status
            });
        	$(".lw-animated-like-heart").toggleClass("lw-is-active");
        }
        //check reaction code is 1 and status deleted and like status is 2
        if (response.reaction == 1 && requestData.likeStatus == 2 && requestData.status == "deleted") {
        	__DataRequest.updateModels({
                'userDislikeStatus'     : '<?= __tr('Dislike') ?>', //user like status
            });
        	$(".lw-animated-broken-heart").toggleClass("lw-is-active");
        }
        //remove disabled anchor tag class
        _.delay(function() {
        	$('.lw-like-dislike-box').removeClass("lw-disable-anchor-tag");
        }, 1000);
    }
    /**************** User Like Dislike Fetch and Callback Block End ******************/



    $('.updateSelectChange').on('change', function(e) {

    	var tabAction = $(this).attr('data-action');
    	var tabOption = $(this).val();
    	e.preventDefault();
    	$.ajaxSetup({
    		headers: {
    			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    		}
    	});
    	$.ajax({
    		type:'POST',
    		url:"{{ url('updates-select-option') }}",
    		dataType : 'json',
    		data: {tabAction:tabAction,tabOption:tabOption},
    		success:function(response){
    			if(response.status == 'success'){
    				
    				if(response.request == 'view'){
    					$('#viewedMeTab').html(response.html);
    				}
    				if(response.request == 'visit'){
    					$('#iVisited').html(response.html);
    				}

    				if(response.request == 'favorites'){
    					$('#favoritesTab').html(response.html);
    				}

    				if(response.request == 'favoritesMe'){
    					$('#favoritesMeTab').html(response.html);
    				}



    			}


    		}

    	});

    	return false;
    });





</script>

@stop
