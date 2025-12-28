
# Project Blueprint

## Overview

This project is a full-stack web application built with Laravel for managing a member list. It includes features for creating, reading, updating, and deleting members, as well as uploading member lists from a CSV file.

## Features

### Implemented

*   **Member Management:**
    *   CRUD functionality for members (Create, Read, Update, Delete).
    *   A dashboard to display an overview of the members.
    *   Demographics page to visualize member data.
*   **CSV Upload:**
    *   Upload a CSV file of members.
    *   The application parses the CSV and creates new members.
*   **Styling & UI:**
    *   The application uses Tailwind CSS for styling.
    *   A consistent layout is maintained using Blade templates.
    *   The interface is designed to be user-friendly and intuitive.

### Current Task: Enhance Member Import/Export

*   **Export Member List:**
    *   Implement a feature to export the current member list as a CSV file.
*   **Duplicate Handling on Import:**
    *   When uploading a CSV file, use the `member_number` as a unique identifier.
    *   If a member with the same `member_number` already exists, the system will not create a new entry. Instead, it will update the existing member's record, filling in any blank fields with the new data from the CSV.
    *   If the `member_number` does not exist, a new member record will be created.

## Plan

1.  **Install `maatwebsite/excel`:** This package will be used for both exporting and importing CSV files.
2.  **Create Export Route and Controller Method:**
    *   Add a new route to `routes/web.php` for exporting members.
    *   Create an `export` method in the `MemberController` to handle the export logic.
3.  **Implement Export View:**
    *   Add an "Export" button to the `members/index.blade.php` view.
4.  **Update Import Logic:**
    *   Modify the `MembersImport` class to handle the duplicate checking and conditional updating logic.
5.  **Update `MemberController` for Import:**
    *   Adjust the `upload` method in the `MemberController` to use the updated import class and provide user feedback.
