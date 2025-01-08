Event-Planner-WebApp/
├── frontend/
│   ├── css/
│   │   ├── styles.css
│   │   ├── themes.css
│   ├── js/
│   │   ├── main.js
│   │   ├── chatbot.js
│   ├── assets/
│   │   ├── images/
│   │   ├── icons/
│   └── index.html
│
├── backend/
│   ├── controllers/
│   │   ├── eventController.php
│   │   ├── userController.php
│   │   ├── authController.php
│   ├── models/
│   │   ├── User.php
│   │   ├── Event.php
│   └── routes/
│       ├── api.php
│       ├── web.php
│
├── database/
│   ├── migrations/
│   │   ├── create_users_table.sql
│   │   ├── create_events_table.sql
│   ├── seeds/
│       ├── userSeeder.sql
│       ├── eventSeeder.sql
│
├── mail/
│   ├── templates/
│   │   ├── eventNotification.html
│   │   ├── passwordReset.html
│   └── mailer.php
│
├── apis/
│   ├── weatherAPI.php
│   ├── googleAPI.php
│   ├── calendarAPI.php
│
├── tests/
│   ├── integration/
│   │   ├── eventManagementTest.php
│   ├── unit/
│       ├── authTest.php
│       ├── emailTest.php
│
├── config/
│   ├── database.php
│   ├── apiKeys.php
│
├── logs/
│   └── error.log
│
├── docs/
│   ├── README.md
│   ├── design-documents/
│   │   ├── architecture.md
│   │   ├── api-docs.md
│   ├── requirements.md
│
├── .env
├── composer.json
├── package.json
├── LICENSE
└── CONTRIBUTING.md
