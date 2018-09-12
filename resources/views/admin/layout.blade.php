<!DOCTYPE html>
<html lang="cs" prefix="og: http://ogp.me/ns#">
   <head>
      <meta charset="utf-8">
      <meta content="IE=edge" http-equiv="X-UA-Compatible">
      <meta content="width=device-width, initial-scale=1" name="viewport">
      <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
      <title>
         Literát Admin - administrace
      </title>
      <meta content="Literát Admin" name="description">
      <meta content="SitePoint" name="author">
      <link href="{{ url('/') }}/css/admin/css_custom.css" rel="stylesheet">
      <link href="{{ url('/') }}/vendor/animate/animate.min.css" rel="stylesheet">
      <link crossorigin="anonymous" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" rel="stylesheet">
      <link rel="stylesheet" href="{{url('/') }}/vendor/summernote/summernote.css">
   </head>
   <body>
       
          <!-- Latest compiled and minified JavaScript -->
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
       
    <!-- Fixed navbar -->
    <nav class="navbar navbar-default navbar-fixed-top navbar-inverse">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="{{ url('/') }}/admin/dealer">A chicken drug dealer</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="{{ url('/') }}/admin/dealer">Dashboard</a></li>
            <li class="dropdown">
                   <a href="#"  class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                       Manage articles
                       <span class="caret"></span>
                   </a>
                 <ul class="dropdown-menu">
                    <li><a href="{{ url('/') }}/admin/dealer/list-of-articles"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span> List of articles</a></li>
                    <li><a href="{{ url('/') }}/admin/dealer/add-article"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Add article</a></li>
                </ul>
             </li>
            <li class="dropdown">
                   <a href="#"  class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                       Manage galleries
                       <span class="caret"></span>
                   </a>
                 <ul class="dropdown-menu">
                    <li><a href="{{ url('/') }}/admin/dealer/list-of-galleries"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span> List of galleries</a></li>
                    <li><a href="{{ url('/') }}/admin/dealer/add-gallery"><span class="glyphicon glyphicon-film" aria-hidden="true"></span> Add gallery</a></li>
                </ul>
             </li>
            <li>
                   <a href="{{ url('/') }}/admin/dealer/orders">
                      <span class="glyphicon glyphicon-usd"></span>
                      <span class="glyphicon glyphicon-usd"></span>
                      <span class="glyphicon glyphicon-usd"></span>
                      <span class="glyphicon glyphicon-usd"></span>
                   </a>
             </li>
            <li class="dropdown">
                   <a href="#"  class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                       Manage tours
                       <span class="caret"></span>
                   </a>
                 <ul class="dropdown-menu">
                    <li><a href="{{ url('/') }}/admin/dealer/add-event"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span> Add an event</a></li>
                    <li><a href="{{ url('/') }}/admin/dealer/list-of-events"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span> List of events</a></li>
                </ul>
             </li>
            <li class="dropdown">
                   <a href="#"  class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                       Manage books
                       <span class="caret"></span>
                   </a>
                 <ul class="dropdown-menu">
                    <li><a href="{{ url('/') }}/admin/dealer/books/add"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span> Add a book</a></li>
                    <li><a href="{{ url('/') }}/admin/dealer/books/list"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span> List of books</a></li>
                </ul>
             </li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
                <a href="./" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                    {{ $user->name }} ∞
                    <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                    <span class="caret"></span>
                    <span class="sr-only">(users settings)</span>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="{{ url('/') }}/admin/dealer/account-settings"><span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Account settings</a></li>
                    <li><a href="{{ url('/') }}/admin/dealer/logout"><span class="glyphicon glyphicon-log-out" aria-hidden="true"></span> Log out</a></li>
                </ul>
            </li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
              
      <div class="container-fluid center-white center-padding-bottom">
          
        @yield('content_admin')
         
      </div>
    
    	<footer class="footer">
		<div class="container">
			<p class="text-muted"> 
                            ∞ 2013 - 2016 Slavná literární skupina Kerouac, kerouac.cz | 
                            Thank you for managing your website with a chicken drug dealer.
                        </p>
		</div>
	</footer>


   </body>
</html>