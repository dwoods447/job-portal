<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script defer src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <script>
		$(function() {
			$( "#datepicker" ).datepicker();
		});
    </script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('all.jobs') }}">{{ __('View Jobs') }}</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            {{-- @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif --}}

                            @if (Route::has('employer.signup'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('employer.signup') }}">{{ __('Employer Registration') }}</a>
                            </li>
                            @endif

                            @if (Route::has('jobseeker.signup'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('jobseeker.signup') }}">{{ __('Jobseeker Registration') }}</a>
                            </li>
                            @endif
                        @else
                        @if(Auth::check() && Auth::user()->user_type=="employer")
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('employer.jobs') }}">{{ __('View Jobs') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{route('job.applicants')}}">{{__('View All Applicants')}}</a>
                                </li>
                            @else
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('all.jobs') }}">{{ __('View Jobs') }}</a>
                            </li>
                        @endif
                       @if(Auth::check() && Auth::user()->user_type=="employer")
                           <li class="nav-item">
                                    <a class="nav-link" href="{{ route('employer.jobcreationform') }}">{{ __('Post a Job') }}</a>
                           </li>
                       @endif
                        @if(Auth::check() && Auth::user()->user_type=="employer")
                            <li  class="nav-item">
                                <a href="{{route('company.profile')}}" class="nav-link"> {{ __('Company Profile') }}</a>
                            </li>
                            @endif
                            @if(Auth::check() && Auth::user()->user_type=="seeker")
                           <li  class="nav-item">
                                <a href="{{route('jobseeker.profile')}}" class="nav-link">{{ Auth::user()->name }}'s {{ __('job profile') }}</a>
                            </li>
                            @endif
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>


                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
