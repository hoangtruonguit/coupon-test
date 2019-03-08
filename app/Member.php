<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Kyslik\ColumnSortable\Sortable;

class Member extends Authenticatable
{
    use Notifiable, Sortable;


    protected  $table = 'members';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email',
    ];

    public $sortable = ['id', 'name', 'email', 'created_at', 'updated_at'];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    public function memberCoupon()
    {
       return  $this->hasMany('App\MemberCoupon', 'member_id');
    }

}
