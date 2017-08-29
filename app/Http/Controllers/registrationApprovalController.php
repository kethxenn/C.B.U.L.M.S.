<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Datatables;
use Response;
use App\RegistrationHeader;
use App\RegistrationDetail;
use Auth;

class registrationApprovalController extends Controller
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
    public function index()
    {
        //
      return view('transaction.registrationApproval.index');
    }
    public function data()
    {
      $result=DB::table('registration_headers')
      ->select(DB::raw(
        'registration_headers.id,'.
        'registration_headers.code as regi_code,'.
        'tenants.description as tenant_description,'.
        'business_types.description as business_type_description,'.  
        'count(registration_details.id) as regi_count'
        ))
      ->join('tenants','registration_headers.tenant_id','tenants.id')
      ->join('business_types','tenants.business_type_id','business_types.id')
      ->join('users','tenants.user_id','users.id')
      ->join('registration_details','registration_headers.id','registration_details.registration_header_id')
      ->where('registration_headers.status','0')
      ->where('registration_headers.is_forfeited','0')
      ->where('registration_details.is_forfeited','0')
      ->where('registration_details.is_rejected','0')
      ->groupBy('registration_headers.id')
      ->orderBy('registration_headers.id')
      ->get();
      return Datatables::of($result)
      ->addColumn('action', function ($data) {
        return "<a href=".route('registrationApproval.show',$data->id)." type='button' class='btn bg-green btn-circle waves-effect waves-circle waves-float'><i class='mdi-action-visibility'></i></a>";
      })
      ->setRowId(function ($data) {
        return $data = 'id'.$data->id;
      }) 
      ->rawColumns(['action'])
      ->make(true)
      ;
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
        //
      if($request->header_is_active==1)// if the transaction was accepted
      {
        $regi_head=RegistrationHeader::find($request->myId);
        $regi_head->status=1;
        $regi_head->user_id=Auth::user()->id;
        $regi_head->admin_remarks=$request->header_remarks;
        $regi_head->save();
        for($x=0;$x<count($request->regi_id); $x++)
        { 
          $regi_detail=RegistrationDetail::find($request->regi_id[$x]);
          $regi_detail->is_rejected=$request->regi_is_active[$x];
          $regi_detail->admin_remarks=$request->detail_remarks[$x];
          $regi_detail->save();
        }
        return redirect(route('offersheets.show',$request->myId));
      }
      else //if the transaction was rejected
      {
        $regi_head=RegistrationHeader::find($request->myId);
        $regi_head->status=2;
        $regi_head->user_id=Auth::user()->id;
        $regi_head->admin_remarks=$request->header_remarks;
        $regi_head->save();
      }
      return redirect(route('registrationApproval.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showData($id)
    {
     $result=DB::table('registration_details')
     ->join('registration_headers','registration_headers.id','registration_details.registration_header_id')
     ->join('building_types','building_types.id','registration_details.building_type_id')
     ->select(DB::Raw('CONCAT(registration_details.size_from,"-",registration_details.size_to," sqm") as size_range,registration_details.*,building_types.description, registration_details.id as detail_id'))
     ->where('registration_headers.id','=',$id)
     ->where('registration_headers.status','0')
     ->where('registration_headers.is_forfeited','0')
     ->where('registration_details.is_forfeited','=',0)
     ->get();
     return Datatables::of($result)
     ->addColumn('action', function ($data) {
      return " <button type='button' id='btnChoose' class='btn bg-blue btn-circle waves-effect waves-circle waves-float btnChoose' value='$data->detail_id'><i class='mdi-action-visibility'></i></button>
      <input type='hidden' value='$data->detail_id' name='regi_id[]'>
      <input type='hidden' name='regi_is_active[]' id='regi$data->detail_id'value='0'><input id='remarks$data->detail_id' type='hidden' name='detail_remarks[]'>";
    })
     ->addColumn('unit_type', function ($data) {
      $value='Raw';
      if($data->unit_type==1)
        $value='Shell';
      return $value;
    })
     ->setRowId(function ($data) {
      return $data = 'id'.$data->id;
    }) 
     ->rawColumns(['action'])
     ->make(true)
     ;
   }
   public function show($id)
   {
        //
    $tenant=DB::table('registration_headers')
    ->join('tenants','registration_headers.tenant_id','tenants.id')
    ->join('users','users.id','tenants.user_id')
    ->select(DB::Raw('registration_headers.tenant_remarks,registration_headers.id,tenants.description,registration_headers.code, concat(first_name," ", last_name) as name'))
    ->where('registration_headers.status','0')
    ->where('registration_headers.is_forfeited','0')
    ->where('registration_headers.id','=',$id)
    ->first();
    return view('transaction.registrationApproval.show')
    ->withTenant($tenant);
  }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
      $result=DB::table('registration_details')
      ->join('registration_headers','registration_headers.id','registration_details.registration_header_id')
      ->join('building_types','building_types.id','registration_details.building_type_id')
      ->select(DB::Raw('registration_headers.tenant_remarks as header_remarks,CONCAT(registration_details.size_from,"-",registration_details.size_to," sqm") as size_range,registration_details.floor,registration_details.unit_type,building_types.description, registration_details.id as detail_id,registration_details.tenant_remarks as detail_remarks'))
      ->where('registration_details.id','=',$id)
      ->where('registration_headers.status','0')
      ->where('registration_headers.is_forfeited','0')
      ->where('registration_details.is_forfeited','0')
      ->first();
      return response::json($result);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
  }
