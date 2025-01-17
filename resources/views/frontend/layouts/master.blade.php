<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no, target-densityDpi=device-dpi" />
    <title>ArtPublishers</title>
    <link rel="icon" type="image/png" href="images/favicon.png">
    <link rel="stylesheet" href="{{ asset('frontend/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/venobox.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/summernote.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/nice-select.css') }}">
    <link rel="stylesheet" href="//cdn.datatables.net/2.1.7/css/dataTables.dataTables.min.css">
    <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/responsive.css') }}">
    {{-- <style>
        .modal-content {
            max-height: 90vh;
            /* Limits modal height to 90% of viewport height */
            overflow-y: auto;
            /* Adds scroll if content exceeds max-height */
        }

        .modal-body {
            max-height: 75vh;
            /* Controls modal body height for scrollability */
            overflow-y: auto;
        } --}}
    </style>
    <!-- <link rel="stylesheet" href="css/rtl.css"> -->
    @stack('styles')
</head>

<body>

    <!--==========================
        NAVABR PART START
    ===========================-->
    @include('frontend.layouts.navbar')
    <!--==========================
        NAVABR PART START
    ===========================-->

    <!--==========================
        Contents PART START
    ===========================-->
    @yield('contents')

    <!--==========================
        Contents PART END
    ===========================-->


    <!--==========================
        FOOTER PART START
    ===========================-->
    @include('frontend/layouts/footer')
    <!--==========================
        FOOTER PART END
    ===========================-->

    <!--==========================
        Listing MODEL PART START
    ===========================-->

    <section id="wsus__map_popup">
        <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <button type="button" class="btn-close popup_close" data-bs-dismiss="modal" aria-label="Close"><i
                            class="far fa-times"></i></button>
                    <div class="modal-body model-art-content">

                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--==========================
        Listing MODEL PART END
    ===========================-->

    <!--=============SCROLL BTN==============-->
    <div class="scroll_btn">
        <i class="fas fa-chevron-up"></i>
    </div>
    <!--=============SCROLL BTN==============-->


    <!--jquery library js-->
    <script src="{{ asset('frontend/js/jquery-3.6.0.min.js') }}"></script>
    <!--bootstrap js-->
    <script src="{{ asset('frontend/js/bootstrap.bundle.min.js') }}"></script>
    <!--font-awesome js-->
    <script src="{{ asset('frontend/js/Font-Awesome.js') }}"></script>
    <!--slick js-->
    <script src="{{ asset('frontend/js/slick.min.js') }}"></script>
    <!--venobox js-->
    <script src="{{ asset('frontend/js/venobox.min.js') }}"></script>
    <!--counter js-->
    <script src="{{ asset('frontend/js/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.countup.min.js') }}"></script>
    <!--nice select js-->
    <script src="{{ asset('frontend/js/select2.min.js') }}"></script>
    <!--isotope js-->
    <script src="{{ asset('frontend/js/isotope.pkgd.min.js') }}"></script>
    <!--summer_note js-->
    <script src="{{ asset('frontend/js/summernote.min.js') }}"></script>
    <!--select js-->
    <script src="{{ asset('frontend/js/jquery.nice-select.min.js') }}"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="//cdn.datatables.net/2.1.7/js/dataTables.min.js"></script>

    <!--main/custom js-->
    <script src="{{ asset('frontend/js/main.js') }}"></script>
    <script>
        @if (session('success'))
            toastr.success("{{ session('success') }}");
        @endif

        @if ($errors->any())
            @foreach ($errors->all() as $error)
                toastr.error("{{ $error }}")
            @endforeach
        @endif
    </script>


    <script>
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                toastr.error("{{ $error }}")
            @endforeach
        @endif
    </script>



    <script>
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                toastr.error("{{ $error }}")
            @endforeach
        @endif
    </script>

    <script>
        function showArtModel(id) {
            $.ajax({
                method: 'GET',
                url: '{{ route('arts-model', ':id') }}'.replace(":id", id),
                data: {},
                beforeSend: function() {
                    $('.model-art-content').html(
                        `<div class="spinner-border" role="status"><span class="visually-hidden">Loading...</span></div>`
                    )

                },
                success: function(response) {
                    $('.model-art-content').html(response)
                },
                error: function(xhr, status, error) {
                    console.log(error)
                }
            })
        }
    </script>
    @stack('scripts')
</body>

</html>
