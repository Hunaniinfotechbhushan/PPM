<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LinkedinSocialiteController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*
|--------------------------------------------------------------------------
| Lw-Dating Routes 
|--------------------------------------------------------------------------
*/


Route::get('/clear', function() {

    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('config:cache');
    Artisan::call('view:clear');
    Artisan::call('route:clear');

    return "Cleared!";
});


Route::group(['middleware' => 'admin','middleware' => 'auth','prefix' => 'admin'], function(){

    Route::get('/', [App\Http\Controllers\backend\AdminController::class, 'index'])->name('admin');

    Route::resource('new-signup', backend\NewSignUpController::class);
    Route::resource('media', backend\MediaController::class);
    Route::get('/reject/photto/{id}', [App\Http\Controllers\backend\MediaController::class, 'photto_reject_request']);
    Route::get('/approve/photto/{id}', [App\Http\Controllers\backend\MediaController::class, 'photto_approve_request']);
    // Users
    Route::resource('users', backend\UserController::class);
    Route::get('delete-user/{id}', [App\Http\Controllers\backend\UserController::class, 'delete_user']);
    Route::get('temporary-suspend/{id}', [App\Http\Controllers\backend\UserController::class, 'temporary_suspend']);
     Route::get('/user/temporary-disable/{id}', [App\Http\Controllers\backend\UserController::class, 'temporary_disable']);
// Team
    Route::resource('team', backend\TeamController::class);
    Route::get('/team/activate/{id}', [App\Http\Controllers\backend\TeamController::class, 'team_activate']);
    Route::get('/team/freeze/{id}', [App\Http\Controllers\backend\TeamController::class, 'team_freeze']);
    Route::get('/team/deleted/{id}', [App\Http\Controllers\backend\TeamController::class, 'team_deleted']);

              // Temp Block Account
    Route::resource('temp-block-users', backend\TempBlockUserController::class);
    Route::get('/temp-user/activate/{id}', [App\Http\Controllers\backend\TempBlockUserController::class, 'temp_user_activate']);
    Route::get('temp-user/delete/{id}', [App\Http\Controllers\backend\UserController::class, 'delete_user']);

// Deleted Profile
    Route::resource('deleted-profiles', backend\DeletedProfileController::class);
    Route::get('remove-from-system/{id}', [App\Http\Controllers\backend\DeletedProfileController::class, 'remove_from_system']);
    Route::get('reinstate/{id}', [App\Http\Controllers\backend\DeletedProfileController::class, 'reinstate']);

// Description
    Route::resource('description', backend\DescriptionController::class);
    // Description
    Route::resource('disable-profile', backend\DisableProfileController::class);
// Verification
    Route::resource('verifications-video', backend\VerificationsVideo::class);
    Route::get('/approve/verifications-video/{id}', [App\Http\Controllers\backend\VerificationsVideo::class, 'video_approve_request']);
    Route::post('/reject/verifications-video', [App\Http\Controllers\backend\VerificationsVideo::class, 'video_reject_request']);
    Route::post('/user-verifications-video', [App\Http\Controllers\backend\VerificationsVideo::class, 'user_verifications_video_upload']);


// Social Verification
    Route::resource('verifications-social-media', backend\VerificationsSocialMedia::class);
    Route::get('/approve/verifications-linkedin/{id}', [App\Http\Controllers\backend\VerificationsSocialMedia::class, 'linkedin_approve_request']);
    Route::get('/approve/verifications-facebook/{id}', [App\Http\Controllers\backend\VerificationsSocialMedia::class, 'facebook_approve_request']);
    Route::get('/approve/verifications-instagram/{id}', [App\Http\Controllers\backend\VerificationsSocialMedia::class, 'instagram_approve_request']);

    // Event Verification
    Route::resource('events', backend\EventsController::class);

    Route::get('update-events', [App\Http\Controllers\backend\EventsController::class, 'updateEvent']);
    Route::get('update-events-edit/{id}', [App\Http\Controllers\backend\EventsController::class, 'editUpdateEvent']);
    Route::post('events/updates/{id}', [App\Http\Controllers\backend\EventsController::class, 'updateEventEditUpdate']);

    Route::resource('rejected-events', backend\RejectedEventsController::class);
    Route::get('event/reinstate/{id}', [App\Http\Controllers\backend\RejectedEventsController::class, 'reinstate']);
    Route::get('event/remove-from-system/{id}', [App\Http\Controllers\backend\RejectedEventsController::class, 'remove_from_system']);
          // Report

    Route::resource('reports', backend\ReportsController::class);
    Route::post('/report/warn-user', [App\Http\Controllers\backend\ReportsController::class, 'user_warn_request']);
    Route::get('report/delete/{id}', [App\Http\Controllers\backend\ReportsController::class, 'delete_user']);
    Route::get('report/no-action/{id}', [App\Http\Controllers\backend\ReportsController::class, 'no_action']);
    Route::get('report/delete-action/{id}', [App\Http\Controllers\backend\ReportsController::class, 'delete_action']);

// Warned User
    Route::resource('warned-users', backend\WarnedUserController::class);
      Route::get('warned-user/delete/{id}', [App\Http\Controllers\backend\WarnedUserController::class, 'delete_user']);
      Route::get('warned-user/remove/{id}', [App\Http\Controllers\backend\WarnedUserController::class, 'remove_warm_user']);

    Route::post('/reject/verifications-social', [App\Http\Controllers\backend\VerificationsSocialMedia::class, 'social_reject_request']);
    Route::post('change-password', [App\Http\Controllers\backend\ProfileController::class, 'changePassword'])->name('change-password');
    Route::resource('profile', backend\ProfileController::class);

    // Rejected Profile
    Route::resource('user-rejected-profile', backend\UserRejectedProfileController::class);
     Route::get('user-rejected-profile/reinstate/{id}', [App\Http\Controllers\backend\UserRejectedProfileController::class, 'reinstate']);

});




