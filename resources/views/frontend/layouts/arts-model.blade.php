<div class="row">
    <div class="col-12 col-xl-12 col-md-12">
        <div class="map_popup_content">
            <div class="img">
                <img src="{{ asset($arts->image) }}" alt="{{ $arts->title }}" class="img-fluid w-100">
            </div>
            <div class="map_popup_text">
                @if ($arts->is_featured)
                <span><i class="far fa-star"></i> Featured</span>
                @endif
                @if ($arts->is_verified)
                <span class="red"><i class="far fa-check"></i> verified</span>
                @endif
                <h5>{{ $arts->title }}</h5>
                <a class="call" href="callto:{{ $arts->phone }}"><i class="fal fa-phone-alt"></i>
                    {{ $arts->phone }}</a>
                <a class="mail" href="mailto:{{ $arts->email }}"><i
                        class="fal fa-envelope"></i>
                        {{ $arts->email }}</a>
                <p>{{ truncate(strip_tags($arts->description), 100) }}</p>
                <a class="read_btn" href="{{ route('arts.show',$arts->slug) }}">read more</a>
            </div>
        </div>
    </div>
    @if($arts->google_map_link)
    <div class="col-12 col-xl-12 col-md-12">
        <div class="map_popup_content_map">
            {!! $arts->google_map_link !!}
        </div>
    </div>
    @endif
</div>
