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
                            <div class="card card-primary text-center task_card" v-for="(t, index) in tasks.open" :ref="'opencard'+index">
                                <div class="card-block">
                                    <p class="white-text">@{{ t.task }}</p>
                                </div>
                                <div class="card-data">
                                    <ul class="text-left">
                                        <li><button class="task_btn btn-flat" v-on:click="helpTask(t,index,'open')"><i class="fa fa-question pad-lr-10" title="Help Wanted!"></i></button></li>
                                        <li><button class="task_btn btn-flat" v-on:click="closedTask(t,index,'open')"><i class="fa fa-check pad-lr-10" title="Completed"></i></button></li>
                                        <li><button class="task_btn btn-flat" v-on:click="deleteTask(t,index,'open')"><i class="fa fa-trash pad-lr-10" title="Delete"></i></button></li>
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
                            <div class="card card-warning text-center task_card" v-for="(t, index) in tasks.help" :ref="'helpcard'+index">
                                <div class="card-block">
                                    <p class="white-text">@{{ t.task }}</p>

                                </div>
                                <div class="card-data">
                                    <ul class="text-left">
                                        <li><button class="task_btn btn-flat" v-on:click="openTask(t,index,'help')"><i class="fa fa-sticky-note pad-lr-10" title="Remaining"></i></button></li>
                                        <li><button class="task_btn btn-flat" v-on:click="closedTask(t,index,'help')"><i class="fa fa-check pad-lr-10" title="Completed"></i></button></li>
                                        <li><button class="task_btn btn-flat" v-on:click="deleteTask(t,index,'help')"><i class="fa fa-trash pad-lr-10" title="Delete"></i></button></li>
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
                            <div class="card card-success text-center task_card" v-for="(t, index) in tasks.closed" :ref="'closedcard'+index">
                                <div class="card-block">
                                    <p class="white-text">@{{ t.task }}</p>
                                </div>
                                <div class="card-data">
                                    <ul class="text-left">     
                                        <li><button class="task_btn btn-flat" v-on:click="openTask(t,index,'closed')"><i class="fa fa-sticky-note pad-lr-10" title="Remaining"></i></button></li>
                                        <li><button class="task_btn btn-flat" v-on:click="helpTask(t,index,'closed')"><i class="fa fa-question pad-lr-10" title="Help Wanted!"></i></button></li>
                                        <li><button class="task_btn btn-flat" v-on:click="deleteTask(t,index,'closed')"><i class="fa fa-trash pad-lr-10" title="Delete"></i></button></li>
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

    <div class="fx-action-btn">
        <a href="{{ route('createLog') }}" data-toggle="tooltip" data-placement="left" title="Add new log" class="btn-floating btn-large red">
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
          function AnimTask(refElm, style, fn ){
            this.refElm = refElm;
            this.style  = style;
            this.fn = fn;
          }
       var task = new Vue ({    
            
            el: "#task",
            
            data : {
                newTask : "",
                tasks   : {
                    open : [],
                    help : [],
                    closed : [],
                },
                toAnimateBefore: [], 
                toAnimateAfter: [],
                clicks: 0,
                timer: null
            },
            beforeUpdate : function(){
                if( this.toAnimateBefore.length > 0 ){
                    while(this.toAnimateBefore.length != 0 ){
                        var animTask = this.toAnimateBefore.shift();
                        // console.log('beforeUpdate', animTask.refElm )
                        $( this.$refs[animTask.refElm][0] ).animateCss( animTask.style );
                    }
                        if( animTask.fn != undefined )
                            setTimeout( animTask.fn, 500 );
                }
            },
            updated:function(){
                if( this.toAnimateAfter.length > 0 ){
                    while(this.toAnimateAfter.length != 0 ){
                        var animTask = this.toAnimateAfter.shift();
                        // console.log('After Update', animTask.refElm )
                        $( this.$refs[animTask.refElm][0] ).animateCss( animTask.style );
                    }
                }
            },
            mounted:function () {
                var self = this;
                axios.post('/api/{{ $gusermail }}/tasks/show', {})
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
                            self.toAnimateAfter.push( new AnimTask("opencard0", 'flipInX') )
                        });
                    }
                },
                deleteTask : function ( t, index, targetFrom ) {
                    if(confirm('Are you sure to delete?')){
                        var self = this;
                        // console.log(self.$refs[targetFrom+"card"+index][0]);
                        axios.post('/api/{{ $gusermail }}/tasks/delete', {
                                id: t.id,
                        }).then(function (response) {
                            toastr.error(t.task + " Deleted");
                            var animTask =   new AnimTask ( 
                                                            targetFrom+"card"+index,
                                                            'rollOut', 
                                                            function(){
                                                             self.tasks[targetFrom].splice(index,1);
                                                            }
                                                        );
                            self.toAnimateBefore.push( animTask );
                            // $(self.$refs["opencard"+index][0]).animateCss('');

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

                        self.toAnimateBefore.push( new AnimTask ( 
                                                            targetFrom + "card" + index,
                                                            targetFrom == 'help' ? 'slideOutLeft' : 'slideOutRight',
                                                            function(){  self.tasks[targetFrom].splice(index,1)  }
                                                        )
                                                 );

                        self.tasks.open.unshift(t);
                        self.toAnimateAfter.push( new AnimTask (
                                                        "opencard0",
                                                        targetFrom == 'help' ? 'slideInRight' : 'slideInLeft',
                                                    )
                                                );
                    });        
                },
                helpTask : function ( t, index, targetFrom) {
                    var self = this;             
                    axios.post('/api/{{ $gusermail }}/tasks/help', {
                            id: t.id,
                    }).then(function (response) {
                        t.updated_at = response.data.updated_at;
                        toastr.warning(t.task + " Added in to Help Wanted!");

                        self.toAnimateBefore.push( new AnimTask (
                                                        targetFrom + "card" + index,
                                                        targetFrom == 'closed' ? 'slideOutLeft' : 'slideOutRight',
                                                        function(){ self.tasks[targetFrom].splice(index,1); }
                                                    )
                                                );
                        self.tasks.help.unshift(t);
                        self.toAnimateAfter.push( new AnimTask (
                                                        "helpcard0",
                                                        targetFrom == 'closed' ? 'slideInRight' : 'slideInLeft',
                                                    )
                                                );
                    });
                },
                closedTask : function ( t, index, targetFrom) {
                    this.moving = true;
                    var self = this;
                    axios.post('/api/{{ $gusermail }}/tasks/closed', {
                            id: t.id,
                    }).then(function (response) {
                        t.updated_at = response.data.updated_at;
                        toastr.success(t.task + " Added in to Completed");
                        
                        self.toAnimateBefore.push( new AnimTask (
                                                        targetFrom + "card" + index,
                                                        targetFrom == 'open' ? 'slideOutLeft' : 'slideOutRight',
                                                        function(){ self.tasks[targetFrom].splice(index,1); }
                                                    )
                                                );
                        
                        self.tasks.closed.unshift(t);
                        self.toAnimateAfter.push( new AnimTask (
                                                        "closedcard0",
                                                        targetFrom == 'open' ? 'slideInRight' : 'slideInLeft',
                                                    )
                                                );                       

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