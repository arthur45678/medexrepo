<?php

namespace App\Models;

use http\Env\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\DB;
use Spatie\Activitylog\Traits\LogsActivity;


class OrderOutput extends Model
{
    use LogsActivity;

    protected static $logName = 'orderoutput';
    protected static $logAttributes = ['*'];
    // protected static $recordEvents = ['updated', 'created', 'deleted'];
    protected static $logAttributesToIgnore = ['updated_at'];

    protected $table = 'orderoutput';
    protected $fillable = ['user_id','patient_id','cashbox_id', 'price','sum_text','document_type','passport_data','social_card','correspondentAccount_id'];

    public static function storeOrder($request, $cashbox)
    {

        $model = new static;
        $data = $request->only($model->fillable);
        $data["created_at"] =  \Carbon\Carbon::now();
        $data["updated_at"] =  \Carbon\Carbon::now();

        $order_id = DB::table('orderoutput')->insertGetId($data);
        $orderOutput = self::find($order_id);

        $orderOutput->cashbox_id = $cashbox->id;
        $orderOutput->save();
        return $orderOutput;
    }

    public function cashbox()
    {
        return $this->belongsTo(Cashbox::class);
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class,'patient_id','id');
    }
}
