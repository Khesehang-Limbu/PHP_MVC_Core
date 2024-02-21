<?php
namespace evil\phpmvc;
use evil\phpmvc\db\DbModel;

abstract class UserModel extends DbModel {
    abstract public function getDisplayName() : string;
}
