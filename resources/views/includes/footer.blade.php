<style type="text/css">
 .progresss {
background: linear-gradient(to right, #f51b1c 0%, #f51b1c 0%, #fff 0%, #fff 100%);
border: solid 2px #f51b1c;
border-radius: 8px;
height: 7px;
width: 100%;
outline: none;
transition: background 450ms ease-in;
-webkit-appearance: none;
}
.distance-filter input {
    padding: 0;
}
.progresss::-webkit-slider-thumb {
  width: 20px;
  height: 20px;
  border-radius: 50%;
  -webkit-appearance: none;
  cursor: ew-resize;
  background: #434343;
}
/*.distance-filter input {
    padding: 3px 0px 3px;
    width: 100%;
}*/
#slider-1, #slider-2, #slider-height1, #slider-height2 {
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    width: 100%;
    outline: none;
    position: absolute;
    margin: auto;
    top: 5px;
    bottom: 0;
    background-color: transparent;
    pointer-events: none;
    font-size: 10px;
}

/*********************************
    APTO Dropdown Styles
  **********************************/

.lw-page-content .apto-dropdown-wrapper {
    width: 65px;
    height: 45px;
    float: left;
    position: relative;
    border:1px solid #e5e5e5;
}

.lw-page-content .apto-trigger-dropdown {
    border: 0;
}

.lw-page-content .apto-trigger-dropdown:hover {
    background-color: #eeeeee0f !important;
}

.lw-page-content .apto-trigger-dropdown .fa-caret-down {

    float: right;
    line-height: 22px;
}

.lw-page-content .apto-trigger-dropdown svg {

    width: 25px;
    float: left;
    height: 25px;

}

.lw-page-content .dropdown-menu {
    width: 180px;
    display: none;
    z-index: 1;
    position: absolute;
    left: -231%;
    top: 36px;
    border-radius: none;
    box-shadow: 0 4px 5px 0 rgb(0 0 0 / 14%), 0 1px 10px 0 rgb(0 0 0 / 12%), 0 2px 4px -1px rgb(0 0 0 / 30%);
}
.lw-page-content .dropdown-menu.show {
    display:block;
}

.lw-page-content .dropdown-item svg {

    width: 25px;
    height: 25px;
    float: left;
    margin-right:10px;
    color:#222;
}

.lw-page-content .dropdown-item {
    width: 100%;
    height: 50px;
    line-height: 25px;
    border: 0;
    padding: 0 20px;
    cursor: pointer;
    transition:0.2s ease-in;
    background-color:#fff;
    font-weight: 700;
    font-family: Montserrat, serif;
    color: #5a616c;
    text-align: left;
}

.lw-page-content .dropdown-item:hover {
    background-color:#e5e5e5;
}
.lw-page-content .dropdown-item:not(:last-child){
    border-bottom: 1px solid #e5e5e5;
}
.triangle-up {
    width: 0;
    height: 0;
    border-left: 25px solid transparent;
    border-right: 25px solid transparent;
    border-bottom: 50px solid #555;
}
.lw-page-content .dropdown-item:after {
    content: '';
    position: absolute;
    top: 0;
    left: 41%;
    margin-left: 66px;
    margin-top: -8px;
    width: 0;
    z-index: 1;
    height: 0;
    border-bottom: solid 15px #FFF;
    border-left: solid 15px transparent;
    border-right: solid 15px transparent;
}
.dropdown-menu {
    border-radius: 0;
}
button.apto-trigger-dropdown {
    background-color: transparent;
}
button.apto-trigger-dropdown:focus-visible, button.apto-trigger-dropdown:focus {
    outline: none !important;
}
.red {
    margin-right: -2rem;
}
</style>
<img src="<?= asset('public/imgs/ajax-loader.gif') ?>" style="height:1px;width:1px;">

<script src="{{ asset('public/frontend/glightbox/js/glightbox.js') }}"></script>

 <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.css" rel="stylesheet"/> 


