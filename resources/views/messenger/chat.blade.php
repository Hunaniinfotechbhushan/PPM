@extends('public-master')
@section('content')
<style>

    @media screen and (max-width: 768px) {
        .inboxTab .active_chat {
            display: none;
        }
        .lw-page-content{
            display: none;
        }
        #message_inbox_chat .msg_history.msg_history_height {
            /*height: calc(100vh - 312px) !important;*/
        }
        #wrapper {
            margin-bottom: 0px !important;
        }
    }
</style>

<div id="wrapper" class="container-fluid wrapper_height msgpag wrap-inpox">

    @if(isset($_GET['uid']))
    <?php $sideBarMessage = ""; ?>
    @else
    <?php $sideBarMessage = "message-main-page"; ?>
    @endif
    <div class="msgpag {{ $sideBarMessage }}">
        <ul class="nav navbar-nav sidebar sidebar_customheight accordion" id="accordionSidebar" role="tablist">
            <hr class="sidebar-divider mt-2 mb-2 d-sm-block d-md-none">
            <li role="inboxTab" data-toggle="tab" class="active nav-item justify-content-between text-left select-drop-down">
                <a class="msg_inbox"href=".inboxTab" aria-controls="profile" role="tab" data-toggle="tab">
                   <p>Inbox</p>
               </a>
           </li>
           <li role="unreadMessageTab" data-toggle="tab" class="active nav-item justify-content-between text-left select-drop-down">
            <a class="msg_inbox"href=".unreadMessageTab" aria-controls="profile" role="tab" data-toggle="tab">
               <p>Unread Messages</p>
           </a>
       </li>
       <li role="filterTab" data-toggle="tab" class="nav-item justify-content-between text-left select-drop-down">
        <a class="msg_inbox"href=".inboxTab" aria-controls="profile" role="tab" data-toggle="tab">
            <p>Filter</p>
        </a>
    </li>
    <!-- Heading -->
    <li role="archiveTab" data-toggle="tab" class="nav-item justify-content-between text-left">
        <a class="msg_inbox" href=".archiveTab" aria-controls="profile" role="tab" data-toggle="tab">
         <p>Archive</p>
     </a>
 </li>

 <li role="deleteTab" data-toggle="tab" class="nav-item justify-content-between text-left">
    <a class="msg_inbox" href=".deleteTab" aria-controls="profile" role="tab" data-toggle="tab">
        <p>Deleted</p>
    </a>
</li>
</ul>
<!-- Content Wrapper -->

<div id="content-wrapper" class="d-flex flex-column lw-page-bg">

    <div id="content">


        <div class="lw-page-content px-2">

            <div class="lw-ad-block-h90">

            </div>

            <div class="card mb-3 mobile-view-none">

                <div class="card-header d-flex justify-content-between">

                   <h3><i class="fa-solid fa-comment-dots"></i>Inbox</h3>

                   <div class="d-flex"> 

                   </div>

               </div>

           </div>
           <div class="card p-2 d-md-none chat-box-head">
               <!--       <div class="d-flex justify-content-between">
                         <div class="d-flex">
                             <div role="inboxTab" data-toggle="tab">
                                <a href=".inboxTab" aria-controls="profile" role="tab" data-toggle="tab">
                                    <p>Inbox</p>
                                </a>
                            </div>
                            <div role="archiveTab" data-toggle="tab">
                                <a href=".archiveTab" aria-controls="profile" role="tab" data-toggle="tab">
                                    <p class="send">Archive</p>
                                </a>
                            </div>
                        </div>
                    -->


                    <ul class="nav navbar-nav sidebar sidebar_height accordion" id="accordionSidebar" role="tablist">

                        <hr class="sidebar-divider mt-2 mb-2 d-sm-block d-md-none">

                        <li role="inboxTab" data-toggle="tab" class="active nav-item justify-content-between text-left select-drop-down">
                            <a href=".inboxTab" aria-controls="profile" role="tab" data-toggle="tab">
                                <p>Inbox</p>
                            </a>
                        </li>

                        <!-- Heading -->

                        <li role="archiveTab" data-toggle="tab" class="nav-item justify-content-between text-left select-drop-down">
                            <a href=".archiveTab" aria-controls="profile" role="tab" data-toggle="tab">
                                <p class="send">Archive</p>
                            </a>
                        </li>

                        <li role="archiveTab" data-toggle="tab" class="nav-item justify-content-between text-left select-drop-down">
                            <a href=".archiveTab" aria-controls="profile" role="tab" data-toggle="tab">
                                <p class="send">Filtered Out</p>
                            </a>
                        </li>

                        <li role="archiveTab" data-toggle="tab" class="nav-item justify-content-between text-left select-drop-down">
                            <a href=".archiveTab" aria-controls="profile" role="tab" data-toggle="tab">
                                <p class="send">Archive</p>
                            </a>
                        </li>

                        <li class="nav-item justify-content-between text-left select-drop-down">

                          <p>Filtered Out</p>

                      </li>

                      <li class="nav-item justify-content-between text-left select-drop-down">

                         <p>Archive</p>

                     </li>
                 </ul>

                 <div>
                    <i class="fa-solid fa-angle-down inbox-filter-button"></i>
                </div>
            </div>
       <!--      <div class="d-flex justify-content-between inbox-filter-toggle" style="display: none !important;">
             <div class="">
                 <p class="py-2">Sent</p>
                 <p class="py-2">Archive</p>
             </div>
         </div> -->
         <div class="card p-2 d-md-none chat-box-head">
           <div class="d-flex justify-content-between" style="width:100%;">
             <input type="text" class="" placeholder="Search" width="100%" style="width:100%;">
         </div>
     </div>
 </div>
