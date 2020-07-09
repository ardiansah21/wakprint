<header>
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light shadow-sm bg-white fixed-top" role="navigation">
            <div class="container pt-2 pb-2">
                <a id="judulLogoWakprint" class="navbar-brand font-weight-bold" href="{{ url('/pengelola') }}">WAKPRINT</a>
                <div class="collapse navbar-collapse" id="exCollapsingNavbar">
                    <ul class="nav navbar-nav justify-content-between ml-auto">
                        <li class="nav-item align-self-center mr-4"><a class="nav-link active" href="{{url('pengelola/chat')}}"><span class="badge-notif"></span>Chat</a></li>
                        <li class="nav-item align-self-center mr-2"><a class="nav-link active" href="#"><i class="material-icons mr-2">notifications</i></a></li>
                        <li class="nav-item align-self-center mr-4">
                            <a class="text-primary-purple font-weight-bold" href="{{ url('/pengelola/profil') }}">Rp. 1.200.000
                                <img class="img-responsive align-self-center ml-4" src="https://ptetutorials.com/images/user-profile.png" width="32" height="32" alt="no logo">
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</header>