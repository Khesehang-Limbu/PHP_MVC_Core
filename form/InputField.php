<?php

namespace evil\phpmvc\form;

use evil\phpmvc\Model;

class InputField extends BaseField
{
    public const TYPE_EMAIL = "email";
    public const TYPE_TEXT = "text";
    public const TYPE_PASSWORD = "password";
    public const TYPE_FILE = "file";

    public string $type;

    public function __construct(Model $model, string $attribute)
    {
        $this->type = self::TYPE_TEXT;
        parent::__construct($model, $attribute);
    }

    public function renderInput(): string
    {
        return sprintf(
            '
                <input type="%s" name="%s" id="%s" value="%s" class="%s" />
            ',
            $this->type,
            $this->attribute,
            $this->attribute,
            $this->model->{$this->attribute},
            $this->model->hasError($this->attribute) ? 'is-invalid' : '',
        );
    }

    public function passwordField()
    {
        $this->type = self::TYPE_PASSWORD;
        return $this;
    }

    public function emailField()
    {
        $this->type = self::TYPE_EMAIL;
        return $this;
    }

    public function imageField(){
        $this->type = self::TYPE_FILE;
        return $this;
    }
}
