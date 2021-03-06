<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class League extends Model {

    use UsesUuid;

    protected $guarded = [];

    public function meets()
    {
        return $this->hasMany(Meet::class);
    }

    public function admins()
    {
        return $this->belongsToMany(User::class, 'league_admins', 'league_id', 'user_id')
            ->withTimestamps();
    }

    public function members()
    {
        return $this->belongsToMany(User::class, 'league_members', 'league_id', 'user_id')
            ->withTimestamps();
    }

    public function scopeRecentlyMet($query)
    {
        return $query->leftJoin('meets', 'meets.league_id', '=', 'leagues.id')
            ->groupBy(['leagues.id'])
            ->orderByRaw('max(meets.meet_date) desc')
            ->select('leagues.*');
    }
}
