<center style="background-color: #f1f1f1; padding: 2rem; font-family: sans-serif">
 <div style="max-width: 600px; margin: 0 auto;  background-color: #fff; padding: 2rem;" class="email-container">
<h1 style="color: 647345;">Kostenoverzicht Kussens.nu</h1>
<p>
    In onderstaand tabel zijn de door Kussens.nu gemaakte kosten opgesomd.
    Graag zien we deze kosten gecrediteerd.
</p>
<table align="center" style="padding: 16px; width:100%; border-spacing: 5px; margin: auto;" >

    <thead valign="top" style="padding-bottom: 16px; border-bottom: 1px solid #000000">
       <tr style="text-align: left;">
         <th scope="col">Datum</th>
         <th scope="col">Type</th>
          <th scope="col">Order</th>
         <th colspan="2">Omschrijving</th>
         <th scope="col">Kosten</th>
       </tr>
     </thead>
    @isset($errors)
        @foreach ($errors as $error)
        <tr style="text-align: left; ">
          <th>{{ date('d-m-Y', strtotime($error->created_at)) }}</th>
          <td>{{ $error->title }}</td>
          <td>{{ $error->order}}</td>
          <td colspan="2">{{ $error->description}}</td>
          <td>€ {{ $error->amount }}</td>

        </tr>

        @endforeach
    @endisset

</table>
</div>
</center>
