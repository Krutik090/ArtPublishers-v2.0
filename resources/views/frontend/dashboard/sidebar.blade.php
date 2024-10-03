<div class="dashboard_sidebar">
    <span class="close_icon"><i class="far fa-times"></i></span>
    <a href="dsahboard.html" class="dash_logo"><img src="{{ asset(auth()->user()->avatar) }}" alt="logo"
            class="img-fluid"></a>
    <ul class="dashboard_link">
        <li><a class="active" href="{{ route('account.dashboard') }}"><i class="fas fa-tachometer"></i>Dashboard</a></li>
        <li><a href="{{ route('account.arts.index') }}"><i class="fas fa-list-ul"></i> My Arts</a></li>
        <li><a href="{{ route('account.arts.create') }}"><i class="fal fa-plus-circle"></i> Create
                Arts</a></li>
        {{-- <li><a href="dsahboard_review.html"><i class="far fa-star"></i> Reviews</a></li>
        <li><a href="dsahboard_wishlist.html"><i class="far fa-heart"></i> Wishlist</a></li>

        <li><a href="dsahboard_order.html"><i class="fal fa-notes-medical"></i> Orders</a></li>
        <li><a href="dsahboard_package.html"><i class="fal fa-gift-card"></i> Package</a></li>
        <li><a href="dsahboard_message.html"><i class="far fa-comments-alt"></i> Message</a></li> --}}
        <li><a href="{{ route('account.profile') }}"><i class="far fa-user"></i> My Profile</a></li>
        {{-- <li><a href="{{ route('account.logout') }}"><i class="far fa-sign-out-alt"></i> Logout</a></li> --}}
        <li>
            <form action="{{ route('account.logout') }}">
                <a href="{{ route('account.logout') }}" onclick="event.preventDefault(); this.closest('form').submit();"
                    class="text-danger">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
            </form>
        </li>
    </ul>
</div>
