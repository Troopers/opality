<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181210150244 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE evaluation (id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', user_id INT NOT NULL, status VARCHAR(15) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_1323A575A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE meeting (id INT AUTO_INCREMENT NOT NULL, note_taker_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, date DATETIME NOT NULL, agenda LONGTEXT DEFAULT NULL, notes LONGTEXT DEFAULT NULL, duration INT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_F515E1391B75A85D (note_taker_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE meeting_user (meeting_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_61622E9B67433D9C (meeting_id), INDEX IDX_61622E9BA76ED395 (user_id), PRIMARY KEY(meeting_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE objective (id INT AUTO_INCREMENT NOT NULL, parent_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, slug VARCHAR(128) NOT NULL, description LONGTEXT DEFAULT NULL, measurement VARCHAR(255) DEFAULT NULL, attainable TINYINT(1) NOT NULL, ambitious TINYINT(1) DEFAULT NULL, accomplished TINYINT(1) NOT NULL, planned_date DATE DEFAULT NULL, recurrence ENUM(\'weekly\', \'monthly\', \'quarterly\', \'yearly\') DEFAULT NULL COMMENT \'(DC2Type:RecurrenceType)\', created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, UNIQUE INDEX UNIQ_B996F101989D9B62 (slug), INDEX IDX_B996F101727ACA70 (parent_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE objective_user (objective_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_1F952F9373484933 (objective_id), INDEX IDX_1F952F93A76ED395 (user_id), PRIMARY KEY(objective_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE objective_team (objective_id INT NOT NULL, team_id INT NOT NULL, INDEX IDX_56E65FC573484933 (objective_id), INDEX IDX_56E65FC5296CD8AE (team_id), PRIMARY KEY(objective_id, team_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE evaluation_objective (id INT AUTO_INCREMENT NOT NULL, objective_id INT NOT NULL, evaluation_id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', value VARCHAR(55) DEFAULT NULL, confidence ENUM(\'0\', \'1\', \'2\', \'3\', \'4\', \'5\', \'6\', \'7\') DEFAULT NULL COMMENT \'(DC2Type:DegreeConfidenceType)\', created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_6B963A8573484933 (objective_id), INDEX IDX_6B963A85456C5646 (evaluation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE involvement (id INT AUTO_INCREMENT NOT NULL, responsibility_id INT DEFAULT NULL, user_id INT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, discr VARCHAR(255) NOT NULL, mental_charge ENUM(\'0\', \'1\', \'2\') DEFAULT NULL COMMENT \'(DC2Type:CriticalityType)\', time_consumator ENUM(\'0\', \'1\', \'2\') DEFAULT NULL COMMENT \'(DC2Type:CriticalityType)\', anxiety ENUM(\'0\', \'1\', \'2\') DEFAULT NULL COMMENT \'(DC2Type:CriticalityType)\', palatability ENUM(\'0\', \'1\', \'2\') DEFAULT NULL COMMENT \'(DC2Type:CriticalityType)\', toughness ENUM(\'0\', \'1\', \'2\') DEFAULT NULL COMMENT \'(DC2Type:CriticalityType)\', INDEX IDX_EEBBC0B3385A88B7 (responsibility_id), INDEX IDX_EEBBC0B3A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commitment (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commitment_core_value (commitment_id INT NOT NULL, core_value_id INT NOT NULL, INDEX IDX_7D460C06680FAE08 (commitment_id), INDEX IDX_7D460C0646E2CD01 (core_value_id), PRIMARY KEY(commitment_id, core_value_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commitment_objective (commitment_id INT NOT NULL, objective_id INT NOT NULL, INDEX IDX_AA9D5AB680FAE08 (commitment_id), INDEX IDX_AA9D5AB73484933 (objective_id), PRIMARY KEY(commitment_id, objective_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE evaluation_commitment (id INT AUTO_INCREMENT NOT NULL, commitment_id INT NOT NULL, evaluation_id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', value VARCHAR(55) DEFAULT NULL, confidence ENUM(\'0\', \'1\', \'2\', \'3\', \'4\', \'5\', \'6\', \'7\') DEFAULT NULL COMMENT \'(DC2Type:DegreeConfidenceType)\', created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_19E78B49680FAE08 (commitment_id), INDEX IDX_19E78B49456C5646 (evaluation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE core_value (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(55) NOT NULL, slug VARCHAR(128) NOT NULL, description VARCHAR(255) DEFAULT NULL, color VARCHAR(6) NOT NULL, mantra VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, UNIQUE INDEX UNIQ_4BF679D4989D9B62 (slug), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE kuky (id INT AUTO_INCREMENT NOT NULL, author_id INT NOT NULL, message LONGTEXT DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_30897E51F675F31B (author_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE kuky_user (kuky_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_6F87817A2EE7EE7B (kuky_id), INDEX IDX_6F87817AA76ED395 (user_id), PRIMARY KEY(kuky_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE responsibility (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, criticality ENUM(\'0\', \'1\', \'2\') NOT NULL COMMENT \'(DC2Type:CriticalityType)\', enabled TINYINT(1) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE responsibility_objective (responsibility_id INT NOT NULL, objective_id INT NOT NULL, INDEX IDX_369F43D0385A88B7 (responsibility_id), INDEX IDX_369F43D073484933 (objective_id), PRIMARY KEY(responsibility_id, objective_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE team (id INT AUTO_INCREMENT NOT NULL, parent_id INT DEFAULT NULL, name VARCHAR(55) NOT NULL, slug VARCHAR(128) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, UNIQUE INDEX UNIQ_C4E0A61F989D9B62 (slug), INDEX IDX_C4E0A61F727ACA70 (parent_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE team_user (team_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_5C722232296CD8AE (team_id), INDEX IDX_5C722232A76ED395 (user_id), PRIMARY KEY(team_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ultimate_goal (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, UNIQUE INDEX UNIQ_70566678A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, enabled TINYINT(1) DEFAULT \'0\' NOT NULL, firstname VARCHAR(55) DEFAULT NULL, lastname VARCHAR(55) DEFAULT NULL, picture VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE evaluation ADD CONSTRAINT FK_1323A575A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE meeting ADD CONSTRAINT FK_F515E1391B75A85D FOREIGN KEY (note_taker_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE meeting_user ADD CONSTRAINT FK_61622E9B67433D9C FOREIGN KEY (meeting_id) REFERENCES meeting (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE meeting_user ADD CONSTRAINT FK_61622E9BA76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE objective ADD CONSTRAINT FK_B996F101727ACA70 FOREIGN KEY (parent_id) REFERENCES objective (id)');
        $this->addSql('ALTER TABLE objective_user ADD CONSTRAINT FK_1F952F9373484933 FOREIGN KEY (objective_id) REFERENCES objective (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE objective_user ADD CONSTRAINT FK_1F952F93A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE objective_team ADD CONSTRAINT FK_56E65FC573484933 FOREIGN KEY (objective_id) REFERENCES objective (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE objective_team ADD CONSTRAINT FK_56E65FC5296CD8AE FOREIGN KEY (team_id) REFERENCES team (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE evaluation_objective ADD CONSTRAINT FK_6B963A8573484933 FOREIGN KEY (objective_id) REFERENCES objective (id)');
        $this->addSql('ALTER TABLE evaluation_objective ADD CONSTRAINT FK_6B963A85456C5646 FOREIGN KEY (evaluation_id) REFERENCES evaluation (id)');
        $this->addSql('ALTER TABLE involvement ADD CONSTRAINT FK_EEBBC0B3385A88B7 FOREIGN KEY (responsibility_id) REFERENCES responsibility (id)');
        $this->addSql('ALTER TABLE involvement ADD CONSTRAINT FK_EEBBC0B3A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE commitment_core_value ADD CONSTRAINT FK_7D460C06680FAE08 FOREIGN KEY (commitment_id) REFERENCES commitment (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE commitment_core_value ADD CONSTRAINT FK_7D460C0646E2CD01 FOREIGN KEY (core_value_id) REFERENCES core_value (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE commitment_objective ADD CONSTRAINT FK_AA9D5AB680FAE08 FOREIGN KEY (commitment_id) REFERENCES commitment (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE commitment_objective ADD CONSTRAINT FK_AA9D5AB73484933 FOREIGN KEY (objective_id) REFERENCES objective (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE evaluation_commitment ADD CONSTRAINT FK_19E78B49680FAE08 FOREIGN KEY (commitment_id) REFERENCES commitment (id)');
        $this->addSql('ALTER TABLE evaluation_commitment ADD CONSTRAINT FK_19E78B49456C5646 FOREIGN KEY (evaluation_id) REFERENCES evaluation (id)');
        $this->addSql('ALTER TABLE kuky ADD CONSTRAINT FK_30897E51F675F31B FOREIGN KEY (author_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE kuky_user ADD CONSTRAINT FK_6F87817A2EE7EE7B FOREIGN KEY (kuky_id) REFERENCES kuky (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE kuky_user ADD CONSTRAINT FK_6F87817AA76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE responsibility_objective ADD CONSTRAINT FK_369F43D0385A88B7 FOREIGN KEY (responsibility_id) REFERENCES responsibility (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE responsibility_objective ADD CONSTRAINT FK_369F43D073484933 FOREIGN KEY (objective_id) REFERENCES objective (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE team ADD CONSTRAINT FK_C4E0A61F727ACA70 FOREIGN KEY (parent_id) REFERENCES team (id)');
        $this->addSql('ALTER TABLE team_user ADD CONSTRAINT FK_5C722232296CD8AE FOREIGN KEY (team_id) REFERENCES team (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE team_user ADD CONSTRAINT FK_5C722232A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ultimate_goal ADD CONSTRAINT FK_70566678A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE evaluation_objective DROP FOREIGN KEY FK_6B963A85456C5646');
        $this->addSql('ALTER TABLE evaluation_commitment DROP FOREIGN KEY FK_19E78B49456C5646');
        $this->addSql('ALTER TABLE meeting_user DROP FOREIGN KEY FK_61622E9B67433D9C');
        $this->addSql('ALTER TABLE objective DROP FOREIGN KEY FK_B996F101727ACA70');
        $this->addSql('ALTER TABLE objective_user DROP FOREIGN KEY FK_1F952F9373484933');
        $this->addSql('ALTER TABLE objective_team DROP FOREIGN KEY FK_56E65FC573484933');
        $this->addSql('ALTER TABLE evaluation_objective DROP FOREIGN KEY FK_6B963A8573484933');
        $this->addSql('ALTER TABLE commitment_objective DROP FOREIGN KEY FK_AA9D5AB73484933');
        $this->addSql('ALTER TABLE responsibility_objective DROP FOREIGN KEY FK_369F43D073484933');
        $this->addSql('ALTER TABLE commitment_core_value DROP FOREIGN KEY FK_7D460C06680FAE08');
        $this->addSql('ALTER TABLE commitment_objective DROP FOREIGN KEY FK_AA9D5AB680FAE08');
        $this->addSql('ALTER TABLE evaluation_commitment DROP FOREIGN KEY FK_19E78B49680FAE08');
        $this->addSql('ALTER TABLE commitment_core_value DROP FOREIGN KEY FK_7D460C0646E2CD01');
        $this->addSql('ALTER TABLE kuky_user DROP FOREIGN KEY FK_6F87817A2EE7EE7B');
        $this->addSql('ALTER TABLE involvement DROP FOREIGN KEY FK_EEBBC0B3385A88B7');
        $this->addSql('ALTER TABLE responsibility_objective DROP FOREIGN KEY FK_369F43D0385A88B7');
        $this->addSql('ALTER TABLE objective_team DROP FOREIGN KEY FK_56E65FC5296CD8AE');
        $this->addSql('ALTER TABLE team DROP FOREIGN KEY FK_C4E0A61F727ACA70');
        $this->addSql('ALTER TABLE team_user DROP FOREIGN KEY FK_5C722232296CD8AE');
        $this->addSql('ALTER TABLE evaluation DROP FOREIGN KEY FK_1323A575A76ED395');
        $this->addSql('ALTER TABLE meeting DROP FOREIGN KEY FK_F515E1391B75A85D');
        $this->addSql('ALTER TABLE meeting_user DROP FOREIGN KEY FK_61622E9BA76ED395');
        $this->addSql('ALTER TABLE objective_user DROP FOREIGN KEY FK_1F952F93A76ED395');
        $this->addSql('ALTER TABLE involvement DROP FOREIGN KEY FK_EEBBC0B3A76ED395');
        $this->addSql('ALTER TABLE kuky DROP FOREIGN KEY FK_30897E51F675F31B');
        $this->addSql('ALTER TABLE kuky_user DROP FOREIGN KEY FK_6F87817AA76ED395');
        $this->addSql('ALTER TABLE team_user DROP FOREIGN KEY FK_5C722232A76ED395');
        $this->addSql('ALTER TABLE ultimate_goal DROP FOREIGN KEY FK_70566678A76ED395');
        $this->addSql('DROP TABLE evaluation');
        $this->addSql('DROP TABLE meeting');
        $this->addSql('DROP TABLE meeting_user');
        $this->addSql('DROP TABLE objective');
        $this->addSql('DROP TABLE objective_user');
        $this->addSql('DROP TABLE objective_team');
        $this->addSql('DROP TABLE evaluation_objective');
        $this->addSql('DROP TABLE involvement');
        $this->addSql('DROP TABLE commitment');
        $this->addSql('DROP TABLE commitment_core_value');
        $this->addSql('DROP TABLE commitment_objective');
        $this->addSql('DROP TABLE evaluation_commitment');
        $this->addSql('DROP TABLE core_value');
        $this->addSql('DROP TABLE kuky');
        $this->addSql('DROP TABLE kuky_user');
        $this->addSql('DROP TABLE responsibility');
        $this->addSql('DROP TABLE responsibility_objective');
        $this->addSql('DROP TABLE team');
        $this->addSql('DROP TABLE team_user');
        $this->addSql('DROP TABLE ultimate_goal');
        $this->addSql('DROP TABLE `user`');
    }
}
