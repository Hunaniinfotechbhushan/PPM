<?php

namespace App\Exp\Support;
use Carbon\Carbon;

/**
 * This CommonTrait class.
 *---------------------------------------------------------------- */
trait CommonTrait
{
	/*
      * Get User Specification Config Items
      *
      * @return boolean.
      *-------------------------------------------------------- */
    public static function getUserSettingConfigItem()
    {
        return require app_path('Exp/Components/UserSetting/Config/userSetting.php');
    }

    /*
      * Get User Specification Config Items
      *
      * @return boolean.
      *-------------------------------------------------------- */
    public function getUserSpecificationConfig()
    {
        return require app_path('Exp/Components/UserSetting/Config/specification.php');
    }

	/*
      * Get User Setting Config Items
      *
      * @return boolean.
      *-------------------------------------------------------- */
    public function getUserSettingConfig()
    {
        return self::getUserSettingConfigItem();
    }

	/**
     * Cast User Settings Value
     *
     * @param integer $dataType
     * @param string $itemValue
     * 
     * @return array
     *---------------------------------------------------------------- */
    protected function castValue($dataType, $itemValue) 
    {
        switch ($dataType) {
            case 1:
            return (string) $itemValue;
            break;
            case 2:
            return (bool) $itemValue;
            break;
            case 3:
            return (int) $itemValue;
            break;
            case 4:
            return ((!__isEmpty($itemValue)) and (!is_array($itemValue))) 
            ? json_decode($itemValue, true) : $itemValue;
            break;
            case 5:
            return ((!__isEmpty($itemValue)) and (is_array($itemValue))) 
            ? json_encode($itemValue) : '';
            break;
            default:
            return $itemValue;
        }
    }

	/**
     * Prepare Data For Configuration.
     *
     * @param array $dbConfigurationSettings
     * @param array $defaultSetting
     *
     * @return array
     *---------------------------------------------------------------- */
    protected function prepareDataForConfiguration($dbConfigurationSettings, $defaultSetting)
    {
        $isHideValue = array_get($defaultSetting, 'hide_value', false);
        // Check if a value is hidden for show on view
        if ($isHideValue) {
            return (!__isEmpty(array_get($dbConfigurationSettings, $defaultSetting['key'])))
            ? true : false;
        }
        return array_get($dbConfigurationSettings, $defaultSetting['key'], $defaultSetting['default']);
    }

	/**
     * Get configuration default Settings.
     *
     * @return array
     *---------------------------------------------------------------- */
    protected function getDefaultSettings($configItem) 
    {
        $defaultSettings = $configItem;
        // check if default settings exists
        if (__isEmpty($defaultSettings)) {
            return null;
        }
        
        foreach($defaultSettings as $settingKey => $settingValue) {
            $defaultSettings[$settingKey]['default'] = $this->castValue($settingValue['data_type'], $settingValue['default']);
        }
        
        return $defaultSettings;
    }
    
    /**
     * Prepare User Array Data.
     *
     *-----------------------------------------------------------------------*/
    public function getUserOnlineStatus($userLastActivity) 
    {
        $userOnlineStatus = null;
        $dtSubTenMinute = Carbon::now()->subMinutes(10)->toDateTimeString();
        $dtSubFiveMinute = Carbon::now()->subMinutes(5)->toDateTimeString();
        $dtSubTwoMinute = Carbon::now()->subMinutes(2)->toDateTimeString();
        //check user last login less than sub 2 minute on current datetime condition is false
        //then user is online
        if (!$userLastActivity < $dtSubTwoMinute) {
            $userOnlineStatus = 1;
        }
        //check user last login less than sub 2 minute on current datetime condition is true
        //then user is idle
        if ($userLastActivity < $dtSubTwoMinute) {
            $userOnlineStatus = 2;
        }
        //check user last login less than sub 5 minute on current datetime condition is true
        //then user is offline
        if ($userLastActivity < $dtSubFiveMinute) {
            $userOnlineStatus = 3;
        }
        if ($userLastActivity < $dtSubTenMinute) {
            $userOnlineStatus = 4;
        }


        return $userOnlineStatus;
    }


