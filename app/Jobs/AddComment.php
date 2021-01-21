<?php

namespace App\Jobs;

use App\Models\Comment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class AddComment implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $articleId;
    protected $subject;
    protected $body;
    protected $postedAt;


    /**
     * AddComment constructor.
     * @param int $articleId
     * @param string $subject
     * @param string $body
     * @param $postedAt
     */
    public function __construct(int $articleId, string $subject, string $body, $postedAt)
    {
        $this->articleId = $articleId;
        $this->subject = $subject;
        $this->body = $body;
        $this->postedAt = $postedAt;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $comment = new Comment();
        $comment->article_id = $this->articleId;
        $comment->subject = $this->subject;
        $comment->body = $this->body;
        $comment->posted_at = $this->postedAt;
        $comment->save();
    }
}
