<!DOCTYPE html>
<html lang="zxx" class="js">

<head>
    <base href="../">
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="author" content="Softnio">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="A powerful and conceptual apps base dashboard template that especially build for developers and programmers.">
    <!-- Fav Icon  -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <link rel="shortcut icon" href="{{ asset('/backend/mages/favicon.png') }}') }}">
    <script rel="shortcut icon" src="{{ asset('/dist/js/common-app.min.js') }}') }}"></script>
    <!-- Page Title  -->
    <title>PPM</title>
    <!-- StyleSheets  -->
    <!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css"> -->


    <link rel="stylesheet" href="{{ asset('/backend/assets/css/dashlite.css?ver=3.0.0') }}">
    <link id="skin-default" rel="stylesheet" href="{{ asset('public/backend/assets/css/theme.css?ver=3.0.0') }}">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="{{ asset('/frontend/glightbox/css/glightbox.css') }}" />

    <style type="text/css">
        #example_filter .form-control.form-control-sm {
            max-width: 182px;
        }
    </style>

    <style type="text/css">

        .custom-model-popup {
          text-align: center;
          overflow: hidden;
          position: fixed;
          top: 0;
          right: 0;
          bottom: 0;
          left: 0; /* z-index: 1050; */
          -webkit-overflow-scrolling: touch;
          outline: 0;
          opacity: 0;
          -webkit-transition: opacity 0.15s linear, z-index 0.15;
          -o-transition: opacity 0.15s linear, z-index 0.15;
          transition: opacity 0.15s linear, z-index 0.15;
          z-index: -1;
          overflow-x: hidden;
          overflow-y: auto;
      }

      .model-open {
          z-index: 99999;
          opacity: 1;
          overflow: hidden;
      }
      .custom-model-inner {
          -webkit-transform: translate(0, -25%);
          -ms-transform: translate(0, -25%);
          transform: translate(0, -25%);
          -webkit-transition: -webkit-transform 0.3s ease-out;
          -o-transition: -o-transform 0.3s ease-out;
          transition: -webkit-transform 0.3s ease-out;
          -o-transition: transform 0.3s ease-out;
          transition: transform 0.3s ease-out;
          transition: transform 0.3s ease-out, -webkit-transform 0.3s ease-out;
          display: inline-block;
          vertical-align: middle;
          width: 600px;
          margin: 30px auto;
          max-width: 97%;
      }
      .custom-model-wrap {
          display: block;
          width: 100%;
          position: relative;
          background-color: #fff;
          border: 1px solid #999;
          border: 1px solid rgba(0, 0, 0, 0.2);
          border-radius: 6px;
          -webkit-box-shadow: 0 3px 9px rgba(0, 0, 0, 0.5);
          box-shadow: 0 3px 9px rgba(0, 0, 0, 0.5);
          background-clip: padding-box;
          outline: 0;
          text-align: left;
          padding: 20px;
          -webkit-box-sizing: border-box;
          -moz-box-sizing: border-box;
          box-sizing: border-box;
          max-height: calc(100vh - 70px);
          overflow-y: auto;
      }
      .model-open .custom-model-inner {
          -webkit-transform: translate(0, 0);
          -ms-transform: translate(0, 0);
          transform: translate(0, 0);
          position: relative;
          z-index: 999;
      }
      .model-open .bg-overlay {
          background: rgba(0, 0, 0, 0.6);
          z-index: 99;
      }
      .bg-overlay {
          background: rgba(0, 0, 0, 0);
          height: 100vh;
          width: 100%;
          position: fixed;
          left: 0;
          top: 0;
          right: 0;
          bottom: 0;
          z-index: 0;
          -webkit-transition: background 0.15s linear;
          -o-transition: background 0.15s linear;
          transition: background 0.15s linear;
      }
      .close-btn {
          position: absolute;
          right: 0;
          top: -30px;
          cursor: pointer;
          z-index: 99;
          font-size: 30px;
          color: #fff;
      }

      @media screen and (min-width:800px){
        .custom-model-popup:before {
          content: "";
          display: inline-block;
          height: auto;
          vertical-align: middle;
          margin-right: -0px;
          height: 100%;
      }
  }
  @media screen and (max-width:799px){
      .custom-model-inner{margin-top: 45px;}
  }

  .nk-sidebar-content {
    overflow-y: scroll;
}

</style>
</head>

