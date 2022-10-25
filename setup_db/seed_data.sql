INSERT INTO questions(id, content) VALUES (1, '北斗七星はある星座のしっぽと言われていますがその星座は？');
INSERT INTO questions(id, content) VALUES (2, 'この中で一番明るい星はどれでしょう？');
INSERT INTO questions(id, content) VALUES (3, 'アルクトゥルスは何座の中にある星？');
INSERT INTO questions(id, content) VALUES (4, '全天に星座はいくつあるでしょう？');
INSERT INTO questions(id, content) VALUES (5, '全天で最も小さい星座はどれでしょう？');
INSERT INTO questions(id, content) VALUES (6, '全天で最も大きい星座はどれでしょう？');
INSERT INTO questions(id, content) VALUES (7, '次の星座のうち、日本からは全く見えない星座はどれでしょう？');
INSERT INTO questions(id, content) VALUES (8, '2つの1等星をもつ星座は、オリオン座、みなみじゅうじ座と何座?');
INSERT INTO questions(id, content) VALUES (9, '日本でも南十字星が見える場所は？');
INSERT INTO questions(id, content) VALUES (10, 'みずがめ座の別名は？');
INSERT INTO questions(id, content) VALUES (11, 'ベテルギウスとリゲルという二つの一等星を持つ星座は？');
INSERT INTO questions(id, content) VALUES (12, 'プロキオンを一等星に持つ星座は？');
INSERT INTO questions(id, content) VALUES (13, 'シリウスを一等星に持つ星座は？');


