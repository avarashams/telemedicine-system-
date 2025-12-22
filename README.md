# Telemedicine++ [system]

## Table of Contents

1. [Description](#description)
2. [Types of Users](#type-of-user)
3. [Common-features-available-to-all-users](#common-features-available-to-all-users)
4. [Specific Features by User Type](#specific-features-by-user-type)

## Description

Telemedicine++ is web-based project that integrates both frontend and backend. Firstly, it lets users buy medicine, take lab tests and take doctor’s appointment. Later they can manage their own dashboard. Secondly, doctors can access the dashboard to manage their appointments, can set their availability status and generate reports/prescription. Overall, the admin can manually add medicines, lab tests and doctors to the respective lists accordingly. Finally, telemedicine++ solves the problem where a patient can manage their medical records through one dashboard and doctors can do the same.

## Type of user

1. Patients, Doctors, Admin

### Common Features (Available to All Users)

- Authentication

  - Login to the system
  - Logout from the system
  - User registration

- Account Management
  - Change or reset password
  - Manage profile information (view, edit, delete)
- Dashboard
  - Access a personalized dashboard after login

### Specific Features by User Type


- Features of Patient

  - Can buy medicines from 'Medicine' navigation
  - Take nearby lab-tests
  - Take doctor's appointment

- Features of Doctor

  - Manage patient's appointments through dashboard
  - Set their own availability status for appointment
  - Can generate report for each patient

- Features of Admin

  - Generate monthly summary report (total doctors, patients, medicines, lab tests)
  - Ban/Unban doctors, patients for unauthorized behavior
  - Publish announcement across all user (Doctors, patients)
