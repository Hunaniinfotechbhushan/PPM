<?php
/*
* MessengerRepository.php - Repository file
*
* This file is part of the Messenger component.
*-----------------------------------------------------------------------------*/

namespace App\Exp\Components\Messenger\Repositories;

use App\Exp\Base\BaseRepository;

use App\Exp\Components\Messenger\Models\ChatModel;
use App\Exp\Components\Messenger\Interfaces\MessengerRepositoryInterface;
use Auth;
use DB;
class MessengerRepository extends BaseRepository
implements MessengerRepositoryInterface 
{
    /**
      * Fetch the record of Messenger users
      *
      * @param number $userId
      *
      * @return    eloquent collection object
      *---------------------------------------------------------------- */
    public function fetchInboxMessengerUsers($userId)
    {
        if(isset($_GET['uid'])){
      
    return ChatModel::/* where('chats.users__id', $userId)
    -> */join('users', function ($join) use($userId) {
        $join->on('chats.from_users__id', '=', 'users._id')
        ->where('chats.to_users__id', $userId)
        ->orOn('chats.to_users__id', '=', 'users._id')
        ->where('chats.from_users__id', $userId);
    })
    ->join('chat_archive_user', 'users._id', '!=', 'chat_archive_user.to_user_id')
    ->join('user_authorities', 'users._id', '=', 'user_authorities.users__id')
    ->orderBy('chats.updated_at','DESC')
    ->leftJoin('user_profiles', 'users._id', '=', 'user_profiles.users__id')
    ->groupBy('chats.from_users__id')
    ->select(
        \__nestedKeyValues([
            'chats' => [
                '_id',
                '_uid',
                'users__id',
                'from_users__id',
                'to_users__id'
            ],
            'users' => [
                '_id AS user_id',
                '_uid AS user_uid',
                'username'
            ],
            'user_profiles' => [
                'users__id AS user_profile_user_id',
                'profile_picture',
                'about_me'
            ],
            'user_authorities' => [
                'users__id AS user_authority_user_id',
                'updated_at as user_authority_updated_at'
            ]
        ])
    )
    ->get();
}else{
    $archiveIDArray = array();
    $deletedIDArray = array();
    $archiveIDs = DB::table('chat_archive_user')->where('from_user_id','=',Auth::user()->_id)->get();
    $deletedChatIDs = DB::table('chat_deleted_user')->where('from_user_id','=',Auth::user()->_id)->get();
    if (!empty($archiveIDs)) {
        foreach ($archiveIDs as $key => $value) {
            $archiveIDArray[]=$value->to_user_id;
        }
    }

    if (!empty($deletedChatIDs)) {
        foreach ($deletedChatIDs as $key => $value) {
            $deletedIDArray[]=$value->to_user_id;
        }
    }
    $chatData = ChatModel::join('users', function ($join) use($userId) {
             $join->on('chats.from_users__id', '=', 'users._id')
            ->where('chats.to_users__id', $userId)
            ->orOn('chats.to_users__id', '=', 'users._id')
           
            ->where('chats.from_users__id', $userId);

             $join->on('chats.from_users__id', '=', 'users._id')
        ->where('chats.to_users__id', $userId);
    })
    ->join('user_authorities', 'users._id', '=', 'user_authorities.users__id')    
    ->leftJoin('user_profiles', 'users._id', '=', 'user_profiles.users__id');

    if(!empty($archiveIDArray)){
     $chatData->whereNotIn('users._id',$archiveIDArray); 
 }
 if(!empty($deletedIDArray)){
     $chatData->whereNotIn('users._id',$deletedIDArray); 
 }  

 $chatData->where('chats.msg_status',1);
 $chatData->groupBy('chats.from_users__id');
 $chatData->orderBy('chats.updated_at','DESC');
 $chatData->select(
    \__nestedKeyValues([
        'chats' => [
            '_id',
            '_uid',
            'users__id',
            'from_users__id',
            'to_users__id'
        ],
        'users' => [
            '_id AS user_id',
            '_uid AS user_uid',
            'username'
        ],
        'user_profiles' => [
            'users__id AS user_profile_user_id',
            'profile_picture',
            'about_me'
        ],
        'user_authorities' => [
            'users__id AS user_authority_user_id',
            'updated_at as user_authority_updated_at'
        ]
    ])
);

 return $chatData->get();
}

}


  public function unreadMessengerUsers($userId)
    {

    $archiveIDArray = array();
    $deletedIDArray = array();
    $archiveIDs = DB::table('chat_archive_user')->where('from_user_id','=',Auth::user()->_id)->get();
    $deletedChatIDs = DB::table('chat_deleted_user')->where('from_user_id','=',Auth::user()->_id)->get();
    if (!empty($archiveIDs)) {
        foreach ($archiveIDs as $key => $value) {
            $archiveIDArray[]=$value->to_user_id;
        }
    }

    if (!empty($deletedChatIDs)) {
        foreach ($deletedChatIDs as $key => $value) {
            $deletedIDArray[]=$value->to_user_id;
        }
    }
    $chatData = ChatModel::join('users', function ($join) use($userId) {
             $join->on('chats.from_users__id', '=', 'users._id')
            ->where('chats.to_users__id', $userId)
            ->orOn('chats.to_users__id', '=', 'users._id')
            ->where('chats.from_users__id', $userId);
    })
    ->join('user_authorities', 'users._id', '=', 'user_authorities.users__id')
    ->orderBy('chats.updated_at','DESC')
    ->leftJoin('user_profiles', 'users._id', '=', 'user_profiles.users__id');

    if(!empty($archiveIDArray)){
     $chatData->whereNotIn('users._id',$archiveIDArray); 
 }
 if(!empty($deletedIDArray)){
     $chatData->whereNotIn('users._id',$deletedIDArray); 
 }  
 $chatData->where('chats.msg_status',0);
 $chatData->groupBy('chats.from_users__id');
 $chatData->select(
    \__nestedKeyValues([
        'chats' => [
            '_id',
            '_uid',
            'users__id',
            'from_users__id',
            'to_users__id'
        ],
        'users' => [
            '_id AS user_id',
            '_uid AS user_uid',
            'username'
        ],
        'user_profiles' => [
            'users__id AS user_profile_user_id',
            'profile_picture',
            'about_me'
        ],
        'user_authorities' => [
            'users__id AS user_authority_user_id',
            'updated_at as user_authority_updated_at'
        ]
    ])
);

 return $chatData->get();

}


public function fetchSentMessengerUsers($userId)
{
        return ChatModel::/* where('chats.users__id', $userId)
        -> */join('users', function ($join) use($userId) {
            $join->on('chats.to_users__id', '=', 'users._id')
            ->where('chats.from_users__id', Auth::user()->_id)
            ->where('chats.request_is', 'first');
        })
        ->leftJoin('user_profiles', 'users._id', '=', 'user_profiles.users__id')
        ->join('user_authorities', 'chats.to_users__id', '=', 'user_authorities.users__id')
        ->select(
            \__nestedKeyValues([
                'chats' => [
                    '_id',
                    '_uid',
                    'users__id',
                    'from_users__id',
                    'to_users__id'
                ],
                'users' => [
                    '_id AS user_id',
                    '_uid AS user_uid',
                    'username'
                ],
                'user_profiles' => [
                    'users__id AS user_profile_user_id',
                    'profile_picture',
                    'about_me'
                ],
                'user_authorities' => [
                    'users__id AS user_authority_user_id',
                    'updated_at as user_authority_updated_at'
                ]
            ])
        )
        ->orderBy('chats.created_at','DESC')
        ->get();
    }


    public function fetchArchiveMessengerUsers($userId)
    {
        $deletedIDArray = array();
            $deletedChatIDs = DB::table('chat_deleted_user')->where('from_user_id','=',Auth::user()->_id)->get();
 
    if (!empty($deletedChatIDs)) {
        foreach ($deletedChatIDs as $key => $value) {
            $deletedIDArray[]=$value->to_user_id;
        }
    }

     $arcData = DB::table('chat_archive_user')
     ->leftJoin('users', 'users._id', '=', 'chat_archive_user.to_user_id')
     ->leftJoin('user_profiles', 'users._id', '=', 'user_profiles.users__id')
     ->join('user_authorities', 'users._id', '=', 'user_authorities.users__id')
     ->where('chat_archive_user.from_user_id', Auth::user()->_id);

    if(!empty($deletedIDArray)){
     $arcData->whereNotIn('users._id',$deletedIDArray); 
 }
     $arcData->select(
        \__nestedKeyValues([
            'users' => [
                '_id AS user_id',
                '_uid AS user_uid',
                'username'
            ],
            'user_profiles' => [
                'users__id AS user_profile_user_id',
                'profile_picture',
                'about_me'
            ],
            'user_authorities' => [
                'users__id AS user_authority_user_id',
                'updated_at as user_authority_updated_at'
            ]
        ])
    );
     $arcData->orderBy('chat_archive_user.created_at','DESC');
     return $arcData->get();

 }

 public function fetchDeletedMessengerUsers($userId)
 {
     $arcData = DB::table('chat_deleted_user')
     ->leftJoin('users', 'users._id', '=', 'chat_deleted_user.to_user_id')
     ->leftJoin('user_profiles', 'users._id', '=', 'user_profiles.users__id')
     ->join('user_authorities', 'users._id', '=', 'user_authorities.users__id')
     ->where('chat_deleted_user.from_user_id', Auth::user()->_id);
     $arcData->select(
        \__nestedKeyValues([
            'users' => [
                '_id AS user_id',
                '_uid AS user_uid',
                'username'
            ],
            'user_profiles' => [
                'users__id AS user_profile_user_id',
                'profile_picture',
                'about_me'
            ],
            'user_authorities' => [
                'users__id AS user_authority_user_id',
                'updated_at as user_authority_updated_at'
            ]
        ])
    );
     $arcData->orderBy('chat_deleted_user.created_at','DESC');
     return $arcData->get();

 }

  public function fetchFilteredOutMessengerUsers($userId)
 {
     $arcData = DB::table('chat_archive_user')
     ->leftJoin('users', 'users._id', '=', 'chat_archive_user.to_user_id')
     ->leftJoin('user_profiles', 'users._id', '=', 'user_profiles.users__id')
     ->join('user_authorities', 'users._id', '=', 'user_authorities.users__id')
     ->where('chat_archive_user.from_user_id', Auth::user()->_id);
     $arcData->select(
        \__nestedKeyValues([
            'users' => [
                '_id AS user_id',
                '_uid AS user_uid',
                'username'
            ],
            'user_profiles' => [
                'users__id AS user_profile_user_id',
                'profile_picture',
                'about_me'
            ],
            'user_authorities' => [
                'users__id AS user_authority_user_id',
                'updated_at as user_authority_updated_at'
            ]
        ])
    );
     $arcData->orderBy('chat_archive_user.created_at','DESC');
     return $arcData->get();

 }

 public function fetchBothUserConversations($userId)
 {   
    return ChatModel::where(function($query) use($userId) {
        $query->where('chats.to_users__id', $userId)
        ->orWhere('chats.from_users__id', $userId);
    })
    ->where(function($query) {
        $loggedInUserId = getUserID();
        $query->where('chats.to_users__id', $loggedInUserId)
        ->orWhere('chats.from_users__id', $loggedInUserId);
    })
    ->join('users AS message_from_user', 'chats.from_users__id', '=', 'message_from_user._id')
    ->join('users AS message_to_user', 'chats.to_users__id', '=', 'message_to_user._id')
    ->select(
        \__nestedKeyValues([
            'chats' => [
                '_id',
                '_uid',
                'created_at',
                'status',
                'message',
                'type',
                'from_users__id',
                'to_users__id',
                'users__id'
            ],
            'message_from_user' => [
                '_id AS message_from_user_id',
                'username AS from_username'
            ],
            'message_to_user' => [
                '_id AS message_to_user_id',
                'username AS to_username'
            ]
        ])
    )
    ->get();
}


    /**
      * Fetch the record of Messenger
      *
      * @param number $userId
      *
      * @return    eloquent collection object
      *---------------------------------------------------------------- */
    public function fetchConversations($userId)
    {   
        return ChatModel::where('chats.users__id', $userId)
        ->where(function($query) {
            $loggedInUserId = getUserID();
            $query->where('chats.to_users__id', $loggedInUserId)
            ->orWhere('chats.from_users__id', $loggedInUserId);
        })
        ->join('users AS message_from_user', 'chats.from_users__id', '=', 'message_from_user._id')
        ->join('users AS message_to_user', 'chats.to_users__id', '=', 'message_to_user._id')
        ->select(
            \__nestedKeyValues([
                'chats' => [
                    '_id',
                    '_uid',
                    'created_at',
                    'status',
                    'message',
                    'type',
                    'from_users__id',
                    'to_users__id',
                    'users__id'
                ],
                'message_from_user' => [
                    '_id AS message_from_user_id',
                    'first_name AS message_from_first_name',
                    'last_name AS message_from_last_name'
                ],
                'message_to_user' => [
                    '_id AS message_to_user_id',
                    'first_name AS message_to_first_name',
                    'last_name AS message_to_last_name'
                ]
            ])
        )
        ->get();
    }

    /**
      * Store Message
      *
      * @param array $inputData
      *
      * @return eloquent collection object
      *---------------------------------------------------------------- */
    public function storeMessage($inputData)
    {
        $newChatModel = new ChatModel;
        // check if chat messages store
        if ($chatUids = $newChatModel->prepareAndInsert($inputData, 'created_at')) {
            return $chatUids;
        }

        return false;
    }

    /**
      * Check if current logged in user can chat with user
      *
      * @param int $userId
      *
      * @return eloquent collection object
      *---------------------------------------------------------------- */
    public function fetchMessageRequest($userId)
    {
        $loggedInUserId = getUserID();
        return ChatModel::whereIn('type', [9, 10, 11])
        ->where('users__id', $loggedInUserId)
        ->where(function($query) use($userId) {
            $query->where('to_users__id', $userId)
            ->orWhere('from_users__id', $userId);
        })
        ->first();
    }

    /**
      * Fetch message receiver data
      *
      * @param int $userId
      *
      * @return eloquent collection object
      *---------------------------------------------------------------- */
    public function fetchPendingMessageData($fromUserId, $toUserId)
    {
        return ChatModel::where([
            'from_users__id' => $fromUserId,
            'to_users__id' => $toUserId,
        ])
        ->whereIn('type', [9, 11])
        ->get();
    }

    /**
      * Update message request
      *
      * @param arr $updateData
      *
      * @return eloquent collection object
      *---------------------------------------------------------------- */
    public function updateMessages($updateData)
    {
        return ChatModel::bunchUpdate($updateData, '_id');
    }

    /**
      * Fetch by id
      *
      * @param number $chatId
      *
      * @return eloquent collection object
      *---------------------------------------------------------------- */
    public function fetchById($chatId)
    {
        return ChatModel::where('_id', $chatId)->first();
    }

    /**
      * delete Chat
      *
      * @param obj $message
      *
      * @return eloquent collection object
      *---------------------------------------------------------------- */
    public function deleteMessage($message)
    {
        if ($message->delete()) {
            return true;
        }

        return false;
    }

    /**
      * Fetch My 
      *
      * @param obj $message
      *
      * @return eloquent collection object
      *---------------------------------------------------------------- */
    public function fetchMyMessages($userId)
    {
        $loggedInUserId = getUserID();
        return ChatModel::where('users__id', $userId)
        ->whereNotIn('type', [9, 10, 11])
        ->get();
    }

    /**
      * Delete all messages
      *
      * @param obj $message
      *
      * @return eloquent collection object
      *---------------------------------------------------------------- */
    public function deleteAllMessages($messageIds)
    {
        if (ChatModel::whereIn('_id', $messageIds)->delete()) {
            return true;
        }

        return false;
    }

    /**
      * Fetch Messenger Data table 
      *
      * @return eloquent collection object
      *---------------------------------------------------------------- */
    public function fetchMessengerLogData()
    {
        $dataTableConfig = [
            'fieldAlias' => [
                'sender' => 'message_from_user.first_name',
                'receiver' => 'message_to_user.first_name',
                'send_on' => 'chats.created_at'
            ],
            'searchable' => [   
                /* 'title',
                'content' */
            ]
        ];
        
        return ChatModel::whereNotIn('chats.type', [9, 10, 11])
        ->join('users AS message_from_user', 'chats.from_users__id', '=', 'message_from_user._id')
        ->leftJoin('user_profiles AS message_from_user_profile', 'message_from_user._id', '=', 'message_from_user_profile.users__id')
        ->join('users AS message_to_user', 'chats.to_users__id', '=', 'message_to_user._id')
        ->leftJoin('user_profiles AS message_to_user_profile', 'message_to_user._id', '=', 'message_to_user_profile.users__id')
        ->select(
            \__nestedKeyValues([
                'chats' => [
                    '_id',
                    '_uid',
                    'created_at',
                    'status',
                    'message',
                    'type',
                    'from_users__id',
                    'to_users__id',
                    'users__id'
                ],
                'message_from_user' => [
                    '_id AS message_from_user_id',
                    '_uid AS message_from_user_uid',
                    'first_name AS message_from_first_name',
                    'last_name AS message_from_last_name'
                ],
                'message_to_user' => [
                    '_id AS message_to_user_id',
                    '_uid AS message_to_user_uid',
                    'first_name AS message_to_first_name',
                    'last_name AS message_to_last_name'
                ],
                'message_from_user_profile' => [
                    'users__id AS message_from_user_profile_user_id',
                    'profile_picture AS message_from_user_profile_picture'
                ],
                'message_to_user_profile' => [
                    'users__id AS message_to_user_profile_user_id',
                    'profile_picture AS message_to_user_profile_picture'
                ]
            ])
        )->dataTables($dataTableConfig)->toArray();
    }
}