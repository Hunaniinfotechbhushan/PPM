<?php
/*
* UserEncounterController.php - Controller file
*
* This file is part of the UserEncounter User component.
*-----------------------------------------------------------------------------*/

namespace App\Exp\Components\Sitemap\Controllers;

use App\Exp\Base\BaseController;
use App\Exp\Support\CommonUnsecuredPostRequest;
use App\Exp\Components\Event\UserEncounterEngine;
use Request;
use Auth;
// form Requests
use App\Exp\Support\CommonPostRequest;
use App\Exp\Components\Event\UserEngine;


use App\Exp\Components\Event\Models\Event;
use App\Exp\Components\Event\Models\InterestedUser;
use App\Exp\Components\Pages\Models\PageModel;





class SitemapController extends BaseController 
{  
    public function index(CommonUnsecuredPostRequest $request){

    
         
         $PageModel = PageModel::all();
           return response()->view('sitemap.index', [
            'sitemap' => $PageModel,
        ])->header('Content-Type', 'text/xml');
        
      }
      
    

}