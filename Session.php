<?php

namespace evil\phpmvc;

class Session
{
    protected const FLASH_KEY = "flash_messages";

    public function __construct()
    {
        session_start();

        $flashMessages = $_SESSION[self::FLASH_KEY] ?? [];

        foreach ($flashMessages as $key => &$flashMessage) {
            //Mark A Message To Be Removed
            $flashMessage["remove"] = true;
        }
        $_SESSION[self::FLASH_KEY] = $flashMessages;
    }

    public function setFlashMessage($key, $message)
    {
        $_SESSION[self::FLASH_KEY][$key] = [
            "remove" => false,
            "value" => $message
        ];
    }

    public function getFlashMessage($key)
    {
        return $_SESSION[self::FLASH_KEY][$key]["value"] ?? false;
    }

    public function set($key, $value){
        $_SESSION[$key] = $value;
    }

    public function get($key){
        return $_SESSION[$key] ?? false;
    }

    public function remove($key){
        unset($_SESSION[$key]);
    }

    public function __destruct()
    {
        $flashMessages = $_SESSION[self::FLASH_KEY] ?? [];

        foreach ($flashMessages as $key => &$flashMessage) {
            //Marked Message To Be Removed
            if($flashMessage["remove"]){
                unset($flashMessages[$key]);
            }
        }
        $_SESSION[self::FLASH_KEY] = $flashMessages;
    }
}
