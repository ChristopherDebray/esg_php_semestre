-- Adminer 4.8.1 PostgreSQL 15.1 (Debian 15.1-1.pgdg110+1) dump

DROP TABLE IF EXISTS "esgi_user" CASCADE;
DROP TABLE IF EXISTS "esgi_page";
DROP TABLE IF EXISTS "esgi_page_comment";
DROP SEQUENCE IF EXISTS esgi_user_id_seq;
DROP SEQUENCE IF EXISTS esgi_page_id_seq;
DROP SEQUENCE IF EXISTS esgi_page_comment_id_seq;
CREATE SEQUENCE esgi_user_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 CACHE 1;
CREATE SEQUENCE esgi_page_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 CACHE 1;
CREATE SEQUENCE esgi_page_comment_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 CACHE 1;

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

INSERT INTO "public"."esgi_user" (firstname, lastname, email, pwd, date_inserted, date_updated, status, role) VALUES ('Jean', 'Dupond', 'jeandupond@gmail.com', '$2y$10$mLKjj7saZwKJ73EiGIAJd.5S5b0ciFsPR4mplK469x1n77VjIei4i', '2023-06-13 09:30:38', '2023-06-13 09:30:38', 1, 'guest');
INSERT INTO "public"."esgi_user" (firstname, lastname, email, pwd, date_inserted, date_updated, status, role) VALUES ('Anne', 'Dupond', 'annedupond@gmail.com', '$2y$10$mLKjj7saZwKJ73EiGIAJd.5S5b0ciFsPR4mplK469x1n77VjIei4i', '2023-06-13 09:30:38', '2023-06-13 09:30:38', 1, 'guest');
INSERT INTO "public"."esgi_user" (firstname, lastname, email, pwd, date_inserted, date_updated, status, role) VALUES ('Patrick', 'Verger', 'patrickverger@gmail.com', '$2y$10$mLKjj7saZwKJ73EiGIAJd.5S5b0ciFsPR4mplK469x1n77VjIei4i', '2023-06-13 09:30:38', '2023-06-13 09:30:38', 1, 'guest');

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

-- 2023-04-18 16:57:56.748799+00