<?php

namespace common\models\output;

class Response {

    public $success = false;
    public $message = null;
    public $data = null;

    public function __construct($success = false, $message = null, $data = null) {
        $this->success = $success;
        $this->message = $message;
        $this->data = $data;
    }

}
