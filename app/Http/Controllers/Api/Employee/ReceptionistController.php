<?php

namespace App\Http\Controllers\Api\Employee;

use App\Enums\ReservationStatus;
use App\Enums\TableStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\Receptionist\StoreReservationRequest;
use App\Http\Resources\CustomerCollection;
use App\Http\Resources\ReservationResource;
use App\Models\Customer;
use App\Models\Reservation;
use App\Traits\ResponseApi;
use Illuminate\Support\Facades\Auth;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class ReceptionistController extends Controller
{

    use ResponseApi;

    public function __construct()
    {
        $this->middleware('role:manager|receptionist');
    }

    public function searchCustomer()
    {
        $customers = QueryBuilder::for(Customer::class)
        ->allowedFilters([
            'name',
            'phone'
        ])
        ->paginate(10);
        return $this->responseSuccess('show customers',new CustomerCollection($customers));
    }
    
    public function showReservations()
    {
        $reservations = Reservation::withWhereHas('tables',function($query){
            $query->where('branch_id',Auth::user()->branch->id);
        });
        $reservations = QueryBuilder::for($reservations)
        ->allowedFilters([
            AllowedFilter::exact('status'),
        ])->get();
        return $this->responseSuccess('show reservations',ReservationResource::collection($reservations));
    }

    public function reserveTable(StoreReservationRequest $request) 
    {
        $request->merge(['status'=>ReservationStatus::Requested]);
        $reservation = Reservation::create($request->all());
        $reservation->tables()->attach($request->tables);
        $reservation->tables()->update(['status'=>TableStatus::Reserved]);
        return $this->responseSuccess('reservation has been created successfully!',new ReservationResource($reservation));
    }

}
