<?php

namespace app\core\form;

use app\core\form\BaseField;
use app\core\Model;

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
