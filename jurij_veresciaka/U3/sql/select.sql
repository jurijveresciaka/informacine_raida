USE  `TURKISH_INSURANCE`;

-- ///////////////////////////////////////////////////////////////////////////
-- Show `CUSTOMERS` with `INSURANCE_CONTRACT` end_date in next week
-- ///////////////////////////////////////////////////////////////////////////

SELECT 'Show `CUSTOMERS` with `INSURANCE_CONTRACT` end_date in next week' AS 'Title';
SELECT
    `CUSTOMER`.`first_name`   AS 'First Name',
    `CUSTOMER`.`second_name`  AS 'Second Name',
    `CUSTOMER`.`phone`        AS 'Phone',
    `CUSTOMER`.`email`        AS 'Email'
FROM `CUSTOMER`
	INNER JOIN `INSURANCE_CONTRACT` ON `CUSTOMER`.`customer_id` = `INSURANCE_CONTRACT`.`customer_id`
  WHERE
    (
      ('2014-02-01' +
      INTERVAL (7 - IF(DAYOFWEEK('2014-02-01') = 1, 7, DAYOFWEEK('2014-02-01') - 1)) DAY
      ) < (`INSURANCE_CONTRACT`.`end_date`)
    ) AND
    (
      ('2014-02-01' +
      INTERVAL (7 - IF(DAYOFWEEK('2014-02-01') = 1, 7, DAYOFWEEK('2014-02-01') - 1)) + 7 DAY
      ) >= (`INSURANCE_CONTRACT`.`end_date`)
    )    
;