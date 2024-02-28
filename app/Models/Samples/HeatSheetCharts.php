<?php

namespace App\Models\Samples;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Http\Request;

class HeatSheetCharts extends Model
{
    protected $table = 'heat_sheet_charts';
    protected $fillable = ['day','day_time_period','A_CH_comment','temperature','p','t_0','heat_sheet_id',];

    public function heat_sheet() : BelongsTo
    {
        return $this->belongsTo(HeatSheet::class,'heat_sheet_id','id');
    }

    public function storeChart(Request $request,$heat_sheet_id)
    {
        $fields = $request->only($this->fillable);
        $fields['heat_sheet_id'] = $heat_sheet_id;
        $item = self::create($fields);
        return $item;
    }

    public function updateChart(Request $request,$chart_id)
    {
        $item = self::findOrFail($chart_id);
        $fields = $request->only($this->fillable);
        $item->fill($fields);
        $t = $item->save();
        return $item;

    }

}