</div>

<div class="tab-content" id="message_inbox_chat">
    <div role="tabpanel" class="tab-pane {{ isset($_GET['uid']) ? '' : 'active' }} inboxTab">
     @if(!empty($inboxMessageResponse['data']['messengerUsers']))
     @foreach($inboxMessageResponse['data']['messengerUsers'] as $key=>$filter)
     <div class="event d-flex justify-content-between pb-3 py-2 message_event_chat">
        <a class="event_chat_link" href="{{ url('messenger') }}?uid={{ $filter['user_id'] }}">
         <div class="img-about d-flex align-items-flex-start">

            <div class="vister-image-icon">
                <img class="vister-profile-image" src="{{ $filter['profileImage'] }}" class="lw-user-thumbnail lw-lazy-img">
            </div>
            
            <div>
                <div class="css-ugj49">
                    <div class="css-1pk73qe">
                        <div data-cy-user-info="username" class="css-1nyvsm4">
                            <div class="css-1eve09z">
                                <span class="css-1ld10yt">  @if($filter['userOnlineStatus'])

                                    @if($filter['userOnlineStatus'] == 1)
                                    <span class="lw-dot lw-dot-success" title="Online"></span>
                                    @elseif($filter['userOnlineStatus'] == 2)
                                    <span class="lw-dot lw-dot-warning" title="Idle"></span>
                                    @elseif($filter['userOnlineStatus'] == 3)
                                    <span class="lw-dot lw-dot-danger" title="Offline"></span>
                                    @endif

                                    @endif
                                    
                                    <?= $filter['username'] ?>
                                    
                                </span>

                                <?php $chatMessages = \App\Exp\Components\Messenger\Models\ChatModel::where('to_users__id',Auth::user()->_id)
                                ->where('from_users__id',$filter['user_id'])
                                ->where('msg_status',0)->count();?>
                                ({{ isset($chatMessages) ? $chatMessages : '' }})
                                <span class="timestamp user-time-out" style="color: #808080a1;">
                                    <abbr class="timeago"><time datetime="2022-02-25T15:35:45.000Z" title="2022-02-25T15:35:45+00:00"><?= $filter['userOnlineStatusAgo'] ?></time>
                                    </abbr>
                                </span>                                     
                            </div>
                        </div>
                        <div data-cy-user-info="time-stamp">
                        </div>
                    </div>
                    <div class="css-13pazyb">
                        <div class="css-ls6xl3"><p data-cy-user-info="heading" class="css-rb1opn"><?= substr_replace($filter['heading'], "...", 50) ?></p><p data-cy-user-info="age-location-container" class="css-6tpspj"><span data-cy-user-info="age"><?= $filter['userAge'] ?></span>, <span data-cy-user-info="location"><?= $filter['city'] ?></span></p></div>
                    </div>
                    <p class="ConvoRow-body" style="font-weight: normal; margin-top: 0px;"><span>Upgrade to read</span></p>
                </div>
            </div>
        </div>
    </a>
