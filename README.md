## Description
ToDo is an app for managing team tasks. You can create a new room for your team, where you will see shared tasks. Everyone on your team can join with a URL or a special unique roomID and view tasks, edit them, mark them as "in progress" or "done".

## Usage
1. Import database from `ToDo-app.sql` file.
2. Fill in database credentials in `.env.example` file and change it's name to `.env`
3. Install all required dependencies by composer.
```bash
composer install
```
4. Start docker - the app server
```bash
docker-compose up
```
## Tech stack
`PHP 8.0` `Vanilla JS` `HTML` `CSS` `Bootstrap` `MySQL` `Composer` `Docker (as a develop server)`
