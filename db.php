<?php

$conn = new PDO('sqlite:../todo.db');

$conn->exec('CREATE TABLE IF NOT EXISTS user (
                id INTEGER PRIMARY KEY,
                name TEXT UNIQUE,
                password TEXT
            );
            CREATE TABLE IF NOT EXISTS todo (
                id INTEGER PRIMARY KEY,
                description TEXT,
                user_id INTEGER,
                FOREIGN KEY(user_id) REFERENCES user(id)
            )');