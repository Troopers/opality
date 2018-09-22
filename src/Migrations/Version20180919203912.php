<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180919203912 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE core_value ADD mantra VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE goal_evaluation RENAME INDEX idx_f2066123667d1afe TO IDX_3177B472667D1AFE');
        $this->addSql('ALTER TABLE goal_evaluation RENAME INDEX idx_f2066123a76ed395 TO IDX_3177B472A76ED395');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE core_value DROP mantra');
        $this->addSql('ALTER TABLE goal_evaluation RENAME INDEX idx_3177b472667d1afe TO IDX_F2066123667D1AFE');
        $this->addSql('ALTER TABLE goal_evaluation RENAME INDEX idx_3177b472a76ed395 TO IDX_F2066123A76ED395');
    }
}
