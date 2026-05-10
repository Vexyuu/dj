<?php

namespace App\Tests\Entity;

use App\Entity\DjEntity;
use PHPUnit\Framework\TestCase;

class DjEntityTest extends TestCase
{
    public function testGettersAndSetters(): void
    {
        $dj = new DjEntity();
        
        $date = new \DateTime();
        
        $dj->setNom('Gretta')
           ->setPrenom('David')
           ->setEmail('david.gretta@example.com')
           ->setTel('0102030405')
           ->setUrlPortfolio('https://portfolio.com')
           ->setDateSoiree($date)
           ->setMateriel(true)
           ->setCouleur('#ff0000')
           ->setPhoto('dj-photo.jpg')
           ->setNbEnceintes(4)
           ->setPuissance(2000);

        $this->assertEquals('Gretta', $dj->getNom());
        $this->assertEquals('David', $dj->getPrenom());
        $this->assertEquals('david.gretta@example.com', $dj->getEmail());
        $this->assertEquals('0102030405', $dj->getTel());
        $this->assertEquals('https://portfolio.com', $dj->getUrlPortfolio());
        $this->assertEquals($date, $dj->getDateSoiree());
        $this->assertTrue($dj->isMateriel());
        $this->assertEquals('#ff0000', $dj->getCouleur());
        $this->assertEquals('dj-photo.jpg', $dj->getPhoto());
        $this->assertEquals(4, $dj->getNbEnceintes());
        $this->assertEquals(2000, $dj->getPuissance());
    }

    public function testIdIsNullByDefault(): void
    {
        $dj = new DjEntity();
        $this->assertNull($dj->getId());
    }
}
