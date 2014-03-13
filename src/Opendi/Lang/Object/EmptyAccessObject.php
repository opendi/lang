<?php
namespace Opendi\Lang\Object;

class EmptyAccessObject {
    use PropertyAccess;

    private static $instance;

    private function __construct() {
    }

    public static function getInstance() {
        if (self::$instance == null) {
            self::$instance = new EmptyAccessObject();
        }
        return self::$instance;
    }

    public function __toString() {
        return '';
    }
}