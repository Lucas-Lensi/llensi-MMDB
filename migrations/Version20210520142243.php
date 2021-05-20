<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210520142243 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE movie_user (movie_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_7EF5F7448F93B6FC (movie_id), INDEX IDX_7EF5F744A76ED395 (user_id), PRIMARY KEY(movie_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_watchList (movie_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_94D1AA098F93B6FC (movie_id), INDEX IDX_94D1AA09A76ED395 (user_id), PRIMARY KEY(movie_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE movie_user ADD CONSTRAINT FK_7EF5F7448F93B6FC FOREIGN KEY (movie_id) REFERENCES movie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE movie_user ADD CONSTRAINT FK_7EF5F744A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_watchList ADD CONSTRAINT FK_94D1AA098F93B6FC FOREIGN KEY (movie_id) REFERENCES movie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_watchList ADD CONSTRAINT FK_94D1AA09A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE movie ADD release_date DATE DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE movie_user');
        $this->addSql('DROP TABLE user_watchList');
        $this->addSql('ALTER TABLE movie DROP release_date');
    }
}