    public function getUserOnlineStatusAgo($userLastActivity) 
    {
        $userOnlineStatusago = null;
        $dtSub1Minute = Carbon::now()->subMinutes(1)->toDateTimeString();
        $dtSub5Minute = Carbon::now()->subMinutes(5)->toDateTimeString();
        $dtSub10Minute = Carbon::now()->subMinutes(10)->toDateTimeString();
        $dtSub20Minute = Carbon::now()->subMinutes(20)->toDateTimeString();
        $dtSub30Minute = Carbon::now()->subMinutes(30)->toDateTimeString();
        $dtSub60Minute = Carbon::now()->subMinutes(60)->toDateTimeString();
        $dtSub120Minute = Carbon::now()->subMinutes(120)->toDateTimeString();
        $dtSub180Minute = Carbon::now()->subMinutes(180)->toDateTimeString();
        $dtSub240Minute = Carbon::now()->subMinutes(240)->toDateTimeString();
        $dtSub480Minute = Carbon::now()->subMinutes(480)->toDateTimeString();
        $dtSub720Minute = Carbon::now()->subMinutes(720)->toDateTimeString();
        $dtSub960Minute = Carbon::now()->subMinutes(960)->toDateTimeString();
        $dtSub1440Minute = Carbon::now()->subMinutes(1440)->toDateTimeString();
            $dtSub10080Minute = Carbon::now()->subMinutes(10080)->toDateTimeString(); //1 week
            $dtSub43200Minute = Carbon::now()->subMinutes(43200)->toDateTimeString(); // 1 month

        //check user last login less than sub 2 minute on current datetime condition is false
        //then user is online
            if ($userLastActivity < $dtSub1Minute) {
                $userOnlineStatusago = '1 mints ago';
            }
            if ($userLastActivity < $dtSub5Minute) {
                $userOnlineStatusago = '5 mints ago';
            }
            if ($userLastActivity < $dtSub10Minute) {
                $userOnlineStatusago = '10 mints ago';
            }
            if ($userLastActivity < $dtSub20Minute) {
                $userOnlineStatusago = '20 mints ago';
            }

            if (!$userLastActivity < $dtSub30Minute) {
                $userOnlineStatusago = '30 mints ago';
            }
        //check user last login less than sub 2 minute on current datetime condition is true
        //then user is idle

        //check user last login less than sub 5 minute on current datetime condition is true
        //then user is offline
            if ($userLastActivity < $dtSub60Minute) {
                $userOnlineStatusago = '1 Hours ago';
            }
            if ($userLastActivity < $dtSub120Minute) {
                $userOnlineStatusago = '2 Hours ago';
            }
            if ($userLastActivity < $dtSub180Minute) {
                $userOnlineStatusago = '3 Hours ago';
            }
            if ($userLastActivity < $dtSub240Minute) {
                $userOnlineStatusago = '4 Hours ago';
            }

            if ($userLastActivity < $dtSub480Minute) {
                $userOnlineStatusago = '8 Hours ago';
            }
            if ($userLastActivity < $dtSub720Minute) {
                $userOnlineStatusago = '12 Hours ago';
            }

            if ($userLastActivity < $dtSub960Minute) {
                $userOnlineStatusago = '16 Hours ago';
            }

            if ($userLastActivity < $dtSub1440Minute) {
                $userOnlineStatusago = '1 Day ago';
            }   

            if ($userLastActivity < $dtSub10080Minute) {
                $userOnlineStatusago = '1 Week ago';
            }       

            if ($userLastActivity < $dtSub43200Minute) {
                $userOnlineStatusago = 'Month ago';
            }       



            return $userOnlineStatusago;
        }



