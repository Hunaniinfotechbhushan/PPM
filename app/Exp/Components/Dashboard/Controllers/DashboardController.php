<?php
/*
* DashboardController.php - Controller file
*
* This file is part of the Dashboard component.
*-----------------------------------------------------------------------------*/

namespace App\Exp\Components\Dashboard\Controllers;

use App\Exp\Base\BaseController;
use App\Exp\Components\Dashboard\DashboardEngine;

class DashboardController extends BaseController 
{    
    /**
     * @var  DashboardEngine $dashboardEngine - Dashboard Engine
     */
    protected $dashboardEngine;

    /**
      * Constructor
      *
      * @param  DashboardEngine $dashboardEngine - Dashboard Engine
      *
      * @return  void
      *-----------------------------------------------------------------------*/

    function __construct(DashboardEngine $dashboardEngine)
    {
        $this->dashboardEngine = $dashboardEngine;
    }

	/**
     * Show dashboard view.
     *---------------------------------------------------------------- */
    public function loadDashboardView()
    {
    	$data = $this->dashboardEngine->prepareDashboard();

        return $this->loadManageView('dashboard.dashboard', $data);
	}
}