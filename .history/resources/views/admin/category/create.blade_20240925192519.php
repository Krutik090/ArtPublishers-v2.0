@extends('admin.layouts.master')
@section('contents')
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="{{ route('category.index') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1>Category</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item active"><a href="{{ route('category.index') }}">Category</a></div>
                <div class="breadcrumb-item">Create</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Create Category</h4>
                        </div>
                        <form action="{{ route('admin.hero.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="">Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="name" id="name"
                                    value="">
                            </div>

                            <div class="form-group">
                                <label for="">Icon Image <span class="text-danger">*</span></label>
                                <div id="image-preview" class="image-preview">
                                    <label for="image-upload" id="image-label">Choose File</label>
                                    <input type="file" name="icon_image" id="icon_image" />
                                </div>
                            </div>


                            <div class="form-group">

                                <input type="submit" class="btn btn-primary" name="Submit">
                            </div>
                        </form>
                        <div class="card-body">

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection

@push('scripts')
    <script>

    </script>
@endpush