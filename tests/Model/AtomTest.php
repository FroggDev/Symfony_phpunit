<?php

namespace App\Tests\Model;

use App\Model\Atom;
use ArgumentCountError;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;


/**
 * $atom = new Atom('Carbon','C');
 * un atome doit être instancié avec 2 chaine de caractère
 * dont la seconde doit contenir au maximum 2 caractères.
 *
 * $atom->getName();
 * $atom->getSymbol('C');
 */
class AtomTest extends TestCase
{
    /**
     * Test unitaire :
     * php bin/phpunit
     *
     * Test unitaire export:
     * php bin/phpunit --coverage-html public/output
     */

    public function testAtomCanBeCreated()
    {
        $this->assertInstanceOf(
            Atom::class,
            new Atom('Carbone', 'C')
        );
    }

    public function testAtomHasAName()
    {
        $atome = new Atom('Carbone', 'C');
        $this->assertEquals('Carbone', $atome->getName());
    }

    public function testAtomHasASymbol()
    {
        $atome = new Atom('Carbone', 'C');
        $this->assertEquals('C', $atome->getSymbol());
    }

    public function testAtomHasAnInvalidSymbol()
    {
        if (method_exists($this, 'expectException')) {
            $this->expectException(InvalidArgumentException::class);
        } else {
            # for PHPUnit < 5.2
            $this->setExpectedException(InvalidArgumentException::class);
        }

        $atome = new Atom('Carbone', 'CO2');
    }

    public function testAtomHasAnInvalidName()
    {
        if (method_exists($this, 'expectException')) {
            $this->expectException(InvalidArgumentException::class);
        } else {
            # for PHPUnit < 5.2
            $this->setExpectedException(InvalidArgumentException::class);
        }

        $atome = new Atom('Carbone1', 'C');
    }

    public function testAtomNameAndSymbolAreNotString()
    {
        $this->expectException(InvalidArgumentException::class);
        $atome = new Atom(1, 2);
    }

    public function testAtomCannotBeCreated()
    {
        if (PHP_VERSION_ID >= 70100) {
            $this->expectException(ArgumentCountError::class);
        } else {
            $this->expectException(PHPUnit_Framework_Error_Warning::class);
        }

        $atome = new Atom();
    }

}