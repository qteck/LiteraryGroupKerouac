@extends('/admin/layout') 

@section('content_admin')
  <h1>Orders</h1>

  <table class="table table-striped">
    <thead>
      <tr>
        <th>Forename</th>
        <th>Surname</th>
        <th>Phone</th>
        <th>Email</th>
        <th>Item</th>
        <th>Price</th>
        <th>Total</th>
        <th>Quantity</th>
        <th>Currency</th>
        <th>Address</th>
        <th>Status</th>
        <th>Date</th>
      </tr>
    </thead>
    <tbody>
     @foreach($orders as $order)
      <tr>
        <td>{{ $order->forename }}</td>
        <td>{{ $order->surname }}</td>
        <td>{{ $order->phone	}}</td>
        <td>{{ $order->email }}</td>
        <td>{{ $order->orderedItem_id }}</td>
        <td>{{ $order->price }}</td>
        <td>{{ $order->totalPrice }}</td>
        <td>{{ $order->quantity }}</td>
        <td>{{ $order->currency }}</td>
        <td>{{ $order->address }}</td>
        <td>{{ $order->status }}</td>
        <td>{{ $order->created_at }}</td>
      </tr>
      @endforeach

    </tbody>
  </table>


@endsection