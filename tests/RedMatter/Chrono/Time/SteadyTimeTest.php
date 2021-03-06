<?php
/**
 * @copyright 2009-2020 Red Matter Ltd (UK)
 */

namespace RedMatter\Chrono\Time;

use PHPUnit\Framework\TestCase;
use RedMatter\Chrono\Clock\CalendarClock;
use RedMatter\Chrono\Clock\SteadyClock;

class SteadyTimeTest extends TestCase
{
    public function testFromTime()
    {
        $clock = new CalendarClock();
        $steadyClock = new SteadyClock();

        $time = $clock->now();
        $steadyTime = $steadyClock->now();

        $steadyTimeFromTime = SteadyTime::fromTime($time);

        self::assertEquals(
            $steadyTime->secondsSinceEpoch()->value(),
            $steadyTimeFromTime->secondsSinceEpoch()->value(),
            '',
            0.0005 // for php < 7.3
        );
    }

    /**
     * @dataProvider providesTestToStringData
     * @param SteadyTime $time
     * @param $str
     */
    public function testToString(SteadyTime $time, $str)
    {
        self::assertEquals($str, (string)$time);
    }

    public function providesTestToStringData()
    {
        return [
            [new SteadyTime(1.0), '1000000000 ns since epoch'],
        ];
    }
}
