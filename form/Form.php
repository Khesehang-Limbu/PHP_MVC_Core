<?php
namespace evil\phpmvc\form;
use evil\phpmvc\Model;

class Form {
    public static function begin($method, $action, $media = "") {
        echo "<form method='$method' action='$action' enctype='$media'>";
        return new Form();
    }

    public static function end(){
        echo "</form>";
    }

    public static function field(Model $model, string $attribute){
        return new InputField($model, $attribute);
    }
}
