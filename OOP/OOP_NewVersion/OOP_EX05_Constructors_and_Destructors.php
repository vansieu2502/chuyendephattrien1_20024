<?php
class BaseClass {
    // create __construct
    function __construct() {
        print "In BaseClass constructor\n";
    }
}

class SubClass extends BaseClass {
    function __construct() {
        // parent to __construct in BaseClass
        parent::__construct();
        print "In SubClass constructor\n";
    }
}

class OtherSubClass extends BaseClass {
    // inherits BaseClass's constructor
}
// In BaseClass constructor
$obj = new BaseClass();
// In BaseClass constructor
// In SubClass constructor
$obj = new SubClass();
// In BaseClass constructor
$obj = new OtherSubClass();
