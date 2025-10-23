@extends('layouts.app')

@section('title', 'Filter Attributes')

@section('content')

<div class="section-body">
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center">
            <div class="header-action">
                <h1 class="page-title">Filter Attributes</h1>
                <ol class="breadcrumb page-breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item" aria-current="page">Product Management</li>
                    <li class="breadcrumb-item active" aria-current="page">Filter Attributes</li>
                </ol>
            </div>
            <ul class="nav nav-tabs page-header-tab">
                {{-- <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#Student-all" id="list-tab">List</a></li> --}}
                @can('Filter Attributes Create')
                <li class="nav-item"><a class="btn btn-info" href="{{ route('filter-attributes.create') }}"><i class="fa fa-plus"></i>Add New Attribute</a></li>
                @endcan
            </ul>
        </div>
    </div> 
</div>

<div class="section-body mt-4">
    <div class="container-fluid">
        <div class="tab-content">
            <div class="tab-pane active" id="Student-all">
                <div class="card mt-4">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover js-basic-example dataTable table-striped table_custom border-style spacing5">
                                <thead class="table-light">
                                    <tr>
                                        <th width="5%">#</th>
                                        <th>Name</th>
                                        <th>Slug</th>
                                        <th>Values</th>
                                        <th width="15%">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($attributes as $attribute)
                                    <tr>
                                        <td>{{ $loop->iteration + ($attributes->currentPage() - 1) * $attributes->perPage() }}</td>
                                        <td>{{ $attribute->name }}</td>
                                        <td><code>{{ $attribute->slug }}</code></td>
                                    
                                        <td>
                                            <a href="{{ route('filter-attribute-values.index', $attribute) }}" 
                                            class="badge badge-secondary">
                                                {{ $attribute->values_count }} values
                                            </a>
                                        </td>
                                        <td>
                                            <div class="d-flex">
                                                <a href="{{ route('filter-attributes.edit', $attribute) }}" 
                                                class="btn btn-sm btn-primary mr-2" title="Edit">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <a href="{{ route('filter-attribute-values.index', $attribute) }}" 
                                                class="btn btn-sm btn-info mr-2" title="Manage Values">
                                                    <i class="fa fa-list fa-xs"></i>
                                                </a>
                                                <form action="{{ route('filter-attributes.destroy', $attribute) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger" 
                                                            title="Delete" onclick="return confirm('Are you sure?')">
                                                        <i class="fa fa-trash-o"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="6" class="text-center">No filter attributes found</td>
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