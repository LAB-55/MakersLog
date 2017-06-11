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

    <!--Main layout-->
    <main class="">
        <div class="container-fluid">
            <div class="container-blog">
            <!--Section heading-->

                <div class="card-block">
                    <h4 class="text-left"> {{ $p->p_title}}</h4>
                    <hr>
                    
                </div>        
            </div>
        </div>
    </main>
    <!--/Main layout-->

    <div class="fixed-action-btn" style="bottom: 45px; right: 24px;">
        <a data-toggle="tooltip" data-placement="left" title="Add new log" class="btn-floating btn-large red">
            <i class="fa fa-pencil"></i>
        </a>
    </div>
    @include('includes.footerscripts')
</body>

</html>