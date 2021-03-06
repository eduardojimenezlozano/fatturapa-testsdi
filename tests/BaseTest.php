<?php
declare(strict_types=1);

define("BASEROOT", $_SERVER['DOCUMENT_ROOT']);
require 'core/vendor/autoload.php';

use FatturaPa\Core\Actors\Base;

final class BaseTest extends PHPUnit\Framework\TestCase
{
    public function testSpeedZero()
    {
        Base::resetTime();
        Base::setSpeed(0);
        $datetime1 = Base::getDateTime();
        sleep(5);
        $datetime2 = Base::getDateTime();
        $this->assertEquals($datetime1, $datetime2);
    }
    public function testSpeedOne()
    {
        Base::resetTime();
        $datetime1 = Base::getDateTime();
        sleep(5);
        $datetime2 = Base::getDateTime();
        $this->assertEquals($datetime1->getTimeStamp() + 5, $datetime2->getTimeStamp());
    }
    public function testSpeedOneThousand()
    {
        Base::resetTime();
        Base::setSpeed(1000);
        $datetime1 = Base::getDateTime();
        sleep(5);
        $datetime2 = Base::getDateTime();
        $this->assertEquals($datetime1->getTimeStamp() + 5000, $datetime2->getTimeStamp());
    }

    public function testSpeedStillOneThousand()
    {
        $datetime1 = Base::getDateTime();
        sleep(5);
        $datetime2 = Base::getDateTime();
        $this->assertEquals($datetime1->getTimeStamp() + 5000, $datetime2->getTimeStamp());
    }

    public function testSetDateTime()
    {
        $datetime0 = new DateTime('2019-01-01T00:00:00Z');
        Base::setDateTime($datetime0);
        $datetime1 = Base::getDateTime();
        $this->assertEquals($datetime0->getTimeStamp(), $datetime1->getTimeStamp());
        sleep(5);
        $datetime2 = Base::getDateTime();
        $this->assertEquals($datetime1->getTimeStamp() + 5000, $datetime2->getTimeStamp());
    }
}
