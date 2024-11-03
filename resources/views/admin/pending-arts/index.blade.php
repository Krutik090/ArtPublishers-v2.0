@extends('admin.layouts.master')
@section('contents')
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="{{ route('admin.dashboard') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1>Pending Arts</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item">Pending Arts</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Pending Arts</h4>
                            <div class="card-header-action">
                                <a href="{{  route('arts.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Create</a>
                            </div>
                        </div>

                        <div class="card-body">
                            {{ $dataTable->table() }}
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </section>
@endsection

@push('scripts')

        {{ $dataTable->scripts(attributes: ['type' => 'module']) }}

        {{-- <script>
             $('body').on('change','.approve', function(e) {
                let id = $(this).data('id');
                let value = $(this).val();
                alert(value);
                $.ajax({
                    method: 'POST',
                    url : '{{ route("admin.pending-arts.update") }}',
                    data: {
                        _token:"{{ csrf_token() }}",
                        id:id,
                        value:value
                    },
                    success: function(response){

                        if(response.status === "success"){
                            toastr.success(response.message);
                        }else{
                            toastr.error(response.message);
                        }
                    },error: function(error){
                        console.log(error);
                    }
                })
            })
        </script> --}}
        <script>
            $('body').on('change', '.approve', function(e) {
                let id = $(this).data('id');
                let value = $(this).val();

                $.ajax({
                    method: 'POST',
                    url: '{{ route("admin.pending-arts.update") }}',
                    data: {
                        _token: "{{ csrf_token() }}",
                        id: id,
                        value: value
                    },
                    success: function(response) {
                        if (response.status === "success") {
                            toastr.success(response.message);
                        } else {
                            toastr.error(response.message);
                        }
                    },
                    error: function(error) {
                        console.log(error);
                        toastr.error("An error occurred. Please check the console for more details.");
                    }
                });
            });
        </script>


@endpush
