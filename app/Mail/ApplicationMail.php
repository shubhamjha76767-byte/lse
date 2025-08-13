<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Http\UploadedFile;

class ApplicationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;
    public $photo1;
    public $photo2;
    public $photo3;
    public $photo4;

    public function __construct($data, UploadedFile $photo1, UploadedFile $photo2 = null, UploadedFile $photo3 = null, UploadedFile $photo4 = null)
    {
        $this->data = $data;
        $this->photo1 = $photo1;
        $this->photo2 = $photo2;
        $this->photo3 = $photo3;
        $this->photo4 = $photo4;
    }

    public function build()
    {
        $email = $this->subject('New Application Submission')
                      ->view('emails.application')
                      ->with(['data' => $this->data]);

        // Attach one by one (only if they exist)
        if ($this->photo1) {
            $email->attach($this->photo1->getRealPath(), [
                'as' => $this->photo1->getClientOriginalName(),
                'mime' => $this->photo1->getClientMimeType(),
            ]);
        }

        if ($this->photo2) {
            $email->attach($this->photo2->getRealPath(), [
                'as' => $this->photo2->getClientOriginalName(),
                'mime' => $this->photo2->getClientMimeType(),
            ]);
        }

        if ($this->photo3) {
            $email->attach($this->photo3->getRealPath(), [
                'as' => $this->photo3->getClientOriginalName(),
                'mime' => $this->photo3->getClientMimeType(),
            ]);
        }

        if ($this->photo4) {
            $email->attach($this->photo4->getRealPath(), [
                'as' => $this->photo4->getClientOriginalName(),
                'mime' => $this->photo4->getClientMimeType(),
            ]);
        }

        return $email;
    }
}
