# News Laravel

News Laravel is a Laravel-based project for managing and displaying news articles. It includes features for fetching articles from external sources and allows users to customize their news preferences.

## Setup

1. **Environment:**
   - Create an `.env` file in the project root.
   - Configure environmental variables. Use `.env.example` as a reference.

2. **Laravel Sail:**
   - Use the following alias for Laravel Sail:
     ```bash
     alias sail='[ -f sail ] && sh sail || sh vendor/bin/sail'
     ```

3. **Run Migrations:**
   - Execute the following command:
     ```bash
     sail artisan migrate
     ```

4. **Run the Project:**
   - Start the Laravel project using Sail:
     ```bash
     sail artisan up
     ```

5. **API Documentation:**
   - Generate API documentation with Laravel Swagger:
     ```bash
     sail artisan l5-swagger:generate
     ```

6. **Run Jobs:**
   - Run the job queue for processing background jobs:
     ```bash
     sail artisan queue:work
     ```

7. **Scheduled Jobs:**
   - Execute scheduled jobs and console commands:
     ```bash
     sail artisan schedule:run
     ```

## Additional Notes

- Customize your `.env` file with specific configurations.
- Refer to Laravel and Sail documentation for detailed information.

## Contributors

- [AJITH SIMON]