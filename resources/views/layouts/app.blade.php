<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('images/visiq.png') }}" type="image/png">

    <title>{{ config('app.name', 'Laravel') }}</title>
    

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- AOS CSS -->
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">

    <!-- Styles -->
    <style>
        .hover-bounce:hover {
            animation: bounce 0.5s;
        }

        .btn-outline-primary:hover {
            background-color: #007bff;
            color: #fff;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            color: #fff;
        }

        @keyframes bounce {
            0% {
                transform: translateY(0);
            }

            30% {
                transform: translateY(-10px);
            }

            50% {
                transform: translateY(0px);
            }

            70% {
                transform: translateY(-5px);
            }

            100% {
                transform: translateY(0);
            }
        }

        .feature-box {
            cursor: pointer;
            transition: transform 0.4s, box-shadow 0.4s;
        }

        .feature-box:hover {
            transform: translateY(-8px) scale(1.05);
            box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.2);
        }
    </style>

    <!-- Laravel Vite Assets -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body class="hold-transition sidebar-mini layout-fixed sidebar-collapse">

    <div id="app">
       <main class="p-0">

            @yield('content')
        </main>
    </div>

    <!-- AOS -->
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 1000,
            easing: 'ease-in-out',
            once: true,
        });
    </script>

    <!-- Smooth Scrolling -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function(e) {
                    e.preventDefault();
                    const target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth'
                        });
                    }
                });
            });
        });

        function changeBackground(color) {
            const el = document.getElementById('features');
            if (el) {
                el.style.transition = "background 1.5s ease-in-out";
                el.style.background = `radial-gradient(circle at center, ${color} 0%, #f8f9fa 80%)`;
            }
        }
    </script>

    <!-- Idle Timeout Partial -->
 

</body>

</html>
