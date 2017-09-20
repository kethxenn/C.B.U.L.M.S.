@extends('layout.tenantNav')
@section('breadcrumbs')
<ol class="breadcrumb breadcrumb-col-brown">
	<li><a href="{{url('/tenant')}}"><i class="mdi-action-home"></i> Home</a></li>
	<li><a><i class="mdi-action-swap-horiz"></i> Transaction</a></li>
	<li><a href="{{route("offerSheetApproval.index")}}"><i class="mdi-action-thumbs-up-down"></i> Offer Sheet Approval</a></li>
	<li><a href="{{route("offerSheetApproval.show",$result->id)}}"> {{$result->code}}</a></li>
</ol>
@endsection
@section('content')
<div class="body">
	{{  Form::open(array('route' => 'offerSheetApproval.store'))}}
	<div class="header align-center">
		{{$result->code}}
		<button type='button' class='btn bg-blue waves-effect waves-float btnChoose' value="header" >Accept/Reject</button>
		<div class="form-group">
			<input type="hidden" id="header_remarks"  class="form-control form-line" name="header_remarks" value="">
			<input type="hidden" value="{{$result->id}}" name="myId">
			<input type='hidden' name='header_is_active' id='header_is_active' value="1">
			<h2>
				Offer Sheet Approval for {{$result->code}}
				<div class="form-group">
					<label class="control-label">Remarks*</label>
				</div>
			</h2>
		</div>
		<div class="modal fade" id="modalChoose" tabindex="-1" role="dialog">
			<div class="modal-dialog" role="document">
				<div class="modal-content modal-col-green">
					<div class="modal-header">
						<h1 id="label" class="modal-title align-center p-b-15">What would you like to do with this item?<a href="" class="pull-right" data-dismiss="modal"><i class="mdi-navigation-close"></i></a></h1>
					</div>
					<div class="modal-body">
						Lessor: {{$result->name}}
						<br>
						<div id='myInfo'>
							{{-- used in javascript. don't delete --}}
						</div>
					</div>
					<div class="modal-footer">
						<textarea id='modal_remarks' class="form-control form-line" placeholder="remarks"></textarea>
						<button type='button' id='btnAccept' class='btn bg-blue waves-effect waves-float'>Accept</button>
						<button type='button' id='btnReject' class='btn bg-brown waves-effect waves-float'>Reject</button>
					</div>
				</div>

			</div>
		</div>
		<table class="table table-hover dataTable" id="myTable">
			<thead>
				<tr>
					<th class="align-center">Offer Sheet Detail</th>
					<th class="align-center">Registration Detail</th>
					<th class="align-center">Unit Offered</th>
					<th class="align-center">Unit Rate</th>
					<th class="align-center">Action</th>


				</tr>
			</thead>
			<tbody id="myList">

			</tbody>
		</table>
	</div>

	<button type="submit" class="btn btn-lg bg-brown waves-effect waves-white col-md-12" id="btnSave"><i class="mdi-content-save"></i><span> Generate Offer Sheet Approval</span></button>
	{{Form::close()}}
</div>
@endsection
@section('scripts')
{!!Html::script("custom/offerSheetApprovalShowAjax.js")!!}
<script type="text/javascript">
	mainUrl='{{route('offerSheetApproval.index')}}';
	dataurl='{{route('offerSheetApproval.index')}}/get/showData/{{$result->id}}';
	header_remarks="{{$result->tenant_remarks}}";
</script>
@endsection
