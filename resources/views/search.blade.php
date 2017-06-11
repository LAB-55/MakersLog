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
                            <div class="col-lg-12 pad-lr-30" v-if="users.length <= 0 && !userloading" v-cloak>
                                <div class="alert blue-text text-center" >Result Not Found</div>
                            </div>
                            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 pad-lr-10 pad-tb-10" v-for="user in users">
                                <div class="card testimonial-card view overlay hm-white-slight" v-cloak>
                                
                                <div class="card-up" :class="getColor(user.g_username,user.first_name,user.last_name)"></div>
                                <a v-bind:href="user.g_username">
                                        <div class="mask waves-effect waves-light"></div>
                                </a>
                                <div class="avatar"><img  width="100" v-bind:src="user.avatar" class="rounded-circle img-responsive">
                                </div>
                                <div class="card-block">
                                    <h4 class="card-title" >@{{user.first_name}} @{{user.last_name}}</h4>
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
                        <input type="search" id="form-autocomplete-b" class="form-control" placeholder="Search from what Makers think of"  v-model="text" v-on:keyup="typed">
                    </div>
                    <form class="scrollmenu new-scroll">
                            <fieldset class="form-group" v-for="(c, index) in categories">
                                <input type="checkbox" class="filled-in" v-on:click="search" v-model="c.checked" v-bind:id="'chk' + index.toString()">
                                <label v-bind:for="'chk' + index.toString()" >@{{ c.c_name }}</label>
                            </fieldset>
                        </form>
                        <br>
                        <br>
                   <div class="row pad-lr-20">
                        <div class="col-lg-12 pad-lr-30" v-if="logsCollection.length <= 0 && !postloading" v-cloak>
                            <div class="alert blue-text text-center" >Result Not Found</div>
                        </div>
                        <div class="col-md-12 pad-lr-10 pad-tb-10" v-for="p in logsCollection">
                            <div class="media mb-1">
                                <a target="_blank" :href="makeUrl(p.g_username)" class="media-left waves-light">
                                    <img class="rounded-circle-imp" v-bind:src="p.avatar" alt="image of @{{p.first_name}}" width="80">
                                </a>
                                    <div class="media-body pad-lr-20">
                                    <a target="_blank" :href="makeUrl(p.g_username,p.p_id,p.uri)">
                                        <h5 class="media-heading">@{{getLimit(p.p_title,100)}}</h5>
                                    </a>
                                        <ul class="rating inline-ul">
                                        by <a target="_blank" :href="makeUrl(p.g_username)">@{{ p.first_name+" "+p.last_name }}</a>
                                    </ul>
                                    <p>@{{getLimit(p.p_short_dec,140)}}</p>
                                   
                                    </div>
                            </div>
                            <hr />
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
    <div class="fx-action-btn" style="bottom: 45px; right: 24px;">
        <a title="Add new log" class="btn-floating btn-large red" href="/log/new">
            <i class="fa fa-pencil"></i>
        </a>
    </div>  
    @endif
     <div class="fx-action-btn" style="bottom: 55px; right: 95px;">
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
                colors:['red darken-1', 'grey darken-3', 'pink darken-1', 'teal darken-3', 'purple darken-2', 'yellow darken-2', 'indigo accent-4', 'green darken-2', 'deep-orange', 'deep-purple darken-3', 'mdb-color darken-3', 'cyan darken-2', 'brown']
            },
            mounted:function () {
                self=this;
                self.userloading=true
                    axios.post('/api/search',{ 'type':'user', 'offset':0 , 'limit':12 , 'qry':"" })
                      .then(function (response) {
                        self.users=response.data.collection;
                        self.userloading=false;
                      });
            },

            methods:{
                typed: function (e) {
                    clearTimeout(timeout);
                    self=this;
                    timeout = setTimeout(function () {
                    self.userloading=true
                        
                    axios.post('/api/search',{ 'type':'user', 'offset':0 , 'limit':12 , 'qry':self.text })
                      .then(function (response) {
                        // user
                        self.users=response.data.collection;
                        self.userloading=false;
                      })
                  }, 200);
                },
                getColor: function(name,salt1,salt2){
                        name = name+"_"+salt1+"+6"+salt2;
                        var t = 0;
                          for (var i = 0; i < name.length; i++){ 
                             name.charCodeAt(i).toString(2).split('').map(function(n){ t+=parseInt(n) });
                          }
                          t = t % this.colors.length;
                          return this.colors[t];
                }
            }
        });

        new Vue({
            el : "#panel52",
            data:{
                text: "",
                categories : [],
                collection:[],
                logsCollection:[],
                postloading:false,
            },
          
            methods:{
                typed: function (e) {
                    clearTimeout(timeout);
                    var self=this;
                    timeout = setTimeout(function () {
                        self.search();
                    }, 200);
                },
                search:function (e) {
                    var self=this;
                    var chkCat=self.categories.filter(function (element) {
                            return element.checked
                        });
                    // console.log(chkCat);
                    postloading:true;
                    axios.post('/api/search',{ 'type':'post', 'offset':0 , 'limit':12 , 'qry':self.text , 'categories':chkCat})
                      .then(function (response) {
                        //  logs
                        self.logsCollection=response.data.collection;
                        postloading:false;

                      })
                },
                makeUrl : function(){
                    var x = "";
                    if(arguments.length > 0){
                        for( var i in arguments ){
                            x += "/"+arguments[i];
                        }
                        return x;
                    }
                    return "/";
                },
                getLimit:function(str,lmt){
                    // console.log(str,lmt);
                    if( str.length > lmt+5 ){
                        var s = str.substr(0,lmt);
                        s = s.split(" ");
                        s.pop();
                        return s.join(" ")+"...";
                    }
                    return str;
                }

            },
            mounted:function () {
                var self = this;
                    self.search();
                    axios.post('/api/category', {}).then(function (response) {
                            self.categories = response.data.collection.map(function (e) {
                                e.checked = false;
                                return e;
                            });
                        });   
            }, 
        })

    </script>
    </script>
</body>

</html>