<?php

class Pet
{
    public string $name;
    public int $type;
    public int $user;

    public function __construct($name, $type, $user)
    {
        $this->name = $name;
        $this->type = $type;
        $this->user = $user;
    }

}