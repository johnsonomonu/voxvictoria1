@if ($data)
    <div class="my-60">
        <div class="container">
            <div class="section-header left-style">
                <h5 class="title">{{ __($data->title) }}</h5>
            </div>
            <div class="offer-wrapper">
                @if ($data->banner)
                    @php
                        $customLinks = [
                            'Electric Generator' => 'https://www.voxvictoria.com.ng/products/electric-generators',
                            'Electric Motors' => 'https://www.voxvictoria.com.ng/products/motors',
                            'Pipes and fittings' => 'https://www.voxvictoria.com.ng/products/pipes-and-fitting',
                            'Toilet and Bathroom' => 'https://www.voxvictoria.com.ng/products/toilet-and-bathroom',
                            'Water heaters' => 'https://www.voxvictoria.com.ng/products/water-heater',
                            'Water Pumps' => 'https://www.voxvictoria.com.ng/products/water-pumps',
                            'Water Tanks' => 'https://www.voxvictoria.com.ng/products/waters-tanks',
                        ];
                        $bannerLink = $customLinks[$data->title] ?? 'https://www.voxvictoria.com.ng/';
                    @endphp
                    <div class="offer-banner @if($data->banner && $data->banner_position == 'right') order-1 @endif">
                        <a href="{{ $bannerLink }}">
                            <img class="w-100 rounded--5" src="{{ getImage(getFilePath('collection') . '/' . $data->banner, getFileSize('collection')) }}" alt="offer-banner">
                        </a>
                    </div>

                    <div class="product-slider-wrapper">
                        <div class="product-with-banner owl-carousel owl-theme">
                            @foreach ($data->products()->sortByDesc('id')->chunk(2) as $chunk)
                                <div class="offer-product">
                                    @foreach ($chunk as $product)
                                        <x-dynamic-component :component="frontendComponent('product-card')" :product="$product" :showRating="false" :showCartButton="false" />
                                    @endforeach
                                </div>
                            @endforeach
                        </div>
                    </div>
                @else
                    <div class="product-wrapper">
                        @foreach ($data->products() as $product)
                            <x-dynamic-component :component="frontendComponent('product-card')" :product="$product" />
                        @endforeach
                    </div>
                @endif

            </div>
        </div>
    </div>
@endif
