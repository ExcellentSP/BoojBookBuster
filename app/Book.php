<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
	public $fillable = [
		'title',
		'author',
		'publication_date',
		'genre',
		'isbn',
		'description'
	];
}