@extends('layout.coreLayout')
@section('content')
<div class="container-fluid">
  <div class="body">
    <div class="block-header">
      <h2 class="align-center">CONTENTS<button class="btn btn-success btn-lg waves-effect waves-lime m-l-15 m-b-5 " id="btnAddModal"  type="button" >
        <i class="mdi-content-add pulls"></i> NEW
      </button></h2>
    </div>
  </div>
  <div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
     <!--Delete MODAL-->
     <div class="modal fade" id="modalDelete" tabindex="-1" role="dialog">
      <div class="modal-dialog modal-md" role="document">
        <div class="modal-content modal-col-green">
          <div class="modal-header-delete">
            <h2 class="modal-title align-center p-b-15 p-l-35">DELETE<a href="" class="pull-right" data-dismiss="modal"><i class="mdi-navigation-close"></i></a></h2>
          </div>
          <div class="modal-body align-center">
            <p>Are you sure do you want to delete this record?</p>
          </div>
          <div class="modal-footer align-center">
            <button id="btnDelete" type="submit" class="btn btn-lg bg-red waves-effect waves-white col-md-12 col-sm-12"><i class="mdi-action-delete"></i> DELETE</button>
          </div>
        </div>
      </div>
    </div>
    <!--Delete MODAL-->

    <!--MODAL-->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content modal-col-green">
          {{ Form::open([
            'id' => 'myForm', 'class' => 'form-horizontal'
            ])
          }}
          <div class="modal-header">
            <h1 id="label" class="modal-title align-center p-b-15">CONTENTS<a href="" class="pull-right" data-dismiss="modal"><i class="mdi-navigation-close"></i></a></h1>
          </div>
          <div class="modal-body">
            <div class="form-group p-l-30">
              <div class="form-line">
                {{Form::textarea('txtContent',null,[
                  'id'=> 'txtContent',
                  'class' => 'form-control align-center',
                  'autocomplete' => 'off',
                  'minlength' => '3',
                  'maxlength' => '120',
                  'required' => 'required',
                  'data-parsley-pattern' => '^[a-zA-Z0-9. ]+$'
                  ])
                }}
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-lg bg-brown waves-effect waves-white col-md-12" id="btnSave" value="add"><i class="mdi-content-save"></i><span id="lblButton"> SAVE</span></button>
            <input type="hidden" id="myId" value="0">
          </div>
          {{Form::close()}}
        </div>

      </div>
    </div>
    <!--MODAL-->

    <div class="card">
      <div class="header align-center">
        <h2>
          LIST OF CONTENT
        </h2>
      </div>
      <div class="body">
        <table class="table table-hover dataTable" id="myTable">
          <thead>
            <tr>
              <th class="align-center">Content</th>
              <th class="align-center">Status</th>
              <th class="align-center">Action</th>
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
{!!Html::script("custom/contentAjax.js")!!}
<script type="text/javascript">
  var dataurl="{!!route('content.getData')!!}" ;
  var url="{!!route('content.index')!!}" ;
</script>
@endsection
