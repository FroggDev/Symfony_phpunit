<?php
namespace App\Model;

use \InvalidArgumentException;

class Atom
{

    /** @var string Atom name */
    private $name;

    /** @var string Atom symbol */
    private $symbol;

    public function __construct($name,$symbol)
    {
        /*
        if(gettype($name)!='string' || gettype($symbol)!='string'){
            throw new InvalidArgumentException();
        }
        */

        if(!preg_match("/^[A-Z][a-z]+$/", $name)) {
            throw new InvalidArgumentException("Invalid name $name" );
        }

        if(!preg_match("/^[A-Z][a-z]?$/", $symbol)) {
            throw new InvalidArgumentException("Invalid symbol $symbol");
        }


        $this->name = $name;
        $this->symbol = $symbol;
    }

    /**
     * getter Atom name
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * getter Atom symbol
     * @return string
     */
    public function getSymbol(): string
    {
        return $this->symbol;
    }


}