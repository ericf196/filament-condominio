<?php

namespace App\Notifications;

use App\Models\CondominiumBill;
use App\Models\Owner;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class EmailCondominiumBill extends Notification
{
    use Queueable;

    public $owner;
    public $condominiumBill;

    /**
     * Create a new notification instance.
     * @param Owner $owner
     * @param CondominiumBill $condominiumBill
     */
    public function __construct(Owner $owner, CondominiumBill $condominiumBill)
    {
        $this->owner = $owner;
        $this->condominiumBill = $condominiumBill;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $urlBaseStorage = config('filesystems.disks.public.url');
        $urlBaseStorageRoot = config('filesystems.disks.public.root');

        $filePath = storage_path('app/public/01J1E34KJ0K1Q92RM6MXN0VR3G.pdf');

        return (new MailMessage)
                    ->line("Buenos dias propietario {$this->owner->first_name} {$this->owner->last_name}")
                    ->line("Aqui adjuntamos la factura de condominio {$this->condominiumBill->name} {$filePath}")
                    ->attach($filePath, [
                        'as' => 'invoice.pdf',
                        'mime' => 'application/pdf',
                    ]);

    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
