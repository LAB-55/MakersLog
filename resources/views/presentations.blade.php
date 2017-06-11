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
        <div class="container-fluid">
                <div class="row">
                    <form action="{{ route('presentations', ['gusermail' => $meta['gusermail']] ) }}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                        <div class="form-group" id="ppt">
                            <label>Title: </label>
                            <input type="text" class="form-control" name="title" placeholder="MakersLog" required>
                            <label>Presentation: </label>
                            <input type="file" class="form-control" name="ppt" value="ppt" required> 
                        </div>
                        <button type="submit" value="Submit"  class="btn btn-success" name="submit">Upload</button>
                    </form>
                </div>
                <h2 class="text-center">Presentations</h2>
                <div class="row">
                    @foreach($presentations as $pre)
                    <div class="col-lg-2 text-center">
                        <a href="{{ route( 'presentationView', ['gusermail' => $meta['gusermail'], 'title' => $pre->title] ) }}" target="_blank"><img src="{{ $pre->thumbnail_url }}"></a>
                        <a href="{{ route( 'presentationView', ['gusermail' => $meta['gusermail'], 'title' => $pre->title] ) }}" target="_blank">{{ $pre->title }}</a>
                    </div>
                    @endforeach
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