<!-- include header -->

<!DOCTYPE html>

<html lang="en" dir="ltr">

<head>

    <meta charset="utf-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <meta name="description" content="">

    <meta name="author" content="">

    <title>Search</title>

    <!-- Custom fonts for this template-->

    <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:300,400,600,700&display=swap" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet">

    <link rel="shortcut icon" href="backend/media-storage/favicon/favicon.ico?ver=" type="image/x-icon">

    <link rel="icon" href="backend/media-storage/favicon/favicon.ico?ver=" type="image/x-icon">



    <!-- Primary Meta Tags -->

    <meta name="title" content="admin">

    <meta name="description" content="">

    <meta name="keywordDescription" property="og:keywordDescription" content="">

    <meta name="keywordName" property="og:keywordName" content="">

    <meta name="keyword" content="">

    <!-- Google Meta -->

    <meta itemprop="name" content="admin">

    <meta itemprop="description" content="">

    <meta itemprop="image" content="backend/imgs/no_thumb_image.jpg">

    <!-- Open Graph / Facebook -->

    <meta property="og:type" content="website">

    <meta property="og:url" content="@admin">

    <meta property="og:title" content="admin">

    <meta property="og:description" content="">

    <meta property="og:image" content="backend/imgs/no_thumb_image.jpg">

    <!-- Twitter -->

    <meta property="twitter:card" content="backend/imgs/no_thumb_image.jpg">

    <meta property="twitter:url" content="@admin">

    <meta property="twitter:title" content="admin">

    <meta property="twitter:description" content="">

    <meta property="twitter:image" content="backend/imgs/no_thumb_image.jpg">



    <!-- Custom styles for this template-->

    <link href="backend/dist/css/style.css" rel="stylesheet" type="text/css">

    <link href="backend/dist/css/public-assets-app.min.css?VER=0849bb30a3441d013da219a1ff12bab0" rel="stylesheet" type="text/css">

    <link href="backend/dist/fa/css/all.min.css?VER=65207e5766e5ebc30a37454161bb3af3" rel="stylesheet" type="text/css">

    <link href="backend/dist/css/vendorlibs-datatable.css?VER=d99371a7db79cf796b96552cda3ded7e" rel="stylesheet" type="text/css">

    <link href="backend/dist/css/vendorlibs-photoswipe.css?VER=65207e5766e5ebc30a37454161bb3af3" rel="stylesheet" type="text/css">

    <link href="backend/dist/css/vendorlibs-smartwizard.css?VER=65207e5766e5ebc30a37454161bb3af3" rel="stylesheet" type="text/css">

    <link href="backend/dist/css/custom.min.css?VER=da62064a90680ebe9a4427f10f1fbbdc" rel="stylesheet" type="text/css">

    <link href="backend/dist/css/messenger.min.css?VER=249c788a985ac5ca9d7e348654519004" rel="stylesheet" type="text/css">

    <link href="backend/dist/css/login-register.min.css?VER=d301065fe7065e0775a6b160a2cdc628" rel="stylesheet" type="text/css">



    <!-- font-awosm -->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />



</head><!-- /include header -->

<body id="page-top" class="lw-page-bg lw-public-master">

   <!-- Page Wrapper -->

   <div class="container-fluid">

    <!-- Topbar -->

    <nav class="row navbar navbar-expand navbar-light 

    topbar mb-4 static-top shadow menu-bar">

    <!-- Sidebar Toggle (Topbar) -->

    <button type="button" id="sidebarToggleTop" class="btn btn-link d-block d-md-none rounded-circle mr-3">

      <img class="lw-logo-img" src="backend/media-storage/logo/logo.png?ver=1644819848" alt="PPM">

  </button>

  <!-- Nav Item - Search Dropdown (Visible Only XS) -->

  <div class="nav-item dropdown no-arrow d-flex">

      <a class="sidebar-brand d-flex align-items-center" href="home">

        <div class="sidebar-brand-icon">

            <img class="lw-logo-img" src="backend/media-storage/small_logo/images.png?ver=1644474798" alt="PPM">

        </div>

        <img class="lw-logo-img d-sm-none d-none d-md-block" src="backend/media-storage/logo/logo.png?ver=1644819848" alt="PPM">

        <img class="lw-logo-img d-sm-block d-md-none" src="backend/media-storage/small_logo/images.png?ver=1644474798" alt="PPM">

    </a>

    <div class="d-flex align-items-center">

        <ul class="d-flex header-menu">

           <li><i class="fa-solid fa-magnifying-glass"></i>Search</li>

           <li><i class="fa-solid fa-heart"></i>Interests</li>

           <li><i class="fa-solid fa-photo-film"></i>Events</li>

           <li><i class="fa-solid fa-comment-dots"></i>Message</li>

       </ul>

   </div>  

</div>

