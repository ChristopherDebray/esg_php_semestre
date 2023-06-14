-- Adminer 4.8.1 PostgreSQL 15.1 (Debian 15.1-1.pgdg110+1) dump

DROP TABLE IF EXISTS "esgi_user" CASCADE;
DROP TABLE IF EXISTS "esgi_page" CASCADE;
DROP TABLE IF EXISTS "esgi_page_comment";
DROP TABLE IF EXISTS "esgi_reporting";
DROP SEQUENCE IF EXISTS esgi_user_id_seq;
DROP SEQUENCE IF EXISTS esgi_page_id_seq;
DROP SEQUENCE IF EXISTS esgi_page_comment_id_seq;
DROP SEQUENCE IF EXISTS esgi_reporting_id_seq;
CREATE SEQUENCE esgi_user_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 CACHE 1;
CREATE SEQUENCE esgi_page_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 CACHE 1;
CREATE SEQUENCE esgi_page_comment_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 CACHE 1;
CREATE SEQUENCE esgi_reporting_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 CACHE 1;

CREATE TABLE "public"."esgi_user" (
    "id" integer DEFAULT nextval('esgi_user_id_seq') NOT NULL,
    "firstname" character varying(60) NOT NULL,
    "lastname" character varying(120) NOT NULL,
    "email" character varying(320) NOT NULL,
    "pwd" character varying(255) NOT NULL,
    "date_inserted" timestamp NOT NULL,
    "date_updated" timestamp,
    "status" smallint NOT NULL,
    "role" character varying(60) NOT NULL,
    "token" character varying(20),
    CONSTRAINT "esgi_user_pkey" PRIMARY KEY ("id")
) WITH (oids = false);
ALTER TABLE "public"."esgi_user" ADD COLUMN "is_verified" smallint NOT NULL DEFAULT 0;

INSERT INTO "public"."esgi_user" (firstname, lastname, email, pwd, date_inserted, date_updated, status, role, is_verified) VALUES ('Jean', 'Dupond', 'jeandupond@gmail.com', '$2y$10$mLKjj7saZwKJ73EiGIAJd.5S5b0ciFsPR4mplK469x1n77VjIei4i', '2023-06-13 09:30:38', '2023-06-13 09:30:38', 1, 'guest', 1);
INSERT INTO "public"."esgi_user" (firstname, lastname, email, pwd, date_inserted, date_updated, status, role, is_verified) VALUES ('Anne', 'Dupond', 'annedupond@gmail.com', '$2y$10$mLKjj7saZwKJ73EiGIAJd.5S5b0ciFsPR4mplK469x1n77VjIei4i', '2023-06-13 09:30:38', '2023-06-13 09:30:38', 1, 'guest', 1);
INSERT INTO "public"."esgi_user" (firstname, lastname, email, pwd, date_inserted, date_updated, status, role, is_verified) VALUES ('Patrick', 'Verger', 'patrickverger@gmail.com', '$2y$10$mLKjj7saZwKJ73EiGIAJd.5S5b0ciFsPR4mplK469x1n77VjIei4i', '2023-06-13 09:30:38', '2023-06-13 09:30:38', 1, 'guest', 1);

CREATE TABLE "public"."esgi_page" (
    "id" integer DEFAULT nextval('esgi_page_id_seq') NOT NULL,
    "user_id" integer,
    CONSTRAINT fk_page_user_id FOREIGN KEY(user_id) REFERENCES esgi_user(id),
    "title" character varying(60) NOT NULL,
    "slug" character varying(60) NOT NULL,
    "date_inserted" timestamp NOT NULL,
    "date_updated" timestamp NOT NULL,
    "config" jsonb NOT NULL,
    "content" jsonb NOT NULL,
    "theme" integer NOT NULL,
    "status" integer NOT NULL,
    CONSTRAINT "esgi_page_pkey" PRIMARY KEY ("id")
);

INSERT INTO "public"."esgi_page" (user_id, title, slug, date_inserted, date_updated, config, content, theme, status) VALUES (1, 'Toto Page', 'toto-page', '2023-06-13 09:30:38', '2023-06-13 09:30:38', '{"toto":[1,2]}', '{"toto":[1,2]}', 1, 1);

CREATE TABLE "public"."esgi_page_comment" (
    "id" integer DEFAULT nextval('esgi_page_comment_id_seq') NOT NULL,
    "date_inserted" timestamp NOT NULL,
    "status" integer NOT NULL,
    "content" character varying(255) NOT NULL,
    "user_id" integer NOT NULL,
    CONSTRAINT fk_page_comment_user_id FOREIGN KEY(user_id) REFERENCES esgi_user(id),
    "page_id" integer NOT NULL,
    CONSTRAINT fk_page_comment_page_id FOREIGN KEY(page_id) REFERENCES esgi_page(id),
    CONSTRAINT "esgi_page_comment_pkey" PRIMARY KEY ("id")
);

INSERT INTO "public"."esgi_page_comment" (date_inserted, status, content, user_id, page_id) VALUES ('2023-06-13 09:30:38', 1, 'toto', 1, 1);

CREATE TABLE "public"."esgi_reporting" (
    "id" integer DEFAULT nextval('esgi_reporting_id_seq') NOT NULL,
    "date_inserted" timestamp NOT NULL,
    "date_updated" timestamp NOT NULL,
    "page_id" integer,
    CONSTRAINT fk_reporting_page_id FOREIGN KEY(page_id) REFERENCES esgi_page(id),
    "comment_id" integer,
    CONSTRAINT fk_reporting_comment_id FOREIGN KEY(comment_id) REFERENCES esgi_page_comment(id),
    "status" integer NOT NULL,
    CONSTRAINT "esgi_reporting_pkey" PRIMARY KEY ("id")
);

INSERT INTO "public"."esgi_reporting" (date_inserted, date_updated, page_id, status) VALUES ('2023-06-13 09:30:38', '2023-06-13 09:30:38', 1, 1);

-- 2023-04-18 16:57:56.748799+00