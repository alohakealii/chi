# 1. When people are available 
SELECT firstName, lastName, day, startTime, endTime
FROM availabilities NATURAL JOIN profiles;

# 2. Retrieving lost username for Betty Smith
SELECT username
FROM users NATURAL JOIN profiles
WHERE firstName = 'Betty' AND lastName = 'Smith';

# 3. All users who are younger than 50 and available after 3
SELECT firstName, lastName, day, startTime, endTime
FROM availabilities NATURAL JOIN profiles
WHERE age < 50 AND startTime > 3;
