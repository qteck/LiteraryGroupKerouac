    $(document).ready(function() {
        var path = window.location.pathname.split('/');
        var idFromPath = + path[path.length - 1];

        if(!isNaN(idFromPath)) {
            $("input[name='title'], input[name='place']").blur(function() {
                articleAjaxUpdate(function(success){console.log(success)}, function(errr){console.log(errr)});
                eventViewer('Article has been saved');
            });
        
            $("textarea[name='storyline']").blur(function() {
                storylineAjaxUpdate();
                eventViewer('Storyline has been saved');
            });
        }

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

            function articleAjaxUpdate(success = '', error = '') {
                      var title = $("input[name='title']").val();
                      var summernote = $('#summernote').val(); 
                      var summernote1 = $('#summernote1').val(); 
                      var place = $("input[name='place']").val();
                      var token = $("input[name='_token']").val();

                $.ajax({
                    type: 'PATCH',
                    url: "{{ url('/admin/dealer/add-article/update/'.$articleToEdit->id) }}",
                    dataType: 'json',
                    data: {
                        'title': title,
                        'content_in_brief': summernote,
                        'content': summernote1,
                        'place': place,
                        '_token': token
                    },
                    success: success,
                    error: error,
                });
            }


        $("button[name='preview']").click(function(){

          var title = $("input[name='title']").val();
          var summernote = $('#summernote').val(); 
          var summernote1 = $('#summernote1').val(); 
          var place = $("input[name='place']").val();

          $(".grid8 h2").text(title);
          $('.grid4 .contentInBrief').html(summernote);
          $('.grid8 .text').html(summernote1);
          $(".grid4 .place").text(place);
       });

      $("input[name='storylineSubmit']").click(function(){

          var dots = "<span class='loader__dot'>.</span><span class='loader__dot'>.</span><span class='loader__dot'>.</span>";
          var success = "<span class='glyphicon glyphicon-ok text-success'></span>";
          var error = "<span class='glyphicon glyphicon-remove text-danger'></span>";

          var alertAjax = $(".alertAjaxState");

          alertAjax.css('display','initial');
          alertAjax.html(dots);

          storylineAjaxUpdate(
          function (responseSuccess) {
                alertAjax.html(success).fadeOut(2000, function() {
                alertAjax.empty();
              })
          },
          function (responseError) {
                alertAjax.html(error);
          }); 

          return false;
      });

     $("input[value='Publish']").click(function(){
            
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

        var summernoteChars=0;
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
                onKeyup: function (e) {
                    var t = e.currentTarget.innerText;
                    var wom = t.split(' ');
                    summernoteChars++;

                    $('#chars').text(t.trim().length);
                    $('#words').text(wom ? wom.length : 0);

                    if(summernoteChars > 100) {
                    articleAjaxUpdate(function(success){console.log(success)}, function(errr){console.log(errr)});
                    eventViewer('Article has been saved');   
                    summernoteChars = 0;                 
                  }
                },
                onBlur: function (){
                    articleAjaxUpdate(function(success){console.log(success)}, function(errr){console.log(errr)});
                    eventViewer('Article has been saved');
                },
            }
        });
       var summernote1Chars = 0;
        $('#summernote1').summernote({
            placeholder: 'and carry on with your article...',
            height: 300,
            tabsize: 2,
            styleWithSpan: false,
            callbacks: {
                onKeyup: function (e) {
                    var t = e.currentTarget.innerText;
                    var wom = t.split(' ');
                    summernote1Chars++;

                    $('#chars1').text(t.trim().length);
                    $('#words1').text(wom ? wom.length : 0);

                    if(summernote1Chars>100){
                            articleAjaxUpdate(function(success){console.log(success)}, function(errr){console.log(errr)});
                            eventViewer('Article has been saved');              
                            summernote1Chars = 0;
                    }
                },
                onBlur: function () {
                    articleAjaxUpdate(function(success){console.log(success)}, function(errr){console.log(errr)});
                    eventViewer('Article has been saved');
                }
            }
        });
    });