<!DOCTYPE HTML>
<html>

<head>
    <title>Events</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <link rel="stylesheet" href="{{asset('dashboard/css/main.css')}}" />
    <noscript>
        <link rel="stylesheet" href="{{asset('dashboard/css/noscript.css')}}" />
    </noscript>
    @stack('style')
</head>

<body class="is-preload">
    <!-- Wrapper -->
    <div id="wrapper">

        <!-- Header -->
        <header id="header">
            <div class="inner">

                <!-- Logo -->
                <a href="{{URL::to('/')}}" class="logo">
                    <span class="symbol"><img src="{{asset('dashboard/images/logo.svg')}}" alt="" /></span><span
                        class="title">Events</span>
                </a>

                <!-- Nav -->
                <nav>
                    <ul>
                        <li><a href="#menu">Menu</a></li>
                    </ul>
                </nav>

            </div>
        </header>

        <!-- Menu -->
        <nav id="menu">
            <h2>Menu</h2>
            <ul>
                @if(Auth::user()->role=='admin')
                    <li><a href="{{URL::to('admin/dashboard')}}">Admin Dashbaord</a></li>
                @endif
                <li><a href="{{URL::to('/')}}">Home</a></li>
                <li><a href="{{URL::to('my-events')}}">My Events</a></li>
                <li><a href="{{URL::to('add-new-event')}}">Add New Event</a></li>
                <li><a href="{{URL::to('logout')}}">Logout</a></li>
            </ul>
        </nav>

        @include('utils.toasts')
        @yield('content')

        <!-- Footer -->
        <footer id="footer">
            <div class="inner">
                <section>
                    <h2>Get in touch</h2>
                    <form method="post" action="#">
                        <div class="fields">
                            <div class="field half">
                                <input type="text" name="name" id="name" placeholder="Name" />
                            </div>
                            <div class="field half">
                                <input type="email" name="email" id="email" placeholder="Email" />
                            </div>
                            <div class="field">
                                <textarea name="message" id="message" placeholder="Message"></textarea>
                            </div>
                        </div>
                        <ul class="actions">
                            <li><input type="submit" value="Send" class="primary" /></li>
                        </ul>
                    </form>
                </section>
                <section>
                    <h2>Follow</h2>
                    <ul class="icons">
                        <li><a href="#" class="icon brands style2 fa-twitter"><span class="label">Twitter</span></a>
                        </li>
                        <li><a href="#" class="icon brands style2 fa-facebook-f"><span class="label">Facebook</span></a>
                        </li>
                        <li><a href="#" class="icon brands style2 fa-instagram"><span class="label">Instagram</span></a>
                        </li>
                        <li><a href="#" class="icon brands style2 fa-dribbble"><span class="label">Dribbble</span></a>
                        </li>
                        <li><a href="#" class="icon brands style2 fa-github"><span class="label">GitHub</span></a></li>
                        <li><a href="#" class="icon brands style2 fa-500px"><span class="label">500px</span></a></li>
                        <li><a href="#" class="icon solid style2 fa-phone"><span class="label">Phone</span></a></li>
                        <li><a href="#" class="icon solid style2 fa-envelope"><span class="label">Email</span></a></li>
                    </ul>
                </section>
                <ul class="copyright">
                    <li>&copy; Untitled. All rights reserved</li>
                    <li>Design: <a href="http://html5up.net">HTML5 UP</a></li>
                </ul>
            </div>
        </footer>
        
        </div>
        
        <!-- Scripts -->
        <script src="{{asset('dashboard/js/jquery.min.js')}}"></script>
        <script src="{{asset('dashboard/js/browser.min.js')}}"></script>
        <script src="{{asset('dashboard/js/breakpoints.min.js')}}"></script>
        <script src="{{asset('dashboard/js/util.js')}}"></script>
        <script src="{{asset('dashboard/js/main.js')}}"></script>
        @stack('script')
        @if($errors->any())
        <script>
            $(document).ready(function(){
                  $('.toast').toast('show');
              });
        </script>
        @endif
        
        </body>
        
        </html>