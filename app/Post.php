<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

	protected $table = "posts";

    public $fillable = ['title','text','category_id'];

    /**
     * Get the index name for the model.
     *
     * @return string
    */
    public function category (){
        return $this->belongsTo('App\Category');
    }
}