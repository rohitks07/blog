<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\User;


class Role extends Model
{
    use SoftDeletes;
    protected $guarded =[];
    protected $dates  =['deleted_at'];

    public function users()
    {
        //Here this is parent table (bec'z user table belongs from role table (example role_id in user table available))
        return $this->hasMany('App\User');
    }
}
