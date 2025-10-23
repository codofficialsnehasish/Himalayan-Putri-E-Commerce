@extends('layouts.app')

@section('title','Products')

@section('content')

<div class="section-body">
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center">
            <div class="header-action">
                <h1 class="page-title">Products</h1>
                <ol class="breadcrumb page-breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('product.index') }}">Products</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit Video</li>
                </ol>
            </div>
            <ul class="nav nav-tabs page-header-tab">
                <li class="nav-item"><a class="btn btn-info" href="{{ route('product.index') }}"><i class="fa fa-arrow-left me-2"></i>Back</a></li>
            </ul>
        </div>
    </div>
</div>

<form action="{{ route('products.product-video-edit-process') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="section-body mt-4">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-9">
                    <div class="card">
                        <div class="card-body">
                            <!-- Nav tabs -->
                            @include('admin.products.nav-tabs-edit')
                            <input type="hidden" name="product_id" value="{{ request()->segment(4) }}">
                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane active p-3" id="inventory" role="tabpanel">
                                    <table width="100%" cellpadding="5" cellspacing="5" id="table_repeters">
                                        <tr>
                                            <th width="30%">Video Link</th>
                                            <th width="4%">Action</th>
                                        </tr>
                                        @foreach($product->video as $spec)
                                        <tr>
                                            <td>
                                                {!! $spec->video_link !!}
                                            </td>
                                            <td>
                                                <a  href="{{ route('products.product-video-delete-process',$spec->id) }}" onclick="return confirm('Are You sure?')" class="btn btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Remove this Item"><i class="fa fa-trash-o text-danger"></i></a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </table>

                                    <hr>

                                    <table width="100%" cellpadding="5" cellspacing="5" id="table_repeter">
                                        <tr>
                                            <th width="30%">Video Link</th>
                                            <th width="4%">&nbsp;</th>
                                        </tr>
                                        <tr>
                                            <td>
                                                <input type="text" name="video_link[]" id="title_1" class="form-control"/>
                                            </td>
                                        </tr>
                                    </table>
                                    <div  id="more1"><a class="btn btn-success btn-sm float-end" href="javascript:;" onClick="showMore_edit('field_1');"><i class="fa fa-plus"></i>Add More</a></div>
                                    <p>&nbsp;</p>
                                    <input type="hidden" name="cont" id="cont" value="1" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Save & Publish</h3>
                            {{-- <div class="card-options ">
                                <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                                <a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
                            </div> --}}
                        </div>
                        <div class="card-body">
                            <div class="mb-0">
                                <div>
                                    <button type="submit" class="btn btn-primary waves-effect waves-light me-1">
                                        Save & Next
                                    </button>
                                    <button type="reset" class="btn btn-secondary waves-effect">
                                        Cancel
                                    </button>
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
		function showMore_edit(id){
            var idd = id.split("_");
            var idty = parseInt(idd[1]);
            idty = idty + 1;
            var table = document.getElementById("table_repeter");

            var rowCount = table.rows.length;
            
            var row = table.insertRow(rowCount);
            // var cell0 = row.insertCell(0);
            // var rowCount = table.rows.length;
            var row = table.insertRow(rowCount);
            var cell1 = row.insertCell(0);
            var cell2 = row.insertCell(1);
            document.getElementById("cont").value = idty;
            
            cell1.innerHTML = '<input type="text" name="video_link[]" id="title_'+idty+'" class="form-control"/>';
                 
            cell2.innerHTML = "<a  href=\"javascript:;\" class=\"btn btn-sm\" data-bs-toggle=\"tooltip\" data-bs-placement=\"top\" title=\"Remove this Item\" onClick=\"deleteRow(this)\"><i class=\"fa fa-trash-o text-danger\"></i></a>";

				  
			document.getElementById("more1").innerHTML = "<a class=\"btn btn-success btn-sm float-end\" href=\"javascript:;\" onClick=\"showMore_edit('field_" + idty + "');\"><i class=\"fa fa-plus\"></i>Add More</a>";
                
                
        }

        function deleteRow(btn) {
            if (confirm("Are You Sure?") == true) {
                var row = btn.parentNode.parentNode;
                row.parentNode.removeChild(row);
            } else { }
		}
    </script>

@endsection