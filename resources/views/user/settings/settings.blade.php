@extends('public-master')
@section('content')
<div class="lw-page-content px-2">

    <style type="text/css">
        .form-control.error {
            width: 100%;
        }

        .error {
            color: #e74a3b;
        }
        #email2-error {
            width: 100%;
        }

        p.setting-list {
            font-size: 1rem;
        }
        span.web {
            font-size: 16px;
            color: #000;
        }
        span.web-test {
            font-size: 16px;
        }
        .inner-main {
            padding: 0px 30px;
        }
        .sett-title {
            color: rgb(71, 71, 71);
            font-size: 18px;
            font-weight: 800;
            line-height: 22px;
            margin: 20px 0px;
            font-family: 'source sans pro,HelveticaNeue,Helvetica,Arial,Sans';
        }
        .css-textarea {
            font-size: 16px;
            line-height: 22px;
            margin: 0px;
        }
        .css-btm {
            margin: 40px 0px;
        }
        .inner-con i.fa-brands {
            font-size: 30px;
        }
        button.css-btn {
            border-radius: 2px;
            display: inline-flex;
            -webkit-box-align: center;
            align-items: center;
            -webkit-box-pack: center;
            justify-content: center;
            box-sizing: border-box;
            padding: 12px 16px;
            font-family: "Source Sans Pro", HelveticaNeue, Helvetica, Arial, Sans;
            font-size: 16px;
            font-weight: 700;
            line-height: 1;
            outline: none;
            cursor: pointer;
            white-space: nowrap;
            width: 100%;
            border: rgb(207, 4, 4);
            background-color: rgb(207, 4, 4);
            color: rgb(255, 255, 255);
            margin: 0px auto;
            text-overflow: ellipsis;
            overflow: hidden;
            width: 270px !important;
            display: inline-block !important;
        }
        .css-btm-con {
            margin-top: 40px;
        }

        .grouped-inner label {
            font-size: 18px;
            font-weight: bold;
            max-height: 114px;
            padding-left: 16px !important;
            box-shadow: rgb(230 230 230) 0px 1px 0px 0px inset, rgb(230 230 230) 0px 1px 0px 0px inset;
            background-color: rgb(247, 247, 247) !important;
            border: none !important;
            text-align: left !important;
            padding: 34px 16px !important;
            width: 100%;
            padding-left: 5!important;
            padding-right: 0!important;
            margin-left: 0!important;
            margin-right: 0!important;
            text-align: center;
            -webkit-box-pack: center;
            -ms-flex-pack: center;
            justify-content: center;
        }
        .grouped-inner label.active {
            border-right: 0px;
            border-bottom: 0px;
            border-image: initial;
            box-shadow: none;
            background-color: rgb(255, 255, 255) !important;
            border-top: 1px solid rgb(230, 230, 230) !important;
            border-left: 1px solid rgb(230, 230, 230) !important;
            border-radius: 3px !important;
        }


        .tabordion_settings{
            position: relative;  
            margin: 30px 0px !important;  
        }
        .tabordion_settings input[name="sections"] {
          left: -9999px;
          position: absolute;
          top: -9999px;
      }

      .tabordion_settings section {
          display: block;
      }

      .tabordion_settings section label {
          background: #ccc;
          border:1px solid #fff;
          cursor: pointer;
          display: block;
          font-size: 1.2em;
          font-weight: bold;
          padding: 15px 20px;
          position: relative;
          width: 30%;
          z-index:100;
      }
      .grouped-inner {
        display: flex;
        flex-direction: row;
    }
    .inner-con { 
        position: absolute;
        top: 0;
        left: 230px;   
        border-radius: 0px 4px 4px 0px;
        border-top: 1px solid rgb(230, 230, 230) !important;
        border-right: 1px solid rgb(230, 230, 230) !important;
        border-bottom: 1px solid rgb(230, 230, 230) !important;
        border-left: none !important;
        padding: 1em 1em;
        height: 100%;
    }

