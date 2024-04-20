<!-- Modal -->
<div class="modal fade" id="edit{{ $order->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Order</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('admin-orders.update', $order->id) }}" method="post" enctype="multipart/form-data">
                {{ method_field('patch') }}
                {{ csrf_field() }}
                @csrf
                <div class="modal-body">
                    <label for="exampleInputPassword1">Order Status</label>
                    <select name="status" class="form-control SlectBox">
                        <option value="ordered" @if($order->status == 'ordered') selected @endif>Ordered</option>
                        <option value="delivered" @if($order->status == 'delivered') selected @endif>Delivered</option>
                        <option value="canceled" @if($order->status == 'canceled') selected @endif>Canceled</option>
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
