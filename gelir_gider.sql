-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 14 Haz 2024, 14:56:40
-- Sunucu sürümü: 10.4.32-MariaDB
-- PHP Sürümü: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `gelir_gider`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `ajanda`
--

CREATE TABLE `ajanda` (
  `id` int(11) NOT NULL,
  `gorev` varchar(55) NOT NULL,
  `tarih` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `ajanda`
--

INSERT INTO `ajanda` (`id`, `gorev`, `tarih`) VALUES
(1, 'toplantı', '2024-06-18');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `gelirler`
--

CREATE TABLE `gelirler` (
  `id` int(11) NOT NULL,
  `ucret` int(11) NOT NULL,
  `aciklama` varchar(255) NOT NULL,
  `gelir_tur` int(11) NOT NULL,
  `vade_gun` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `gelirler`
--

INSERT INTO `gelirler` (`id`, `ucret`, `aciklama`, `gelir_tur`, `vade_gun`) VALUES
(1, 50, 'no1', 0, 0),
(2, 50, 'a', 0, 0);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `mal_beyan`
--

CREATE TABLE `mal_beyan` (
  `id` int(11) NOT NULL,
  `aciklama` varchar(55) NOT NULL,
  `deger` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `mal_beyan`
--

INSERT INTO `mal_beyan` (`id`, `aciklama`, `deger`) VALUES
(1, 'araba', 500);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `odemeler`
--

CREATE TABLE `odemeler` (
  `id` int(11) NOT NULL,
  `odeme_adi` varchar(55) NOT NULL,
  `ucret` int(11) NOT NULL,
  `odeme_gunu` int(11) NOT NULL,
  `taksit_sayi` int(11) NOT NULL,
  `mevcut_taksit` int(11) NOT NULL,
  `durum` tinyint(1) NOT NULL,
  `borc_tur` varchar(55) NOT NULL,
  `odenen_gun` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `odemeler`
--

INSERT INTO `odemeler` (`id`, `odeme_adi`, `ucret`, `odeme_gunu`, `taksit_sayi`, `mevcut_taksit`, `durum`, `borc_tur`, `odenen_gun`) VALUES
(1, 'denee', 500, 20, 12, 20, 1, '2', '-'),
(2, 'aidat', 1500, 2024, 0, 0, 1, '1', '-');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `yonetim`
--

CREATE TABLE `yonetim` (
  `id` int(11) NOT NULL,
  `mail` varchar(55) NOT NULL,
  `parola` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `yonetim`
--

INSERT INTO `yonetim` (`id`, `mail`, `parola`) VALUES
(1, 'admin@mail.com', '112233');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `ajanda`
--
ALTER TABLE `ajanda`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `gelirler`
--
ALTER TABLE `gelirler`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `mal_beyan`
--
ALTER TABLE `mal_beyan`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `odemeler`
--
ALTER TABLE `odemeler`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `yonetim`
--
ALTER TABLE `yonetim`
  ADD PRIMARY KEY (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `ajanda`
--
ALTER TABLE `ajanda`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tablo için AUTO_INCREMENT değeri `gelirler`
--
ALTER TABLE `gelirler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Tablo için AUTO_INCREMENT değeri `mal_beyan`
--
ALTER TABLE `mal_beyan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tablo için AUTO_INCREMENT değeri `odemeler`
--
ALTER TABLE `odemeler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Tablo için AUTO_INCREMENT değeri `yonetim`
--
ALTER TABLE `yonetim`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
