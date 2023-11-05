<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transactions extends Model
{
    use HasFactory;

    protected $guarded = [];
    static public function getCA($startDate, $endDate)
    {

        $ca = self::whereDate('updated_at', '>=', $startDate)
                    ->whereDate('updated_at', '<=', $endDate)
                    ->where('trasaction_category', 'Révenu')
                   ->sum('amount');
        return $ca;
    }


    static public function getDepense($startDate, $endDate)
    {

        $ca = self::whereDate('updated_at', '>=', $startDate)
                    ->whereDate('updated_at', '<=', $endDate)
                    ->where('trasaction_category', 'Dépense')
                   ->sum('amount');
        return $ca;
    }
}