Route::get('mail', function () {  
    $details = [
        'title' => 'Welcome',
        'body' => 'This is for testing email using smtp'
    ];   
    \Mail::to('webtest41@gmail.com')->send(new \App\Mail\MyTestMail($details));
    dd("Email is Sent.");
});
// Linkedin Connect
Route::get('auth/linkedin', [App\Exp\Components\User\Controllers\UserController::class, 'redirectToLinkedin']);
Route::get('callback/linkedin', [App\Exp\Components\User\Controllers\UserController::class, 'handleCallback']);
// Instagram Connect
Route::get('instagram', [App\Exp\Components\User\Controllers\UserController::class, 'redirectToInstagramProvider']);
Route::get('instagram/callback', [App\Exp\Components\User\Controllers\UserController::class, 'instagramProviderCallback']);

Route::get('terms', [App\Exp\Components\User\Controllers\UserController::class, 'term']);

Route::get('policy', [App\Exp\Components\User\Controllers\UserController::class, 'policy']);
    // // verify account
Route::get('account-verify', [App\Exp\Components\User\Controllers\UserController::class, 'verify_account']);
Route::post('notification-read-request', [App\Exp\Components\Notification\Controllers\NotificationController::class, 'notificationRead']);
Route::post('messager-user-activity', [App\Exp\Components\Messenger\Controllers\MessengerController::class, 'messagerUserActivity']);
Route::post('message-user-action', [App\Exp\Components\Messenger\Controllers\MessengerController::class, 'message_user_action']);


