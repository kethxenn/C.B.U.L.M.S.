<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Datatables;
use Response;
use App\BuildingType;

class buildingTypeController extends Controller
{
  public function __construct()
  {
    $this->middleware('admin');
    $this->middleware('auth');
}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function data()
    {
        $result=BuildingType::all();
        return Datatables::of($result)
        ->addColumn('action', function ($data) {
            return '<button id="btnEdit" type="button" class="btn bg-blue btn-circle waves-effect waves-circle waves-float" value="'.$data->id.'"><i class="mdi-editor-border-color"></i></button> <button type="button" class="btn bg-red btn-circle waves-effect waves-circle waves-float deleteRecord" value= "'.$data->id.'"><i class="mdi-action-delete"></i></button>';
        })
        ->editColumn('is_active', function ($data) {
          $checked = '';
          if($data->is_active==1){
            $checked = 'checked';
        }
        return '<div class="switch"><label>Off<input '.$checked.' type="checkbox" id="IsActive" value="'.$data->id.'"><span class="lever switch-col-blue"></span>On</label></div>';
    })
        ->setRowId(function ($data) {
            return $data = 'id'.$data->id;
        })
        ->rawColumns(['is_active','action'])
        ->make(true);
    }

    public function index()
    {
        //
        return view('maintenance.buildingType.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

     try
     {
        $result=new BuildingType();
        $result->description=$request->txtBuilTypeDesc;
        $result->save();
    }
    catch(\Exception $e)
    {
        if($e->errorInfo[1]==1062)
          return "This Data Already Exists";
      else if($e->errorInfo[1]==1452)
          return "Already Deleted";
      else
          return var_dump($e->errorInfo[1]);
  }
}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $result=BuildingType::find($id);
        return Response::json($result);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try
        {  
            try
            {
                $result=BuildingType::find($id);
                $result->description=$request->txtBuilTypeDesc;
                $result->save();
            }
            catch(\Exception $e)
            {
              if($e->errorInfo[1]==1062)
                return "This Data Already Exists";
            else
                return var_dump($e->errorInfo[1]);
        }
    }
    catch(\Exception $e)
    {
        return "Deleted";
    }
}

public function softdelete($id)
{
    $result=BuildingType::find($id);
    if($result->is_active==1)
        $val=0;
    else
        $val=1;
    $result->is_active=$val;
    $result->save();
}
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        try
        {
            $result = BuildingType::findorfail($id);
            try
            {
              $result->delete();
              return Response::json($result->description);
          }
          catch(\Exception $e) {
              if($e->errorInfo[1]==1451)
                return Response::json(['true',$result->description]);
            else
                return Response::json(['true',$result->description,$e->errorInfo[1]]);
        }
    } 
    catch(\Exception $e) {
        return "Deleted";
    }
}
}
