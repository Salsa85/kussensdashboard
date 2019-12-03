@extends('layouts.app')

@section('content')
<div class="container-fluid page-errors">
    <div class="row">
        <div class="error__form">
            <div class="form__wrapper">
                <form class="" action="/add-error" method="post">
                    @csrf
                    <label for="title">Fout type</label>
                    <select class="" name="title" required>
                        <option value="Productie fout">Productie </option>
                        <option value="Verzend fout">Verzending </option>
                        <option value="Administratie fout">Administratie </option>
                    </select>
                    <label for="order">Ordernummer</label>
                    <input type="text" name="order" value="" required>
                    <label for="description">Fout omschrijving</label>
                    <textarea name="description" rows="8" cols="80" required></textarea>
                    <label for="amount">Kosten</label required>
                    <input type="text" name="amount" value="" placeholder="0.00" required>
                    <input type="submit" name="" value="Toevoegen">
                </form>

                <div class="alert alert-primary">
                    <span>Totaal inbare kosten: € {{$totals}}</span>
                </div>
            </div>
        </div>
        <div class="errors">

            <form class="" action="/update" method="post">
            @csrf
            <div class="row">

                <table class="table table-striped">

                    <thead>
                       <tr>
                         <th scope="col">Datum</th>
                         <th scope="col">Type</th>
                          <th scope="col">Order</th>
                         <th scope="col">Omschrijving</th>
                         <th scope="col">Kosten</th>
                         <th scope="col">Betaald</th>
                       </tr>
                     </thead>

                @isset($errors)
                    @foreach ($errors as $error)

                    <tr class="error" data-id="{{ $error->id }}">
                      <th scope="row">{{ date('d-m-Y', strtotime($error->created_at)) }}</th>
                      <td>{{ $error->title }}</td>
                       <td>{{ $error->order}}</td>
                      <td>{{ $error->description}}</td>
                      <td>€ {{ $error->amount }}</td>
                      <td> <input class="paid" type="checkbox" name="paid" value="1" {{ $error->paid === 1 ? 'checked' : '' }}> </td>
                    </tr>

                    @endforeach
                @endisset

            </table>
            <div class="links">
                {{ $errors->links() }}
            </div>
            </div>
            </form>
        </div>
    </div>
</div>


@endsection
