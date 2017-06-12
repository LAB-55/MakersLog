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
                <!-- First row -->
                <div class="row">
                    @if( $user->provider_id != Auth::user()->provider_id )
                    <div class="col-md-3 mb-1">
                        <div class="card contact-card with-padding">
                            <div class="card-body text-center text-overflow-ellipsis">
                                <div class="mt-1 mb-1">
                                    <img src="{{ $user->avatar }}" alt="" class="img-fluid rounded-circle contact-avatar mx-auto"/>
                                </div>
                                <h3 class="h3-responsive">{{$user->first_name}} {{$user->last_name}}</h3>
                                <p class="text-center grey-text">{{$user->bio}}</p>
                                <ul class="striped">
                                    <li class="text-overflow-ellipsis"> {{$user->g_username}}</li>
                                    <li class="text-overflow-ellipsis"> <a href="mailto:{{$user->email}}"> {{$user->email}} </a></li>
                                    {{-- @if( $user->mobile_number != "")  --}}
                                    {{-- <li><strong>Mobile number:</strong> {{$user->mobile_number}}</li> --}}
                                    {{-- @endif --}}
                                    @if( $user->website != "") 
                                    <li><strong>Website:</strong> {{$user->website}}</li>
                                    @endif
                                    <li><strong>Total Blogs:</strong> {{$postcount}}</li>

                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9">
                    @else
                    <div class="col-md-12">
                    @endif
                        <div class="row">
                            <div class="col-md-12 mb-1">

                                <!--Card-->
                                <div class="card card-cascade narrower">
                                    <div class="admin-panel info-admin-panel">

                                        <!--Card content-->
                                        <div class="card-block">

                                            <div class="list-group">
                                              <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                                                <div class="d-flex w-100 justify-content-between">
                                                  <h4 class="mb-1">Lambu Lambu title { { p.title } } </h4>
                                                  <small> { { p.time_ago } }</small>
                                                </div>
                                                <p class="mb-1">{ { p.p_short_dec. } }</p>
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