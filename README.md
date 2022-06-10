# Exchange

## About Exchange

Exchange is a simple bureau de change book keeping web application. This application uses schedules to generate daily summary reports. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

Technologies used for building this application are

- [Laravel](https://laravel.com)
- [InertiaJs](https://inertiajs.com)
- [TailwindCSS](https://tailwindcss.com/)


## Application Highlights

Application uses breeze for quick authentication.

Schedules are used for generating the report summary records. Daily reports are generated for each day and updated as transaction events occur.

As transaction events occur, the application uses listeners to update the day's report summary. The application uses the database to queue the listener actions.
