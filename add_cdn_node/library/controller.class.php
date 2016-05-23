<?php
class Controller {

        protected $_controller;
        protected $_action;

        function __construct($model, $controller, $action) {

                $this->_controller = $controller;
                $this->_action = $action;
                $this->$model = new $model;
        }

        function __destruct() {
        }

}