<body class="nk-body bg-lighter npc-default has-sidebar ">
    <div class="nk-app-root">
        <!-- main @s -->
        <div class="nk-main ">

           @include('layouts.backend.sidebar')

           <div class="nk-wrap ">

               @include('layouts.backend.header')

               @yield('content')

               @include('layouts.backend.footer')

           </div>
           <!-- wrap @e -->
       </div>
       <!-- main @e -->
   </div>
   <!-- app-root @e -->
   <!-- select region modal -->
   <div class="modal fade" tabindex="-1" role="dialog" id="region">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <a href="#" class="close" data-bs-dismiss="modal"><em class="icon ni ni-cross-sm"></em></a>
            <div class="modal-body modal-body-md">
                <h5 class="title mb-4">Select Your Country</h5>
                <div class="nk-country-region">
                    <ul class="country-list text-center gy-2">
                        <li>
                            <a href="#" class="country-item">
                                <img src="{{ asset('public/backend/images/flags/arg.png') }}" alt="" class="country-flag">
                                <span class="country-name">Argentina</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="country-item">
                                <img src="{{ asset('public/backend/images/flags/aus.png') }}" alt="" class="country-flag">
                                <span class="country-name">Australia</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="country-item">
                                <img src="{{ asset('public/backend/images/flags/bangladesh.png') }}" alt="" class="country-flag">
                                <span class="country-name">Bangladesh</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="country-item">
                                <img src="{{ asset('public/backend/images/flags/canada.png') }}" alt="" class="country-flag">
                                <span class="country-name">Canada <small>(English)</small></span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="country-item">
                                <img src="{{ asset('public/backend/images/flags/china.png') }}" alt="" class="country-flag">
                                <span class="country-name">Centrafricaine</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="country-item">
                                <img src="{{ asset('public/backend/images/flags/china.png') }}" alt="" class="country-flag">
                                <span class="country-name">China</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="country-item">
                                <img src="{{ asset('public/backend/images/flags/french.png') }}" alt="" class="country-flag">
                                <span class="country-name">France</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="country-item">
                                <img src="{{ asset('public/backend/images/flags/germany.png') }}" alt="" class="country-flag">
                                <span class="country-name">Germany</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="country-item">
                                <img src="{{ asset('public/backend/images/flags/iran.png') }}" alt="" class="country-flag">
                                <span class="country-name">Iran</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="country-item">
                                <img src="{{ asset('public/backend/images/flags/italy.png') }}" alt="" class="country-flag">
                                <span class="country-name">Italy</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="country-item">
                                <img src="{{ asset('public/backend/images/flags/mexico.png') }}" alt="" class="country-flag">
                                <span class="country-name">México</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="country-item">
                                <img src="{{ asset('public/backend/images/flags/philipine.png') }}" alt="" class="country-flag">
                                <span class="country-name">Philippines</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="country-item">
                                <img src="{{ asset('public/backend/images/flags/portugal.png') }}" alt="" class="country-flag">
                                <span class="country-name">Portugal</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="country-item">
                                <img src="{{ asset('public/backend/images/flags/s-africa.png') }}" alt="" class="country-flag">
                                <span class="country-name">South Africa</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="country-item">
                                <img src="{{ asset('public/backend/images/flags/spanish.png') }}" alt="" class="country-flag">
                                <span class="country-name">Spain</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="country-item">
                                <img src="{{ asset('public/backend/images/flags/switzerland.png') }}" alt="" class="country-flag">
                                <span class="country-name">Switzerland</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="country-item">
                                <img src="{{ asset('public/backend/images/flags/uk.png') }}" alt="" class="country-flag">
                                <span class="country-name">United Kingdom</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="country-item">
                                <img src="{{ asset('public/backend/images/flags/english.png') }}" alt="" class="country-flag">
                                <span class="country-name">United State</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div><!-- .modal-content -->
    </div><!-- .modla-dialog -->
</div><!-- .modal -->
<!-- JavaScript -->
<script src="{{ asset('public/frontend/glightbox/js/glightbox.js') }}"></script>



<!-- Glightbox Image Slider -->
<script>
    var lightbox = GLightbox();
    lightbox.on('open', (target) => {
        console.log('lightbox opened');
    });
    var lightboxDescription = GLightbox({
        selector: '.glightbox2'
    });
    var lightboxVideo = GLightbox({
        selector: '.glightbox3'
    });
    lightboxVideo.on('slide_changed', ({ prev, current }) => {
        console.log('Prev slide', prev);
        console.log('Current slide', current);

        const { slideIndex, slideNode, slideConfig, player } = current;

        if (player) {
            if (!player.ready) {
                        // If player is not ready
                        player.on('ready', (event) => {
                            // Do something when video is ready
                        });
                    }

                    player.on('play', (event) => {
                        console.log('Started play');
                    });

                    player.on('volumechange', (event) => {
                        console.log('Volume change');
                    });

                    player.on('ended', (event) => {
                        console.log('Video ended');
                    });
                }
            });

    var lightboxInlineIframe = GLightbox({
        selector: '.glightbox4'
    });

            /* var exampleApi = GLightbox({ selector: null });
            exampleApi.insertSlide({
                href: 'https://picsum.photos/1200/800',
            });
            exampleApi.insertSlide({
                width: '500px',
                content: '<p>Example</p>'
            });
            exampleApi.insertSlide({
                href: 'https://www.youtube.com/watch?v=WzqrwPhXmew',
            });
            exampleApi.insertSlide({
                width: '200vw',
                content: document.getElementById('inline-example')
            });
            exampleApi.open(); */
        </script>
        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="{{ asset('public/backend/assets/js/scripts.js?ver=3.0.0') }}"></script>
        <script src="{{ asset('public/backend/assets/js/libs/datatable-btns.js?ver=3.0.0') }}"></script>


        <script src="{{ asset('public/backend/assets/js/bundle.js?ver=3.0.0') }}"></script>
        <script src="{{ asset('public/backend/assets/js/scripts.js?ver=3.0.0') }}"></script>
        <script src="{{ asset('public/backend/assets/js/charts/chart-ecommerce.js?ver=3.0.0') }}"></script>
    </body>

    </html>