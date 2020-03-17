<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class League extends Model
{
    protected $guarded = [];

    public function meets()
    {
        return $this->hasMany(Meet::class);
    }

    public function scopeRecentlyMet($query)
    {
        return $query->leftJoin('meets', 'meets.league_id', '=', 'leagues.id')
            ->groupBy(['leagues.id'])
            ->orderByRaw('max(meets.meet_date) desc')
            ->select('leagues.*');
    }
}
