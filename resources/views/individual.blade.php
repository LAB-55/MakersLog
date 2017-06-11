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

                <div class="card-block jumbotron">
                    <div class="row">
                        <div class="col-md-2 col-sm-2">
                            
                            <a target="_blank" href="/{{ $u->g_username}}" class="media-left waves-light waves-effect waves-light"><img src="https://lh4.googleusercontent.com/-yIfvqErBAzA/AAAAAAAAAAI/AAAAAAAAAjg/DJ2vTnUnDdE/photo.jpg?sz=100" alt="image of {{$p->first_name}}" width="80" class="rounded-circle-imp"></a>
                        </div>
                        <div class="col-md-10 col-sm-10">
                            <h4 class="text-left"> {{ $p->p_title}}</h4>
                            <div class="rating inline-ul">
                                        by <a target="_blank" href="/fotariyajimish">Jimish Fotariya</a>
                            </div>
                            <hr>
                        </div>

                    </div>
                    
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