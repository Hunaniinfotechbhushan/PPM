<?php
/*
* MessengerController.php - Controller file
*
* This file is part of the Messenger component.
*-----------------------------------------------------------------------------*/

namespace App\Exp\Components\Messenger\Controllers;

use App\Exp\Base\BaseController;
use App\Exp\Support\CommonUnsecuredPostRequest;
use App\Exp\Components\Messenger\Requests\MessageRequest;
use App\Exp\Components\Messenger\MessengerEngine;
use Illuminate\Http\Request;
use DB;
use Auth;

class MessengerController extends BaseController 
{    
    /**
     * @var  MessengerEngine $messengerEngine - Messenger Engine
     */
    protected $messengerEngine;

    /**
      * Constructor
      *
      * @param  MessengerEngine $messengerEngine - Messenger Engine
      *
      * @return  void
      *-----------------------------------------------------------------------*/

    function __construct(MessengerEngine $messengerEngine)
    {
        $this->messengerEngine = $messengerEngine;
    }

    /**
      * Get Conversation List
      *
      * @return  void
      *-----------------------------------------------------------------------*/
    public function show()
    {
        return $this->loadView('messenger.chat-box');
    }

    /**
      * Get Conversation List
      *
      * @return  void
      *-----------------------------------------------------------------------*/
    public function getAllConversation()
    {
        $inboxMessageResponse = $this->messengerEngine->prepareConversationList('inbox',null);
        $unreadMessageResponse = $this->messengerEngine->prepareConversationList('unreadMessage',null);
        $sentMessageResponse = $this->messengerEngine->prepareConversationList('sent',null);
        $archiveMessageResponse = $this->messengerEngine->prepareConversationList('archive',null);
        $deletedMessageResponse = $this->messengerEngine->prepareConversationList('deleted',null);
        $filteredMessageResponse = $this->messengerEngine->prepareConversationList('filtered',null);
// echo "<pre>";
// print_r($deletedMessageResponse);
// die;
        return view('messenger.chat',compact('inboxMessageResponse','sentMessageResponse','archiveMessageResponse','deletedMessageResponse','filteredMessageResponse','unreadMessageResponse'));

    }

    /**
      * Get Conversation List
      *
      * @return  void
      *-----------------------------------------------------------------------*/
    public function getIndividualConversation($specificUserId)
    {
        $processReaction = $this->messengerEngine->prepareConversationList($specificUserId);

        return $this->responseAction(
            $this->processResponse($processReaction, [], [], true),
            $this->replaceView('messenger.chat', $processReaction['data'], '#lwMessengerContent')
        );
    }

    /**
      * Get User Conversation
      *
      * @param number $userId
      *
      * @return  void
      *-----------------------------------------------------------------------*/
    public function getUserConversation(Request $request)
    {
        if(isset($request->user_id)){
           $processReaction = $this->messengerEngine->getBothUserConversation($request->user_id);

           if($processReaction){
            echo json_encode($processReaction);
        }
    }

}


    public function messagerUserActivity(Request $request)
    {
            if($request->request_for == 'delete'){

                   $deletedChatIDs = DB::table('chat_deleted_user')
                   ->where('from_user_id','=',Auth::user()->_id)
                   ->where('to_user_id','=',$request->to_user_id)
                   ->first();
                   if(empty($deletedChatIDs)){
                     DB::insert('insert into chat_deleted_user (from_user_id, to_user_id) values (?, ?)', [Auth::user()->_id, $request->to_user_id]);
                   }
       
            }

            if($request->request_for == 'archive'){

                   $deletedChatIDs = DB::table('chat_archive_user ')
                   ->where('from_user_id','=',Auth::user()->_id)
                   ->where('to_user_id','=',$request->to_user_id)
                   ->first();
                   if(empty($deletedChatIDs)){
                     DB::insert('insert into chat_archive_user (from_user_id, to_user_id) values (?, ?)', [Auth::user()->_id, $request->to_user_id]);
                   }
       
            }

            if($request->request_for == 'block'){
                
            }
          echo json_encode($processReaction);
 
}


    public function message_user_action(Request $request)
    {
            if($request->request_for == 'delete'){

                   $deletedChatIDs = DB::table('chat_deleted_user')
                   ->where('from_user_id','=',Auth::user()->_id)
                   ->where('to_user_id','=',$request->to_user_id)
                   ->first();
                   if(empty($deletedChatIDs)){
                     DB::insert('insert into chat_deleted_user (from_user_id, to_user_id) values (?, ?)', [Auth::user()->_id, $request->to_user_id]);
                   }
       
            }

            if($request->request_for == 'archive'){

                   $deletedChatIDs = DB::table('chat_archive_user ')
                   ->where('from_user_id','=',Auth::user()->_id)
                   ->where('to_user_id','=',$request->to_user_id)
                   ->first();
                   if(empty($deletedChatIDs)){
                     DB::insert('insert into chat_archive_user (from_user_id, to_user_id) values (?, ?)', [Auth::user()->_id, $request->to_user_id]);
                   }
       
            }

            if($request->request_for == 'block'){
                
            }
          echo json_encode(array('status' => 'success' ));
 
}


    /**
      * Send Message
      *
      * @param number $userId
      *
      * @return  void
      *-----------------------------------------------------------------------*/
    public function sendMessageOnProfile(MessageRequest $request, $userId)
    {
        $processReaction = $this->messengerEngine->processSendMessageProfile($request->all(), $userId);

        if($processReaction){
            echo json_encode($processReaction);
        }   
    }

    public function sendChatMessage(Request $request){


     $processReaction = $this->messengerEngine->sendChatMessage($request->all());

        if($processReaction){
            echo json_encode($processReaction);
        } 

}


