<?php
/*
* HomeController.php - Controller file
*
* This file is part of the Home component.
*-----------------------------------------------------------------------------*/

namespace App\Exp\Components\Home\ApiControllers;

use App\Exp\Base\BaseController; 
use App\Exp\Components\Home\HomeEngine;
use App\Exp\Components\User\UserEncounterEngine;
use App\Exp\Components\Filter\FilterEngine;
use App\Exp\Support\CommonUnsecuredPostRequest;
use App\Exp\Components\Pages\ManagePagesEngine;

class ApiHomeController extends BaseController 
{    
    /**
     * @var  HomeEngine $homeEngine - Home Engine
     */
    protected $homeEngine;

    /**
     * @var  UserEncounterEngine $userEncounterEngine - UserEncounter Engine
     */
    protected $userEncounterEngine;
    
    /**
     * @var  FilterEngine $filterEngine - Filter Engine
     */
    protected $filterEngine;

    /**
     * @var  ManagePagesEngine $managepageEngine - Manage Pages Engine
     */
    protected $managepageEngine;

    /**
      * Constructor
      *
      * @param  HomeEngine $homeEngine - Home Engine
      * @param  ManagePagesEngine $managepageEngine - Manage Pages Engine
      *
      * @return  void
      *-----------------------------------------------------------------------*/

    function __construct(
        HomeEngine $homeEngine,
        UserEncounterEngine $userEncounterEngine,
        FilterEngine $filterEngine,
        ManagePagesEngine $managepageEngine
    )
    {
        $this->homeEngine           = $homeEngine;
        $this->userEncounterEngine  = $userEncounterEngine;
        $this->filterEngine         = $filterEngine;
        $this->managepageEngine         = $managepageEngine;
    }

     /**
     * View Home Page
     *---------------------------------------------------------------- */
    public function getHomePageData()
    {
        // get encounter data
        $processReaction = $this->userEncounterEngine->getEncounterUserData();
       

        return $this->processResponse($processReaction, [], [], true);
    }

    /**
     * View Home Page
     *---------------------------------------------------------------- */
    public function getRandomUsers()
    {
        // For Random search use following function
        $processReaction = $this->filterEngine->prepareRandomUserData([], 12);
       

        return $this->processResponse($processReaction, [], [], true);
    }
}