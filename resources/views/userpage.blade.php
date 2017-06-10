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
                                    <img src="../../../../wp-content/uploads/2015/10/avatar-2.jpg" alt="" class="img-fluid rounded-circle contact-avatar mx-auto">
                                </div>
                                <h3 class="h3-responsive text-center">Anna Doe</h3>
                                <p class="text-center grey-text">Marketing Analyst</p>
                                <ul class="striped">
                                    <li><strong>E-mail address:</strong> a.doe@example.com</li>
                                    <li><strong>Phone number:</strong> +1 234 5678 90</li>
                                    <li><strong>Company:</strong> The Company, Inc</li>
                                    <li><strong>Twitter username:</strong> @anna.doe</li>
                                    <li><strong>Instagram username:</strong> @anna.doe</li>
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