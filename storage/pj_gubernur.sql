INSERT INTO
    `receivers` (
        `id`,
        `name`,
        `type`,
        `biro_id`,
        `description`,
        `created_at`,
        `updated_at`
    )
VALUES (
        NULL,
        'PJ. GUBERNUR',
        '1',
        NULL,
        NULL,
        NULL,
        NULL
    );

INSERT INTO
    `users` (
        `id`,
        `type`,
        `biro_id`,
        `receiver_id`,
        `username`,
        `name`,
        `email`,
        `wa`,
        `email_verified_at`,
        `password`,
        `disposition_password`,
        `remember_token`,
        `created_at`,
        `updated_at`,
        `deleted_at`
    )
VALUES (
        NULL,
        0,
        NULL,
        1974,
        'pj_gubernur',
        'AKMAL MALIK',
        'pj_gubernur@gmail.com',
        '6282255682584',
        '2023-10-06 09:24:10',
        '$2y$10$97ZIwaVBP.l0B.eH1sdSieSxQbbDu/PYjWTTAMLjaxRuLzKdjPdDW',
        NULL,
        NULL,
        '2023-10-06 09:25:11',
        '2023-10-06 09:25:11',
        NULL
    );