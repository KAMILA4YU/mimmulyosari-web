<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\InfoKontak;

class BalasanKontak extends Mailable
{
    use Queueable, SerializesModels;

    public $nama;
    public $subjek;
    public $balasan;
    public $telepon;

    public function __construct($nama, $subjek, $balasan)
    {
        $this->nama = $nama;
        $this->subjek = $subjek;
        $this->balasan = $balasan;
        $this->telepon = InfoKontak::value('telepon');
    }

    public function build()
    {
        return $this->subject('Balasan: ' . $this->subjek)
                    ->view('emails.balasan-kontak');
    }
}
