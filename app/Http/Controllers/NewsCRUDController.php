<?php
namespace App\Http\Controllers;
use App\Models\News;
use Illuminate\Http\Request;
class NewsCRUDController extends Controller
{
/**
* Display a listing of the resource.
*
* @return \Illuminate\Http\Response
*/
public function index()
{
$data['news'] = News::orderBy('id','desc')->paginate(10);
return view('news.index', $data);
}
/**
* Show the form for creating a new resource.
*
* @return \Illuminate\Http\Response
*/
public function create()
{
return view('news.create');
}
/**
* Store a newly created resource in storage.
*
* @param  \Illuminate\Http\Request  $request
* @return \Illuminate\Http\Response
*/
public function store(Request $request)
{
$request->validate([
'title' => 'required',
'slug' => 'required',
'description' => 'required'
]);

//dd('test');
$News = new News;
$News->title = $request->title;
$News->slug = $request->slug;
$News->description = $request->description;
$News->save();
return redirect()->route('news.index')
->with('success','News has been created successfully.');
}
/**
* Display the specified resource.
*
* @param  \App\News  $News
* @return \Illuminate\Http\Response
*/
public function show(News $News)
{
return view('news.show',compact('News'));
} 
/**
* Show the form for editing the specified resource.
*
* @param  \App\News  $News
* @return \Illuminate\Http\Response
*/
public function edit(News $News)
{
return view('news.edit',compact('News'));
}
/**
* Update the specified resource in storage.
*
* @param  \Illuminate\Http\Request  $request
* @param  \App\News  $News
* @return \Illuminate\Http\Response
*/
public function update(Request $request, $id)
{
$request->validate([
'title' => 'required',
'slug' => 'required',
'description' => 'required',
]);
$News = News::find($id);
$News->title = $request->title;
$News->slug = $request->slug;
$News->description = $request->description;
$News->save();
return redirect()->route('news.index')
->with('success','News Has Been updated successfully');
}
/**
* Remove the specified resource from storage.
*
* @param  \App\News  $News
* @return \Illuminate\Http\Response
*/
public function destroy(News $News)
{
$News->delete();
return redirect()->route('news.index')
->with('success','News has been deleted successfully');
}
}