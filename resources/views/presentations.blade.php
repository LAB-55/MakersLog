<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    @include('includes.head')
</head>

    <body class="fixed-sn white-skin">
        
     <header>
        @include('includes.sidebar')
        @include('includes.navbar')
        
    </header>

    <!--Main layout-->
    <main class="">
        <form action="{{ route('presentations', ['gusermail' => $meta['gusermail']] ) }}" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
            <div class="form-group" id="ppt">
                <label>Title: </label>
                <div class="row">
                    <input type="text" class="form-control" name="title" placeholder="MakersLog" required>
                </div>
                <label>Presentation: </label>
                <div class="row">
                    <input type="file" class="form-control" name="ppt" value="ppt" required>
                </div>                        
            </div>
            <button type="submit" value="Submit"  class="btn btn-success" name="submit">Upload</button>
        </form>
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