<div class="brands">
    <div class="container">
        <div class="wrapper flexitem">
            @foreach (App\Models\Brand::where('Status', 'active')->latest()->inRandomOrder()->limit(5)->get() as $brand)
                <div class="item">
                    <a href="{{ $brand->link }}">
                        <img src="{{ asset('images/' . $brand->image) }}" alt="">
                    </a>
                </div>
            @endforeach

        </div>
    </div>
</div>
