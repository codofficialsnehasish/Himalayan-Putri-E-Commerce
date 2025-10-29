@extends('layouts.app')

@section('title', 'Services')

@section('content')
<div class="section-body">
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center">
            <div class="header-action">
                <h1 class="page-title">Services</h1>
                <ol class="breadcrumb page-breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Services</li>
                </ol>
            </div>
            <ul class="nav nav-tabs page-header-tab">
                @can('Service Create')
                <li class="nav-item">
                    <a class="btn btn-info" href="{{ route('service.create') }}">
                        <i class="fa fa-plus"></i> Add New Service
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
            <div class="tab-pane active">
                <div class="card mt-4">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover js-basic-example dataTable table-striped table_custom border-style spacing5">
                                <thead class="table-light">
                                    <tr>
                                        <th>Sl. No</th>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Image</th>
                                        <th>Visibility</th>
                                        <th>Created At</th>
                                        @canany(['Service Edit', 'Service Delete'])
                                            <th>Action</th>
                                        @endcanany
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($services as $service)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td class="text-wrap">{{ $service->title }}</td>
                                            <td class="text-wrap">{!! $service->description !!}</td>
                                            <td>
                                                @if($service->getFirstMediaUrl('service-icon'))
                                                    <img src="{{ $service->getFirstMediaUrl('service-icon') }}" 
                                                         class="img-thumbnail rounded me-2" 
                                                         width="60" height="60" alt="Service Image">
                                                @else
                                                    <img src="{{ asset('images/no-image.png') }}" 
                                                         class="img-thumbnail rounded me-2" 
                                                         width="60" height="60" alt="No Image">
                                                @endif
                                            </td>
                                            <td>{!! check_status($service->is_visible) !!}</td>
                                            <td>{{ format_datetime($service->created_at) }}</td>

                                            @canany(['Service Edit', 'Service Delete'])
                                            <td>
                                                @can('Service Edit')
                                                <a class="btn btn-icon btn-sm" 
                                                   href="{{ route('service.edit', $service->id) }}" 
                                                   title="Edit">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                @endcan

                                                @can('Service Delete')
                                                <form action="{{ route('service.destroy', $service->id) }}" 
                                                      method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-icon btn-sm" 
                                                            onclick="return confirm('Are you sure you want to delete this service?')" 
                                                            type="submit" title="Delete">
                                                        <i class="fa fa-trash-o text-danger"></i>
                                                    </button>
                                                </form>
                                                @endcan
                                            </td>
                                            @endcanany
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center text-muted">
                                                No services found.
                                            </td>
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
