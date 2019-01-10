<?php
declare(strict_types=1);

namespace Neighborhoods\PhpUnitFirstSteps\Tests;

use Neighborhoods\PhpUnitFirstSteps\Username;
use PHPUnit\Framework\TestCase;

class UsernameTest extends TestCase
{

    /**
     * @test
     */
    public function createUsername() {
        $usernameString = "abcdefghijklmnopqrstuvwxyz1234567890abc";
        $username = new Username($usernameString);
        $this->assertSame($usernameString, $username->username());
    }

    /**
     * @test
     */
    public function testCreateUsernameWithEmptyString() {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Invalid username "": username must be between 1 and 128 characters in length.');

        new Username("");
    }

    /**
     * @test
     */
    public function testCreateUsernameWith128Characters() {
        $usernameString = "abcdefghijklmnopqrstuvwxyz1234567890abcdefghijklmnopqrstuvwxyz1234567890abcdefghijklmnopq" .
            "rstuvwxyz1234567890abcdefghijklmnopqrst";
        $username = new Username($usernameString);
        $this->assertSame($usernameString, $username->username());
    }

    /**
     * @test
     */
    public function testCreateUsernameWith129Characters() {
        $usernameString = "abcdefghijklmnopqrstuvwxyz1234567890abcdefghijklmnopqrstuvwxyz1234567890abcdefghijklmnopqrst
        uvwxyz1234567890abcdefghijklmnopqrstu";

        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage(
            sprintf('Invalid username "%s": username must be between 1 and 128 characters in length.', $usernameString)
        );

        new Username($usernameString);
    }

    /**
     * @test
     */
    public function testCreateUsernameWith1Character() {
        $usernameString = "a";
        $username = new Username($usernameString);
        $this->assertSame($usernameString, $username->username());
    }

    /**
     * @test
     */
    public function testCreateUsernameWithNonAlphanumericCharacter() {
        $usernameString = "abcdefghijklmnopqrstuvwxyz1234567890abc@";

        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage(
            sprintf('Invalid username "%s": username contains invalid characters.', $usernameString)
        );

        new Username($usernameString);
    }

}

