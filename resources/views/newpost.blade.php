<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    @include('includes.head')
    <script type="text/javascript" src="/js/vendor/tinymce/tinymce.min.js"></script>
</head>

    <body class="fixed-sn white-skin" style="display: none">
        
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
                    <div class="col-lg-4" id="category-scope">

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
                                    <div class="check-list new-scroll grey lighten-5 pad-lr-10 pad-tb-10">
                                        
                                        <fieldset v-for="(c, index) in categories" class="form-group">
                                            
                                            <input  type="checkbox" 
                                                    v-model="c.checked" 
                                                    v-el="'chk' + index.toString()"
                                                    v-bind:id="'chk' + index.toString()
                                                 ">
                                            <label v-bind:for="'chk' + index.toString()">@{{ c.name }}</label>
                                        </fieldset>                               

                                    </div>
                                    <div class="form-group">
                                            <input  type="text" 
                                                    v-model="newCategoryName"
                                                    v-on:keyup.enter="addCategory" 
                                                    class="form-control"
                                                    name="newcategory"
                                                    placeholder="Make new category" required=""
                                                    :disabled='catAddInProcess' />       
                                        
                                    </div>
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
    @include('includes.footerscripts')
    <script type="text/javascript">
    
        axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        new Vue({
            el: "#category-scope",
            data : {
                categories : [],
                newCategoryName : "",
                catAddInProcess : false,
                page : true,
            },
            mounted:function () {
                var self = this;
                    axios.get('/root/initial?'+Date.now().toString()+Math.floor(Math.random()*9999)+Date.now().toString()+Math.floor(Math.random()*9999) )
                    .then(function (r) {
                            r.data.say != "YmFyb2JhciBjaGUuIGFnYWwgamF2YSBkZQ==" ? (function () { window.location = "/?auth=0&failed=true"; self.page = false })() : $('body').show();
                    });   
                  
                    axios.post('/api/category', {}).then(function (response) {
                        self.categories = response.data.collection.map(function (e) {
                            e.name = e.c_name;
                            return e;
                        });
                  })
            },//ready
            methods:{
                addCategory : function ( e ) {
                    var notFound = true, self = this, scrollid="#chk";
                    self.catAddInProcess = true;
                    this.newCategoryName = this.newCategoryName.trim().toLowerCase();
                    if( this.newCategoryName != ""  )
                    {
                        this.categories.forEach(function(e, i){

                            if ( e.name == self.newCategoryName ) {
                                e.checked = true; 
                                notFound = false; 
                                self.catAddInProcess = false;
                                self.newCategoryName = "";
                                
                            }
                        });
                        if( notFound ){
                            var self = this;
                            axios.post('/api/category/add', {
                                    c_name: self.newCategoryName,
                            }).then(function (response) {
                               self.categories.push({ name: self.newCategoryName, checked:true });
                                self.catAddInProcess = false;
                                self.newCategoryName = "";
                            })

                        }

                    }
                    return;
                },

            },//methods
            watch: {
                page :function( val ){
                    if( !this.page ){
                        window.location = "/?auth=0&failed=true";
                    }
                }
            },
        })

    </script>
    <script type="text/javascript">
          tinymce.init({ selector:'#post_content', menubar: false, height : "270" });
    </script>
</body>

</html>