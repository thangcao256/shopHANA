<div class="row isotope-grid">
    @if (count($products) == 0)
        <div class="p-b-35 isotope-item women" style="width: 100%">
            <!-- Block2 -->
            <div class="block2">
                <p style="font-size: 18px;font-style: italic;color: #e6e6e6;text-align: center;margin: 20px auto">
                    Chưa có sản phẩm liên quan !
                </p>
            </div>
        </div>
    @endif
    @foreach($products as $key => $product)
        <div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item women">
            <!-- Block2 -->
            <div class="block2">
                <div class="block2-pic hov-img0">
                    <img src="{{ $product->thumb }}" alt="{{ $product->name }}">
                </div>

                <div class="block2-txt flex-w flex-t p-t-14">
                    <div class="block2-txt-child1 flex-col-l ">
                        <a href="/san-pham/{{ $product->id }}-{{ Str::slug($product->name, '-') }}.html"
                           class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
                            {{ $product->name }}
                        </a>

                        <span class="stext-105 cl3">
							{!!  \App\Helpers\Helper::price($product->price, $product->price_sale)  !!}
                        </span>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