Route::group([
    'namespace' => '\App\Exp\Components',
], function () {

 Route::group(['middleware' => 'auth'], function () {
        // Event view
    Route::get('/updates', [
        'as' => 'updates.read.events',
        'uses' => 'Updates\Controllers\UpdatesController@index'
    ]);

        // Event view
    Route::get('/events', [
        'as' => 'user.read.events',
        'uses' => 'Event\Controllers\EventController@index'
    ]);

    Route::get('/events-views', [
        'uses' => 'Event\Controllers\EventController@viewEvents'
    ]);

    Route::get('/events-edit/{id}', [
        'uses' => 'Event\Controllers\EventController@viewsEventsedit'
    ]);

    Route::any('/events-update', [
        'uses' => 'Event\Controllers\EventController@viewsEventsupdate'
    ]);

    Route::any('/events-delete/{id}', [
        'uses' => 'Event\Controllers\EventController@viewsEventsdelete'
    ]);

    Route::any('/event-view', [
        'as' => 'user.view.events',
        'uses' => 'Event\Controllers\EventController@viewEvent'
    ]);

    Route::any('/event-add', [
        'as' => 'user.add.events',
        'uses' => 'Event\Controllers\EventController@addEvent'
    ]);

    /* interested */
    Route::any('/interested-user', [
        'as' => 'user.interested.events',
        'uses' => 'Event\Controllers\EventController@interestedUser'
    ]);

 // User Like Dislike route
    Route::post('/{toUserUid}/{like}/event-like-dislike', [
        'as' => 'event.write.like_dislike',
        'uses' => 'Event\Controllers\EventController@userLikeDislike'
    ]);
    
    
    Route::get('/change-language/{localeID}', [
        'as' => 'locale.change',
        'uses' => 'Home\Controllers\HomeController@changeLocale',
    ]);
    
    // contact view
    Route::get('/contact', [
        'as' => 'user.read.contact',
        'uses' => 'User\Controllers\UserController@getContactView'
    ]);
    
    // process contact form
    Route::post('/post-contact', [
        'as' => 'user.contact.process',
        'uses' => 'User\Controllers\UserController@contactProcess',
    ]);

    // page preview
    Route::get('/page/{pageUId}/{title}', [
        'as' => 'page.preview',
        'uses' => 'Home\Controllers\HomeController@previewPage',
    ]);

    Route::post('/updates-select-option', [
        'as' => 'updates.read.events',
        'uses' => 'Updates\Controllers\UpdatesController@update_select_option'
    ]);
});

 Route::group([
    'namespace' => 'Home\Controllers'
], function () {
            // Get landing page view
    Route::get('/', [
        'as' => 'landing_page',
        'uses' => 'HomeController@landingPage'
    ]);
            // Process search from landing page
    Route::post('/search-matches', [
        'as' => 'search_matches',
        'uses' => 'HomeController@searchMatches'
    ]);
    });            // User Messenger related routes
 Route::group([
    'namespace' => 'Messenger\Controllers',
    'prefix' => 'messenger'
], function () {
                // Get All Conversation
    // Route::get('/', [
    //     'as' => 'user.read.messenger',
    //     'uses' => 'MessengerController@show',
    // ]);
                // Get All Conversation
    Route::get('/', [
        'as' => 'user.read.all_conversation',
        'uses' => 'MessengerController@getAllConversation',
    ]);


 // get all chat
    Route::post('chat/get-conversation', [
        'as' => 'user.getMessage',
        'uses' => 'MessengerController@getUserConversation',
    ]);

// Send chat message
    Route::post('chat/send-conversation', [
        'as' => 'user.sendMessage',
        'uses' => 'MessengerController@sendChatMessage',
    ]);


                // Get Specific Conversation 
    Route::get('/{specificUserId}/individual-conversation', [
        'as' => 'user.read.individual_conversation',
        'uses' => 'MessengerController@getIndividualConversation',
    ]);
                // Get Conversation List
    Route::get('/{userId}/user-conversation', [
        'as' => 'user.read.user_conversation',
        'uses' => 'MessengerController@getUserConversation',
    ]);
                // Send message
    Route::post('/{userId}/process-send-message-profile', [
        'as' => 'user.write.send_message_profile',
        'uses' => 'MessengerController@sendMessageOnProfile',
    ]);

    Route::post('/{userId}/process-send-message', [
        'as' => 'user.write.send_message',
        'uses' => 'MessengerController@sendMessage',
    ]);
                // Accept / Decline Message request
    Route::post('/{userId}/process-accept-decline-message-request', [
        'as' => 'user.write.accept_decline_message_request',
        'uses' => 'MessengerController@acceptDeclineMessageRequest',
    ]);
                // Delete Single Chat
    Route::post('/{chatId}/{userId}/delete-message', [
        'as' => 'user.write.delete_message',
        'uses' => 'MessengerController@deleteMessage',
    ]);
                // Get Call Token Data
    Route::post('/{userUId}/{type}/call-initialize', [
        'as' => 'user.write.caller.call_initialize',
        'uses' => 'MessengerController@callerCallInitialize',
    ]);
                // Get Call Token Data
    Route::post('/join-call', [
        'as' => 'user.write.receiver.join_call',
        'uses' => 'MessengerController@receiverJoinCallRequest',
    ]);
                // Caller Call Reject
    Route::get('/{receiverUserUid}/caller-reject-call', [
        'as' => 'user.write.caller.reject_call',
        'uses' => 'MessengerController@callerRejectCall',
    ]);
                // Receiver Call Reject
    Route::get('/{callerUserUid}/receiver-reject-call', [
        'as' => 'user.write.receiver.reject_call',
        'uses' => 'MessengerController@receiverRejectCall',
    ]);
                // Caller call errors
    Route::get('/{receiverUserUid}/caller-errors', [
        'as' => 'user.write.caller.error',
        'uses' => 'MessengerController@callerCallErrors',
    ]);
                // Receiver call errors
    Route::get('/{callerUserUid}/receiver-errors', [
        'as' => 'user.write.receiver.error',
        'uses' => 'MessengerController@receiverCallErrors',
    ]);
                // Receiver call accept
    Route::post('/{receiverUserUid}/receiver-call-accept', [
        'as' => 'user.write.receiver.call_accept',
        'uses' => 'MessengerController@receiverCallAccept',
    ]);
                // Receiver call errors
    Route::get('/{callerUserUid}/receiver-busy-call', [
        'as' => 'user.write.receiver.call_busy',
        'uses' => 'MessengerController@receiverCallBusy',
    ]);
                // Delete all chat conversation 
    Route::post('/{userId}/delete-all-message', [
        'as' => 'user.write.delete_all_messages',
        'uses' => 'MessengerController@deleteAllMessages',
    ]);
                // Get Stickers
    Route::get('/get-stickers', [
        'as' => 'user.read.get_stickers',
        'uses' => 'MessengerController@getStickers',
    ]);
                // Buy Sticker
    Route::post('/process-buy-sticker', [
        'as' => 'user.write.buy_stickers',
        'uses' => 'MessengerController@buySticker',
    ]);
});


    /*
    User Components Public Section Related Routes
    ----------------------------------------------------------------------- */
    Route::group(['middleware' => 'guest'], function () {

        Route::group([
            'namespace' => 'User\Controllers',
            'prefix' => 'user',
        ], function () {
            // login
            Route::get('/login', [
                'as' => 'user.login',
                'uses' => 'UserController@login',
            ]);
            
            // login process
            Route::post('/login-process', [
                'as' => 'user.login.process',
                'uses' => 'UserController@loginProcess',
            ]);

            Route::post('do-login', [
                'as' => 'user.do.login',
                'uses' => 'UserController@doLogin',
            ]);
            
            // User Registration
            Route::get('/sign-up', [
                'as' => 'user.sign_up',
                'uses' => 'UserController@signUp',
            ]);
            
            // User Registration Process
            Route::post('/sign-up-process', [
                'as' => 'user.sign_up.process',
                'uses' => 'UserController@signUpProcess'
            ]);

            // forgot password view
            Route::get('/forgot-password', [
                'as' => 'user.forgot_password',
                'uses' => 'UserController@forgotPasswordView',
            ]);

            // forgot password process
            Route::post('/forgot-password-process', [
                'as' => 'user.forgot_password.process',
                'uses' => 'UserController@processForgotPassword',
            ]);

            // reset password
            Route::get('/reset-password', [
                'as' => 'user.reset_password',
                'uses' => 'UserController@restPasswordView',
            ]);

            // reset password process
            Route::post('/reset-password-process/{reminderToken}', [
                'as' => 'user.reset_password.process',
                'uses' => 'UserController@processRestPassword',
            ]);
            
            // Account Activation
            Route::get('/{userUid}/account-activation', [
                'as' => 'user.account.activation',
                'uses' => 'UserController@accountActivation',
            ])->middleware('signed');




        });
    });
    
    /*
    User Social Access Components Public Section Related Routes
    ----------------------------------------------------------------------- */
    Route::group([
        'namespace' => 'User\Controllers',
        'prefix'    => 'user/social-login',
    ], function () {

        // social user login
        Route::get('/request/{provider}', [
            'as'   => 'social.user.login',
            'uses' => 'SocialAccessController@redirectToProvider',
        ]);

        // social user login callback
        Route::get('/response/{provider}', [
            'as'   => 'social.user.login.callback',
            'uses' => 'SocialAccessController@handleProviderCallback',
        ]);
    });

    /*
    After Authentication Accessible Routes
    -------------------------------------------------------------------------- */

     // post report user
    Route::post('/report-user', [
        'as' => 'member.write.report_user',
        'uses' => 'Member\Controllers\MemberController@reportUser'
    ]);

    Route::any('/image-approver', [
        'uses' => 'Member\Controllers\MemberController@imageApprover'
    ]);

    Route::any('/image-approver-update', [
        'uses' => 'Member\Controllers\MemberController@updateImageApprover'
    ]);

    Route::group(['middleware' => 'auth'], function () {


            // username suggest request
        Route::post('/username-suggest', [
            'uses' => 'User\Controllers\UserController@username_suggest'
        ]);


             // username check is exits 
        Route::post('/username-exists', [
            'uses' => 'User\Controllers\UserController@username_exists'
        ]);


        // Home page for logged in user
        // Route::get('/home', [
        //     'as' => 'home_page',
        //     'uses' => 'Home\Controllers\HomeController@index',
        // ]);

        Route::post('/upload-user-story', [
            'as' => 'story_page',
            'uses' => 'Story\Controllers\StoryController@uploadStory',
        ]);



        Route::post('/get-user-notify-image', [
            'as' => 'story_page',
            'uses' => 'Story\Controllers\StoryController@get_user_notify_image',
        ]);



            // Home page for logged in user
        Route::get('/home', [
            'as' => 'activity_page',
            'uses' => 'Activity\Controllers\ActivityController@index',
        ]);


             // Skip Profile steps
        Route::get('/skip-user-profile', [
            'as' => 'user.skip_user_profile',
            'uses' => 'User\Controllers\UserController@userProfileSkip',
        ]);
        
          // post book -mark
        Route::any('/bookmarks-user', [

          'as' => 'bookmarks.write.book_mark',
          'uses' => 'Bookmarks\Controllers\BookmarksController@book_marks'
      ]);

        
        // Get User Profile view
        Route::get('/@{username}', [
            'as' => 'user.profile_view',
            'uses' => 'User\Controllers\UserController@getUserProfile'
        ]);

         // Get User Profile view
        Route::get('/member/{id}', [
            'as' => 'member.profile_view',
            'uses' => 'Member\Controllers\MemberController@getUserProfile'
        ]);
        
        // Get user profile data
        Route::get('/{username}/get-user-profile-data', [
            'as' => 'user.get_profile_data',
            'uses' => 'User\Controllers\UserController@getUserProfileData'
        ]);
        // View photos settings
        Route::get('/@{username}/photos', [
            'as' => 'user.photos_setting',
            'uses' => 'UserSetting\Controllers\UserSettingController@getUserPhotosSetting',
        ]);

              // Get User Profile view
        Route::get('/settings', [
           'as' => 'user.settings',
           'uses' => 'UserSetting\Controllers\UserSettingController@userSetting',
       ]);

        /*
        Filter Components Public Section Related Routes
        ----------------------------------------------------------------------- */
        Route::group([
            'namespace' => 'Filter\Controllers',
        ], function () {
            // Show Find Matches View
            Route::get('/search', [
                'as' => 'user.read.search',
                'uses' => 'FilterController@getFindMatches',
            ]);

            Route::post('/save-serach', [
                'as' => 'save_serach',
                'uses' => 'FilterController@save_serach',
            ]);

            Route::post('/delete-save-serach', [
                'as' => 'delete_save_serach',
                'uses' => 'FilterController@delete_save_serach',
            ]);

            //         Route::get('/short-by', [
            //     'as' => 'user.read.short',
            //     'uses' => 'FilterController@getShortBy',
            // ]);
        });

        /*
         * User Section 
        ----------------------------------------------------------------------- */
        Route::group([
            'prefix' => 'user'
        ], function() {
            /*
            User Component Related Routes
            ----------------------------------------------------------------------- */
            Route::group([
                'namespace' => 'User\Controllers'
            ], function () {

                // Get user profile data
                Route::get('/update-profile-wizard', [
                    'as' => 'user.update_profile.wizard',
                    'uses' => 'UserController@loadProfileUpdateWizard'
                ]);

                // Get user profile data
                Route::get('/check-profile-updated', [
                    'as' => 'user.profile.wizard_completed',
                    'uses' => 'UserController@checkProfileUpdateWizard'
                ]);

                // Get user profile data
                Route::post('/finish-wizard', [
                    'uses' => 'UserController@finishWizard'
                ]);

                // logout
                Route::get('/logout', [
                    'as' => 'user.logout',
                    'uses' => 'UserController@logout',
                ]);
                
                // change password view
                Route::get('/change-password', [
                    'as' => 'user.change_password',
                    'uses' => 'UserController@changePasswordView',
                ]);
                
                // User Change Password Process
                Route::post('/change-password-process', [
                    'as' => 'user.change_password.process',
                    'uses' => 'UserController@processChangePassword'
                ]);

                // change email view
                Route::get('/change-email', [
                    'as' => 'user.change_email',
                    'uses' => 'UserController@changeEmailView',
                ]);
                
                // User Change Email Process
                Route::post('/change-email-process', [
                    'as' => 'user.change_email.process',
                    'uses' => 'UserController@processChangeEmail'
                ]);
                
                // New Email Activation
                Route::get('/{userUid}/{newEmail}/new-email-activation', [
                    'as' => 'user.new_email.activation',
                    'uses' => 'UserController@newEmailActivation',
                ]);

                // Get User Profile view
                Route::get('/update-email-success', [
                    'as' => 'user.new_email.read.success',
                    'uses' => 'UserController@updateEmailSuccessView'
                ]);
                
                // User Like Dislike route
                Route::post('/{toUserUid}/{like}/user-like-dislike', [
                    'as' => 'user.write.like_dislike',
                    'uses' => 'UserController@userLikeDislike'
                ]);
                
                // Get User My like view
                Route::get('/liked', [
                    'as' => 'user.my_liked_view',
                    'uses' => 'UserController@getMyLikeView'
                ]);

                // Get User My Dislike view
                Route::get('/disliked', [
                    'as' => 'user.my_disliked_view',
                    'uses' => 'UserController@getMyDislikedView'
                ]);

                // Get who liked me users
                Route::get('/who-liked-me', [
                    'as' => 'user.who_liked_me_view',
                    'uses' => 'UserController@getWhoLikedMeView'
                ]);

                // Get mutual likes users
                Route::get('/mutual-likes', [
                    'as' => 'user.mutual_like_view',
                    'uses' => 'UserController@getMutualLikeView'
                ]);

                // Get profile visitors users
                Route::get('/visitors', [
                    'as' => 'user.profile_visitors_view',
                    'uses' => 'UserController@getProfileVisitorView'
                ]);

                // post User send gift
                Route::post('/{sendUserUId}/send-gift', [
                    'as' => 'user.write.send_gift',
                    'uses' => 'UserController@userSendGift'
                ]);



                // post User send gift
                Route::post('/block-user', [
                    'as' => 'user.write.block_user',
                    'uses' => 'UserController@blockUser'
                ]);

                // block user list
                Route::get('/blocked-users', [
                    'as' => 'user.read.block_user_list',
                    'uses' => 'UserController@blockUserList'
                ]);

                // post un-block user
                Route::post('/{userUid}/unblock-user', [
                    'as' => 'user.write.unblock_user',
                    'uses' => 'UserController@processUnblockUser'
                ]);

                // post un-block user
                Route::post('/boost-profile', [
                    'as' => 'user.write.boost_profile',
                    'uses' => 'UserController@processBoostProfile'
                ]);

                // block user list
                Route::get('/get-booster-info', [
                    'as' => 'user.read.booster_data',
                    'uses' => 'UserController@getBoosterInfo'
                ]);




                
                // Permanent delete account
                Route::post('/delete-account', [
                    'as' => 'user.write.delete_account',
                    'uses' => 'UserController@deleteAccount'
                ]);
            });

            // User Settings related routes
Route::group([
    'namespace' => 'UserSetting\Controllers',
    'prefix' => 'settings'
], function () {
                // View settings
    Route::get('/{pageType}', [
        'as' => 'user.read.setting',
        'uses' => 'UserSettingController@getUserSettingView',
    ]);
                 // Process Configuration Data
    Route::post('/{pageType}/process-user-setting-store', [
        'as' => 'user.write.setting',
        'uses' => 'UserSettingController@processStoreUserSetting',
    ]);
                // Process basic settings
    Route::post('/process-basic-settings', [
        'as' => 'user.write.basic_setting',
        'uses' => 'UserSettingController@processUserBasicSetting',
    ]);

    Route::post('/user-email-update', [
        'as' => 'user.write.email_update',
        'uses' => 'UserSettingController@userEmailUpdateRequest',
    ]);

                // Process basic settings
    Route::post('/process-update-profile-wizard', [
        'as' => 'user.write.update_profile_wizard',
        'uses' => 'UserSettingController@profileUpdateWizard',
    ]);

                // Process location / maps data
    Route::post('/process-location-data', [
        'as' => 'user.write.location_data',
        'uses' => 'UserSettingController@processLocationData',
    ]);
                // Store User Profile Image
    Route::post('/upload-profile-image', [
        'as' => 'user.upload_profile_image',
        'uses' => 'UserSettingController@uploadProfileImage'
    ]);
                // Store User Cover Image
    Route::post('/upload-cover-image', [
        'as' => 'user.upload_cover_image',
        'uses' => 'UserSettingController@uploadCoverImage'
    ]);
                // Process User Profile 
    Route::post('/process-profile-setting', [
        'as' => 'user.write.profile_setting',
        'uses' => 'UserSettingController@processUserProfileSetting',
    ]);

                //delete

                  // Upload multiple hotos
    Route::post('/profile-photos-delete', [
        'as' => 'user.delete_profile_photos',
        'uses' => 'UserSettingController@deletePhotos'
    ]);
               // move
    Route::post('/profile-photos-move', [
        'as' => 'user.move_profile_photos',
        'uses' => 'UserSettingController@movePhotos'
    ]);

                 // move public
    Route::post('/profile-photos-move-public', [
        'as' => 'user.move_profile_photos_public',
        'uses' => 'UserSettingController@movePhotosPublic'
    ]);


                  // set Profile
    Route::post('/profile-photos-set', [
        'as' => 'user.update_profile_photo',
        'uses' => 'UserSettingController@updateProfilePoto'
    ]);
                // Upload multiple hotos
    Route::post('/upload-photos', [
        'as' => 'user.upload_photos',
        'uses' => 'UserSettingController@uploadPhotos'
    ]);

                     // Upload multiple hotos
    Route::post('/upload-user-photo', [
        'as' => 'user.upload_user_photo',
        'uses' => 'UserSettingController@uploadUserPhoto'
    ]);
});


            // User Notification related routes
Route::group([
    'namespace' => 'Notification\Controllers',
    'prefix' => 'notifications'
], function () {
                // Get mutual likes users
    Route::get('/', [
        'as' => 'user.notification.read.view',
        'uses' => 'NotificationController@getNotificationView'
    ]);

                 // Get mutual likes users
    Route::get('/notification-list', [
        'as' => 'user.notification.read.list',
        'uses' => 'NotificationController@getNotificationList'
    ]);

                // Post Read All Notification
    Route::post('/read-all-notification', [
        'as' => 'user.notification.write.read_all_notification',
        'uses' => 'NotificationController@readAllNotification'
    ]);
});

            // User Encounter related routes
Route::group([
    'namespace' => 'User\Controllers',
    'prefix' => 'encounters'
], function () {
                // Get users encounter view
    Route::get('/', [
        'as' => 'user.read.encounter.view',
        'uses' => 'UserEncounterController@getUserEncounterView'
    ]);

                // User Like Dislike route
    Route::post('/{toUserUid}/{like}/user-encounter-like-dislike', [
        'as' => 'user.write.encounter.like_dislike',
        'uses' => 'UserEncounterController@userEncounterLikeDislike'
    ]);

                // Skip Encounter User
    Route::post('/{toUserUid}/skip-encounter-user', [
        'as' => 'user.write.encounter.skip_user',
        'uses' => 'UserEncounterController@skipEncounterUser'
    ]);
});

             /*
            Manage Premium Plan User Components Public Section Related Routes
            ----------------------------------------------------------------------- */
            Route::group([
                'namespace' => 'User\Controllers',
                'prefix' => 'premium',
            ], function () {
                // User Premium Plan View
                Route::get('/', [
                    'as' => 'user.premium_plan.read.view',
                    'uses' => 'PremiumPlanController@getPremiumPlanView',
                ]);

                // buy premium plans
                Route::post('/buy-plans', [
                    'as' => 'user.premium_plan.write.buy_premium_plan',
                    'uses' => 'PremiumPlanController@buyPremiumPlans',
                ]);

                 // User Premium Plan Buy Successfully
                Route::get('/success', [
                    'as' => 'user.premium_plan.read.success_view',
                    'uses' => 'PremiumPlanController@getPremiumPlanSuccessView',
                ]);
            });
            
            /*
            Credit wallet User Components Public Section Related Routes
            ----------------------------------------------------------------------- */
            Route::group([
                'namespace' => 'User\Controllers',
                'prefix' => 'credit-wallet',
            ], function () {
                // User Credit-wallet View
                Route::get('/', [
                    'as' => 'user.credit_wallet.read.view',
                    'uses' => 'CreditWalletController@creditWalletView',
                ]);

                // Public User Wallet transaction list
                Route::get('/user-wallet-transaction-list', [
                    'as' => 'user.credit_wallet.read.wallet_transaction_list',
                    'uses' => 'CreditWalletController@getUserWalletTransactionList',
                ]);
                
                // paypal transaction complete
                Route::post('/{packageUid}/paypal-transaction-complete', [
                    'as' => 'user.credit_wallet.write.paypal_transaction_complete',
                    'uses' => 'CreditWalletController@paypalTransactionComplete',
                ]);
                
                // stripe checkout routes
                Route::post('/payment-process', [
                    'as' => 'user.credit_wallet.write.payment_process',
                    'uses' => 'CreditWalletController@paymentProcess',
                ]);
                
                // stripe success callback routes
                Route::get('/stripe-callback', [
                    'as' => 'user.credit_wallet.write.stripe.callback_url',
                    'uses' => 'CreditWalletController@stripeCallbackUrl',
                ]);
                
                // stripe checkout cancel url
                Route::get('/stripe-cancel', [
                    'as' => 'user.credit_wallet.write.stripe.cancel_url',
                    'uses' => 'CreditWalletController@stripeCancelCallback',
                ]);

                // razorpay checkout
                Route::post('/razorpay-checkout', [
                    'as' => 'user.credit_wallet.write.razorpay.checkout',
                    'uses' => 'CreditWalletController@razorpayCheckout',
                ]);
            });
        });     
        /*
         * User Section End here
        ----------------------------------------------------------------------- */

        /*
         * Manage / Admin Section 
        ----------------------------------------------------------------------- */
        Route::group([
            'middleware' => 'admin.auth',
            'prefix' => 'adminOld'
        ], function() {

// Meida CRUD
          Route::group([
            'namespace' => 'MemberMedia\Controllers'
        ], function () {
         Route::resource('member-media', MemberMediaController::class);

     });
            /*
            Manage User Components Public Section Related Routes
            ----------------------------------------------------------------------- */
            Route::group([
                'namespace' => 'User\Controllers',
                'prefix' => 'manage/user',
            ], function () {
                // Manage User List
                Route::get('/{status}/list', [
                    'as' => 'manage.user.view_list',
                    'uses' => 'ManageUserController@userList',
                ]);

                // Manage User Photos List
                Route::get('/photos', [
                    'as' => 'manage.user.photos_list',
                    'uses' => 'ManageUserController@userPhotosView',
                ]);

                // Manage User Photos List
                Route::get('/photos-list', [
                    'as' => 'manage.user.read.photos_list',
                    'uses' => 'ManageUserController@userPhotosList',
                ]);

                // Delete User photo
                Route::post('/{userUid}/{type}/{profileOrPhotoUid}/process-delete-photo', [
                    'as' => 'manage.user.write.photo_delete',
                    'uses' => 'ManageUserController@processUserPhotoDelete',
                ]);

                // Manage User List
                Route::get('/{status}/users-list', [
                    'as' => 'manage.user.read.list',
                    'uses' => 'ManageUserController@userDataTableList',
                ]);

                // Add New User
                Route::get('/add', [
                    'as' => 'manage.user.add',
                    'uses' => 'ManageUserController@addNewUserView',
                ]);
                // Add New User Process
                Route::post('/process-add', [
                    'as' => 'manage.user.write.create',
                    'uses' => 'ManageUserController@processAddNewUser',
                ]);
                // Edit User
                Route::get('/{userUid}/edit', [
                    'as' => 'manage.user.edit',
                    'uses' => 'ManageUserController@editUser',
                ]);
                // Update User
                Route::post('/{userUid}/process-update', [
                    'as' => 'manage.user.write.update',
                    'uses' => 'ManageUserController@processUpdateUser',
                ]);
                // Soft Delete User
                Route::post('/{userUid}/process-soft-delete', [
                    'as' => 'manage.user.write.soft_delete',
                    'uses' => 'ManageUserController@processUserSoftDelete',
                ]);
                // Permanent  Delete User
                Route::get('/{userUid}/process-permanent-delete', [
                    'as' => 'manage.user.write.permanent_delete',
                    'uses' => 'ManageUserController@processUserPermanentDelete',
                ]);
                // Restore User
                Route::post('/{userUid}/process-restore-user', [
                    'as' => 'manage.user.write.restore_user',
                    'uses' => 'ManageUserController@processRestoreUser',
                ]);
                // Blocked User
                Route::post('/{userUid}/process-block-user', [
                    'as' => 'manage.user.write.block_user',
                    'uses' => 'ManageUserController@processUserBlock',
                ]);
                // Unblocked User
                Route::post('/{userUid}/process-unblock-user', [
                    'as' => 'manage.user.write.unblock_user',
                    'uses' => 'ManageUserController@processUserUnblock',
                ]);
                // Show User Details
                Route::get('/{userUid}/details', [
                    'as' => 'manage.user.read.details',
                    'uses' => 'ManageUserController@getUserDetails',
                ]);

                // Verify user profile
                Route::get('/{userUid}/verify-profile', [
                    'as' => 'manage.user.write.verify',
                    'uses' => 'ManageUserController@processVerifyUserProfile',
                ]);
                
                // Manage User transaction list
                Route::get('/{userUid}/manage-user-transaction-list', [
                    'as' => 'manage.user.read.transaction_list',
                    'uses' => 'ManageUserController@manageUserTransactionList',
                ]);
            });

            /*
            Manage Credit Package Routes
            ----------------------------------------------------------------------- */
            Route::group([
                'namespace' => 'CreditPackage\Controllers',
                'prefix' => 'manage/credit-package',
            ], function () {
                //list
                Route::get('/list', [
                    'as' => 'manage.credit_package.read.list',
                    'uses' => 'CreditPackageController@getCreditPackageList',
                ]);
                
                // Package add view
                Route::get('/add-package', [
                    'as' => 'manage.credit_package.add.view',
                    'uses' => 'CreditPackageController@packageAddView',
                ]);
                
                // Package add
                Route::post('/add-package-process', [
                    'as' => 'manage.credit_package.write.add',
                    'uses' => 'CreditPackageController@addPackage',
                ]);
                
                // Package edit view
                Route::get('/{packageUId}/edit-package', [
                    'as' => 'manage.credit_package.edit.view',
                    'uses' => 'CreditPackageController@packageEditView',
                ]);

                // Package edit process
                Route::post('/{packageUId}/edit-package-process', [
                    'as' => 'manage.credit_package.write.edit',
                    'uses' => 'CreditPackageController@editPackage',
                ]);
                
                // Package delete view
                Route::post('/{packageUId}/delete-package', [
                    'as' => 'manage.credit_package.write.delete',
                    'uses' => 'CreditPackageController@processDeletePackage',
                ]);
            });

            /*
            Manage Credit wallet User Components Public Section Related Routes
            ----------------------------------------------------------------------- */
            Route::group([
                'namespace' => 'User\Controllers',
                'prefix' => 'manage/fake-user',
            ], function () {

                // Add New User
                Route::get('/generate', [
                    'as' => 'manage.fake_users.read.generator_options',
                    'uses' => 'ManageUserController@fetchFakeUserOptions',
                ]);
                // Add New User Process
                Route::post('/generate-fake-users', [
                    'as' => 'manage.fake_users.write.create',
                    'uses' => 'ManageUserController@generateFakeUser',
                ]);
            });

            /*
            Media Component Routes Start from here
            ------------------------------------------------------------------- */
            Route::group([
                'namespace' => 'Media\Controllers',
                'prefix'    => 'media',
            ], function () {
                // Temp Upload
                Route::post('/upload-temp-media', [
                    'as' => 'media.upload_temp_media',
                    'uses' => 'MediaController@uploadTempMedia',
                ]);
                // Gift Temp Upload
                Route::post('/upload-gift-temp-media', [
                    'as' => 'media.gift.upload_temp_media',
                    'uses' => 'MediaController@uploadGiftTempMedia',
                ]);
                // Sticker Temp Upload
                Route::post('/upload-sticker-temp-media', [
                    'as' => 'media.sticker.upload_temp_media',
                    'uses' => 'MediaController@uploadStickerTempMedia',
                ]);
                // Package Temp Upload
                Route::post('/upload-package-temp-media', [
                    'as' => 'media.package.upload_temp_media',
                    'uses' => 'MediaController@uploadPackageTempMedia',
                ]);
                // Upload Logo
                Route::post('/upload-logo', [
                    'as' => 'media.upload_logo',
                    'uses' => 'MediaController@uploadLogo',
                ]);
                // Upload Small Logo
                Route::post('/upload-small-logo', [
                    'as' => 'media.upload_small_logo',
                    'uses' => 'MediaController@uploadSmallLogo',
                ]);
                // Upload Favicon
                Route::post('/upload-favicon', [
                    'as' => 'media.upload_favicon',
                    'uses' => 'MediaController@uploadFavicon',
                ]);
            });
            
            /*
            Dashboard Component Routes Start from here
            ------------------------------------------------------------------- */
            Route::group([
                'namespace' => 'Dashboard\Controllers'
            ], function () {
                // dashboard view
                Route::get('/', [
                    'as' => 'manage.dashboard',
                    'uses' => 'DashboardController@loadDashboardView',
                ]);   
            });
            
            /*
            Configuration Component Routes Start from here
            ------------------------------------------------------------------- */
            Route::group([
                'namespace' => 'Configuration\Controllers',
                'prefix'    => 'configuration',
            ], function () {

                // Clear Cache Everything
                Route::get('/clear-system-cache', [
                    'as' => 'manage.configuration.clear_cache',
                    'uses' => 'ConfigurationController@clearSystemCache',
                ]);
                
                // View Configuration View
                Route::get('/{pageType}', [
                    'as' => 'manage.configuration.read',
                    'uses' => 'ConfigurationController@getConfiguration',
                ]);
                // Process Configuration Data
                Route::post('/{pageType}/process-configuration-store', [
                    'as' => 'manage.configuration.write',
                    'uses' => 'ConfigurationController@processStoreConfiguration',
                ]);
            });
            
            /*
            Manage Financial transaction Components Manage Section Related Routes
            ----------------------------------------------------------------------- */
            Route::group([
                'namespace' => 'FinancialTransaction\Controllers',
                'prefix' => 'financial-transaction',
            ], function () {
                //Manage Financial transaction transaction View
                Route::get('/{transactionType}/list', [
                    'as' => 'manage.financial_transaction.read.view_list',
                    'uses' => 'FinancialTransactionController@financialTransactionViewList',
                ]);

                // Financial transaction list
                Route::get('/{transactionType}/transaction-list', [
                    'as' => 'manage.financial_transaction.read.list',
                    'uses' => 'FinancialTransactionController@getTransactionList',
                ]);
                
                // Delete all test transaction 
                Route::post('/delete-all-test-transaction', [
                    'as' => 'manage.financial_transaction.write.delete.all_transaction',
                    'uses' => 'FinancialTransactionController@deleteAllTestTransaction',
                ]);
            });
            
            /*
            Pages Components Manage Section Related Routes
            ------------------------------------------------------------------- */
            Route::group([
                'namespace' => 'Pages\Controllers',
                'prefix' => 'pages',
            ], function () {
                // pages view
                Route::get('/', [
                    'as' => 'manage.page.view',
                    'uses' => 'ManagePagesController@pageListView',
                ]);
                
                // pages view
                Route::get('/list', [
                    'as' => 'manage.page.list',
                    'uses' => 'ManagePagesController@getDatatableData',
                ]);

                // pages add view
                Route::get('/add', [
                    'as' => 'manage.page.add.view',
                    'uses' => 'ManagePagesController@pageAddView',
                ]);

                // pages add process
                Route::post('/page-add-process', [
                    'as' => 'manage.page.write.add',
                    'uses' => 'ManagePagesController@processAddPage',
                ]);

                // pages edit view
                Route::get('/{pageUId}/edit', [
                    'as' => 'manage.page.edit.view',
                    'uses' => 'ManagePagesController@pageEditView',
                ]);

                // pages edit process
                Route::post('/{pageUId}/page-edit-process', [
                    'as' => 'manage.page.write.edit',
                    'uses' => 'ManagePagesController@processEditPage',
                ]);

                // pages delete process
                Route::post('/{pageUId}/page-delete', [
                    'as' => 'manage.page.write.delete',
                    'uses' => 'ManagePagesController@delete',
                ]);
            });

            /*
            Gift Components Manage Section Related Routes
            ------------------------------------------------------------------- */
            Route::group([
                'namespace' => 'Item\Controllers'
            ], function () {
                // Gift view
                Route::get('/gift', [
                    'as' => 'manage.item.gift.view',
                    'uses' => 'ManageGiftController@giftListView',
                ]);

                // Gift add view
                Route::get('/add-gift', [
                    'as' => 'manage.item.gift.add.view',
                    'uses' => 'ManageGiftController@giftAddView',
                ]);

                // Gift add
                Route::post('/add-gift-process', [
                    'as' => 'manage.item.gift.write.add',
                    'uses' => 'ManageGiftController@addGift',
                ]);

                // Gift edit view
                Route::get('/{giftUId}/edit-gift', [
                    'as' => 'manage.item.gift.edit.view',
                    'uses' => 'ManageGiftController@giftEditView',
                ]);

                // Gift edit process
                Route::post('/{giftUId}/edit-gift-process', [
                    'as' => 'manage.item.gift.write.edit',
                    'uses' => 'ManageGiftController@editGift',
                ]);

                // Gift delete view
                Route::post('/{giftUId}/delete-gift', [
                    'as' => 'manage.item.gift.write.delete',
                    'uses' => 'ManageGiftController@deleteGift',
                ]);

                // Sticker view
                Route::get('/sticker', [
                    'as' => 'manage.item.sticker.view',
                    'uses' => 'ManageStickerController@stickerListView',
                ]);
                
                // Upload Sticker image
                Route::post('/upload-sticker-image', [
                    'as' => 'manage.item.sticker.write.upload_image',
                    'uses' => 'ManageStickerController@uploadStickerImage',
                ]);

                // Sticker add view
                Route::get('/add-sticker', [
                    'as' => 'manage.item.sticker.add.view',
                    'uses' => 'ManageStickerController@stickerAddView',
                ]);

                // Sticker add
                Route::post('/add-sticker-process', [
                    'as' => 'manage.item.sticker.write.add',
                    'uses' => 'ManageStickerController@addSticker',
                ]);

                // Sticker edit view
                Route::get('/{stickerUId}/edit-sticker', [
                    'as' => 'manage.item.sticker.edit.view',
                    'uses' => 'ManageStickerController@stickerEditView',
                ]);

                // Sticker edit process
                Route::post('/{stickerUId}/edit-sticker-process', [
                    'as' => 'manage.item.sticker.write.edit',
                    'uses' => 'ManageStickerController@editSticker',
                ]);

                // Sticker delete view
                Route::post('/{stickerUId}/delete-sticker', [
                    'as' => 'manage.item.sticker.write.delete',
                    'uses' => 'ManageStickerController@deleteSticker',
                ]);
            });

            /*
            User AbuseReport Component Manage Routes Start from here
            ------------------------------------------------------------------- */
            Route::group([
                'namespace' => 'AbuseReport\Controllers',
                'prefix'    => 'abuse-report',
            ], function () {
                // abuse report view list
                Route::get('/{status}/list', [
                    'as' => 'manage.abuse_report.read.list',
                    'uses' => 'AbuseReportController@reportListView',
                ]);

                // abuse report moderated
                Route::post('/moderate-report', [
                    'as' => 'manage.abuse_report.write.moderated',
                    'uses' => 'AbuseReportController@reportModerated',
                ]);
            });

            /*
            Manage Translations
            ------------------------------------------------------------------- */
            Route::group([
                'namespace' => 'Translation\Controllers',
                'prefix'    => 'translations',
            ], function () {

                Route::get('/', [
                    'as' => 'manage.translations.languages',
                    'uses' => 'TranslationController@languages',
                ]);

                // Store New Language
                Route::post('/process-language-store', [
                    'as' => 'manage.translations.write.language_create',
                    'uses' => 'TranslationController@storeLanguage',
                ]);

                // Update Language
                Route::post('/process-language-update', [
                    'as' => 'manage.translations.write.language_update',
                    'uses' => 'TranslationController@updateLanguage',
                ]);

                // Delete Language
                Route::post('/{languageId}/process-language-delete', [
                    'as' => 'manage.translations.write.language_delete',
                    'uses' => 'TranslationController@deleteLanguage',
                ]);

                Route::get('language/{languageId}', [
                    'as' => 'manage.translations.lists',
                    'uses' => 'TranslationController@lists',
                ]);

                Route::get('/scan/{languageId}/{preventReload?}', [
                    'as' => 'manage.translations.scan',
                    'uses' => 'TranslationController@scan',
                ]);

                Route::post('/update', [
                    'as' => 'manage.translations.update',
                    'uses' => 'TranslationController@update',
                ]);

                Route::get('/export/{languageId}', [
                    'as' => 'manage.translations.export',
                    'uses' => 'TranslationController@export',
                ]);

                Route::post('/import/{languageId}', [
                    'as' => 'manage.translations.import',
                    'uses' => 'TranslationController@import',
                ]);
            });
        });
});
});
Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::any('/sitemap.xml',[App\Exp\Components\Sitemap\Controllers\SitemapController::class, 'index'])->name('sitemap.index');
