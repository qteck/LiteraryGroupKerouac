<!DOCTYPE html>
<html prefix="og: http://ogp.me/ns#" lang="cs">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<title>Slavná literární skupina</title>
	<!-- meta data for fb-->
	<meta property="og:title" content="">
	<meta property="og:type" content="">
	<meta property="og:url" content="">
	<meta property="og:image" content="">
	<!-- Bootstrap -->
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/css_custom.css') }}">
	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
	<!-- main font, download it. -->
	<link href="https://fonts.googleapis.com/css?family=PT+Serif" rel="stylesheet">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css" rel="stylesheet">

	<!-- Core CSS file photoswipe-->
	<link rel="stylesheet" href="{{ url('/') }}/vendor/photoswipe/dist/photoswipe.css">
	<link rel="stylesheet" href="{{ url('/') }}/vendor/photoswipe/dist/default-skin/default-skin.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
	<!-- Skin CSS file (styling of UI - buttons, caption, etc.) / photoswipe
     In the folder of skin CSS file there are also:
     - .png and .svg icons sprite, 
     - preloader.gif (for browsers that do not support CSS animations) -->
	<link rel="stylesheet" href="{{ url('/') }}/vendor/photoswipe/default-skin/default-skin.css">
	<script src="https://www.paypalobjects.com/api/checkout.js"></script>

	<link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
	<link rel="manifest" href="/site.webmanifest">
	<link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
	<meta name="msapplication-TileColor" content="#da532c">
	<meta name="theme-color" content="#ffffff">
</head>

<body>
	<header>
		<div class="header-title">
			<div>
	    <h1 class="slavna">
                <a href="/">Slavná literární<br> skupina</a>
            </h1>

	<div class="" style="font-size:26px">
	    
				&nbsp; 
	 
	</div>
			</div>
		</div>
	</header>
	<div class="article-container padding-as-fuck">
	<article class="container-fluid">
		<nav class="navbar navbar-default nav-restyle">
			<div class="container-fluid">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
				</div>
				<!-- Collect the nav links, forms, and other content for toggling -->
				<div  style="text-align: center;" class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav text-menu-style">
						<li><a href="{{ url('/')  }}/">HOME</a>
						</li>
						<!--<li><a href="{{ url('/')  }}/knihy">KNIHY</a>
						</li>
						<li class="active nav-active-restyle">
							<a href="{{ url('/')  }}/manifest">MANIFEST<span class="sr-only">(current)</span></a>
						</li>
						<li><a href="{{ url('/')  }}/clanky">ČLÁNKY</a>
						</li>
						<li><a href="{{ url('/')  }}/literarni-tour">LITERÁRNÍ TOUR</a>
						</li>
						<li><a href="{{ url('/')  }}/galerie">GALERIE</a>
						</li>
						<li><a href="http://evelinka.kerouac.cz">UŽIVATELSKÁ SEKCE <span class="glyphicon glyphicon-grain"></span></a>
						</li>-->
					</ul>
				</div>
				<!-- /.navbar-collapse -->
			</div>
			<!-- /.container-fluid -->
		</nav>


		@yield('content')
	</article>
	</div>
	<footer class="footer">
		<div class="container">
			<p class="text-muted row"> 
			  <div class="col-sm-10">
				∞ 2013 - {{ $year }} Slavná literární skupina, kerouac.cz | Last update: 23.12.{{ $year }} 
			  </div>
			  <div class="col-sm-2 text-right">
				<img src="/images/facebook.png"> :
				<a href="https://www.facebook.com/literarniSkupinaKerouac/">
					<img src="/images/cz-flag.png">
				</a> 
				<a href="https://www.facebook.com/TheFamousLiteraryGroup/">
					<img src="/images/en-flag.png">
				</a>
			  </div>
			</p>
		</div>
	</footer>
	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	<!-- photoswipe -->
	<div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="pswp__bg"></div>
		<div class="pswp__scroll-wrap">
			<div class="pswp__container">
				<div class="pswp__item"></div>
				<div class="pswp__item"></div>
				<div class="pswp__item"></div>
			</div>
			<div class="pswp__ui pswp__ui--hidden">
				<div class="pswp__top-bar">
					<div class="pswp__counter"></div>
					<button class="pswp__button pswp__button--close" title="Close (Esc)"></button>
					<button class="pswp__button pswp__button--share" title="Share"></button>
					<button class="pswp__button pswp__button--fs" title="Toggle fullscreen"></button>
					<button class="pswp__button pswp__button--zoom" title="Zoom in/out"></button>
					<div class="pswp__preloader">
						<div class="pswp__preloader__icn">
							<div class="pswp__preloader__cut">
								<div class="pswp__preloader__donut"></div>
							</div>
						</div>
					</div>
				</div>
				<div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
					<div class="pswp__share-tooltip"></div>
				</div>
				<button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)">
				</button>
				<button class="pswp__button pswp__button--arrow--right" title="Next (arrow right)">
				</button>
				<div class="pswp__caption">
					<div class="pswp__caption__center"></div>
				</div>
			</div>
		</div>
	</div>
	<!-- Core JS file photoswipe-->
	<script src="{{ url('/') }}/vendor/photoswipe/dist/photoswipe.min.js"></script>
	<!-- UI JS file photoswipe-->
	<script src="{{ url('/') }}/vendor/photoswipe/dist/photoswipe-ui-default.min.js"></script>
	<script src="{{ url('/') }}/vendor/photoswipe/dist/photoswipeitems.js"></script>
</body>

</html>