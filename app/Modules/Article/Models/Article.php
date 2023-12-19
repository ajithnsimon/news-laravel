<?php

namespace App\Modules\Article\Models;

use Illuminate\Database\Eloquent\Model;

use App\Modules\Author\Models\Author;
use App\Modules\Source\Models\Source;
use App\Modules\Category\Models\Category;

class Article extends Model
{
    protected $fillable = ['title', 'content', 'date', 'author_id', 'source_id', 'category_id', 'api'];

    // Define the relationship with the Author model
    public function author()
    {
        return $this->belongsTo(Author::class, 'author_id');
    }

    // Define the relationship with the Source model
    public function source()
    {
        return $this->belongsTo(Source::class, 'source_id');
    }

    // Define the relationship with the Category model
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
