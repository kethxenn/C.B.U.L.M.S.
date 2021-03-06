<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Response;
use App\BuildingType;
use App\province;
use App\BusinessType;
use App\RepresentativePosition;
use App\Floor;
use App\SizeRange;
use App\Notification;
use App\UserBalance;
use App\BillingHeader;
use App\BillingDetail;
use App\BillingItem;
use App\Payment;
use Carbon\Carbon;
use Config;
use Auth;
use Datatables;
class customController extends Controller
{
	public function getCity($id)
	{
		$result=DB::table("cities")
		->select("cities.*")
		->join("provinces","cities.province_id","provinces.id")
		->where("cities.province_id","=",$id)
		->get();
		return Response::json($result);
	}
	public function getBanks()
	{
		$result=DB::table("banks")
		->select("banks.id",'banks.description')
		->get();
		return Response::json($result);
	}
	public function getMarketRate($id)
	{
		$result=DB::table("cities")
		->leftJoin("market_rates","cities.id","market_rates.city_id")
		->join('addresses','cities.id','addresses.city_id')
		->join('buildings','addresses.id','buildings.address_id')
		->where('buildings.id',$id)
		->whereRaw("market_rates.date_as_of=(SELECT MAX(date_as_of) from market_rates where city_id=cities.id)")
		->select(DB::raw("COALESCE(market_rates.rate,0) as rate"))
		->first(); 
		return Response::json($result->rate);
	}
	public function getBuildingType()
	{
		$result=BuildingType::where('is_active',1)
		->orderBy("description")
		->get();
		return Response::json($result);
	}
	public function getProvince()
	{
		$result=province::where('is_active',1)->get();
		return Response::json($result);
	}
	public function getFloor()
	{
		$result=Floor::where('floors.is_active','=',1)
		->groupBy('floors.number')
		->join('units','floors.id','units.floor_id')
		->select('floors.id','floors.number')
		->get();
		return Response::json($result);
	}
	public function getRange()
	{
		$range=SizeRange::where('is_active','=',1)
		->select(DB::Raw('id, size_from, size_to,CONCAT(size_from," - ",size_to," sqm") as name,CONCAT(size_from,"|",size_to) as value'))
		->get()
		;
		return Response::json($range);

	}

