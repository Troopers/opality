<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180906210040 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE involvement (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, responsibility_id INT DEFAULT NULL, discr VARCHAR(255) NOT NULL, mental_charge INT DEFAULT NULL, time_consumator INT DEFAULT NULL, anxiety INT DEFAULT NULL, palatability INT DEFAULT NULL, toughness INT DEFAULT NULL, INDEX IDX_EEBBC0B3A76ED395 (user_id), INDEX IDX_EEBBC0B3385A88B7 (responsibility_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE involvement ADD CONSTRAINT FK_EEBBC0B3A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE involvement ADD CONSTRAINT FK_EEBBC0B3385A88B7 FOREIGN KEY (responsibility_id) REFERENCES responsibility (id)');
        $this->addSql('ALTER TABLE responsibility CHANGE criticality criticality ENUM(\'minor\', \'medium\', \'critical\') NOT NULL COMMENT \'(DC2Type:CriticalityType)\'');
        $this->addSql('ALTER TABLE user ADD leader_involvements_id INT DEFAULT NULL, ADD advisor_involvements_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649146B5EA3 FOREIGN KEY (leader_involvements_id) REFERENCES involvement (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649D252108 FOREIGN KEY (advisor_involvements_id) REFERENCES involvement (id)');
        $this->addSql('CREATE INDEX IDX_8D93D649146B5EA3 ON user (leader_involvements_id)');
        $this->addSql('CREATE INDEX IDX_8D93D649D252108 ON user (advisor_involvements_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE `user` DROP FOREIGN KEY FK_8D93D649146B5EA3');
        $this->addSql('ALTER TABLE `user` DROP FOREIGN KEY FK_8D93D649D252108');
        $this->addSql('DROP TABLE involvement');
        $this->addSql('ALTER TABLE responsibility CHANGE criticality criticality VARCHAR(10) NOT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('DROP INDEX IDX_8D93D649146B5EA3 ON `user`');
        $this->addSql('DROP INDEX IDX_8D93D649D252108 ON `user`');
        $this->addSql('ALTER TABLE `user` DROP leader_involvements_id, DROP advisor_involvements_id');
    }
}
