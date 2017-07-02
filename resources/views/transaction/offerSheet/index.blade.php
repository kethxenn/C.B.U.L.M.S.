@extends('layout.coreLayout')
@section('content')
<meta name="_token" content="{!! csrf_token() !!}" />
<div class="container-fluid">
  <div class="body">
    <div class="block-header">
      <h2 class="align-center">USER ACCOUNTS</h2>
    </div>
    
  </div>
  <div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <div class="card">
        <div class="header align-center">
          <h2>
            LIST OF UNSETTLED REGISTRATION 
          </h2>
        </div>
        <div class="body">
          <table class="table table-hover dataTable" id="myTable">
            <thead>
              <tr>
                <th class="align-center">REGISTRATION CODE</th>
                <th class="align-center">Client</th>
                <th class="align-center">Business</th>
                <th class="align-center">Unit requested</th>
              </tr>
            </thead>
            <tbody id="myList">
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@section('scripts')
{!!Html::script("custom/offerSheetAjax.js")!!}
<script type="text/javascript">
  var dataurl="{!!route('offerSheets.getData')!!}" ;
  var url="{!!route('offersheets.index')!!}" ;
</script>
@endsection