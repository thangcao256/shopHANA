@extends('main')

@section('content')
    <form class="bg0 p-t-130 p-b-85" method="post">
        @include('admin.alert')

        @if (count($products) != 0)
            <div class="container">
                <div class="row">
                    <div class="container" style="margin-bottom:40px">
                        <img src="/template/images/icons/herschel-supply-1657350625.png">
                    </div>
                    <div class="col-lg-10 col-xl-7 m-lr-auto m-b-50">
                        <div class="m-l-25 m-r--38 m-lr-0-xl">
                            <div class="wrap-table-shopping-cart">
                                @php $total = 0; @endphp
                                <table class="table-shopping-cart">
                                    <tbody>
                                    <tr class="table_head">
                                        <th class="column-1">SẢN PHẨM</th>
                                        <th class="column-2"></th>
                                        <th class="column-3">GIÁ</th>
                                        <th class="column-4">SỐ LƯỢNG</th>
                                        <th class="column-5">TỔNG CỘNG</th>
                                        <th class="column-6">&nbsp;</th>
                                    </tr>

                                    @foreach($products as $key => $product)
                                        @php
                                            $price = $product->price_sale != 0 ? $product->price_sale : $product->price;
                                            $priceEnd = $price * $carts[$product->id];
                                            $total += $priceEnd;
                                        @endphp
                                        <tr class="table_row">
                                            <td class="column-1">
                                                <div class="how-itemcart1">
                                                    <img src="{{ $product->thumb }}" alt="IMG">
                                                </div>
                                            </td>
                                            <td class="column-2">{{ $product->name }}</td>
                                            <td class="column-3">{{ number_format($price, 0, '', '.') }}</td>
                                            <td class="column-4">
                                                <div class="wrap-num-product flex-w m-l-auto m-r-0">
                                                    <div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
                                                        <i class="fs-16 zmdi zmdi-minus"></i>
                                                    </div>

                                                    <input class="mtext-104 cl3 txt-center num-product" type="number" min="1"
                                                           name="num_product[{{ $product->id }}]" value="{{ $carts[$product->id] }}">

                                                    <div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
                                                        <i class="fs-16 zmdi zmdi-plus"></i>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="column-5">{{ number_format($priceEnd, 0, '', '.') }}</td>
                                            <td class="p-r-15">
                                                <a href="/carts/delete/{{ $product->id }}">Xóa</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <div class="flex-w flex-sb-m bor15 p-t-18 p-b-15 p-lr-40 p-lr-15-sm">
                                <div class="flex-w flex-m m-r-20 m-tb-5">
                                    <input class="stext-104 cl2 plh4 size-117 bor13 p-lr-20 m-r-10 m-tb-5" type="text"
                                           name="coupon" placeholder="Mã Voucher">

                                    <div
                                        class="flex-c-m stext-101 cl2 size-118 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-5">
                                        Áp dụng
                                    </div>
                                </div>

                                <input type="submit" value="Cập nhật" formaction="/update-cart"
                                    class="flex-c-m stext-101 cl2 size-119 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-10">
                                @csrf
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-10 col-lg-7 col-xl-5 m-lr-auto m-b-50">
                        <div class="bor10 p-lr-40 p-t-30 p-b-40 m-l-63 m-r-40 m-lr-0-xl p-lr-15-sm">
                            <h4 class="mtext-109 cl2 p-b-30">
                                Tổng giỏ hàng
                            </h4>

                            <div class="flex-w flex-t p-t-27 p-b-33">
                                <div class="size-208">
                                    <span class="mtext-101 cl2">
                                        Tổng:
                                    </span>
                                </div>

                                <div class="size-209 p-t-1">
                                    <span class="mtext-110 cl2">
                                        {{ number_format($total, 0, '', '.') }}
                                    </span>
                                </div>
                            </div>

                            <div class="flex-w flex-t bor12 p-t-15 p-b-30">

                                <div class="size-100 p-r-18 p-r-0-sm w-full-ssm">

                                    <div class="p-t-15">
                                        <span class="stext-112 cl8">
                                            Thông Tin Khách Hàng
                                        </span>

                                        <div class="bor8 bg0 m-b-12">
                                            <input class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="name" placeholder="Tên khách Hàng" required>
                                        </div>

                                        <div class="bor8 bg0 m-b-12">
                                            <input class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="phone" placeholder="Số Điện Thoại" required>
                                        </div>

                                        <div class="bor8 bg0 m-b-12">
                                            <input class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="address" placeholder="Địa Chỉ Giao Hàng">
                                        </div>

                                        <div class="bor8 bg0 m-b-12">
                                            <input class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="email" placeholder="Email Liên Hệ">
                                        </div>

                                        <div class="bor8 bg0 m-b-12">
                                            <textarea class="cl8 plh3 size-111 p-lr-15" name="content"></textarea>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <button class=" stext-101 cl0 size-116 bor14 hov-btn3 p-lr-15 trans-04 pointer" onclick="history.back()" style="background-color: #e6e6e6;color: black">
                                    Tiếp tục mua hàng
                                </button>
                                <button class=" stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer m-t-40">
                                    Đặt Hàng
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </form>
    @else
        <style>
            form {
                padding-bottom: 0px !important;
            }
        </style>
        <div class="container">
            <div class="row m-40">
                <div class="container" style="margin-bottom:40px">
                    <img src="/template/images/icons/herschel-supply-1657350625.png" style="width:100%">
                </div>
                <div class="col-lg-10 col-xl-7 m-lr-auto m-b-50">
                    <div class="m-l-25 m-r--38 m-lr-0-xl">
                        <div class="text-center" style="margin-bottom: 300px">
                            <p style="font-size: 18px;font-style: italic;color: #000;text-align: center;margin: 20px auto">
                                Giỏ hàng trống !
                            </p>
                            <img src="/template/images/icons/empty-cart.png" style="width: 120px; margin-bottom: 40px">
                            <a href="/" class="flex-c-m stext-101 cl2 size-101 bor1 hov-btn1 p-lr-15 trans-04" style="background-color:
                                    #e6e6e6; margin: 20px auto; width: 200px;">
                                Đi đến trang chủ
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection