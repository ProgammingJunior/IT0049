USE tasks_today;

INSERT INTO tasks (title, status, task_date, created_at) VALUES
('Review the project timeline', 'pending', CURDATE(), NOW()),
('Send the weekly team update', 'in progress', CURDATE(), NOW()),
('Pick up groceries for dinner', 'pending', CURDATE(), NOW()),
('Take a proper lunch break', 'completed', CURDATE(), NOW()),
('Book the annual checkup', 'pending', DATE_ADD(CURDATE(), INTERVAL 1 DAY), NOW()),
('Prepare notes for the planning meeting', 'pending', DATE_ADD(CURDATE(), INTERVAL 1 DAY), NOW()),
('Return the library books', 'completed', DATE_SUB(CURDATE(), INTERVAL 1 DAY), NOW()),
('Water the balcony plants', 'pending', DATE_SUB(CURDATE(), INTERVAL 1 DAY), NOW());

INSERT INTO users (username, full_name, email, created_at) VALUES
('alexmorgan', 'Alex Morgan', 'alex.morgan@example.com', NOW());