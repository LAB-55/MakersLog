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

                        <div>
                               <button type="submit" class="btn green offset-md-1" :disabled="pushing" v-on:click="publish">Publish</button>
                                <button
                                    v-on:click="discardPost"
                                    class="btn red btn-danger waves-effect offset-md-2"> Discard</button>
                        </div>
                        <br>
                        <div class="card card-cascade narrower mb-r">
                            <div class="admin-panel info-admin-panel">
                                <div class="view primary-color">
                                    <h5>Categories</h5>
                                </div>
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
                            </div>
                        </div>
                        
                        <button id="uploadFilesPopUpBtn" class="btn btn-success waves-effect waves-light"><i class="fa fa-plus"></i>&nbsp; Add Attachments</button>
                        <ul id="files" class="list-group">
                            
                        </ul>
                        <!-- Modal -->
                        <div class="modal fade" id="myModal" role="dialog">
                            <div class="modal-dialog">
                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header" style="padding:35px 50px;">
                                        @if (Session::has('success'))
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="alert alert-info alert-dismissable">
                                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                                        {{ Session::get('success') }}
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4><span class="glyphicon glyphicon-lock"></span>Upload Attachments</h4>
                                    </div>
                                    <div class="modal-body" style="padding:40px 50px;">
                                        <form id="uploadDocuments" method="post" enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                            <div class="form-group" id="documents">
                                                <label>Documents: </label>
                                                <input type="file" id="multiFiles" class="form-control" name="documents[]" multiple required> 
                                            </div>
                                            <button  type="hidden" value="Submit"  class="btn btn-success" name="submit">Upload Documents</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
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
    <script>
        $(document).ready(function(){
            $("#uploadFilesPopUpBtn").click(function(){
                $("#myModal").modal();
            });
        });

        $(document).ready(function (e) {
            $('#multiFiles').change(function () {
                $('#uploadDocuments').submit();
            });

            $('#uploadDocuments').on('submit', function () {
                $.ajax({
                    url: "{{ route('uploadDocuments') }}",
                    dataType: 'text',
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: new FormData(this),
                    type: 'post',
                    success: function (response) {
                        $('#multiFiles').val('');
                        $("#myModal").modal('hide');
                        var data = JSON.parse(response);
                        $.each(data, function (index) {
                            var url = "/document/delete/" + data[index].document_id;
                            $('#files').append("<li class='list-group-item justify-content-between'>" 
                                                + data[index].document_name + 
                                                "<a class='deleteDoc' data-id='" + data[index].document_id + "'data-name='" + data[index].document_name + "' onClick='deleteDoc(this)'><span class='deleteDoc badge badge-primary badge-pill'><i class='fa fa-close' style='color:#f5f5f5'></i></span></a></li>");
                        })                        
                    },
                    error: function (response) {
                        $('#msg').html(response); // display error response from the PHP script
                    }
                });
            });
        });

        function deleteDoc(obj) {
            var document_id = obj.getAttribute('data-id'),
                two = obj.getAttribute('data-name');
            $.ajax({
                url: "../document/delete/"+document_id,
                dataType: 'text',
                cache: false,
                contentType: false,
                processData: false,
                data: document_id,
                type: 'post',
                success: function (response) {
                    $('.deleteDoc').filter('[data-id =' + document_id + ']').parent().remove();
                },
                error: function (response) {
                    $('#msg').html(response); // display error response from the PHP script
                }
            });
        }
        
    </script>

    <script type="text/javascript">

        // window.history.pushState('obj', '', '/?tab=recent');

        axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        $.ajaxSetup({
            headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') }
        });

          var tm = tinymce.init({
                    selector:'#post_content',
                    menubar: false,
                    height : "270",
                    plugins: "paste",
                    paste_data_images: true,
                    valid_elements: "b,a,p,strong,i,em,h1,h2,h3,h4,h5,ul,ol,li,,img,span",
                    invalid_elements:"*['class']"
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
