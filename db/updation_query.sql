use todophp;
ALTER TABLE tasks ADD COLUMN priority VARCHAR(50) NOT NULL DEFAULT 'Medium';
ALTER TABLE users ADD COLUMN failed_attempts VARCHAR(50);




SELECT * from tasks;