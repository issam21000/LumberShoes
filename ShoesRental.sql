-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Lun 20 Novembre 2017 à 12:45
-- Version du serveur :  5.7.20-0ubuntu0.16.04.1
-- Version de PHP :  5.6.32-1+ubuntu16.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `ShoesRental`
--

-- --------------------------------------------------------

--
-- Structure de la table `ShRent_Brand`
--

CREATE TABLE `ShRent_Brand` (
  `id` int(11) NOT NULL,
  `legend` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `ShRent_Brand`
--

INSERT INTO `ShRent_Brand` (`id`, `legend`, `created_at`, `updated_at`) VALUES
(1, 'HAIX ', NULL, NULL),
(2, 'HAIXFOR ', NULL, NULL),
(3, 'KAYLAND ', NULL, NULL),
(4, 'Timberland ', NULL, NULL),
(5, 'JALFIR ', NULL, NULL),
(7, 'ONTARIO II ', NULL, NULL),
(8, 'Zeus ', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `ShRent_City`
--

CREATE TABLE `ShRent_City` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `ShRent_City`
--

INSERT INTO `ShRent_City` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Paris', NULL, NULL),
(2, 'Nancy', NULL, NULL),
(3, 'Lyon', NULL, NULL),
(4, 'Marseille', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `ShRent_Order`
--

CREATE TABLE `ShRent_Order` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `total_price` int(11) NOT NULL DEFAULT '0',
  `order_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `ShRent_OrderLine`
--

CREATE TABLE `ShRent_OrderLine` (
  `id` int(11) NOT NULL,
  `shoes_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `start_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `end_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `total_price` double NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `ShRent_Shoes`
--

CREATE TABLE `ShRent_Shoes` (
  `id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `shop_id` int(11) NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `size` int(11) NOT NULL,
  `is_reserved` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `price_per_day_cents` int(11) NOT NULL,
  `price_per_day` double NOT NULL,
  `model` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `ShRent_Shoes`
--

INSERT INTO `ShRent_Shoes` (`id`, `brand_id`, `shop_id`, `image`, `size`, `is_reserved`, `created_at`, `updated_at`, `description`, `price_per_day_cents`, `price_per_day`, `model`) VALUES
(2, 1, 2, 'Shoes1.jpg', 42, 0, '2017-10-09 22:00:00', NULL, '\r\nThe HAIX Protector Forest is a comfortable anti-cut protection shoe that will complement your equipment as a hunter or forestry worker.\r\n\r\nThe Vibram rubber sole, which is water and cold resistant, has been specially developed for mountain areas in collaboration with tire manufacturer Pirelli. It is anti-slip and anti-slip. Also, will you have a firm grip even on rough terrain. A padded safety toe, extra large and extra high, protects your toes from falling heavy objects, such as tree trunks and branches, for example. A two-zone lacing system allows you to tighten these shoes differently in the foot area and the calf area. In this way, these boots will fit perfectly to your feet and will benefit from pleasant well-being all day long.', 99, 10, 'PROTECTOR FOREST'),
(3, 2, 1, 'Shoes2.jpg', 43, 0, '2017-10-02 22:00:00', NULL, '- Standards: S3 - SRC\r\n- Leather shoe\r\n- Water repellent\r\n- Filled lining\r\n- Antistatic\r\n- Non-slip\r\n- Steel antiperforation sole\r\n- Shockproof\r\n- Steel toecap\r\n- PU / PU sole\r\n- Heel with shock absorbing system\r\n- Oil resistant soles\r\n- Breathable lining\r\n- Waterproof upper\r\n- Weight of a boot in size 41: 760g\r\n- Areas of use: forest\r\nFurther information:\r\nStandard EN 20345 shells and end caps withstand an energy of 200 Joules. This energy corresponds to a 20 kg object falling from a height of one meter. On crushing (drop height equal to 0), the 200J protective shell withstands a force equivalent to 1500 kg', 89, 11, 'PROTECTOR LIGHT'),
(4, 3, 2, 'Shoes3.jpg', 44, 0, '2017-10-10 22:00:00', NULL, 'These safety shoes can be worn with orthopedic insoles, without losing their approval as safety shoes.\r\n\r\nFPA certification according to EN ISO 20345, Class I, S3 and EN ISO 17249, Class 3 cut-off protection. Cut-resistant protection boots with the advantages of a hiking boot on medium-level terrain and maximum protection thanks to a Kevlar sole and steel reinforcements.\r\n\r\n- FPA homologation\r\n\r\n- EN ISO 20345, Class I\r\n\r\n- Steel shell & anti-perforation soles (S3)\r\n\r\n- EN ISO 17249, class 3 cut-off protection\r\n\r\n- Leather lining\r\n\r\n- Anti-pronation and supination protection\r\n\r\n- Height of the stem 21 cm\r\n\r\n- Weight 2100 g / pair (size 43)\r\n\r\n- Non-slip Meindl sole with polyurethane wedge', 53, 15, 'GLOBO GORETEX'),
(5, 4, 1, 'Shoes6.jpg', 42, 1, '2017-10-12 22:00:00', NULL, '\r\nGenuine Norwegian stitching with double seams constituting a type of solid shoe\r\nOne-piece black rust leather upper in 3.2 / 3.4 mm thick waterproof treated crust\r\nInterior lined leather with padding\r\nLeather bellows with foam reinforcement for comfort\r\nQuilted leather back\r\nLacing with stainless steel rings and hooks offers good tightening and strength\r\nLeather inner sole\r\nMountain sole GALIBIER\r\nWeight: 2.4 Kgs in size 42', 0, 8, 'GALIBIER SUPERRANDO'),
(6, 5, 2, 'Shoes7.jpg', 44, 1, '2017-10-16 22:00:00', NULL, 'Outdoor safety shoe, suitable for the building sector. Full grain water repellent leather upper with pull-up finish. Anti-abrasion protection on the front and heel to ensure durability and durability of the shoe in very aggressive conditions of use: better resistance to shocks, cuts and abrasion. Raising the PU sole on the forefoot for added protection. Ergonomic upper padding made of soft and compact foam, for greater comfort in the malleolus and achilles tendon. Inner lining (3D), three-dimensional fabric combining a foam for protection and comfort and an open structure (grid) for peripheral ventilation of the foot. Full protection: 200 joule polymer tip. Anti-perforation stainless steel spacer. PU / PU sole.', 0, 7, 'SAS S3 CI AN SRC - Jallatte'),
(7, 5, 2, 'Shoes9.jpg', 43, 0, '2017-10-17 22:00:00', NULL, 'A classic style nubuck shoes. Stable and durable, suitable for difficult and durable hiking. Versatile and good for four seasons use, it is ideal for sustainable use, even in particularly wet conditions, it perfectly suites the activity of hunters and loggers. Gore Tex® lining and clean comfort to great sense of utility.\r\nCharacteristics:\r\nUpper: Nubuck 2,4 / 2,6 mm + Rand Rubber\r\nLining: GORE TEX® Comfort & Performance\r\nConstruction: Lasting\r\nFootbed: Felt + Pe + Textile\r\nInsole: PP / fiberglass\r\nInterlayer: Single density PU light\r\nFit: ERGO Comfort\r\nSole: Vibram® Foura EVO\r\nStiffness Level: LEVEL 5 SEMI RIGID\r\nWeight: 800gr\r\nTechnology:\r\nMADE IN EUROPE: In order to grant the best quality and performance, Kayland® shoes are mainly produced in European comunity facilities, utilizing the capabilities of the continent\'s historic craftsmanship.\r\nSPEED Lacing System: Is the new Kayland® design system that works in synergy with the extended, asymmetrical lacing to ensure comfort and a perfect fit, especially in the heel and ankle area.\r\nGORE TEX®: essendo Resistenti all`acqua e traspiranti, the GORE TEX® Performance Comfort Calibration tengono i piedi Asciutti e protetti. Sono basate su no sistema progettato fornier he massimo confort climatico. Sono Ottimali by a \'Campia Gamma di Condizioni e soprattutto by attività all`aperto.', 0, 6, 'Shoe en Cuir solide'),
(8, 7, 2, 'Shoes10.jpg', 42, 0, '2017-10-17 22:00:00', NULL, '\r\n- Protective shoes\r\n- EN ISO 17249: 2004 class 2 standard 24m / s\r\n- S3, SRC, CI, HRO, WR\r\n- Steel shell\r\n- Stainless steel anti-perforation sole\r\n- Made of 2.2 / 2.4 mm flower leather\r\n- Lining: Waterproof TEPOR membrane\r\n- welded nitrile sole', 0, 7, 'S3 CI SRC Edition 1'),
(9, 8, 1, 'Shoes14.jpg', 43, 0, '2017-10-09 22:00:00', NULL, '\r\nComfort and modernity come together in this pair of boots by Creeks. Slightly rising, they have a rounded tip and two-tone laces, and are enhanced by a contrasting sole and notched. These boots will be perfect with straight jeans and a plaid shirt.\r\n\r\n- Men\'s boots\r\n- Creeks\r\n- Round toe\r\n- Notched contrast sole\r\n- Two-tone lace-up closure\r\n- Ankle reinforcement\r\n- Bi-material', 0, 8, 'Comfort and modernity '),
(10, 2, 1, 'Shoes15.jpg', 44, 1, '2017-10-16 22:00:00', NULL, 'Cowhide split leather upper 2.8 mm.\r\nRaincoat.\r\nLeather lining.\r\nDouble stitching.\r\nIdeal for lumberjack or mountain work.\r\nDavos rubber sole.', 0, 11, 'Cowhide split leather '),
(11, 4, 1, 'Shoes17.jpg', 41, 1, '2017-10-11 22:00:00', NULL, 'PVC / Rubber stem, green nitrile. PVC / rubber sole, black nitrile. White polyester lining, steel safety shell, anti-perforation sole.\r\n\r\nStrong points\r\n\r\nStrong adhesion, tip very resistant to shock and crushing, anti-slip sole. Very good acid resistance, bases, various chemicals. Waterproof, puncture resistant outsole, antistatic outsole, heel energy absorption, antistatic.\r\n\r\napplications\r\n\r\nResistant to animal and vegetable acids, fats and oils, various disinfectants and chemicals.', 0, 12, 'PVC / Rubber stem green '),
(12, 3, 2, 'Shoes19.jpg', 41, 0, '2017-10-24 22:00:00', NULL, '\n- PVC top\n- PVC / nitrile rubber sole, EN ISO 20345 steel toecap (200 Joules)\n- Polyester warm lining\n- Two leather tabs for easy donning\n- Cleated soles\n- Steel hull\n- flexible steel insole\n- Anti-slip sole complies with SRA standard\n- Water resistance\n- PVC material, PVC sole and Nitrile rubber Polyester lining\nStandards: EN ISO 20345: 2011 S5 SRA\n\nSRA Slip resistance on tiles coated with sodium lauryl sulfate solution.\n\nS5 Impact resistant toe cap of 200 Joules. All rubber or polymer shoes with antistatic properties. Shock absorption in the heel area. More anti-perforation sole and notched outsole.', 0, 13, 'PVC top rubber sole'),
(13, 1, 2, 'Shoes20.jpg', 44, 1, '2017-10-04 22:00:00', NULL, '- Top material: PVC / Nitrile\n- Sole material: PVC / Nitrile\n- Shell steel 200 joules\n- Steel sole\n- Antistatic shoes\n- Heel with energy absorption\n- Waterproof\n- SRC anti-slip soles\n\nThe EN 345 ​​hulls and protective caps resist an energy of 200 Joules.\nThis energy corresponds to a 20 kg object falling from a height of one meter. On crushing (drop height equal to 0), the 200J protective shell withstands a force equivalent to 1500 kg.', 0, 10, 'PVC / Nitrile Sole '),
(14, 2, 1, 'Shoes18.jpg', 45, 0, '2017-10-08 22:00:00', NULL, '- Anti-perforation sole steel: 1 100 N\n- High Performance Adhesion: SRC\n- Height of the boot: 28 cm\n- Off the heel: 14 mm\n\nEnvironment:\n\n- construction, quarries,\n- Heavy industry\n- Oil industry\n\nStem:\n- 200J toecap, composite insulation of cold and heat\n\n- Water repellent full grain leather and oil repellent\n\nFocus:\n\n- Wide footwear\n- Handles\n\n- Very notched sole designed for high stability on uneven ground\n\n\nSpecifications:\nNet weight per pair: 1.5 kg net\nSize from 39 to 48\nStandard: EN ISO 20345\nMarking: S3 SRC', 0, 12, 'sole steel 1100 N'),
(15, 4, 2, 'Shoes13.jpg', 44, 0, '2017-09-30 22:00:00', NULL, '\nSOLE:\n- Ultra light dual-density polyurethane\n- High Performance Adhesion: SRC\n- Anti-perforation sole steel 1 100 N\n- Off the heel: 10 mm\nENVIRONMENT:\n- Construction, quarries, forestry work\n- Heated or muddy soils\nSTEM:\n- Heavy-duty water resistant greased leather (2-2, 2 mm)\n- Protective toecap 200 J composite insulating cold or heat.\n- Thinsulate lining: very insulating and breathable, fast drying.\nFOCUS:\n- Reinforced protection of the overbout\n- Prevention of side, rear and frontal impact risks', 0, 13, 'Ultra light dual-density polyurethane'),
(16, 5, 2, 'Shoes12.jpg', 43, 0, '2017-10-28 22:00:00', NULL, '\nShoes tiger Steel Safety Filled Footwear - Standards EN20345 SRC and S3\n\nS3 work shoes are suitable for anyone working in an environment with a high level of humidity and in the presence of mineral oils and hydrocarbons.\nS3 work shoes also protect against the risk of perforation and crushing of the foot.\n\nRecommended Use: Heavy Handling, Slip Media, Oil Media, Wetlands, Industries, Storage\n\nMATERIALS :\n\n- Upper: full grain leather shoes\n- Lining: acrylic fur\n- Sock: Fixed, synthetic top on foam\n- Sole: injected, dual-density polyurethane.\n\nSTRONG POINTS :\n\n- Impact and crush resistant tip (200 Joules)\n- Energy absorbing heel\n- Hydrocarbon resistant sole\n- Anti-perforation sole\n- Slip resistant crampon sole\n- Antistatic protector\n- Stem resistant to the penetration of water\n- Cold protection.\n\nBrown color\n\nThis pair of safety shoes meets the following standards:\n\nEN ISO 20345: This standard specifies the basic and additional requirements for safety footwear for professional use.\nStandard S3: antistatic, heel energy absorption, water penetration resistance, puncture resistance of the sole\nSRC standard: Non-slip sole.', 0, 11, ' tiger Steel Safety Filled ');

-- --------------------------------------------------------

--
-- Structure de la table `ShRent_Shop`
--

CREATE TABLE `ShRent_Shop` (
  `id` int(11) NOT NULL,
  `city_id` int(11) NOT NULL,
  `shop_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `formatted_address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `latitude` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `longitude` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `ShRent_Shop`
--

INSERT INTO `ShRent_Shop` (`id`, `city_id`, `shop_name`, `formatted_address`, `latitude`, `longitude`, `created_at`, `updated_at`) VALUES
(1, 2, 'Noze', '', '48.655046', '6.184997', NULL, NULL),
(2, 2, 'Chaussea', '', '48.710145', '6.245957', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `ShRent_User`
--

CREATE TABLE `ShRent_User` (
  `id` int(11) NOT NULL,
  `full_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_date` timestamp NULL DEFAULT NULL,
  `last_latitude` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_longitude` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `ShRent_User`
--

INSERT INTO `ShRent_User` (`id`, `full_name`, `email`, `password`, `created_date`, `last_latitude`, `last_longitude`, `token`, `created_at`, `updated_at`) VALUES
(4, 'admin', 'admin@admin.fr', '$2y$10$JZQRZN09hyvbFC/qfV81Au7Zy2HLyjvVzHiHfNkb/FPcwSZ/k8bwK', NULL, NULL, NULL, 'npBljIdLy8W71giXCK62', '2017-11-20 11:42:20', '2017-11-20 11:42:31');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `ShRent_Brand`
--
ALTER TABLE `ShRent_Brand`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `ShRent_City`
--
ALTER TABLE `ShRent_City`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `ShRent_Order`
--
ALTER TABLE `ShRent_Order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id_user_foreign` (`user_id`);

--
-- Index pour la table `ShRent_OrderLine`
--
ALTER TABLE `ShRent_OrderLine`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orderline_id_shoes_foreign` (`shoes_id`),
  ADD KEY `orderline_id_order_foreign` (`order_id`);

--
-- Index pour la table `ShRent_Shoes`
--
ALTER TABLE `ShRent_Shoes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `shoes_id_brand_foreign` (`brand_id`),
  ADD KEY `shoes_id_shop_foreign` (`shop_id`);

--
-- Index pour la table `ShRent_Shop`
--
ALTER TABLE `ShRent_Shop`
  ADD PRIMARY KEY (`id`),
  ADD KEY `shop_id_city_foreign` (`city_id`);

--
-- Index pour la table `ShRent_User`
--
ALTER TABLE `ShRent_User`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_email_unique` (`email`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `ShRent_Brand`
--
ALTER TABLE `ShRent_Brand`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT pour la table `ShRent_City`
--
ALTER TABLE `ShRent_City`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `ShRent_Order`
--
ALTER TABLE `ShRent_Order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT pour la table `ShRent_OrderLine`
--
ALTER TABLE `ShRent_OrderLine`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT pour la table `ShRent_Shoes`
--
ALTER TABLE `ShRent_Shoes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT pour la table `ShRent_Shop`
--
ALTER TABLE `ShRent_Shop`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `ShRent_User`
--
ALTER TABLE `ShRent_User`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `ShRent_Order`
--
ALTER TABLE `ShRent_Order`
  ADD CONSTRAINT `order_id_user_foreign` FOREIGN KEY (`user_id`) REFERENCES `ShRent_User` (`id`);

--
-- Contraintes pour la table `ShRent_OrderLine`
--
ALTER TABLE `ShRent_OrderLine`
  ADD CONSTRAINT `orderline_id_order_foreign` FOREIGN KEY (`order_id`) REFERENCES `ShRent_Order` (`id`),
  ADD CONSTRAINT `orderline_id_shoes_foreign` FOREIGN KEY (`shoes_id`) REFERENCES `ShRent_Shoes` (`id`);

--
-- Contraintes pour la table `ShRent_Shoes`
--
ALTER TABLE `ShRent_Shoes`
  ADD CONSTRAINT `shoes_id_brand_foreign` FOREIGN KEY (`brand_id`) REFERENCES `ShRent_Brand` (`id`),
  ADD CONSTRAINT `shoes_id_shop_foreign` FOREIGN KEY (`shop_id`) REFERENCES `ShRent_Shop` (`id`);

--
-- Contraintes pour la table `ShRent_Shop`
--
ALTER TABLE `ShRent_Shop`
  ADD CONSTRAINT `shop_id_city_foreign` FOREIGN KEY (`city_id`) REFERENCES `ShRent_City` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