<ul class="navbar-nav">

    <li class="nav-item d-none d-sm-none d-md-block">

        <a class="nav-link" onclick="getChatMessenger('user/messenger/all-conversation', true)" id="lwAllMessageChatButton" data-chat-loaded="false" data-toggle="modal" data-target="#messengerDialog">

            <i class="far fa-comments"></i>

        </a>

    </li>

    <!-- Notification Link -->

    <li class="nav-item dropdown no-arrow mx-1 d-none d-sm-none d-md-block">

        <a class="nav-link dropdown-toggle lw-ajax-link-action" href="user/notifications/read-all-notification" data-callback="onReadAllNotificationCallback" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-method="post">

            <i class="fas fa-bell fa-fw"></i>

            <span class="badge badge-danger badge-counter" data-model="totalNotificationCount"></span>

        </a>

        <!-- Dropdown - Alerts -->

        <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">

            <h6 class="dropdown-header">

            Notification                </h6>

            <!-- Notification block -->     

            <div id="lwNotificationContent"></div>

            <!-- /Notification block -->

        </div>

    </li>

    <!-- Notification Link -->

    <li class="nav-item dropdown no-arrow mx-1 d-none d-sm-none d-md-block">

        <a class="nav-link">

            <select>

                <option>Eng</option>

                <option>Eng</option>

            </select>

        </a>

        <!-- Dropdown - Alerts -->

    </li>

    <!-- Nav Item - User Information -->

    <li class="nav-item dropdown no-arrow">

        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

            <img class="img-profile rounded-circle" src="backend/imgs/no_thumb_image.jpg">

        </a>

        <!-- Dropdown - User Information -->

        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">

            <h6 class="dropdown-header">

            PPM Admin                </h6>

            <div class="dropdown-divider"></div>

            <a class="dropdown-item" href="@admin">

                <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>

            Profile                </a>

            <a class="dropdown-item" href="user/settings/notification">

                <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>

            Settings                </a>

            <a class="dropdown-item" href="user/change-password">

                <i class="fas fa-key fa-sm fa-fw mr-2 text-gray-400"></i>

            Change Password                </a>

            <a class="dropdown-item" href="user/change-email">

                <i class="fas fa-envelope fa-sm fa-fw mr-2 text-gray-400"></i>

            Change Email                </a>

            <div class="dropdown-divider"></div>

            <a class="dropdown-item text-primary" target="_blank" href="admin">

                <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>

            Admin Panel                    </a>

            <div class="dropdown-divider"></div>

            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">

                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>

            Logout                </a>

        </div>

    </li>

</ul>

</nav>

</div>

<div class="bottom-bar-mobile">
                    <ul class="d-flex justify-content-between">
                         <li class="active"><i class="fa-solid fa-house"></i>Home</li>
                         <li class=""><i class="fa-solid fa-magnifying-glass"></i>Search</li>
                        <li><i class="fa-solid fa-heart"></i>Interests</li>
                        <li><i class="fa-solid fa-photo-film"></i>Events</li>
                        <li><i class="fa-solid fa-comment-dots"></i>Message</li>
                    </ul>
        </div>







<div id="wrapper" class="container-fluid">

    <!-- include sidebar -->

    <!-- Sidebar -->

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



    <li class="nav-item justify-content-between text-left select-drop-down">

     <select class="select-sidebar">

         <option>Saved Searchs & Option</option>

         <option>List 1</option>

         <option>List 1</option>

     </select>

     <span class="d-flex justify-content-between align-items-center my-2"><button class="web-button">

         Load More

     </button><p>Reset All</p></span>

 </li>
<li class="nav-item justify-content-between text-left select-drop-down">
      <select class="select-sidebar">

         <option>Saved Searchs & Option</option>

         <option>List 1</option>

         <option>List 1</option>

     </select>

     <span class="d-flex justify-content-between align-items-center my-2"><button class="web-button">

         Search

     </button><p>Reset All</p></span>
</li>

<li class="nav-item justify-content-between text-left select-drop-down">
    <p>OPTION</p>
    <div>
     <form action="/action_page.php">
      <input type="checkbox" id="vehicle1" name="vehicle1" value="Bike">
      <label for="vehicle1"> View</label><br>
      <input type="checkbox" id="vehicle2" name="vehicle2" value="Car">
      <label for="vehicle2"> Photo</label><br>
    </form>
 
    </div>
</li>
 <!-- Heading -->

 <li class="nav-item justify-content-between text-left select-drop-down">
     <div class="accordion_container">
      <div class="accordion_head"><div class="d-flex justify-content-between"><span>Location</span><i class="fa-solid fa-caret-down"></i></div></div>
      <div class="accordion_body" style="display: none;">
        <p>lorem ipsum </p>
      </div>
      <div class="accordion_head"><div class="d-flex justify-content-between"><span>SHOW MEMBERS SEEKING</span><i class="fa-solid fa-caret-down"></i></div></div>
      <div class="accordion_body" style="display: none;">
        <p>Second Accordian Body, it will have description</p>
      </div>
      <div class="accordion_head"><div class="d-flex justify-content-between"><span>BODY TYPE</span><i class="fa-solid fa-caret-down"></i></div></div>
      <div class="accordion_body" style="display: none;">
        <p>Third Accordian Body, it will have description</p>
      </div>
       <div class="accordion_head"><div class="d-flex justify-content-between"><span>AGE</span><i class="fa-solid fa-caret-down"></i></div></div>
      <div class="accordion_body" style="display: none;">
        <p>Third Accordian Body, it will have description</p>
      </div>
       <div class="accordion_head"><div class="d-flex justify-content-between"><span>ETHNICITY</span><i class="fa-solid fa-caret-down"></i></div></div>
      <div class="accordion_body" style="display: none;">
        <p>Third Accordian Body, it will have description</p>
      </div>
       <div class="accordion_head"><div class="d-flex justify-content-between"><span>HEIGHT</span><i class="fa-solid fa-caret-down"></i></div></div>
      <div class="accordion_body" style="display: none;">
        <p>Third Accordian Body, it will have description</p>
      </div>
      <div class="accordion_head"><div class="d-flex justify-content-between"><span>HAIR COLOR</span><i class="fa-solid fa-caret-down"></i></div></div>
      <div class="accordion_body" style="display: none;">
        <p>Third Accordian Body, it will have description</p>
      </div>
      <div class="accordion_head"><div class="d-flex justify-content-between"><span>SMOKING</span><i class="fa-solid fa-caret-down"></i></div></div>
      <div class="accordion_body" style="display: none;">
        <p>Third Accordian Body, it will have description</p>
      </div>
      <div class="accordion_head"><div class="d-flex justify-content-between"><span>DRINKING</span><i class="fa-solid fa-caret-down"></i></div></div>
      <div class="accordion_body" style="display: none;">
        <p>Third Accordian Body, it will have description</p>
      </div>
      <div class="accordion_head"><div class="d-flex justify-content-between"><span>RELATIONSHIP STATUS</span><i class="fa-solid fa-caret-down"></i></div></div>
      <div class="accordion_body" style="display: none;">
        <p>Third Accordian Body, it will have description</p>
      </div>
      <div class="accordion_head"><div class="d-flex justify-content-between"><span>EDUCATION</span><i class="fa-solid fa-caret-down"></i></div></div>
      <div class="accordion_body" style="display: none;">
        <p>Third Accordian Body, it will have description</p>
      </div>
      <div class="accordion_head"><div class="d-flex justify-content-between"><span>CHILDREN</span><i class="fa-solid fa-caret-down"></i></div></div>
      <div class="accordion_body" style="display: none;">
        <p>Third Accordian Body, it will have description</p>
      </div>
       <div class="accordion_head"><div class="d-flex justify-content-between"><span>LANGUAGE</span><i class="fa-solid fa-caret-down"></i></div></div>
      <div class="accordion_body" style="display: none;">
        <p>Third Accordian Body, it will have description</p>
      </div>
       <div class="accordion_head"><div class="d-flex justify-content-between"><span>ANNUAL INCOME</span><i class="fa-solid fa-caret-down"></i></div></div>
      <div class="accordion_body" style="display: none;">
        <p>Third Accordian Body, it will have description</p>
      </div>
       <div class="accordion_head"><div class="d-flex justify-content-between"><span>NET WORTH</span><i class="fa-solid fa-caret-down"></i></div></div>
      <div class="accordion_body" style="display: none;">
        <p>Third Accordian Body, it will have description</p>
      </div>
        <div class="accordion_head"><div class="d-flex justify-content-between"><span>DON'T SHOW MEMBERS SEEKING</span><i class="fa-solid fa-caret-down"></i></div></div>
      <div class="accordion_body" style="display: none;">
        <p>Third Accordian Body, it will have description</p>
      </div>
    </div>
    
 </li>

</ul>



<!-- Content Wrapper -->

<div id="content-wrapper" class="d-flex flex-column lw-page-bg">

    <div id="content">

        <!-- include top bar -->















        <!-- Modal -->

        <div class="modal fade" id="boosterModal" tabindex="-1" role="dialog" aria-labelledby="boosterModalLabel" aria-hidden="true">

            <div class="modal-dialog" role="document">

                <div class="modal-content">

                    <div class="modal-header">

                        <h5 class="modal-title" id="boosterModalLabel">Boost Profile</h5>

                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                            <span aria-hidden="true">&times;</span>

                        </button>

                    </div>

                    <div class="modal-body">



                        <!-- insufficient balance error message -->

                        <div class="alert alert-info" id="lwBoosterCreditsNotAvailable" style="display: none;">

                            Your credit balance is too low, please              <a href="user/credit-wallet">purchase credits</a>

                        </div>

                        <!-- / insufficient balance error message -->



                        <div class="text-center">



                            This will costs you             <span id="lwBoosterPrice">

                            0                </span>

                            credits for immediate               <span id="lwBoosterPeriod">

                            5               </span>

                        minutes         </div>

                    </div>

                    <div class="modal-footer">

                        <button type="button" class="btn btn-light btn-sm" data-dismiss="modal">Cancel</button>

                        <a class="btn btn-success btn-sm lw-ajax-link-action" data-callback="onProfileBoosted" href="user/boost-profile" data-method="post"><i class="fas fa-bolt fa-fw"></i> Boost</a>

                    </div>

                </div>

            </div>

        </div>



        <!-- Delete Account Container -->

        <div class="modal fade" id="lwDeleteAccountModel" tabindex="-1" role="dialog" aria-labelledby="messengerModalLabel" aria-hidden="true" style="display: none;">

            <div class="modal-dialog modal-lg" role="document">

                <div class="modal-content">

                    <div class="modal-header">

                        <h5 class="modal-title">Delete account?</h5>        

                    </div>

                    <div class="modal-body">

                        <!-- Delete Account Form -->

                        <form class="user lw-ajax-form lw-form" method="post" action="user/delete-account">

                            <!-- Delete Message -->

                            Are you sure you want to delete your account? All content including photos and other data will be permanently removed!                    <!-- /Delete Message -->

                            <hr/>

                            <!-- password input field -->

                            <div class="form-group">

                                <label for="password">Enter your password</label>

                                <input type="password" class="form-control" name="password" id="password" placeholder="Password" required minlength="6">

                            </div>

                            <!-- password input field -->



                            <!-- Delete Account -->

                            <button type="submit" class="lw-ajax-form-submit-action btn btn-primary btn-user btn-block-on-mobile">Delete Account</button>

                            <!-- / Delete Account -->

                        </form>

                        <!-- /Delete Account Form -->

                    </div>

                </div>

            </div>

        </div>











        <!-- product zoom gallery block -->

        <div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">

            <div class="pswp__bg"></div>

            <div class="pswp__scroll-wrap">

                <div class="pswp__container">

                    <div class="pswp__item"></div>

                    <div class="pswp__item"></div>

                    <div class="pswp__item"></div>

                </div>

            </div>

        </div>

        <!-- / product zoom gallery block -->

        <!-- End of Topbar -->

        <!-- /include top bar -->



        <!-- Begin Page Content -->

        <div class="lw-page-content px-2">

            <!-- header advertisement -->

            <div class="lw-ad-block-h90">

            </div>

            <div class="card mb-3 ">

                <div class="card-header d-flex justify-content-between">

                   <h3 class="mb-0"><i class="fa-solid fa-magnifying-glass"></i>New Search</h3>

                   <div class="d-flex"> 


                 </div>

             </div>

         </div>
         
                <div class="card mb-3 ">

                <div class="card-header d-flex justify-content-between align-items-center filter">

                 <div class="d-flex">
                       <p>Inbox</p>
                       <p>Filterd Out</p>
                 </div>

                   <div class="d-flex align-items-center"> 
                    <div class="d-flex">
                       <i class="fa-solid fa-table-cells"></i>
                        <i class="fa-solid fa-table-list"></i>
                    </div>
                     <div class="col-md-3 col-sm-12 text-right intrest-input">
                         <select>
                             <option>26 Page</option>
                         </select>
                         
                    </div>

                 </div>

             </div>

         </div>
         

     <div class="card mb-3 d-md-none event-filter">

        <div class="card-header">

         <ul class="mobile-filter">
            <li><a class="btn FormFooter-rightLink u-hide--tablet-up js-toggleSidebarBtn css-157uzvc" id="filterSidebarClose"><svg viewBox="0 0 24 24" fill="black" width="24px" height="24px"><g fill="#949494"><path d="M0 0h24v24H0z" fill="none"></path><path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"></path></g></svg></a></li>
            <li class="nav-item ">

             <select class="select-sidebar">

                 <option>Saved Searchs & Option</option>

                 <option>List 1</option>

                 <option>List 1</option>

             </select>

             <span class="d-flex justify-content-between align-items-center my-2"><button class="web-button">

                 Load More

             </button><p>Reset All</p></span>

         </li>

         <!-- Heading -->

         <li class="nav-item justify-content-between text-left select-drop-down">

             <p>Location</p>

             <select class="select-sidebar">

                 <option>City, Postel Code</option>

                 <option>List 1</option>

                 <option>List 1</option>

             </select>

         </li>

         <li class="nav-item justify-content-between text-left select-drop-down">

             <p>Meet Type</p>

             <select class="select-sidebar">

                 <option>Any</option>

                 <option>List 1</option>

                 <option>List 1</option>

             </select>

         </li>

         <li class="nav-item justify-content-between text-left select-drop-down">

             <p>When</p>

             <select class="select-sidebar">

                 <option>Any</option>

                 <option>List 1</option>

                 <option>List 1</option>

             </select>

         </li>

         <li class="nav-item justify-content-between text-left select-drop-down">

             <p>Profile</p>

             <select class="select-sidebar">

                 <option>Jhone Deo, Honkin</option>

                 <option>List 1</option>

                 <option>List 1</option>

             </select>

             <span class="d-flex justify-content-between align-items-center my-2"><button class="web-button">

                 Search

             </button><p>Reset All</p></span>

         </li>

     </ul>

 </div>

</div>

</div>

<div class="row">
    <div class="col-6 col-sm-6 col-md-4">
        <div class="serch-result-box">
            <div class="result-box-img">
                <img src="https://images.seeking.com/prod/photos/92aa5263-226d-4625-9dee-7747aa57fe98.jpg" width="100%">
            </div>
            <div class="result-box-body">
                <div class="like"><i class="fa-solid fa-heart"></i></div>
                <p class="font-bold">EnchantingPlayer</p>
                <P class="result-location text-gray-400">Mexico City, Mexico City, Mexico</P>
                <P>Soy una chica lista.</P>
                <p>3 photos</p>
            </div>
        </div>
    </div>
       <div class="col-6 col-sm-6 col-md-4">
        <div class="serch-result-box">
            <div class="result-box-img">
                <img src="https://images.seeking.com/prod/photos/92aa5263-226d-4625-9dee-7747aa57fe98.jpg" width="100%">
            </div>
            <div class="result-box-body">
                <div class="like"><i class="fa-solid fa-heart"></i></div>
                <p class="font-bold">EnchantingPlayer</p>
                <P class="result-location text-gray-400">Mexico City, Mexico City, Mexico</P>
                <P>Soy una chica lista.</P>
                <p>3 photos</p>
            </div>
        </div>
    </div>
       <div class="col-6 col-sm-6 col-md-4">
        <div class="serch-result-box">
            <div class="result-box-img">
                <img src="https://images.seeking.com/prod/photos/92aa5263-226d-4625-9dee-7747aa57fe98.jpg" width="100%">
            </div>
            <div class="result-box-body">
                <div class="like"><i class="fa-solid fa-heart"></i></div>
                <p class="font-bold">EnchantingPlayer</p>
                <P class="result-location text-gray-400">Mexico City, Mexico City, Mexico</P>
                <P>Soy una chica lista.</P>
                <p>3 photos</p>
            </div>
        </div>
    </div>
       <div class="col-6 col-sm-6 col-md-4">
        <div class="serch-result-box">
            <div class="result-box-img">
                <img src="https://images.seeking.com/prod/photos/92aa5263-226d-4625-9dee-7747aa57fe98.jpg" width="100%">
            </div>
            <div class="result-box-body">
                <div class="like"><i class="fa-solid fa-heart"></i></div>
                <p class="font-bold">EnchantingPlayer</p>
                <P class="result-location text-gray-400">Mexico City, Mexico City, Mexico</P>
                <P>Soy una chica lista.</P>
                <p>3 photos</p>
            </div>
        </div>
    </div>
       <div class="col-6 col-sm-6 col-md-4">
        <div class="serch-result-box">
            <div class="result-box-img">
                <img src="https://images.seeking.com/prod/photos/92aa5263-226d-4625-9dee-7747aa57fe98.jpg" width="100%">
            </div>
            <div class="result-box-body">
                <div class="like"><i class="fa-solid fa-heart"></i></div>
                <p class="font-bold">EnchantingPlayer</p>
                <P class="result-location text-gray-400">Mexico City, Mexico City, Mexico</P>
                <P>Soy una chica lista.</P>
                <p>3 photos</p>
            </div>
        </div>
    </div>
</div>



<!-- /User Specifications -->



</div>

</div>



<!-- user report Modal-->

<div class="modal fade" id="lwReportUserDialog" tabindex="-1" role="dialog" aria-labelledby="userReportModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-md" role="document">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title" id="userReportModalLabel">Abuse Report to loveria Admin</h5>

                <button class="close" type="button" data-dismiss="modal" aria-label="Close">

                    <span aria-hidden="true">×</span>

                </button>

            </div>

            <form class="lw-ajax-form lw-form" id="lwReportUserForm" method="post" data-callback="userReportCallback" action="user/50ee1967-7341-4c3a-b071-f2ea0722b179/report-user">

                <div class="modal-body">

                    <!-- reason input field -->

                    <div class="form-group">

                        <label for="lwUserReportReason">Reason</label>

                        <textarea class="form-control" rows="3" id="lwUserReportReason" name="report_reason" required></textarea>

                    </div>

                    <!-- / reason input field -->

                </div>



                <!-- modal footer -->

                <div class="modal-footer mt-3">

                    <button class="btn btn-light btn-sm" id="lwCloseUserReportDialog">Cancel</button>

                    <button type="submit" class="btn btn-primary btn-sm lw-ajax-form-submit-action btn-user lw-btn-block-mobile">Report</button>

                </div>

            </form>

            <!-- modal footer -->

        </div>

    </div>

