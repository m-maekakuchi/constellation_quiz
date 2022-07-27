INSERT INTO questions(id, content) VALUES (1, '北斗七星はある星座のしっぽと言われていますがその星座は？');
INSERT INTO questions(id, content) VALUES (2, 'この中で一番明るい星はどれでしょう？');
INSERT INTO questions(id, content) VALUES (3, 'アルクトゥルスは何座の中にある星？');

INSERT INTO choices(id, content, result_flg, questions_id) VALUES (1, 'こいぬ座', 1, 1);
INSERT INTO choices(id, content, result_flg, questions_id) VALUES (2, 'おおぐま座', 0, 1);
INSERT INTO choices(id, content, result_flg, questions_id) VALUES (3, 'おおいぬ座', 1, 1);
INSERT INTO choices(id, content, result_flg, questions_id) VALUES (4, 'こぐま座', 1, 1);
INSERT INTO choices(id, content, result_flg, questions_id) VALUES (5, 'シリウス', 0, 2);
INSERT INTO choices(id, content, result_flg, questions_id) VALUES (6, 'スピカ', 1, 2);
INSERT INTO choices(id, content, result_flg, questions_id) VALUES (7, 'プロキオン', 1, 2);
INSERT INTO choices(id, content, result_flg, questions_id) VALUES (8, 'ペテルギウス', 1, 2);
INSERT INTO choices(id, content, result_flg, questions_id) VALUES (9, 'かんむり座', 1, 3);
INSERT INTO choices(id, content, result_flg, questions_id) VALUES (10, 'りょうけん座', 1, 3);
INSERT INTO choices(id, content, result_flg, questions_id) VALUES (11, 'ケンタウルス座', 1, 3);
INSERT INTO choices(id, content, result_flg, questions_id) VALUES (12, 'うしかい座', 0, 3);


INSERT INTO answer_histroy(id, username, choices_id1, choices_id2, choices_id3)VALUES (1, 'テストユーザー', 1, 5, 11);