</div>

@endforeach
@else
<div class="event d-flex justify-content-between pb-3 py-2">
    <div class="col-sm-12 alert alert-info">
     <span>No inbox messages.</span>  
 </div>
</div>
@endif
</div>


<div role="tabpanel" class="tab-pane unreadMessageTab">
 @if(!empty($unreadMessageResponse['data']['messengerUsers']))
 @foreach($unreadMessageResponse['data']['messengerUsers'] as $key=>$filter)
 <div class="event d-flex justify-content-between pb-3 py-2 message_event_chat">
    <a class="event_chat_link" href="{{ url('messenger') }}?uid={{ $filter['user_id'] }}">
     <div class="img-about d-flex align-items-flex-start">

        <div class="vister-image-icon">
            <img class="vister-profile-image" src="{{ $filter['profileImage'] }}" class="lw-user-thumbnail lw-lazy-img">
        </div>

        <div>
            <div class="css-ugj49">
                <div class="css-1pk73qe">
                    <div data-cy-user-info="username" class="css-1nyvsm4">
                        <div class="css-1eve09z">
                            <span class="css-1ld10yt">  @if($filter['userOnlineStatus'])

                                @if($filter['userOnlineStatus'] == 1)
                                <span class="lw-dot lw-dot-success" title="Online"></span>
                                @elseif($filter['userOnlineStatus'] == 2)
                                <span class="lw-dot lw-dot-warning" title="Idle"></span>
                                @elseif($filter['userOnlineStatus'] == 3)
                                <span class="lw-dot lw-dot-danger" title="Offline"></span>
                                @endif

                                @endif

                                <?= $filter['username'] ?>

                            </span>

                            <?php $chatMessages = \App\Exp\Components\Messenger\Models\ChatModel::where('to_users__id',Auth::user()->_id)
                            ->where('from_users__id',$filter['user_id'])
                            ->where('msg_status',0)->count();?>
                            ({{ isset($chatMessages) ? $chatMessages : '' }})
                            <span class="timestamp user-time-out" style="color: #808080a1;">
                                <abbr class="timeago"><time datetime="2022-02-25T15:35:45.000Z" title="2022-02-25T15:35:45+00:00"><?= $filter['userOnlineStatusAgo'] ?></time>
                                </abbr>
                            </span>                                     
                        </div>
                    </div>
                    <div data-cy-user-info="time-stamp">
                    </div>
                </div>
                <div class="css-13pazyb">
                    <div class="css-ls6xl3"><p data-cy-user-info="heading" class="css-rb1opn"><?= substr_replace($filter['heading'], "...", 50) ?></p><p data-cy-user-info="age-location-container" class="css-6tpspj"><span data-cy-user-info="age"><?= $filter['userAge'] ?></span>, <span data-cy-user-info="location"><?= $filter['city'] ?></span></p></div>
                </div>
                <p class="ConvoRow-body" style="font-weight: normal; margin-top: 0px;"><span>Upgrade to read</span></p>
            </div>
        </div>
    </div>
</a>
</div>

@endforeach
@else
<div class="event d-flex justify-content-between pb-3 py-2">
    <div class="col-sm-12 alert alert-info">
     <span>No unread messages.</span>  
 </div>
</div>
@endif
</div>


