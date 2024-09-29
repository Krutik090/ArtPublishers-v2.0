@extends('admin.layouts.master')
@section('contents')
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="{{ route('arts.index') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1>Arts</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item active"><a href="{{ route('arts.index') }}">Arts</a></div>
                <div class="breadcrumb-item">Create</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Create Arts</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('arts.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Image <span class="text-danger">*</span></label>
                                            <div id="image-preview" class="image-preview">
                                                <label for="image-upload" id="image-label">Choose File</label>
                                                <input type="file" name="image" id="image-upload" />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Thumbnail Image <span class="text-danger">*</span></label>
                                            <div id="image-preview-2" class="image-preview">
                                                <label for="image-upload-2" id="image-label-2">Choose File</label>
                                                <input type="file" name="thb_image" id="image-upload-2" />
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="title">Title <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="title" id="title" value="">
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="category">Category <span class="text-danger">*</span></label>
                                            <select name="category" id="category" class="form-control">
                                                <option value="">Select</option>
                                                @foreach ($category as $cat)
                                                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="location">Location <span class="text-danger">*</span></label>
                                            <select name="location" id="location" class="form-control">
                                                <option value="">Select</option>
                                                @foreach ($location as $lac)
                                                    <option value="{{ $lac->id }}">{{ $lac->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="address">Address <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="address" id="address" value="">
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="phone">Phone No <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="phone" id="phone"
                                                value="">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="email">Email <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="email" id="email"
                                                value="">
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="website">Website <span class="text-danger"></span></label>
                                            <input type="text" class="form-control" name="website" id="website"
                                                value="">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="fb_link">Facebook <span class="text-danger"></span></label>
                                            <input type="text" class="form-control" name="fb_link" id="fb_link"
                                                value="">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="x_link">X <span class="text-danger"></span></label>
                                            <input type="text" class="form-control" name="x_link" id="x_link"
                                                value="">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="insta_link">Instagram <span class="text-danger"></span></label>
                                            <input type="text" class="form-control" name="insta_link" id="insta_link"
                                                value="">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="attachment">Attachment <span class="text-danger"></span></label>
                                            <input type="file" class="form-control" name="attachment" id="attachment"
                                                value="">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Amenities</label>
                                    <select class="form-control select2" multiple="" name="amenities[]">
                                        @foreach ($amenity as $amt)
                                            <option value="{{ $amt->id }}">{{ $amt->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="description">Description <span class="text-danger"></span></label>
                                    <textarea name="description" id="description" class="summernote" cols="30" rows="10"></textarea>

                                </div>
                                <div class="form-group">
                                    <label for="google_map">Google Map Embed Code <span class="text-danger"></span></label>
                                    <textarea name="google_map" id="google_map" class="form-control" cols="30" rows="10"></textarea>

                                </div>

                                <div class="form-group">
                                    <label for="seo_title">SEO Title  <span class="text-danger"></span></label>
                                    <input type="text" class="form-control" name="seo_title" id="seo_title"
                                        value="">
                                </div>

                                <div class="form-group">
                                    <label for="seo_description">SEO Description <span class="text-danger"></span></label>
                                    <textarea name="seo_description" id="seo_description" class="form-control" cols="30" rows="10"></textarea>

                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="status">Status <span class="text-danger">*</span></label>
                                            <select name="status" id="status" class="form-control">
                                                <option value="1">Active</option>
                                                <option value="0">Inactive</option>
                                            </select>
                                        </div>

                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="is_featured">Is Featured <span class="text-danger">*</span></label>
                                            <select name="is_featured" id="is_featured" class="form-control">
                                                <option value="0">No</option>
                                                <option value="1">Yes</option>
                                            </select>
                                        </div>

                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="is_verified">Is Verified <span class="text-danger">*</span></label>
                                            <select name="is_verified" id="is_verified" class="form-control">
                                                <option value="1">Yes</option>
                                                <option value="0">No</option>
                                            </select>
                                        </div>

                                    </div>
                                </div>


                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary" name="submit">Create</button>
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
