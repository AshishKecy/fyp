const express = require('express');
const bodyParser = require('body-parser');

const app = express();
const port = 3000; // or any other port you prefer

// Parse URL-encoded bodies (as sent by HTML forms)
app.use(bodyParser.urlencoded({ extended: true }));

// Parse JSON bodies (as sent by API clients)
app.use(bodyParser.json());

// In-memory storage for user data (replace this with a real database in a production environment)
const users = [];

// Registration endpoint
app.post('/register', (req, res) => {
    const { email, username, password, confirmPassword } = req.body;

    // Basic validation
    if (!email || !username || !password || !confirmPassword) {
        return res.status(400).json({ success: false, message: 'All fields are required.' });
    }
    if (password !== confirmPassword) {
        return res.status(400).json({ success: false, message: 'Passwords do not match.' });
    }

    // Check if the user already exists
    if (users.find(user => user.email === email)) {
        return res.status(400).json({ success: false, message: 'Email is already registered.' });
    }

    // Create new user object
    const newUser = { email, username, password };
    users.push(newUser);

    // Return success response
    res.status(200).json({ success: true, message: 'Registration successful. You can now login.' });
});

// Start the server
app.listen(port, () => {
    console.log(`Server is listening at http://localhost:${port}`);
});
