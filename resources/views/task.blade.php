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
            <div class="row">
                
                <!-- First Col -->
                <div class="col-md-4">
                    <!--Panel-->
                    <div class="card">
                        <div class="card-header primary-color white-text">
                            Remaining
                        </div>
                        <div class="card-block tasks">
                            <div class="form-group">
                                <input type="text" id="addtask" class="form-control" name="addtask" placeholder="Add New Task" name="addtask" />
                            </div>
                            <!--Card Primary-->
                            <div class="card card-primary text-center z-depth-2 task_card">
                                <div class="card-block">
                                    <p class="white-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
                                </div>
                            </div>
                            <!--/.Card Primary-->
                            <!--Card Danger-->
                            <div class="card card-danger text-center z-depth-2 task_card">
                                <div class="card-block">
                                    <p class="white-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
                                </div>
                            </div>
                            <!--/.Card Danger-->
                            <!--Card Success-->
                            <div class="card card-success text-center z-depth-2 task_card">
                                <div class="card-block">
                                    <p class="white-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
                                </div>
                            </div>
                            <!--/.Card Success-->
                            <!--Card Warning-->
                            <div class="card card-warning text-center z-depth-2 task_card">
                                <div class="card-block">
                                    <p class="white-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
                                </div>
                            </div>
                            <!--/.Card Warning-->
                            <!--Card Info-->
                            <div class="card card-info text-center z-depth-2 task_card">
                                <div class="card-block">
                                    <p class="white-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
                                </div>
                            </div>
                            <!--/.Card Info-->
                            <!--Card Default-->
                            <div class="card default-color text-center z-depth-2 task_card">
                                <div class="card-block">
                                    <p class="white-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
                                </div>
                            </div>
                            <!--/.Card Default-->
                        </div>
                    </div>
                    <!--/.Panel-->
                </div>
                <!--/.First Col -->

                <!-- First Col -->
                <div class="col-md-4">
                    <!--Panel-->
                    <div class="card">
                        <div class="card-header primary-color white-text">
                            Help Me
                        </div>
                        <div class="card-block tasks">
                            <!--Card Primary-->
                            <div class="card card-primary text-center z-depth-2 task_card">
                                <div class="card-block">
                                    <p class="white-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
                                </div>
                            </div>
                            <!--/.Card Primary-->
                            <!--Card Danger-->
                            <div class="card card-danger text-center z-depth-2 task_card">
                                <div class="card-block">
                                    <p class="white-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
                                </div>
                            </div>
                            <!--/.Card Danger-->
                            <!--Card Success-->
                            <div class="card card-success text-center z-depth-2 task_card">
                                <div class="card-block">
                                    <p class="white-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
                                </div>
                            </div>
                            <!--/.Card Success-->
                            <!--Card Warning-->
                            <div class="card card-warning text-center z-depth-2 task_card">
                                <div class="card-block">
                                    <p class="white-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
                                </div>
                            </div>
                            <!--/.Card Warning-->
                            <!--Card Info-->
                            <div class="card card-info text-center z-depth-2 task_card">
                                <div class="card-block">
                                    <p class="white-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
                                </div>
                            </div>
                            <!--/.Card Info-->
                            <!--Card Default-->
                            <div class="card default-color text-center z-depth-2 task_card">
                                <div class="card-block">
                                    <p class="white-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
                                </div>
                            </div>
                            <!--/.Card Default-->
                        </div>
                    </div>
                    <!--/.Panel-->
                </div>
                <!--/.First Col -->

                <!-- First Col -->
                <div class="col-md-4">
                    <!--Panel-->
                    <div class="card">
                        <div class="card-header primary-color white-text">
                            Completed
                        </div>
                        <div class="card-block tasks">
                            <!--Card Primary-->
                            <div class="card card-primary text-center z-depth-2 task_card">
                                <div class="card-block">
                                    <p class="white-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
                                </div>
                            </div>
                            <!--/.Card Primary-->
                            <!--Card Danger-->
                            <div class="card card-danger text-center z-depth-2 task_card">
                                <div class="card-block">
                                    <p class="white-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
                                </div>
                            </div>
                            <!--/.Card Danger-->
                            <!--Card Success-->
                            <div class="card card-success text-center z-depth-2 task_card">
                                <div class="card-block">
                                    <p class="white-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
                                </div>
                            </div>
                            <!--/.Card Success-->
                            <!--Card Warning-->
                            <div class="card card-warning text-center z-depth-2 task_card">
                                <div class="card-block">
                                    <p class="white-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
                                </div>
                            </div>
                            <!--/.Card Warning-->
                            <!--Card Info-->
                            <div class="card card-info text-center z-depth-2 task_card">
                                <div class="card-block">
                                    <p class="white-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
                                </div>
                            </div>
                            <!--/.Card Info-->
                            <!--Card Default-->
                            <div class="card default-color text-center z-depth-2 task_card">
                                <div class="card-block">
                                    <p class="white-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
                                </div>
                            </div>
                            <!--/.Card Default-->
                        </div>
                    </div>
                    <!--/.Panel-->
                </div>
                <!--/.Third Col -->


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