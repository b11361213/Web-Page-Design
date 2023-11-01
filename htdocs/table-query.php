<?php $tableQuery = <<<EOD
    CREATE TABLE IF NOT EXISTS `dataform` (
        `dataFormPrimaryKey` int(64) NOT NULL,
        `dataFormDateOfApplicationDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT '申請日期',
        `dataFormApplyForPurposeChoice` tinytext NOT NULL COMMENT '申請項目',
        `dataFormApplicantFormText` tinytext NOT NULL COMMENT '申請人',
        `dataFormIdentityCardNumberFormText` tinytext NOT NULL COMMENT '身分證字號',
        `dataFormContactNumberFormText` tinytext NOT NULL COMMENT '連絡電話',
        `dataFormPhoneNumberFormText` tinytext NOT NULL COMMENT '手機號碼',
        `dataFormResidenceFormChoice` tinytext NOT NULL COMMENT '居住縣市',
        `dataFormAddressFormText` tinytext NOT NULL COMMENT '通訊地址'
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
EOD ?>