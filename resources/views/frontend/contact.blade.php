{{-- Extend the frontend layout --}}
@extends('layouts.frontend')

{{-- Define the content for the slot --}}
@section('content')
    <section class="py-5">
        <div class="container">
            <h1 class="mb-4">Contact Us</h1>
            <p class="lead">
                Have questions or need assistance? We're here to help!
            </p>
            
            <div class="row mb-5">
                <div class="col-md-6">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title">Get In Touch</h5>
                            <p class="card-text">
                                Whether you're a donor, recipient, or just have questions about our platform,
                                please don't hesitate to reach out to us.
                            </p>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    <i class="fas fa-envelope me-2"></i>
                                    <strong>Email:</strong> info@blooddonor.example.com
                                </li>
                                <li class="list-group-item">
                                    <i class="fas fa-phone me-2"></i>
                                    <strong>Phone:</strong> +1 (555) 123-4567
                                </li>
                                <li class="list-group-item">
                                    <i class="fas fa-map-marker-alt me-2"></i>
                                    <strong>Address:</strong> 123 Blood Donor Street, City, State 12345
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title">Send Us a Message</h5>
                            <form>
                                <div class="mb-3">
                                    <label for="contactName" class="form-label">Your Name</label>
                                    <input type="text" class="form-control" id="contactName" placeholder="Enter your name">
                                </div>
                                <div class="mb-3">
                                    <label for="contactEmail" class="form-label">Email Address</label>
                                    <input type="email" class="form-control" id="contactEmail" placeholder="Enter your email">
                                </div>
                                <div class="mb-3">
                                    <label for="contactSubject" class="form-label">Subject</label>
                                    <input type="text" class="form-control" id="contactSubject" placeholder="Enter subject">
                                </div>
                                <div class="mb-3">
                                    <label for="contactMessage" class="form-label">Message</label>
                                    <textarea class="form-control" id="contactMessage" rows="5" placeholder="Enter your message"></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Send Message</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Our Location</h5>
                        </div>
                        <div class="card-body">
                            <div id="map" style="height: 300px; background: #eee;">
                                <p class="text-center py-5">Map would appear here</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection