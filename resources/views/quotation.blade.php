@extends('layouts.app')
@section('content')
<div class="container page-quotation">
    <div class="row">
        <div class="reciever">
            <form class="" action="index.html" method="post">
                <h3>Ontvanger</h3>

                <fieldset class="company">
                    <label for="company">Bedrijfsnaam</label>
                    <input type="text" name="company" value="">
                </fieldset>

                <fieldset class="name">
                    <label for="name">Naam</label>
                    <input type="text" name="name" value="">

                    <label for="lastname">Achternaam</label>
                    <input type="text" name="lastname" value="">
                </fieldset>

                <fieldset class="contact">
                    <label for="tel">Telefoonnummer</label>
                    <input type="tel" name="tel" value="">

                    <label for="email">Email</label>
                    <input type="email" name="email" value="">
                </fieldset>

                <fieldset class="address">
                    <label for="postalcode">Postcode</label>
                    <input type="text" name="postalcode" value="">

                    <label for="housenumber">Huisnummer</label>
                    <input type="text" name="housenumber" value="">

                    <label for="city">Woonplaats</label>
                    <input type="text" name="city" value="">
                </fieldset>


            </form>
        </div>
        <div class="add__products">

        </div>
    </div>
</div>
@endsection
