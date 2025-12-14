# Member Management System

## Purpose & Capabilities

This application is a comprehensive member management system. It allows for the easy management of members, including creating, viewing, editing, and deleting member information. It also provides a demographics dashboard to visualize member data.

## Style, Design, and Features

### 1. Aesthetics & Design

*   **Layout:** A modern and clean layout using Tailwind CSS.
*   **Components:** Standard form elements and tables for easy interaction.

### 2. Features

*   **Member List:**
    *   A paginated table listing all members with their name, email, member number, status, and member type.
    *   Search functionality to filter members by name, email, or member number.
    *   Action buttons to view, edit, and delete members.
*   **Member Management:**
    *   A form to create new members.
    *   A form to edit existing members.
    *   A view to display the full details of a single member.
*   **Demographics Page:**
    *   Charts to visualize member data, including:
        *   Member status (pie chart)
        *   Member types (bar chart)
        *   Gender distribution (doughnut chart)

## Implementation Details

1.  **`Member` Model and Migration:**
    *   Created a `Member` model and a migration to define the `members` table schema.
2.  **Controllers:**
    *   `MemberController` to handle all CRUD operations for members.
    *   `DemographicsController` to prepare data for the demographics charts.
3.  **Routes:**
    *   Defined resourceful routes for members.
    *   Defined a route for the demographics page.
4.  **Blade Views:**
    *   Created a layout file to maintain a consistent look and feel.
    *   Developed views for listing, creating, editing, and showing members.
    *   Created a view for the demographics page with charts.
5.  **Database Seeding:**
    *   Created a `MemberSeeder` to populate the database with dummy data for testing.
6.  **Welcome Page:**
    *   Updated the welcome page to redirect users to the members list.
