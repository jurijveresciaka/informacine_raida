USE  `TURKISH_INSURANCE`;

-- ///////////////////////////////////////////////////////////////////////////
-- 01. Insert data into `CUSTOMER` table
-- ///////////////////////////////////////////////////////////////////////////

INSERT INTO `CUSTOMER` (`customer_id`, `first_name`, `second_name`, `phone`, `email`) VALUES
( 1, 'David' , 'Kroenke'   , '+11111111', 'david.kroenke@gmail.com'  ),
( 2, 'David' , 'Auer'      , '+22222222', 'david.Auer@gmail.com'     ),
( 3, 'Ronald', 'Graham'    , '+33333333', 'Ronald.Graham@gmail.com'  ),
( 4, 'Donald', 'Knuth'     , '+44444444', 'Donald.Knuth@gmail.com'   ),
( 5, 'Oren'  , 'Patashnik' , '+55555555', 'Oren.Patashnik@gmail.com' ),
( 6, 'Paul'  , 'Deitel'    , '+66666666', 'Paul.Deitel@gmail.com'    ),
( 7, 'Harvey', 'Deitel'    , '+77777777', 'Harvey.Deitel@gmail.com'  ),
( 8, 'Hans'  , 'Christian' , '+88888888', 'Hans.Christian@gmail.com' ),
( 9, 'Maja'  , 'Dusikova'  , '+99999999', 'Maja.Dusikova@gmail.com'  ),
(10, 'Jerry' , 'Pinkney'   , '+10101010', 'Jerry.Pinkney@gmail.com'  );

-- ///////////////////////////////////////////////////////////////////////////
-- 02. Insert data into `INSURANCE_PLAN` table
-- ///////////////////////////////////////////////////////////////////////////

INSERT INTO `INSURANCE_PLAN` (`insurance_plan_id`, `title`, `daily_rate`) VALUES
( 1, 'family'     , 50.00),
( 2, 'personmal'  , 40.00),
( 3, 'business'   , 30.00),
( 4, 'vacations'  , 20.00);

-- ///////////////////////////////////////////////////////////////////////////
-- 03. Insert data into `INSURANCE_CONTRACT` table
-- ///////////////////////////////////////////////////////////////////////////

INSERT INTO `INSURANCE_CONTRACT` (`insurance_contract_id`, `start_date`, `end_date`, `price`, `customer_id`, `insurance_plan_id`) VALUES
( 1, '2014-01-01' , '2014-02-01', 1550.00, 1, 1),
( 2, '2014-01-02' , '2014-02-02', 1550.00, 2, 1),
( 3, '2014-01-03' , '2014-02-03', 1550.00, 3, 1),
( 4, '2014-01-04' , '2014-02-04', 1550.00, 4, 1),
( 5, '2014-01-05' , '2014-02-05', 1550.00, 5, 1),
( 6, '2014-01-10' , '2014-02-10', 1550.00, 6, 1),
( 7, '2014-01-11' , '2014-02-11', 1550.00, 7, 1);