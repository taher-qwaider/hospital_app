<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReservationEmail extends Mailable
{
    use Queueable, SerializesModels;

    protected $user;
    protected $doctor;
    protected $date;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $doctor, $date)
    {
        //
        $this->user = $user;
        $this->doctor = $doctor;
        $this->date = $date;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('support@hospital.pah.ps')
            ->markdown('emails.ReservationEmail', [
            'user' =>$this->user,
            'doctor_name' => $this->doctor,
            'date' => $this->date
        ]);
    }
}
