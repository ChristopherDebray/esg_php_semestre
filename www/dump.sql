-- Adminer 4.8.1 PostgreSQL 15.1 (Debian 15.1-1.pgdg110+1) dump

DROP TABLE IF EXISTS "esgi_user" CASCADE;
DROP TABLE IF EXISTS "esgi_page";
DROP SEQUENCE IF EXISTS esgi_user_id_seq;
DROP SEQUENCE IF EXISTS esgi_page_id_seq;
CREATE SEQUENCE esgi_user_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 CACHE 1;
CREATE SEQUENCE esgi_page_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 CACHE 1;

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

-- 2023-04-18 16:57:56.748799+00