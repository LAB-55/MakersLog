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
            <!-- Section: Edit Account -->
            <section class="section">
                <!-- First row -->
                <div class="row">
                    <!-- First column -->
                    <div class="col-lg-4">

                        <!-- Card -->
                        <div class="card contact-card card-cascade narrower mb-r">
                            <div class="admin-panel info-admin-panel">
                                <!-- Card title -->
                                <div class="view primary-color">
                                    <h5>Edit Photo</h5>
                                </div>
                                <!-- /.Card title -->

                                <!-- Card content -->
                                <div class="card-block text-center">
                                    <img src="{{ $meta['avatar']}}" alt="User Photo" class="rounded-circle contact-avatar my-2 mx-auto" />

                                    <p class="text-muted"><small>Profile photo will be changed automatically</small></p>

                                    <button class="btn btn-primary">Upload New Photo</button><br>
                                    <button class="btn btn-danger">Delete</button>
                                </div>
                                <!-- /.Card content -->
                            </div>
                        </div>
                        <!-- /.Card -->

                    </div>
                    <!-- /.First column -->
                    <!-- Second column -->
                    <div class="col-lg-8">
                        <!--Card-->
                        <div class="card card-cascade narrower mb-r">
                            <div class="admin-panel info-admin-panel">
                                <!--Card image-->
                                <div class="view primary-color">
                                    <h5>Edit Account</h5>
                                </div>
                                <!--/Card image-->
                                <!--Card content-->
                                <div class="card-block">
                                    <!-- Edit Form -->
                                    <form>
                                        <!--First row-->
                                        <div class="row">
                                            <!--First column-->
                                            <div class="col-md-6">
                                                <div class="md-form">
                                                    <input type="email" id="email" class="form-control validate" value="{{ $meta['email']}}">
                                                    <label for="email">Email address</label>
                                                </div>
                                            </div>
                                            <!--Second column-->
                                            <div class="col-md-6">
                                                <div class="md-form">
                                                    <input type="text" id="gusermail" class="form-control validate" value="{{ $meta['gusermail']}}">
                                                    <label for="gusermail" data-error="wrong" data-success="right">Username</label>
                                                </div>
                                            </div>
                                        </div>
                                        <!--First row-->
                                        <!--First row-->
                                        <div class="row">
                                            <!--First column-->
                                            <div class="col-md-6">
                                                <div class="md-form">
                                                    <input type="text" id="firstName" class="form-control validate" value="{{ $meta['firstName']}}">
                                                    <label for="firstName" data-error="wrong" data-success="right">First name</label>
                                                </div>
                                            </div>
                                            <!--Second column-->
                                            <div class="col-md-6">
                                                <div class="md-form">
                                                    <input type="text" id="lastName" class="form-control validate" value="{{ $meta['lastName']}}">
                                                    <label for="lastName" data-error="wrong" data-success="right">Last name</label>
                                                </div>
                                            </div>
                                        </div>
                                        <!--/.First row-->
                                        <!--Second row-->
                                        <div class="row">
                                            <!--First column-->
                                            <div class="col-md-6">
                                                <div class="md-form">
                                                    <input type="number" id="mobileNumber" class="form-control validate" value="{{ $meta['mobileNumber']}}" placeholder="9638947072">
                                                    <label for="mobileNumber">Mobile Number</label>
                                                </div>
                                            </div>
                                            <!--Second column-->
                                            <div class="col-md-6">
                                                <div class="md-form">
                                                    <input type="text" id="website" class="form-control validate" value="{{ $meta['website']}}" placeholder="http://www.makerslog.in">
                                                    <label for="website" data-error="wrong" data-success="right">Website Address</label>
                                                </div>
                                            </div>
                                        </div>
                                        <!--/.Second row-->
                                        <!--Third row-->
                                        <div class="row">
                                            <!--First column-->
                                            <div class="col-md-12">
                                                <div class="md-form">
                                                    <textarea type="text" id="bio" class="md-textarea">{{ $meta['bio']}}</textarea>
                                                    <label for="bio">About me</label>
                                                </div>
                                            </div>
                                        </div>
                                        <!--/.Third row-->
                                        <!--Fourth row-->
                                        <div class="row">
                                            <!--First column-->
                                            <div class="col-md-6">
                                                <div class="md-form">
                                                    <select id="gender" class="form-control validate">
                                                        <option name="{{ $meta['gender']}}" value="{{ $meta['gender']}}">{{ $meta['gender']}}</option>
                                                        <option name="Male" value="Male">Male</option>
                                                        <option name="Female" value="Female">Female</option>
                                                        <option name="Other" value="Other">Other</option>
                                                    </select>
                                                    <label for="gender">Gender</label>
                                                </div>
                                            </div>
                                            <!--Second column-->
                                            <div class="col-md-6">
                                                <div class="md-form">
                                                    <input type="date" id="birthday" class="form-control validate" value="{{ $meta['birthday']}}">
                                                    <label for="birthday" data-error="wrong" data-success="right">Birthdate</label>
                                                </div>
                                            </div>
                                        </div>
                                        <!--/.Fourth row-->
                                        <!-- Fifth row -->
                                        <div class="row">
                                            <div class="col-md-12 text-center">
                                                <input type="submit" value="Update Account" class="btn btn-primary">
                                            </div>
                                        </div>
                                        <!-- /.Fifth row -->
                                    </form>
                                    <!-- Edit Form -->
                                </div>
                                <!--/.Card content-->
                            </div>
                        </div>
                        <!--/.Card-->
                    </div>
                    <!-- /.Second column -->
                </div>
                <!-- /.First row -->
            </section>
            <!-- /.Section: Edit Account -->
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