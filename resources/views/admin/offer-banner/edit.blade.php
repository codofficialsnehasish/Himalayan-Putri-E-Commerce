@extends('layouts.app')

@section('title','Offer Banner')

@section('style')
<link rel="stylesheet" href="{{ asset('assets/admin-assets/plugins/dropify/css/dropify.min.css') }}">
@endsection

@section('content')

<div class="section-body">
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center">
            <div class="header-action">
                <h1 class="page-title">Offer Banner</h1>
                <ol class="breadcrumb page-breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('offer-banner.index') }}">Offer Banner</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit Offer Banner</li>
                </ol>
            </div>
            <ul class="nav nav-tabs page-header-tab">
                <li class="nav-item">
                    <a class="btn btn-info" href="{{ route('offer-banner.index') }}">
                        <i class="fa fa-arrow-left me-2"></i>Back
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>

<form action="{{ route('offer-banner.update', $offerBanner->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="section-body mt-4">
        <div class="container-fluid">
            <div class="row">
                {{-- Left Section --}}
                <div class="col-lg-8 col-md-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Offer Banner Information</h3>
                        </div>
                        <div class="card-body">

                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Heading <span class="text-danger">*</span></label>
                                <div class="col-md-9">
                                    <input type="text" name="heading" class="form-control"
                                        placeholder="Enter heading" value="{{ old('heading', $offerBanner->heading) }}" required>
                                    @error('heading') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Title <span class="text-danger">*</span></label>
                                <div class="col-md-9">
                                    <input type="text" name="title" class="form-control"
                                        placeholder="Enter title" value="{{ old('title', $offerBanner->title) }}" required>
                                    @error('title') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                            </div>

                        </div>
                    </div>

                    {{-- Image Upload --}}
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Banner Image</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <input type="file" name="image" class="dropify"
                                    data-default-file="{{ $offerBanner->getFirstMediaUrl('offer-banner') }}">
                                @error('image') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Right Section --}}
                <div class="col-lg-4 col-md-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Save & Publish</h3>
                        </div>
                        <div class="card-body">
                            <div class="row clearfix">
                                <div class="col-sm-12 mb-3">
                                    <label class="form-label mb-3 d-flex">Visibility</label>
                                    <div class="form-check form-check-inline">
                                        <input type="radio" id="is_visible1" name="is_visible"
                                            class="form-check-input" value="1"
                                            {{ $offerBanner->is_visible == 1 ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_visible1">Show</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input type="radio" id="is_visible2" name="is_visible"
                                            class="form-check-input" value="0"
                                            {{ $offerBanner->is_visible == 0 ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_visible2">Hide</label>
                                    </div>
                                    @error('is_visible') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>

                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                    <a href="{{ route('offer-banner.index') }}" class="btn btn-outline-secondary">Cancel</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> {{-- End Right --}}
            </div>
        </div>
    </div>
</form>

@endsection

@section('script')
<script src="{{ asset('assets/admin-assets/plugins/dropify/js/dropify.min.js') }}"></script>
<script src="{{ asset('assets/admin-assets/page-assets/js/form/dropify.js') }}"></script>
@endsection
