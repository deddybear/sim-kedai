<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

// untuk mengirim data pendaftaran kepada user

class RegisterMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // dd(['data' => $this->data]);
        return $this->subject('Data Pendaftaran Pegawai' . $this->data['name'])
              ->view('mail.index', ['data' => $this->data])
              ->from('admin@admin.com', 'admin');
    }
}
