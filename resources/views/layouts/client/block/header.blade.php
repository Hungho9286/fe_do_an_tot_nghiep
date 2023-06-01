<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <!-- Logo and responsive toggle -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#"><span class="glyphicon glyphicon-globe"></span> Logo</a>
        </div>
        <!-- Navbar links -->
        <div class="collapse navbar-collapse" id="navbar">
            <ul class="nav navbar-nav">
                <li class="active">
                    <a href="#">Home</a>
                </li>
                <li>
                    <a href="#">About</a>
                </li>
                <li>
                    <a href="#">Products</a>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Services <span class="caret"></span></a>
                    <ul class="dropdown-menu" aria-labelledby="about-us">
                        <li><a href="#">Engage</a></li>
                        <li><a href="#">Pontificate</a></li>
                        <li><a href="#">Synergize</a></li>
                    </ul>
                </li>
            </ul>
            <!-- Log In Form -->
            {{-- <div class="form-group">
                <label class="sr-only" for="emailAddress">Email address</label>
                <input type="email" class="form-control" id="emailAddress" placeholder="Email">
            </div>
            <div class="form-group">
                <label class="sr-only" for="pwd">Password</label>
                <input type="password" class="form-control" id="pwd" placeholder="Password">
            </div> --}}
            <form class="navbar-form navbar-right form-inline" method="POST" action="{{route('dang-xuat')}}">
                @csrf
                <button type="submit" class="btn btn-default">Đăng xuất</button>
            </form>

        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>
<div class="jumbotron feature">
    <div class="container">

        <div id="feature-carousel" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#feature-carousel" data-slide-to="0" class="active"></li>
                <li data-target="#feature-carousel" data-slide-to="1"></li>
                <li data-target="#feature-carousel" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner" role="listbox">
                <div class="item active">
                    <a href="#">
                        {{-- <div style="width:100%; height:100%;background-image:image({{asset('images/school/caothang_banner.png')}}) inherit"></div> --}}
                        <img class="img-responsive" src="{{asset('images/school/picture_banner_2.jpg')}}"   alt="">
                    </a>
                    {{-- <div class="carousel-caption">
                        <h3>Dramatically Engage</h3>
                        <p>Objectively innovate empowered manufactured products whereas parallel platforms.</p>
                    </div> --}}
                </div>
                <div class="item">
                    <a href="#">
                        <img class="img-responsive" src="{{asset('images/school/picture_banner_1.jpg')}}"  alt="">
                    </a>
                    {{-- <div class="carousel-caption">
                        <h3>Efficiently Unleash</h3>
                        <p>Dramatically maintain clicks-and-mortar solutions without functional solutions.</p>
                    </div> --}}
                </div>
                <div class="item">
                    <a href="#">
                        <img class="img-responsive" src="{{asset('images/school/picture_banner_3.jpg')}}"  alt="">
                    </a>
                    {{-- <div class="carousel-caption">
                        <h3>Proactively Pontificate</h3>
                        <p>Holistically pontificate installed base portals after maintainable products.</p>
                    </div> --}}
                </div>
            </div>
            <a class="left carousel-control" href="#feature-carousel" role="button" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#feature-carousel" role="button" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>

    </div>
</div>