INSERT INTO choices(id, content, result_flg, questions_id) VALUES (1, 'こいぬ座', 0, 1);
INSERT INTO choices(id, content, result_flg, questions_id) VALUES (2, 'おおぐま座', 1, 1);
INSERT INTO choices(id, content, result_flg, questions_id) VALUES (3, 'おおいぬ座', 0, 1);
INSERT INTO choices(id, content, result_flg, questions_id) VALUES (4, 'こぐま座', 0, 1);
INSERT INTO choices(id, content, result_flg, questions_id) VALUES (5, 'シリウス', 1, 2);
INSERT INTO choices(id, content, result_flg, questions_id) VALUES (6, 'スピカ', 0, 2);
INSERT INTO choices(id, content, result_flg, questions_id) VALUES (7, 'プロキオン', 0, 2);
INSERT INTO choices(id, content, result_flg, questions_id) VALUES (8, 'ペテルギウス', 0, 2);
INSERT INTO choices(id, content, result_flg, questions_id) VALUES (9, 'かんむり座', 0, 3);
INSERT INTO choices(id, content, result_flg, questions_id) VALUES (10, 'りょうけん座', 0, 3);
INSERT INTO choices(id, content, result_flg, questions_id) VALUES (11, 'ケンタウルス座', 0, 3);
INSERT INTO choices(id, content, result_flg, questions_id) VALUES (12, 'うしかい座', 1, 3);
INSERT INTO choices(id, content, result_flg, questions_id) VALUES (13, '48星座', 0, 4);
INSERT INTO choices(id, content, result_flg, questions_id) VALUES (14, '68星座', 0, 4);
INSERT INTO choices(id, content, result_flg, questions_id) VALUES (15, '88星座', 1, 4);
INSERT INTO choices(id, content, result_flg, questions_id) VALUES (16, '108星座', 0, 4);
INSERT INTO choices(id, content, result_flg, questions_id) VALUES (17, 'や座', 0, 5);
INSERT INTO choices(id, content, result_flg, questions_id) VALUES (18, 'こうま座', 0, 5);
INSERT INTO choices(id, content, result_flg, questions_id) VALUES (19, 'みなみじゅうじ座', 1, 5);
INSERT INTO choices(id, content, result_flg, questions_id) VALUES (20, 'はえ座', 0, 5);
INSERT INTO choices(id, content, result_flg, questions_id) VALUES (21, 'くじら座', 0, 6);
INSERT INTO choices(id, content, result_flg, questions_id) VALUES (22, 'おおぐま座', 0, 6);
INSERT INTO choices(id, content, result_flg, questions_id) VALUES (23, 'おとめ座', 0, 6);
INSERT INTO choices(id, content, result_flg, questions_id) VALUES (24, 'うみへび座', 1, 6);
INSERT INTO choices(id, content, result_flg, questions_id) VALUES (25, 'はちぶんぎ座', 1, 7);
INSERT INTO choices(id, content, result_flg, questions_id) VALUES (26, 'ろくぶんぎ座', 0, 7);
INSERT INTO choices(id, content, result_flg, questions_id) VALUES (27, 'みなみじゅうじ座', 0, 7);
INSERT INTO choices(id, content, result_flg, questions_id) VALUES (28, 'みなみのうお座', 0, 7);
INSERT INTO choices(id, content, result_flg, questions_id) VALUES (29, 'しし座', 0, 8);
INSERT INTO choices(id, content, result_flg, questions_id) VALUES (30, 'はくちょう座', 0, 8);
INSERT INTO choices(id, content, result_flg, questions_id) VALUES (31, 'ケンタウルス座', 1, 8);
INSERT INTO choices(id, content, result_flg, questions_id) VALUES (32, 'ケフェウス座', 0, 8);
INSERT INTO choices(id, content, result_flg, questions_id) VALUES (33, '北海道', 0, 9);
INSERT INTO choices(id, content, result_flg, questions_id) VALUES (34, '千葉', 0, 9);
INSERT INTO choices(id, content, result_flg, questions_id) VALUES (35, '長崎', 0, 9);
INSERT INTO choices(id, content, result_flg, questions_id) VALUES (36, '沖縄', 1, 9);
INSERT INTO choices(id, content, result_flg, questions_id) VALUES (37, 'ポカリスエット', 0, 10);
INSERT INTO choices(id, content, result_flg, questions_id) VALUES (38, 'アクエリアス', 1, 10);
INSERT INTO choices(id, content, result_flg, questions_id) VALUES (39, 'オロナミン', 0, 10);
INSERT INTO choices(id, content, result_flg, questions_id) VALUES (40, 'アオジル', 0, 10);
INSERT INTO choices(id, content, result_flg, questions_id) VALUES (41, 'おおいぬ座', 0, 11);
INSERT INTO choices(id, content, result_flg, questions_id) VALUES (42, 'オリオン座', 1, 11);
INSERT INTO choices(id, content, result_flg, questions_id) VALUES (43, 'はくちょう座', 0, 11);
INSERT INTO choices(id, content, result_flg, questions_id) VALUES (44, 'こいぬ座', 0, 11);
INSERT INTO choices(id, content, result_flg, questions_id) VALUES (45, 'こと座', 0, 12);
INSERT INTO choices(id, content, result_flg, questions_id) VALUES (46, 'オリオン座', 0, 12);
INSERT INTO choices(id, content, result_flg, questions_id) VALUES (47, 'はくちょう座', 0, 12);
INSERT INTO choices(id, content, result_flg, questions_id) VALUES (48, 'こいぬ座', 1, 12);
INSERT INTO choices(id, content, result_flg, questions_id) VALUES (49, 'おおいぬ座', 1, 13);
INSERT INTO choices(id, content, result_flg, questions_id) VALUES (50, 'わし座', 0, 13);
INSERT INTO choices(id, content, result_flg, questions_id) VALUES (51, 'はくちょう座', 0, 13);
INSERT INTO choices(id, content, result_flg, questions_id) VALUES (52, 'こいぬ座', 0, 13);


INSERT INTO answer_history(id, users_id, choices_id1, choices_id2, choices_id3, choices_id4, choices_id5, choices_id6, choices_id7, choices_id8, choices_id9, choices_id10)
VALUES (1, 1, 2, 5, 12, 15, 19, 24, 28, 31, 36, 38);


INSERT INTO users(id, email, password) VALUES (1, 'example@gmail.com', '1234abc');


INSERT INTO user_detail(id, name, address_id, birthday, tel, works_id, users_id) VALUES (1, 'まりえ', 1, '1994/7/14', '090-1234-5678', 2, 1);


