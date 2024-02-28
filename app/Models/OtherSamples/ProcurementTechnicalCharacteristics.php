<?php

namespace App\Models\OtherSamples;

use App\Contracts\Models\Approvable as ApprovableContract;
use App\Models\User;
use App\Traits\Approvable;
use App\Traits\FormatsDateFields;
use App\Traits\HasUserId;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class ProcurementTechnicalCharacteristics extends Model implements ApprovableContract
{
    use LogsActivity, HasUserId, Approvable, FormatsDateFields;

    protected static $logName = 'procurement_technical_characteristics';
    protected static $logAttributes = ['*'];
    protected static $logAttributesToIgnore = ['updated_at'];

    protected $fillable = [
        'user_id', // comment('Մուտքագրողի id-ն')
        'invitation_quota_number', // comment('Հրավերով նախատեսված չափաբաժնի համարը')  - invitation_quota_number
        'procurement_plan_passcode', // comment('Գնումների պլանով նախատեսված միջանցիկ ծածկագիրը ըստ ԳՄԱ դասկարգման (CPV)') - procurement_plan_passcode
        'name_and_trademark', // comment('Անվանումը և ապրանքային նշանը') - name_and_trademark
        'manufacturer_name_and_country', // comment('Արտադրողի անվանումը և ծագման երկիրը') - manufacturer_name_and_country
        'technical_specifications', // comment('Տեխնիկական բնութագիրը') - technical_specifications
        'measurement_unit', // comment('Չափման միավորը') - measurement_unit
        'unit_price', // comment('Միավոր գինը ՀՀ դրամ') - unit_price
        'total_price', // comment('Ընդհանուր գինը ՀՀ դրամ') - total_price
        'total_quantity', // comment('Ընդհանուր քանակը') - total_quantity

        'address',      //  comment('Հասցե')
        'quantities',   //  comment('Ենթակա քանակներ')
        'deadlines',    //  comment('Ժամկետներ')
        'general',      //  comment('Ընդհանուր')
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
