<div class="card shadow mt-4">
    <div class="card-body">
        <h5 class="card-title">Manage Filter Attributes</h5>
        
        <form action="{{ route('admin.categories.filter-attributes.update', $category) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group">
                        <label>Available Attributes</label>
                        <select id="availableAttributes" class="form-control" size="10">
                            @foreach($attributes as $attribute)
                                @unless($category->filterAttributes->contains($attribute))
                                <option value="{{ $attribute->id }}">
                                    {{ $attribute->name }}
                                </option>
                                @endunless
                            @endforeach
                        </select>
                    </div>
                    <button type="button" id="addAttributeBtn" class="btn btn-sm btn-primary">
                        <i class="fa fa-arrow-right"></i> Add to Category
                    </button>
                </div>
                
                <div class="col-md-7">
                    <div class="form-group">
                        <label>Assigned Attributes</label>
                        <div id="assignedAttributes">
                            @foreach($category->filterAttributes as $attribute)
                            <div class="attribute-item mb-2 p-2 border rounded" data-id="{{ $attribute->id }}">
                                <div class="d-flex justify-content-between">
                                    <span>
                                        {{ $attribute->name }}
                                    </span>
                                    <button type="button" class="btn btn-sm btn-danger remove-attribute">
                                        <i class="fa fa-times"></i>
                                    </button>
                                </div>
                                <input type="hidden" name="attributes[]" value="{{ $attribute->id }}">
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            
            <button type="submit" class="btn btn-primary mt-3">Save Changes</button>
        </form>
    </div>
</div>

@section('script')
<script>
$(document).ready(function() {
    // Add attribute to category
    $('#addAttributeBtn').click(function() {
        const selected = $('#availableAttributes option:selected');
        if (selected.length) {
            const id = selected.val();
            const name = selected.text();
            
            if (!$(`.attribute-item[data-id="${id}"]`).length) {
                $('#assignedAttributes').append(`
                    <div class="attribute-item mb-2 p-2 border rounded" data-id="${id}">
                        <div class="d-flex justify-content-between">
                            <span>${name.split(' (')[0]}</span>
                            <button type="button" class="btn btn-sm btn-danger remove-attribute">
                                <i class="fa fa-times"></i>
                            </button>
                        </div>
                        <input type="hidden" name="attributes[]" value="${id}">
                    </div>
                `);
                selected.remove();
            }
        }
    });
    
    // Remove attribute from category
    $(document).on('click', '.remove-attribute', function() {
        const item = $(this).closest('.attribute-item');
        const id = item.data('id');
        const text = item.find('span').text();
        const type = item.find('small').text().replace(/[()]/g, '');
        
        $('#availableAttributes').append(
            `<option value="${id}" data-type="${type.trim()}">${text}</option>`
        );
        item.remove();
    });
});
</script>
@endsection