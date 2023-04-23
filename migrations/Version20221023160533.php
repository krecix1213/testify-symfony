<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221023160533 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE "answers_id_seq" INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE "exams_id_seq" INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE "examsUsers_id_seq" INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE "expires_id_seq" INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE "groups_id_seq" INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE "groupsUsers_id_seq" INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE "multiAnswer_id_seq" INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE "multiAnswerCorrect_id_seq" INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE "questions_id_seq" INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE "results_id_seq" INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE "answers" (id INT NOT NULL, question_id_id INT NOT NULL, answer_id INT NOT NULL, answer_text TEXT NOT NULL, ts TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_50D0C6064FAF8F53 ON "answers" (question_id_id)');
        $this->addSql('CREATE TABLE "exams" (id INT NOT NULL, name VARCHAR(255) NOT NULL, time INT DEFAULT 0 NOT NULL, random BOOLEAN DEFAULT false NOT NULL, x_ofy INT DEFAULT 0 NOT NULL, progressive BOOLEAN DEFAULT false NOT NULL, rules_page BOOLEAN DEFAULT false NOT NULL, rules_page_text TEXT DEFAULT NULL, ts TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT \'now()\' NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE "examsUsers" (id INT NOT NULL, exam_id_fk_id INT NOT NULL, user_id_fk_id INT DEFAULT NULL, group_id_fk_id INT DEFAULT NULL, ts TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_F7C9491089617D3 ON "examsUsers" (exam_id_fk_id)');
        $this->addSql('CREATE INDEX IDX_F7C94910AB7FBCE0 ON "examsUsers" (user_id_fk_id)');
        $this->addSql('CREATE INDEX IDX_F7C9491042C2149F ON "examsUsers" (group_id_fk_id)');
        $this->addSql('CREATE TABLE "expires" (id INT NOT NULL, exam_id_fk_id INT NOT NULL, user_id_fk_id INT NOT NULL, group_id_fk_id INT DEFAULT NULL, expire_time TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, ts TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_9A9C688C89617D3 ON "expires" (exam_id_fk_id)');
        $this->addSql('CREATE INDEX IDX_9A9C688CAB7FBCE0 ON "expires" (user_id_fk_id)');
        $this->addSql('CREATE INDEX IDX_9A9C688C42C2149F ON "expires" (group_id_fk_id)');
        $this->addSql('CREATE TABLE "groups" (id INT NOT NULL, name VARCHAR(255) NOT NULL, ts TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE "groupsUsers" (id INT NOT NULL, ts TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE groups_users_user (groups_users_id INT NOT NULL, user_id INT NOT NULL, PRIMARY KEY(groups_users_id, user_id))');
        $this->addSql('CREATE INDEX IDX_19D2E187DCA14EE2 ON groups_users_user (groups_users_id)');
        $this->addSql('CREATE INDEX IDX_19D2E187A76ED395 ON groups_users_user (user_id)');
        $this->addSql('CREATE TABLE groups_users_groups (groups_users_id INT NOT NULL, groups_id INT NOT NULL, PRIMARY KEY(groups_users_id, groups_id))');
        $this->addSql('CREATE INDEX IDX_1DA9F2FEDCA14EE2 ON groups_users_groups (groups_users_id)');
        $this->addSql('CREATE INDEX IDX_1DA9F2FEF373DCF ON groups_users_groups (groups_id)');
        $this->addSql('CREATE TABLE "multiAnswer" (id INT NOT NULL, user_id_fk_id INT NOT NULL, exam_id_fk_id INT NOT NULL, question_id_fk_id INT NOT NULL, answer INT NOT NULL, ts TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_772E53AB7FBCE0 ON "multiAnswer" (user_id_fk_id)');
        $this->addSql('CREATE INDEX IDX_772E5389617D3 ON "multiAnswer" (exam_id_fk_id)');
        $this->addSql('CREATE INDEX IDX_772E5328FAE8EC ON "multiAnswer" (question_id_fk_id)');
        $this->addSql('CREATE TABLE "multiAnswerCorrect" (id INT NOT NULL, examd_id_fk_id INT NOT NULL, question_id_fk_id INT NOT NULL, answer INT NOT NULL, ts TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_60C4F9944AB26116 ON "multiAnswerCorrect" (examd_id_fk_id)');
        $this->addSql('CREATE INDEX IDX_60C4F99428FAE8EC ON "multiAnswerCorrect" (question_id_fk_id)');
        $this->addSql('CREATE TABLE "questions" (id INT NOT NULL, exam_id_fk_id INT NOT NULL, question_type INT NOT NULL, question_number INT NOT NULL, question_title TEXT NOT NULL, answer_correct INT DEFAULT NULL, answer_correct_multi BOOLEAN DEFAULT NULL, ts TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_8ADC54D589617D3 ON "questions" (exam_id_fk_id)');
        $this->addSql('CREATE TABLE "results" (id INT NOT NULL, exam_id_fk_id INT NOT NULL, user_id_fk_id INT NOT NULL, question_id_fk_id INT NOT NULL, answer_int INT NOT NULL, answer_text TEXT NOT NULL, answer_multi_check BOOLEAN DEFAULT NULL, ts TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_9FA3E41489617D3 ON "results" (exam_id_fk_id)');
        $this->addSql('CREATE INDEX IDX_9FA3E414AB7FBCE0 ON "results" (user_id_fk_id)');
        $this->addSql('CREATE INDEX IDX_9FA3E41428FAE8EC ON "results" (question_id_fk_id)');
        $this->addSql('ALTER TABLE "answers" ADD CONSTRAINT FK_50D0C6064FAF8F53 FOREIGN KEY (question_id_id) REFERENCES "questions" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE "examsUsers" ADD CONSTRAINT FK_F7C9491089617D3 FOREIGN KEY (exam_id_fk_id) REFERENCES "exams" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE "examsUsers" ADD CONSTRAINT FK_F7C94910AB7FBCE0 FOREIGN KEY (user_id_fk_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE "examsUsers" ADD CONSTRAINT FK_F7C9491042C2149F FOREIGN KEY (group_id_fk_id) REFERENCES "groups" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE "expires" ADD CONSTRAINT FK_9A9C688C89617D3 FOREIGN KEY (exam_id_fk_id) REFERENCES "exams" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE "expires" ADD CONSTRAINT FK_9A9C688CAB7FBCE0 FOREIGN KEY (user_id_fk_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE "expires" ADD CONSTRAINT FK_9A9C688C42C2149F FOREIGN KEY (group_id_fk_id) REFERENCES "groups" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE groups_users_user ADD CONSTRAINT FK_19D2E187DCA14EE2 FOREIGN KEY (groups_users_id) REFERENCES "groupsUsers" (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE groups_users_user ADD CONSTRAINT FK_19D2E187A76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE groups_users_groups ADD CONSTRAINT FK_1DA9F2FEDCA14EE2 FOREIGN KEY (groups_users_id) REFERENCES "groupsUsers" (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE groups_users_groups ADD CONSTRAINT FK_1DA9F2FEF373DCF FOREIGN KEY (groups_id) REFERENCES "groups" (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE "multiAnswer" ADD CONSTRAINT FK_772E53AB7FBCE0 FOREIGN KEY (user_id_fk_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE "multiAnswer" ADD CONSTRAINT FK_772E5389617D3 FOREIGN KEY (exam_id_fk_id) REFERENCES "exams" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE "multiAnswer" ADD CONSTRAINT FK_772E5328FAE8EC FOREIGN KEY (question_id_fk_id) REFERENCES "questions" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE "multiAnswerCorrect" ADD CONSTRAINT FK_60C4F9944AB26116 FOREIGN KEY (examd_id_fk_id) REFERENCES "exams" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE "multiAnswerCorrect" ADD CONSTRAINT FK_60C4F99428FAE8EC FOREIGN KEY (question_id_fk_id) REFERENCES "questions" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE "questions" ADD CONSTRAINT FK_8ADC54D589617D3 FOREIGN KEY (exam_id_fk_id) REFERENCES "exams" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE "results" ADD CONSTRAINT FK_9FA3E41489617D3 FOREIGN KEY (exam_id_fk_id) REFERENCES "exams" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE "results" ADD CONSTRAINT FK_9FA3E414AB7FBCE0 FOREIGN KEY (user_id_fk_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE "results" ADD CONSTRAINT FK_9FA3E41428FAE8EC FOREIGN KEY (question_id_fk_id) REFERENCES "questions" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE "answers_id_seq" CASCADE');
        $this->addSql('DROP SEQUENCE "exams_id_seq" CASCADE');
        $this->addSql('DROP SEQUENCE "examsUsers_id_seq" CASCADE');
        $this->addSql('DROP SEQUENCE "expires_id_seq" CASCADE');
        $this->addSql('DROP SEQUENCE "groups_id_seq" CASCADE');
        $this->addSql('DROP SEQUENCE "groupsUsers_id_seq" CASCADE');
        $this->addSql('DROP SEQUENCE "multiAnswer_id_seq" CASCADE');
        $this->addSql('DROP SEQUENCE "multiAnswerCorrect_id_seq" CASCADE');
        $this->addSql('DROP SEQUENCE "questions_id_seq" CASCADE');
        $this->addSql('DROP SEQUENCE "results_id_seq" CASCADE');
        $this->addSql('ALTER TABLE "answers" DROP CONSTRAINT FK_50D0C6064FAF8F53');
        $this->addSql('ALTER TABLE "examsUsers" DROP CONSTRAINT FK_F7C9491089617D3');
        $this->addSql('ALTER TABLE "examsUsers" DROP CONSTRAINT FK_F7C94910AB7FBCE0');
        $this->addSql('ALTER TABLE "examsUsers" DROP CONSTRAINT FK_F7C9491042C2149F');
        $this->addSql('ALTER TABLE "expires" DROP CONSTRAINT FK_9A9C688C89617D3');
        $this->addSql('ALTER TABLE "expires" DROP CONSTRAINT FK_9A9C688CAB7FBCE0');
        $this->addSql('ALTER TABLE "expires" DROP CONSTRAINT FK_9A9C688C42C2149F');
        $this->addSql('ALTER TABLE groups_users_user DROP CONSTRAINT FK_19D2E187DCA14EE2');
        $this->addSql('ALTER TABLE groups_users_user DROP CONSTRAINT FK_19D2E187A76ED395');
        $this->addSql('ALTER TABLE groups_users_groups DROP CONSTRAINT FK_1DA9F2FEDCA14EE2');
        $this->addSql('ALTER TABLE groups_users_groups DROP CONSTRAINT FK_1DA9F2FEF373DCF');
        $this->addSql('ALTER TABLE "multiAnswer" DROP CONSTRAINT FK_772E53AB7FBCE0');
        $this->addSql('ALTER TABLE "multiAnswer" DROP CONSTRAINT FK_772E5389617D3');
        $this->addSql('ALTER TABLE "multiAnswer" DROP CONSTRAINT FK_772E5328FAE8EC');
        $this->addSql('ALTER TABLE "multiAnswerCorrect" DROP CONSTRAINT FK_60C4F9944AB26116');
        $this->addSql('ALTER TABLE "multiAnswerCorrect" DROP CONSTRAINT FK_60C4F99428FAE8EC');
        $this->addSql('ALTER TABLE "questions" DROP CONSTRAINT FK_8ADC54D589617D3');
        $this->addSql('ALTER TABLE "results" DROP CONSTRAINT FK_9FA3E41489617D3');
        $this->addSql('ALTER TABLE "results" DROP CONSTRAINT FK_9FA3E414AB7FBCE0');
        $this->addSql('ALTER TABLE "results" DROP CONSTRAINT FK_9FA3E41428FAE8EC');
        $this->addSql('DROP TABLE "answers"');
        $this->addSql('DROP TABLE "exams"');
        $this->addSql('DROP TABLE "examsUsers"');
        $this->addSql('DROP TABLE "expires"');
        $this->addSql('DROP TABLE "groups"');
        $this->addSql('DROP TABLE "groupsUsers"');
        $this->addSql('DROP TABLE groups_users_user');
        $this->addSql('DROP TABLE groups_users_groups');
        $this->addSql('DROP TABLE "multiAnswer"');
        $this->addSql('DROP TABLE "multiAnswerCorrect"');
        $this->addSql('DROP TABLE "questions"');
        $this->addSql('DROP TABLE "results"');
    }
}
