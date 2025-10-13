<nav class="main-header navbar navbar-expand-md navbar-light navbar-white"
    style="padding-left: 30px; padding-right: 30px;">
    <div class="container-fluid">

        <!-- Left: Logo + Title -->
        <a href="#" class="navbar-brand d-flex align-items-center">
            <img src="{{ asset('images/visiq.png') }}" alt="Logo" class="brand-image  elevation-3"
                style="width: 80px; height: 80px;">
        </a>

        <!-- Center: Navbar Menu -->
        <div class="collapse navbar-collapse justify-content-center order-2" id="navbarCollapse">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="#about" class="nav-link custom-link">About</a>
                </li>
                <li class="nav-item">
                    <a href="#features" class="nav-link custom-link">Features</a>
                </li>
                <li class="nav-item">
                    <a href="#services" class="nav-link custom-link">Services</a>
                </li>

            </ul>

            <!-- CSS for custom styles -->
            <style>
                /* Style for the navbar items */
                .navbar-nav .nav-item .nav-link {
                    position: relative;
                    color: #333;
                    font-size: 16px;
                    padding: 10px 15px;
                    text-decoration: none;
                    overflow: hidden;
                }

                /* Parallelogram background effect */
                .navbar-nav .nav-item .nav-link::after {
                    content: "";
                    position: absolute;
                    top: 0;
                    left: 0;
                    width: 100%;
                    height: 100%;
                    background-color: #FF9900;
                    transform: skewX(-20deg);
                    transform-origin: bottom left;
                    transition: transform 0.3s ease, width 0.3s ease;
                    z-index: -1;
                    /* Ensure it stays behind the text */
                    width: 0;
                }

                /* Hover effect */
                .navbar-nav .nav-item .nav-link:hover::after {
                    width: 100%;
                    transform: skewX(0deg);
                    /* No skew on hover, making it appear like a smooth background expansion */
                }

                /* Hover text color change */
                .navbar-nav .nav-item .nav-link:hover {
                    color: white;
                }
            </style>

        </div>

        <!-- Right: Buttons -->
        <div class="order-3 ml-auto d-flex align-items-center">
            <a href="{{ route('login') }}" class="btn btn-outline-primary custom-btn"
                style="margin-right: 10px;">Login</a>
        </div>
    </div>
</nav>

<!-- CSS for custom styles -->
<style>
    /* Navbar background and padding */
    .main-header {
        background-color: #ffffff;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    /* Navbar menu items */
    .navbar-nav .nav-item .nav-link {
        color: #333;
        font-size: 16px;
        padding: 10px 15px;
        transition: color 0.3s, transform 0.3s ease;
    }

    /* Hover effect for navbar links */
    .navbar-nav .nav-item .nav-link:hover,
    .navbar-nav .nav-item .nav-link.active {

        transform: translateY(-3px);
    }

    /* Custom button styles */
    .custom-btn {
        padding: 10px 20px;
        font-size: 14px;
        border-radius: 30px;
        transition: all 0.3s;
    }

    .custom-btn:hover {

        color: white;
        transform: translateY(-3px);
    }

    /* Navbar brand image */
    .navbar-brand img {
        width: 100px;
        height: 100px;
        object-fit: cover;
    }

    /* Active navbar item */
    .navbar-nav .nav-item .nav-link.active {
        font-weight: bold;
    }
</style>