<div role="tabpanel" class="tab-pane deleteTab">
 @if(!empty($deletedMessageResponse['data']['messengerUsers']))
 @foreach($deletedMessageResponse['data']['messengerUsers'] as $key=>$filter)
 <div class="event d-flex justify-content-between pb-3 py-2 message_event_chat">
    <a class="event_chat_link" href="{{ url('messenger') }}?uid={{ $filter['user_id'] }}">
     <div class="img-about d-flex align-items-flex-start">

        <div class="vister-image-icon">
            <img class="vister-profile-image" src="{{ $filter['profileImage'] }}" class="lw-user-thumbnail lw-lazy-img">
        </div>

        <div>
            <div class="css-ugj49">
                <div class="css-1pk73qe">
                    <div data-cy-user-info="username" class="css-1nyvsm4">
                        <div class="css-1eve09z">
                            <span class="css-1ld10yt">  @if($filter['userOnlineStatus'])

                                @if($filter['userOnlineStatus'] == 1)
                                <span class="lw-dot lw-dot-success" title="Online"></span>
                                @elseif($filter['userOnlineStatus'] == 2)
                                <span class="lw-dot lw-dot-warning" title="Idle"></span>
                                @elseif($filter['userOnlineStatus'] == 3)
                                <span class="lw-dot lw-dot-danger" title="Offline"></span>
                                @endif

                                @endif

                                <?= $filter['username'] ?>

                            </span>

                            <?php $chatMessages = \App\Exp\Components\Messenger\Models\ChatModel::where('to_users__id',Auth::user()->_id)
                            ->where('from_users__id',$filter['user_id'])
                            ->where('msg_status',0)->count();?>
                            ({{ isset($chatMessages) ? $chatMessages : '' }})
                            <span class="timestamp user-time-out" style="color: #808080a1;">
                                <abbr class="timeago"><time datetime="2022-02-25T15:35:45.000Z" title="2022-02-25T15:35:45+00:00"><?= $filter['userOnlineStatusAgo'] ?></time>
                                </abbr>
                            </span>                                     
                        </div>
                    </div>
                    <div data-cy-user-info="time-stamp">
                    </div>
                </div>
                <div class="css-13pazyb">
                    <div class="css-ls6xl3"><p data-cy-user-info="heading" class="css-rb1opn"><?= substr_replace($filter['heading'], "...", 50) ?></p><p data-cy-user-info="age-location-container" class="css-6tpspj"><span data-cy-user-info="age"><?= $filter['userAge'] ?></span>, <span data-cy-user-info="location"><?= $filter['city'] ?></span></p></div>
                </div>
                <p class="ConvoRow-body" style="font-weight: normal; margin-top: 0px;"><span>Upgrade to read</span></p>
            </div>
        </div>
    </div>
</a>
</div>

@endforeach
@else
<div class="event d-flex justify-content-between pb-3 py-2">
    <div class="col-sm-12 alert alert-info">
     <span>No deleted messages.</span>  
 </div>
</div>
@endif
</div>


<div role="tabpanel" class="tab-pane archiveTab">
 @if(!empty($archiveMessageResponse['data']['messengerUsers']))
 @foreach($archiveMessageResponse['data']['messengerUsers'] as $key=>$filter)
 <div class="event d-flex justify-content-between pb-3 py-2 message_event_chat">
    <a class="event_chat_link" href="{{ url('messenger') }}?uid={{ $filter['user_id'] }}">
     <div class="img-about d-flex align-items-flex-start">

        <div class="vister-image-icon">
            <img class="vister-profile-image" src="{{ $filter['profileImage'] }}" class="lw-user-thumbnail lw-lazy-img">
        </div>

        <div>
            <div class="css-ugj49">
                <div class="css-1pk73qe">
                    <div data-cy-user-info="username" class="css-1nyvsm4">
                        <div class="css-1eve09z">
                            <span class="css-1ld10yt">  @if($filter['userOnlineStatus'])

                                @if($filter['userOnlineStatus'] == 1)
                                <span class="lw-dot lw-dot-success" title="Online"></span>
                                @elseif($filter['userOnlineStatus'] == 2)
                                <span class="lw-dot lw-dot-warning" title="Idle"></span>
                                @elseif($filter['userOnlineStatus'] == 3)
                                <span class="lw-dot lw-dot-danger" title="Offline"></span>
                                @endif

                                @endif

                                <?= $filter['username'] ?>

                            </span>

                            <?php $chatMessages = \App\Exp\Components\Messenger\Models\ChatModel::where('to_users__id',Auth::user()->_id)
                            ->where('from_users__id',$filter['user_id'])
                            ->where('msg_status',0)->count();?>
                            ({{ isset($chatMessages) ? $chatMessages : '' }})
                            <span class="timestamp user-time-out" style="color: #808080a1;">
                                <abbr class="timeago"><time datetime="2022-02-25T15:35:45.000Z" title="2022-02-25T15:35:45+00:00"><?= $filter['userOnlineStatusAgo'] ?></time>
                                </abbr>
                            </span>                                     
                        </div>
                    </div>
                    <div data-cy-user-info="time-stamp">
                    </div>
                </div>
                <div class="css-13pazyb">
                    <div class="css-ls6xl3"><p data-cy-user-info="heading" class="css-rb1opn"><?= substr_replace($filter['heading'], "...", 50) ?></p><p data-cy-user-info="age-location-container" class="css-6tpspj"><span data-cy-user-info="age"><?= $filter['userAge'] ?></span>, <span data-cy-user-info="location"><?= $filter['city'] ?></span></p></div>
                </div>
                <p class="ConvoRow-body" style="font-weight: normal; margin-top: 0px;"><span>Upgrade to read</span></p>
            </div>
        </div>
    </div>