        public function timeAgo($userLastActivity) 
        {
          $userOnlineStatusago = null;
          $dtSub1Minute = Carbon::now()->subMinutes(1)->toDateTimeString();
          $dtSub2Minute = Carbon::now()->subMinutes(2)->toDateTimeString();
          $dtSub5Minute = Carbon::now()->subMinutes(5)->toDateTimeString();
          $dtSub10Minute = Carbon::now()->subMinutes(10)->toDateTimeString();
          $dtSub20Minute = Carbon::now()->subMinutes(20)->toDateTimeString();
          $dtSub30Minute = Carbon::now()->subMinutes(30)->toDateTimeString();
          $dtSub60Minute = Carbon::now()->subMinutes(60)->toDateTimeString();
          $dtSub120Minute = Carbon::now()->subMinutes(120)->toDateTimeString();
          $dtSub180Minute = Carbon::now()->subMinutes(180)->toDateTimeString();
          $dtSub240Minute = Carbon::now()->subMinutes(240)->toDateTimeString();
          $dtSub480Minute = Carbon::now()->subMinutes(480)->toDateTimeString();
          $dtSub720Minute = Carbon::now()->subMinutes(720)->toDateTimeString();
          $dtSub960Minute = Carbon::now()->subMinutes(960)->toDateTimeString();
          $dtSub1440Minute = Carbon::now()->subMinutes(1440)->toDateTimeString();
            $dtSub10080Minute = Carbon::now()->subMinutes(10080)->toDateTimeString(); //1 week
            $dtSub43200Minute = Carbon::now()->subMinutes(43200)->toDateTimeString(); // 1 month

        //check user last login less than sub 2 minute on current datetime condition is false
        //then user is online
            if ($userLastActivity < $dtSub1Minute) {
                $userOnlineStatusago = 'Online';
            }
              if ($userLastActivity < $dtSub2Minute) {
                $userOnlineStatusago = '2 mints ago';
            }
            if ($userLastActivity < $dtSub5Minute) {
                $userOnlineStatusago = '5 mints ago';
            }
            if ($userLastActivity < $dtSub10Minute) {
                $userOnlineStatusago = '10 mints ago';
            }
            if ($userLastActivity < $dtSub20Minute) {
                $userOnlineStatusago = '20 mints ago';
            }

            if (!$userLastActivity < $dtSub30Minute) {
                $userOnlineStatusago = '30 mints ago';
            }
        //check user last login less than sub 2 minute on current datetime condition is true
        //then user is idle

        //check user last login less than sub 5 minute on current datetime condition is true
        //then user is offline
            if ($userLastActivity < $dtSub60Minute) {
                $userOnlineStatusago = '1 Hours ago';
            }
            if ($userLastActivity < $dtSub120Minute) {
                $userOnlineStatusago = '2 Hours ago';
            }
            if ($userLastActivity < $dtSub180Minute) {
                $userOnlineStatusago = '3 Hours ago';
            }
            if ($userLastActivity < $dtSub240Minute) {
                $userOnlineStatusago = '4 Hours ago';
            }

            if ($userLastActivity < $dtSub480Minute) {
                $userOnlineStatusago = '8 Hours ago';
            }
            if ($userLastActivity < $dtSub720Minute) {
                $userOnlineStatusago = '12 Hours ago';
            }

            if ($userLastActivity < $dtSub960Minute) {
                $userOnlineStatusago = '16 Hours ago';
            }

            if ($userLastActivity < $dtSub1440Minute) {
                $userOnlineStatusago = '1 Day ago';
            }   

            if ($userLastActivity < $dtSub10080Minute) {
                $userOnlineStatusago = '1 Week ago';
            }       

            if ($userLastActivity < $dtSub43200Minute) {
                $userOnlineStatusago = 'Month ago';
            }       



            return $userOnlineStatusago;
        }


        function ageCalculator($dob){
            if(!empty($dob)){
                $birthdate = new DateTime($dob);
                $today   = new DateTime('today');
                $age = $birthdate->diff($today)->y;
                return $age;
            }else{
                return 0;
            }
        }

    }