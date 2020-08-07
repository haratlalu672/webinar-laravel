<?php

namespace App\Http\Controllers;

use App\article;
use App\Http\Requests\ArticleRequest;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = article::all();
        return view('admin.article', compact('articles'));
    }
    public function guestArticle()
    {
        // $articles = factory(Article::class, 10)->create();
        $search = '';
        $articles = article::where('is_published', true)->paginate(5);
        return view('guest.article', compact('articles', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArticleRequest $request)
    {
        article::create($this->articleStore($request));
        return redirect('article')->with('alert', 'Data Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(article $article)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit(article $article)
    {
        return view('admin.edit', compact('article'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(ArticleRequest $request, article $article)
    {
        $this->deleteThumbnail($article);
        $article->update($this->articleStore($request));
        return redirect('article')->with('alert', 'Data Berhasil Diedit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(article $article)
    {
        $this->deleteThumbnail($article);
        article::destroy($article->id);
        return redirect('article')->with('alert', 'Data Berhasil Dihapus');
    }

    public function articleStore()
    {
        if (request()->file('thumbnail') != null) {
            $thumbnail = request()->file('thumbnail');
            $name = $thumbnail->getClientOriginalName();
            $thumbnail->storeAs('public/img', $name);
        } else {
            $name = 'default.jpg';
        }
        return [
            'title' => \request('title'),
            'slug' => \Str::slug(request('title')),
            'content' => \request('content'),
            'thumbnail' => 'img/' . $name,
            'is_published' => \request('is_published'),
            'user_id' => auth()->user()->id,
        ];
    }

    public function deleteThumbnail(article $article)
    {
        if ($article->thumbnail != "img/default.jpg") {
            \Storage::delete('public/' . $article->thumbnail);
        }
    }

    public function detail(article $article)
    {
        return view('guest.detail', compact('article'));
    }

    public function search(Request $request)
    {
        // $this->validate($request, [
        //     'search'    => 'required|max:255',
        // ],[
        //     'search.required' => 'Pencarian tidak boleh kosong',
        //     'search.max' => 'Maksimal 255 huruf'
        // ]);
        $search = $request->search;
        $articles = \DB::table('articles')
            ->where('title', 'like', "%" . $search . "%")
            ->where('is_published', true)
            ->paginate(5);
        return \view('guest.article', compact('articles', 'search'));
    }
}
