<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Book;

class BooksController extends Controller
{

	/**
	 * Display a listing of books.
	 *
	 * @param Request $request
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{

		$books = Book::orderBy('id','DESC')->paginate(5);

		return view('books.index',compact('books'))
			->with('b', ($request->input('page', 1) - 1) * 5);

	}

	/**
	 * Show the form for creating a new book.
	 *
	 * @return Response
	 */
	public function create()
	{

		return view('books.create');

	}

	/**
	* Store a newly created book in storage.
	*
	* @param  Request  $request
	* @return Response
	*/
	public function store(Request $request)
	{

		$this->validate($request, [
			'title' => 'required|unique:books|max:255',
			'author' => 'required|max:255',
			'publication_date' => 'date',
			'genre' => 'max:255',
			'isbn' => 'max:17',
			'description' => 'max:2000'
		]);


		Book::create($request->all());
		return redirect()->route('books.index')
		                 ->with('success','Book created successfully');

	}

	/**
	 * Display the specified book.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{

		$book = Book::find( $id );

		return view( 'books.show', compact( 'book' ) );

	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		$book = Book::find($id);
		return view('books.edit',compact('book'));
	}

	/**
	 * Update the specified book in storage.
	 *
	 * @param  Request  $request
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Request $request, $id)
	{

		$this->validate($request, [
			'title' => 'required|max:255',
			'author' => 'required|max:255',
			'publication_date' => 'date',
			'genre' => 'max:255',
			'isbn' => 'max:17',
			'description' => 'max:2000'
		]);


		Book::find($id)->update($request->all());
		return redirect()->route('books.index')
		                 ->with('success','Book updated successfully');

	}

	/**
	 * Remove the specified book from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{

		Book::find($id)->delete();
		return redirect()->route('books.index')
		                 ->with('success','Item deleted successfully');

	}

}