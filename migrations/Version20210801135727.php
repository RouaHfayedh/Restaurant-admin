<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210801135727 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        $this->addSql('INSERT INTO user (`firstname`, `lastname`, `email`, `avatar`, `hash`, `slug`) values ("Raya","Naouar","raia.naouar@gamil.com","http://www.nretnil.com/avatar/barrel.jpg","$2y$13$zDPDE7xyFFpHz64k2Ui0fOPn0yaUemaG0v8qacYL527ITzAL9HgCa","raya-naouar");');

    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
