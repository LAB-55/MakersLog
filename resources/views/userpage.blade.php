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
                                              <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                                                <div class="d-flex w-100 justify-content-between">
                                                  <h4 class="mb-1">List group item heading</h4>
                                                  <small>3 days ago</small>
                                                </div>
                                                <p class="mb-1">Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.</p>
                                                <small>Donec id elit non mi porta.</small>
                                              </a>
                                              <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                                                <div class="d-flex w-100 justify-content-between">
                                                  <h4 class="mb-1">List group item heading</h4>
                                                  <small class="text-muted">3 days ago</small>
                                                </div>
                                                <p class="mb-1">Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.</p>
                                                <small class="text-muted">Donec id elit non mi porta.</small>
                                              </a>
                                              <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                                                <div class="d-flex w-100 justify-content-between">
                                                  <h4 class="mb-1">List group item heading</h4>
                                                  <small class="text-muted">3 days ago</small>
                                                </div>
                                                <p class="mb-1">Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.</p>
                                                <small class="text-muted">Donec id elit non mi porta.</small>
                                              </a>
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