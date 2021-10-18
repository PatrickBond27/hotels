--
-- Database: `festivals`
--

-- --------------------------------------------------------

--
-- Table structure for table `festivals`
--

CREATE TABLE `hotels` (
  `id` int(11) NOT NULL,
  `name` varchar(64) NOT NULL,
  `address` text DEFAULT NULL,
  `star_rating` float NOT NULL,
  `phone_number` varchar(64) NOT NULL,
  `image_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `festivals`
--

INSERT INTO `hotels` (`id`, `name`, `address`, `star_rating`, `phone_number`, `image_id`) VALUES
(1, 'The Ocean Lodge', '2864 S Pacific Ave, Cannon Beach, OR 97110-3153', '4.1', '+459 (632) 433-9307', 1),
(2, 'Warwick Brussels', 'Rue Duquesnoy 5, Brussels 1000 Belgium', '3.9', '+245 (442) 254-1331', 2),
(3, 'Avenue Inn & Spa', '33 Wilmington Ave, Rehoboth Beach, DE 19971-2218', '4.2', '+69 (972) 926-0230', 3),
(4, 'Fairmont Rio de Janeiro', 'Av. Atlantica, 4240 Copacabana, Rio de Janeiro, State of Rio de Janeiro 22070-002 Brazil', '4', '+54 (827) 218-6146', 4),
(5, 'The Resident Covent Garden', '51 Bedford Street what3words Address: ///drift.every.atoms, London WC2R 0PZ England', '3.7', '+91 (995) 936-2364', 5),
(6, 'Haytor Hotel', 'Meadfoot Road, Torquay TQ1 2JP England', '4', '+430 (791) 403-9253', 6),
(7, 'Grand Elysee Hotel Hamburg', 'Rothenbaumchaussee 10, 20148 Hamburg Germany', '4.1', '+113 (574) 677-0413', 7),
(8, 'The Resident Victoria', '10 Palace Place what3words Address: ///fairly.trim.behind, London SW1E 5BW England', '3.7', '+289 (653) 448-3323', 8),
(9, 'Miyakojima Tokyo Hotel & Resorts', '914 Shimojiyonaha, Miyakojima 906-0305 Okinawa Prefecture', '4.2', '+169 (375) 630-6230', 9),
(10, 'Hotel Jakarta Amsterdam', 'Javakade 766, 1019 SH Amsterdam The Netherlands', '4.3', '+370 (931) 677-8263', 10),
(11, 'Hotel Moments Budapest', 'Andrassy ut 8., Budapest 1061 Hungary', '4.1', '+283 (785) 655-5296', 11),
(12, 'Riad Melhoun & Spa', 'No. 99 Sidi Moussa, Bahia, Marrakech 40000 Morocco', '4.3', '+496 (688) 451-2328', 12),
(13, 'Hotel 1898', 'La Rambla, 109, 08001 Barcelona Spain', '4.4', '+129 (922) 845-1533', 13),
(14, 'Hyatt Regency Vancouver', '655 Burrard Street, Vancouver, British Columbia V6C 2R7 Canada', '3.9', '+18 (104) 250-4546', 14),
(15, 'Zrinka House', 'Grabovac 209, Grabovac, Plitvice Lakes National Park 47246 Croatia', '4.4', '+137 (157) 763-6699', 15),
(16, 'The Peninsula Manila', 'Corner of Ayala and Makati Avenues, Makati, Luzon 1226 Philippines', '4.1', '+304 (965) 426-6733', 16);

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` int(11) NOT NULL,
  `filename` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `filename`) VALUES
(1, 'assets/img/hotel_01.jpg'),
(2, 'assets/img/hotel_02.jpg'),
(3, 'assets/img/hotel_03.jpg'),
(4, 'assets/img/hotel_04.jpg'),
(5, 'assets/img/hotel_05.jpg'),
(6, 'assets/img/hotel_06.jpg'),
(7, 'assets/img/hotel_07.jpg'),
(8, 'assets/img/hotel_08.jpg'),
(9, 'assets/img/hotel_09.jpg'),
(10, 'assets/img/hotel_10.jpg'),
(11, 'assets/img/hotel_11.jpg'),
(12, 'assets/img/hotel_12.jpg'),
(13, 'assets/img/hotel_13.jpg'),
(14, 'assets/img/hotel_14.jpg'),
(15, 'assets/img/hotel_15.jpg'),
(16, 'assets/img/hotel_16.jpg');

-- --------------------------------------------------------

--
-- Indexes for dumped tables
--

--
-- Indexes for table `festivals`
--
ALTER TABLE `hotels`
  ADD PRIMARY KEY (`id`),
  ADD KEY `hotels_image_fk` (`image_id`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

-- --------------------------------------------------------

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `festivals`
--
ALTER TABLE `hotels`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

-- --------------------------------------------------------

--
-- Constraints for dumped tables
--

--
-- Constraints for table `festivals`
--
ALTER TABLE `hotels`
  ADD CONSTRAINT `hotels_image_fk` FOREIGN KEY (`image_id`) REFERENCES `images` (`id`);

-- --------------------------------------------------------