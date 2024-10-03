@extends('frontend.layouts.master')

@push('styles')
    <link rel="stylesheet" href="{{ asset('admin/assets/modules/select2/dist/css/select2.min.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote.min.css" rel="stylesheet">
    <style>
        label {
            margin-top: 15px;
        }

        .custom-margin a {
            margin-right: 15px;
            /* Adjust this value for the space between button and heading */
        }

        .custom-margin h4 {
            margin-left: 15px;
            /* This aligns the heading with the button */
        }
    </style>
@endpush
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

                            <div class="d-flex align-items-center mb-3 custom-margin">
                                <a href="{{ route('account.arts.index') }}" class="btn btn-primary">
                                    <i class="fas fa-chevron-left"></i>
                                </a>
                                <h4 class="mb-0 ml-3">Video Gallery ({{ $arttitle->title }})</h4>
                            </div>

                            <form action="{{ route('account.video-gallery.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="video_url">Youtube Video URL <code>*</code></label>
                                    <input type="text" class="form-control" name="video_url" id="video_url">
                                    <input type="hidden" class="form-control" name="art_id" value="{{ request()->id }}">
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary mt-4"> Upload </button>
                                </div>

                            </form>
                        </div>
                        <div class="my_listing mt-4">
                            <h4>All Images</h4>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Image</th>
                                        <th scope="col">URL</th>
                                        <th scope="col">Action</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($videos as $video)
                                        <tr>
                                            <th scope="row">{{ ++$loop->index }}</th>
                                            <td>
                                                <img width="200px" src="{{ getThumbnail($video->video_url) }}" class="mt-2">
                                            </td>
                                            <td>
                                                <a target="_blank" href="{{ $video->video_url }}">{{ $video->video_url }} </a>
                                            </td>
                                            <td>
                                                <a href="{{ route('video-gallery.destroy', $video->id) }}"
                                                    class="btn delete-item btn-md btn-danger">
                                                    <i class="fas fa-trash-alt"> </i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection


@push('scripts')
    <script src="{{ asset('admin/assets/modules/upload-preview/assets/js/jquery.uploadPreview.min.js') }}"></script>
    <script src="{{ asset('admin/assets/modules/select2/dist/js/select2.full.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(".select2").select2();

        $(document).ready(function() {
            $('.summernote').summernote();
        });


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
    <script>
        $('body').on('click', '.delete-item', function(e) {
            e.preventDefault();
            let url = $(this).attr('href');
            console.log(url);
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {

                    $.ajax({
                        method: 'DELETE',
                        url: url,
                        data: {
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(response) {
                            if (response.status == 'success') {
                                Swal.fire({
                                    title: "Deleted!",
                                    text: response.message,
                                    icon: "success"
                                })
                                window.location.reload();
                            } else if (response.status == 'error') {
                                Swal.fire({
                                    title: "Something Went Wrong",
                                    text: response.message,
                                    icon: "error"
                                })
                            }

                        },
                        error: function(xhr, status, error) {
                            console.log(error);
                        }
                    })


                }
            });
        })
    </script>
@endpush
