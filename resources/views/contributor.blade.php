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
        <ul class="list-group">
            @for ($i = 0; $i < 4; $i++)
                <li class='list-group-item justify-content-between documents'>
                    <a href="{{ $contributors[$i]['html_url'] }}" target="_blank">{{ $contributors[$i]['login'] }}</a>
                </li>
            @endfor
        </ul>
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