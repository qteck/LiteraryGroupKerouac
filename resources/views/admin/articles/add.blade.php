@extends('/admin/layout') 

@section('content_admin')
<!-- include summernote -->
<script type="text/javascript" src="{{url('/') }}/vendor/summernote/summernote.js"></script>
<script type="text/javascript">
$(document).ready(function() {

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

    $("#calendar").click(function() {
        $("#datetime").toggle('fast'); 
        //change to glyphicon-triangle-bottom to make it toggling
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

    $("input[value='Publish']").click(function() {

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
    });

    var summernoteChars = 0;
    $('#summernote').summernote({
        placeholder: 'add a brief description...',
        height: 100,
        toolbar: [
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
                         //local storage  saving solution 
                        summernoteChars = 0;
                    }
                }
            },
            onBlur: function() { //local storage saving solution }
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
                             //local storage saving solution 
                        summernote1Chars = 0;
                    }
                }
            },
            onBlur: function() {
                 //local storage saving solution 
            }
        }
    });
});
</script>
<div class="row">
    <form action="{{ url('/admin/dealer/add-article/create') }}" method="POST">
        <input type="hidden" name="_token" value="{{ csrf_token() }}"> 
        <div class="col-md-2">
            <div class="menu-title">Publish</div>
            <div class="form-group">
                <input type="submit" name="status" value="Save draft" id="draft" class="btn btn-info btn-block draft-margin">
                <button type="button" class="btn btn-info" data-toggle="modal" data-target=".tar-modal-lg" name="preview">Preview</button>
            </div>
            <p class="p-padding">Status: <span id="statusOfArticle">new piece</span></p>
            <p class="p-padding">Publish immediately, <a href="#" id="calendar">edit</a></p>
            <div id="datetime">
                <label class="control-label" for="poston">Schedule it:</label>
                <input type="text" name="scheduledTime" placeholder="18:20" id="poston" class="form-control btn-margin">
                <input type="text" name="scheduledDate" placeholder="1.2.2017" class="form-control btn-margin">
            </div>
            <input type="submit" name="status" value="Publish" id="publish" class="btn btn-success btn-margin"> 
        </div>
        <div class="col-md-7">
            <article>
                <h1>
                    Add article
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
                <input type="text" name="title" value="{{ old('title') }}" id="articleTitle" class="form-control btn-margin" placeholder="add title..">
                <textarea name="contentInBrief" id="summernote" placeholder="add a brief content">{{ old('contentInBrief') }}</textarea>
                
                <div class="row text-muted small padding-letters-words">
                    <div class="col-md-6">(article has to contain 100 characters at least)</div>
                    <div class="col-md-6 text-right">Approximately: <span id="chars">0</span> letters, <span id="words">0</span> words </div>
                </div>
                </div>

                <textarea name="content" id="summernote1" placeholder="and carry on with article...">{{ old('content') }}</textarea>
                <div class="row text-muted small padding-letters-words">
                    <div class="col-md-6">(article has to contain 1000 characters at least)</div>
                    <div class="col-md-6 text-right">Approximately: <span id="chars1">0</span> letters, <span id="words1">0</span> words </div>
                </div>
                <input type="text" name="place" id="articlePlace" value="{{ old('place') }}" class="form-control btn-margin" placeholder="e.g. Praha, Česká Republika">
            </article>
        </div>
    </form>
    <div class="col-md-3">
        <div id="ajaxStoryLine">
            <div class="functionality">
            <p>
                Start with saving a draft.
            </p>
            <p>
                Save a draft and get extra storyline box aside and autosaving functionality.
            </p>
            </div>
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
