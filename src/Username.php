<?php

declare(strict_types=1);

namespace Neighborhoods\PhpUnitFirstSteps;

class Username
{
    /**
     * @var string
     */
    private const ALLOWABLE_CHARACTERS_REGEX = "/[A-Za-z0-9]+/u";

    /**
     * @var string
     */
    private $username;

    /**
     * Constructor.
     *
     * @param string $username
     */
    public function __construct(string $username)
    {
        $this->setUsername($username);
    }

    /**
     * @return string
     */
    public function username(): string
    {
        return $this->username;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->username;
    }

    /**
     * Validate and set the username
     *
     * @param string $username
     * @return void
     * @throws \InvalidArgumentException
     */
    private function setUsername(string $username): void
    {
        if (strlen($username) < 1 || strlen($username) > 128) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid username \"%s\": username must be between 1 and 128 characters in length.",
                    $username
                )
            );
        }

        if (!preg_match(static::ALLOWABLE_CHARACTERS_REGEX, $username)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid username \"%s\": username contains invalid characters.",
                    $username
                )
            );
        }

        $this->username = $username;
    }
}
