<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Slider;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {
        $categories = Category::where('status', 'active')->take(3)->get();
        $sliders = Slider::take(3)->get();
        $articles = Article::take(3)->orderBy('created_at', 'desc')->get();
        return view('front.index', compact('categories', 'sliders', 'articles'));
    }

    public function det($id)
    {
        $articles = Article::find($id);
        return view('front.newsdetailes', compact('articles'));
    }

    public function all($id)
    {
        $categories = Category::findOrFail($id);
        $articles = Article::where('category_id', $id)->orderBy('id', 'desc')->paginate(4);
        return view('front.all-news', compact('categories', 'articles'));
    }

    public function showContact()
    {
        return view('front.contact');
    }

    public function storeContact(Request $request)
    {
        $validator = Validator($request->all(), [
            'fullname' => 'required'
        ]);
        if (!$validator->fails()) {
            $contacts = new Contact();
            $contacts->fullname = $request->get('fullname');
            $contacts->mobile = $request->get('mobile');
            $contacts->email = $request->get('email');
            $contacts->message = $request->get('message');
            $isSaved = $contacts->save();
            return response()->json([
                'icon' => 'success',
                'title' => 'Created is Successfully',
            ], 200);
        } else {
            return response()->json([
                'icon' => 'error',
                'title' => $validator->getMessageBag()->first(),
            ], 400);
        }
    }
}
