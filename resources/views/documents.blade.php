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
        <div class="container">
                <div class="card">
                    <h3 class="card-header default-color-dark white-text text-center">Documents</h3>
                    <div class="card-block">
                        <div class="row pad-lr-15">
                            @foreach($documents as $doc)
                            <div class="jumbotron p-card">
                                <a href="{{ route( 'documentView', ['gusermail' => $meta['gusermail'], 'googledrive_id' => $doc->googledrive_id] ) }}" target="_blank"><img src="{{ $doc->thumbnail_url }}" class="img-fluid">
                                    <div class="p-card-title text-center teal-text">
                                        {{ $doc->document_name }}
                                    </div>
                                </a>
                            </div>
                            @endforeach     
                        </div>
                    </div>
                </div>
        </div>
    </main>
    <!--/Main layout-->

    <form>
    
</form>

    <div class="fx-action-btn" style="bottom: 45px; right: 24px;">
        <a href="{{ route('createLog') }}" data-toggle="tooltip" data-placement="left" title="Add new log" class="btn-floating btn-large red">
            <i class="fa fa-pencil"></i>
        </a>
    </div>
    @include('includes.footerscripts')
</body>

</html>