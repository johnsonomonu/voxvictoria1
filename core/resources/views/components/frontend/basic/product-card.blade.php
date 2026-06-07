@props([
    'product' => $product,
    'wishlist' => null,
    'showRating' => true,
    'showTitle' => true,
    'showCartButton' => true,
])

@php
    $addedInCompareList = checkCompareList($product->id);
@endphp

<div class="product-card" style="position: relative;">

    @if (Route::is('wishlist.page'))
        <button class="active removeWishlist wishlist-product-remove-btn"
            data-page="1"
            data-id="{{ $wishlist->id }}"
            data-pid="{{ $product->id }}"
            style="z-index: 5;">
            <i class="las la-trash"></i>
        </button>
    @endif

    <div class="product-thumb" style="position: relative;">
        <ul class="product-card-buttons" style="z-index: 5;">
            @if (gs('product_wishlist') && !Route::is('wishlist.page'))
                <li class="product-wishlist-btn">
                    <button type="button"
                        @class(['addToWishlist', 'active' => checkWishList($product->id)])
                        data-id="{{ $product->id }}">
                        <i class="lar la-heart"></i>
                    </button>
                </li>
            @endif

            @if ($product->product_type_id && gs('product_compare'))
                <li class="product-compare-btn">
                    <button type="button"
                        class="addToCompare {{ $addedInCompareList ? 'active' : '' }}"
                        data-id="{{ $product->id }}">
                        <i class="las la-exchange-alt"></i>
                    </button>
                </li>
            @endif
        </ul>

        <img src="{{ getImage(null) }}"
             class="lazyload"
             data-src="{{ $product->mainImage() }}"
             alt="flash">
    </div>

    <div class="product-content" style="position: relative;">
        <div class="product-before-content" style="position: relative; z-index: 2;">
            @if ($showTitle)
                <h6 class="title">
                    {{ strLimit(__($product->name), 40) }}
                </h6>
            @endif

            <div class="single_content__info">
                <div class="price">
                    {!! $product->formattedPrice() !!}
                </div>

                @if ($showRating && gs('product_review'))
                    <div class="ratings-area">
                        {!! displayRating($product->reviews_avg_rating) !!}
                        <span class="rating-count">
                            ({{ $product->reviews_count ?? 0 }})
                        </span>
                    </div>
                @endif
            </div>

            @if ($product->summary)
                <div class="single_content">
                    <p>{{ __($product->summary) }}</p>
                </div>
            @endif
        </div>

        @if ($showCartButton)
            <div style="position: relative; z-index: 5;">
                @if ($product->productVariants->count())
                    <button class="quickViewBtn add-to-cart-btn"
                        data-product="{{ $product->slug }}">
                        <i class="las la-shopping-bag"></i> @lang('Add to Cart')
                    </button>
                @else
                    <input type="hidden" name="quantity" value="1">
                    <button type="button"
                        class="addToCart add-to-cart-btn"
                        data-id="{{ $product->id }}"
                        data-product_type="{{ $product->product_type }}">
                        <i class="las la-shopping-bag"></i> @lang('Add to Cart')
                    </button>
                @endif
            </div>
        @endif
    </div>


    <a href="{{ $product->link() }}"
       style="position:absolute; top:0; left:0; width:100%; height:100%; z-index:1;">
    </a>

</div>
