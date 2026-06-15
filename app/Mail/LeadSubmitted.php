<?php

namespace App\Mail;

use App\Models\FormSubmission;
use Illuminate\Mail\Mailable;

class LeadSubmitted extends Mailable
{
    public function build()
    {
        $id = (int) app('lead_submission_id');

        $s = FormSubmission::query()
            ->select(FormSubmission::MAIL_COLUMNS)
            ->findOrFail($id);

        $brand   = config('mail.from.name') ?? config('app.name');
        $subject = $s->mailSubject($brand);

        return $this
            ->from(config('mail.from.address'), $brand)
            ->subject($subject)
            ->view('emails.leads.submitted', [
                's'       => $s,
                'brand'   => $brand,
                'subject' => $subject,
            ])
            ->text('emails.leads.submitted_text', [
                's'       => $s,
                'brand'   => $brand,
                'subject' => $subject,
            ]);
    }
}
