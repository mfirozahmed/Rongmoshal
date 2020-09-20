<thead>
    <tr>
        <th></th>
        <th>date</th>
        <th>name</th>
        <th>email</th>
        <th>delivery status</th>
        <th>payment status</th>
        <th>price</th>
        <th></th>
    </tr>
</thead>
<tbody>
    @if (count($required_orders) > 0)
    @foreach ($required_orders as $todays_order)
    <tr class="tr-shadow">
        <td> {{ $todays_order->id }} </td>
        <td>{{ $todays_order->created_at }}</td>
        <td> {{ $todays_order->user->name }} </td>
        <td>
            <span class="block-email">{{ $todays_order->user->email }}</span>
        </td>
        @if ($todays_order->delivery_status == 0)
        <td>
            <span class="status--denied">Not Delivered</span>
        </td>
        @else
        <td>
            <span class="status--process">Delivered</span>
        </td>
        @endif
        @if ($todays_order->payment_status == 0)
        <td>
            <span class="status--denied">Not Paid</span>
        </td>
        @else
        <td>
            <span class="status--process">Paid</span>
        </td>
        @endif
        <td>&#x9f3; {{ $todays_order->price }}</td>
        <td>
            <div class="table-data-feature">
                <button class="item" data-toggle="tooltip" data-placement="top" title="Send">
                    <i class="zmdi zmdi-mail-send"></i>
                </button>
                <button class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                    <i class="zmdi zmdi-edit"></i>
                </button>
                <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                    <i class="zmdi zmdi-delete"></i>
                </button>
                <button class="item" data-toggle="tooltip" data-placement="top" title="More">
                    <i class="zmdi zmdi-more"></i>
                </button>
            </div>
        </td>
    </tr>
    <tr class="spacer"></tr>
    @endforeach
    @else
    <tr class="tr-shadow">
        <td></td>
        <td></td>
        <td>
            <span class="block-email"></span>
        </td>
        <td>
            <h3>There is no order today!</h3>
        </td>
        <td>
            <span class="status--denied"></span>
        </td>
        <td>
            <span class="status--process"></span>
        </td>
        <td></td>
        <td></td>
    </tr>
    <tr class="spacer"></tr>
    @endif

</tbody>