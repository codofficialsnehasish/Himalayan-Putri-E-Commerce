<div class="">
    <ul id="glasscase" class="gc-start">
        @php $product_images = $product->getMedia('products-media') @endphp
        @foreach($product_images as $image)
        <li>
            <img src="{{ $image->getUrl() }}" 
                 alt="{{ $product->name }}"  
                 data-gc-caption="Your caption text"
                 data-variation-id="{{ $image->custom_properties['variation_id'] ?? '' }}"
                 data-option-id="{{ $image->custom_properties['option_id'] ?? '' }}"
                 data-variation-name="{{ $image->custom_properties['variation_name'] ?? '' }}"
                 data-option-value="{{ $image->custom_properties['option_value'] ?? '' }}" />
        </li>
        @endforeach
    </ul>
</div>