</div>

<!-- /user report Modal-->



<!-- send gift Modal-->

<div class="modal fade" id="lwSendGiftDialog" tabindex="-1" role="dialog" aria-labelledby="sendGiftModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-md" role="document">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title" id="sendGiftModalLabel">Send Gift <small class="text-muted">(Credits Available:  0)</small></h5>

                <button class="close" type="button" data-dismiss="modal" aria-label="Close">

                    <span aria-hidden="true">×</span>

                </button>

            </div>

            <!-- info message -->

            <div class="alert alert-info">

            There are no gifts                  </div>

            <!-- / info message -->

            <div>

                <div>

                </div>

                <!-- /send gift Modal-->

            </div>

        </div>

    </div>

    <!-- User block Confirmation text html -->

    <div id="lwBlockUserConfirmationText" style="display: none;">

        <h3>Are You Sure!</h3>

        <strong>You want to block this user.</strong>

    </div>

    <!-- /User block Confirmation text html -->



    <!-- Content for sidebar -->

    <!-- /if user block then don't show profile page content -->





    <!-- footer advertisement -->

    <div class="lw-ad-block-h90">

    </div>

    <!-- /footer advertisement -->

</div>

<!-- /.container-fluid -->

</div>

</div>

<!-- End of Content Wrapper -->

</div>

<!-- End of Page Wrapper -->



<div class="lw-cookie-policy-container row p-4" id="lwCookiePolicyContainer">

    <div class="col-sm-11">

    To help personalise content, tailor and measure adverts and provide a safer experience, we use cookies. By clicking on or navigating the site, you agree to allow us to collect information through cookies.        </div>

    <div class="col-sm-1 mt-2"><button id="lwCookiePolicyButton" class="btn btn-primary">OK</button></div>

</div>

<!-- include footer -->

















<!-- Footer -->

<footer>

  <div class="container">

    <div class="row">

      <div class="col-lg-1 col-md-1 col-sm-12">

          <a class="sidebar-brand d-flex align-items-center" href="home">

            <div class="sidebar-brand-icon">

                <img class="lw-logo-img" src="backend/media-storage/small_logo/images.png?ver=1644474798" alt="PPM-f">

            </div>

            <img width="40px" src="backend/media-storage/logo/logo.png?ver=1644819848" alt="PPM-user">

            <img class="lw-logo-img d-sm-block d-md-none" src="backend/media-storage/small_logo/images.png?ver=1644474798" alt="PP-u">

        </a>

    </div>

    <div class="col-lg-8 col-md-8 col-sm-12">

        <ul class="footer-menu">

            <li class="footer-item">

              <a class="footer-link" href="#">Company</a>

          </li>

          <li class="footer-item">

              <a class="footer-link" href="#">Career</a>

          </li>

          <li class="footer-item">

              <a class="footer-link" href="#">Press</a>

          </li>

          <li class="footer-item">

              <a class="footer-link" href="#">Contact</a>

          </li>

          <li class="footer-item">

              <a class="footer-link" href="#">Investors</a>

          </li>

      </ul>

  </div>

  <div class="col-lg-3 col-md-3 col-sm-12 icon-group ">

    <a class="navbar-brand" href="#"><i class="fa-brands fa-facebook"></i></a>

    <a class="navbar-brand" href="#"><i class="fa-brands fa-instagram-square"></i></a>

    <a class="navbar-brand" href="#"><i class="fa-brands fa-twitter-square"></i></a>

</div>

</div>

</div> 

</footer>

<!-- End of Footer -->











<!-- Messenger Dialog -->

<div class="modal fade" id="messengerDialog" tabindex="-1" role="dialog" aria-labelledby="messengerModalLabel"

aria-hidden="true">

<div class="modal-dialog modal-lg" role="document">

    <div class="modal-content">

        <div class="modal-header">

            <button id="lwChatSidebarToggle" class="btn btn-link d-md-none rounded-circle mr-3">

                <i class="fa fa-bars"></i>

            </button>

            <h5 class="modal-title">Chat</h5>

            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span

                aria-hidden="true">&times;</span></button>

            </div>

            <div class="modal-body">

                <div id="lwChatDialogLoader" style="display: none;">

                    <div class="d-flex justify-content-center m-5">

                        <div class="spinner-border" role="status">

                            <span class="sr-only">Loading...</span>

                        </div>

                    </div>

                </div>

                <div id="lwMessengerContent"></div>

            </div>

        </div>

    </div>

</div>

<!-- Messenger Dialog -->

