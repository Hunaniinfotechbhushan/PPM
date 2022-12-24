
 <ul class="navbar-nav sidebar  accordion" id="accordionSidebar">

       <li class="nav-item mt-2 d-sm-block d-md-none">

        <a href class="nav-link" onclick="getChatMessenger('user/messenger/all-conversation', true)" id="lwAllMessageChatButton" data-chat-loaded="false" data-toggle="modal" data-target="#messengerDialog">

            <i class="far fa-comments"></i>

            <span>Messenger</span>

        </a>

    </li>

    <!-- Notification Link -->

    <li class="nav-item dropdown no-arrow mx-1 d-sm-block d-md-none">

        <a class="nav-link dropdown-toggle lw-ajax-link-action" href="user/notifications/read-all-notification" data-callback="onReadAllNotificationCallback" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-method="post">

            <i class="fas fa-bell fa-fw"></i>

            <span>Notification</span>

            <span class="badge badge-danger badge-counter" id="lwNotificationCount">0</span>

        </a>

        <!-- Dropdown - Alerts -->

        <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">

            <h6 class="dropdown-header">

            Notification                </h6>

            <!-- Notification block -->             

            <!-- info message -->

            <a class="dropdown-item text-center small text-gray-500">There are no notification.</a>

            <!-- /info message -->

            <!-- /Notification block -->

        </div>

    </li>

    <!-- /Notification Link -->



    <!-- Nav Item - Messages -->

    <li class="nav-item d-sm-block d-md-none">

        <a class="nav-link" href="user/credit-wallet">

            <i class="fas fa-coins fa-fw mr-2"></i>

            <span>Credit Wallet</span>

            <span class="badge badge-success badge-counter">0</span>

        </a>

    </li>



    <!-- Nav Item - Messages -->

    <li class="nav-item d-sm-block d-md-none">

        <a class="nav-link" href  data-toggle="modal" data-target="#boosterModal">

            <i class="fas fa-bolt fa-fw mr-2"></i>

            <span>Profile Booster</span>

            <span id="lwBoosterTimerCountDownOnSB"></span>

        </a>

    </li>



    <hr class="sidebar-divider mt-2 mb-2 d-sm-block d-md-none">

    <!-- Heading -->

    <li class="nav-item justify-content-between text-left select-drop-down about-list settings-sidebar setting_sidebar_menu" value="about-settings">
           <a href="#">
       <p class="setting-list active">Settings</p>
         </a>
     </li>

    <li class="nav-item justify-content-between text-left select-drop-down activity-list settings-sidebar" value="notification-setting">
           <a href="#">
       <p class="setting-list">Notification</p>
         </a>
     </li>

      <li class="nav-item justify-content-between text-left select-drop-down settings-sidebar" value="hidden_members">
           <a href="#">
       <p class="setting-list">Hidden Members </p>
         </a>
     </li>
        
      <li class="nav-item justify-content-between text-left select-drop-down settings-sidebar" value="video_chat_permissions">
           <a href="#">
       <p class="setting-list">Video Chat Permissions </p>
         </a>
     </li>
   
      <li class="nav-item justify-content-between text-left select-drop-down settings-sidebar" value="subscription-setting">
           <a href="#">
       <p class="setting-list">Subscription </p>
         </a>
     </li>

 <li class="nav-item justify-content-between text-left select-drop-down settings-sidebar" value="security_information">
       <a href="#">
       <p class="setting-list">Security Information </p>
     </li>
         

 <li class="nav-item justify-content-between text-left select-drop-down settings-sidebar" value="verifications">
    <a href="#">
       <p class="setting-list">Verifications</p>
         </a>
     </li>     



 <!-- Heading -->

</ul>
<script type="text/javascript">
    jQuery(document).ready(function(){
        jQuery("#accordionSidebar .settings-sidebar").click(function(){
            jQuery('.settings-main .setting-list-content').hide();
            jQuery('#'+jQuery(this).attr('value')).show();
            window.history.replaceState(null, null, '?'+jQuery(this).attr('value'));
        });
        var url = window.location.href;
         var href = url.substring(0, url.indexOf('='));
         if(href == ''){
            var index = url.indexOf("?");
         }else{
            var index = href.indexOf("?");
         }
        // var index = href.indexOf("?");
        if (index !== -1)
        {
            if(href == ''){
            var hashTab = url.substring(index + 1);
             }else{
                var index2 = url.indexOf("?");
                if (index2 !== -1)
                {
                    var hash1 = url.substring(index2 + 1);
                    var beforePlus = hash1.split('=').shift();
                }
                var index1 = url.indexOf("="); 
                if (index1 !== -1)
                {
                    var hash = url.substring(index1 + 1);
                }
             }
            setTimeout(function(){
                jQuery('.settings-main .setting-list-content').hide();
                if(hashTab == null){
                    jQuery('#'+beforePlus).show();
                }else{
                    jQuery('#'+hashTab).show();
                }
            },50);
            setTimeout(function(){
                jQuery('.grouped-inner .'+hash+'').click();
            },60);
        }
        setTimeout(function(){
            jQuery('.tabordion_settings section').first().find('.grouped-inner label').click();
        },50);
        jQuery(".tabordion_settings .grouped-inner label").click(function(){
            jQuery('.tabordion_settings .grouped-inner label').removeClass('active');
            jQuery(this).addClass('active');
            jQuery('.tabordion_settings .grouped-inner .inner-con').hide();
            jQuery(this).next().show();
        });
    });
</script>

