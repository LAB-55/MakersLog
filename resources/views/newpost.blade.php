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
        <main class="" id="editor-scope">

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
                                    <input type="text" v-model="logcontent.title" class="form-control" name="logcontent-title" >
                                    <label for="form1" class="">Blog title</label>
                                </div>
                                <div class="md-form mb-0">
                                    <textarea name="logcontent-content" v-model="logcontent.desc" type="text" class="md-textarea" rows="1" ></textarea>
                                    <label for="form7">Blog Description in 140 characters</label>
                                </div>
                            </div>
                        </div>
                        
                        <div class="card mb-r">
                            <textarea v-model="logcontent.content" id="post_content" placeholder="Write content here.." ></textarea>
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
                                            <input type="text" 
                                                    v-model="newCategoryName"
                                                    v-on:keyup.enter="addCategory" 
                                                    class="form-control"
                                                    name="newcategory"
                                                    placeholder="Make new category" 
                                                    :disabled='catAddInProcess'
                                                    name="newcategory" />       
                                        
                                    </div>
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
    
        // window.history.pushState('obj', '', '/?tab=recent');

        axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
          
          var tm = tinymce.init({ selector:'#post_content', menubar: false, height : "270" });

       new Vue({    
            el: "#editor-scope",
            data : {
                pushing: false,
                categories : [],
                newCategoryName : "",
                catAddInProcess : false,
                page : true,
                logcontent : {
                    title : "",
                    desc : "",
                    content : "",
                },
            },
            // componets:{
            //     VueTinymce :
            // }
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
                    e.preventDefault();
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
                                toastr.info(self.newCategoryName +' checked');  
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
                                toastr.info(self.newCategoryName +' Added');  
                                self.newCategoryName = "";
                            });

                        }

                    }
                    return;
                },
                publish : function(e){
                    // validate all 
                    var self = this;
                    this.logcontent.content = tinymce.get('post_content').getContent();
                    tinymce.get('post_content').setMode('readonly');

                    var categoriesToPush =  this.categories.filter(function( elm ){
                        return  elm.checked
                    });
                    axios.post('/api/log/publish', {
                                    p_title: self.logcontent.title ,
                                    p_short_desc: self.logcontent.desc,
                                    p_content: self.logcontent.content,
                                    categories: categoriesToPush,

                            }).then(function (response) {
                                console.log(response.data);
                            })

                    return false;
                }

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
</body>

</html>