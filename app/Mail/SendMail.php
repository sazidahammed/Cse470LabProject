<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;


// class SendMail extends Mailable
// {
//     use Queueable, SerializesModels;
//     public $data;

//     public function __construct($data)
//     {
//         $this->data = $data;
//     }

//     public function build()
//     {
//         // dd($this->data);
//         return $this->from('scoops@creamery.pk')->subject('New Customer Equiry')->view('admin.mail.invoice')->with('data', $this->data);
//     }
// }
class SendMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    protected $dynamic_data = '';
    public function __construct($data)
    {
        $this->dynamic_data = $data;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Check',
        );
    }

    // /**
    //  * Get the message content definition.
    //  *
    //  * @return \Illuminate\Mail\Mailables\Content
    //  */
    // public function content()
    // {
    //     return new Content(
    //         view: 'view.name',
    //     );
    // }

    // /**
    //  * Get the attachments for the message.
    //  *
    //  * @return array
    //  */
    // public function attachments()
    // {
    //     return [];
    // }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        return $this->view('admin.mail.invoice',[
            'data'=>$this->dynamic_data,
        ]);
    }

}