<!-- Glightbox Image Slider -->
<script>
    var lightbox = GLightbox();
    lightbox.on('open', (target) => {
        console.log('lightbox opened');
    });
    var lightboxDescription = GLightbox({
        selector: '.glightbox2'
    });
    var lightboxVideo = GLightbox({
        selector: '.glightbox3'
    });
    lightboxVideo.on('slide_changed', ({ prev, current }) => {
        console.log('Prev slide', prev);
        console.log('Current slide', current);

        const { slideIndex, slideNode, slideConfig, player } = current;

        if (player) {
            if (!player.ready) {
                        // If player is not ready
                        player.on('ready', (event) => {
                            // Do something when video is ready
                        });
                    }

                    player.on('play', (event) => {
                        console.log('Started play');
                    });

                    player.on('volumechange', (event) => {
                        console.log('Volume change');
                    });

                    player.on('ended', (event) => {
                        console.log('Video ended');
                    });
                }
            });

    var lightboxInlineIframe = GLightbox({
        selector: '.glightbox4'
    });

            /* var exampleApi = GLightbox({ selector: null });
            exampleApi.insertSlide({
                href: 'https://picsum.photos/1200/800',
            });
            exampleApi.insertSlide({
                width: '500px',
                content: '<p>Example</p>'
            });
            exampleApi.insertSlide({
                href: 'https://www.youtube.com/watch?v=WzqrwPhXmew',
            });
            exampleApi.insertSlide({
                width: '200vw',
                content: document.getElementById('inline-example')
            });
            exampleApi.open(); */
        </script>

        <script>
            window.appConfig = {
                debug: "<?= config('app.debug') ?>",
                csrf_token: "<?= csrf_token() ?>"
            }
        </script>

        <script src="{{ asset('dist/pusher-js/pusher.min.js') }}"></script>
        <script src="{{ asset('dist/js/vendorlibs-public.js') }}"></script>
        <script src="{{ asset('dist/js/vendorlibs-datatable.js') }}"></script>
        <script src="{{ asset('dist/js/vendorlibs-photoswipe.js') }}"></script>
        <script src="{{ asset('dist/js/vendorlibs-smartwizard.js') }}"></script>
        <script>
            (function () {
                $.validator.messages = $.extend({}, $.validator.messages, {
                    required: '<?= __tr("This field is required.") ?>',
                    remote: '<?= __tr("Please fix this field.") ?>',
                    email: '<?= __tr("Please enter a valid email address.") ?>',
                    url: '<?= __tr("Please enter a valid URL.") ?>',
                    date: '<?= __tr("Please enter a valid date.") ?>',
                    dateISO: '<?= __tr("Please enter a valid date (ISO).") ?>',
                    number: '<?= __tr("Please enter a valid number.") ?>',
                    digits: '<?= __tr("Please enter only digits.") ?>',
                    equalTo: '<?= __tr("Please enter the same value again.") ?>',
                    maxlength: $.validator.format('<?= __tr("Please enter no more than {0} characters.") ?>'),
                    minlength: $.validator.format('<?= __tr("Please enter at least {0} characters.") ?>'),
                    rangelength: $.validator.format('<?= __tr("Please enter a value between {0} and {1} characters long.") ?>'),
                    range: $.validator.format('<?= __tr("Please enter a value between {0} and {1}.") ?>'),
                    max: $.validator.format('<?= __tr("Please enter a value less than or equal to {0}.") ?>'),
                    min: $.validator.format('<?= __tr("Please enter a value greater than or equal to {0}.") ?>'),
                    step: $.validator.format('<?= __tr("Please enter a multiple of {0}.") ?>')
                });
            })();
        </script>
         <script src="{{ asset('dist/js/common-app.*.js') }}"></script>
        <script>
            __Utils.setTranslation({
                'processing': "<?= __tr('processing') ?>",
                'uploader_default_text': "<span class='filepond--label-action'><?= __tr('Drag & Drop Files or Browse') ?></span>",
                'gif_no_result': "<?= __tr('Result Not Found') ?>",
                "message_is_required": "<?= __tr('Message is required') ?>",
                "sticker_name_label": "<?= __tr('Stickers') ?>"
            });

            var userLoggedIn = '<?= isLoggedIn() ?>',
            enablePusher = '<?= getStoreSettings('allow_pusher') ?>';

            if (userLoggedIn && enablePusher) {
                var userUid = '<?= getUserUID() ?>',
                pusherAppKey = '<?= getStoreSettings('pusher_app_key') ?>',
                __pusherAppOptions = {
                    cluster: '<?= getStoreSettings('pusher_app_cluster_key') ?>',
                    forceTLS: true,
                };

            }
        </script>
        <!-- Include Audio Video Call Component -->
        @include('messenger.audio-video')
        <!-- /Include Audio Video Call Component -->
        <script>
    //check user loggedIn or not
    if (userLoggedIn && enablePusher) {
        //subscribe pusher notification
        subscribeNotification('event.user.notification', pusherAppKey, userUid, function (responseData) {
            //get notification list
            var requestData = responseData.getNotificationList,
            getNotificationList = requestData.notificationData,
            getNotificationCount = requestData.notificationCount;
            //update notification count
            __DataRequest.updateModels({
                'totalNotificationCount': getNotificationCount, //total notification count
            });
            //check is not empty
            if (!_.isEmpty(getNotificationList)) {
                var template = _.template($("#lwNotificationListTemplate").html());
                $("#lwNotificationContent").html(template({
                    'notificationList': getNotificationList,
                }));
            }
            //check is not empty
            if (responseData) {
                switch (responseData.type) {
                    case 'user-likes':
                    if (responseData.showNotification != 0) {
                        showSuccessMessage(responseData.message);
                    }
                    break;
                    case 'user-gift':
                    if (responseData.showNotification != 0) {
                        showSuccessMessage(responseData.message);
                    }
                    break;
                    case 'profile-visitor':
                    if (responseData.showNotification != 0) {
                        showSuccessMessage(responseData.message);
                    }
                    break;
                    case 'user-login':
                    if (responseData.showNotification != 0) {
                        showSuccessMessage(responseData.message);
                    }
                    break;
                    default:
                    showSuccessMessage(responseData.message);
                    break;
                }
            }
        });

        subscribeNotification('event.user.chat.messages', pusherAppKey, userUid, function (responseData) {
            // Message chat
            if (responseData.requestFor == 'MESSAGE_CHAT') {
                if (currentSelectedUserUid == responseData.toUserUid) {
                    __Messenger.appendReceivedMessage(responseData.type, responseData.message, responseData.createdOn);
                }

                // Set user message count
                if (responseData.userId != currentSelectedUserId) {
                    var incomingMsgEl = $('.lw-incoming-message-count-' + responseData.userId),
                    messageCount = 1;
                    if (!_.isEmpty(incomingMsgEl.text())) {
                        messageCount = parseInt(incomingMsgEl.text()) + 1;
                    }
                    incomingMsgEl.text(messageCount);
                    // Show notification of incoming messages
                    if (responseData.showNotification) {
                        showSuccessMessage(responseData.notificationMessage);
                    }
                }
            }

            // Message request
            if (responseData.requestFor == 'MESSAGE_REQUEST') {
                if (responseData.userId == currentSelectedUserId) {
                    handleMessageActionContainer(responseData.messageRequestStatus, false);
                    if (!_.isEmpty(responseData.message)) {
                        __Messenger.appendReceivedMessage(responseData.type, responseData.message, responseData.createdOn);
                    }
                } else {
                    if (responseData.showNotification) {
                        showSuccessMessage(responseData.notificationMessage);
                    }
                }
            }

        });
    };

    //for cookie terms 
    function showCookiePolicyDialog() {
        if (__Cookie.get('cookie_policy_terms_accepted') != '1') {
            $('#lwCookiePolicyContainer').show();
        } else {
            $('#lwCookiePolicyContainer').hide();
        }
    };

    showCookiePolicyDialog();

    $("#lwCookiePolicyButton").on('click', function () {
        __Cookie.set('cookie_policy_terms_accepted', '1', 1000);
        showCookiePolicyDialog();
    });

    // Get messenger chat data
    function getChatMessenger(url, isAllChatMessenger) {
        var $allMessageChatButtonEl = $('#lwAllMessageChatButton'),
        $lwMessageChatButtonEl = $('#lwMessageChatButton');
        // check if request for all messenger 
        if (isAllChatMessenger) {
            var isAllMessengerChatLoaded = $allMessageChatButtonEl.data('chat-loaded');
            if (!isAllMessengerChatLoaded) {
                $allMessageChatButtonEl.attr('data-chat-loaded', true);
                $lwMessageChatButtonEl.attr('data-chat-loaded', false);
                fetchChatMessages(url);
            }
        } else {
            var isMessengerLoaded = $lwMessageChatButtonEl.data('chat-loaded');
            if (!isMessengerLoaded) {
                $lwMessageChatButtonEl.attr('data-chat-loaded', true);
                $allMessageChatButtonEl.attr('data-chat-loaded', false);
                fetchChatMessages(url);
            }
        }
    };

    // Fetch messages from server
    function fetchChatMessages(url) {
        $('#lwChatDialogLoader').show();
        $('#lwMessengerContent').hide();
        __DataRequest.get(url, {}, function (responseData) {
            $('#lwChatDialogLoader').hide();
            $('#lwMessengerContent').show();
        });
    };



    $(document).ready(function(){

      $("#list_view").hide();
      $(".grid_block").click(function(){
          $("#grid_block").show();
          $("#list_view").hide();
      });
      $(".listing").click(function(){
          $("#grid_block").hide();
          $("#list_view").show();
      });
  });


