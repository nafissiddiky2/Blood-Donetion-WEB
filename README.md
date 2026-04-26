# 🩸 Blood Donation Organization Management System

A web-based database management system for blood donation organizations to manage donors, patients, and blood matching efficiently.

## 📋 Table of Contents
- [Features](#features)
- [Technologies Used](#technologies-used)
- [Database Structure](#database-structure)
- [Installation Guide](#installation-guide)
- [Usage](#usage)
- [File Structure](#file-structure)
- [Screenshots](#screenshots)
- [Future Improvements](#future-improvements)
- [Contributing](#contributing)
- [License](#license)
- [Contact](#contact)

## ✨ Features

### Core Features
- **Donor Management**: Add, view, and delete donor information
- **Patient Management**: Add, view, and delete patient records
- **Blood Type Matching**: Automatically match donors with patients based on blood type
- **Search Functionality**: Search donors and patients by name, blood type, or phone number
- **Dashboard Statistics**: View total donors, patients, and blood type distribution
- **Foreign Key Relationship**: Link patients to specific donors

### Technical Features
- Responsive design (works on desktop and mobile)
- Real-time search filtering
- Secure database connections
- Input validation and sanitization
- User-friendly interface

## 🛠 Technologies Used

| Technology | Purpose |
|------------|---------|
| **PHP** | Backend logic and server-side processing |
| **MySQL** | Database management |
| **HTML5** | Structure of web pages |
| **CSS3** | Styling and responsive design |
| **XAMPP** | Local development environment |
| **VS Code** | Code editor |

## 📊 Database Structure

### Table 1: Doner (Donors)

| Column Name | Data Type | Constraints | Description |
|-------------|-----------|-------------|-------------|
| Doner_ID | INT | PRIMARY KEY | Unique donor identifier |
| Name | VARCHAR(100) | NOT NULL | Donor's full name |
| Age | INT | NOT NULL | Donor's age (18-65) |
| Gender | VARCHAR(10) | NOT NULL | Male/Female |
| Blood_Group | VARCHAR(5) | NOT NULL | A+, A-, B+, B-, O+, O-, AB+, AB- |
| Phone_Number | VARCHAR(15) | NOT NULL | Contact number |

### Table 2: Patient

| Column Name | Data Type | Constraints | Description |
|-------------|-----------|-------------|-------------|
| Patient_ID | INT | PRIMARY KEY | Unique patient identifier |
| Name | VARCHAR(100) | NOT NULL | Patient's full name |
| Phone_Number | VARCHAR(15) | NOT NULL | Contact number |
| Blood_Group | VARCHAR(5) | NOT NULL | Required blood type |
| RQ_of_Blood_Bag | INT | NOT NULL | Number of blood bags needed |
| Doner_ID | INT | FOREIGN KEY | Assigned donor (optional) |

### Relationships

One donor can be assigned to zero or one patient.

## 💻 Installation Guide

### Prerequisites
- XAMPP (or any local server with PHP and MySQL)
- Git (optional, for cloning)
- Web browser (Chrome/Firefox/Edge recommended)

### Step-by-Step Installation

#### 1. Clone or Download the Project

**Clone with Git**

git clone https://github.com/nafissiddiky2/blood-donation-org.git


**🚀 Usage**
**Navigation Menu**
Home: View dashboard statistics

Donors List: View all registered donors

Patients List: View all patients

Add New Donor: Register a new donor

Add New Patient: Register a new patient

Search: Find donors/patients by name, blood type, or phone

Match Blood: Find compatible donors for patients

**Common Operations
Adding a Donor**
Click "Add New Donor"

Fill in donor details (ID, name, age, gender, blood type, phone)

Click "Add Donor"

**Matching Blood**
Click "Match Blood"

Select a patient from dropdown

Click "Find Matching Donors"

View compatible donors with same blood type

Assign a donor to the patient

**Searching**
Click "Search"

Enter name, blood type, or phone number

View search results for both donors and patients

***📁 File Structure***
<img width="554" height="489" alt="image" src="https://github.com/user-attachments/assets/f28bd4d1-fd83-46f9-8cd6-ca238a61a80a" />


**📸 Screenshots**
**Homepage Dashboard**
<img width="1046" height="866" alt="image" src="https://github.com/user-attachments/assets/546a7023-aba7-4ab5-b1f6-5cbde815d388" />
**Donors List**
<img width="948" height="835" alt="image" src="https://github.com/user-attachments/assets/3ca542ac-5b38-42e5-a8db-05b4d9c65414" />
**Blood Matching Feature**
<img width="957" height="732" alt="image" src="https://github.com/user-attachments/assets/9ec433aa-1f44-493d-bee6-01d49007160d" />

**🔧 Future Improvements**
User authentication and login system

Donation history tracking

Email/SMS notification for donors

Appointment scheduling system

Blood inventory management

Report generation (PDF/Excel)

Mobile app integration

Blood expiry date tracking

Geolocation for nearby donors

Donor rewards/points system

**🤝 Contributing**
Contributions are welcome! Please follow these steps:

Fork the repository

Create a feature branch (git checkout -b feature/AmazingFeature)

Commit changes (git commit -m 'Add some AmazingFeature')

Push to branch (git push origin feature/AmazingFeature)

Open a Pull Request

**Coding Standards**
Follow PSR-12 PHP coding standards

Use meaningful variable names

Comment complex logic

Test before submitting

**📞 Contact**
Saad Al Nafis Siddiky

Email:nafissiddiky2@gmail.com

GitHub: @nafissiddiky2

LinkedIn: [Saad Al Nafis Siddiky](www.linkedin.com/in/nafis-siddiky)
