<section id="about" class="content py-5">
    <div class="container text-center" data-aos="fade-right">
        <h2 class="mb-4" style="font-size: 3rem; font-weight: bold;">About Us</h2>
        <p class="text-muted mb-5" style="font-size: 1.25rem;">
            A modern, reliable, and secure visitor management system designed for today’s organizations.
        </p>
        @php
            use App\Models\SystemInformation;

            $system = SystemInformation::first();
            $systemName = $system->name ?? 'VisiQ';
        @endphp
        <div class="row">
            <div class="col-lg-6 mb-4">
                <img src="{{ asset('images/vms2.png') }}" alt="VisiQ - Visitor Management System"
                    class="img-fluid rounded" style="height: 350px; width:400px">
            </div>
            <div class="col-lg-6">
                <p style="font-size: 1rem; line-height: 1.8; text-align: justify;">
                    At <strong>{{ $systemName }}</strong>, our mission is to revolutionize the way organizations
                    handle visitor
                    management. With our advanced <strong>Visitor Management System</strong>, we provide a seamless,
                    efficient, and secure way to monitor and manage visitor access. Our platform ensures smooth
                    check-ins, enhances security protocols, and creates an outstanding visitor experience.
                </p>
                <p style="font-size: 1rem; line-height: 1.8; text-align: justify;">
                    By integrating real-time tracking, automated notifications, and user-friendly interfaces,
                    <strong>{{ $systemName }}</strong> empowers organizations of all sizes to improve operational
                    efficiency and
                    maintain a safe environment. Whether you’re managing a corporate office, a government building, or
                    an educational institution, our system is adaptable to your unique needs, ensuring compliance and
                    peace of mind.
                </p>
                <p style="font-size: 1rem; line-height: 1.8; text-align: justify;">
                    Discover the simplicity and reliability of modern visitor management with
                    <strong>{{ $systemName }}</strong>,
                    your trusted partner in creating secure and welcoming spaces.
                </p>
            </div>
        </div>
    </div>
</section>
