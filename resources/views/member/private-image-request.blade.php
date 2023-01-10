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
<?php
	$id = Auth::user()->_id;
	$uriSegments = explode("/", parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
	$user = App\Exp\Components\User\Models\User::where('_uid', end($uriSegments))->first();
	$UserProfile = App\Exp\Components\User\Models\UserProfile::where('users__id', $user['_id'])->first();
	$userProfileGet = \App\Exp\Components\User\Models\UserProfile::where('users__id', $user['_id'])->first();
	$ActivityLog = \App\Exp\Components\User\Models\ActivityLog::where('user_id', $user['_id'])->first();

	$UserLike = App\Exp\Components\User\Models\LikeDislikeModal::where('to_users__id', $user['_id'])->where('by_users__id', $id)->first();

	$UserLikeBY = App\Exp\Components\User\Models\LikeDislikeModal::where('by_users__id', $id)->where('to_users__id', $user['_id'])->first();

	$MemberView = App\Exp\Components\User\Models\MemberView::where('to_view_id', $user['_id'])->first();
?>
<section class="pb-5">
	<div class="container-fluid px-0">
		<h2> Private Album</h2>
		<div class="row interest-tab-bar px-3 py-3 bg-gray my-3 align-items-center" id="lwUserFilterContainer">
			<div class="col-md-9 col-sm-12">
				<ul class="nav interest-tab" role="tablist">
					<li class="tab-filter-li active" role="viewedMeTab" data-toggle="tab" data-filter="viewedMeDropdown">
						<a href=".viewedMeTab" aria-controls="profile" role="tab" data-toggle="tab">
							<h3>Request</h3>
						</a>
					</li>
					<li class="tab-filter-li" role="iVisited" data-toggle="tab" data-filter="iVisitedDropdown">
						<a href=".iVisited" aria-controls="profile" role="tab" data-toggle="tab">
							<h3>Sharing Private Photos</h3>
						</a>
					</li>
				</ul>
			</div>
		</div> 

		<?php 
		?>
		<div class="row pt-2" id="lwUserFilterContainer">
			<div class="col-12 tab-content">
				<div role="tabpanel" class="tab-pane active viewedMeTab" id="viewedMeTab">
					@if(count($listprivateimages) > 0)
					@foreach($listprivateimages as $filter)
							<?php
								if ($filter->profile_picture) {
									print_r($user);
									$imgURL = url('/') . '/media-storage/users/' . $filter->_uid . '/' . $filter->profile_picture;
								} else {
									$imgURL =  url('/imgs/default-image.png');
								}         
							?>
				
								<div class="vister d-flex justify-content-between pb-3 py-2">
									<div class="img-about d-flex align-items-flex-start">
										<div class="vister-image-icon">
											<img class="vister-profile-image" src="{{ (isset($imgURL)) ? $imgURL : '' }}" class="lw-user-thumbnail lw-lazy-img">
											<i class="fa-solid fa-camera"></i>
										</div>
											<p>{{$filter->username}}</p>
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
												</p>
											</a>
										</div>
									</div>
									<div class="time">
										<input type="button" class="web-btn" id="active-pending" image_id="{{$filter->_id}}" value="Accept Request">  
									</div>
								</div>
						@endforeach
						@else
							<div class="col-sm-12 alert alert-info">
								There are no records found.
							</div>
						@endif
					
				</div>
					<!-- I visited Section -->
				<div role="tabpanel" class="tab-pane iVisited" id="iVisited">
				@if(count($requeststatus) > 0)
			
					@forelse($requeststatus as $filter)
							<?php
								if ($filter->profile_picture) {
									print_r($user);
									$imgURL = url('/') . '/media-storage/users/' . $filter->_uid . '/' . $filter->profile_picture;
								} else {
									$imgURL =  url('/imgs/default-image.png');
								}         
							?>
				
								<div class="vister d-flex justify-content-between pb-3 py-2">
									<div class="img-about d-flex align-items-flex-start">
										<div class="vister-image-icon">
											<img class="vister-profile-image" src="{{ (isset($imgURL)) ? $imgURL : '' }}" class="lw-user-thumbnail lw-lazy-img">
											<i class="fa-solid fa-camera"></i>
										</div>
											<p>{{$filter->username}}</p>
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
												</p>
											</a>
										</div>
									</div>
									<div class="time">
										<input type="button" class="web-btn" id="active-pending" image_id="{{$filter->_id}}" value="Unshare">  
									</div>
								</div>
						
					@endforeach
				@else
					<div class="col-sm-12 alert alert-info">
						There are no records found.
					</div>
				@endif			
				</div>
				</div>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
</section>

<script type="text/javascript">

		$('input#active-pending').click(function() {
            var status = $(this).val();
			console.log(status);
            var image_id = jQuery(this).attr('image_id'); 
            console.log('image_id',image_id);
            $.ajax({
                type:'post',
                url:"{{ url('image-approver-update') }}",
                dataType:'json',
                data:{
                    '_token':$('meta[name="csrf-token"]').attr('content'),
                    'status':status,
                    'image_id':image_id,
                },
                success: function (response) {
					if(response.status == 'success'){
						showSuccessMessage("Your Message Update Successfully.");
							setInterval(function () {
							location.reload();
					},1000);
					}
                }
            });

        });


	$(".interest-tab li").on('click', function(e){
		$(".interest-tab li.active").removeClass('active');
		$(this).addClass('active');
	});
</script>
@stop
