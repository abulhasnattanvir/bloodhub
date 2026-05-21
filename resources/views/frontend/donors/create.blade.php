{{-- Extend the frontend layout --}}
@extends('layouts.frontend')

{{-- Define the content for the slot --}}
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{ isset($donor) && $donor ? 'Edit Donor' : 'Add New Donor' }}</h3>
                    </div>
                    <div class="card-body">
                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                         <form method="POST" action="{{ isset($donor) && $donor ? route('donors.update', $donor->id) : route('donors.store') }}" enctype="multipart/form-data">
                            @csrf
                            @if(isset($donor) && $donor)
                                @method('PUT')
                            @endif

                            <div class="row mb-3">
                                <label for="full_name" class="col-md-4 col-form-label text-md-end">Full Name *</label>
                                <div class="col-md-8">
                                     <input id="full_name" type="text" class="form-control @error('full_name') is-invalid @enderror" name="full_name" value="{{ old('full_name', isset($donor) && $donor ? $donor->full_name : '' ) }}" required autocomplete="full_name" autofocus>
                                    @error('full_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="profile_photo" class="col-md-4 col-form-label text-md-end">Profile Photo</label>
                                <div class="col-md-8">
                                    <input id="profile_photo" type="file" class="form-control @error('profile_photo') is-invalid @enderror" name="profile_photo" accept="image/*">
                                    @error('profile_photo')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    @if(isset($donor) && $donor && $donor->profile_photo)
                                        <div class="mt-2">
                                             <img src="{{ Storage::url($donor->profile_photo) }}" alt="Current Photo" class="img-thumbnail" style="max-width: 150px;">
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="blood_group_id" class="col-md-4 col-form-label text-md-end">Blood Group *</label>
                                <div class="col-md-8">
                                    <select id="blood_group_id" class="form-select @error('blood_group_id') is-invalid @enderror" name="blood_group_id" required>
                                        <option value="">Select Blood Group</option>
                                        @foreach($bloodGroups as $bloodGroup)
                                             <option value="{{ $bloodGroup->id }}" {{ old('blood_group_id', isset($donor) && $donor ? $donor->blood_group_id : '' ) == $bloodGroup->id ? 'selected' : '' }}>
                                                {{ $bloodGroup->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('blood_group_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="phone_number" class="col-md-4 col-form-label text-md-end">Phone Number *</label>
                                <div class="col-md-8">
                                     <input id="phone_number" type="tel" class="form-control @error('phone_number') is-invalid @enderror" name="phone_number" value="{{ old('phone_number', isset($donor) && $donor ? $donor->phone_number : '' ) }}" required autocomplete="tel">
                                    @error('phone_number')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="gender" class="col-md-4 col-form-label text-md-end">Gender *</label>
                                <div class="col-md-8">
                                    <div class="form-check form-check-inline">
                                         <input class="form-check-input @error('gender') is-invalid @enderror" type="radio" name="gender" id="gender_male" value="male" {{ old('gender', isset($donor) && $donor ? $donor->gender : '' ) == 'male' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="gender_male">Male</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                         <input class="form-check-input @error('gender') is-invalid @enderror" type="radio" name="gender" id="gender_female" value="female" {{ old('gender', isset($donor) && $donor ? $donor->gender : '' ) == 'female' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="gender_female">Female</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                         <input class="form-check-input @error('gender') is-invalid @enderror" type="radio" name="gender" id="gender_other" value="other" {{ old('gender', isset($donor) && $donor ? $donor->gender : '' ) == 'other' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="gender_other">Other</label>
                                    </div>
                                    @error('gender')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="address" class="col-md-4 col-form-label text-md-end">Address *</label>
                                <div class="col-md-8">
                                     <textarea id="address" class="form-control @error('address') is-invalid @enderror" name="address" rows="3">{{ old('address', isset($donor) && $donor ? $donor->address : '' ) }}</textarea>
                                    @error('address')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="last_donation_date" class="col-md-4 col-form-label text-md-end">Last Donation Date</label>
                                <div class="col-md-8">
                                     <input id="last_donation_date" type="date" class="form-control @error('last_donation_date') is-invalid @enderror" name="last_donation_date" value="{{ old('last_donation_date', isset($donor) && $donor && $donor->last_donation_date ? $donor->last_donation_date->format('Y-m-d') : '' ) }}">
                                    @error('last_donation_date')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="availability_status" class="col-md-4 col-form-label text-md-end">Availability Status *</label>
                                <div class="col-md-8">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input @error('availability_status') is-invalid @enderror" type="radio" name="availability_status" id="availability_available" value="available" {{ old('availability_status', $donor->availability_status ?? '') == 'available' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="availability_available">Available</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input @error('availability_status') is-invalid @enderror" type="radio" name="availability_status" id="availability_not_available" value="not_available" {{ old('availability_status', $donor->availability_status ?? '') == 'not_available' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="availability_not_available">Not Available</label>
                                    </div>
                                    @error('availability_status')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="email" class="col-md-4 col-form-label text-md-end">Email</label>
                                <div class="col-md-8">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email', $donor->email ?? '') }}" autocomplete="email">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="notes" class="col-md-4 col-form-label text-md-end">Notes</label>
                                <div class="col-md-8">
                                    <textarea id="notes" class="form-control @error('notes') is-invalid @enderror" name="notes" rows="3">{{ old('notes', $donor->notes ?? '') }}</textarea>
                                    @error('notes')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                         {{ isset($donor) && $donor ? 'Update Donor' : 'Create Donor' }}
                                    </button>
                                    <a href="{{ route('donors.list') }}" class="btn btn-secondary">Cancel</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection