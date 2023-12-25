-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1:3306
-- Üretim Zamanı: 22 Ara 2023, 08:46:36
-- Sunucu sürümü: 8.0.31
-- PHP Sürümü: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `bilisimdeneme`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `depolar`
--

DROP TABLE IF EXISTS `depolar`;
CREATE TABLE IF NOT EXISTS `depolar` (
  `depo_id` int NOT NULL,
  `depo_adi` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_turkish_ci NOT NULL,
  PRIMARY KEY (`depo_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_turkish_ci;

--
-- Tablo döküm verisi `depolar`
--

INSERT INTO `depolar` (`depo_id`, `depo_adi`) VALUES
(1, 'Manisa Akhisar'),
(4, 'Manisa');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kategoriler`
--

DROP TABLE IF EXISTS `kategoriler`;
CREATE TABLE IF NOT EXISTS `kategoriler` (
  `kategori_id` int NOT NULL,
  `kategori_adi` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_turkish_ci NOT NULL,
  PRIMARY KEY (`kategori_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_turkish_ci;

--
-- Tablo döküm verisi `kategoriler`
--

INSERT INTO `kategoriler` (`kategori_id`, `kategori_adi`) VALUES
(1, 'İçecek');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `stok`
--

DROP TABLE IF EXISTS `stok`;
CREATE TABLE IF NOT EXISTS `stok` (
  `stok_id` int NOT NULL,
  `urun_id` int NOT NULL,
  `depo_id` int NOT NULL,
  `miktar` int NOT NULL,
  PRIMARY KEY (`stok_id`),
  KEY `urun_id` (`urun_id`) USING BTREE,
  KEY `depo_id` (`depo_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_turkish_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `stok_hareketleri`
--

DROP TABLE IF EXISTS `stok_hareketleri`;
CREATE TABLE IF NOT EXISTS `stok_hareketleri` (
  `hareket_id` int NOT NULL,
  `urun_id` int NOT NULL,
  `depo_id` int NOT NULL,
  `miktar` int NOT NULL,
  `hareket_tarihi` date NOT NULL,
  `hareket_turu` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_turkish_ci NOT NULL,
  PRIMARY KEY (`hareket_id`),
  KEY `urun_id` (`urun_id`) USING BTREE,
  KEY `depo_id` (`depo_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_turkish_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `tedarikciler`
--

DROP TABLE IF EXISTS `tedarikciler`;
CREATE TABLE IF NOT EXISTS `tedarikciler` (
  `tedarikci_id` int NOT NULL,
  `tedarikci_adi` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_turkish_ci NOT NULL,
  `tedarikci_adresi` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_turkish_ci NOT NULL,
  PRIMARY KEY (`tedarikci_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_turkish_ci;

--
-- Tablo döküm verisi `tedarikciler`
--

INSERT INTO `tedarikciler` (`tedarikci_id`, `tedarikci_adi`, `tedarikci_adresi`) VALUES
(4134, 'affa', 'dfafd'),
(332323, '323123', 'weeds');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `urunler`
--

DROP TABLE IF EXISTS `urunler`;
CREATE TABLE IF NOT EXISTS `urunler` (
  `urun_id` int NOT NULL,
  `urun_adi` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_turkish_ci NOT NULL,
  `kategori_id` int NOT NULL,
  `birim_fiyat` decimal(10,2) NOT NULL,
  `tedarikci_id` int NOT NULL,
  PRIMARY KEY (`urun_id`),
  KEY `kategori_id` (`kategori_id`) USING BTREE,
  KEY `tedarikci_id` (`tedarikci_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_turkish_ci;

--
-- Tablo döküm verisi `urunler`
--

INSERT INTO `urunler` (`urun_id`, `urun_adi`, `kategori_id`, `birim_fiyat`, `tedarikci_id`) VALUES
(452542, '524245524', 1, '542245.00', 4134);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `yoneticiler`
--

DROP TABLE IF EXISTS `yoneticiler`;
CREATE TABLE IF NOT EXISTS `yoneticiler` (
  `yonetici_id` int NOT NULL AUTO_INCREMENT,
  `yonetici_adi` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_turkish_ci NOT NULL,
  `sifre` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_turkish_ci NOT NULL,
  PRIMARY KEY (`yonetici_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4136 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_turkish_ci;

--
-- Tablo döküm verisi `yoneticiler`
--

INSERT INTO `yoneticiler` (`yonetici_id`, `yonetici_adi`, `sifre`) VALUES
(1, '', ''),
(2, '', ''),
(3, '', 'merhaba3'),
(313, '4314', '34341'),
(334, '', ''),
(4134, '4143', '413413'),
(4135, '', '');

--
-- Dökümü yapılmış tablolar için kısıtlamalar
--

--
-- Tablo kısıtlamaları `stok`
--
ALTER TABLE `stok`
  ADD CONSTRAINT `stok_ibfk_1` FOREIGN KEY (`urun_id`) REFERENCES `urunler` (`urun_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `stok_ibfk_2` FOREIGN KEY (`depo_id`) REFERENCES `depolar` (`depo_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Tablo kısıtlamaları `stok_hareketleri`
--
ALTER TABLE `stok_hareketleri`
  ADD CONSTRAINT `stok_hareketleri_ibfk_1` FOREIGN KEY (`urun_id`) REFERENCES `urunler` (`urun_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `stok_hareketleri_ibfk_2` FOREIGN KEY (`depo_id`) REFERENCES `depolar` (`depo_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Tablo kısıtlamaları `urunler`
--
ALTER TABLE `urunler`
  ADD CONSTRAINT `urunler_ibfk_1` FOREIGN KEY (`kategori_id`) REFERENCES `kategoriler` (`kategori_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `urunler_ibfk_2` FOREIGN KEY (`tedarikci_id`) REFERENCES `tedarikciler` (`tedarikci_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
