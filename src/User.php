<?php

/**
 * User
 *
 * A user of the system
 */
class User
{

    /**
     * First name
     * @var string
     */
    public $first_name;
    
    /**
     * Last name
     * @var string
     */
    public $surname;

    /**
     * Email address
     * @var string
     */
    public $email;

    /**
     * Mailer object
     * @var Mailer
     */
    protected $mailer;
    protected $mailer_callable;

    /**
     * Constructor
     *
     * @param string $email The user's email
     *
     * @return void
     */
    public function __construct(string $email, string $first_name, string $username)
    {
        $this->email = $email;
        $this->first_name = $first_name;
        $this->username = $username;
    }

    /**
     * Set the mailer dependency
     *
     * @param Mailer $mailer The Mailer object
     */
    public function setMailer(Mailer $mailer) {
        $this->mailer = $mailer;
    }

    /**
     * Mailer callable setter
     *
     * @param callable $mailer_callable A Mailer callable
     *
     * @return void
     */
    public function seCalllCall(callable $mailer_callable) {
        $this->mailer_callable = $mailer_callable;
    }

    /**
     * Get the user's full name from their first name and surname
     *
     * @return string The user's full name
     */
    public function getFullName()
    {
        return trim("$this->first_name $this->surname");
    }

    /**
     * Send the user a message
     *
     * @param string $message The message
     *
     * @return boolean True if sent, false otherwise
     */
    public function notify($message)
    {
        // return Mailer::send($this->email, $message);
        // return $this->mailer->send($this->email, $message);
        // return $this->mailer->sendMessage($this->email, $message);
        return call_user_func($this->mailer_callable, $this->email, $message);
    }
}
