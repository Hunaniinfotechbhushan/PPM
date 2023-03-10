@extends('public-master')
@section('content')
<div id="wrapper" class="container-fluid">
<div class="lw-messenger-header row">
    <div class="col-md-10">
        <img src="<?= $processReaction['data']['userData']['profile_picture_image'] ?>" class="lw-profile-picture lw-online  float-left" alt="">
        <div class="lw-messenger-header-meta">
            <?= $processReaction['data']['userData']['full_name'] ?>
            <div class="text-muted">
                <small>
                </small>
            </div>
        </div>
    </div>
    <div class="col-md-2 text-right lw-messenger-user-menu">
        <div class="dropdown">
            <button class="btn btn-black dropdown-toggle lw-datatable-action-dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-ellipsis-v"></i>
            </button>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu2">
                @if(getStoreSettings('allow_pusher') and getStoreSettings('allow_agora'))
                @if(getFeatureSettings('audio_call_via_messenger'))
                <a class="dropdown-item" id="lwAudioCallDisableBtn"><i class="fas fa-phone-alt"></i> <?= __tr('Audio Call') ?></a>
                <!-- audio call button -->
                <a class="dropdown-item" href type="button" id="lwAudioCallBtn" data-user-uid="<?= $processReaction['data']['userData']['user_uid'] ?>" data-call-type="audio" data-confirm="#lwCallErrorContainer"><i class="fas fa-phone-alt"></i> <?= __tr('Audio Call') ?></a>
                <!-- /audio call button -->
                @endif

                @if(getFeatureSettings('video_call_via_messenger'))
                <a class="dropdown-item" id="lwVideoCallDisableBtn" readonly><i class="fas fa-video"></i> <?= __tr('Video Call') ?></a>
                <!-- video call button -->
                <a class="dropdown-item" href type="button" id="lwVideoCallBtn" data-user-uid="<?= $processReaction['data']['userData']['user_uid'] ?>" data-call-type="video" data-confirm="#lwCallErrorContainer"><i class="fas fa-video"></i> <?= __tr('Video Call') ?></a>
                <!-- /video call button -->
                @endif
                @endif

                <!-- delete all chat button -->
                <a class="dropdown-item lw-disable-link" id="lwDeleteAllChatDisableButton" readonly><i class="fas fa-trash"></i> <?= __tr('Delete All Chat') ?></a>
                <a class="dropdown-item lw-ajax-link-action" id="lwDeleteAllChatActiveButton" href="<?= route('user.write.delete_all_messages', ['userId' => $processReaction['data']['userData']['user_id']]) ?>" data-method="post" data-callback="userChatResponse" data-post-data='<?= json_encode(['to_user_id' => $processReaction['data']['userData']['user_id']]) ?>' type="button"><i class="fas fa-trash"></i> <?= __tr('Delete All Chat') ?></a>
                <!-- /delete all chat button -->
            </div>
        </div>
    </div>
</div>
<div class="lw-messenger-chat-window row">
    <!-- Check if user conversation exists -->
    @if(!__isEmpty($processReaction['data']['userConversations']))
        <!-- Loop over the user conversation -->
        @foreach($userConversations as $processReaction['data']['userConversations'])
            <!-- Check if message received from other user -->
            @if($processReaction['data']['userConversations']['is_message_received'])
                <div class="lw-messenger-chat-message row col-md-12 lw-messenger-chat-recipient">
                    <!-- message received user profile picture -->
                    <img src="<?= $processReaction['data']['userData']['profile_picture_image'] ?>" class="lw-profile-picture lw-online" alt="">
                    <!-- /message received user profile picture -->

                    <!-- Check if message is only text -->
                    @if($processReaction['data']['userConversations']['type'] == 1)
                        <div class="lw-messenger-chat-item"><?= $processReaction['data']['userConversations']['message'] ?>
                            <a type="button" class="close float-right lw-ajax-link-action lw-single-message-delete" href="<?= route('user.write.delete_message', ['chatId' => $processReaction['data']['userConversations']['chat_id'], 'userId' => $processReaction['data']['userData']['user_id']]) ?>" data-method="post" data-callback="userChatResponse">
                                <span aria-hidden="true">&times;</span>
                            </a>
                            <span class="lw-messenger-chat-meta"><?= $processReaction['data']['userConversations']['created_on'] ?></span>
                        </div>
                    <!-- Check if message for Uploaded File / Giphy / Sticker -->
                    @elseif ($processReaction['data']['userConversations']['type'] == 2 or $processReaction['data']['userConversations']['type'] == 8 or $processReaction['data']['userConversations']['type'] == 12)
                        <div class="lw-messenger-chat-item"><img src="<?= $processReaction['data']['userConversations']['message'] ?>" alt="">
                            <a type="button" class="close float-right lw-ajax-link-action lw-single-message-delete" href="<?= route('user.write.delete_message', ['chatId' => $processReaction['data']['userConversations']['chat_id'], 'userId' => $processReaction['data']['userData']['user_id']]) ?>" data-method="post" data-callback="userChatResponse">
                                <span aria-hidden="true">&times;</span>
                            </a>
                            <span class="lw-messenger-chat-meta"><?= $processReaction['data']['userConversations']['created_on'] ?></span>
                        </div>
                    @endif
                </div>
            <!-- Check if message send -->
            @else
                <div class="lw-messenger-chat-message lw-messenger-chat-sender row col-md-12">
                    @if($processReaction['data']['userConversations']['type'] == 1)
                        <div class="lw-messenger-chat-item">
                            <a type="button" class="close float-right lw-ajax-link-action lw-single-message-delete" href="<?= route('user.write.delete_message', ['chatId' => $processReaction['data']['userConversations']['chat_id'], 'userId' => $processReaction['data']['userData']['user_id']]) ?>" data-method="post" data-callback="userChatResponse">
                                <span aria-hidden="true">&times;</span>
                            </a>
                            <?= $processReaction['data']['userConversations']['message'] ?>
                            <span class="lw-messenger-chat-meta"><?= $processReaction['data']['userConversations']['created_on'] ?></span>
                        </div>
                    @elseif ($processReaction['data']['userConversations']['type'] == 2 or $processReaction['data']['userConversations']['type'] == 8 or $processReaction['data']['userConversations']['type'] == 12)
                        <div class="lw-messenger-chat-item"><img src="<?= $processReaction['data']['userConversations']['message'] ?>" alt="">
                            <span class="lw-messenger-chat-meta"><?= $processReaction['data']['userConversations']['created_on'] ?></span>
                            <a type="button" class="close float-right lw-ajax-link-action lw-single-message-delete" href="<?= route('user.write.delete_message', ['chatId' => $processReaction['data']['userConversations']['chat_id'], 'userId' => $processReaction['data']['userData']['user_id']]) ?>" data-method="post" data-callback="userChatResponse">
                                <span aria-hidden="true">&times;</span>
                            </a>
                        </div>
                    @endif
                    <img src="<?= $loggedInUserProfilePicture ?>" class="lw-profile-picture lw-online" alt="">
                </div>
            @endif
            <!-- /Check if message received from other user -->
        @endforeach
        <!-- /Loop over the user conversation -->
    @endif
    <!-- Check if user conversation exists -->
</div>
<div class="lw-messenger-footer">
    <div class="col-12">
        <form class="lw-ajax-form lw-form" method="post" action="<?= route('user.write.send_message', ['userId' => $processReaction['data']['userData']['user_id']]) ?>" id="lwSendMessageForm" style="display: none;">
            <div class="input-group">
                <input type="text" name="message" class="form-control" aria-describedby="button-addon4" id="lwChatMessage">
                <div class="input-group-append" id="button-addon4">

                    <!-- Message Type for Example: Text / Gif / Sticker / Uploaded Image etc. --> 
                    <input type="hidden" name="type" value="1">
                    <!-- /Message Type for Example: Text / Gif / Sticker / Uploaded Image etc. --> 

                    <!-- Send Button -->
                    <button class="btn btn-primary" id="lwSendMessageButton" type="button"><i class="fas fa-paper-plane"></i></button>
                    <!-- /Send Button -->

                    <!-- Gif Image  Button -->
                    @if(getStoreSettings('allow_giphy'))
                    <button class="btn btn-outline-secondary lw-open-gif-action" class="lw-gif-images" type="button"><i class="fa fa-images"></i></button>
                    @endif
                    <!-- /Gif Image  Button -->

                    <!-- Sticker Button -->
                    <a class="btn btn-outline-secondary lw-open-stickers-action lw-ajax-link-action" href="<?= route('user.read.get_stickers') ?>" type="button" data-callback="__Messenger.fetchStickers"><i class="fas fa-sticky-note"></i></a>
                    <!-- /Sticker Button -->
                    
                    <button class="input-group-text" id="lwUploadingLoader" style="display: none;">
                        <div class="spinner-border spinner-border-sm" role="status">
                            <span class="sr-only"><?= __tr('Loading...') ?></span>
                        </div>
                    </button>
                    <!-- Upload Media Button -->
                    <button class="btn btn-outline-secondary lw-messenger-file-upload" type="button" id="lwMessengerFileUpload"></button>
                    <!-- Upload Media Button -->
                </div>
            </div>
        </form>

        <!--  Accept Message Request Button -->
        <a href="<?= route('user.write.accept_decline_message_request', ['userId' => $processReaction['data']['userData']['user_id']]) ?>" type="button" class="btn btn-success btn-sm lw-ajax-link-action" id="lwAcceptChatRequestBtn" data-post-data='<?= json_encode(['message_request_status' => 1]) ?>' style="display: none;" data-method="post" data-callback="__Messenger.acceptMessageRequest"><?= __tr('Accept') ?></a>
        <!--  /Accept Message Request Button -->

        <!--  Decline Message Request Button -->
        <a href="<?= route('user.write.accept_decline_message_request', ['userId' => $processReaction['data']['userData']['user_id']]) ?>" type="button" class="btn btn-danger btn-sm lw-ajax-link-action" id="lwDeclineChatRequestBtn" data-post-data='<?= json_encode(['message_request_status' => 2]) ?>' style="display: none;" data-method="post" data-callback="__Messenger.declineMessageRequest"><?= __tr('Decline') ?></a>
        <!--  Decline Message Request Button -->

        <div class="text-white" id="lwDeclineMessage" style="display: none;">
            <?= __tr('Message Request Declined') ?>
        </div>
        
    </div>
</div>
<div id="lwBuyStickerText" data-message="<?= __('Are you sure to purchase this sticker') ?>"></div>
<!-- Bottom sheet for Sticker / Gif Image -->
<div class="lw-messenger-bottom-sheet">
    <div class="lw-heading"></div>
    <div class="lw-content">
        <div id="lwStickerImagesContainer"></div>
        <div id="lwGifImagesContainer"></div>
        <!-- <div class="lw-overlay offset-md-4"></div> -->
    </div>
</div>
<!-- /Bottom sheet for Sticker / Gif Image -->
<!-- Modal -->
<div class="modal fade" id="lwUserNotAcceptedMsgRequest" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close lw-not-accepted-dialog-close-btn" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body py-4 bg-white text-center">
                <h5><?= __tr('User needs to accept chat request') ?></h5>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary lw-not-accepted-dialog-close-btn"><?= __tr('Close') ?></button>
            </div>
        </div>
    </div>
</div>

<script>
__Messenger.recipientUserProfilePicture = "<?= $processReaction['data']['userData']['profile_picture_image'] ?>";
</script>

</div>
@stop
