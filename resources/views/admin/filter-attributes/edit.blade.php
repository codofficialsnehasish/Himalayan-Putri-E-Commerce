@extends('layouts.app')

@section('title', 'Edit Filter Attribute')

@section('content')

<div class="section-body">
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center">
            <div class="header-action">
                <h1 class="page-title">Filter Attributes</h1>
                <ol class="breadcrumb page-breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item" aria-current="page">Product Management</li>
                    <li class="breadcrumb-item" aria-current="page">Filter Attributes</li>
                    <li class="breadcrumb-item active" aria-current="page">Edit Filter Attributes</li>
                </ol>
            </div>
            <ul class="nav nav-tabs page-header-tab">
                @can('Filter Attributes Show')
                <li class="nav-item">
                    <a class="btn btn-info" href="{{ route('filter-attributes.index') }}">
                        <i class="fa fa-arrow-left fa-sm"></i> Back</a>
                    </li>
                @endcan
            </ul>
        </div>
    </div> 
</div>    

<form action="{{ route('filter-attributes.update',$filter_attribute) }}" method="post" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="section-body mt-4">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-8 col-md-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Attribute Details</h3>
                            <div class="card-options ">
                                {{-- <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                                <a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a> --}}
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Attribute Name *</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                        id="name" name="name" value="{{ old('name',$filter_attribute->name) }}" required>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="slug">Slug *</label>
                                    <input type="text" class="form-control @error('slug') is-invalid @enderror" 
                                        id="slug" name="slug" value="{{ old('slug', $filter_attribute->slug) }}" required>
                                    @error('slug')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <small class="form-text text-muted">Unique identifier (lowercase, hyphens instead of spaces)</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Save & Publish</h3>
                            <div class="card-options ">
                                <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                                <a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row clearfix">
                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    <button type="reset" class="btn btn-outline-secondary">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection

@section('script')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Auto-generate slug from name
        const nameField = document.getElementById('name');
        const slugField = document.getElementById('slug');
        
        if (nameField && slugField) {
            nameField.addEventListener('blur', function() {
                if (!slugField.value) {
                    slugField.value = this.value.toLowerCase()
                        .replace(/\s+/g, '-')    // Replace spaces with -
                        .replace(/[^\w\-]+/g, '') // Remove all non-word chars
                        .replace(/\-\-+/g, '-')   // Replace multiple - with single -
                        .replace(/^-+/, '')       // Trim - from start of text
                        .replace(/-+$/, '');      // Trim - from end of text
                }
            });
        }
    });
</script>
@endsection