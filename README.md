# Event-Planner-WebApp

For our Web Programming course, we are developing a **Club Event Planner WebApp**. This project will incorporate multiple APIs to deliver a comprehensive solution. The web app will allow **admin users** to manage and add events, while **regular users** receive notifications via email. We aim to refine our approach and explore additional features as the project evolves.

---

## Key Features to Explore

Our project, **AUST Event Planner**, will include the following features:
- **Email Server Announcements:** Automate email notifications for events.
- **API Integration:**
  - Weather updates.
  - Calendar synchronization.
  - Google API for features such as "Forgot Password" and meeting scheduling.
- **Admin and User Privileges:** Secure roles with distinct functionalities.
- **Database Management:** Store email data, logs, and user information.
- **Chatbot and Q&A:** Provide a virtual assistant for queries.
- **Suggestion Box and Social Features:** Users can provide feedback, like, and share event links.
- **User Authentication:** Login system with Two-Factor Authentication (2FA).
- **Sponsors Section:** Showcase sponsors for events.
- **Contact Section:** Provide a means to connect with the team.
- **Multilingual Support:** For international projects.
- **Club Team Applications:** Allow users to apply to become part of the club team by specifying roles and reasons.
- **Session Management:** Track session time and manage cookies.

---

## Project Structure

The project will be divided into four major sections:

1. **Frontend Development:** User interface and user experience design.
2. **Backend Development:** Core logic and functionality (using PHP).
3. **API Integration:** Incorporating external APIs for additional functionalities.
4. **Mail Servers and Database:** Managing notifications, logs, and data storage.

---

## How to Currently Run This Project

1. Run the WAMP server 
2. Copy the Files inside Event-Planner-WebApp\src into an new dir in the www dir in WAMP C:\wamp64\www\Event-Planner-WebApp
3. access the site by inserting "http://localhost/Event-Planner-WebApp/"

---

## Current Features 

- Basic Front-End 
- Functional Login and Signup Pages
- Functional Redirection between Login, Signup, and Forgot your Password Pages 
- Successful implementation of Logout from sessions 
- Distinction between Admin and End-User session 
- DB tables Initialized 

## To Work On

- Adjust Front-End style especially in Admin-Panel 
- Replace Mail inout to username input for login
- Implement a Calendar showing Events in the End-User Homepage 
- Implements Weather API with the Calendar 
- Implement Authenticaor / 2FA 
- Figure out a better solution to store admin user and its related security
- Impelments the mail functionalities
- Implements the Contact functionalities 
- Separate the pages in the homepages 
- Implements Analytis in Admin-Panel
- Google meet integration 
- Multilingual Support

---

## Important Notes

1. As you may know Admin user will get access to a different page than end user amidst logging in. Right now The admin is being added into the 
   DB manually through the SQL tab in phpMyAdmin (Temporary Solution). The Default Credentials are `admin@test:admin`. To change it for now, feel free to edit its SQL 
   Statement in the `DB_Setup.sql` file before pasting it into phpMyAdmin.
   
   PS. To generate the hash of the password use the following PHP syntax 
   ```php
		echo password_hash('your-password', PASSWORD_BCRYPT);
   ```

---

## Responsibilities

Since the deadline is **next Wednesday** and our concept is still being finalized, all team members will collaborate to bring the product to life before assigning secondary tasks. Team members include:

- **Peter Chalhoub**
- **Mohammad Daaboul**
- **Paul Estephan**
- **Samy**

---

## Extras

Create a Poster, Presentation, and a Report
