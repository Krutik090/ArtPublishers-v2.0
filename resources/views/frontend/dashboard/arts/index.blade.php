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
                            <h4 style="justify-content: space-between">My Arts
                                <a href="{{ route('account.arts.create') }}" class="btn btn-success"> Create</a>
                            </h4>
                            <div class="card-body">
                                {{ $dataTable->table() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection


@push('scripts')
        {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
                                }else if(response.status == 'error'){
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
