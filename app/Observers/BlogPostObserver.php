<?php

namespace App\Observers;

use App\Models\BlogPost;
use Carbon\Carbon;
use Str\Str;

class BlogPostObserver
{
    /**
     * Handle the blog post "created" event.
     *
     * @param  \App\Models\BlogPost  $blogPost
     * @return void
     */
    public function created(BlogPost $blogPost)
    {
        //
    }

    
    public function updating(BlogPost $blogPost)
    {
        // //ete mi tox phoxvela kveradarcni true
        // $test[]=$blogPost->isDirty();
        // //ete nshvac tox@ phoxvela kveradarcni true
        // $test[]=$blogPost->isDirty('is_published');
        // $test[]=$blogPost->isDirty('user_id');
        // //veradarcnuma nchvac toxi arjeq@
        // $test[]=$blogPost->getAttribute('is_published');
        // $test[]=$blogPost->is_published;
        // //veradarcnuma nchvac toxi arjeq@ minchev phoxvel@ (inchpes vor ka bazayum)
        // $test[]=$blogPost->getOriginal('is_published');
        // dd($test);

        $this->setPublishedAt($blogPost);
        $this->setSlug($blogPost);
    }
    /**
     * Handle the blog post "updated" event.
     *
     * @param  \App\Models\BlogPost  $blogPost
     * @return void
     */
    public function updated(BlogPost $blogPost)
    {
       //
    }

    protected function setPublishedAt(BlogPost $blogPost) {
        if (empty($blogPost->published_at)) {
            $blogPost->published_at=Carbon::now();
        }
    }
    protected function setSlug(BlogPost $blogPost) {
        if (empty($blogPost->slug)) {
            $blogPost->slug=Str::slug($blogPost->title);
        }
    }

    /**
     * Handle the blog post "deleted" event.
     *
     * @param  \App\Models\BlogPost  $blogPost
     * @return void
     */
    public function deleted(BlogPost $blogPost)
    {
        //
    }

    /**
     * Handle the blog post "restored" event.
     *
     * @param  \App\Models\BlogPost  $blogPost
     * @return void
     */
    public function restored(BlogPost $blogPost)
    {
        //
    }

    /**
     * Handle the blog post "force deleted" event.
     *
     * @param  \App\Models\BlogPost  $blogPost
     * @return void
     */
    public function forceDeleted(BlogPost $blogPost)
    {
        //
    }
}
