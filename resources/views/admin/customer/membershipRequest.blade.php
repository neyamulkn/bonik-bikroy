@extends('layouts.admin-master')
@section('title', 'Membership request list')

@section('content')
    <!-- Page wrapper  -->
    <!-- ============================================================== -->
    <div class="page-wrapper">
        <!-- ============================================================== -->
        <!-- Container fluid  -->
        <!-- ============================================================== -->
        <div class="container-fluid">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h4 class="text-themecolor">Verify request List</h4>
                </div>
                <div class="col-md-7 align-self-center text-right">
                    <div class="d-flex justify-content-end align-items-center">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Verify request</a></li>
                            <li class="breadcrumb-item active">list</li>
                        </ol>
                        <!-- <button data-toggle="modal" data-target="#add" class="btn btn-info d-none d-lg-block m-l-15"><i class="fa fa-plus-circle"></i> Create New</button> -->
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Start Page Content -->
            <!-- ============================================================== -->
            
            <div class="row">
                <div class="col-12">

                    <div class="card ">
                        <div class="card-body">
                           
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Mobile</th>
                                            <th>Membership</th>
                                            <th>Amount</th>
                                            <th>Payment</th>
                                            <th>Verify</th>
                                        </tr>
                                    </thead> 
                                    <tbody>
                                        @foreach($sellerMemberships as $index => $customer)
                                        <tr id="item{{$customer->id}}">
                                            <td>{{(($sellerMemberships->perPage() * $sellerMemberships->currentPage() - $sellerMemberships->perPage()) + ($index+1) )}}</td>
                                            
                                            <td>
                                                <a style="display:flex;" class="dropdown-item" title="View Profile" href="{{ route('customer.profile', $customer->user->username) }}">
                                                <p style="padding-left: 3px">{{$customer->user->name}}</p>
                                                </a>
                                            </td>
                                            <td>{{$customer->user->mobile}} <br/> {{$customer->user->email}}</td> 
                                           
                                            <td>{{str_replace("-", " ", $customer->membership)}} </td>
                                             <td>{{ config("siteSetting.currency_symble"). $customer->amount}}</td>
                                            <td>{{ $customer->payment_method }} 
                                                @if($customer->tnx_id)
                                                <br>{{$customer->tnx_id}}
                                                <br>{{$customer->payment_info}}
                                                @endif

                                            </td>
                                            <td onclick="customerStatus({{ $customer->id }})"> @if($customer->status == 'active') <span class="label label-success"> Active </span> @else <span class="label label-danger">{{$customer->status}}</span> @endif</td>
                                           
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="row">
               <div class="col-sm-6 col-md-6 col-lg-6 text-center">
                   {{$sellerMemberships->appends(request()->query())->links()}}
                  </div>
                <div class="col-sm-6 col-md-6 col-lg-6 text-right">Showing {{ $sellerMemberships->firstItem() }} to {{ $sellerMemberships->lastItem() }} of total {{$sellerMemberships->total()}} entries ({{$sellerMemberships->lastPage()}} Pages)</div>
            </div>
            <!-- ============================================================== -->
            <!-- End PAge Content -->
            <!-- ============================================================== -->

        </div>
        <!-- ============================================================== -->
        <!-- End Container fluid  -->
        <!-- ============================================================== -->
    </div>
 
    <div class="modal fade" id="customerStatus_modal" role="dialog"  tabindex="-1" aria-hidden="true" style="display: none;">
            <div class="modal-dialog modal-sm">

                  <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Membership request Status</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body form-row">
                        <div class="card-body">
                            
                            <div class="form-body">
                                <form action="{{route('membershipRequestUpdate')}}" method="POST">
                                {{csrf_field()}}
                               <div id="verify_form">
                                    <input type="hidden" name="id" value="" id="request_id">
                                    <div class="form-group">
                                        <label>Request Status</label>
                                        <select required onchange="requestStatus(this.value)" name="status" class="form-control">
                                            <option value="" >Select Status</option>
                                            <option value="active" >Active</option>
                                            <option value="reject">Reject</option>
                                        </select>
                                    </div>

                                    <div class="form-group" id="bandReason"></div>
                                    
                                    
                               </div>
                               <div class="modal-footer">
                                    <button type="submit" name="submit" value="add" class="btn btn-success"> <i class="fa fa-check"></i> Change Status</button>
                                    <button type="button" data-dismiss="modal" class="btn btn-inverse">Close</button>
                                </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
  
@endsection
@section('js')

<script type="text/javascript">
                                         
function requestStatus(status) {
if(status == 'reject'){
$('#bandReason').html(`<div class="form-group">

</div><div class="form-group"><label>Write reject reason</label><textarea name="reject_reason" class="form-control" placeholder="Write reject reason"></textarea></div>`);
}else{
 $('#bandReason').html('');
}

}

function customerStatus(id){
    $("#customerStatus_modal").modal("show");
    $("#request_id").val(id);
}

</script>

@endsection
