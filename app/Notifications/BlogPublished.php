<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class BlogPublished extends Notification
{
    use Queueable;

    protected $blog;

    /**
     * Create a new notification instance.
     */
    public function __construct($blog)
    {
        $this->blog = $blog;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $url = url('/blogs/' . $this->blog->id);

        return (new MailMessage)
            ->subject('New Blog Published')
            ->line('A new blog post has been published on the platform!')
            ->action('Read Blog', $url)
            ->line('Thank you for being part of our community!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        $url = url('/blogs/' . $this->blog->id);

        return [
            'blog_id' => $this->blog->id,
            'title' => $this->blog->title,
            'message' => 'A new blog has been published: ' . $this->blog->title,
            'url' => $url,
        ];
    }
}
