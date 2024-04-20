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
                    <span></span> All Orders
                </div>
            </div>
        </div>

    <section class="mt-50 mb-50">
            <div class="container">
                <div class="row pb-30">
                    <div class="col">
                      <div class="card radius-10 border-start border-0 border-3 border-info">
                         <div class="card-body">
                             <div class="d-flex align-items-center">
                                 <div>
                                     <p class="mb-0 text-secondary">Total Orders</p>
                                     <h4 class="my-1 ">{{\App\Models\Order::count()}}</h4>
                                     <p class="mb-0 font-13">+2.5% from last week</p>
                                 </div>
                                 <div class="widgets-icons-2 rounded-circle bg-gradient-bloody text-white ms-auto"><i class="fa fa-shopping-cart"></i>
                                 </div>
                             </div>
                         </div>
                      </div>
                    </div>
                    <div class="col">
                     <div class="card radius-10 border-start border-0 border-3 border-danger">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div>
                                    <p class="mb-0 text-secondary">Total Revenue</p>
                                    <h4 class="my-1 ">${{number_format(\App\Models\Order::sum('Total'), 2)}}</h4>
                                    <p class="mb-0 font-13">+5.4% from last week</p>
                                </div>
                                <div class="widgets-icons-2 rounded-circle bg-gradient-bloody text-white ms-auto"><i class="fa fa-dollar"></i>
                                </div>
                            </div>
                        </div>
                     </div>
                   </div>
                 </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header  bg-white rounded-lg">
                                <div class="row">
                                    <div class="col-md-6">
                                        <span class="text-xl px-2 text-bold">All Orders</span>
                                    </div>
                                    <div class="col-md-6">
                                        <a href="{{route('admin.orders-reports')}}" class="btn float-end"><i class="fa fa-file"></i> Orders Reports</a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                @if(Session::has('message'))
                                    <div class="alert alert-success" role="alert">{{Session::get('message')}}</div>
                                @endif
                                <table class="min-w-full">
                                    <thead>
                                        <tr class="bg-gray-200">
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
                                    <tbody class="divide-y divide-gray-300">
                                        @php
                                            $i = 0;
                                        @endphp
                                        @foreach($orders as $order)
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
                                {{-- {{$categories->links()}} --}}
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
@endpush