    public function sendMessage(MessageRequest $request, $userId)
    {
        $processReaction = $this->messengerEngine->processSendMessage($request->all(), $userId);

        return $this->processResponse($processReaction, [], [], true);
    }

	/**
      * Prepare user caller call
      *
      * @param number $userId
      *
      * @return  void
      *-----------------------------------------------------------------------*/
    public function callerCallInitialize($userUId, $type)
    {
        $processReaction = $this->messengerEngine->prepareUserCallerCallData($userUId, $type);

        return $this->responseAction(
            $this->processResponse($processReaction, [], [], true)
        );
    }

  /**
    * Receiver join call request
    *
    * @param obj CommonUnsecuredPostRequest $request
    *
    * @return  void
    *-----------------------------------------------------------------------*/
  public function receiverJoinCallRequest(CommonUnsecuredPostRequest $request)
  {
      $processReaction = $this->messengerEngine->processReceiverJoinCall($request->all());

      return $this->processResponse($processReaction, [], [], true);
  }

	/**
      * Prepare user caller reject call 
      *
      * @param number $userId
      *
      * @return  void
      *-----------------------------------------------------------------------*/
    public function callerRejectCall($receiverUserUid)
    {
        $processReaction = $this->messengerEngine->prepareCallerRejectCall($receiverUserUid);
        return $this->responseAction(
            $this->processResponse($processReaction, [], [], true)
        );
    }

	/**
      * Prepare user receiver reject call
      *
      * @param number $userId
      *
      * @return  void
      *-----------------------------------------------------------------------*/
    public function receiverRejectCall($callerUserUid)
    {
        $processReaction = $this->messengerEngine->prepareReceiverRejectCall($callerUserUid);
        return $this->responseAction(
            $this->processResponse($processReaction, [], [], true)
        );
    }

	/**
      * Prepare Caller Calling Errors Request
      *
      * @param number $receiverUserUid
      *
      * @return  void
      *-----------------------------------------------------------------------*/
    public function callerCallErrors($receiverUserUid)
    {
      $processReaction = $this->messengerEngine->prepareCallerCallErrors($receiverUserUid);

      return $this->responseAction(
        $this->processResponse($processReaction, [], [], true)
    );
  }

	/**
      * Prepare Receiver Calling Errors Request
      *
      * @param number $callerUserUid
      *
      * @return  void
      *-----------------------------------------------------------------------*/
    public function receiverCallErrors($callerUserUid)
    {
      $processReaction = $this->messengerEngine->prepareReceiverCallErrors($callerUserUid);

      return $this->responseAction(
        $this->processResponse($processReaction, [], [], true)
    );
  }

	/**
      * Prepare Receiver Calling Accept Request
      *
      * @param number $receiverUserUid
      *
      * @return  void
      *-----------------------------------------------------------------------*/
    public function receiverCallAccept($receiverUserUid)
    {
      $processReaction = $this->messengerEngine->prepareReceiverCallAccept($receiverUserUid);

      return $this->responseAction(
        $this->processResponse($processReaction, [], [], true)
    );
  }

	/**
      * Prepare Receiver Calling Busy Errors Request
      *
      * @param number $callerUserUid
      *
      * @return  void
      *-----------------------------------------------------------------------*/
    public function receiverCallBusy($callerUserUid)
    {
      $processReaction = $this->messengerEngine->prepareReceiverCallBusy($callerUserUid);

      return $this->responseAction(
        $this->processResponse($processReaction, [], [], true)
    );
  }

    /**
      * Acccept / Decline message request
      *
      * @param obj CommonUnsecuredPostRequest $request
      * @param number $userId
      *
      * @return  void
      *-----------------------------------------------------------------------*/
    public function acceptDeclineMessageRequest(CommonUnsecuredPostRequest $request, $userId)
    {
        $processReaction = $this->messengerEngine->processAcceptDeclineMessageRequest($request->all(), $userId);

        return $this->processResponse($processReaction, [], [], true);
        return $this->getUserConversation($userId);
    }

    /**
      * Delete Single Message
      *
      * @param obj CommonUnsecuredPostRequest $request
      * @param number $chatId
      *
      * @return  void
      *-----------------------------------------------------------------------*/
    public function deleteMessage(CommonUnsecuredPostRequest $request, $chatId, $userId)
    {
        $processReaction = $this->messengerEngine->processDeleteMessage($chatId);

        return $this->getUserConversation($userId);
    }

    /**
      * Delete Single Message
      *
      * @param obj CommonUnsecuredPostRequest $request
      *
      * @return  void
      *-----------------------------------------------------------------------*/
    public function deleteAllMessages(CommonUnsecuredPostRequest $request, $userId)
    {
        $processReaction = $this->messengerEngine->processDeleteAllMessages($request->all());

        return $this->getUserConversation($userId);
    }

    /**
      * Get Stickers
      *
      * @return  void
      *-----------------------------------------------------------------------*/
    public function getStickers()
    {
        $processReaction = $this->messengerEngine->prepareStickers();

        return $this->processResponse($processReaction, [], [], true);
    }

    /**
      * Get Stickers
      *
      * @return  void
      *-----------------------------------------------------------------------*/
    public function buySticker(CommonUnsecuredPostRequest $request)
    {
        $processReaction = $this->messengerEngine->processBuySticker($request->all());

        return $this->processResponse($processReaction, [], [], true);
    }

    /**
      * Get Messenger Log
      *
      * @return  void
      *-----------------------------------------------------------------------*/
    public function getMessengerLogView()
    {
        return $this->loadManageView('messenger.manage.log');
    }

    /**
      * Get Messenger Log
      *
      * @return  void
      *-----------------------------------------------------------------------*/
    public function getMessengerLog()
    {
        return $this->messengerEngine->prepareMessengerLog();
    }
}