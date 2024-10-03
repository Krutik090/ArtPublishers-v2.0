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
@endpush