</a>
</div>

@endforeach
@else
<div class="event d-flex justify-content-between pb-3 py-2">
    <div class="col-sm-12 alert alert-info">
        <span>No archive messages.</span>  
    </div>
</div>
@endif
</div>

<div role="tabpanel" class="tab-pane {{ isset($_GET['uid']) ? 'active' : '' }} inboxTab" on-chat-user-id="{{ isset($_GET['uid']) ? '' : '' }}">
    @if(isset($_GET['uid']))
    @if($inboxMessageResponse['data']['chatUserDetails'])
    <div class="messaging pb-2">
        <div class="inbox_msg flex_inbox_msg">
            <div class="mesgs"> 
                <div class="headind_srch headind_srch_head w-100">
                    <div class="recent_heading">
                        <img src="{{ url('/') }}/media-storage/users/{{ $inboxMessageResponse['data']['chatUserDetails']['_uid'] }}/{{ $inboxMessageResponse['data']['chatUserDetails']['profile_picture'] }}" alt="{{ $inboxMessageResponse['data']['chatUserDetails']['username'] }}" style="
                        max-width: 39px;
                        ">
                        <div class="srch_bar">
                            <p class="chat-username">
                                {{ isset($inboxMessageResponse['data']['chatUserDetails']['username']) ? $inboxMessageResponse['data']['chatUserDetails']['username'] : '' }}
                            </p>
                            <p class="chat-user-city">
                                <span class="srch_bar chat-user-age">
                                    {{ isset($inboxMessageResponse['data']['chatUserDetails']['dob']) ? Carbon\Carbon::parse($inboxMessageResponse['data']['chatUserDetails']['dob'])->age : '' }}  
                                </span>
                                {{ isset($inboxMessageResponse['data']['chatUserDetails']['city']) ? $inboxMessageResponse['data']['chatUserDetails']['city'] : '' }}  
                            </p>
                        </div>
                        <div class="video-call_and_list_icon">
                            <button class="vc-btn">
                                <span id="video_call_icon"><i class="fas fa-video "></i></span>
                            </button>
                            <button class="list-btn">
                                <span id="list_icon" class=""><i class="fa-solid fa-ellipsis"></i></span>
                            </button>
                            <div class="list_icon_drodown">
                                <p class="user-action-tab" action="archive">Archive Conversation</p>
                                <p class="user-action-tab" action="delete">Delete Conversation</p>
                                <p id="lwBlockUserBtn1">Block User</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="msg_history msg_history_height">
                    <div class="userChatHistory">
                        <!-- show chat history using ajax -->  
                    </div>
                </div>
                <div class="type_msg">
                    <div class="input_msg_write">
                        <input type="text" name="message" class="write_msg" placeholder="Type a message" />
                        <button id="send_chat" class="msg_send_btn" type="button"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>
                    </div>
                </div>
            </div>
            <div class="inbox_people">
                <div class="inbox_chat inbox_chat_height">
                    <div class="full_height">
                        <div class="chat_list active_chat">
                            <div class="chat-user-img">
                                <img src="{{ url('/') }}/media-storage/users/{{ $inboxMessageResponse['data']['chatUserDetails']['_uid'] }}/{{ $inboxMessageResponse['data']['chatUserDetails']['profile_picture'] }}" alt="{{ $inboxMessageResponse['data']['chatUserDetails']['username'] }}" style="
                                max-width: 49px;
                                ">
                            </div>
                        </div>
                        <div class="chat_list active_chat">
                            <div class="user_area">
                                <span>Member Since</span>
                                <span>{{ isset($inboxMessageResponse['data']['chatUserDetails']['user_created_date']) ? Carbon\Carbon::parse($inboxMessageResponse['data']['chatUserDetails']['user_created_date'])->format('j F Y') : '' }}</span>
                            </div>
                        </div>
                        <div class="chat_list active_chat">
                            <div class="user_area">
                                <span>Interest</span>
                                <span>@if($inboxMessageResponse['data']['chatUserDetails']['interest_selection'] == 1)
                                    Men
                                    @elseif($inboxMessageResponse['data']['chatUserDetails']['interest_selection'] == 2)
                                    Women
                                    @else
                                    Men, Women
                                @endif </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
    @endif
