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

    <main>
        <div class="container-fluid">
            <div class="row">
            @for ($i = count($contributors); $i > 0; $i--)
                <div class="contributor-card col-sm-6">
                    <div class="card testimonial-card">
                        <div class="col-sm-5">
                            <div class="card-up"></div>
                            <div class="avatar">
                                <a href="{{ $contributors[$i-1]['author']['html_url'] }}" target="_blank">
                                    <img src="{{ $contributors[$i-1]['author']['avatar_url'] }}" class="rounded-circle img-responsive">
                                </a>
                            </div>
                            <div class="card-block">
                                <h5 class="card-title">
                                    <a href="{{ $contributors[$i-1]['author']['html_url'] }}" target="_blank">
                                        {{ $contributors[$i-1]['author']['login'] }}
                                    </a>
                                </h5>
                                <hr>
                                <p>
                                    {{ $contributors[$i-1]['total'] }} Commits
                                </p>
                            </div>
                        </div>
                        <div class="col-sm-7">
                        </div>
                    </div>
                </div>
            @endfor
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
    @include('includes.footerscripts')
</body>

</html>