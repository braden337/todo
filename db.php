<?php

$conn = new PDO('sqlite:../todo.db');

$conn->exec('CREATE TABLE IF NOT EXISTS user (
                id INTEGER PRIMARY KEY,
                email TEXT UNIQUE,
                password TEXT
            );
            CREATE TABLE IF NOT EXISTS todo (
                id INTEGER PRIMARY KEY,
                item TEXT,
                user INTEGER,
                FOREIGN KEY(user) REFERENCES user(id)
            )');