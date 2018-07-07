-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 2018 年 7 朁E07 日 07:45
-- サーバのバージョン： 10.1.31-MariaDB
-- PHP Version: 7.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shop`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `dat_member`
--

DROP TABLE IF EXISTS `dat_member`;
CREATE TABLE `dat_member` (
  `code` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `password` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `postal1` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `postal2` varchar(4) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `tel` varchar(13) COLLATE utf8_unicode_ci NOT NULL,
  `danjo` int(11) NOT NULL,
  `born` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- テーブルのデータのダンプ `dat_member`
--

INSERT INTO `dat_member` (`code`, `date`, `password`, `name`, `email`, `postal1`, `postal2`, `address`, `tel`, `danjo`, `born`) VALUES
(2, '2017-04-19 02:21:15', '71db2c0691df516a19845104f3fce0b6', '下田研究室', 'shimodalab.cit@gmail.com', '275', '0016', '千葉県習志野市津田沼2-17-1', '0474780661', 1, 1990),
(3, '2017-04-19 13:56:55', '3cb211104186539915fe6f57315f67db', '千葉工大', 'chiba.koudai@s.chibakoudai.jp', '275', '0016', '千葉県習志野市津田沼2-17-1', '0474780661', 1, 1990),
(4, '2018-07-03 10:30:50', 'c4ca4238a0b923820dcc509a6f75849b', '金子周平', 's1642040ST@s.chibakoudai.jp', '123', '4567', '千葉県習志野市津田沼', '09012345678', 1, 1990);

-- --------------------------------------------------------

--
-- テーブルの構造 `dat_review`
--

DROP TABLE IF EXISTS `dat_review`;
CREATE TABLE `dat_review` (
  `id` int(11) NOT NULL,
  `code` int(11) NOT NULL,
  `name` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `score` int(11) NOT NULL,
  `comment` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- テーブルのデータのダンプ `dat_review`
--

INSERT INTO `dat_review` (`id`, `code`, `name`, `score`, `comment`) VALUES
(1, 0, 'おおき', 9, '肉じゃが肉じゃが'),
(2, 0, '宮田', 9, '最高'),
(27, 1, 'nasu', 7, 'また買いたい'),
(28, 1, 'sato', 4, '良かったです'),
(29, 1, 'nasu', 1, 'あああああ'),
(30, 1, 'H1642040', 7, 'a'),
(31, 1, '宮田', 9, '期待以上'),
(32, 1, '加藤', 6, '価格は高いが、品質は良い。'),
(33, 1, 'kaneko', 7, '普通'),
(34, 1, 'H1642040', 7, 'ああ'),
(35, 1, '田村', 2, '最悪'),
(36, 1, 'nasu', 1, 'ああ'),
(37, 1, 'kaneko', 7, 'またかいたい'),
(38, 1, '宮田', 9, 'saikou '),
(39, 1, 'nasu', 7, 'aa'),
(40, 1, 'H1642040', 7, 'a'),
(41, 1, 'nasu', 7, 'aaa'),
(42, 1, 'nasu', 7, 'あああ'),
(43, 1, '砂糖', 9, 'good'),
(44, 2, 'nasu', 7, 'aaa'),
(45, 2, '宮田a', 8, '1'),
(46, 2, '金子', 8, 'またかいたい'),
(47, 3, 'nasu', 9, 'オニオンスライスに使いましたが、とってもおいしかったです。また購入します。'),
(48, 3, '林檎', 4, 'オニオングラタンスープを作りました。\r\n大きいサイズで満足です。'),
(49, 1, '千葉', 7, 'いいね！'),
(50, 8, '宮田', 5, '味は普通。');

-- --------------------------------------------------------

--
-- テーブルの構造 `dat_sales`
--

DROP TABLE IF EXISTS `dat_sales`;
CREATE TABLE `dat_sales` (
  `code` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `code_member` int(11) NOT NULL,
  `name` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `postal1` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `postal2` varchar(4) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `tel` varchar(13) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- テーブルのデータのダンプ `dat_sales`
--

INSERT INTO `dat_sales` (`code`, `date`, `code_member`, `name`, `email`, `postal1`, `postal2`, `address`, `tel`) VALUES
(2, '2017-04-19 02:21:15', 2, '下田研究室', 'shimodalab.cit@gmail.com', '275', '0016', '千葉県習志野市津田沼2-17-1', '0474780661'),
(3, '2017-04-19 13:56:55', 3, '千葉工大', 'chiba.koudai@s.chibakoudai.jp', '275', '0016', '千葉県習志野市津田沼2-17-1', '0474780661'),
(4, '2018-06-24 14:52:51', 0, '金子周平', 's1642040ST@s.chibakoudai.jp', '123', '4567', '千葉県習志野市津田沼', '09012345678'),
(5, '2018-07-03 10:30:50', 4, '金子周平', 's1642040ST@s.chibakoudai.jp', '123', '4567', '千葉県習志野市津田沼', '09012345678');

-- --------------------------------------------------------

--
-- テーブルの構造 `dat_sales_product`
--

DROP TABLE IF EXISTS `dat_sales_product`;
CREATE TABLE `dat_sales_product` (
  `code` int(11) NOT NULL,
  `code_sales` int(11) NOT NULL,
  `code_product` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- テーブルのデータのダンプ `dat_sales_product`
--

INSERT INTO `dat_sales_product` (`code`, `code_sales`, `code_product`, `price`, `quantity`) VALUES
(3, 2, 1, 100, 1),
(4, 2, 2, 100, 1),
(5, 3, 1, 100, 1),
(6, 4, 1, 2600, 2),
(7, 5, 1, 2000, 1);

-- --------------------------------------------------------

--
-- テーブルの構造 `mst_product`
--

DROP TABLE IF EXISTS `mst_product`;
CREATE TABLE `mst_product` (
  `code` int(11) NOT NULL,
  `name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `price` int(11) NOT NULL,
  `gazou` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `santi` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `meigara` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `nedan` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `syousai` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- テーブルのデータのダンプ `mst_product`