INSERT INTO status(id, status) VALUES (1,'ユーザー');
INSERT INTO status(id, status) VALUES (2,'管理者');


INSERT INTO addresss(id, address) VALUES (1, '北海道');
INSERT INTO addresss(id, address) VALUES (2, '青森');
INSERT INTO addresss(id, address) VALUES (3, '岩手');
INSERT INTO addresss(id, address) VALUES (4, '宮城');
INSERT INTO addresss(id, address) VALUES (5, '秋田');
INSERT INTO addresss(id, address) VALUES (6, '山形');
INSERT INTO addresss(id, address) VALUES (7, '福島');
INSERT INTO addresss(id, address) VALUES (8, '茨城');
INSERT INTO addresss(id, address) VALUES (9, '栃木');
INSERT INTO addresss(id, address) VALUES (10, '群馬');
INSERT INTO addresss(id, address) VALUES (11, '埼玉');
INSERT INTO addresss(id, address) VALUES (12, '千葉');
INSERT INTO addresss(id, address) VALUES (13, '東京');
INSERT INTO addresss(id, address) VALUES (14, '神奈川');
INSERT INTO addresss(id, address) VALUES (15, '新潟');
INSERT INTO addresss(id, address) VALUES (16, '富山');
INSERT INTO addresss(id, address) VALUES (17, '石川');
INSERT INTO addresss(id, address) VALUES (18, '福井');
INSERT INTO addresss(id, address) VALUES (19, '山梨');
INSERT INTO addresss(id, address) VALUES (20, '長野');
INSERT INTO addresss(id, address) VALUES (21, '岐阜');
INSERT INTO addresss(id, address) VALUES (22, '静岡');
INSERT INTO addresss(id, address) VALUES (23, '愛知');
INSERT INTO addresss(id, address) VALUES (24, '三重');
INSERT INTO addresss(id, address) VALUES (25, '滋賀');
INSERT INTO addresss(id, address) VALUES (26, '京都');
INSERT INTO addresss(id, address) VALUES (27, '大阪');
INSERT INTO addresss(id, address) VALUES (28, '兵庫');
INSERT INTO addresss(id, address) VALUES (29, '奈良');
INSERT INTO addresss(id, address) VALUES (30, '和歌山');
INSERT INTO addresss(id, address) VALUES (31, '鳥取');
INSERT INTO addresss(id, address) VALUES (32, '島根');
INSERT INTO addresss(id, address) VALUES (33, '岡山');
INSERT INTO addresss(id, address) VALUES (34, '広島');
INSERT INTO addresss(id, address) VALUES (35, '山口');
INSERT INTO addresss(id, address) VALUES (36, '徳島');
INSERT INTO addresss(id, address) VALUES (37, '香川');
INSERT INTO addresss(id, address) VALUES (38, '愛媛');
INSERT INTO addresss(id, address) VALUES (39, '高知');
INSERT INTO addresss(id, address) VALUES (40, '福岡');
INSERT INTO addresss(id, address) VALUES (41, '佐賀');
INSERT INTO addresss(id, address) VALUES (42, '長崎');
INSERT INTO addresss(id, address) VALUES (43, '熊本');
INSERT INTO addresss(id, address) VALUES (44, '大分');
INSERT INTO addresss(id, address) VALUES (45, '宮崎');
INSERT INTO addresss(id, address) VALUES (46, '鹿児島');
INSERT INTO addresss(id, address) VALUES (47, '沖縄');

INSERT INTO works(id, work) VALUES (1, 'メーカー・製造業');
INSERT INTO works(id, work) VALUES (2, 'サービス業');
INSERT INTO works(id, work) VALUES (3, 'インフラ');
INSERT INTO works(id, work) VALUES (4, '商社');
INSERT INTO works(id, work) VALUES (5, '金融');
INSERT INTO works(id, work) VALUES (6, '情報');
INSERT INTO works(id, work) VALUES (7, 'マスコミ');
INSERT INTO works(id, work) VALUES (8, '百貨店・小売');
INSERT INTO works(id, work) VALUES (9, 'その他');