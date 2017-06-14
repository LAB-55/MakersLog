<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    @include('includes.head')
    <script type="text/javascript" src="/js/vendor/tinymce/tinymce.min.js"></script>
</head>

    <body class="@if(Auth::check()) fixed-sn @else hidden-sn @endif white-skin">
        
     <header>
        @include('includes.sidebar')
        @include('includes.navbar')
        
    </header>

    <!--Main layout-->
    <main class="" id="task">
        <div class="container-fluid" v-cloak>
            <div class="row">

                <!-- First Col -->
                <div class="col-md-4">
                    <!--Panel-->
                    <div class="card">
                        <div class="card-header blue-color darken-2 white-text">
                           <i class="fa fa-sticky-note pad-lr-10"></i> Remaining
                        </div>
                        <div class="card-block">
                            <div class="form-group">
                                <input  type="text" 
                                        id="task" 
                                        class="form-control" 
                                        name="task" 
                                        placeholder="Add New Task"
                                        v-model="newTask"
                                        v-on:keyup.enter="addTask" />
                            </div>
                        <div class="tasks_open">
                            <!--Card Primary-->
                            <div class="card card-primary text-center task_card" v-for="(t, index) in tasks.open">
                                <div class="card-block">
                                    <p class="white-text">@{{ t.task }}</p>
                                </div>
                                <div class="card-data">
                                    <ul class="text-left">
                                        <li><i type="submit" class="fa fa-question pad-lr-10" v-on:click="helpTask(t,index,'open')" title="Help Wanted!"></i></li>
                                        <li><i type="submit" class="fa fa-check pad-lr-10" v-on:click="closedTask(t,index,'open')" title="Completed"></i></li>
                                        <li><i type="submit" class="fa fa-trash pad-lr-10" v-on:click="deleteTask(t,index,'open')" title="Delete"></i></li>
                                        <li class="time_right"><i class="fa fa-clock-o " area-hidden="true"></i>
                                                   @{{ t.updated_at }}</small></li>
                                    </ul>
                                </div>
                            </div>
                            <!--/.Card Primary-->
                        </div>
                        </div>
                    </div>
                    <!--/.Panel-->
                </div>
                <!--/.First Col -->

                <!-- Second Col -->
                <div class="col-md-4">
                    <!--Panel-->
                    <div class="card">
                        <div class="card-header warning-color white-text">
                            <i class="fa fa-question pad-lr-10"></i> Help Wanted
                        </div>
                        <div class="card-block">
                            <div class="tasks">
                            <div class="card card-warning text-center task_card" v-for="(t, index) in tasks.help">
                                <div class="card-block">
                                    <p class="white-text">@{{ t.task }}</p>

                                </div>
                                <div class="card-data">
                                    <ul class="text-left">
                                        <li><i type="submit" class="fa fa-sticky-note pad-lr-10" v-on:click="openTask(t,index,'help')" title="Remaining"></i></li>
                                        <li><i type="submit" class="fa fa-check pad-lr-10" v-on:click="closedTask(t,index,'help')" title="Completed"></i></li>
                                        <li><i type="submit" class="fa fa-trash pad-lr-10" v-on:click="deleteTask(t,index,'help')" title="Delete"></i></li>
                                        <li class="time_right"><i class="fa fa-clock-o " area-hidden="true"></i>
                                                   @{{ t.updated_at }}</small></li>
                                    </ul>
                                </div>
                            </div>
                            </div>
                            <!--/.Card Primary-->
                        </div>
                            
                    </div>
                    <!--/.Panel-->
                </div>
                <!--/.Second Col -->

                <!-- Third Col -->
                <div class="col-md-4">
                    <!--Panel-->
                    <div class="card">
                        <div class="card-header success-color white-text">
                            <i class="fa fa-check pad-lr-10"></i> Completed
                        </div>
                        <div class="card-block">
                            <div class="tasks">
                            <div class="card card-success text-center task_card" v-for="(t, index) in tasks.closed">
                                <div class="card-block">
                                    <p class="white-text">@{{ t.task }}</p>
                                </div>
                                <div class="card-data">
                                    <ul class="text-left">     
                                        <li><i type="submit" class="fa fa-sticky-note pad-lr-10" v-on:click="openTask(t,index,'closed')" title="Remaining"></i></li>
                                        <li><i type="submit" class="fa fa-question pad-lr-10" v-on:click="helpTask(t,index,'closed')" title="Help Wanted!"></i></li>
                                        <li><i type="submit" class="fa fa-trash pad-lr-10" v-on:click="deleteTask(t,index,'closed')" title="Delete"></i></li>
                                        <li class="time_right"><i class="fa fa-clock-o " area-hidden="true"></i>
                                                   @{{ t.updated_at }}</small></li>
                                    </ul>
                                </div>
                            </div>
                            </div>
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
    <script type="text/javascript">
    
        // window.history.pushState('obj', '', '/?tab=recent');

        axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        $.ajaxSetup({
            headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') }
        });
          
       new Vue ({    
            
            el: "#task",
            
            data : {
                newTask : "",
                tasks   : {
                    open : [],
                    help : [],
                    closed : [],
                },
            },
            
            mounted:function () {
                var self = this;
                axios.post('/api/{{ $gusermail }}/tasks/show/', {})
                .then(function (response) {
                    response.data.collection.forEach(function(elm, index){
                        self.tasks[ elm.status ].unshift(elm);
                    })
               })
            },
            
            methods: {
                addTask : function ( e ) {
                    if( this.newTask != "" ) {
                        var self = this;
                        axios.post('/api/{{ $gusermail }}/tasks/add', {
                                task: self.newTask,
                        }).then(function (response) {
                            response.data.elm.updated_at = response.data.updated_at;
                           toastr.info(self.newTask + " Added");
                            self.newTask = "";
                            self.tasks['open'].unshift(response.data.elm);
                        });
                    }
                },
                deleteTask : function ( t, index, targetFrom ) {
                    if(confirm('Are you sure to delete?')){
                        var self = this;
                        axios.post('/api/{{ $gusermail }}/tasks/delete', {
                                id: t.id,
                        }).then(function (response) {
                            toastr.error(t.task + " Deleted");
                            self.tasks[targetFrom].splice(index,1);
                        });
                    }
                },
                openTask : function ( t, index, targetFrom) {
                    var self = this;
                    axios.post('/api/{{ $gusermail }}/tasks/open', {
                            id: t.id,
                    }).then(function (response) {
                        t.updated_at = response.data.updated_at;
                        toastr.info(t.task + " Added in to Remaining");
                        self.tasks[targetFrom].splice(index,1);
                        self.tasks.open.unshift(t);
                    });
                },
                helpTask : function ( t, index, targetFrom) {
                    var self = this;             
                    axios.post('/api/{{ $gusermail }}/tasks/help', {
                            id: t.id,
                    }).then(function (response) {
                        t.updated_at = response.data.updated_at;
                        toastr.warning(t.task + " Added in to Help Wanted!");
                        self.tasks[targetFrom].splice(index,1);
                        self.tasks.help.unshift(t);
                    });
                },
                closedTask : function ( t, index, targetFrom) {
                    var self = this;
                              
                    axios.post('/api/{{ $gusermail }}/tasks/closed', {
                            id: t.id,
                    }).then(function (response) {
                        t.updated_at = response.data.updated_at;
                        toastr.success(t.task + " Added in to Completed");
                        self.tasks[targetFrom].splice(index,1);
                        self.tasks.closed.unshift(t);
                    });
                },
            },
            watch: {
                page :function( val ){
                    if( !this.page ){
                        window.location = "/?auth=0&failed=true";
                    }
                }
            },
        })

    </script>

</body>

</html>