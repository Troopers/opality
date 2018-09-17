<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180911151550 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE involvement CHANGE mental_charge mental_charge ENUM(\'minor\', \'medium\', \'critical\') DEFAULT NULL COMMENT \'(DC2Type:CriticalityType)\', CHANGE time_consumator time_consumator ENUM(\'minor\', \'medium\', \'critical\') DEFAULT NULL COMMENT \'(DC2Type:CriticalityType)\', CHANGE anxiety anxiety ENUM(\'minor\', \'medium\', \'critical\') DEFAULT NULL COMMENT \'(DC2Type:CriticalityType)\', CHANGE palatability palatability ENUM(\'minor\', \'medium\', \'critical\') DEFAULT NULL COMMENT \'(DC2Type:CriticalityType)\', CHANGE toughness toughness ENUM(\'minor\', \'medium\', \'critical\') DEFAULT NULL COMMENT \'(DC2Type:CriticalityType)\'');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE involvement CHANGE mental_charge mental_charge INT DEFAULT NULL, CHANGE time_consumator time_consumator INT DEFAULT NULL, CHANGE anxiety anxiety INT DEFAULT NULL, CHANGE palatability palatability INT DEFAULT NULL, CHANGE toughness toughness INT DEFAULT NULL');
    }
}
