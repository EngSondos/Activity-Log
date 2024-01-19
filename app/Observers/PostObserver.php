<?php

namespace App\Observers;

use App\Models\Activity;
use App\Models\Post;

class PostObserver
{
    /**
     * Handle the Post "created" event.
     */
    public function created(Post $post): void
    {
        //
        Activity::create([
            'user_id'=>1, //auth()->id()
            'model_type'=>'post',
            'model_id'=>$post->id,
            'type'=>'create',
            'from'=>'',
            'to'=>json_encode(['title'=>$post->title,'description'=>$post->description,'image'=>$post->image])

    ]);
    }

    /**
     * Handle the Post "updated" event.
     */
    public function updated(Post $post): void
    {
        //
        $changed_data = $post->getChanges();
        $attributes = $post->getOriginal();
        $from =[];
        foreach($changed_data as $key=>$value){
            if($key == 'updated_at') continue;
            $from[$key] = $attributes[$key];
        }
        
        Activity::create([
            'user_id'=>1, //auth()->id()
            'model_type'=>'post',
            'model_id'=>$post->id,
            'type'=>'update',
            'from'=>json_encode($from),
            'to'=>json_encode($changed_data)

    ]);
    }

    /**
     * Handle the Post "deleted" event.
     */
    public function deleted(Post $post): void
    {
        //
        Activity::create([
            'user_id'=>1, //auth()->id()
            'model_type'=>'post',
            'model_id'=>$post->id,
            'type'=>'delete',
    ]);
    }

    /**
     * Handle the Post "restored" event.
     */
    public function restored(Post $post): void
    {
        //
           //
           Activity::create([
            'user_id'=>1, //auth()->id()
            'model_type'=>'post',
            'model_id'=>$post->id,
            'type'=>'restore',
    ]);
    }

    /**
     * Handle the Post "force deleted" event.
     */
    public function forceDeleted(Post $post): void
    {
        //
           //
           Activity::create([
            'user_id'=>1, //auth()->id()
            'model_type'=>'post',
            'model_id'=>$post->id,
            'type'=>'force_delete',
    ]);
    }
}
