-- Active: 1694423108902@@127.0.0.1@3306@todophp
use todophp;

SELECT * from tasks;
SELECT * from users;
INSERT INTO tasks (user_id, title, description, due_date, created_at, completed) VALUES
(1, 'Finish Project Proposal', 'Write and finalize the project proposal document for submission.', '2024-02-28', '2024-02-14 10:00:00', 0),
(1, 'Prepare Presentation Slides', 'Create slides for the project presentation meeting next week.', '2024-03-05', '2024-02-15 14:30:00', 0),
(2, 'Review Marketing Campaign', 'Evaluate the effectiveness of the current marketing campaign and propose improvements.', '2024-03-10', '2024-02-16 09:45:00', 0),
(2, 'Conduct Market Research', 'Gather data and insights about the target market demographics and preferences.', '2024-03-01', '2024-02-17 11:20:00', 0),
(3, 'Update Website Content', 'Update website content with the latest product information and features.', '2024-02-25', '2024-02-18 13:15:00', 0),
(3, 'Respond to Customer Inquiries', 'Address customer inquiries and provide support via email and chat.', '2024-03-15', '2024-02-19 16:40:00', 0);



INSERT INTO tasks (user_id, title, description, due_date, completed) VALUES
(1, 'Grocery shopping', 'Pick up milk, eggs, bread, and bananas.', '2024-02-20', 0),
(2, 'Write blog post', 'Finish drafting the post on "5 Tips for Time Management".', '2024-02-22', 0),
(3, 'Clean the house', 'Dust furniture, vacuum carpets, mop floors.', '2024-02-24', 0),
(1, 'Pay bills', 'Set up online payments for electricity, water, and internet.', '2024-02-25', 0),
(2, 'Learn a new skill', 'Take an online course on basic web development.', '2024-03-03', 0),
(3, 'Organize paperwork', 'File documents, receipts, and other important papers.', '2024-03-05', 0),
(1, 'Go for a run', 'Run a 5K race for charity.', '2024-03-10', 0),
(2, 'Meet with friends', 'Catch up with friends over coffee or lunch.', '2024-03-12', 0);


SELECT * from users;
INSERT INTO tasks (user_id, title, description, due_date, completed) VALUES
(1, 'Pick up birthday gift for friend', 'Get a thoughtful gift for Mary\'s birthday.', '2024-02-29', 0),
(2, 'Plan weekend getaway', 'Choose a destination and book accommodations for a relaxing trip.', '2024-03-23', 0),
(3, 'Organize closet', 'Sort clothes, declutter items, and fold everything neatly.', '2024-03-16', 0),
(8, 'Call parents', 'Catch up with parents and share recent news.', '2024-02-23', 1),
(3, 'Brainstorm project ideas', 'Come up with new and innovative ideas for the upcoming project.', '2024-02-27', 0),
(1, 'Create presentation slides', 'Design engaging and informative slides for the upcoming client meeting.', '2024-03-07', 0),
(2, 'Review performance report', 'Analyze personal performance metrics and identify areas for improvement.', '2024-03-09', 0),
(3, 'Follow up with client', 'Send a follow-up email after the meeting to address any remaining questions.', '2024-02-24', 1),
(8, 'Go for a hike', 'Explore a new trail and enjoy the fresh air.', '2024-03-02', 0),
(1, 'Cook a healthy breakfast', 'Prepare a nutritious and delicious meal to start the day.', '2024-02-26', 0),
(2, 'Schedule gym session', 'Book a time for a workout at the gym.', '2024-03-06', 0),
(3, 'Meditate for 10 minutes', 'Reduce stress and improve focus with a short meditation session.', '2024-02-22', 1),
(8, 'Balance checkbook', 'Reconcile bank statements and ensure accurate financial records.', '2024-03-05', 0),
(1, 'Set budget for next month', 'Allocate funds for different categories like groceries, bills, and entertainment.', '2024-03-01', 0),
(2, 'Research retirement options', 'Explore different investment options for future financial security.', '2024-03-10', 0),
(3, 'Pay off credit card debt', 'Make a payment towards eliminating credit card debt.', '2024-02-28', 1);



INSERT INTO tasks (user_id, title, description, due_date, completed, priority) VALUES


(8, 'Visit dentist', 'Schedule a checkup and cleaning.', '2024-02-10', 0, 'High'),
(3, 'Learn a new language', 'Start basic lessons in Spanish using an app.', '2024-01-31', 0, 'Medium'),
(1, 'Plan summer vacation', 'Research destinations and book accommodations.', '2024-05-20', 0, 'High'), 
(2, 'Update resume', 'Highlight recent skills and achievements to showcase experience.', '2024-03-15', 0, 'Medium'), 
(3, 'Buy birthday gift for brother', 'Find a unique and thoughtful present for his special day.', '2024-02-12', 1, 'High'), 
(8, 'Organize photos', 'Sort and categorize pictures from recent trips.', '2024-02-25', 0, 'High'), 
(1, 'Fix leaky faucet', 'Repair the dripping faucet in the kitchen sink.', '2023-12-20', 1, 'High'), 
(2, 'Volunteer at local shelter', 'Help out at the animal shelter with various tasks.', '2024-03-25', 0, 'High'), 
(3, 'Start home improvement project', 'Begin painting the living room in a new color.', '2024-01-20', 0, 'Medium'), 
(8, 'Learn to cook a new dish', 'Master a signature recipe to impress friends and family.', '2024-04-08', 0, 'High'), 
(1, 'Read classic novel', 'Start "Moby Dick" and delve into the literary adventure.', '2024-02-05', 0, 'Medium'),
(2, 'Attend industry conference', 'Network with professionals and learn about industry trends.', '2024-04-12', 0, 'High'),
(3, 'Donate to charity', 'Support a cause close to your heart with a financial contribution.', '2024-02-14', 1, 'High'), 
(8, 'Go for a run', 'Start a regular running routine to improve fitness.', '2024-02-17', 0, 'Medium'), 
(1, 'Clean out attic', 'Sort through belongings and discard unnecessary items.', '2024-01-25', 0, 'High');
;