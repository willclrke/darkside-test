## The Brief

The objective of this exercise is to develop a straightforward form that can save and update customer information, such as name, email, phone, and address, to a database. The preferred technologies for this task are PHP, specifically with the Laravel framework for the server-side, and VueJS for the client-side.

Please ensure that any client-side code adheres to the same principles as the server-side code. Additionally, it is essential to follow engineering best practices throughout the project.

The principles we prioritize include security, performance, readability, testability, scalability, and simplicity. Please incorporate these principles into your solution.

Furthermore, strive to achieve a clear separation of concerns between the various components of your solution. Utilizing the MVC pattern, for instance, can facilitate this separation.

If Docker is not utilized, your application should retrieve and store data by reading from and writing to a file on disk, instead of utilizing a relational or NoSQL solution for the datastore.

### How the Application Achieves This:

**Objective: Develop a straightforward form to save and update customer information**
- The form captures customer data (name, email, phone, address) and validates it. 
- It handles both the creation of new customer entries and the updating of existing ones by checking for duplicate names.

**Preferred technologies: PHP (Laravel) for server-side, Vue.js for client-side**
- The server-side code is implemented in Laravel, utilizing its features for routing, validation, and error handling. 
- The client-side is built using Vue.js, providing a reactive and component-based structure for the form.

**Adherence to the same principles as server-side code**
- The client-side code follows similar principles of validation and error handling as the server-side. For instance, both sides validate email and phone formats consistently.

**Follow engineering best practices**
- Validation: Comprehensive validation is applied on both the server (in CustomerFormController.php) and client side (in form.js).
- Error Handling: Errors are logged and user-friendly messages are returned. Validation messages are displayed in the form.
- Sanitization: Input is sanitized to prevent XSS attacks, enhancing security.

**Principles of security, performance, readability, testability, scalability, and simplicity**
- Security: CSRF protection is implemented, and input sanitization is done to mitigate XSS attacks.
- Performance: AJAX is used for form submission, enhancing user experience by avoiding full page reloads.
- Readability: The code is organized with clear naming conventions, comments and consistent formatting, making it easy to read and understand.
- Testability: Methods in form.js and CustomerFormController are structured for easy unit testing, especially validation functions.
- Scalability: The design allows for easy addition of fields or features, and separation of components using MVC pattern allows for a modular design to easily scale in the future.
- Simplicity: The overall structure is straightforward, allowing for easy modifications and maintenance.

**Separation of concerns between components, uilization of the MVC pattern**
- Model: CustomerFormModel.php handles data retrieval and storage.
- View: CustomerForm.vue presents the user interface.
- Controller: CustomerFormController.php manages data flow and logic.
- Modular Design: The form logic is moved to form.js, separating concerns and improving maintainability.

**Docker usage and file-based data storage**
- Docker is not utilized, so the app retrieves and stores data in a JSON file (CustomerData.json), fulfilling the requirement to avoid using relational or NoSQL databases, while providing a simple data management solution.


## Skills/Abilities Being Tested

- The ability to read and understand documentation. A couple of handy ones for this test would be: Laravel | PHP | VueJs ~ [ Preferably Composition API ].
    - The code follows the conventions and practices outlined in the official documentation for both Laravel and Vue.js. For instance, routing, validation, and component creation in Laravel and Vue.js are implemented as recommended.
- Your problem solving skills and your ability to handle difficult tasks.
    - The handling of customer data updates and validations shows my problem-solving skills. 
    - I've implemented logic to check for existing customer entries to fulfill the brief of both saving and updating customer details, but without using a relational DB.
- Your knowledge and ability of Git version control.
    - Have a look around the repo and see how I have utilized branches, issues and pull requests.
- PHP language skills and understanding.
    - Despite being primarily a NodeJS developer in the past, the PHP code effectively uses Laravel’s features, including routing, request handling, validation, and error logging.
- JavaScript language skills and undertsanding.
    - Despite not having used the Vue.js framework previously, I feel the use of Promises for AJAX requests with Axios shows a solid grasp of modern JavaScript practices and asynchronous programming.
- Your understanding of MVC framework concepts Models, Views, Controllers, such as Laravel.
    - The application clearly separates concerns by implementing models (CustomerFormModel.php), views (CustomerForm.vue), and controllers (CustomerFormController.php) in a structured manner, adhering to MVC principles. 
    - I am familiar with this structure, having used NodeJS primarily in the past.
- Your ability to work in a full stack environment.
    - I've integrated both front-end and back-end technologies, managing data flow from the client-side form submission to server-side processing. This includes creating a seamless user experience with AJAX requests.
- Your ability to find bugs, work out why they are bugs/not valid code, then fix them.
    - I feel the validation logic on both client and server sides demonstrates my understanding of common input issues. 
    - Error handling is also in place to capture and log exceptions, ensuring that problems can be diagnosed and addressed effectively, should bugs arise.
- Your ability to validate and sanitize form data from a frontend form.
    - Both client-side and server-side validations are robust. The client-side JS checks for valid inputs before sending data, and server-side validation ensures data integrity. 
    - Additionally, XSS prevention measures are implemented for sanitization.
- Your understanding of responsive first design and building for devices of all sizes.
    - In the CSS I have employed simple media queries to ensure a responsive design, adapting the layout for different screen sizes. 
    - Flexbox is used for layout, making it inherently flexible and ensuring usability across devices.


## Backlog

With more time, I would've liked to have added the following features:
 - Address checker by postcode (user could enter house name/number and postcode, then automatically generate full address)
 - Ability to view/edit all data in table format (assuming this is an operations view and taking into consideration GDPR etc.)
 - Automated testing - this isn't something I have explored much in my current role as we have always tested applications manually, but I'd like to learn.


## Instructions

1. Clone this repository and move into it
    ```
    git clone https://github.com/willclrke/darkside-test.git
    cd darkside-test
    ```
2. Make sure you have Node.js, Composer and PHP installed
3. Install PHP dependencies
    ```
    composer install
    ```
4. Install JS dependencies
    ```
    npm install
    ```
5. Copy the example environment file and create your own
   ```bash
   cp .env.example .env
   ```
6. Generate application key
    ```
    php artisan key:generate
    ```
7. Build assets with vite
    ```
    npm run dev
    ```
8. Start dev server
    ```
    php artisan serve
    ```

9. Open your web browser and navigate to http://localhost:8000 to access the application.
10. To check data, open this file: 
    ```
    storage/app/data/CustomerData.json
    ```