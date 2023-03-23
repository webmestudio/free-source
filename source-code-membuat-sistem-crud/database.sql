CREATE TABLE IF NOT EXISTS `barang` (
  `kode` char(10) DEFAULT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `kategori` varchar(50) DEFAULT NULL,
  `harga` bigint(20) DEFAULT NULL,
  `stok` int(11) DEFAULT NULL
) COLLATE='utf8_general_ci' ENGINE=MyISAM;

INSERT INTO `barang` (`kode`, `nama`, `kategori`, `harga`, `stok`) VALUES
	('02', 'levis ', 'celana', 90000, 2),
	('12', 'test', 'test', 50000, 5);