/*Social Media*/
.css-1ffo5h7 {
    display: flex;
    flex-direction: column;
    align-items: center;
    margin-top: 24px;
}
button.css-12vin3e {
    min-width: 288px;
    margin-top: 16px;
    border-radius: 2px;
    display: inline-flex;
    -webkit-box-align: center;
    align-items: center;
    -webkit-box-pack: center;
    justify-content: center;
    box-sizing: border-box;
    padding: 10px 16px;
    font-family: "Source Sans Pro", HelveticaNeue, Helvetica, Arial, Sans;
    font-size: 16px;
    font-weight: 700;
    line-height: 1;
    outline: none;
    cursor: pointer;
    white-space: nowrap;
    background: rgb(255, 255, 255);
    color: rgb(66, 66, 66);
    border: 1px solid rgb(204, 204, 204);
}
/*photo-verification*/
.css-12vin3e:disabled {
    color: rgb(153, 153, 153);
    border-color: rgb(153, 153, 153);
}
</style>
<!-- header advertisement -->
<style>
  select#floatingSelect{
      box-sizing: border-box;
      width: 36%;
      appearance: none;
      font-family: "Source Sans Pro", HelveticaNeue, Helvetica, Arial, Sans;
      border-radius: 4px;
      border: 1px solid rgb(204, 204, 204);
      font-size: 16px;
      background-color: rgb(255, 255, 255);
      outline: none;
      box-shadow: none;
      white-space: pre-wrap;
      background-image: linear-gradient(45deg, transparent 50%, rgb(66, 66, 66) 50%), linear-gradient(135deg, rgb(66, 66, 66) 50%, transparent 50%);
      background-position: calc(100% - 20px) center, calc(100% - 15px) center, calc(100% - 2.5em) 0.5em;
      background-size: 5px 5px, 5px 5px, 1px 1.5em;
      background-repeat: no-repeat;
  }
  select#floatingSelect {
      height: auto;
      padding: 10px 28px 10px 16px;
  }
  label {
      display: inline-block;
      margin-bottom: 0.5rem;
      margin-top: 1rem;
  }
  label.web {
      color: #000;
      font-size: 16px;
  }
  span.web-test {
      font-size: 16px;
  }
  .d-flex.webtech.py-2 {
      border-bottom: 1px solid #bdbdbd;
      padding: 10px 0;
  }
  .activity-section {
    border-top: 1px solid #bdbdbd;
    padding-top: 40px;
}
/* ***************notification css******************** */
.Panel {
    background-color: #fff;
    border: 1px solid #d9d9d9;
    padding: 0;
    border-radius: 3px;
    box-shadow: 0 1px 1px #0000001a;
    border-color: transparent;
    margin-bottom: 1rem;
    position: relative;
}
#random-glamor-id-5561669341138034 .css-5yv5d9, #random-glamor-id-5561669341138034 [data-css-5yv5d9] {
    margin: 1rem 1rem 0px;
    font-weight: 600;
    font-size: 20px;
}
.Panel-block {
    padding: 1rem 0;
}
.css-fgicdg {
    display: inline-flex;
    font-family: "Source Sans Pro", HelveticaNeue, Helvetica, Arial, Sans;
    color: rgb(66, 66, 66);
    font-size: 16px;
    cursor: pointer;
    font-weight: normal;
    padding: 0px;
    margin: 0px;
    position: relative;
}
h5.css-5yv5d9 {
    font-weight: 500;
}
ul, ol {
    margin: 0;
    list-style: none;
    padding: 0;
}
.css-74frd3 {
    position: absolute;
    display: none;
    cursor: pointer;
}
.css-oshlpk {
    display: block;
    margin-left: 28px;
}
.css-74frd3:checked + span::before {
    background-color: rgb(255, 255, 255);
    background-image: url("data:image/svg+xml,%3C%3Fxml version='1.0' encoding='UTF-8'%3F%3E%3Csvg width='18px' height='18px' viewBox='0 0 18 18' version='1.1' xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink'%3E%3C!-- Generator: sketchtool 58 (101010) - https://sketch.com --%3E%3Ctitle%3ED6AD90D6-DE7C-4AFE-88CE-AACBCB40A866%3C/title%3E%3Cdesc%3ECreated with sketchtool.%3C/desc%3E%3Cg id='Responsive-Web' stroke='none' stroke-width='1' fill='000000' fill-rule='evenodd'%3E%3Cg id='Global-Style' transform='translate(-907.000000, -3872.000000)'%3E%3Cg id='Iconography' transform='translate(80.000000, 3648.000000)'%3E%3Cg id='Checkmark' transform='translate(795.000000, 202.000000)'%3E%3Cg id='Icon/Search-Icon/Checkmark-Circle' transform='translate(32.000000, 22.000000)'%3E%3Cg id='Group'%3E%3Cg id='checkmark' transform='translate(3.000000, 4.000000)' fill='%23000000'%3E%3Cpath d='M9.38500492,0.458573639 L3.96877198,5.98021288 L2.61499508,4.59980307 C2.01669246,3.99212266 1.04665448,3.99212266 0.448726966,4.59980307 C-0.149575655,5.21123459 -0.149575655,6.20152858 0.448726966,6.80920898 L2.88582548,9.29619731 C3.4841281,9.90762883 4.45379097,9.90762883 5.05209359,9.29619731 L11.551273,2.66797956 C12.1495757,2.05654804 12.1495757,1.06625404 11.551273,0.458573639 C10.9529704,-0.15285788 9.98330754,-0.15285788 9.38500492,0.458573639 Z'%3E%3C/path%3E%3C/g%3E%3C/g%3E%3C/g%3E%3C/g%3E%3C/g%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
    background-size: auto;
    background-position: center center;
    border-color: rgb(153, 153, 153);
}
.css-oshlpk::before {
    content: " ";
    position: absolute;
    box-sizing: border-box;
    top: 50%;
    transform: translateY(-50%);
    left: 0px;
    height: 17px;
    width: 17px;
    background-color: rgb(255, 255, 255);
    border-radius: 4px;
    border: 1px solid rgb(153, 153, 153);
}
.css-ldzv7o {
    color: rgb(207, 4, 4);
    text-decoration: underline;
    margin: 1rem;
    display: inline-block;
    padding-right: 20px;
}
.css-1777odk {
    cursor: pointer;
    padding-right: 20px;
}
.css-fgicdg {
    display: inline-flex;
    font-family: "Source Sans Pro", HelveticaNeue, Helvetica, Arial, Sans;
    color: rgb(66, 66, 66);
    font-size: 15px;
    cursor: pointer;
    font-weight: normal;
    padding: 0px;
    margin: 0px;
    position: relative;
}
/==============hidden-members ====================/
.Panel {
    background-color: #fff;
    border: 1px solid #d9d9d9;
    padding: 0;
    border-radius: 3px;
    box-shadow: 0 1px 1px #0000001a;
    border-color: transparent;
    margin-bottom: 1rem;
    position: relative;
}
.ContentPlaceholder--lrg {
    padding: 6rem 7.5rem;
}
.ContentPlaceholder-header {
    margin-bottom: .75rem;
    font-size: 1.5rem;
}
p:last-child {
    margin-bottom: 0;
    font-size: 16px;
    text-decoration: underline;
}
.Panel-block {
    padding: 1rem 0 !important;
}

/* ================video  chat permission=============================== */
.FormGroup {
    margin-bottom: 1rem;
}
.ControlGroup-content-title label {
    margin-bottom: 1rem;
}
label, .label {
    display: inline-block;
}
.ControlGroup-btn-content ul {
    display: table;
}
.ControlGroup-btn-content ul .left-btn {
    padding-right: 1rem;
}
.ControlGroup-btn-content ul li {
    display: table-cell;
    vertical-align: middle;
}
.css-7a2p7m {
    height: 44px;
    display: flex;
    width: 196px;
    box-sizing: border-box;
    border-radius: 4px;
}
.css-7a2p7m label {
    cursor: pointer;
    width: 98px;
    background: rgb(255, 255, 255);
}
.css-7a2p7m label input {
    display: none;
}
.css-7a2p7m label:first-of-type span {
    border-radius: 4px 0px 0px 4px;
    border-right: 0px;
}
.css-7a2p7m label span {
    display: flex;
    padding: 12px 8px;
    box-sizing: border-box;
    -webkit-box-align: center;
    align-items: center;
    width: 100%;
    font-weight: 700;
    text-align: center;
    font-family: "Source Sans Pro", HelveticaNeue, Helvetica, Arial, Sans;
    -webkit-box-pack: center;
    justify-content: center;
    height: 44px;
    max-width: 100%;
    color: rgb(153, 153, 153);
    border: 1px solid rgb(231, 231, 231);
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}
.css-7a2p7m label input:checked + span {
    background: rgb(207, 4, 4);
    color: rgb(255, 255, 255);
    border: 1px solid rgb(207, 4, 4);
}
label.fw-bolder {
    font-weight: 600;
}
.PageHeader {
    margin-bottom: 1.5rem;
    padding-left: 0;
    padding-right: 0;
}
.PageHeader-title {
    padding-top: .75rem;
    margin-bottom: .75rem;
    font-size: 1.5rem;
}
/* ================security information================= */
.title h5 {
    font-size: 14px;
    font-weight: 400;
}
label.fw-bolder {
    font-weight: 600;
    font-size: 16px;
}
.css-ouo77o:hover {
    background-color: rgb(222, 4, 4);
}
.css-ouo77o {
    border-radius: 2px;
    display: inline-flex;
    -webkit-box-align: center;
    align-items: center;
    -webkit-box-pack: center;
    justify-content: center;
    box-sizing: border-box;
    padding: 12px 16px;
    font-family: "Source Sans Pro", HelveticaNeue, Helvetica, Arial, Sans;
    font-size: 16px;
    font-weight: 700;
    line-height: 1;
    outline: none;
    cursor: pointer;
    white-space: nowrap;
    border: rgb(207, 4, 4);
    background-color: rgb(207, 4, 4);
    color: rgb(255, 255, 255);
}
span.web-test {
    font-size: 16px;
    padding-left: 7rem;
}
span.web-test1 {
    padding-left: 5rem;
}
/* =================help center====================== */
.css-xgow36 {
    background: rgb(255, 255, 255);
    padding: 16px;
    box-shadow: rgba(0, 0, 0, 0.1) 0px 1px 1px;
    border-radius: 0px 0px 6px 6px;
}
.css-13ih39a {
    font-weight: 600;
    font-size: 16px;
}
.css-1vvrzwm {
    height: 1px;
    width: 100%;
    background: rgb(255, 255, 255);
    box-shadow: rgb(217, 217, 217) 0px 1px 0px 0px;
    margin: 24px 0px;
}
.css-i3pbo {
    margin-bottom: 24px;
}
.css-2nqlxv:first-of-type {
    margin-top: 16px;
}
.css-6bh5qj {
    display: flex;
    font-size: 16px;
    font-weight: 600;
    color: rgb(66, 66, 66);
}
.css-2nqlxv {
    margin: 16px 0px;
}
.css-1qhmto6 {
    margin-left: 12px;
}
li.setting-list-content {
    font-size: 15px;
}
h5.mt-5.activity-section {
    font-size: 16px;
    color: #000;
}
/* ==================settings css==================== */
.css-1nm8rpl {
    color: rgb(77, 77, 77);
    font-size: 16px;
    font-weight: 600;
    line-height: 19px;
    text-align: left;
}
.css-tgqiqq {
    color: rgb(77, 77, 77);
    font-size: 15px;
    font-weight: 400;
    line-height: 18px;
    text-align: left;
    margin: 20px 0px;
}
.ui.grid {
    margin-top: -1rem;
    margin-bottom: -1rem;
    margin-left: -1rem;
    margin-right: -1rem;
}
.ui.grid {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-orient: horizontal;
    -webkit-box-direction: normal;
    -ms-flex-direction: row;
    flex-direction: row;
    -ms-flex-wrap: wrap;
    flex-wrap: wrap;
    -webkit-box-align: stretch;
    -ms-flex-align: stretch;
    align-items: stretch;
    padding: 0;
}
.ui.grid>.column:not(.row) {
    padding-top: 1rem;
    padding-bottom: 1rem;
}
.ui.grid>.column:not(.row), .ui.grid>.row>.column {
    position: relative;
    display: inline-block;
    width: 6.25%;
    padding-left: 1rem;
    padding-right: 1rem;
    vertical-align: top;
}
.css-lsb4tg {
    background-color: rgb(255, 255, 255);
    border: 1px solid rgb(217, 217, 217);
    border-radius: 2px;
    width: 109px;
    height: 42px;
}
button.css-lsb4tg {
    margin-left: 7rem;
}
span.link.link--accent.u-floatRight.mt-3 {
    display: flex;
    justify-content: end;
}
.link--accent {
    color: #cf0404;
}

.setting-list.active {
    background-color: #fff !important;
    padding: 10px !important;
    text-decoration: none !important;
}
ul li a:hover {
    text-decoration: none;
}
</style>

<div class="lw-ad-block-h90">

</div>

<div class="card mb-3 d-s-none d-block">

    <div class="card-header d-flex justify-content-between settting-mobile">

       <h3 class=""><i class="fa-solid fa-gear"></i>Setting</h3>

       <div class="d-flex"> 

       </div>

   </div>

</div>


<div class="card mb-3 d-md-none ">
    <div class="card-header">
     <select class="mobile-setting-list accordion" name="links_tap" id="accordionSidebar">
         <option>Account</option>
         <option value="about-setting">Settings</option>
         <option value="notification-setting">Notification</option>
         <!-- <option>Member Notes</option> -->
         <option value="hidden_members">Hidden Members</option>
         <option value="video_chat_permissions">Video Chat Permissionss</option>
         <option value="subscription-setting">Subscription</option>
         <option value="verifications">Verifications</option>
         <option value="help_center">Help Center</option>
     </select>
 </div>

</div>

</div>


<div class="card m-2 mb-3">
    <div class="card-body settings-main">
        <!-- info message -->
        
        <ul style="list-style: none;">
            <li class="setting-list-content" id="about-setting">

                <div class="d-flex webtech py-2">
                    <span class="web pb-3">Email </span>
                    <span class="web-test"><b class="email_change">{{ Auth::user()->email}} </b><a href="#" class="text-danger" data-toggle="modal" data-target="#userSmallProfileEditPopup"> &nbsp; &nbsp;Edit email</a></span>
                </div>
                <div class="d-flex py-2 pt-3 pb-3">
                    <span class="web">Password :</span>
                    <span class="text-danger web-test1"><a href="#" class="text-danger">Change Passward</a></span>
                </div>
                <hr>
                <label class="web"for="floatingSelect ms-4">Language</label>
                <div class="form-floating open-menu pt-2">
                 <select class="form-select" id="floatingSelect" aria-label="Floating label select example">
                   <option class="ms-3"selected>English</option>
                   <option value="1">Hindi</option>
                   <option value="2">Punjabi</option>
                   <option value="3">British</option>
                   <option value="4">Français</option>
                   <option value="5">British</option>
                   <option value="6">Français</option>
               </select>
           </div>
           <h5 class="mt-5 activity-section">Your Activity</h5>
           <div class="d-flex py-2">
            <button class="setting-togle-button active" >Visible</button><button class="setting-togle-button">Hidden</button>
        </div>
        <div class="py-2">
            <span>Online Status / Last Active Date 
                <span><label class="switch">
                  <input type="checkbox" checked>
                  <span class="slider round"></span>
              </label>
          </span></span><br>
      </div>
      <div class="py-2">
        <span>When You View Someone
            <span><label class="switch">
              <input type="checkbox" checked>
              <span class="slider round"></span>
          </label>
      </span></span><br>
  </div>
  <div class="py-2">
    <span>When You Favorite Someone
        <span><label class="switch">
          <input type="checkbox" checked>
          <span class="slider round"></span>
      </label>
  </span></span><br>
</div>
<h5 class="mt-5 activity-section">Search and Dashboard</h5>
<div class="d-flex py-2">
    <button class="setting-togle-button active">Visible</button><button class="setting-togle-button">Hidden</button>
</div>
<div class="py-2">
    <span>When You Favorite Someone
        <span><label class="switch">
          <input type="checkbox" checked>
          <span class="slider round"></span>
      </label>
  </span></span><br>
</div>
<h5 class="mt-5 activity-section">Other Profile Information</h5>
<div class="d-flex py-2">
    <button class="setting-togle-button active">Visible</button><button class="setting-togle-button">Hidden</button>
</div>
<div class="py-2">
    <span>Join Date
        <span><label class="switch">
          <input type="checkbox" checked>
          <span class="slider round"></span>
      </label>
  </span></span><br>
</div>
<div class="py-2">
    <span>  
        Recent Login Location
        <span><label class="switch">
          <input type="checkbox" checked>
          <span class="slider round"></span>
      </label>
  </span></span><br>
</div>    
<h5 class="mt-5 activity-section">Preferred Measurement System</h5>
<div class="d-flex py-2">
    <button class="setting-togle-button active">Imperial</button><button class="setting-togle-button">Metric</button>
</div>
<div>
    <hr>
    <div>
        <h1 class="css-1nm8rpl">Social Connections</h1>
        <p class="css-tgqiqq">You can connect or disconnect the following social media accounts.</p>
        <div class="ui grid">
            <div class="three wide computer six wide mobile four wide tablet column"><label class="css-1fagh72">Instagram</label></div>
            <div class="three wide computer six wide mobile four wide tablet column">
                <div><button class="css-lsb4tg" data-cy-social-button="instagram" style="cursor: pointer;">Connect</button></div>
            </div>
        </div>
        <div class="ui grid">
            <div class="three wide computer six wide mobile four wide tablet column"><label class="css-1fagh72">LinkedIn</label></div>
            <div class="three wide computer six wide mobile four wide tablet column">
                <div><button class="css-lsb4tg" data-cy-social-button="linkedin" style="cursor: pointer;">Connect</button></div>
            </div>
        </div>
        
    </div>
</div>
<div class="u-cf"><div><span class="link link--accent u-floatRight mt-3">Deactivate or Delete Account</span></div></div>
</li>

<li class="setting-list-content" id="notification-setting"> 

    <div class="Panel"><div><h5 class="css-5yv5d9">Show me in-app alerts when someone...</h5>
        <ul class="Panel-block">
            <li><label class="css-fgicdg">
                <input type="checkbox" name="message_desktop" class="css-74frd3" checked="">
                <span class="css-oshlpk">Sends me a message</span></label></li>
                <li><label class="css-fgicdg"><input type="checkbox" name="favorite_desktop" class="css-74frd3" checked="">
                    <span class="css-oshlpk">Adds me as a favorite</span></label></li>
                </ul></div><div><h5 class="css-5yv5d9">Send me an email when someone...</h5>
                    <ul class="Panel-block"><li><label class="css-fgicdg">
                        <input type="checkbox" name="message_email" class="css-74frd3" checked="">
                        <span class="css-oshlpk">Sends me a message</span></label></li>
                        <li><label class="css-fgicdg"><input type="checkbox" name="favorite_email" class="css-74frd3" checked=""><span class="css-oshlpk">Adds me as a favorite</span></label></li><li><label class="css-fgicdg"><input type="checkbox" name="profile_email" class="css-74frd3" checked=""><span class="css-oshlpk">Views my profile</span></label></li></ul></div><div><h5 class="css-5yv5d9">Also email me about...</h5><ul class="Panel-block"><li><label class="css-fgicdg"><input type="checkbox" name="new_members_matches" class="css-74frd3" checked=""><span class="css-oshlpk">New members &amp; matches</span></label></li><li><label class="css-fgicdg"><input type="checkbox" name="moderate_content_email" class="css-74frd3" checked=""><span class="css-oshlpk">When my profile changes are approved</span></label></li><li><label class="css-fgicdg"><input type="checkbox" name="verification_requests" class="css-74frd3" checked=""><span class="css-oshlpk">Verification &amp; information requests</span></label></li><li><label class="css-fgicdg"><input type="checkbox" name="special_events" class="css-74frd3" checked=""><span class="css-oshlpk">Special events</span></label></li><li><label class="css-fgicdg"><input type="checkbox" name="news_updates" class="css-74frd3" checked=""><span class="css-oshlpk">News and updates</span></label></li><li><label class="css-fgicdg"><input type="checkbox" name="offers_promotions" class="css-74frd3" checked=""><span class="css-oshlpk">Promotions and other offers</span></label></li></ul></div><div><div class="css-ldzv7o"><span class="css-1777odk" data-cy-button="unsubscribe-all">Unsubscribe All</span></div></div></div>
                    </li> 
                    
                    
                    <li class="setting-list-content" id="hidden_members">
                        <!-- <h5 class="">Hidden Members</h5> -->
                        <div class="Panel Panel--divided"><article class="ContentPlaceholder ContentPlaceholder--lrg">
                            <h2 class="ContentPlaceholder-header text-center">Hurray...you haven't hidden anyone.</h2>
                            <p class="text-center">Hiding a member restricts them from seeing your profile in search, dashboards, and interest lists (although they could still message you if they can find you). The person you hide will not be notified that you have hidden them.</p></article></div>
                        </li>

                        <li class="setting-list-content" id="video_chat_permissions">
                            <!-- <h5 class="">Video Chat Permissions</h5> -->
                            <div class="Panel Panel--divided Panel-block ControlGroup-main-content"><div class="FormGroup"><div class="ControlGroup-content-title">
                                <label class="fw-bolder">Video Chat Availability</label></div>
                                <div class="main-content">
                                    <div class="title"><h5>Blocking incoming video calls</h5>
                                        <div class="ControlGroup-btn-content" style="margin: 16px 0px;"><ul><li class="left-btn" data-cy-vim="block-calls"><div class="css-7a2p7m">
                                            <!-- <label><input type="radio"><span>Enable</span></label><label><input type="radio" checked=""><span>Disable</span></label> -->
                                            <button class="setting-togle-button active" >Enable</button><button class="setting-togle-button">Disable</button>
                                        </div></li></ul></div></div><div class="title">
                                            <h5 class="pt-4">Only receive calls from people I've conversed with</h5><div class="ControlGroup-btn-content" style="margin: 16px 0px;"><ul><li class="left-btn" data-cy-vim="receive-calls"><div class="css-7a2p7m">
                                                <!-- <label><input type="radio" data-cy-switch="videochat_conversed-1" checked=""><span>Enable</span></label><label><input type="radio" data-cy-switch="videochat_conversed-1"><span>Disable</span></label> -->
                                                <button class="setting-togle-button active" >Enable</button><button class="setting-togle-button">Disable</button>
                                            </div></li></ul></div></div></div></div><hr><div class="FormGroup"><div class="ControlGroup-content-title"><label>Video Chat Settings</label></div><div class="main-content"><div class="title"><h5>Incoming ringtone</h5><div class="ControlGroup-btn-content" style="margin: 16px 0px;"><ul><li class="left-btn" data-cy-vim="ringtone-calls"><div class="css-7a2p7m">
                                                <!-- <label><input type="radio" checked=""><span>Enable</span></label><label><input type="radio"><span>Disable</span></label> -->
                                                <button class="setting-togle-button active" >Enable</button><button class="setting-togle-button">Disable</button>
                                            </div></li></ul></div></div></div></div></div>
                                            <div class="PageHeader"><h1 class="PageHeader-title">Sharing Private Photos with</h1></div>
                                            <div class="Panel Panel--divided"><article class="ContentPlaceholder ContentPlaceholder--lrg"><h2 class="ContentPlaceholder-header text-center">You haven't shared any private photos.</h2><p class="text-center">Members that you have shared private photos with will display here.</p></article></div>
                                        </li>
                                        <li class="setting-list-content" id="subscription-setting">
                                            <h5 class="">Subscription</h5>
                                        </li>

                                        <li class="setting-list-content" id="security_information">
                                            <!-- <h5 class="">Security Information</h5> -->
                                            <div class="Panel Panel--divided Panel-block ControlGroup-main-content"><div class="FormGroup"><p>Here are our options to give your account some additional security:</p><div class="setting-secret-questions"><div class="ControlGroup-content-title"><label class="fw-bolder">Security questions</label></div><div class="main-content"><div class="title"><h5>Security questions will be used for password recovery if you forget your password and cannot access your email.</h5><div class="ControlGroup-btn-content"><ul><li class="left-btn"><div class="css-7a2p7m">
                                                <!-- <label><input type="radio" data-cy-switch="security-questions"><span>Enable</span></label><label><input type="radio" data-cy-switch="security-questions" checked=""><span>Disable</span></label> -->
                                                <button class="setting-togle-button active" >Enable</button><button class="setting-togle-button">Disable</button>
                                            </div></li></ul></div></div></div></div></div><hr><div><div class="FormGroup"><div class="setting-two-factor"><div class="ControlGroup-content-title"><label class="fw-bolder">Two-Factor Authentication</label></div><div class="main-content"><div class="title"><h5>Two-Factor authentication adds an extra layer of security to your account. The first time you log in from any device (or when you reset your password) you will be sent a text message with a unique code. This code will be required to log in, meaning someone would need both your password and access to your phone to log into your account.</h5><br><div class="ControlGroup-btn-content"><ul><li class="left-btn"><div class="BtnSwitch"><div class="css-7a2p7m">
                                              <!-- <label><input type="radio"><span>Enable</span></label><label><input type="radio" checked=""><span>Disable</span></label> -->
                                              <button class="setting-togle-button active" >Enable</button><button class="setting-togle-button">Disable</button>
                                          </div></div></li></ul></div></div></div></div></div></div><hr><h5 style="font-weight: 500; margin-bottom: 16px; font-size:16px;">Additional data privacy options</h5><div><a href="/settings/data-privacy"><button class="css-ouo77o" style="white-space: normal;">Request an export or the deletion of your personal data</button></a></div></div>
                                      </li>



                                      <li class="setting-list-content" id="verifications">
                                        <!-- <h5 class="">Your Verifications</h5> -->
                                        <div style="padding: 0px 10px;">Verifications help keep our members safe and trustworthy. Plus, members who have verifications are proven to get more views, favorites, and messages! In general, the more verifications you have the more popular you’ll be with our members!</div>
                                        <div class="tabordion_settings">
                                          <section id="">
                                            <div class="grouped-inner">
                                                <label for="option1">ID Verification</label>
                                                <div class="inner-con" style="display: none;">
                                                    <div class="inner-main">
                                                        <h3 class="sett-title">ID Verification</h3>
                                                        <p class="css-textarea">Having an ID verification badge proves that you are, in fact, who you say you are. It's as simple as taking a quick photo of your government issued ID (front and back) and a selfie, which will be compared to your profile. Once your ID is verified by our team, you will see an ID verification badge appear in your profile.</p>
                                                        <div class="css-btm">
                                                            <div style="display: flex; justify-content: center; flex-direction: column;">
                                                                <button data-cy-idv="not_started" class="css-btn">Buy ID Verification Badge</button>
                                                            </div>
                                                            <div class="css-btm-con">
                                                                <p style="color: rgb(126, 126, 126); font-size: 12px; line-height: 15px;">Seeking will not store or even have access to the information you provide to this third party, we will merely receive a "Pass" or "Fail".</p>
                                                                <p style="color: rgb(126, 126, 126); font-size: 12px;">(Note: If you fail the background check, you will not receive the verification badge. We do not provide refunds for those who fail the background check, as the background check was performed.)</p>
                                                            </div>
                                                        </div>
                                                    </div>                                    
                                                </div>
                                            </div>
                                        </section>
                                        <section id="">
                                            <div class="grouped-inner">
                                                <label for="option1" class="social">Social Media Verification</label>
                                                <div class="inner-con" style="display: none;">
                                                    <div class="inner-main">
                                                        <h3 class="sett-title">Social Media Verification</h3>
                                                        <p>Stand out from the crowd! Connect one of your social media accounts to your Seeking account and your profile will be given a corresponding badge. For your privacy, Seeking will never share information with these accounts, link to these accounts, or request to post to these accounts.</p>
                                                        <div class="css-1ffo5h7">
                                                            <div class="facebook_grup">
                                                               <a class="link_din" href="<?= route('social.user.login', [getSocialProviderKey('facebook')]) ?>" >
                                                                <button class="css-12vin3e"><i class="fa-brands fa-facebook-square"></i>Connect your Facebook</button></a>
                                                                @if($SocialConnectFacebook)
                                                                <div class="face_icon"> <i class="fa fa-check" aria-hidden="true"></i></div>
                                                                @endif
                                                            </div>
                                                            <div class="insta_group">
                                                                <a class="inst_gram" href="{{ url('instagram') }}">
                                                                    <button class="css-12vin3e"><i class="fa-brands fa-instagram"></i>Connect your Instagram</button></a>
                                                                    @if($SocialConnectInstgram)
                                                                    <div class="insta_icon"> <i class="fa fa-check" aria-hidden="true"></i></div>
                                                                    @endif
                                                                </div>
                                                                <div class="linkdin_group">

                                                                    <a class="link_din" href="{{ url('auth/linkedin') }}"><button data-cy-social-button="linkedin" class="css-12vin3e"><i class="fa-brands fa-linkedin"></i>Connect your LinkedIn</button></a>
                                                                    @if($SocialConnectLinkedin)
                                                                    <div class="link_din_icon"> <i class="fa fa-check" aria-hidden="true"></i></div>
                                                                    @endif
                                                                </div>


                                                            </div>
                                                        </div>                                   
                                                    </div>
                                                </div>
                                            </section>
                                            <section id="section3">
                                                <div class="grouped-inner">
                                                    <label for="option1" class="photo">Video Verification</label>
                                                    <div class="inner-con" style="display: none;">
                                                        <div class="inner-main">
                                                            <h3 class="sett-title">Video Verification</h3>
                                                            <p>You can use this verification to prove that your profile photos are truly photos of you. It's as simple as taking a quick photo mimicking an example photo we'll show you and submitting it to us to compare to your profile.</p>



                                                            <div class="css-3uf4f8" style="display: block; text-align: center;">

                                                              <form id="verification_video_upload_form" action="{{ url('/')}}/admin/user-verifications-video" method="post" enctype="multipart/form-data">
                                                                @csrf

                                                                <input id='verifyVideoButtonFile' name="verify_video_upload" type='file' hidden/>
                                                                <button id='verifyVideoButtonHtml' class="css-12vin3e">Verify my video </button>
                                                            </form> 



                                                            <p class="css-areg8u"></p></div>


                                                            <p class="css-btm-con">(Note: You must have at least one approved photo before verifying photos.)</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </section>
                                            <section id="section4">
                                                <div class="grouped-inner">
                                                    <label for="option1" class="background">Background Check</label>
                                                    <div class="inner-con" style="display: none;">
                                                        <div class="inner-main">
                                                            <h3 class="sett-title">We're sorry, background checks are only offered for members who live in the United States.</h3>
                                                        </div>  
                                                    </div>
                                                </div>
                                            </section>
                                        </div>
                                    </li>
                                    <li class="setting-list-content" id="help_center">
                                        <!-- <h5 class="">Help Center</h5> -->
                                        <div class="css-xgow36"><div class="css-13ih39a">Help</div><div class="css-1vvrzwm" style="margin: 2px 0px 12px;"></div><ul class="css-i3pbo"><li class="css-2nqlxv"><a class="css-6bh5qj" id="Frequently" href="https://www.seeking.com/en/help" target="_blank" data-cy-help-center-link="Frequently Asked Questions"><svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24" fill="#cf0404"><path id="inner-content" d="M0 0h24v24H0z" fill="none"></path><path id="background" d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 17h-2v-2h2v2zm2.07-7.75l-.9.92C13.45 12.9 13 13.5 13 15h-2v-.5c0-1.1.45-2.1 1.17-2.83l1.24-1.26c.37-.36.59-.86.59-1.41 0-1.1-.9-2-2-2s-2 .9-2 2H8c0-2.21 1.79-4 4-4s4 1.79 4 4c0 .88-.36 1.68-.93 2.25z"></path></svg><span class="css-1qhmto6">Frequently Asked Questions</span></a></li><li class="css-2nqlxv"><a class="css-6bh5qj" id="SAFETY_DATING_TIPS_ID" href="https://blog.seeking.com/2021/04/06/tips-for-dating-safely" target="_blank" data-cy-help-center-link="Tips for Dating Safely"><svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24" fill="#cf0404"><path id="inner-content" d="M0 0h24v24H0z" fill="none"></path><path id="background" d="M11.99 2c-5.52 0-10 4.48-10 10s4.48 10 10 10 10-4.48 10-10-4.48-10-10-10zm3.61 6.34c1.07 0 1.93.86 1.93 1.93 0 1.07-.86 1.93-1.93 1.93-1.07 0-1.93-.86-1.93-1.93-.01-1.07.86-1.93 1.93-1.93zm-6-1.58c1.3 0 2.36 1.06 2.36 2.36 0 1.3-1.06 2.36-2.36 2.36s-2.36-1.06-2.36-2.36c0-1.31 1.05-2.36 2.36-2.36zm0 9.13v3.75c-2.4-.75-4.3-2.6-5.14-4.96 1.05-1.12 3.67-1.69 5.14-1.69.53 0 1.2.08 1.9.22-1.64.87-1.9 2.02-1.9 2.68zM11.99 20c-.27 0-.53-.01-.79-.04v-4.07c0-1.42 2.94-2.13 4.4-2.13 1.07 0 2.92.39 3.84 1.15-1.17 2.97-4.06 5.09-7.45 5.09z"></path></svg><span class="css-1qhmto6">Tips for Dating Safely</span></a></li><li class="css-2nqlxv"><a class="css-6bh5qj" id="Anti-Sex-Trafficking" href="https://www.seeking.com/p/anti-sex-trafficking/" target="_blank" data-cy-help-center-link="Anti-Sex Trafficking"><svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="24" viewBox="0 0 24 24" width="24" fill="#cf0404"><g><rect id="background" fill="none" height="24" width="24"></rect></g><g><g><g><path id="content" d="M23,5.5V20c0,2.2-1.8,4-4,4h-7.3c-1.08,0-2.1-0.43-2.85-1.19L1,14.83c0,0,1.26-1.23,1.3-1.25 c0.22-0.19,0.49-0.29,0.79-0.29c0.22,0,0.42,0.06,0.6,0.16C3.73,13.46,8,15.91,8,15.91V4c0-0.83,0.67-1.5,1.5-1.5S11,3.17,11,4v7 h1V1.5C12,0.67,12.67,0,13.5,0S15,0.67,15,1.5V11h1V2.5C16,1.67,16.67,1,17.5,1S19,1.67,19,2.5V11h1V5.5C20,4.67,20.67,4,21.5,4 S23,4.67,23,5.5z"></path></g></g></g></svg><span class="css-1qhmto6">Anti-Sex Trafficking</span></a></li><li class="css-2nqlxv"><a class="css-6bh5qj" id="Contact" href="https://www.seeking.com/help/ticket" target="_blank" data-cy-help-center-link="Contact Support"><svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="24" viewBox="0 0 24 24" width="24" fill="#cf0404"><g><rect id="background" fill="none" height="24" width="24"></rect></g><g><path id="content" d="M12,2C6.48,2,2,6.48,2,12c0,5.52,4.48,10,10,10s10-4.48,10-10C22,6.48,17.52,2,12,2z M19.46,9.12l-2.78,1.15 c-0.51-1.36-1.58-2.44-2.95-2.94l1.15-2.78C16.98,5.35,18.65,7.02,19.46,9.12z M12,15c-1.66,0-3-1.34-3-3s1.34-3,3-3s3,1.34,3,3 S13.66,15,12,15z M9.13,4.54l1.17,2.78c-1.38,0.5-2.47,1.59-2.98,2.97L4.54,9.13C5.35,7.02,7.02,5.35,9.13,4.54z M4.54,14.87 l2.78-1.15c0.51,1.38,1.59,2.46,2.97,2.96l-1.17,2.78C7.02,18.65,5.35,16.98,4.54,14.87z M14.88,19.46l-1.15-2.78 c1.37-0.51,2.45-1.59,2.95-2.97l2.78,1.17C18.65,16.98,16.98,18.65,14.88,19.46z"></path></g></svg><span class="css-1qhmto6">Contact Support</span></a></li></ul><div class="css-13ih39a">Site Information</div><div class="css-1vvrzwm" style="margin: 2px 0px 12px;"></div><ul class="css-i3pbo"><li class="css-2nqlxv"><a class="css-6bh5qj" id="Privacy" href="https://www.seeking.com/privacy" target="_blank" data-cy-help-center-link="Privacy Policy"><svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24" fill="#cf0404"><path id="background" d="M0 0h24v24H0z" fill="none"></path><path id="content" d="M10.09 15.59L11.5 17l5-5-5-5-1.41 1.41L12.67 11H3v2h9.67l-2.58 2.59zM19 3H5c-1.11 0-2 .9-2 2v4h2V5h14v14H5v-4H3v4c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2z"></path></svg><span class="css-1qhmto6">Privacy Policy</span></a></li><li class="css-2nqlxv"><a class="css-6bh5qj" id="Terms" href="https://www.seeking.com/terms" target="_blank" data-cy-help-center-link="Terms of Use"><svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24" fill="#cf0404"><path id="background" d="M0 0h24v24H0z" fill="none"></path><path id="content" d="M10.09 15.59L11.5 17l5-5-5-5-1.41 1.41L12.67 11H3v2h9.67l-2.58 2.59zM19 3H5c-1.11 0-2 .9-2 2v4h2V5h14v14H5v-4H3v4c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2z"></path></svg><span class="css-1qhmto6">Terms of Use</span></a></li></ul><div class="css-1skzv06">© 2022 Seeking.com in conjunction with W8 Tech Limited, W8tech Cyprus Limited, and its related companies.</div></div>
                                    </li>

                                    <li class="setting-list-content">
                                        <h5 class="">Other Profile Information</h5>
                                        <div class="d-flex py-2">
                                            <button class="setting-togle-button">Visible</button><button class="setting-togle-button">Hidden</button>
                                        </div>
                                        <div class="py-2">
                                            <span>Join Date
                                                <span><label class="switch">
                                                  <input type="checkbox" checked>
                                                  <span class="slider round"></span>
                                              </label>
                                          </span></span><br>
                                      </div>
                                      <div class="py-2">
                                        <span>Recent Login Location
                                            <span><label class="switch">
                                              <input type="checkbox" checked>
                                              <span class="slider round"></span>
                                          </label>
                                      </span></span><br>
                                  </div>
                              </li>
                              
                              
                              
                              <li class="setting-list-content">

                                <p class="text-danger">Deactivate or Delete Account</p>
                            </li>
                            
                            
                        </ul>
                    </div>
                </div>


                <!-- model close -->


<!-- model close -->
<!-- About Us Model -->

<div class="modal fade" id="userSmallProfileEditPopup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header border-bottom-0">
        <h5 class="modal-title text-center" id="exampleModalLabel">Change your email address</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
  </div>
  <hr />

  <form class="userSmallProfileEditForm" id="userSmallProfileEditForm" method="post" data-show-message="true" action="<?= route('user.write.email_update') ?>">

    <input type="hidden" name="action" value="firstStepUserEditForm">
    <div class="modal-body">
      <div class="form-group">
        <label for="email1">New email address</label>      
         <input type="hidden" name="id" value="{{ Auth::user()->_id}}" class="form-control"> 

        <input type="email" name="email" value="" class="form-control">

    </div>
    <div class="form-group">
        <label for="email1">Confirm new email address</label>       

        <input  type="email" class="form-control" name="email2" value="" autocomplete="on">


    </div>
  
</div>
<hr />
<div class="modal-footer border-top-0 d-flex justify-content-center">

    <button type="button" class="btn btn-danger userSmallProfileEditFormBtn" data-dismiss="modal" aria-label="Close">
      Cancel
  </button>
  <button type="submit" class="btn btn-success">Submit</button>
</div>
</form>
</div>
</div>
</div>
                <script type="text/javascript">

                    document.getElementById('verifyVideoButtonHtml').addEventListener('click', openDialogPublic);
                 
                    function openDialogPublic(e) {
                        e.preventDefault();

                        document.getElementById('verifyVideoButtonFile').click();
                  

                    }


                    jQuery(document).ready(function(){
                     $(document).on('change','.mobile-setting-list',function(){
                        var selectbox = $('.mobile-setting-list :selected').val();
                        jQuery('.settings-main .setting-list-content').hide();
                        jQuery('#'+selectbox).show();
                        window.history.replaceState(null, null, '?'+selectbox);
                    });
                     var url = window.location.href;
                     var href = url.substring(0, url.indexOf('='));
                     if(href == ''){
                        var index = url.indexOf("?");
                    }else{
                        var index = href.indexOf("?");
                    }
        // var index = href.indexOf("?");
        if (index !== -1)
        {
            if(href == ''){
                var hashTab = url.substring(index + 1);
            }else{
                var index2 = url.indexOf("?");
                if (index2 !== -1)
                {
                    var hash1 = url.substring(index2 + 1);
                    var beforePlus = hash1.split('=').shift();
                }
                var index1 = url.indexOf("="); 
                if (index1 !== -1)
                {
                    var hash = url.substring(index1 + 1);
                }
            }
            setTimeout(function(){
                jQuery('.settings-main .setting-list-content').hide();
                if(hashTab == null){
                    jQuery('#'+beforePlus).show();
                }else{
                    jQuery('#'+hashTab).show();
                }
            },50);
            setTimeout(function(){
                jQuery('.grouped-inner .'+hash+'').click();
            },60);
        }
        setTimeout(function(){
            jQuery('.tabordion_settings section').first().find('.grouped-inner label').click();
        },50);
        jQuery(".tabordion_settings .grouped-inner label").click(function(){
            jQuery('.tabordion_settings .grouped-inner label').removeClass('active');
            jQuery(this).addClass('active');
            jQuery('.tabordion_settings .grouped-inner .inner-con').hide();
            jQuery(this).next().show();
        });
    });
</script>
<script type="text/javascript">
    jQuery(document).ready(function(){
        $(".setting-togle-button").click(function () {

            $(".setting-togle-button").removeClass("active");
            $(this).addClass('active');
        });

        $(".setting-list").click(function () {


            $(".setting-list").removeClass("active");
            $(this).addClass('active');
        });


                $(document).on('change', '#verifyVideoButtonFile', function(e){
             e.preventDefault();

             var myForm = $("#verification_video_upload_form")[0];

             var formData = new FormData(myForm);
             console.log(formData);

             $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
             $.ajax({
                type:'POST',
                url:"{{ url('admin/user-verifications-video') }}",
                dataType : 'json',
                data: formData,
                contentType: false,
                cache: false,
                processData: false,
                beforeSend:function(){
                 // $('#uploaded_image_loader').html("<div id='uploaded_image'><div class='loader'></div></div>");
             },   
             success:function(response){
                if(response.status == 'success'){
                    $('#verifyVideoButtonHtml').html('<span> <i class="fa fa-check" aria-hidden="true"></i> Verify my video</span>');
                    showSuccessMessage(response.msg);
                }else{
                      showErrorMessage(response.msg);
                }
            }
        });

             return false;
         });






    });

    $(document).ready(function() {
    
    $('#userSmallProfileEditForm').validate({
        rules: {
            'email': {
                required: true,
                email: true
            },
            email2: {
                equalTo: '[name="email"]',
                 email: true
            }
        },
        submitHandler: function(form) { // for demo
           
            return true;
        }
    });


    $("body").on("submit", ".userSmallProfileEditForm", function(e) {

           

    e.preventDefault();
    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });

    $.ajax({
      type:'POST',
      url:"{{ url('user/settings/user-email-update') }}",
      dataType : 'json',
      data :  $('#userSmallProfileEditForm').serialize(),
      success:function(response){
       
        console.log(response);
        if(response.status=='success'){
        showSuccessMessage("Email Updated Successfully");
        $('.email_change').html('');
         $('.userSmallProfileEditFormBtn').click();
         $('.email_change').html('<b>'+response.email+'</b>')

        }else{
        showSuccessMessage("Email already exits. Please use another email");
        $('.userSmallProfileEditFormBtn').click();


        }
      



   }

});

    return false;
});
    
});
</script>

@stop