<!-- <img src="backend/imgs/ajax-loader.gif" style="height:1px;width:1px;"> -->

<script>

    window.appConfig = {

        debug: "1",

        csrf_token: "084nj6Z3jpjt5RuwAVY0DUVJKvqh18Cg3h2LK4RU"

    }

</script>



<script type="text/javascript" src="backend/dist/pusher-js/pusher.min.js?VER=65207e5766e5ebc30a37454161bb3af3"></script>

<script type="text/javascript" src="backend/dist/js/vendorlibs-public.js?VER=2d3138ad6aedf2a3fb1232af0bca7487"></script>

<script type="text/javascript" src="backend/dist/js/vendorlibs-datatable.js?VER=ee7db8971629f93eb6ba0ab352fdd702"></script>

<script type="text/javascript" src="backend/dist/js/vendorlibs-photoswipe.js?VER=ef73f977d9144b7d546053b323579475"></script>

<script type="text/javascript" src="backend/dist/js/vendorlibs-smartwizard.js?VER=805e501085d0937779a0589b0deef3ba"></script>

<script>

    (function () {

        $.validator.messages = $.extend({}, $.validator.messages, {

            required: 'This field is required.',

            remote: 'Please fix this field.',

            email: 'Please enter a valid email address.',

            url: 'Please enter a valid URL.',

            date: 'Please enter a valid date.',

            dateISO: 'Please enter a valid date (ISO).',

            number: 'Please enter a valid number.',

            digits: 'Please enter only digits.',

            equalTo: 'Please enter the same value again.',

            maxlength: $.validator.format('Please enter no more than {0} characters.'),

            minlength: $.validator.format('Please enter at least {0} characters.'),

            rangelength: $.validator.format('Please enter a value between {0} and {1} characters long.'),

            range: $.validator.format('Please enter a value between {0} and {1}.'),

            max: $.validator.format('Please enter a value less than or equal to {0}.'),

            min: $.validator.format('Please enter a value greater than or equal to {0}.'),

            step: $.validator.format('Please enter a multiple of {0}.')

        });

    })();

</script>

<script type="text/javascript" src="backend/dist/js/common-app.min.js?VER=e1fe1886e452bb2b09610cbe3909373a"></script>

<script>

    __Utils.setTranslation({

        'processing': "processing",

        'uploader_default_text': "<span class='filepond--label-action'>Drag &amp; Drop Files or Browse</span>",

        'gif_no_result': "Result Not Found",

        "message_is_required": "Message is required",

        "sticker_name_label": "Stickers"

    });



    var userLoggedIn = '1',

    enablePusher = '';



    if (userLoggedIn && enablePusher) {

        var userUid = '50ee1967-7341-4c3a-b071-f2ea0722b179',

        pusherAppKey = '',

        __pusherAppOptions = {

            cluster: 'ap2',

            forceTLS: true,

        };



    }

</script>

<!-- Include Audio Video Call Component -->

<!-- /Calling Dialog -->

<div class="modal fade" id="lwAudioCallDialog" tabindex="-1" role="dialog"

aria-labelledby="audioCallModalLabel" aria-hidden="true">

<div class="modal-dialog modal-sm" role="document">

    <div class="modal-content">

        <div id="lwReceiveCallContent" class="modal-body text-center"></div>

        <script type="text/_template" id="lwAudioCallTemplate"

        data-replace-target="#lwReceiveCallContent" data-modal-event="shown"

        data-modal-id="#lwAudioCallDialog">

        <h5 class="modal-title text-center pt-3 pb-3 text-muted small" id="audioCallModalLabel"><%- __tData.callType %></h5>



        <h4><%- __tData.responseData.userFullName %> </h4>



        <!-- Call Status -->

        <div id="lwCallerCallingStatus" data-model="callerCallStatus"><%- __tData.callStatus %></div>

        <!-- /Call Status -->

        <br>

        <!-- disconnect call button -->

        <button class="btn btn-danger rounded-circle" data-show-if="callerDisConnectCallBtn" id="lwCallerDisConnectCallBtn" data-response-data="<%- JSON.stringify(__tData.responseData) %>"><i class="fas fa-phone-slash"></i></button>

        <!-- /disconnect call button -->



        <!-- close call button -->

        <button class="btn btn-light" style="display: none" data-show-if="callerCloseCallBtn" id="lwCallerCloseCallBtn" type="button" data-dismiss="modal" aria-label="Close">Close</button>

        <!-- /close call button -->



    </script>

</div>

</div>

</div>

<!-- /Calling Dialog -->



<!-- inComing Call Dialog -->

<div class="modal fade" id="lwIncomingCallDialog" tabindex="-1" role="dialog"

aria-labelledby="lwIncomingCallModalLabel" aria-hidden="true">

