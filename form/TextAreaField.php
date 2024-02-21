<?php

namespace evil\phpmvc\form;

use evil\phpmvc\form\BaseField;
use evil\phpmvc\Model;

class TextAreaField extends BaseField
{
    public Model $model;
    public string $attribute;

    public function renderInput(): string
    {
        return sprintf(
            '<textarea name="%s" class="form-field %s">%s</textarea>',
            $this->attribute,
            $this->model->hasError($this->attribute) ? 'is-invalid' : '',
            $this->model->{$this->attribute}
        );
    }
}
