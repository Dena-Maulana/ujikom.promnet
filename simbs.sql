-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 28 Nov 2025 pada 22.27
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `simbs`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `buku`
--

CREATE TABLE `buku` (
  `id` int(50) NOT NULL,
  `judul` varchar(100) NOT NULL,
  `deskripsi` varchar(100) NOT NULL,
  `halaman` varchar(100) NOT NULL,
  `gambar` varchar(50) NOT NULL,
  `tanggal_input` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `buku`
--

INSERT INTO `buku` (`id`, `judul`, `deskripsi`, `halaman`, `gambar`, `tanggal_input`) VALUES
(4, 'sastra mesin', 'Novel Nano Machine adalah tentang Cheon Yeowun, seorang seniman bela diri yang menemukan mesin nano ', '200', '692a0207a946c.png', '2025-11-28'),
(13, 'Perjalanan Dena', 'Sebuah Buku yang berisi kisah hidup seorang dena yang menghadapi berbagai tantangan ', '300', '692a1397e0baf.png', '2025-11-29');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `id` int(50) NOT NULL,
  `kategori` varchar(100) NOT NULL,
  `tanggal_input` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`id`, `kategori`, `tanggal_input`) VALUES
(1, 'Fiksi Ilmiah', '2025-11-28 21:22:07'),
(3, 'Self Improvement', '2025-11-28 21:22:07'),
(4, 'Novel', '2025-11-28 21:22:07'),
(6, 'Komik', '2025-11-28 21:27:10');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(50) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `password`) VALUES
(1, 'denaaa', 'dena123@gmail.com', '$2y$10$SrJlmOnXXPgXy5Coqh3Vre7dA29pDvuS.a8mdr8uydenSN8d1Ju0m'),
(2, 'dena', 'dena@gmail.com', '$2y$10$mALj8YNi/KePXhr1SoVCHeIkGoYxU75Rrj0Ks3Z2pnFzYDGtXScti'),
(3, 'gusti', 'gusti11@gmail.com', '$2y$10$4FmYxgHD6BPz21PaUrEd9OUUBS.gaVEsx7FWpbAXbjQypsxYIkPfG'),
(4, 'testuser', 'testuser@example.com', '$2y$10$ltLaLXjgGDfIvwwXVWYpBuN/k3hQROArzQcY9sjj/jnoTURb1lX.m');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `buku`
--
ALTER TABLE `buku`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
