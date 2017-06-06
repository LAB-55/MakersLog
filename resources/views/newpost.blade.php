<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    @include('includes.head')
    <script type="text/javascript" src="/js/vendor/tinymce/tinymce.min.js"></script>
</head>

    <body class="fixed-sn white-skin">
        
     <header>
        @include('includes.sidebar')
        @include('includes.navbar')

        
    </header>

    <!--Main layout-->
        <main class="">
        <div class="container">
            <!-- Section: Create Page -->
            <section class="section">
                <!-- First row -->
                <div class="row">
                    <!-- First col -->
                    <div class="col-lg-8">
                        <!-- First card -->
                        <div class="card mb-r">
                            <div class="card-block">
                                <div class="md-form mt-1 mb-0">
                                    <input type="text" id="form1" class="form-control">
                                    <label for="form1" class="">Blog title</label>
                                </div>
                                <div class="md-form mb-0">
                                    <textarea type="text" id="form7" class="md-textarea" rows="1"></textarea>
                                    <label for="form7">Blog Description in 140 characters</label>
                                </div>
                            </div>
                        </div>
                        
                        <div class="card mb-r">
                            <textarea name="" id="post_content" placeholder="Write content here.."></textarea>
                        </div>
                        
                    </div>
                    <!-- /.First col -->
                    <!-- Second col -->
                    <div class="col-lg-4">

                        <!-- Second card -->
                        <div class="card card-cascade narrower mb-r">
                            <div class="admin-panel info-admin-panel">
                                <!--Card image-->
                                <div class="view primary-color">
                                    <h5>Categories</h5>
                                </div>
                                <!--/Card image-->
                                <!--Card content-->
                                <div class="card-block ">
                                    <div class="check-list grey lighten-5 pad-lr-10 pad-tb-10">
                                        
                                        <fieldset class="form-group">
                                            <input type="checkbox" id="color-1">
                                            <label for="color-1">Material Design</label>
                                        </fieldset>
                                        <fieldset class="form-group">
                                            <input type="checkbox" id="color-2">
                                            <label for="color-2">Tutorials</label>
                                        </fieldset>
                                        <fieldset class="form-group">
                                            <input type="checkbox" id="color-3">
                                            <label for="color-3">Marketing Automation</label>
                                        </fieldset>
                                        <fieldset class="form-group">
                                            <input type="checkbox" id="color-4">
                                            <label for="color-4">Design Resources</label>
                                        </fieldset>
                                        <fieldset class="form-group">
                                            <input type="checkbox" id="color-5">
                                            <label for="color-5">Random Stories</label>
                                        </fieldset>

                                        <fieldset class="form-group">
                                            <input type="checkbox" id="color-5">
                                            <label for="color-5">Random Stories</label>
                                        </fieldset>
                                        <fieldset class="form-group">
                                            <input type="checkbox" id="color-5">
                                            <label for="color-5">Random Stories</label>
                                        </fieldset>
                                        <fieldset class="form-group">
                                            <input type="checkbox" id="color-5">
                                            <label for="color-5">Random Stories</label>
                                        </fieldset>
                                        <fieldset class="form-group">
                                            <input type="checkbox" id="color-5">
                                            <label for="color-5">Random Stories</label>
                                        </fieldset>

                                    </div>
                                    <br>
                                        <button class="btn green col-md-10 offset-md-1">Publish</button>
                                        <button class="btn red btn-danger waves-effect col-md-10 offset-md-2"> Discard</button>

                                </div>
                                <!--/.Card content-->
                            </div>
                        </div>
                        <!-- /.Second card -->
                    </div>
                    <!-- /.Second col -->
                </div>
                <!-- /.First row -->
            </section>
            <!-- /.Section: Create Page -->
        </div>
    </main>
    <!--/Main layout-->
    <script type="text/javascript" >
          tinymce.init({ selector:'#post_content', menubar: false, height : "270" });
    </script>
    @include('includes.footerscripts')
</body>

</html>