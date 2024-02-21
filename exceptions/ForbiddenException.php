<?php
namespace evil\phpmvc\exceptions;

class ForbiddenException extends \Exception{
    protected $code = 403;
    protected $message = "You're not authenticated";
}
