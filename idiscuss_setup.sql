-- iDiscuss sample database setup
-- Compatible with MySQL 8.x. Safe to rerun on this sample schema:
-- it does not drop tables or delete existing data.
-- Note: INSERT IGNORE avoids duplicate sample IDs on reruns.

CREATE DATABASE IF NOT EXISTS idiscuss
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

USE idiscuss;

CREATE TABLE IF NOT EXISTS categories (
    category_id INT NOT NULL AUTO_INCREMENT,
    category_name VARCHAR(255) NOT NULL,
    category_description TEXT NOT NULL,
    created DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (category_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS users (
    user_id INT NOT NULL AUTO_INCREMENT,
    user_email VARCHAR(255) NOT NULL,
    user_pass VARCHAR(255) NOT NULL,
    `timestamp` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (user_id),
    UNIQUE KEY uq_users_email (user_email)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS threads (
    thread_id INT NOT NULL AUTO_INCREMENT,
    thread_title VARCHAR(255) NOT NULL,
    thread_desc TEXT NOT NULL,
    thread_user_id INT NOT NULL,
    thread_cat_id INT NOT NULL,
    `timestamp` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (thread_id),
    FULLTEXT KEY ft_threads_title_desc (thread_title, thread_desc),
    KEY idx_threads_category (thread_cat_id),
    KEY idx_threads_user (thread_user_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS comments (
    comment_id INT NOT NULL AUTO_INCREMENT,
    comment_content TEXT NOT NULL,
    thread_id INT NOT NULL,
    comment_by INT NOT NULL,
    `timestamp` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (comment_id),
    KEY idx_comments_thread (thread_id),
    KEY idx_comments_user (comment_by)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Sample accounts are display-only. Their passwords are not valid login hashes.
INSERT IGNORE INTO categories
    (category_id, category_name, category_description)
VALUES
    (1, 'Programming', 'Discuss programming languages, coding, and software development.'),
    (2, 'Web Development', 'Discuss HTML, CSS, JavaScript, PHP, and web technologies.'),
    (3, 'Machine Learning', 'Discuss machine learning, AI, and data science.'),
    (4, 'Competitive Programming', 'Discuss algorithms, data structures, and coding contests.');

INSERT IGNORE INTO users (user_id, user_email, user_pass)
VALUES
    (1, 'rahul@example.com', 'sample-only-not-a-login-password'),
    (2, 'priya@example.com', 'sample-only-not-a-login-password'),
    (3, 'amit@example.com', 'sample-only-not-a-login-password');

INSERT IGNORE INTO threads
    (thread_id, thread_title, thread_desc, thread_user_id, thread_cat_id)
VALUES
    (1, 'How do I start learning C++?',
     'I am new to programming. Which topics should I learn first in C++?', 1, 1),
    (2, 'How should I get started with React?',
     'I know HTML, CSS, and basic JavaScript. What should I learn next?', 2, 2),
    (3, 'What is overfitting in machine learning?',
     'Can someone explain overfitting with a simple example and ways to prevent it?', 3, 3),
    (4, 'How can I improve on Codeforces?',
     'I can solve some beginner problems. How should I build my problem-solving skills?', 1, 4),
    (5, 'Pointers vs references in C++',
     'I get confused about pointers and references. When should I use each?', 2, 1),
    (6, 'How does CSS Flexbox work?',
     'I want to understand the main concepts of Flexbox and how it differs from Grid.', 3, 2);

INSERT IGNORE INTO comments
    (comment_id, comment_content, thread_id, comment_by)
VALUES
    (1, 'Start with variables, loops, functions, and arrays. Then move to pointers and OOP.', 1, 2),
    (2, 'Build small projects while learning. Practice is important.', 1, 3),
    (3, 'Make sure your JavaScript fundamentals are strong before jumping into React.', 2, 1),
    (4, 'Overfitting happens when a model learns training data too closely and does not generalize well.', 3, 2),
    (5, 'Practice topics you are weak at, and review the solutions after solving.', 4, 3),
    (6, 'A pointer stores an address, while a reference is an alias for an existing variable.', 5, 1);

-- Example full-text search:
-- SELECT * FROM threads
-- WHERE MATCH(thread_title, thread_desc) AGAINST ('codeforces');
