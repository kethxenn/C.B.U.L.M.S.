@extends('layouts.tenantLayout')
@section('content')
<div class="container">
      <div class="card">
        <div class="card-content">
          <table class="table row-border display compact table-hover dataTable table-striped ui celled is-narrow" id="myTable">
            <thead>
              <tr>
                <th class="align-center">Contract</th>
                <th class="align-center">Lessor</th>
                <th class="align-center">Number of Units</th>
                <th class="align-center">Date Issued</th>
                <th class="align-center">Action</th>
              </tr>
            </thead>
            <tbody id = "body">
            </tbody>
          </table>
        </div>
      </div> <!-- end of .card -->
    </div>
   @include('partials.tenant._contractDetailsModal')
   @include('partials.tenant._contractAmmendmentModal')
@endsection

@section('scripts')
{!!Html::script("custom/contractAmmendmentAjax.js")!!}
<script type="text/javascript">
  var dataurl="{!!route('tenant.contractData')!!}" ;
  var url="{!!route('contract.index')!!}" ;
  var urlUnits = "{!!route('tenant.getUnits')!!}";
  var urlStore = "{!!route('tenant.storeRequest')!!}";
  urlbtype="{{route("custom.getBuildingType")}}";
  buil_type_url="{{route("custom.getBuildingType")}}";
  floor_url="{{route("custom.getFloor")}}";
  range_url="{{route("custom.getRange")}}";
</script>


@endsection
@section('styles')
 <style type="text/css" media="screen">
 .unselectable {
    -webkit-touch-callout: none;
    -webkit-user-select: none;
    -khtml-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
}
  .checkbox {
  padding-left: 20px; }
  .checkbox label {
    display: inline-block;
    position: relative;
    padding-left: 5px; }
    .checkbox label::before {
      content: "";
      display: inline-block;
      position: absolute;
      width: 17px;
      height: 17px;
      left: 0;
      margin-left: -20px;
      border: 1px solid #cccccc;
      border-radius: 3px;
      background-color: #fff;
      -webkit-transition: border 0.15s ease-in-out, color 0.15s ease-in-out;
      -o-transition: border 0.15s ease-in-out, color 0.15s ease-in-out;
      transition: border 0.15s ease-in-out, color 0.15s ease-in-out; }
    .checkbox label::after {
      display: inline-block;
      position: absolute;
      width: 16px;
      height: 16px;
      left: 0;
      top: 0;
      margin-left: -20px;
      padding-left: 3px;
      padding-top: 1px;
      font-size: 11px;
      color: #555555; }
  .checkbox input[type="checkbox"] {
    opacity: 0; }
    .checkbox input[type="checkbox"]:focus + label::before {
      outline: thin dotted;
      outline: 5px auto -webkit-focus-ring-color;
      outline-offset: -2px; }
    .checkbox input[type="checkbox"]:checked + label::after {
      font-family: 'FontAwesome';
      content: "\f00c"; }
    .checkbox input[type="checkbox"]:disabled + label {
      opacity: 0.65; }
      .checkbox input[type="checkbox"]:disabled + label::before {
        background-color: #eeeeee;
        cursor: not-allowed; }
  .checkbox.checkbox-circle label::before {
    border-radius: 50%; }
  .checkbox.checkbox-inline {
    margin-top: 0; }

.checkbox-primary input[type="checkbox"]:checked + label::before {
  background-color: #428bca;
  border-color: #428bca; }
.checkbox-primary input[type="checkbox"]:checked + label::after {
  color: #fff; }

.checkbox-danger input[type="checkbox"]:checked + label::before {
  background-color: #d9534f;
  border-color: #d9534f; }
.checkbox-danger input[type="checkbox"]:checked + label::after {
  color: #fff; }

.checkbox-info input[type="checkbox"]:checked + label::before {
  background-color: #5bc0de;
  border-color: #5bc0de; }
.checkbox-info input[type="checkbox"]:checked + label::after {
  color: #fff; }

.checkbox-warning input[type="checkbox"]:checked + label::before {
  background-color: #f0ad4e;
  border-color: #f0ad4e; }
.checkbox-warning input[type="checkbox"]:checked + label::after {
  color: #fff; }

.checkbox-success input[type="checkbox"]:checked + label::before {
  background-color: #5cb85c;
  border-color: #5cb85c; }
.checkbox-success input[type="checkbox"]:checked + label::after {
  color: #fff; }
   
 </style>
@endsection