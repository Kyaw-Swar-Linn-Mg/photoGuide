<?php

namespace App\Http\Controllers;

use App\Book;
use App\ContentOwner;
use App\Publisher;
use App\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use File;


class BookController extends Controller
{
    public function getCoverPhoto($cover)
    {
        $file = Storage::disk('book_cover')->get($cover);
        return response($file,200);
    }

    public function getTable()
    {
        $books = Book::all();

        return view('books.book-table',compact('books'));
    }

    public function transaction()
    {

        $transactions = Transaction::select('*',DB::raw('COUNT(timetick) as count'))->groupBy('timetick')->paginate(5);
        return view('books.transaction_table',compact('transactions'));
    }

    public function createForm()
    {
        $content_owners = ContentOwner::all();
        $publishers = Publisher::all();
        return view('books.create',compact('content_owners','publishers'));
    }

    public function edit($id)
    {
        $content_owners = ContentOwner::all();
        $publishers = Publisher::all();
        $book = Book::where('idx',$id)->first();
        return view('books.update',compact('content_owners','publishers','book'));
    }

    public function storeBook(Request $request)
    {

        $this->validate($request,[
            'co_id'=>'required',
            'publisher_id'=>'required',
            'book_uniq_idx'=>'required',
            'book_name'=>'required',
            'cover_photo'=>'required',
            'prize'=>'required',
        ]);

        $book = new Book();
        $book->co_id=$request->co_id;
        $book->publisher_id=$request->publisher_id;
        $book->book_uniq_idx=$request->book_uniq_idx;
        $book->book_name=$request->book_name;

        $cover_name = time().'BOK'.'.jpg';
        $book->cover_photo=$cover_name;
        $book->prize=$request->prize;
        $book->save();

        $cover_file = $request->file('cover_photo');

        Storage::disk('book_cover')->put($cover_name,file($cover_file));

        return redirect()->route('book_table')->with(['success'=>'A New Book Created Successfully.']);
    }

    public function update(Request $request)
    {

        $book = Book::where('idx',$request['idx'])->first();

        DB::table('books')->where('idx',$request['idx'])->update([
            'book_name' => $request['book_name'] ? $request['book_name'] : $book->book_name,
            'prize' => $request['prize'] ? $request['prize'] : $book->prize,
            'book_uniq_idx' => $request['book_uniq_idx'] ? $request['book_uniq_idx'] : $book->book_uniq_idx,
            'publisher_id' => $request['publisher_id'] ? $request['publisher_id'] : $book->publisher_id,
            'cover_photo' => $request['cover_photo'] ? $this->updateImage($request->file('cover_photo'),$book->cover_photo) : $book->cover_photo,
            'co_id' => $request['co_id'] ? $request['co_id'] : $book->co_id
        ]);

        return redirect()->route('book_table')->with(['success'=>'A New Book Updated Successfully.']);
    }


    public function updateImage($new_file,$current_file)
    {
        Storage::disk('book_cover')->delete($current_file);
        $cover_name = time().'BOK'.'.jpg';
        Storage::disk('book_cover')->put($cover_name,file($new_file));

        return $cover_name;
    }

    public function delete($id)
    {
        $book = DB::table('books')->where('idx',$id)->delete();
        if($book) {
            return redirect()->back()->with(['success'=>'One book was deleted successfully!']);
        }
    }
}
