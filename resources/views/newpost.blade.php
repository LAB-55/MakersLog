<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    @include('includes.head')
    <script type="text/javascript" src="/js/vendor/tinymce/tinymce.min.js"></script>
</head>

    <body class="@if(Auth::check()) fixed-sn @else hidden-sn @endif white-skin" style="display: none">

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
                                    <input type="text" v-model="logcontent.title" class="form-control" name="logcontent-title" :disabled="pushing" >
                                    <label for="form1" class="">Blog title</label>
                                </div>
                                <br>
                                <div class="md-form mb-0">
                                    <textarea name="logcontent-content" v-model="logcontent.desc" type="text" class="md-textarea" rows="1" :disabled="pushing" ></textarea>
                                    <label for="form7">Blog Description in around 140 characters</label>
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

                        <div>
                               <button type="submit" class="btn green offset-md-1" :disabled="pushing" v-on:click="publish">@{{ pushing ? 'Publishing' : 'Publish'}} </button>
                                <button
                                    v-on:click="discardPost"
                                    class="btn red btn-danger waves-effect offset-md-2"> Discard</button>
                        </div>
                        <br>
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
                                    <div id="new-scroll" class="check-list new-scroll grey lighten-5 pad-lr-10 pad-tb-10">

                                        <fieldset :ref= "'chk' + index.toString()" v-for="(c, index) in categories" class="form-group">

                                            <input  type="checkbox"
                                                    v-model="c.checked"
                                                    v-el="'chk' + index.toString()"
                                                    v-bind:id="'chk' + index.toString()"
                                                    :disabled="pushing"
                                                 >
                                            <label v-bind:for="'chk' + index.toString()">@{{ c.name }}</label>
                                        </fieldset>

                                    </div>
                                    <div class="form-group">

                                            <input  type="text"
                                                    id="newcategory"
                                                    v-model="newCategoryName"
                                                    v-on:keyup.enter="addCategory"
                                                    class="form-control"
                                                    name="newcategory"
                                                    placeholder="Make new category"
                                                    :disabled='catAddInProcess || pushing'
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
    @include('includes.footerscripts')
    @include('includes.models')
    <!--/Main layout-->
    <script type="text/javascript">

        // window.history.pushState('obj', '', '/?tab=recent');

        axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        $.ajaxSetup({
            headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') }
        });

        tinymce.init({
            selector: "#post_content",

            plugins: [
                "advlist autolink lists link image charmap print preview anchor",
                "searchreplace visualblocks fullscreen",
                "insertdatetime media table contextmenu paste"
            ],
            height:"270",
            file_browser_callback_types: 'image',
            file_picker_types: 'image',
            paste_data_images: true,
            
            file_picker_callback: function(callback, value, meta) {
                                // return console.log(meta);
                if( meta.filetype == 'image'){

                var input = document.createElement('input');
                    input.setAttribute('type', 'file');
                    input.setAttribute('accept', '.xlsx,.xls,.doc,.docx,.ppt, .pptx,.txt,.pdf,.ods,.odp,image/*,.mp4');
                    input.onchange = function() {
                      var file = this.files[0];
                      var reader = new FileReader();
                      reader.readAsDataURL(file);
                      reader.onload = function () {
                        var id = 'blobid' + (new Date()).getTime();
                        var blobCache =  tinymce.activeEditor.editorUpload.blobCache;
                        var base64 = reader.result.split(',')[1];
                        var blobInfo = blobCache.create(id, file, base64);
                        blobCache.add(blobInfo);
                        callback(blobInfo.blobUri(), { title: file.name });
                      };
                    };
                    
                    input.click();
                } 
          },
            toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
            invalid_elements:"*['class'],button",

        });

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
                haveToScroll : false,
                elmToScroll : null,

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
            updated : function(){
                if( this.haveToScroll && this.elmToScroll ){
                    var em = this.$refs[this.elmToScroll][0];
                    this.$el.querySelector("#new-scroll").scrollTop = em.offsetTop-100;
                    this.haveToScroll = false;
                    this.elmToScroll = null;
                }
            },
            methods:{
                addCategory : function ( e ) {
                    e.preventDefault();
                    var notFound = true, self = this, scrollid="#chk";
                    self.catAddInProcess = true;
                    this.newCategoryName = this.newCategoryName.trim().toLowerCase();
                    if( this.newCategoryName != ""  )
                    {
                        var em;
                       this.categories.forEach(function(e, i){

                            if ( e.name == self.newCategoryName ) {
                                toastr.info(self.newCategoryName + " checked");
                                e.checked = true;
                                notFound = false;
                                self.catAddInProcess = false;
                                self.newCategoryName = "";

                                em = 'chk'+i;
                                self.haveToScroll = true;
                                self.elmToScroll = em;
                            }
                        });
                        if( notFound ){
                            var self = this;
                            axios.post('/api/category/add', {
                                    c_name: self.newCategoryName,
                            }).then(function (response) {
                               toastr.success(self.newCategoryName + " added");
                                self.categories.push({ name: self.newCategoryName, checked:true });
                                self.catAddInProcess = false;
                                self.newCategoryName = "",

                                em = 'chk'+ (self.categories.length - 1);
                                console.log(em,self.categories.length);
                                self.haveToScroll = true;
                                self.elmToScroll = em;

                            });

                        }
                        // console.log(this.$refs[em][0]);

                    }
                    return;
                },
                publish : function(e){
                    // validate all
                    var self = this;
                    this.logcontent.content = tinymce.get('post_content').getContent();
                    // console.log(this.logcontent.content);
                    // return false;
                    if( this.logcontent.title.trim() == "" )
                    {
                        toastr.error("Log Title is required");
                         return;
                    }
                    else if(this.logcontent.desc.trim() == "" )
                    {
                        toastr.error("Log Description is required"); return;
                    }
                    else if( this.logcontent.content.trim() == "" ){
                        toastr.error("Please add Log content"); return;
                    }
                    this.pushing = true;
                    var categoriesToPush =  this.categories.filter(function( elm ){
                        return  elm.checked
                    });
                    tinymce.get('post_content').setMode('readonly');

                    axios.post('/api/log/publish', {
                                    p_title: self.logcontent.title ,
                                    p_short_desc: self.logcontent.desc,
                                    p_content: self.logcontent.content,
                                    categories: categoriesToPush,

                            }).then(function (response) {
                                pushing = false;
                                self.justShow();
                                // console.log(response.data);

                                // toastr.success("Post added");
                            })

                    return false;
                }, justShow:function(){
                    try {
                        $('#publishedModalInfo').modal({
                                backdrop:'static'
                        })
                        $('#publishedModalInfo').modal('show')
                    }catch(ex){
                        console.info("Caught: model is transitioning")
                    }
                 },
                 discardPost : function(){
                    confirm('Are you sure to discard all these?') ? location.reload() : null;
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

</html>`
