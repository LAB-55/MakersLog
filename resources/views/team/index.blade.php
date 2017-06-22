<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    @include('includes.head')
</head>
    <body class="@if(Auth::check()) fixed-sn @else hidden-sn @endif white-skin">
        
    <header>
        @include('includes.sidebar')
        @include('includes.navbar')
        
    </header>
    <!--/.Double navigation-->

    <!--Main layout-->
    <main class="" id="appmain">
        <div class="container-fluid">
            <div class="row pad-lr-20">
                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 pad-lr-10 pad-tb-10">
                    
                </div>
            </div>
        </div>
    </main>

    @if( Auth::check() )
    <div class="fx-action-btn">
        <a href="{{ route('createLog') }}" data-toggle="tooltip" data-placement="left" title="Add new log" class="btn-floating btn-large red">
            <i class="fa fa-pencil"></i>
        </a>
    </div> 
    @endif
    <div id="gotoTop" class="fx-action-btn hideOnMobile" style="right: 95px;">
        <a data-toggle="tooltip" data-placement="left" title="Goto top" class="btn-floating btn-med green">
            <i class="fa fa-chevron-up fa-1 med-btn-fonts" ></i>
        </a>
    </div>  
    @include('includes.footerscripts')
</body>
</html>
