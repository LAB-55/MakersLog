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
    <!--/.Double navigation-->

    <!--Main layout-->
    <main class="">
        <div class="container-fluid">

            <!--Section heading-->
                
                <h4 class="text-left"></h4>

            <div class="tabs-wrapper"> 
                <ul class="nav classic-tabs indigo tabs-2" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link waves-light active" data-toggle="tab" href="#panel51" role="tab">
                        <i class="fa fa-coffee pad-lr-10"></i>
                        Fellow Makers</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link waves-light" data-toggle="tab" href="#panel52" role="tab">
                        <i class="fa fa-list-ul pad-lr-10"></i>
                        Recent Logs</a>
                    </li>
                </ul>
            </div>

            <!-- Tab panels -->
            <div class="tab-content card">

                <!--Panel 1-->
                <div class="tab-pane fade in show active" id="panel51" role="tabpanel ">
                    <div class="md-form col-md-8 offset-md-2 ">
                        <input type="search" id="form-autocomplete-f" class="form-control" placeholder="Search Fellow Makers of TT17 " v-model="text" v-on:keyup="typed">
                    </div>

                    <div class="row pad-lr-20">
                            <div class="col-md-12 pad-lr-30" v-if="users.length <= 0 && !userloading" v-cloak>
                                <div class="alert blue-text text-center" >Result Not Found</div>
                            </div>
                            <div class="col-md-4 pad-lr-10 pad-tb-10" v-for="user in users">
                                <div class="card testimonial-card view overlay hm-white-slight" v-cloak>
                                
                                <div class="card-up default-color-dark"></div>
                                <a v-bind:href="user.g_username">
                                        <div class="mask waves-effect waves-light"></div>
                                </a>
                                <div class="avatar"><img  width="100" v-bind:src="user.avatar" class="rounded-circle img-responsive">
                                </div>
                                <div class="card-block">
                                    <h4 class="card-title" >@{{user.first_name}} @{{user.last_name}}</h4>
                                    <hr>
                                    <p > @{{ user.bio }}</p>
                                </div>
                                 <div class="card-data">
                                    <ul>
                                        <li ><i class="fa fa-bars" ></i> @{{user.post_count}} Logs</li>
                                    </ul>
                                </div>
                                </div>
                            </div>



                    </div>

                </div>
                <!--/.Panel 1-->

                <!--Panel 2-->
                <div class="tab-pane fade " id="panel52" role="tabpanel">
                    <div class="md-form col-md-8 offset-md-2 ">
                        <input type="search" id="form-autocomplete-b" class="form-control" placeholder="Search from what Makers think of">
                    </div>
                   <div class="row pad-lr-20">
                     
                        <div class="col-md-12 pad-lr-10 pad-tb-10">
                            <div class="media mb-1">
                                <a class="media-left waves-light">
                                    <img class="rounded-circle-imp" src="https://mdbootstrap.com/img/Photos/Avatars/avatar-13.jpg" alt="imag of p.name" width="80">
                                </a>
                                    <div class="media-body pad-lr-20">
                                    <a href="#">
                                        <h5 class="media-heading">Log nu bau lambu Title</h5>
                                    </a>
                                        <ul class="rating inline-ul">
                                        by him or her
                                    </ul>
                                    <p>Log description like, Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nisi cupiditate temporibus iure soluta. Quasi mollitia maxime nemo quam accusamus possimus, voluptatum expedita assumenda. Earum sit id ullam eum vel delectus!</p>
                                   
                                    </div>
                            </div>
                        </div>
                        <hr />
                        <div class="col-md-12 pad-lr-10 pad-tb-10">
                            <div class="media mb-1">
                                <a class="media-left waves-light">
                                    <img class="rounded-circle-imp" src="https://mdbootstrap.com/img/Photos/Avatars/avatar-13.jpg" alt="imag of p.name" width="80">
                                </a>
                                <div class="media-body pad-lr-20">
                                    <h5 class="media-heading">Log Title</h5>
                                    <ul class="rating inline-ul">
                                        by him or her
                                    </ul>
                                    <p>Log description like, Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nisi cupiditate temporibus iure soluta. Quasi mollitia maxime nemo quam accusamus possimus, voluptatum expedita assumenda. Earum sit id ullam eum vel delectus!</p>
                                   
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <!--/.Panel 2-->

            </div>
            <br>

        </div>
    </main>
    <!--/Main layout-->

    @if( Auth::check() )
    <div class="fixed-action-btn" style="bottom: 45px; right: 24px;">
        <a data-toggle="tooltip" data-placement="left" title="Add new log" class="btn-floating btn-large red">
            <i class="fa fa-pencil"></i>
        </a>
    </div>  
    @endif
     <div class="fixed-action-btn" style="bottom: 55px; right: 95px;">
        <a data-toggle="tooltip" data-placement="left" title="Goto top" class="btn-floating btn-med green">
            <i class="fa fa-chevron-up fa-1 med-btn-fonts" ></i>
        </a>
    </div>  
    @include('includes.footerscripts')
    <script type="text/javascript">
    var timeout=null;
        new Vue({
            el : "#panel51",
            data:{
                text: "",
                users: [],
                userloading:false,
            },
            mounted:function () {
                self=this;
                self.userloading=true
                axios.post('/api/search',{ 'type':'user', 'offset':0 , 'limit':12 , 'qry':"" })
                      .then(function (response) {
                        self.users=response.data.collection;
                        self.userloading=false;
                      })
                  },

            methods:{
                typed: function (e) {
                    clearTimeout(timeout);
                    self=this;
                    timeout = setTimeout(function () {
                    self.userloading=true
                        
                    axios.post('/api/search',{ 'type':'user', 'offset':0 , 'limit':12 , 'qry':self.text })
                      .then(function (response) {
                        self.users=response.data.collection;
                        self.userloading=false;
                      })
                  }, 200);
                }
            }
        });

        new Vue({
            el : "#panel52"
        })

    </script>
    </script>
</body>

</html>