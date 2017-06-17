<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

	protected $table = "categories";

    public $fillable = ['title','parent_id'];

    /**
     * Get the index name for the model.
     *
     * @return string
    */
    public function user() {
        return $this->belongsTo('App\User', 'parent_id') ;
    }
    
}