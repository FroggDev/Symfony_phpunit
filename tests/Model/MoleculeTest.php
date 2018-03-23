<?php
namespace App\Tests\Model;

use App\Model\Atom;
use ArgumentCountError;
use App\Model\Molecule;
use LogicException;
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

    /** @var Atom this is a mock */
    private static $atom;

    public function setUp()
    {
        if(!self::$atom) {
            self::$atom = $this->createConfiguredMock(Atom::class,[
               'getSymbol'=>'C'
            ]);

            /* OR
            self::$atom = $this
                ->getMockBuilder(Atom::class)
                ->disableOriginalConstructor()
                ->setMethods(['getName'])
                ->getMock();
            */
            /* OR
            self::$atom = $this
                ->createMock(Atom::class);
            self::$atom->method('getSymbol')->willReturn('C');
            */
        }
    }

    /*
     * Example
    public function testMock()
    {
        $atom = $this->createMock(Atom::class);
        //
        $service = $this
            ->getMockBuilder('NAMESPACE\OF\SERVICE')
            ->disableOriginalConstructor()
            ->setMethods(['getName'])
            ->getMock();
        $service->method('getName')->willReturn('Carbon');
    }
    */

    public function testMoleculeCanBeInstantiated()
    {
        $this->assertInstanceOf(Molecule::class, new Molecule('glucide'));
    }

    public function testMoleculeCannotBeCreated()
    {
        if (PHP_VERSION_ID >= 70100) {
            $this->expectException(ArgumentCountError::class);
        } else {
            $this->expectException(PHPUnit_Framework_Error_Warning::class);
        }

        $atome = new Molecule();
    }


    public function testAddAtomMustBeAnAtomType()
    {
        $this->expectException(\TypeError::class);
        $molecule = new Molecule('glucide');
        $molecule->addAtom('Carbon');
    }


    public function testAtomCanBeAddedInMolecule()
    {
        $molecule = new Molecule('glucide');
        $molecule->addAtom(self::$atom);

        # Test if atoms is array
        $this->assertInternalType('array',$molecule->getAtoms());
        # Test if count getAtoms return array with 1 element
        $this->assertCount(1, $molecule->getAtoms());
        # Test if same object before and after
        $this->assertSame($molecule,$molecule->addAtom(self::$atom));
        # Test if count getAtoms return array with 1 element
        $this->assertCount(2, $molecule->getAtoms());
    }

    public function testRetreiveArrayOfAtom()
    {
        $molecule = new Molecule('glucide');
        $molecule->addAtom(self::$atom)
                  ->addAtom(self::$atom);
        $molecule->getAtoms();

        # Test if atoms is array
        $this->assertEquals('array', gettype($molecule->getAtoms()));
        # Test if atom is type of Atom
        $this->assertContainsOnlyInstancesOf(Atom::class,$molecule->getAtoms());
    }

    public function testIfFusionHasAtLeastTwoAtomes()
    {
        if (method_exists($this, 'expectException')) {
            $this->expectException(LogicException::class);
        } else {
            # for PHPUnit < 5.2
            $this->setExpectedException(LogicException::class);
        }

        $molecule = new Molecule('glucide');
        $molecule->addAtom(self::$atom);

        $molecule->merge();
    }

    public function testIfNameIsTheMergeOfAtomesSymbols()
    {
        $molecule = new Molecule('glucide');
        $molecule->addAtom(self::$atom)
            ->addAtom(self::$atom)
            ->merge();

        $this->assertEquals($molecule->getName(),self::$atom->getSymbol().self::$atom->getSymbol());
    }

    public function testCannotGetNameWithoutMerge()
    {
        $molecule = new Molecule('glucide');
        $molecule->addAtom(self::$atom)
            ->addAtom(self::$atom);

        $this->assertEquals($molecule->getName(),null);
    }

}