--

INSERT INTO `mst_product` (`code`, `name`, `price`, `gazou`, `santi`, `meigara`, `nedan`, `syousai`) VALUES
(7, '秋田産あきたこまち', 2000, 'akitakomati.jpg', ' 秋田', ' あきたこまち', ' 小', '世界三大美人に数えられる平安時代の歌人「小野小町」にちなんで名づけられた日本を代表するお米「あきたこまち」。その名の通り秋田県で開発された品種であり、秋田で作付面積の80％のシェアを持つ秋田県を代表するお米です。あきたこまちの特徴は、コシヒカリ譲りの甘みや旨みを持ちながらも、味のバランスが良いのであっさりとしている点です。 ですので、あきたこまちに合う料理は、繊細で比較的薄味の和食との相性が非常に良いです。刺身やお寿司にも良く合います。'),
(8, '山形産つや姫', 2600, 'tuyahime.jpg', ' 山形', ' つや姫', ' 中', '山形県で近年開発された「つや姫」。人気が非常に高く、山形県以外での生産も拡大しています。味の特徴は、甘みや旨みはもちろん、口当たりや粘り気などの米の味としてバランスが良い点が特徴です。'),
(9, '北海道産ななつぼし', 2300, 'nanatubosi.jpg', ' 北海道', ' ななつぼし', ' 小', '食味ランキング特A獲得のななつぼし。北海道米で今一番多く作られている種類です。 粘りのある国宝ローズというのが交配さていて、つや、粘り、甘みバランスが最高。 ななつぼしは冷めても美味しくたべれるので、お弁当やお寿司などにぴったりのお米です。'),
(10, '青森産晴天の霹靂', 2800, 'seitennohekireki.jpg', ' 青森', ' 晴天の霹靂', ' 中', '粒がやや大きめのしっかりしたお米です。ほどよいツヤと、柔らかな白さ、炊きあがりからしばらく保温していても、つぶれることのない適度な硬さがあります。食べごたえがあって、しかも、重すぎない。粘りとキレのバランスがいい。上品な甘みの残る味わいです。食材豊かな青森で誕生した「青天の霹靂」は海のもの、山のもの、里のもの、どんな食材とも相性がよく、おかずを選ばない頼もしさがあります。'),
(11, '新潟産コシヒカリ', 3500, 'kosihikari.jpg', ' 新潟', ' コシヒカリ', ' 高', '美味しいお米の代名詞。味の特徴は、強いうまみと粘りです。それだけではなく香りや炊きあがりの美しさ、歯ごたえの柔らかさなどどれをとっても優れています。コシヒカリは米本来の味や香りが強いので、薄味の和食よりも味付けの濃い料理との相性が良いです。ハンバーグやとんかつなどの濃い味の料理にも負けない濃い味のお米です。');

-- --------------------------------------------------------

--
-- テーブルの構造 `mst_staff`
--

DROP TABLE IF EXISTS `mst_staff`;
CREATE TABLE `mst_staff` (
  `code` int(11) NOT NULL,
  `name` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(32) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- テーブルのデータのダンプ `mst_staff`
--

INSERT INTO `mst_staff` (`code`, `name`, `password`) VALUES
(1, 'shimoda', '9602038a24c4347f6dc16d57cd85b455'),
(2, 'yabuki', '9abc0aee29c4f992aefffe3507bba348'),
(3, 'takuma', '3fba72c69719599256c2077481fbc7fa'),
(4, 'kaneko', 'c4ca4238a0b923820dcc509a6f75849b');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dat_member`
--
ALTER TABLE `dat_member`
  ADD PRIMARY KEY (`code`);

--
-- Indexes for table `dat_review`
--
ALTER TABLE `dat_review`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dat_sales`
--
ALTER TABLE `dat_sales`
  ADD PRIMARY KEY (`code`);

--
-- Indexes for table `dat_sales_product`
--
ALTER TABLE `dat_sales_product`
  ADD PRIMARY KEY (`code`);

--
-- Indexes for table `mst_product`
--
ALTER TABLE `mst_product`
  ADD PRIMARY KEY (`code`);

--
-- Indexes for table `mst_staff`
--
ALTER TABLE `mst_staff`
  ADD PRIMARY KEY (`code`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dat_member`
--
ALTER TABLE `dat_member`
  MODIFY `code` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `dat_review`
--
ALTER TABLE `dat_review`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `dat_sales`
--
ALTER TABLE `dat_sales`
  MODIFY `code` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `dat_sales_product`
--
ALTER TABLE `dat_sales_product`
  MODIFY `code` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `mst_product`
--
ALTER TABLE `mst_product`
  MODIFY `code` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `mst_staff`
--
ALTER TABLE `mst_staff`
  MODIFY `code` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
