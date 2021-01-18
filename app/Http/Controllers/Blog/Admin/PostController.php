<?php

namespace App\Http\Controllers\Blog\Admin;

// use Illuminate\Http\Request;
use App\Http\Requests\BlogPostUpdateRequest;
use App\Http\Requests\BlogPostCreateRequest;
use App\Repositories\BlogPostRepository;
use App\Repositories\BlogCategoryRepository;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use App\Models\BlogPost;

class PostController extends BaseController 
{
    /**
     * @var BlogPostRepository
     */
    private $blogPostRepository;

    /**
     * @var BlogCategoryRepository
     */
    private $blogCategoryRepository;

    public function __construct() {
        parent::__construct();
        $this->blogPostRepository=app(BlogPostRepository::class);
        $this->blogCategoryRepository=app(BlogCategoryRepository::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $paginator=$this->blogPostRepository->getAllWithPaginate(25);

        return view('blog.admin.posts.index',compact('paginator'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $item=new BlogPost();
        $categoryList=$this->blogCategoryRepository->getForComboBox();

        return view('blog.admin.posts.edit', compact('item','categoryList'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BlogpostCreateRequest $request)
    {
        $data=$request->input();
        $item = (new BlogPost())->create($data);

        if ($item) {
            return redirect()
            ->route('blog.admin.posts.edit',$item->id)
            ->with(['success'=>'успешно сохранено']);
        }else {
            return back()
            ->withErrors(['msg'=>'Ошибка сохранения'])
            ->withInput();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item=$this->blogPostRepository->getEdit($id);
        if(empty($item)){
            abort(404);
        }
        $categoryList=$this->blogCategoryRepository->getForComboBox();

        return view('blog.admin.posts.edit', compact('item','categoryList'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BlogpostUpdateRequest $request, $id)
    {
        $item=$this->blogPostRepository->getEdit($id);

        if(empty($item)){
            return back()
                ->withErrors(['msg'=>"Запись id=[$id] не найдена"])
                ->withInput();
        }

        $data=$request->all();

        //TODO phoxancela logikan observer
        // if (empty($data)) {
        //     $data['slug']=Str::slug($data['title']);
        // }
        // if (empty($item->published_at) && $data['is_published']) {
        //     $data['published_at']=Carbon::now()/* ->format('Y-m-d H:i:s') */;
        // }

        $result=$item->update($data);

        if ($result) {
            return redirect()
                ->route('blog.admin.posts.edit',$item->id)
                ->with(['success'=>'Успешно сахранено']);
        } else {
            return redirect()
                ->withErrors(['msg'=>"Ошибка сохранения"])
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        dd(__METHOD__,$id,request()->all());
    }
}
