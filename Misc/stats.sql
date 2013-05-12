INSERT INTO stats (stat,value) VALUES ('users',(SELECT COUNT(*) FROM users));
INSERT INTO stats (stat,value) VALUES ('sheets',(SELECT COUNT(*) FROM sheets));
INSERT INTO stats (stat,value) VALUES ('feeds',(SELECT COUNT(*) FROM feeds));
INSERT INTO stats (stat,value) VALUES ('items',(SELECT COUNT(*) FROM items));
INSERT INTO stats (stat,value) VALUES ('comments',(SELECT COUNT(*) FROM comments));