<?php

namespace App\Email;

use App\Entity\User;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Twig\Environment;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;

class Mailer
{
    /**
     * @var MailerInterface
     */
    private $mailer;

    private $twig;

    public function __construct(
        Environment $twig,
        MailerInterface $mailer
    )
    {
        $this->mailer = $mailer;
        $this->twig = $twig;
    }

    public function sendConfirmationEmail(User $user)
    {
        $message = (new TemplatedEmail())
            ->context([
                'user' => $user
            ])
            ->from('hello@example.com')
            ->to($user->getEmail())
            ->subject("Please confirm your account!")
            ->htmlTemplate('email/confirmation.html.twig');
        $this->mailer->send($message);
    }
}