</div>
</div>
</div>
</div>
</div>
</div>

<?php 

if(isset($_GET['uid']))
{
    ?>    
    <script type="text/javascript">

        $(document).ready(function(){
            $(".dropdown-toggle").dropdown();
        });
// Get url parameter
var getUrlParameter = function getUrlParameter(sParam) {
    var sPageURL = window.location.search.substring(1),
    sURLVariables = sPageURL.split('&'),
    sParameterName,
    i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
            return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
        }
    }
    return false;
};

$(document).ready(function(){
    setTimeout(realTime, 2000);
});

        // Get User Conversations
        function realTime() {
            $.ajax({
                type:'post',
                url: "{{ url('messenger/chat/get-conversation') }}",
                dataType:'json',
                data:{
                    '_token':$('meta[name="csrf-token"]').attr('content'),
                    'user_id':getUrlParameter('uid'),
                },
                success: function (data) {
                    if(data){
                        $('.userChatHistory').html(data.userConversations);
                    }
                },
            });
            setTimeout(realTime,2000);
        }

        // Send User Conversations
        $(document).on('click','#send_chat', function (){
            var write_msg1 = $('.write_msg').val();
            if(write_msg1 == ''){
                return false;
            }
            $.ajax({
                type:'post',
                url:"{{ url('messenger/chat/send-conversation') }}",
                dataType:'json',
                data:{
                    '_token':$('meta[name="csrf-token"]').attr('content'),
                    'user_id':getUrlParameter('uid'),
                    'message':$('input[name=message]').val(),
                },
                success: function (data) {
                    console.log(data.msg);
                    if(data.msg){
                        $('.userChatHistory').append(data.msg);
                    }
                }
            });
            $('input[name=message]').val('');

        });
// On enter sendmessage
$('.write_msg').keypress(function(e){


        if(e.which == 13){//Enter key pressed
            $('#send_chat').click();//Trigger search button click event
            $('input[name=message]').val('');
        }
    });


// $('.msg_send_btn').click(function(e){


//      write_msg = $('.write_msg').val();

// alert(write_msg);
//     });



$(".list-btn").click(function(){
  $(".list_icon_drodown").toggle();
});


     //block user confirmation
    $("#lwBlockUserBtn1").on('click', function(e) {
       // alert('jj');
        var confirmText = "Are you want to sure ";
        
        //show confirmation 
        showConfirmation(confirmText, function() {
            var requestUrl = '<?= route('user.write.block_user') ?>',
            formData = {
                'block_user_id' : <?= $_GET['uid']?>,
            };                  
            // post ajax request
            __DataRequest.post(requestUrl, formData, function(response) {
                if (response.reaction == 1) {
                    __Utils.viewReload();
                }
            });
        });
    });



      //report 

      $("body").on("click", ".user-action-tab", function(e) {


        e.preventDefault();
        $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });

      var user_Action =  $(this).attr('action');
      var action_user_id =  $(this).closest().attr('on-chat-user-id');
        $.ajax({
          type:'POST',
          url:"{{ url('message-user-action') }}",
          dataType : 'json',
          data: {'request_for':user_Action,'to_user_id':action_user_id},
          success:function(response){
             if(response.status== 'success'){
                 showSuccessMessage("Action successfully performed.");

               //   setInterval(function () {
               //     location.reload();
               // },1000);

             }


         }

     });

        return false;
    });
</script>
<?php
}
?>

@stop
