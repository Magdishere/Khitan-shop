<div>
    <div class="container-fluid">
        <!-- Title -->
        <div class="d-flex justify-content-between align-items-center py-3">
            <h2 class="h5 mb-0"><a href="#" class="text-muted"></a> Order #{{ $order->id }}</h2>
        </div>

        <!-- Main content -->
        <div class="row">
            <!-- Display order details -->
            <div class="col-lg-8">
                <!-- Loop through order items -->
                @foreach($order->orderItems as $item)
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="mb-3 d-flex justify-content-between">
                            <div>
                                <span class="me-3">{{ $order->created_at->format('d-m-Y') }}</span>
                                <span class="me-3">#{{ $order->id }}</span>
                                <!-- Additional order details here -->
                            </div>
                            <!-- Additional actions here -->
                        </div>
                        <table class="table table-borderless">
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="d-flex mb-2">
                                            <div class="flex-shrink-0">
                                                {{-- <img src="{{ $item->product->image_url }}" alt="{{ $item->product->name }}" width="35" class="img-fluid"> --}}
                                            </div>
                                            <div class="flex-lg-grow-1 ms-3">
                                                <h6 class="small mb-0"><a href="#" class="text-reset">{{ $item->slug }}</a></h6>
                                                <span class="small">Color: {{ $item->color }}</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $item->quantity }}</td>
                                    <td class="text-end">${{ number_format($item->price, 2) }}</td>
                                </tr>
                                <!-- Additional item details here -->
                            </tbody>
                        </table>
                    </div>
                </div>
                @endforeach
                <!-- Additional sections for payment, billing address, etc. here -->
            </div>
            <!-- Display customer notes, shipping information, etc. here -->
        </div>
    </div>
</div>
