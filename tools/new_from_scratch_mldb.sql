DROP TABLE USERS;

CREATE TABLE USERS
(
    ID              INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
    valid           BOOLEAN,
    timeout         VARCHAR(50),
    usernameFB      VARCHAR(50),      
    idFB            VARCHAR(50),
    first_nameFB    VARCHAR(50),
    last_nameFB     VARCHAR(50),
    emailFB         VARCHAR(50),
    genderFB        VARCHAR(10),
    reg_time        VARCHAR(50),
    NOTE            TEXT
) ;
