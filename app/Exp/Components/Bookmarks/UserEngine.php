<?php
/*
* UserEngine.php - Main component file
*
* This file is part of the User component.
*-----------------------------------------------------------------------------*/

namespace App\Exp\Components\Bookmarks;
use Auth;
use Cookie;
use Hash;
use YesSecurity;
use Session;
use PushBroadcast;
use Carbon\Carbon;
use App\Exp\Base\BaseEngine;
use App\Exp\Base\BaseMailer;
use App\Exp\Components\Media\MediaEngine;
use App\Exp\Components\Bookmarks\Repositories\{UserRepository, CreditWalletRepository, UserEncounterRepository};
use App\Exp\Components\UserSetting\Repositories\UserSettingRepository;
use App\Exp\Components\Item\Repositories\ManageItemRepository;
use App\Exp\Components\AbuseReport\Repositories\ManageAbuseReportRepository;
use App\Exp\Support\Country\Repositories\CountryRepository;
use App\Exp\Support\CommonTrait;
use \Illuminate\Support\Facades\URL;
use YesTokenAuth;
use App\Exp\Support\Utils;
use App\Exp\Components\Bookmarks\Models\User;
use App\Exp\Components\Bookmarks\Models\UserProfile;
use App\Exp\Components\Bookmarks\Models\UserTag;
use App\Exp\Components\Bookmarks\Models\AnnualIncome;
use App\Exp\Components\Bookmarks\Models\Ethnicity;
use App\Exp\Components\Bookmarks\Models\Education;
use App\Exp\Components\Bookmarks\Models\Occupation;
use App\Exp\Components\Bookmarks\Models\RelationshipStatus;
use App\Exp\Components\Bookmarks\Models\BodyType;
use App\Exp\Components\Bookmarks\Models\NetWorth;



class UserEngine extends BaseEngine
{
    /**
     * @var CommonTrait - Common Trait
     */
    use CommonTrait;

    /**
     * @var UserRepository - User Repository
     */
    protected $userRepository;

    /**
     * @var BaseMailer - Base Mailer
     */
    protected $baseMailer;

    /**
     * @var  UserSettingRepository $userSettingRepository - UserSetting Repository
     */
    protected $userSettingRepository;

	/**
     * @var ManageItemRepository - ManageItem Repository
     */
	protected $manageItemRepository;

	 /**
     * @var  CreditWalletRepository $creditWalletRepository - CreditWallet Repository
     */
	 protected $creditWalletRepository;

	/**
     * @var ManageAbuseReportRepository - ManageAbuseReport Repository
     */
	protected $manageAbuseReportRepository;

	 /**
     * @var  UserEncounterRepository $userEncounterRepository - UserEncounter Repository
     */
	 protected $userEncounterRepository;

    /**
     * @var  CountryRepository $countryRepository - Country Repository
     */
    protected $countryRepository;

    /**
     * @var  MediaEngine $mediaEngine - Media Engine
     */
    protected $mediaEngine;

    /**
     * Constructor.
     * @param  CreditWalletRepository $creditWalletRepository - CreditWallet Repository
     * @param UserRepository  $userRepository  - User Repository
     * @param BaseMailer  $baseMailer  - Base Mailer
     * @param  UserSettingRepository $userSettingRepository - UserSetting Repository
     * @param ManageItemRepository $manageItemRepository - ManageItem Repository
     * @param  CountryRepository $countryRepository - Country Repository
     * 
     *-----------------------------------------------------------------------*/
    public function __construct(
    	BaseMailer  $baseMailer,
    	UserRepository $userRepository,
    	UserSettingRepository $userSettingRepository,
    	ManageItemRepository $manageItemRepository,
    	CreditWalletRepository $creditWalletRepository,
    	ManageAbuseReportRepository $manageAbuseReportRepository,
    	UserEncounterRepository $userEncounterRepository,
    	CountryRepository $countryRepository,
    	MediaEngine $mediaEngine
    ) {
    	$this->baseMailer        	        = $baseMailer;
    	$this->userRepository        	    = $userRepository;
    	$this->userSettingRepository        = $userSettingRepository;
    	$this->manageItemRepository 	    = $manageItemRepository;
    	$this->creditWalletRepository 	    = $creditWalletRepository;
    	$this->manageAbuseReportRepository 	= $manageAbuseReportRepository;
    	$this->userEncounterRepository 	    = $userEncounterRepository;
    	$this->countryRepository            = $countryRepository;
    	$this->mediaEngine                  = $mediaEngine;
    }

	/**
     * Process user login request using user repository & return
     * engine reaction.
     *
     * @param array $input
     *
     * @return array
     *---------------------------------------------------------------- */

public function processBookmarksUser($inputData)
	{
		echo 'jjjj';
		die;

	}

	
}