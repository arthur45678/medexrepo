<?php

namespace App\Models;

use App\Traits\HasCacheableOptions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Order extends Model
{
    use LogsActivity;

    protected static $logName = 'orders';
    protected static $logAttributes = ['*'];
    // protected static $recordEvents = ['updated', 'created', 'deleted'];
    protected static $logAttributesToIgnore = ['updated_at'];

    public const STATUS_WAIT = 0;
    public const STATUS_IN_YEREVAN = 1;
    public const STATUS_ACTIVE = 2;
    public const STATUS_CANCELED = 3;

    protected $table = 'orders';


    protected $fillable = ['user_id','patient_id','cashbox_id', 'department_id', 'shipped','price','sum_text','social_card','document_type','correspondentAccount_id'];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function cashbox()
    {
        return $this->belongsTo(Cashbox::class);
    }

    public function treatments()
    {
        return $this->belongsToMany(TreatmentList::class,'order_treatment','order_id','treatment_id');
    }

    public function department()
    {
        return $this->belongsToMany(Department::class,'order_department','order_id','department_id');
    }


    public static function storeOrderInput($request, $cashbox)
    {


        $model = new static;
        $data = $request->only($model->fillable);

        $data["created_at"] =  \Carbon\Carbon::now();
        $data["updated_at"] =  \Carbon\Carbon::now();

        $data['correspondentaccount_id'] =  (int) $request->correspondentaccount_id;
        $order_id = DB::table('orders')->insertGetId($data);

        $order = self::find($order_id);


        $order->cashbox_id = $cashbox->id;
        $order->save();

        $treatment_ids = $request->treatment_ids;
        foreach ($treatment_ids as $treatment_id) {
            if($treatment_id){
                OrderTreatment::create([
                    'order_id' => $order->id,
                    'treatment_id' => $treatment_id
                ]);
            }
        }

        $departments_full_ids = $request->departments_full_ids;
        foreach ($departments_full_ids as $department_id) {
            if($department_id){
                OrderDepartment::create([
                    'order_id' => $order->id,
                    'department_id' => $department_id,
                ]);
            }
        }
    }
}
