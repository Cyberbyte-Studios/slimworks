
-----------------------------------------------------------------------
-- users
-----------------------------------------------------------------------

DROP TABLE IF EXISTS [users];

CREATE TABLE [users]
(
    [id] INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
    [steamid] INTEGER,
    [first_name] VARCHAR(50),
    [last_name] VARCHAR(50),
    [username] VARCHAR(50),
    [email] VARCHAR(100),
    [password] VARCHAR(100),
    UNIQUE ([steamid]),
    UNIQUE ([id])
);
