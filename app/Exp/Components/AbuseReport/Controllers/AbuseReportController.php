<?php
/*
* AbuseReportController.php - Controller file
*
* This file is part of the Abuse Report component.
*-----------------------------------------------------------------------------*/

namespace App\Exp\Components\AbuseReport\Controllers;

use App\Exp\Base\BaseController;
use App\Exp\Components\AbuseReport\ManageAbuseReportEngine;
use App\Exp\Components\AbuseReport\Requests\{ModerateAbuseReportRequest};

class AbuseReportController extends BaseController
{
	/**
     * @var ManageAbuseReportEngine - ManageAbuseReport Engine
     */
	protected $manageAbuseReportEngine;

    /**
     * Constructor.
     *
     * @param ManageAbuseReportEngine $manageAbuseReportEngine - ManageReport Engine
     *-----------------------------------------------------------------------*/
    public function __construct(ManageAbuseReportEngine $manageAbuseReportEngine)
    {
        $this->manageAbuseReportEngine = $manageAbuseReportEngine;
	}

	/**
     * Show Report List View.
     *
     *-----------------------------------------------------------------------*/
    public function reportListView($status)
    {
		$processReaction = $this->manageAbuseReportEngine->prepareReportList($status);

        return $this->loadManageView('abuse-report.manage.list', $processReaction['data']);
	}

	/**
     * Handle moderate report request.
     *
     * @param ModerateAbuseReportRequest $request
     *
     * @return json response
     *---------------------------------------------------------------- */
    public function reportModerated(ModerateAbuseReportRequest $request)
    {
        $processReaction = $this->manageAbuseReportEngine
								->processModerateReport($request->all());
								
		return $this->responseAction(
			$this->processResponse($processReaction, [], [], true)
		);
	}
}