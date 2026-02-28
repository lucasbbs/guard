CREATE TABLE users (
  id INTEGER PRIMARY KEY AUTOINCREMENT,
  name varchar(255) NOT NULL,
  email varchar(255) NOT NULL UNIQUE,
  password varchar(255) NOT NULL
);

CREATE TABLE notes (
  id INTEGER PRIMARY KEY AUTOINCREMENT,
  user_id INTEGER,
  title varchar(255) NOT NULL,
  note TEXT NOT NULL,
  created_at timestamp,
  updated_at timestamp,
  FOREIGN KEY (user_id) REFERENCES users (id)
);
