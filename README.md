# Patient Management System
### Motivation
The main purpose of this application was to develop a multi-user system for surgeries and medical clinics within the United Kingdom. The system would allow to store and manage patient personal and health-related information, appointments, prescriptions. Furthermore, a time management tool for medical staff members was also implemented. 
### Technologies Used
- Laravel 5.4 (based on PHP 7.1)
- HTML5 & CSS3
- JavaScript
- MongoDB 3.4.2
### List of Implemented Features
- Add and edit new users 
  - Five user types - patient, staff, manager, doctor and nurse
  - Each new user gets a unique 8-digit user ID code
  - Temporary password is sent to the email address upon registration
- Patients can book and cancel appointments
- Staff members can book and cancel appointments on behalf of their patients
- Doctors and nurses can schedule their appointment times for up to 6 months in advance
- Doctors are able to add, edit and remove prescriptions
  - There are 3 types of prescriptions, developed according to the NHS England guidelines
    - Standard prescriptions (valid for 6 months)
    - Controlled drug prescriptions (valid for 28 days)
    - Repeat prescriptions (valid for 1 month at a time for total of up to 12 months)
- All users can edit their own profile and contact information (change password, email, phone number and address)
- Full mobile responsiveness (Bootstrap-powered)
- Appointment notes associated with each individual appointment
- General patient notes associated with their profile


### System features planned in the future

- Instant messaging system between users
