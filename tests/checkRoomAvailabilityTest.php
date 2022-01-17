<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

class CheckRoomAvailabilityTest extends TestCase
{
    /**
     * function has to start with Test
     */
    public function testPremiumRoom(): void
    {
        $room = new Room(false);
        $user = new User(false);

        $this->assertTrue($room->canBook($user));
    }
}
