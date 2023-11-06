<?php $tableQuery = <<<EOD
    DROP TABLE IF EXISTS `dataform`;
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

    DROP TABLE IF EXISTS `datamember`;
    CREATE TABLE IF NOT EXISTS `datamember` (
        `dataMemberPrimaryKey` int(64) NOT NULL,
        `dataMemberAccountCreationDateDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT '帳號創建日期',
        `dataMemberUsernameMemberText` tinytext NOT NULL COMMENT '使用者名稱',
        `dataMemberPasswordMemberText` tinytext NOT NULL COMMENT '密碼',
        `dataMemberEmailMemberText` tinytext NOT NULL COMMENT '電子郵件'
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
EOD ?>