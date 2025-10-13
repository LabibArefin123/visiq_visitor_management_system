<section id="contact" class="content py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold text-primary">Get in Touch</h2>
            <p class="text-muted">We’re here to assist you with demos, pricing, or technical inquiries.</p>
        </div>

        <div class="row">
            <!-- Contact Info -->
            <div class="col-md-6 d-flex">
                <div class="contact-box bg-white p-4 rounded shadow-lg w-100 d-flex flex-column justify-content-between animate__animated animate__fadeInUp">
                    <div>
                        <!-- Email -->
                        <div class="contact-item d-flex align-items-center mb-4">
                            <i class="fas fa-envelope fa-2x text-primary me-3"></i>
                            <div>
                                <h6 class="mb-1 fw-bold">Email</h6>
                                <a href="mailto:arif@totalofftec.com.bd" class="text-decoration-none text-muted hover-link">
                                    arif@totalofftec.com.bd
                                </a>
                            </div>
                        </div>
            
                        <!-- Phone -->
                        <div class="contact-item d-flex align-items-center mb-4">
                            <i class="fas fa-phone fa-2x text-success me-3"></i>
                            <div>
                                <h6 class="mb-1 fw-bold">Phone</h6>
                                <a href="https://wa.me/8809643111222" target="_blank" class="text-decoration-none text-muted hover-link">
                                    +8809643111222
                                </a>
                            </div>
                        </div>
            
                        <!-- Address -->
                        <div class="contact-item d-flex align-items-start mb-3">
                            <i class="fas fa-map-marker-alt fa-2x text-danger me-3"></i>
                            <div>
                                <h6 class="mb-1 fw-bold">Address</h6>
                                <p class="mb-0 text-muted">Building # 443 (5th Floor)<br>
                                    Road # 07, DOHS Baridhara<br>
                                    Dhaka - 1206, Bangladesh
                                </p>
                            </div>
                        </div>
                    </div>
            
                    <!-- Map -->
                    <div class="mt-4">
                        <iframe 
                            src="https://www.google.com/maps?q=23.7686518,90.3789979&hl=es;z=14&amp;output=embed" 
                            width="100%" 
                            height="200" 
                            style="border:0; border-radius: 0.5rem;" 
                            allowfullscreen 
                            loading="lazy">
                        </iframe>
                    </div>
                </div>
            </div>
            

            <!-- Contact Form -->
            <div class="col-md-6 d-flex">
                <div class="bg-white p-4 rounded shadow-sm w-100 h-100">
                    <form action="{{ route('contact.store') }}" method="POST" class="h-100 d-flex flex-column justify-content-between">
                        @csrf
                        <div>
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Name</label>
                                <input type="text" name="name" class="form-control" placeholder="Please enter your fullname" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Email</label>
                                <input type="email" name="email" class="form-control" placeholder="Please enter your email" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Message</label>
                                <textarea name="message" class="form-control" rows="5" placeholder="Write your message here..." required></textarea>
                            </div>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-primary px-4 py-2">Send Message</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <style>
        .hover-link:hover {
            color: #FF9900 !important;
            transition: color 0.3s ease;
        }
    
        .contact-box {
            transition: box-shadow 0.3s ease;
        }
    
        .contact-box:hover {
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
        }
    
        .contact-item i {
            transition: transform 0.3s ease, color 0.3s ease;
        }
    
        .contact-item:hover i {
            transform: scale(1.2);
            color: #FF9900 !important;
        }
    </style>    
    
</section>
