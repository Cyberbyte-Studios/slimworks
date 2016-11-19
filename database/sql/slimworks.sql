
-----------------------------------------------------------------------
-- users
-----------------------------------------------------------------------

DROP TABLE IF EXISTS [users];

CREATE TABLE [users]
(
    [id] INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
    [steamid] INTEGER,
    [name] VARCHAR(50),
    [avatar] VARCHAR(50),
    UNIQUE ([steamid]),
    UNIQUE ([id])
);
