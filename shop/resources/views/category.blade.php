@extends('main')

@section('content')
    <style>
        .content p {
            text-align: justify;
            line-height: 2;
        }
    </style>
    @php $menusHtml = \App\Helpers\Helper::category($menus); @endphp
    <div class="bg0 m-t-23 p-b-140 p-t-80">
        <div class="container" style="margin-bottom:40px; margin-top: 40px">
            <img src="/template/images/icons/herschel-supply-1657350625.png" style="width:100%">
        </div>
        <div class="container">
            <div class="flex-w flex-sb-m p-b-52">
                <div class="flex-w flex-c-m m-tb-10" style="width: 80%;">
                    <ul class="main-menu" style="list-style-type: none;padding: 0;display: contents">
                        {!! $menusHtml !!}
                    </ul>
                </div>
                <div class="flex-w flex-c-m m-tb-10" style="width: 20%">
                    <div class="flex-c-m stext-106 cl6 size-105 bor4 pointer hov-btn3 trans-04 m-tb-4 js-show-search">
                        <i class="icon-search cl2 m-r-6 fs-15 trans-04 zmdi zmdi-search"></i>
                        <i class="icon-close-search cl2 m-r-6 fs-15 trans-04 zmdi zmdi-close dis-none"></i>
                        Search
                    </div>
                </div>

                <!-- Search product -->
                <div class="dis-none panel-search w-full p-t-10 p-b-15">
                    <div class="bor8 dis-flex p-l-15">
                        <button class="size-113 flex-c-m fs-16 cl2 hov-cl1 trans-04">
                            <i class="zmdi zmdi-search"></i>
                        </button>

                        <input class="mtext-107 cl2 size-114 plh2 p-r-15" type="text" name="search-product" placeholder="Search">
                    </div>
                </div>
            </div>



            <h4 style="margin: 0px auto 20px;font-style: italic;">Một số mẫu {{ $menu->name }} nổi bật</h4>

            <div id="loadProduct">
                @include('products.list')
            </div>
            <div class="content">
                <p >{{ $menu->description }}</p>

                <p>{!! $menu->content !!}</p>
            </div>

        </div>
    </div>
@endsection
