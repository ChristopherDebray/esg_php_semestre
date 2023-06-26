-- Adminer 4.8.1 PostgreSQL 15.1 (Debian 15.1-1.pgdg110+1) dump

DROP TABLE IF EXISTS "esgi_user" CASCADE;
DROP TABLE IF EXISTS "esgi_page" CASCADE;
DROP TABLE IF EXISTS "esgi_page_comment" CASCADE;
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
ALTER TABLE "public"."esgi_user" ADD COLUMN "is_deleted" smallint NOT NULL DEFAULT 0;

INSERT INTO "public"."esgi_user" (firstname, lastname, email, pwd, date_inserted, date_updated, status, role, is_verified) VALUES ('Jean', 'Dupond', 'jeandupond@gmail.com', '$2y$10$mLKjj7saZwKJ73EiGIAJd.5S5b0ciFsPR4mplK469x1n77VjIei4i', '2023-06-13 09:30:38', '2023-06-13 09:30:38', 1, 'admin', 1);
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
    "config" TEXT NOT NULL,
    "content" TEXT NOT NULL,
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

INSERT INTO "esgi_page" ("id", "user_id", "title", "slug", "date_inserted", "date_updated", "config", "content", "theme", "status") VALUES
(3,	1,	'titre',	'titre',	'2023-06-16 04:37:33',	'2023-06-26 12:55:35',	'{"config-keywords":"key, words","config-description":"Ma description"}',	'{"content-banner-imgSrc":"https:\/\/external-content.duckduckgo.com\/iu\/?u=https%3A%2F%2Ftse1.mm.bing.net%2Fth%3Fid%3DOIP.zO7A4uwcxSoxC_Idg99ygQHaCv%26pid%3DApi&f=1&ipt=b5f83dd2531296f3042d63a8c1eb239be4102b3b033236e09a62ef310a23f171&ipo=images","content-banner-companyTitle":"touta","content-slideshow-one-imgSrc":"https:\/\/hatrabbits.com\/wp-content\/uploads\/2017\/01\/random.jpg","content-slideshow-one-imgAlt":"description of the first picture","content-slideshow-two-imgSrc":"https:\/\/www.doubledtrailers.com\/assets\/images\/random%20horse%20facts%20shareable.png","content-slideshow-two-imgAlt":"description of the second picture","content-slideshow-three-imgSrc":"https:\/\/fs-prod-cdn.nintendo-europe.com\/media\/images\/10_share_images\/games_15\/nintendo_switch_download_software_1\/H2x1_NSwitchDS_LostInRandom_image1600w.jpg","content-slideshow-three-imgAlt":"description of the third picture","content-cards-one-imgSrc":"https:\/\/api.iconify.design\/material-symbols:house-outline.svg","content-cards-one-imgAlt":"description of the first picture","content-cards-one-title":"Heading1","content-cards-one-p":"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.","content-cards-two-imgSrc":"https:\/\/api.iconify.design\/material-symbols:house-outline.svg","content-cards-two-imgAlt":"description of the second picture","content-cards-two-title":"Heading2","content-cards-two-p":"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.","content-cards-three-imgSrc":"https:\/\/api.iconify.design\/material-symbols:house-outline.svg","content-cards-three-imgAlt":"description of the third picture","content-cards-three-title":"Heading3","content-cards-three-p":"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.","content-quote-quote":"I love this landing page OOOO! It rocks!","content-quote-author":"Jean","content-quote-info":"Toto Company","content-footer-companyTitle":"Toto","content-footer-footerColor":"#f6b73c"}',	1,	1);