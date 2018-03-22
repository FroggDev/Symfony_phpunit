<?php
namespace App\Tests\Model;

use App\Model\Atom;
use ArgumentCountError;
use App\Model\Molecule;
use PHPUnit\Framework\TestCase;

/**
 * $molecule = new Molecule('glucide');
 * $molecule->addAtom(new Atom('Carbon','C'))
 *          ->addAtom(new Atom('Carbon','C'))
 * $molecule->getAtoms(); //retourne un tableau d atomes
 * $molecule->merge(); // La fusion ne doit fontionner que s'il y a au moins 2 molecules
 * $molecule->getName(); //Fait le merge et renvoi le nom de la molécule
 */

class MoleculeTest extends TestCase
{
    public function testMoleculeCannotBeCreated()
    {
        if (PHP_VERSION_ID >= 70100) {
            $this->expectException(ArgumentCountError::class);
        } else {
            $this->expectException(PHPUnit_Framework_Error_Warning::class);
        }

        $atome = new Molecule();
    }

    public function testRetreiveArrayOfAtom()
    {
        $molecule = new Molecule('glucide');
        $molecule->addAtom(new Atom('Carbon','C'))
                  ->addAtom(new Atom('Carbon','C'));
        $molecule->getAtoms();


    }

    public function testIfFusionHasAtLeastTwoAtomes()
    {
        $molecule = new Molecule('glucide');
        $molecule->addAtom(new Atom('Carbon','C'))
            ->addAtom(new Atom('Carbon','C'));
        $molecule->merge();

    }

    public function testIfNameIsTheMergeOfAtomesNames()
    {
        $molecule = new Molecule('glucide');
        $molecule->addAtom(new Atom('Carbon','C'))
            ->addAtom(new Atom('Carbon','C'));
        $molecule->merge();
        $molecule->getName();

    }
}