@extends('layouts.app')

@section('title','Offer Banner')

@section('content')

<div class="section-body">
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center">
            <div class="header-action">
                <h1 class="page-title">Offer Banner</h1>
                <ol class="breadcrumb page-breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Offer Banner</li>
                </ol>
            </div>
            <ul class="nav nav-tabs page-header-tab">
                @can('OfferBanner Create')
                <li class="nav-item">
                    <a class="btn btn-info" href="{{ route('offer-banner.create') }}">
                        <i class="fa fa-plus"></i> Add New Offer Banner
                    </a>
                </li>
                @endcan
            </ul>
        </div>
    </div>
</div>

<div class="section-body mt-4">
    <div class="container-fluid">
        <div class="tab-content">
            <div class="tab-pane active" id="OfferBanner-all">
                <div class="card mt-4">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover js-basic-example dataTable table-striped table_custom border-style spacing5">
                                <thead class="table-light">
                                    <tr>
                                        <th>Sl.no</th>
                                        <th>Heading</th>
                                        <th>Title</th>
                                        <th>Image</th>
                                        <th>Visibility</th>
                                        <th>Created At</th>
                                        @canany(['OfferBanner Edit','OfferBanner Delete'])
                                        <th>Action</th>
                                        @endcanany
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($offerBanners as $banner)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td class="text-wrap">{{ $banner->heading }}</td>
                                        <td class="text-wrap">{{ $banner->title }}</td>
                                        <td>
                                            @if($banner->getFirstMediaUrl('offer-banner'))
                                                <img src="{{ $banner->getFirstMediaUrl('offer-banner') }}" width="60" class="img-thumbnail rounded" alt="Banner">
                                            @else
                                                <img src="{{ asset('assets/no-image.png') }}" width="60" class="img-thumbnail rounded" alt="No Image">
                                            @endif
                                        </td>
                                        <td>{!! check_status($banner->is_visible) !!}</td>
                                        <td>{{ format_datetime($banner->created_at) }}</td>
                                        @canany(['OfferBanner Edit','OfferBanner Delete'])
                                        <td>
                                            @can('OfferBanner Edit')
                                            <a class="btn btn-icon btn-sm" href="{{ route('offer-banner.edit', $banner->id) }}" title="Edit">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            @endcan
                                            @can('OfferBanner Delete')
                                            <form action="{{ route('offer-banner.destroy', $banner->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-icon btn-sm" onclick="return confirm('Are you sure you want to delete this banner?')" type="submit">
                                                    <i class="fa fa-trash-o text-danger"></i>
                                                </button>
                                            </form>
                                            @endcan
                                        </td>
                                        @endcanany
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="7" class="text-center text-muted">No Offer Banners Found</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
