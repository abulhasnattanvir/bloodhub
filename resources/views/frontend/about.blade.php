{{-- Extend the frontend layout --}}
@extends('layouts.frontend')

{{-- Define the content for the slot --}}
@section('content')
    <section class="py-5">
        <div class="container">
            <h1 class="mb-4">About Us</h1>
            <p class="lead">
                Welcome to our Blood Donor Management System. We are dedicated to connecting blood donors with those in need.
                Our platform aims to make the process of finding and donating blood as seamless as possible.
            </p>
            <p>
                Our mission is to save lives by ensuring that every patient in need of blood can find a donor quickly and efficiently.
                We believe that by leveraging technology, we can create a robust network of voluntary blood donors.
            </p>
            <h3 class="mt-4">Our Vision</h3>
            <p>
                To be the leading platform for blood donation services, providing a reliable and user-friendly interface for donors and recipients alike.
            </p>
            <h3 class="mt-4">How We Work</h3>
            <ol>
                <li>Donors register and provide their blood group, contact information, and availability.</li>
                <li>Recipients (or their representatives) search for donors by blood group and location.</li>
                <li>The platform facilitates communication between donors and recipients.</li>
                <li>After donation, donors can update their last donation date and availability.</li>
            </ol>
            <p>
                Together, we can make a difference in the healthcare community and ensure that no one suffers due to lack of blood.
            </p>
        </div>
    </section>
@endsection