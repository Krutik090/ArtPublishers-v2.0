@extends('frontend.layouts.master')

@section('contents')
    <section id="dashboard">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    @include('frontend.dashboard.sidebar')
                </div>
                <div class="col-lg-9">
                    <div class="dashboard_content">
                        <div class="my_listing">
                            <h4>basic information</h4>
                            <form action="{{ route('account.profile.update') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-xl-8 col-md-12">
                                        <div class="row">
                                            <div class="col-xl-6 col-md-6">
                                                <div class="my_listing_single">
                                                    <label for="name">Name <span class="text-danger">*</span></label>
                                                    <div class="input_area">
                                                        <input type="text" placeholder="Name" name="name" id="name" value="{{ $user->name }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-6 col-md-6">
                                                <div class="my_listing_single">
                                                    <label for="phone">phone <span class="text-danger">*</span></label>
                                                    <div class="input_area">
                                                        <input type="text" placeholder="" name="phone" id="phone" value="{{ $user->phone }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-12">
                                                <div class="my_listing_single">
                                                    <label for="email">email <span class="text-danger">*</span></label>
                                                    <div class="input_area">
                                                        <input type="Email" placeholder="Email" name="email" id="email" value="{{ $user->email }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="my_listing_single">
                                                    <label for="address">Address <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" name="address" id="address"
                                                        value="{{ $user->address }}" required>
                                                </div>
                                            </div>
                                            <div class="col-xl-12">
                                                <div class="my_listing_single">
                                                    <label for="about">About Me</label>
                                                    <div class="input_area">
                                                        <textarea cols="3" rows="3" placeholder="Your Text" name="about" id="about" >{!! $user->about !!}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-6">
                                                <div class="my_listing_single">
                                                    <label for="website">Website</label>
                                                    <div class="input_area">
                                                        <input type="text" name="website" id="website" value="{{ $user->website }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-6">
                                                <div class="my_listing_single">
                                                    <label for="fb_link">Facebook</label>
                                                    <div class="input_area">
                                                        <input type="text" name="fb_link" id="fb_link" value="{{ $user->fb_link }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-6">
                                                <div class="my_listing_single">
                                                    <label for="x_link">X</label>
                                                    <div class="input_area">
                                                        <input type="text" name="x_link" id="x_link" value="{{ $user->x_link }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-6">
                                                <div class="my_listing_single">
                                                    <label for="in_link">LinkedIn</label>
                                                    <div class="input_area">
                                                        <input type="text" name="in_link" id="in_link" value="{{ $user->in_link }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-6">
                                                <div class="my_listing_single">
                                                    <label for="wp_link">WhatsApp</label>
                                                    <div class="input_area">
                                                        <input type="text" name="wp_link" id="wp_link" value="{{ $user->wp_link }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-6">
                                                <div class="my_listing_single">
                                                    <label for="insta_link">Instagram</label>
                                                    <div class="input_area">
                                                        <input type="text" name="insta_link" id="insta_link"
                                                        value="{{ $user->insta_link }}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-md-5">
                                        <div class="my_listing_single">
                                            <label for="avatar">Avatar</label>
                                            <div class="profile_pic_upload">
                                                <img src="{{ asset($user->avatar) }}" alt="img" class="imf-fluid w-100">
                                                <input type="file" name="avatar">
                                            </div>
                                        </div>
                                        <div class="my_listing_single">
                                            <label for="banner">Banner</label>
                                            <div class="profile_pic_upload">
                                                <img src="{{ asset($user->banner) }}" alt="img" class="imf-fluid w-100">
                                                <input type="file" name="banner">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <button type="submit" class="read_btn">Update</button>
                                </div>
                            </form>
                        </div>
                        <div class="my_listing list_mar">
                            <h4>change password</h4>
                            <form action="{{ route('account.profile.passwordUpdate') }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-xl-4 col-md-6">
                                        <div class="my_listing_single">
                                            <label>current password</label>
                                            <div class="input_area">
                                                <input type="password" placeholder="Current Password" name="current_password">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-md-6">
                                        <div class="my_listing_single">
                                            <label>new password</label>
                                            <div class="input_area">
                                                <input type="password" placeholder="New Password" name="password">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-4">
                                        <div class="my_listing_single">
                                            <label>confirm password</label>
                                            <div class="input_area">
                                                <input type="password" placeholder="Confirm Password" name="password_confirmation">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <button type="submit" class="read_btn">Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection


@push('scripts')
    <script>
        $(document).ready(function() {
            $('.avatar-preview').css({
                'background-image': 'url({{ asset($user->avatar) }})',
                'background-size': 'cover',
                'background-position': 'center center'
            });

            $('.banner-preview').css({
                'background-image': 'url({{ asset($user->banner) }})',
                'background-size': 'cover',
                'background-position': 'center center'
            });
        })

        $.uploadPreview({
            input_field: "#image-upload", // Default: .image-upload
            preview_box: "#image-preview", // Default: .image-preview
            label_field: "#image-label", // Default: .image-label
            label_default: "Choose File", // Default: Choose File
            label_selected: "Change File", // Default: Change File
            no_label: false, // Default: false
            success_callback: null // Default: null
        });

        $.uploadPreview({
            input_field: "#image-upload-2", // Default: .image-upload
            preview_box: "#image-preview-2", // Default: .image-preview
            label_field: "#image-label-2", // Default: .image-label
            label_default: "Choose File", // Default: Choose File
            label_selected: "Change File", // Default: Change File
            no_label: false, // Default: false
            success_callback: null // Default: null
        });
    </script>
@endpush