</script>

<script type="text/javascript">
    $(document).ready(function(){

      $(".setting-list-content").hide();
      $("#about-setting").show();
      $(".about-list").click(function(){
          $("#about-setting").show();
          $("#about-setting").addClass('active');
          $("#activity-setting").hide();
      });
      $(".activity-list").click(function(){
          $("#about-setting").hide();
          $("#activity-setting").show();
      });
  });
</script>
<script type="text/javascript">
    const progress = document.querySelector('.progresss');

    progress.addEventListener('input', function() {
      const value = this.value;
      this.style.background = `linear-gradient(to right, #f51b1c 0%, #f51b1c ${value}%, #fff ${value}%, white 100%)`
  })
</script>
@stack('appScripts')
<script type="text/javascript">
    jQuery(document).ready(function() {

      jQuery(document).click(function() {
       jQuery('.dropdown-menu.show').removeClass('show');
   });

      jQuery('body').on('click','.apto-trigger-dropdown', function(e){

        e.stopPropagation();

        jQuery(this).closest('.apto-dropdown-wrapper').find('.dropdown-menu').toggleClass('show');
    });


      jQuery('body').on('click','.dropdown-item', function(e){

        e.stopPropagation();

        let $selectedValue = jQuery(this).val(); 
        let $icon          = jQuery(this).find('svg');
        let $btn           = jQuery(this).closest('.apto-dropdown-wrapper').find('.apto-trigger-dropdown');

        jQuery(this).closest('.apto-dropdown-wrapper').find('.dropdown-menu').removeClass('show').attr('data-selected', $selectedValue);

        $btn.find('svg').remove();
        $btn.prepend($icon[0].outerHTML);

    });

  });
</script>

