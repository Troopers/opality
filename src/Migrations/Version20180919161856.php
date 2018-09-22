<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180919161856 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE goal_evaluation (id INT AUTO_INCREMENT NOT NULL, goal_id INT NOT NULL, value VARCHAR(55) DEFAULT NULL, done TINYINT(1) NOT NULL, INDEX IDX_F2066123667D1AFE (goal_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE goal_evaluation ADD CONSTRAINT FK_F2066123667D1AFE FOREIGN KEY (goal_id) REFERENCES goal (id)');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649146B5EA3');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649D252108');
        $this->addSql('DROP INDEX IDX_8D93D649146B5EA3 ON user');
        $this->addSql('DROP INDEX IDX_8D93D649D252108 ON user');
        $this->addSql('ALTER TABLE user DROP leader_involvements_id, DROP advisor_involvements_id, CHANGE picture picture VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE goal_evaluation');
        $this->addSql('ALTER TABLE `user` ADD leader_involvements_id INT DEFAULT NULL, ADD advisor_involvements_id INT DEFAULT NULL, CHANGE picture picture VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE `user` ADD CONSTRAINT FK_8D93D649146B5EA3 FOREIGN KEY (leader_involvements_id) REFERENCES involvement (id)');
        $this->addSql('ALTER TABLE `user` ADD CONSTRAINT FK_8D93D649D252108 FOREIGN KEY (advisor_involvements_id) REFERENCES involvement (id)');
        $this->addSql('CREATE INDEX IDX_8D93D649146B5EA3 ON `user` (leader_involvements_id)');
        $this->addSql('CREATE INDEX IDX_8D93D649D252108 ON `user` (advisor_involvements_id)');
    }
}
