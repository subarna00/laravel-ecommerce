 <?php
 $products = App\Models\Product::where(['status' => 'active', 'types' => 'Trending'])
     ->latest()
     ->inRandomOrder()
     ->take(12)
     ->get();
 ?>
 @if (count($products) > 0)
     <div class="trending">
         <div class="container">
             <div class="wrapper">
                 <div class="sectop flexitem">
                     <h2><span class="circle"></span><span>Trending Products</span></h2>
                 </div>
                 <div class="" style="display: flex;flex-wrap:wrap;gap:50px">
                     @foreach ($products as $product)
                         <div class="row products mini"
                             style="    display: flex;
                                         flex-wrap: wrap;
                                         gap: 50px;flex:1">
                             <div class="item" style="max-width: 350px">
                                 <div class="media">
                                     <div class="thumbnail object-cover">
                                         <a href="{{ route('productDetailPage', $product->slug) }}">
                                             <img src="{{ showImage($product->images[0]['image'] ?? null) }} "
                                                 alt="">
                                         </a>
                                     </div>
                                     <div class="hoverable">
                                         <ul>
                                             <li><a href="#"><i class="ri-eye-line"></i></a></li>
                                         </ul>
                                     </div>
                                     @if ($product->discount !== null)
                                         <div class="discount circle flexcenter"><span>{{ $product->discount }}%</span>
                                         </div>
                                     @endif
                                 </div>
                                 <div class="content">

                                     <h3 class="main-links"><a
                                             href="{{ route('productDetailPage', $product->slug) }}">{{ $product->name }}

                                         </a></h3>


                                     <div class="rating">

                                         @for ($i = 0; $i < $product->rating; $i++)
                                             <i class="ri-star-fill" style="color: orange"></i>
                                         @endfor
                                     </div>
                                     <div class="price">
                                         @if ($product->discount !== null)
                                             <span class="current">Rs.
                                                 {{ getDiscountPrice($product->price, $product->discount) }}</span>
                                             <br>
                                             <span class="normal mini-text">Rs. {{ $product->price }}</span>
                                         @else
                                             <span class="current">Rs. {{ $product->price }}</span>
                                         @endif
                                     </div>
                                     <div class="mini-text">
                                     </div>
                                 </div>
                             </div>

                         </div>
                     @endforeach
                 </div>
             </div>
         </div>
     </div>
 @endif
