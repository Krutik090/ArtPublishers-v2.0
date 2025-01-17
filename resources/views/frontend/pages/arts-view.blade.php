@extends('frontend.layouts.master')

@section('contents')
    <!--==========================
                                    BREADCRUMB PART START
                                ===========================-->
    <div id="breadcrumb_part"
        style="
    background : url({{ $arts->thumbnail }});
    background-size : cover;
    background-repeat: no-repeat;
    background-position: center;
    ">
        <div class="bread_overlay">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 text-center text-white">
                        <h4>{{ $arts->title }}</h4>
                        <nav style="--bs-breadcrumb-divider: '';" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}"> Home </a></li>
                                <li class="breadcrumb-item active" aria-current="page"> Arts details </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--==========================
                                    BREADCRUMB PART END
                                ===========================-->


    <!--==========================
                                    LISTING DETAILS START
                                ===========================-->
    <section id="listing_details">
        <div class="container">
            <div class="row">
                <div class="col-xl-8 col-lg-7">
                    <div class="listing_details_text">
                        <div class="listing_det_header">
                            <div class="listing_det_header_img">
                                <img src="{{ asset($arts->user->avatar) }}" alt="logo" class="img-fluid w-100">
                            </div>
                            <div class="listing_det_header_text">
                                <h6>{{ $arts->title }}</h6>
                                <p class="host_name">Hosted by <a
                                        href="agent_public_profile.html">{{ $arts->user->name }}</a></p>
                                <p class="rating">
                                    @for ($i = 1; $i <= 5; $i++)
                                                    @if ($i <= $arts->reviews_avg_rating)
                                                        <i class="fas fa-star"></i>
                                                    @else
                                                        <i class="far fa-star"></i>
                                                    @endif
                                                @endfor
                                    <b>{{ intval($arts->reviews_avg_rating) }}</b>
                                    <span>({{ count($reviews)  }} reviews)</span>
                                </p>
                                <ul>
                                    @if ($arts->is_verified)
                                        <li><a href="#"><i class="far fa-check"></i> Verified</a></li>
                                    @endif
                                    @if ($arts->is_featured)
                                        <li><a href="#"><i class="far fa-star"></i> Featured</a></li>
                                    @endif
                                    <li><a href="#"><i class="fal fa-heart"></i> Add to Favorite</a></li>
                                    <li><a href="#"><i class="fal fa-eye"></i> 194</a></li>
                                    {{-- <li><a href="#">Open</a></li> --}}
                                </ul>
                            </div>
                        </div>
                        <div class="listing_det_text">
                            {!! $arts->description !!}
                        </div>
                        <div class="listing_det_Photo">
                            <div class="row">
                                @foreach ($arts->gallery as $image)
                                    <div class="col-xl-3 col-sm-6">
                                        <a class="venobox" data-gall="gallery01" href="{{ asset($image->image) }}">
                                            <img src="{{ asset($image->image) }}" alt="gallery1" class="img-fluid w-100">
                                            <div class="photo_overlay">
                                                <i class="fal fa-plus"></i>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="listing_det_feature">
                            <div class="row">
                                @foreach ($arts->amenities as $amenity)
                                    <div class="col-xl-4 col-sm-6">
                                        <div class="listing_det_feature_single">
                                            <i class="{{ $amenity->amenity->icon }}"></i>
                                            <span>{{ $amenity->amenity->name }}</span>
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                        <div class="listing_det_video">
                            <div class="row">
                                @foreach ($arts->videoGallery as $video)
                                    <div class="col-xl-4 col-sm-6">
                                        <div class="listing_det_video_img">
                                            <img src="{{ getThumbnail($video->video_url) }}" alt="img"
                                                class="img-fluid w-100">
                                            <a class="venobox" data-autoplay="true" data-vbtype="video"
                                                href="{{ $video->video_url }}">
                                                <i class=" fas fa-play"></i>
                                            </a>
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                        @if ($arts->google_map_link)
                            {!! $arts->google_map_link !!}
                        @endif

                        <div class="wsus__listing_review">
                            <h4>reviews {{ count($reviews) }}</h4>
                            @foreach ($reviews as $review)
                                <div class="wsus__single_comment">
                                    <div class="wsus__single_comment_img">
                                        <img src="{{ asset($review->user->avatar) }}" alt="comment"
                                            class="img-fluid w-100">
                                    </div>
                                    <div class="wsus__single_comment_text">
                                        <h5>{{ $review->user->name }}<span>
                                                @for ($i = 1; $i <= 5; $i++)
                                                    @if ($i <= $review->rating)
                                                        <i class="fas fa-star"></i>
                                                    @else
                                                        <i class="far fa-star"></i>
                                                    @endif
                                                @endfor
                                            </span>
                                        </h5>
                                        <span>{{ date('d-m-Y', strtotime($review->created_at)) }}</span>
                                        <p>{{ $review->review }}</p>
                                    </div>
                                </div>
                            @endforeach

                            <div>
                                <div id="pagination">
                                    @if ($reviews->hasPages())
                                    {{ $reviews->links() }}
                                @endif
                                </div>

                            </div>

                            @auth
                                <form action={{ route('art-review.store') }} method="POST" class="input_comment">
                                    @csrf
                                    <h5>add a review</h5>
                                    <div class="row">
                                        <div class="col-xl-12">
                                            <div class="wsus__select_rating">
                                                <i class="fas fa-star"></i>
                                                <select class="select_2" name="rating">
                                                    <option value="">select rating</option>
                                                    <option value="1"> 1 </option>
                                                    <option value="2"> 2 </option>
                                                    <option value="3"> 3 </option>
                                                    <option value="4"> 4 </option>
                                                    <option value="5"> 5 </option>
                                                </select>
                                                <input type="hidden" name="art_id" value="{{ $arts->id }}">
                                            </div>
                                        </div>
                                        <div class="col-xl-12">
                                            <div class="blog_single_input">
                                                <textarea cols="3" rows="5" placeholder="Comment" name="review"></textarea>
                                                <button type="submit" class="read_btn">submit review</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            @endauth

                            @guest
                                <div class="alert alert-warning">
                                    Please <a href="{{ route('account.login') }}">login</a> for submit a review.
                                </div>
                            @endguest

                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-5">
                    <div class="listing_details_sidebar">
                        <div class="row">
                            <div class="col-12">
                                <div class="listing_det_side_address">
                                    <a href="callto:{{ $arts->phone }}"><i class="fal fa-phone-alt"></i>
                                        {{ $arts->phone }}</a>
                                    <a href="mailto:{{ $arts->email }}"><i class="fal fa-envelope"></i>
                                        {{ $arts->email }}</a>
                                    <p><i class="fal fa-map-marker-alt"></i> {{ $arts->location->name }}</p>
                                    @if ($arts->website)
                                        <p style="display: flex; ">
                                            <i class="fal fa-globe" style="margin-right: 5px;"></i>
                                            <a href="{{ $arts->website }}">{{ $arts->website }}</a>
                                        </p>
                                    @endif

                                    <ul>
                                        @if ($arts->fb_link)
                                            <li><a href="{{ $arts->fb_link }}"><i class="fab fa-facebook-f"></i></a></li>
                                        @endif
                                        @if ($arts->x_link)
                                            <li><a href="{{ $arts->x_link }}"><i class="fab fa-twitter"></i></a></li>
                                        @endif
                                        @if ($arts->in_link)
                                            <li><a href="{{ $arts->in_link }}"><i class="fab fa-linkedin-in"></i></a>
                                            </li>
                                        @endif
                                        @if ($arts->insta_link)
                                            <li><a href="{{ $arts->insta_link }}"><i class="fab fa-instagram"></i></a>
                                            </li>
                                        @endif

                                    </ul>
                                </div>
                            </div>
                            {{-- <div class="col-12">
                                    <div class="listing_det_side_open_hour">
                                        <h5>Opening Hours</h5>
                                        <p>Saturday <span>10:00 AM - 06:00 PM</span></p>
                                        <p>Sunday <span>Close</span></p>
                                        <p>Monday <span>10:00 AM - 06:00 PM</span></p>
                                        <p>Yuesday <span>10:00 AM - 06:00 PM</span></p>
                                        <p>Wednesday <span>10:00 AM - 06:00 PM</span></p>
                                        <p>Thursday <span>10:00 AM - 06:00 PM</span></p>
                                        <p>Friday <span>10:00 AM - 06:00 PM</span></p>
                                    </div>
                                </div> --}}
                            <div class="col-12">
                                <div class="listing_det_side_contact">
                                    <h5>quick contact</h5>
                                    <form>
                                        <form type="text" placeholder="Name*">
                                            <input type="email" placeholder="Email*">
                                            <input type="text" placeholder="Phone*">
                                            <input type="text" placeholder="Subject*">
                                            <textarea cols="3" rows="5" placeholder="Message*"></textarea>
                                            <button type="submit" class="read_btn">send</button>
                                        </form>
                                </div>
                            </div>
                            @if (count($similarArts) > 0)
                                <div class="col-12">
                                    <div class="listing_det_side_list">
                                        <h5>Similar Listing</h5>
                                        @foreach ($similarArts as $smart)
                                            <a href="{{ route('arts.show', $smart->slug) }}" class="sidebar_blog_single">
                                                <div class="sidebar_blog_img">
                                                    <img src="{{ asset($smart->image) }}" alt="{{ $smart->title }}"
                                                        class="imgofluid w-100">
                                                </div>
                                                <div class="sidebar_blog_text">
                                                    <h5>{{ truncate($smart->title) }}</h5>
                                                    <p> <span>Jul 29 2021
                                                            {{ date('m d Y', strtotime($smart->created_at)) }} </span> 2
                                                        Comment </p>
                                                </div>
                                            </a>
                                        @endforeach


                                    </div>
                                </div>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--==========================
                                    LISTING DETAILS END
                                ===========================-->

@endsection

@push('scripts')
    <script>
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                toastr.error("{{ $error }}")
            @endforeach
        @endif
    </script>
@endpush
