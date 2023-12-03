<div class="row">
    <div class="col-lg-10 mx-auto">
        <div class="cart__table">
            <table class="cart__table--inner">
                <thead class="cart__table--header">
                    <tr class="cart__table--header__items">
                        <th class="cart__table--header__list">{{ translate('Product')}}</th>
                        <th class="cart__table--header__list">{{ translate('Price')}}</th>
                        <th class="cart__table--header__list">{{ translate('Qty')}}</th>
                        <th class="cart__table--header__list">{{ translate('Tax')}}</th>
                        <th class="cart__table--header__list">{{ translate('Total')}}</th>
                        <!--<th class="cart__table--header__list">{{ translate('Remove')}}</th>-->
                    </tr>
                </thead>
                <tbody class="cart__table--body">
                    @php
                        $total = 0;
                    @endphp

                    @if( $carts && count($carts) > 0 )

                        @foreach ($carts as $key => $cartItem)

                            @php
                                $product = get_single_product($cartItem['product_id']);
                                $product_stock = $product->stocks->where('variant', $cartItem['variation'])->first();
                                // $total = $total + ($cartItem['price']  + $cartItem['tax']) * $cartItem['quantity'];
                                $total = $total + cart_product_price($cartItem, $product, false) * $cartItem['quantity'];
                                $product_name_with_choice = $product->getTranslation('name');
                                if ($cartItem['variation'] != null) {
                                    $product_name_with_choice = $product->getTranslation('name').' - '.$cartItem['variation'];
                                }
                            @endphp

                    <tr class="cart__table--body__items">
                        <td class="cart__table--body__list">
                            <div class="cart__product d-flex align-items-center">
                                <a href="javascript:void(0)" onclick="removeFromCartView(event, {{ $cartItem['id'] }})" class="cart__remove--btn">
                                    <svg fill="currentColor" xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 24 24" width="16px" height="16px"><path d="M 4.7070312 3.2929688 L 3.2929688 4.7070312 L 10.585938 12 L 3.2929688 19.292969 L 4.7070312 20.707031 L 12 13.414062 L 19.292969 20.707031 L 20.707031 19.292969 L 13.414062 12 L 20.707031 4.7070312 L 19.292969 3.2929688 L 12 10.585938 L 4.7070312 3.2929688 z"/></svg>
                                </a>

                                <div class="cart__thumbnail">
                                    <a href="product-details.html">
                                        <img src="{{ uploaded_asset($product->thumbnail_img) }}"
                                             class="border-radius-5"
                                             alt="{{ $product->getTranslation('name')  }}"
                                             onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';" />
                                    </a>
                                </div>
                                <div class="cart__content">
                                    <h4 class="cart__content--title"><a href="product-details.html">{{ $product_name_with_choice }}</a></h4>
                                    <span class="cart__content--variant">COLOR: Blue</span>
                                    <span class="cart__content--variant">WEIGHT: 2 Kg</span>
                                </div>
                            </div>
                        </td>
                        <td class="cart__table--body__list">
                            <span class="cart__price">{{ cart_product_price($cartItem, $product, true, false) }}</span>
                        </td>
                        <td class="cart__table--body__list">

                                    @if ($cartItem['digital'] != 1 && $product->auction_product == 0)
                            <div class="quantity__boxst aiz-plus-minus quantity__box">
                                <button
                                    class="quantity__value quickview__value--quantity decrease"
                                    type="button" data-type="minus"
                                    data-field="quantity[{{ $cartItem['id'] }}]">
                                    -
                                </button>
                                <!--<label>-->
                                    <input type="number" class="quantity__number quickview__value--number quantity__number quickview__value--number" 
                                           name="quantity[{{ $cartItem['id'] }}]"
                                           placeholder="1" value="{{ $cartItem['quantity'] }}"
                                           min="{{ $product->min_qty }}"
                                           max="{{ $product_stock->qty }}"
                                           onchange="updateQuantity({{ $cartItem['id'] }}, this)"
                                           />
                                <!--</label>-->
                                <button
                                    class="quantity__value quickview__value--quantity increase "
                                    type="button" data-type="plus"
                                    data-field="quantity[{{ $cartItem['id'] }}]">
                                    +
                                </button>
                            </div>
                                    @elseif($product->auction_product == 1)
                            <span class="fw-700 fs-14">1</span>
                                    @endif



                        </td>
                        <td class="cart__table--body__list">
                            <span class="cart__price">{{ cart_product_tax($cartItem, $product) }}</span>
                        </td>
                        <td class="cart__table--body__list">
                            <span class="cart__price end">{{ single_price(cart_product_price($cartItem, $product, false) * $cartItem['quantity']) }}</span>
                        </td>
                    </tr>

                        @endforeach
                    @else
                    <tr class="cart__table--body__items">
                        <td class="cart__table--body__list" colspan="5">
                            {{translate('Your Cart is empty')}}
                        </td>
                    </tr>
                    @endif



                </tbody>
            </table> 
            <div class="continue__shopping d-flex justify-content-between">
                <div class="col-lg-12">
        <div class="cart__summary border-radius-10">


            <div class="cart__summary--total mb-20">
                <table class="cart__summary--total__table">
                    <tbody>
                        <tr class="cart__summary--total__list">
                            <td class="cart__summary--total__title text-left">{{translate('Subtotal')}}</td>
                            <td class="cart__summary--amount text-right">{{ single_price($total) }}</td>
                        </tr>
                        <!--                        <tr class="cart__summary--total__list">
                                                    <td class="cart__summary--total__title text-left">GRAND TOTAL</td>
                                                    <td class="cart__summary--amount text-right">$860.00</td>
                                                </tr>-->
                    </tbody>
                </table>
            </div>
            <div class="cart__summary--footer">
                <p class="cart__summary--footer__desc">Shipping & taxes calculated at checkout</p>
                <ul class="d-flex justify-content-between">
                    <li><a class="cart__summary--footer__btn primary__btn cart" href="{{ route('home') }}">{{ translate('Return to shop')}}</a></li>
                    <li>
                        @if(Auth::check())
                        <a href="{{ route('checkout.shipping_info') }}" class="cart__summary--footer__btn primary__btn checkout">
                                        {{ translate('Continue to Shipping')}}
                        </a>
                        @else
                        <button class="cart__summary--footer__btn primary__btn cart" onclick="showLoginModal()">{{ translate('Continue to Shipping')}}</button>
                        @endif

                    </li>
                </ul>
            </div>
        </div> 
    </div>
            </div>



        </div>
    </div>
    
</div> 

<script type="text/javascript">
    AIZ.extra.plusMinus();
</script>
