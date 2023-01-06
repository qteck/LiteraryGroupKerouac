@extends('/admin/layout') 

@section('content_admin')
<!-- include summernote -->
<script type="text/javascript" src="{{url('/') }}/vendor/summernote/summernote.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    var path = window.location.pathname.split('/');
    var idFromPath = +path[path.length - 1];
    $(".toggleTitleAndDescription a").click(function(){
      $("#toggleFields").toggle('fast', function(){
        var span = $(".toggleTitleAndDescription a span");
        if(span.attr('class') == 'glyphicon glyphicon-triangle-top'){
            span.attr('class','glyphicon glyphicon-triangle-bottom');
        }else{
            span.attr('class','glyphicon glyphicon-triangle-top');
        }

      });
    });

   var wobbleIt = function (status, val){
             var statusOfArticle = $('#statusOfArticle');

                 statusOfArticle.text(status);

                statusOfArticle.parent().addClass('animated wobble');
                statusOfArticle.parent().on( 'webkitAnimationEnd mozAnimationEnd oAnimationEnd oanimationend animationend', function() 
                {
                        statusOfArticle.parent().removeClass('animated wobble');
                        $.each(val, function(index, value){
                             $(index).val(value);
                        });
                       
                });
   }


       $("input[name='status']").click(function(){
        var statusOfArticle = $('#statusOfArticle');

        if($(this).attr('id') == 'publish'){
        if ($('#articleTitle').val().length < 3) {
            alert('Title has to be longer than 3 letters.');
            return false;
        } else if ($('#summernote').val().length < 100) {
            alert('Description has to contain more than 100 characters.');
            return false;
        } else if ($('#summernote1').val().length < 1000) {
            alert('You cannot publish an article with less than 1000 characters.');
            return false;
        } else if ($('#articlePlace').val().length < 3) {
            alert('Place should contain the city and the coutry of writing separated by comma.');
            return false;
        }

           articleAjaxUpdate(function(success) { 
                 wobbleIt('published', {'#publish' : 'Update', '#draft' : 'Draft it'});
            }, function(errr) {
                console.log(errr)
            }, 'Publish');

            eventViewer('Article has been published.');
        }else{
          console.log($(this).attr('id'));
            articleAjaxUpdate(function(success) {
                wobbleIt('draft', {'#publish' : 'Publish', '#draft' : 'Save Draft'});
            }, function(errr) {
                console.log(errr);
            });
            eventViewer('Draft has been manually saved');

          $("#statusOfArticle").text('draft');
        }

        return false;
       });

        $("input[name='title'], input[name='place']").blur(function() {
            articleAjaxUpdate(function(success) {
                console.log(success)
            }, function(errr) {
                console.log(errr)
            });
            eventViewer('Article has been saved');
        });

        $("textarea[name='storyline']").blur(function() {
            storylineAjaxUpdate();
            eventViewer('Storyline has been saved');
        });

    

    var strokeCount = 0;
    $("textarea[name='storyline']").keyup(function() {
        strokeCount = ++strokeCount;

        if (strokeCount > 100) {
            storylineAjaxUpdate();
            eventViewer('Storyline has been saved');
            strokeCount = 0;
        }
    });

    function eventViewer(msg) {
        var date = new Date();

        var minutes = date.getMinutes();
        var hours = date.getHours();
        var seconds = date.getSeconds();

        $(".eventManager .menu-title").after("<p>" + msg + "<span class='small'> (" + hours + ":" + minutes + ":" + seconds + ")</span></p>");
        $(".eventManager p:eq(1)").fadeOut(6000);
    }

    function storylineAjaxUpdate(success = '', error = '') {
        var storyline = $("textarea[name='storyline']").val();
        var token = $("input[name='_token']").val();

        $.ajax({
            type: 'PATCH',
            url: "{{ url('/') }}/admin/dealer/add-article/storyline/{{ $articleToEdit->id }}",
            dataType: 'json',
            data: {
                'storyline': storyline,
                '_token': token
            },
            success: success,
            error: error,
        });
    }

    function articleAjaxUpdate(success = '', error = '', statusArg = '') {
        var title = $("input[name='title']").val();
        var scheduledTime = $("input[name='scheduledTime']").val();
        var scheduledDate = $("input[name='scheduledDate']").val();
        var summernote = $('#summernote').val();
        var summernote1 = $('#summernote1').val();
        var status = !statusArg ? 'Save draft': statusArg;
        console.log('bob'+status);
        var place = $("input[name='place']").val();
        var token = $("input[name='_token']").val();

        $.ajax({
            type: 'PATCH',
            url: "{{ url('/admin/dealer/update-article/'.$articleToEdit->id) }}",
            dataType: 'json',
            data: {
                'title': title,
                'content_in_brief': summernote,
                'content': summernote1,
                'place': place,
                'status': status,
                'scheduledTime': scheduledTime,
                'scheduledDate': scheduledDate,
                '_token': token
            },
            success: success,
            error: error,
        });
    }


    $("button[name='preview']").click(function() {

        var title = $("input[name='title']").val();
        var summernote = $('#summernote').val();
        var summernote1 = $('#summernote1').val();
        var place = $("input[name='place']").val();

        $(".grid8 h2").text(title);
        $('.grid4 .contentInBrief').html(summernote);
        $('.grid8 .text').html(summernote1);
        $(".grid4 .place").text(place);
    });

    $("input[name='storylineSubmit']").click(function() {

        var dots = "<span class='loader__dot'>.</span><span class='loader__dot'>.</span><span class='loader__dot'>.</span>";
        var success = "<span class='glyphicon glyphicon-ok text-success'></span>";
        var error = "<span class='glyphicon glyphicon-remove text-danger'></span>";

        var alertAjax = $(".alertAjaxState");

        alertAjax.css('display', 'initial');
        alertAjax.html(dots);

        storylineAjaxUpdate(
            function(responseSuccess) {
                alertAjax.html(success).fadeOut(4000, function() {
                    alertAjax.empty();
                })
            },
            function(responseError) {
                alertAjax.html(error);
            });

        return false;
    });

    var summernoteChars = 0;
    $('#summernote').summernote({
        placeholder: 'add a brief description...',
        height: 100,
        toolbar: [
            // [groupName, [list of button]]
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['font', ['strikethrough', 'superscript', 'subscript']],
            ['para', ['ul', 'ol']]
        ],
        callbacks: {
            onKeyup: function(e) {
                var t = e.currentTarget.innerText;
                var wom = t.split(' ');

                $('#chars').text(t.trim().length);
                $('#words').text(wom ? wom.length : 0);

                if (!isNaN(idFromPath)) {
                    summernoteChars++;

                    if (summernoteChars > 100) {
                        articleAjaxUpdate(function(success) {
                            console.log(success)
                        }, function(errr) {
                            console.log(errr)
                        });
                        eventViewer('Article has been saved');
                        summernoteChars = 0;
                    }
                }
            },
            onBlur: function() {
                if (!isNaN(idFromPath)) {
                    articleAjaxUpdate(function(success) {
                        console.log(success)
                    }, function(errr) {
                        console.log(errr)
                    });
                    eventViewer('Article has been saved');
                }
            },
        }
    });
    var summernote1Chars = 0;
    
    $('#summernote1').summernote({
        placeholder: 'and carry on with your article...',
        height: 500,
        tabsize: 2,
        styleWithSpan: false,
        toolbar: [
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['font', ['strikethrough', 'superscript', 'subscript']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['misc', ['print', 'fullscreen']],
            ['insert', ['link', 'picture','video']],
        ],
        callbacks: {
            onKeyup: function(e) {
                var t = e.currentTarget.innerText;
                var wom = t.split(' ');


                $('#chars1').text(t.trim().length);
                $('#words1').text(wom ? wom.length : 0);

                if (!isNaN(idFromPath)) {
                    summernote1Chars++;
                    if (summernote1Chars > 100) {
                        articleAjaxUpdate(function(success) {
                            console.log(success)
                        }, function(errr) {
                            console.log(errr)
                        });
                        eventViewer('Article has been saved');
                        summernote1Chars = 0;
                    }
                }
            },
            onBlur: function() {
                if (!isNaN(idFromPath)) {
                    articleAjaxUpdate(function(success) {
                        console.log(success)
                    }, function(errr) {
                        console.log(errr)
                    });
                    eventViewer('Article has been saved');
                }
            }
        }
    });
});
</script>
<div class="row">
    <form action="{{ url('/admin/dealer/update-article/'.$articleToEdit->id) }}" method="POST">
        <input type="hidden" name="_token" value="{{ csrf_token() }}"> 
            {{ method_field('PATCH') }}
        <div class="col-md-2">
            <div class="menu-title">Publish</div>
            <div class="form-group">
                <input type="submit" name="status" value="{{ ($articleToEdit->status == 'published') ? 'Draft it': 'Save draft' }}" id="draft" class="btn btn-info btn-block draft-margin">
                <button type="button" class="btn btn-info" data-toggle="modal" data-target=".tar-modal-lg" name="preview">Preview</button>
            </div>
            <p class="p-padding">Status: <span id="statusOfArticle">{{ $articleToEdit->status }}</span></p>
            <div id="datetime">
                <label class="control-label" for="poston">You need to schedule it:</label>
                <input type="text" name="scheduledTime" value="{{ $articleToEdit->scheduled->format('H:i') }}" placeholder="18:20" id="poston" class="form-control btn-margin">
                <input type="text" name="scheduledDate" value="{{ $articleToEdit->scheduled->format('d.n.Y') }}" placeholder="1.2.2017" class="form-control btn-margin">
            </div>

            <input type="submit" name="status" value="{{ ($articleToEdit->status == 'published') ? 'Update': 'Publish' }}" id="publish" class="btn btn-success btn-margin"> 
            <div class="fast-track">
            <div class="menu-title">Fast track</div>
            <p>
              <a href="{{ url('/') }}/admin/dealer/list-of-articles"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span> List of articles</a>
            </p>
            </div>
            <div class="eventManager">
                <div class="menu-title">Event manager</div>
                <p class="text-muted">Nothing has happend yet.</p>
            </div>
        </div>
        <div class="col-md-7">
            <article>
                <h1>
                    Edit article 
                  </h1>
                   @if (count($errors))
                <div class="alert alert-warning">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <ul>
                        @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif @if (session('success'))
                <div class="alert alert-success">
                    <strong>Success!</strong>
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> {{ session('success') }}
                </div>
                @endif
                <div class="toggleTitleAndDescription text-right small"><a href="#"><span class="glyphicon glyphicon-triangle-top"></span></a></div>
                <div id="toggleFields">  
                <input type="text" name="title" value="{{ old('title') != null ? old('title') : $articleToEdit->title }}" id="articleTitle" class="form-control btn-margin" placeholder="add title..">
                <textarea name="contentInBrief" id="summernote" placeholder="add a brief content">{{ old('contentInBrief') != null ? old('contentInBrief') : $articleToEdit->content_in_brief }}</textarea>
                
                <div class="row text-muted small padding-letters-words">
                    <div class="col-md-6">(article has to contain 100 characters at least)</div>
                    <div class="col-md-6 text-right">Approximately: <span id="chars">0</span> letters, <span id="words">0</span> words </div>
                </div>
                </div>

                <textarea name="content" id="summernote1" placeholder="and carry on with article...">{{ old('content') != null ? old('content') : $articleToEdit->content }}</textarea>
                <div class="row text-muted small padding-letters-words">
                    <div class="col-md-6">(article has to contain 1000 characters at least)</div>
                    <div class="col-md-6 text-right">Approximately: <span id="chars1">0</span> letters, <span id="words1">0</span> words </div>
                </div>
                <input type="text" name="place" id="articlePlace" value="{{ old('place') != null ? old('place') : $articleToEdit->place }}" class="form-control btn-margin" placeholder="e.g. Praha, Česká Republika">
            </article>
        </div>
    </form>
    <div class="col-md-3">
        <div id="ajaxStoryLine">
            <div class="menu-title">Side notes/Story Line</div>
            @if (session('successNote'))
            <div class="alert alert-success">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> {{ session('successNote') }}
            </div>
            @endif @if (session('errorNote'))
            <div class="alert alert-warning">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> {{ session('errorNote') }}
            </div>
            @endif
            <form action="{{ url('/') }}/admin/dealer/add-article/storyline/{{ $articleToEdit->id }}" method="POST">
                <div class="form-group">
                    {{ csrf_field() }} 
                    {{ method_field('PATCH')}}
                    <textarea name="storyline" class="form-control btn-margin" placeholder="start here..">{{ old('storyline') != null ? old('storyline') : $articleToEdit->storyline }}</textarea>
                    <input type="submit" name="storylineSubmit" class="btn btn-default btn-margin" value="Save storyline">
                    <span class='alertAjaxState'></span>
                </div>
            </form>
        </div>
    </div>
    <!-- Large modal -->
    <div class="modal fade tar-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Preview</h4>
                </div>
                <div class="modal-body">
                    <!-- content-->
                    <div class="row row-margin">
                        <div class="col-sm-4 grid4">
                            <div class="row">
                                <div class="container-fluid">
                                    <strong>
                    <span class="date">{{  $currentTime->format('d.m.Y') }}</span><br>  
                    <span class="place">Karlovy Vary</span>
                </strong>
                                </div>
                            </div>
                            <hr class="divider">
                            <div class="row">
                                <div class="container-fluid">
                                    <strong>Obsah ve stručnosti</strong>
                                    <div class="contentInBrief">
                                        Po delším experimetování a málem i naprogramování si to sám jsem nalezl celkem elegantní a hlavně fungující postup. Vytvořte si instanci Collatoru pro české locale a pak mu nastavte sílu porovnávání na nejnižší možnou a tedy PRIMARY (navzájem se mají odlišovat pouze zcela jiné znaky bez ohledu na velikost nebo nabodeníčka).
                                    </div>
                                </div>
                            </div>
                            <hr class="divider">
                            <div class="row">
                                <div class="container-fluid">
                                    <strong>Doporučený poslech</strong>
                                    <iframe accesskey="" src="https://www.youtube.com/embed/2NiBatjQtZw">
                                    </iframe>
                                </div>
                            </div>
                            <hr class="divider">
                        </div>
                        <div class="col-sm-8 grid8">
                            <h2></h2>
                            <div class="text">
                            </div>
                        </div>
                    </div>
                    <!-- /content-->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
                <!-- / Large modal -->
            </div>
        </div>
    </div>
</div>
@endsection
