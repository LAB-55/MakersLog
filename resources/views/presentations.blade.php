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
        @if (Session::has('success'))
            <div class="row">
                <div class="col-lg-12">
                    <div class="alert alert-info alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        {{ Session::get('success') }}
                    </div>
                </div>
            </div>
        @endif
        <div class="container">
                <div class="card">
                    <h3 class="card-header default-color-dark white-text text-center">Upload Presentation</h3>
                    <div class="card-block">
                    <form action="{{ route('presentations', ['gusermail' => $meta['gusermail']] ) }}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                        <div class="form-group" id="ppt">
                            <label>Presentation: </label>
                            <input type="file" class="form-control" name="ppt" value="ppt" required> 
                        </div>
                        <button type="submit" value="Submit"  class="btn btn-success" name="submit">Upload</button>
                    </form>
                    </div>
                </div>
                <div class="card">
                    <h3 class="card-header default-color-dark white-text text-center">Presentations</h3>
                    <div class="card-block">
                        <div class="row pad-lr-15">
                            @foreach($presentations as $pre)
                            <div class="jumbotron p-card">
                                <a href="{{ route( 'presentationView', ['gusermail' => $meta['gusermail'], 'presentation_id' => $pre->presentation_id] ) }}" target="_blank"><img src="{{ $pre->thumbnail_url }}" class="img-fluid">
                                    <div class="p-card-title text-center teal-text">
                                        {{ $pre->title }}
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

    <div class="fixed-action-btn" style="bottom: 45px; right: 24px;">
        <a data-toggle="tooltip" data-placement="left" title="Add new log" class="btn-floating btn-large red">
            <i class="fa fa-pencil"></i>
        </a>
    </div>
    @include('includes.footerscripts')
</body>

</html>