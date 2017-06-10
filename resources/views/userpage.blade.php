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
            <div class="container-fluid">
                <!-- First row -->
                <div class="row">
                     <!-- Second column -->
                    <div class="col-md-4 mb-1">
                        <div class="card contact-card with-padding">
                            <div class="card-body">
                                <div class="mt-1 mb-1">
                                    <img src="{{ $user->avatar }}" alt="" class="img-fluid rounded-circle contact-avatar mx-auto"/>
                                </div>
                                <h3 class="h3-responsive text-center">{{$user->first_name}} {{$user->last_name}}</h3>
                                <p class="text-center grey-text">{{$user->bio}}</p>
                                <ul class="striped">
                                    <li><strong>Username:</strong> {{$user->g_username}}</li>
                                    <li><strong>E-mail address:</strong> {{$user->email}}</li>
                                    @if( $user->mobile_number != "") 
                                    <li><strong>Mobile number:</strong> {{$user->mobile_number}}</li>
                                    @endif
                                    @if( $user->mobile_number != "") 
                                    <li><strong>Website:</strong> {{$user->website}}</li>
                                    @endif
                                    <li><strong>Total Blogs:</strong> {{$postcount}}</li>

                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- /.Second column -->
                    <!-- First column -->
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-12 mb-1">

                                <!--Card-->
                                <div class="card card-cascade narrower">
                                    <div class="admin-panel info-admin-panel">
                                        <!--Card image-->
                                        <div class="view">
                                            <h5>Blogs</h5>
                                        </div>
                                        <!--/Card image-->

                                        <!--Card content-->
                                        <div class="card-block">

                                            <div class="list-group">
                                                <a href="home v3.html#" class="list-group-item">Cras justo odio <i class="fa fa-wrench ml-auto" data-toggle="tooltip" data-placement="top" title="" data-original-title="Click to fix"></i></a>
                                                <a href="home v3.html#" class="list-group-item">Dapibus ac facilisi<i class="fa fa-wrench ml-auto" data-toggle="tooltip" data-placement="top" title="" data-original-title="Click to fix"></i></a>
                                                <a href="home v3.html#" class="list-group-item">Morbi leo risus <i class="fa fa-wrench ml-auto" data-toggle="tooltip" data-placement="top" title="" data-original-title="Click to fix"></i></a>
                                                <a href="home v3.html#" class="list-group-item">Porta ac consectet<i class="fa fa-wrench ml-auto" data-toggle="tooltip" data-placement="top" title="" data-original-title="Click to fix"></i></a>
                                                <a href="home v3.html#" class="list-group-item">Vestibulum at eros <i class="fa fa-wrench ml-auto" data-toggle="tooltip" data-placement="top" title="" data-original-title="Click to fix"></i></a>
                                            </div>

                                        </div>
                                        <!--/.Card content-->
                                    </div>
                                </div>
                                <!--/.Card-->
                            </div>
                        </div>
                    </div>
                    <!-- /.First column -->
                   
                </div>
                <!-- /.First row -->
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