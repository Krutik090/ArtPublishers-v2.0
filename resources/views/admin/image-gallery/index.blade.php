@extends('admin.layouts.master')
@section('contents')
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="{{ route('arts.index') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1>Image Gallery  ({{ $arttitle->title }})</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item active"><a href="{{ route('arts.index') }}">Arts</a></div>
                <div class="breadcrumb-item">Image Gallery</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Add Images</h4>
                        </div>

                        <div class="card-body">
                            <form action="{{ route('image-gallery.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="">Image <code>(Multi Image Supported)</code></label>
                                    <input type="file" class="form-control" name="images[]" multiple>
                                    <input type="hidden" class="form-control" value="{{ request()->id }}" name="art_id">

                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary"> Upload </button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>All Images</h4>
                        </div>

                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Image</th>
                                        <th scope="col">Action</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($images as $image)
                                    <tr>
                                        <th scope="row">{{ ++$loop->index }}</th>
                                        <td><img src="{{ asset($image->image) }}" class="mt-2" hight="150px" width="210px" alt=""></td>
                                        <td><a href="{{ route('image-gallery.destroy',$image->id) }}" class="btn delete-item btn-md btn-danger"><i class="fas fa-trash-alt"></i></a></td>
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
    <script></script>
@endpush
