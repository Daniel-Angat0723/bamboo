<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Project;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;


class dashboardController extends Controller
{
    function dashboard(){
        return view('dashboard');
    }
    function book(){
        //$books = Book::all();
        //return view('book', ['books' => $books]);
        return view('book');
    }
    function addBook(){
        return view('add-book');
    }
    function updateBook($id){
        $book = Book::find($id);
        return view('update-book',compact('book'));
    }
    function research(){
        //$researches = Research::all();
        //return view('research', ['researches' => $researches]);
        return view('research');
    }
    function addResearch(){
        return view('add-research');
    }
    function updateResearch($id){
        $research = Research::find($id);
        return view('update-research',compact('research'));
    }
    function video(){
        //$videos = Video::all();
        //return view('video', ['videos' => $videos]);
        return view('video');
    }
    function addVideo(){
        return view('add-video');
    }
    function updateVideo($id){
        $video = Video::find($id);
        return view('update-video',compact('video'));
    }
    function article(){
        //$articles = Article::all();
        //return view('article', ['articles' => $videos]);
        return view('article');
    }
    function addArticle(){
        return view('add-article');
    }
    function updateArticle($id){
        $article = Article::find($id);
        return view('update-article',compact('article'));
    }
    function upload_book(Request $request){

        $validator = Validator::make($request->all(), [
            //Validator for book forms
        ]);
        
        if ($validator->fails()) {
            return redirect()->route('book', http_build_query(array_merge(\Request::query(), ['error' => true])));
        }

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            
            // Generate a unique filename
            $filename = $file->hashName();

            // Store the file in the storage directory
            $path = $file->storeAs('public/images/uploaded_books', $filename);
            
            $book = new Book();
            $book->path = $path; // Store the hashed name in the database
            //input for book forms
            $book->save();
        
            return redirect()->route('book', http_build_query(array_merge(\Request::query(), ['uploaded' => true])));
        } 
        return redirect()->route('book', http_build_query(array_merge(\Request::query(), ['error' => true])));
    }
    function update_book(Request $request, $id) {
        $book = Book::find($id);
    
    $validator = Validator::make($request->all(), [
        //Validator for book forms
    ]);


    if ($validator->fails()) {
        return redirect()->route('book', http_build_query(array_merge(\Request::query(), ['error' => true])));
    }

    if ($request->hasFile('file')) {
        // Check if the old file exists and delete it
        if (Storage::exists($book->path)) {
            Storage::delete($book->path);
        }

        // Store the new file
        $file = $request->file('file');
        $filename = $file->hashName();
        $path = $file->storeAs('public/images/uploaded_books', $filename);

        // Update the book data with the new image path
        //dd($file,$path);

        $book->update([
            'path' => $path,
            //other update for book
        ]);

            return redirect()->route('book', http_build_query(array_merge(\Request::query(), ['updated' => true])));
        }
    
        // If no file is provided, update book data without changing the image path
        $book->update([
            //other update for book without update to images
        ]);
    
        return redirect()->route('book', http_build_query(array_merge(\Request::query(), ['updated' => true])));
    }

    function upload_research(Request $request){

        $validator = Validator::make($request->all(), [
            //Validator for research forms
        ]);
        
        if ($validator->fails()) {
            return redirect()->route('research', http_build_query(array_merge(\Request::query(), ['error' => true])));
        }

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            
            // Generate a unique filename
            $filename = $file->hashName();

            // Store the file in the storage directory
            $path = $file->storeAs('public/images/uploaded_researches', $filename);
            
            $research = new Research();
            $research->path = $path; // Store the hashed name in the database
            //input for research forms
            $research->save();
        
            return redirect()->route('research', http_build_query(array_merge(\Request::query(), ['uploaded' => true])));
        } 
        return redirect()->route('research', http_build_query(array_merge(\Request::query(), ['error' => true])));
    }
    function update_research(Request $request, $id) {
        $research = Research::find($id);
    
    $validator = Validator::make($request->all(), [
        //Validator for research forms
    ]);


    if ($validator->fails()) {
        return redirect()->route('research', http_build_query(array_merge(\Request::query(), ['error' => true])));
    }

    if ($request->hasFile('file')) {
        // Check if the old file exists and delete it
        if (Storage::exists($research->path)) {
            Storage::delete($research->path);
        }

        // Store the new file
        $file = $request->file('file');
        $filename = $file->hashName();
        $path = $file->storeAs('public/images/uploaded_researches', $filename);

        // Update the research data with the new image path
        //dd($file,$path);

        $research->update([
            'path' => $path,
            //other update for research
        ]);

            return redirect()->route('research', http_build_query(array_merge(\Request::query(), ['updated' => true])));
        }
    
        // If no file is provided, update research data without changing the image path
        $research->update([
            //other update for research without update to images
        ]);
    
        return redirect()->route('research', http_build_query(array_merge(\Request::query(), ['updated' => true])));
    }

    function upload_video(Request $request){

        $validator = Validator::make($request->all(), [
            //Validator for video forms
        ]);
        
        if ($validator->fails()) {
            return redirect()->route('video', http_build_query(array_merge(\Request::query(), ['error' => true])));
        }

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            
            // Generate a unique filename
            $filename = $file->hashName();

            // Store the file in the storage directory
            $path = $file->storeAs('public/images/uploaded_videos', $filename);
            
            $video = new Video();
            $video->path = $path; // Store the hashed name in the database
            //input for video forms
            $video->save();
        
            return redirect()->route('video', http_build_query(array_merge(\Request::query(), ['uploaded' => true])));
        } 
        return redirect()->route('video', http_build_query(array_merge(\Request::query(), ['error' => true])));
    }
    function update_video(Request $request, $id) {
        $video = Video::find($id);
    
    $validator = Validator::make($request->all(), [
        //Validator for video forms
    ]);


    if ($validator->fails()) {
        return redirect()->route('video', http_build_query(array_merge(\Request::query(), ['error' => true])));
    }

    if ($request->hasFile('file')) {
        // Check if the old file exists and delete it
        if (Storage::exists($video->path)) {
            Storage::delete($video->path);
        }

        // Store the new file
        $file = $request->file('file');
        $filename = $file->hashName();
        $path = $file->storeAs('public/images/uploaded_videos', $filename);

        // Update the video data with the new image path
        //dd($file,$path);

        $video->update([
            'path' => $path,
            //other update for video
        ]);

            return redirect()->route('video', http_build_query(array_merge(\Request::query(), ['updated' => true])));
        }
    
        // If no file is provided, update video data without changing the image path
        $video->update([
            //other update for video without update to images
        ]);
    
        return redirect()->route('video', http_build_query(array_merge(\Request::query(), ['updated' => true])));
    }

    function upload_article(Request $request){

        $validator = Validator::make($request->all(), [
            //Validator for article forms
        ]);
        
        if ($validator->fails()) {
            return redirect()->route('article', http_build_query(array_merge(\Request::query(), ['error' => true])));
        }

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            
            // Generate a unique filename
            $filename = $file->hashName();

            // Store the file in the storage directory
            $path = $file->storeAs('public/images/uploaded_articles', $filename);
            
            $article = new Article();
            $article->path = $path; // Store the hashed name in the database
            //input for article forms
            $article->save();
        
            return redirect()->route('article', http_build_query(array_merge(\Request::query(), ['uploaded' => true])));
        } 
        return redirect()->route('article', http_build_query(array_merge(\Request::query(), ['error' => true])));
    }
    function update_article(Request $request, $id) {
        $article = Article::find($id);
    
    $validator = Validator::make($request->all(), [
        //Validator for article forms
    ]);


    if ($validator->fails()) {
        return redirect()->route('article', http_build_query(array_merge(\Request::query(), ['error' => true])));
    }

    if ($request->hasFile('file')) {
        // Check if the old file exists and delete it
        if (Storage::exists($article->path)) {
            Storage::delete($article->path);
        }

        // Store the new file
        $file = $request->file('file');
        $filename = $file->hashName();
        $path = $file->storeAs('public/images/uploaded_articles', $filename);

        // Update the article data with the new image path
        //dd($file,$path);

        $article->update([
            'path' => $path,
            //other update for article
        ]);

            return redirect()->route('article', http_build_query(array_merge(\Request::query(), ['updated' => true])));
        }
    
        // If no file is provided, update article data without changing the image path
        $article->update([
            //other update for article without update to images
        ]);
    
        return redirect()->route('article', http_build_query(array_merge(\Request::query(), ['updated' => true])));
    }
}