	public function readNotification(Request $request)
	{
		$notification=Notification::FINDORFAIL($request->id);
		$notification->is_read=1;
		$notification->date_read=Carbon::now();
		$notification->save();
		$list=DB::TABLE('notifications')
		->WHERE('user_id',Auth::user()->id)
		->SELECT('id','title','description','link','date_issued')
		->WHERE('is_read',0)
		->GET();
		$count=DB::TABLE('notifications')
		->WHERE('user_id',Auth::user()->id)
		->WHERE('is_read',0)
		->COUNT('id');
		foreach ($list as $element) {
                # code...
			$myDate=new Carbon($element->date_issued);
			$element->date_issued=$element->date_issued;
		}
		$notification = (object)['count' =>$count, 'list' => $list];
		return Response::JSON($notification);
	}
	public function getNotificationCount(){
		$count=DB::TABLE('notifications')
		->WHERE('user_id',Auth::user()->id)
		->WHERE('is_read',0)
		->COUNT('id');
		return response()->json(['count'=>$count]);
	}
	public function setNotificationRead(Request $request){
		$result = DB::table('notifications')
		->where('notifications.user_id',Auth::user()->id)
		->update(['is_read'=>1]);
		return response()->json(['response'=>'okay']);
	}
	public function getBalance(){
		$balance=DB::TABLE('user_balances')
        ->WHERE('user_id',Auth::user()->id)
        ->ORDERBY('id','desc')
        ->SELECT('balance','balance as formatted_balance')
        ->FIRST();
        if(is_null($balance)){
        	$balance = (object)['balance' => 000, 'formatted_balance' => 'You currently have 0 remaining balance'];
        }else{
        	$balance->formatted_balance="PHP ".number_format($balance->formatted_balance,2);
        }
        
        return response()->json(['balance' => $balance]);
	}
	public function postBalance(Request $request){
		$amount = $request->txtWithdraw;
		$user_balance=new UserBalance;
		$user_balance->user_id=Auth::user()->id;
        $user_balance->date_as_of=Carbon::now(Config::get('app.timezone'));
        $balance=DB::TABLE('user_balances')
        ->WHERE('user_id',Auth::user()->id)
        ->ORDERBY('id','desc')
        ->SELECT('balance','balance as formatted_balance')
        ->FIRST();
        $user_balance->balance=$balance->balance - $amount;
        

        $latest=DB::table("billing_headers")
		->select("billing_headers.*")
		->orderBy('code',"DESC")
		->first();
		$code="BILL001";
		if(!is_null($latest))
		$code=$latest->code;
		$sc= new smartCounter();
		$code=$sc->increment($code);

        $billheader = new BillingHeader;
        $billheader->code = $code;
        $billheader->cost = $amount;
        $billheader->user_id = Auth::user()->id;
        $billheader->date_issued =Carbon::now(Config::get('app.timezone'));
        $billheader->save();

        $billing_detail=new BillingDetail();
		$billing_detail->billing_header_id=$billheader->id;
		$billing_detail->billing_item_id=10;
		$billing_detail->description='Tenant Withdrawal';
		$billing_detail->price=$amount;
		$billing_detail->save();


		$latest=DB::table("payments")
		->select("payments.*")
		->orderBy('code',"DESC")
		->first();
		$code="COLLECTION001";
		if(!is_null($latest))
		$code=$latest->code;
		$sc= new smartCounter();
		$code=$sc->increment($code);

		$payment = new Payment;
		$payment->code = $code;
		$payment->billing_header_id = $billheader->id;
		$payment->mode = 0;
		$payment->date_issued = Carbon::now(Config::get('app.timezone'));
		$payment->date_collected = Carbon::now(Config::get('app.timezone'));
		$payment->user_id = Auth::user()->id;
		$payment->payment = $amount;
		$payment->save();
		$user_balance->payment_id = $payment->id;
		$user_balance->save();
        return response()->json(['message' => 'Account updated']);
	}
	public function getUnits()
    {
      $result=DB::table("units")
      ->select(DB::Raw('Coalesce(price * units.size,1) as price,buildings.description as description,floors.number as floor_number,units.code as unit_code,units.type as type,units.size,units.id as id,units.picture as picture'))
      ->where('is_used',0)
      ->where('units.is_active',1)
      ->join("floors","units.floor_id","floors.id")
      ->join("buildings","floors.building_id","buildings.id")
      ->join("building_types","buildings.building_type_id","building_types.id")
      ->leftJoin('unit_prices','units.id','unit_prices.unit_id')
      ->whereRaw("unit_prices.date_as_of=(SELECT MAX(unit_prices.date_as_of) from unit_prices where unit_id=units.id) or isnull(unit_prices.date_as_of)")
      ->where("buildings.is_active",1)
      ->get();
      return Datatables::of($result)
      ->addColumn('action', function ($data) {
        return '<button class="ui right labeled icon blue button button-details" type="button" data-id="'.$data->id.'"><i class="right arrow icon"></i>See Details</button>
        	<button class="ui right labeled icon green button button-toggle" type="button" data-id="'.$data->id.'"><i class="shop icon"></i>Select</button>';
      })
      ->editColumn('size', function ($data) {
        return "$data->size sqm";
      })
      ->editColumn('price', function ($data) {
        return "P $data->price / month";
      })
      ->editColumn('type', function ($data) {
        $value = 'Raw';
        if($data->type==1){
          $value = 'Shell';
        }
        return $value;
      })
      ->setRowId(function ($data) {
        return $data = 'id'.$data->id;
      })
      ->rawColumns(['is_active','action'])
      ->make(true);
    }
    public function getUnitsFrom(Request $request){
    	$result = DB::table('units')
    	->whereIn('id',$request->ids)
    	->get();
    	return response()->json($result);
    }
}


