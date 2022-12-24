<?php
/*
* ApiNotificationController.php - Controller file
*
* This file is part of the Notification component.
*-----------------------------------------------------------------------------*/

namespace App\Exp\Components\Notification\ApiControllers;

use App\Exp\Support\CommonPostRequest;
use App\Exp\Base\BaseController;
use App\Exp\Components\Notification\NotificationEngine;

class ApiNotificationController extends BaseController
{
     /**
     * @var NotificationEngine - Notification Engine
     */
    protected $notificationEngine;

    /**
     * Constructor.
     *
     * @param NotificationEngine $notificationEngine - Notification Engine
     *-----------------------------------------------------------------------*/
    public function __construct(NotificationEngine $notificationEngine)
    {
        $this->notificationEngine = $notificationEngine;
    }

    /**
     * Get Notification DataTable data.
     *
     *-----------------------------------------------------------------------*/
    public function getNotificationList()
    {
        return $this->notificationEngine->prepareApiNotificationList();
    }

    /**
     * Handle read all notification request.
     *
     * @param object read notification $request
     * @param string $reminderToken
     *
     * @return json object
     *---------------------------------------------------------------- */
    public function getNotificationData()
    {
        $processReaction = $this->notificationEngine->prepareNotificationData();

        return $this->processResponse($processReaction, [], [], true);
    }

    /**
     * Handle read all notification request.
     *
     * @param object read notification $request
     * @param string $reminderToken
     *
     * @return json object
     *---------------------------------------------------------------- */
    public function readAllNotification()
    {
        $processReaction = $this->notificationEngine->processReadAllNotification();

        return $this->processResponse($processReaction, [], [], true);
    }
}