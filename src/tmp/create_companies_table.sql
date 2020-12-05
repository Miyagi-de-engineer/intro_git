CREATE TABLE companies (
    id INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255),
    establishment_date DATE,
    founder VARCHAR(255),
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
) DEFAULT CHARACTER SET=utf8mb4;


CREATE TABLE memos(
    id INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY,
    category VARCHAR(255),
    importance VARCHAR(100),
    summary TEXT(1000),
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
) DEFAULT CHARACTER SET=utf8mb4;

INSERT INTO memos(
    title,
    category,
    importance,
    summary
) VALUES (
    'tomorrow',
    'work',
    4,
    'document'
);

DELETE FROM memos WHERE id = '1';

ALTER TABLE memos
ADD title VARCHAR(255) AFTER id;

INSERT INTO reviews(
    title,
    author,
    status,
    score,
    summary
) VALUES (
    'Disney',
    'Wolt',
    'complete',
    100,
    'specialDay'
);
