<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
	protected $table='my_books';
    protected $guarded = [];
    // protected $fillable = [
    //     'user_id', 'book'
    // ];
    public function user(){
    	return $this->belongsTo('App\User');
    	// return $this->belongsTo('App\User', 'user_id', 'id');
    }
}
