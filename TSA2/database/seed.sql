USE tasks_today_tsa2;

INSERT INTO tasks (title, status, task_date, created_at, is_archived) VALUES
('Review the project timeline', 'pending', CURDATE(), NOW(), 0),
('Send the weekly team update', 'in progress', CURDATE(), NOW(), 0),
('Pick up groceries for dinner', 'pending', CURDATE(), NOW(), 0),
('Take a proper lunch break', 'completed', CURDATE(), NOW(), 0),
('Book the annual checkup', 'pending', DATE_ADD(CURDATE(), INTERVAL 1 DAY), NOW(), 0),
('Prepare notes for the planning meeting', 'pending', DATE_ADD(CURDATE(), INTERVAL 1 DAY), NOW(), 0),
('Return the library books', 'completed', DATE_SUB(CURDATE(), INTERVAL 1 DAY), NOW(), 0),
('Water the balcony plants', 'pending', DATE_SUB(CURDATE(), INTERVAL 1 DAY), NOW(), 0);

INSERT INTO users (username, full_name, email, password, created_at) VALUES
('alexmorgan', 'Alex Morgan', 'alex.morgan@example.com', '$2y$10$WoLPOwjs4QhR6srgjZBm5e6VwMIJInuaR87Z8FMeN8oq6TDyGdjEm', NOW());