<div class="modal-dialog modal-sm" role="document">

    <div class="modal-content">

        <div id="lwIncomingCallContent" class="modal-body text-center"></div>

        <script type="text/_template" id="lwIncomingCallTemplate"

        data-replace-target="#lwIncomingCallContent" data-modal-event="shown"

        data-modal-id="#lwIncomingCallDialog">

        <h5 class="modal-title text-center pt-3 pb-3 text-muted small" id="lwIncomingCallModalLabel"><%- __tData.callType %></h5>

        <h4><%- __tData.callerName %> </h4>

        <div class="lw-phone-call-container">

            <div class="lw-phone-call lw-phone-call-1"></div>

            <div class="lw-phone-call lw-phone-call-2"></div>

            <div class="lw-phone-call lw-phone-call-3"></div>

            <div class="lw-phone-call lw-phone-call-4"></div>  

        </div>

        <br>

        <!-- Receiver Call Status -->

        <div id="lwReceiverCallingStatus" data-model="receiverCallStatus"><%- __tData.callStatus %></div>

        <!-- /Receiver Call Status -->

        <br><br>

        <!-- accept call button -->

        <button class="btn btn-secondary" id="lwAcceptCall" data-response-data="<%- JSON.stringify(__tData.responseData) %>" data-show-if="receiverAcceptCallBtn"><i class="fas fa-phone-volume"></i> Accept</button>

        <!-- /accept call button -->



        <!-- disconnect call button -->

        <button class="btn btn-danger" id="lwReceiverDisConnectCallBtn" data-response-data="<%- JSON.stringify(__tData.responseData) %>" data-show-if="receiverDisconnectCallBtn"><i class="fas fa-phone-slash"></i> Reject</button>

        <!-- /disconnect call button -->



        <!-- close call button -->

        <button class="btn btn-light" style="display: none" data-show-if="receiverCloseCallBtn" id="lwReceiverCloseCallBtn" type="button" data-dismiss="modal" aria-label="Close">Close</button>

        <!-- /close call button -->



    </script>

</div>

</div>

</div>

<!-- /inComing Call Dialog -->



<!-- caller ringtone -->

<audio id="lwCallRingtone" loop>

    <source src="backend/imgs/audio/caller-ringtone.mp3" type="audio/mpeg">

    </audio>

    <!-- /caller ringtone -->



    <!-- receiver ringtone -->

    <audio id="lwReveiverRingtone" loop>

        <source src="backend/imgs/audio/receiver-ringtone.mp3" type="audio/mpeg">

        </audio>

        <!-- /receiver ringtone -->



        <!-- append audio video data -->

        <div class="video-grid" id="video">

            <div class="video-view">

                <div id="local_stream" class="video-placeholder"></div>

                <div id="local_video_info" class="video-profile hide"></div>

                <div id="video_autoplay_local" class="autoplay-fallback hide"></div>

            </div>

        </div>

        <!-- /append audio video data -->



        <!-- User Soft delete Container -->

        <div id="lwCallErrorContainer" style="display: none;">

            <h3>Error!</h3>

            <strong>May be your browser not support Audio/Video Calling. We recommend you to use another browser.</strong>

        </div>

        <!-- User Soft delete Container -->



        <!-- /include footer -->



        <!-- Scroll to Top Button-->

        <a class="scroll-to-top rounded" href="#page-top">

            <i class="fas fa-angle-up"></i>

        </a>

        <!-- /Scroll to Top Button-->



        <!-- Logout Modal-->

        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"

        aria-hidden="true">

        <div class="modal-dialog" role="document">

            <div class="modal-content">

                <div class="modal-header">

                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>

                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">

                        <span aria-hidden="true">×</span>

                    </button>

                </div>

                <div class="modal-body">

                Select &quot;Logout&quot; below if you are ready to end your current session.                </div>

                <div class="modal-footer">

                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Not now</button>

                    <a class="btn btn-primary" href="user/logout">Logout</a>

                </div>

            </div>

        </div>

    </div>

    <!-- /Logout Modal-->

    <script type="text/javascript">
        $(document).ready(
            function(){
                $(".event-filter").hide();
                $(".event-filter-button").click(function () {
                    $(".event-filter").show("slow");
                });
                $("#filterSidebarClose").click(function () {
                    $(".event-filter").hide("slow");
                });
            });
        </script>
        <script>
            $(document).ready(function() {
          //toggle the component with class accordion_body
          $(".accordion_head").click(function() {
              $(this).toggleClass("active");
            if ($('.accordion_body').is(':visible')) {
              $(".accordion_body").slideUp(300);
              $(".plusminus").text('+');
            }
            if ($(this).next(".accordion_body").is(':visible')) {
              $(this).next(".accordion_body").slideUp(300);
              $(this).children(".plusminus").text('+');
            } else {
              $(this).next(".accordion_body").slideDown(300);
              $(this).children(".plusminus").text('-');
            }
          });
        });

        </script>

    </body>

    </html>