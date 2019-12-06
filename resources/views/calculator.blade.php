@extends('layouts.app')

@section('content')
<div class="container page__calculator">
    <div class="row">

        <div class="calculator">

            <form class="" action="/get-price" method="post">
                @csrf
                <div class="products">
                    <label for="">Type</label>
                    <select class="" name="products">
                        @foreach ( $products as $product )
                            <option value="{{ $product['uid'] }}"> {{ $product['name'] }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="meassures">
                    <label for="">Lengte</label>
                    <input class="length" type="number" name="length" value="">

                    <label for="">Diepte/Hoogte</label>
                    <input type="number" name="depth" value="">

                    <label for="">Dikte</label>
                    <input type="number" name="thickness" value="">
                </div>

                <div class="fabrics">
                    <select class="" name="fabrics">
                        @foreach ( $fabrics as $fabric )
                            <option value="{{ $fabric['price'] }}"> {{ $fabric['name'] }}</option>
                        @endforeach
                    </select>


                </div>

                <div class="fillings">
                    <select class="" name="fillings">
                        @foreach ( $fillings as $filling )
                            <option value="{{ $filling['price'] }}"> {{ $filling['name'] }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="finishes">
                    <select class="" name="finishes">
                        @foreach ( $finishes as $finish )
                            <option value="{{ $finish['name'] }}"> {{ $finish['name'] }}</option>
                        @endforeach
                    </select>
                </div>

                <input class="calculate" type="submit" name="" value="Calculate">
            </form>


        </div>

        <div class="results">
            <div class="title">
                <h2>Kosten splitsing</h2>
            </div>
            <div class="fabric__price">
                <label for="">Stof: €<span></span> </label>
            </div>
            <div class="filling__price">
                <label for="">Vulling :€ <span></span> </label>
            </div>
            <div class="finish__price">
                <label for="">Afwerking : €<span></span> </label>
            </div>
            <div class="totals">
                <div class="">
                    <label for="">Inkoop: (ex) € <span class="buy"></span> </label>
                </div>
                <div class="">
                    <label for="">Verkoop (ex) € <span class="sell"></span> </label>
                </div>
                <div class="">
                    <label for="">btw: € <span class="btw"></span> </label>
                </div>
                <div class="">
                    <label for="">incl btw: € <span class="incl"></span> </label>
                </div>
            </div>
            <div class="pillows">

            </div>
        </div>
    </div>
</div>
@endsection
