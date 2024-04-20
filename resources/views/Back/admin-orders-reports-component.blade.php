<style>
    nav svg{
        height: 20px;
    }
    nav .hidden{
        display: block;
    }
    th{
        color: hsl(330, 80%, 61%) !important;
    }
    .edit-link{
        color: hsl(330, 81%, 29%) !important;

    }
</style>

<div>
    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="/" rel="nofollow">Home</a>
                    <span></span> Orders Reports
                </div>
            </div>
        </div>

    <section class="mt-50 mb-50">
            <div class="container">
                <div class="row">
                        <div class="cards mg-b-20">
                            <div class="card-header pb-0">
                                <form action="/Search_orders" method="POST" role="search" autocomplete="off">
                                    {{ csrf_field() }}

                                    <div class="col-lg-3">
                                        <label class="rdiobox">
                                            <input checked name="rdio" type="radio" value="1" id="type_div"> <span>Search By Country</span></label>
                                    </div>

                                    <div class="col-lg-3 mg-t-20 mg-lg-t-0">
                                        <label class="rdiobox"><input name="rdio" value="2" type="radio"><span> Search By User
                                            </span></label>
                                    </div><br><br>

                                    <div class="row">

                                        <div class="col-lg-3 mg-t-20 mg-lg-t-0" id="type">
                                            <p class="mg-b-10">Select Order Country</p><select class="form-control select2" name="type"
                                                required>
                                                <option value="{{ $type ?? 'Select Country' }}" selected>
                                                    {{ $type ?? 'Select Country' }}
                                                </option>
                                                <option value="Paid">Paid Bills</option>
                                                <option value="Unpaid">Unpaid Bills</option>
                                                <option value="Partially Paid">Partially Paid Bills</option>

                                            </select>
                                        </div><!-- col-4 -->


                                        <div class="col-lg-3 mg-t-20 mg-lg-t-0" id="order_number">
                                            <p class="mg-b-10">Search By User</p>
                                            <input type="text" class="form-control" id="order_number" name="order_number">

                                        </div><!-- col-4 -->

                                        <div class="col-lg-3" id="start_at">
                                            <label for="exampleFormControlSelect1">From</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i class="fas fa-calendar-alt"></i>
                                                    </div>
                                                </div><input class="form-control fc-datepicker" value="{{ $start_at ?? '' }}"
                                                    name="start_at" placeholder="YYYY-MM-DD" type="text">
                                            </div><!-- input-group -->
                                        </div>

                                        <div class="col-lg-3" id="end_at">
                                            <label for="exampleFormControlSelect1">To</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i class="fas fa-calendar-alt"></i>
                                                    </div>
                                                </div><input class="form-control fc-datepicker" name="end_at"
                                                    value="{{ $end_at ?? '' }}" placeholder="YYYY-MM-DD" type="text">
                                            </div><!-- input-group -->
                                        </div>
                                    </div><br>

                                    <div class="row">
                                        <div class="col-sm-1 col-md-1">
                                            <button class="btn btn-success btn-sm">Search</button>
                                        </div>
                                    </div>
                                </form>

                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    @if (isset($details))
                                        <table id="example" class="table key-buttons text-md-nowrap" style=" text-align: center">
                                            <thead>
                                                <tr>
                                                    <th class="py-3 px-6 text-left font-bold text-center ">#</th>
                                                    <th class="py-3 px-6 text-left font-bold text-center ">Name</th>
                                                    <th class="py-3 px-6 text-left font-bold text-center ">Email</th>
                                                    <th class="py-3 px-6 text-left font-bold text-center ">Mobile</th>
                                                    <th class="py-3 px-6 text-left font-bold text-center ">City</th>
                                                    <th class="py-3 px-6 text-left font-bold text-center ">Country</th>
                                                    <th class="py-3 px-6 text-left font-bold text-center ">Status</th>
                                                    <th class="py-3 px-6 text-left font-bold text-center ">Total</th>
                                                    <th class="py-3 px-6 text-left font-bold text-center ">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $i = 0; ?>
                                                @foreach ($details as $order)
                                                    <?php $i++; ?>
                                                    <tr>
                                                        <tr class="hover:bg-gray-100">
                                                            <td class="py-4 px-6 text-center">{{++$i}}</td>
                                                            <td class="py-4 px-6 text-center">{{$order->firstname}}</td>
                                                            <td class="py-4 px-6 text-center">{{$order->email}}</td>
                                                            <td class="py-4 px-6 text-center">{{$order->mobile}}</td>
                                                            <td class="py-4 px-6 text-center">{{$order->city}}</td>
                                                            <td class="py-4 px-6 text-center">{{$order->country}}</td>
                                                            <td class="py-4 px-6 text-center">{{$order->status}}</td>
                                                            <td class="py-4 px-6 text-center">${{$order->total}}</td>
                                                            <td class="py-4 px-6 text-center">
                                                                <a href="" class="edit-link text-bold">Edit</a>
                                                                <a href="#" class="text-danger" onclick="deleteConfirmation({{$order->id}})" style="margin-left: 20px">Delete</a>
                                                            </td>
                                                        </tr>
                                                @endforeach
                                            </tbody>
                                        </table>

                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</div>

<div class="modal" id="deleteConfirmation">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body pb-30 pt-30">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h4 class="pb-3">Are you sure you want to delete order ?</h4>
                        <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#deleteConfirmation">Cancel</button>
                        <button type="button" class="btn btn-danger" onclick="deleteOrder()">Yes, Delete</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        function deleteConfirmation(id){
            @this.set('order_id', id);
            $('#deleteConfirmation').modal('show');
        }

        function deleteOrder(){
            @this.call('deleteOrder');
            $('#deleteConfirmation').modal('hide');

        }
    </script>

<script>
    var date = $('.fc-datepicker').datepicker({
        dateFormat: 'yy-mm-dd'
    }).val();
</script>

<script>
    $(document).ready(function() {
        $('#invoice_number').hide();
        $('input[type="radio"]').click(function() {
            if ($(this).attr('id') == 'type_div') {
                $('#invoice_number').hide();
                $('#type').show();
                $('#start_at').show();
                $('#end_at').show();
            } else {
                $('#invoice_number').show();
                $('#type').hide();
                $('#start_at').hide();
                $('#end_at').hide();
            }
        });
    });
</script>
@endpush


