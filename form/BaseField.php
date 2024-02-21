<?php

namespace evil\phpmvc\form;
use evil\phpmvc\Model;

abstract class BaseField
{
    abstract function renderInput(): string;
    public Model $model;
    public string $attribute;

    public function __construct(Model $model, string $attribute)
    {
        $this->model = $model;
        $this->attribute = $attribute;
    }

    public function __toString()
    {
        return sprintf(
            '
            <div class="form-field">
                <label for="%s">%s:</label>
                %s
                <div class="invalid-feedback">
                    %s
                </div>
            </div>
            ',
            $this->attribute,
            $this->model->getLabel($this->attribute),
            $this->renderInput(),
            $this->model->getFirstError($this->attribute)
        );
    }
}
