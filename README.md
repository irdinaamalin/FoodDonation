# shareAmeal - Food Donation Website

## Group Information
**Group Name** : gp 3

**Section**: 5

**Group Members** :
1. IRDINA AMALIN HUSNA BINTI ISHAK 2318724
2. KAMA AZIRA BINTI MAT ASHRI 2316826
3. INSYIRAH NUR AINIE BINTI AHMAD FAUZI 2313576
4. AAMINAH ANEESAH BINTI JAFFAR 2226046

## Project Overview

Introduction: 
ShareAmeal is a web-based system designed to connect students and staff within IIUM Gombak for the purpose of reducing food waste and promoting a culture of sharing. Many campus events, cafeterias, and individuals often have excess food. In the meantime, some students face difficulties accessing meals due to financial or personal constraints. This platform serves as a bridge between donors who have surplus food and recipients who need it. This platform enables a fast, safe, and transparent exchange within the IIUM community.
Both donors and recipients, the system allows users to post available food, claim donations, manage their own posts, and report issues when necessary. Administrators oversee overall activity to ensure fairness, safety, and proper functioning. Ultimately, the platform aims to encourage community support, sustainability, and responsible food consumption on campus.

## Project Objectives
1. To reduce food waste within the IIUM community.
2. To support students in need by providing access to free meals.
3. To create an efficient and centralized system for food donations.
4. To promote a culture of sharing and community care.
5. To ensure transparency, safety, and accountability in food-sharing activities.

## Target Users
- IIUM Community

## Features and Functionalities

### User Features
- **User Registration & Login**: Secure account creation and authentication  
- **Homepage Overview**: Platform introduction, how it works, and food previews  
- **Profile Management**: View and update user details and settings  
- **Main Feed Browsing**: View available food donation posts  
- **Search & Filter**: Find food by category, location, and expiry time  
- **Food Claiming**: Claim available food items  
- **My Posts & My Claims**: Track posted donations and claimed food  
- **Reporting**: Submit feedback on food condition and collection  
- **Logout & Account Deletion**: Secure account management  

### Donor Features
- **Create Food Posts**: Share surplus food with details, images, and expiry time  
- **Manage Posts**: Edit or delete donation posts  
- **Pax Tracking**: Monitor available and claimed portions  

### Recipient Features
- **Browse Food Details**: View food information and donor details  
- **Claim Food**: Reserve available food portions  
- **Claim History**: View past claims and pickup details  

### Admin Features
- **Admin Dashboard**: View donations and report statistics  
- **Report Moderation**: Approve, reject, or review reports  
- **User Monitoring**: Ensure platform safety and transparency  


### Entity-Relationship Diagram
https://drive.google.com/file/d/1Wzdsp9tsxOaPNcDR5s9vyWBTly0R2D2i/view?usp=sharing

### Sequence Diagram
https://drive.google.com/file/d/1NMWmoxKlpogre0D8MMyARguPfucsCd4d/view?usp=sharing

### Mock up
https://drive.google.com/drive/folders/1SsTrBPAFa0jrHO-p1q7akjIq3VeobYRB?usp=sharing

## Technical Implementation

**Technology Stack**

- Backend Framework: Laravel 10.x
- Frontend: Blade Templates with Bootstrap
- Database: MySQL 8.0
- Authentication:
- Image Storage: Laravel File Storage
- Development Environment: XAMPP

  
**Database Design**

Database Schema Overview
Our database consist of 6 main tables,

Core Tables:

- admin: Admin information and details
- foodRecipient: Receipient information and details
- foodDonor: Donor information and details
- foodItem: Food details
- claim: Claim information and date
- report: Food report and details

**Entity-Relationship Diagram**
https://drive.google.com/file/d/1Wzdsp9tsxOaPNcDR5s9vyWBTly0R2D2i/view?usp=sharing

Key Relationships:
- Admins can manage multiple Food Recipients (One-to-Many)
- Food Donors can add multiple Food Items (One-to-Many)
- Each Food Item belongs to one Food Donor (Many-to-One)
- Food Recipients can make multiple Claims (One-to-Many)
- Each Claim is for one Food Item (Many-to-One)
- Food Recipients can submit multiple Reports (One-to-Many)
- Each Report is submitted by one user (Admin or Food Recipient) (Many-to-One)

## Laravel Component Implementation

#### Route
    //welcome
    Route::get('/', function () {
    return view('welcome');
    })->name('welcome');

    //main app
    Route::get('/mainfeed', [MainFeedController::class, 'index'])->name('mainfeed');
    Route::get('/my-posts', [MyPostsController::class, 'index'])->name('myposts');
    Route::post('/food/{id}/claim', [MainFeedController::class, 'claim'])->name('food.claim');

    //Create Post
    Route::get('/create-post', [MainFeedController::class, 'create'])->name('food.create');
    Route::post('/store-post', [MainFeedController::class, 'store'])->name('food.store');
    Route::get('/food/{id}', [MainFeedController::class, 'show'])->name('food.show');
    Route::delete('/food/{id}', [MainFeedController::class, 'destroy'])->name('food.destroy');
    Route::get('/food/{id}/edit', [MainFeedController::class, 'edit'])->name('food.edit');
    Route::put('/food/{id}', [MainFeedController::class, 'update'])->name('food.update');

    //My Claims
    Route::get('/my-claims', [MainFeedController::class, 'myClaims'])->name('claims.index');
   
    //My posts
    Route::get('/my-posts', [MainFeedController::class, 'myPosts'])->name('food.myposts');

    // Profile Management
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::get('/profile/edit', [ProfileEditController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileEditController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileEditController::class, 'destroy'])->name('profile.destroy');

    // User Reporting System
    // Route to display the form
    Route::get('/report', [ReportController::class, 'create'])->name('reports.create');

    // Route to handle the form submission
    Route::post('/report', [ReportController::class, 'store'])->name('reports.store');

    //admin only
     Route::middleware(['auth', 'can:admin'])->prefix('admin')->group(function () {
    // URL: /admin
    Route::get('/', [AdminController::class, 'index'])->name('admin.index');
    
    // URL: /admin/reports
    Route::get('/reports', [ReportModerationController::class, 'index'])->name('reports.index');
    
    Route::patch('/{id}', [AdminController::class, 'update'])->name('admin.update');
    Route::post('/reports/{id}/status', [ReportModerationController::class, 'updateStatus'])->name('reports.update');

#### Controller
- AdminController
- AuthController
- Controller
- FoodFeedController
- MainFeedController
- MyPostController
- ProfileController
- ProfileEditController
- ReportController
- ReportModerationController
  
#### Model
    //admin.php
    <?php
    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;

    class Admin extends Model
    {
    protected $table = 'reports'; // This links the model to your migration table
    protected $fillable = ['recipient_name', 'food_received', 'quantity', 'location', 'condition', 'status'];
    }

    //claim.php
    <?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;

    class Claim extends Model
    {
    use HasFactory;

    protected $fillable = [
        'user_id',
        'food_post_id',
    ];

    // Relationship to the Food Post
    public function foodPost()
    {
        return $this->belongsTo(FoodPost::class);
    }

    // Relationship to the User (Student)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    }

    //food.php
    <?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\Relations\BelongsTo;
    use Illuminate\Database\Eloquent\Relations\HasMany;

    class FoodPost extends Model
    {
    use HasFactory;

    // Explicitly define the table name
    protected $table = 'food_posts';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'user_id', 
        'category', 
        'pax', 
        'remaining_pax', 
        'title', 
        'description', 
        'location', 
        'status', 
        'views', 
        'image', 
        'expiry', 
        'expiry_time'
    ];

    /**
     * The attributes that should be cast.
     * This ensures 'expiry' is treated as a Carbon date object.
     */
    protected $casts = [
        'expiry' => 'date',
        'pax' => 'integer',
        'remaining_pax' => 'integer',
        'views' => 'integer',
    ];

    /**
     * Relationship: A FoodPost belongs to a User (Donor).
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relationship: A FoodPost can have many Claims.
     */
    public function claims(): HasMany
    {
        return $this->hasMany(Claim::class);
    }
    }

    //report.php
    <?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;

    class Report extends Model
    {
    protected $fillable = [
        'recipient_name', 
        'food_received', 
        'quantity', 
        'condition', 
        'location', 
        'additional_notes'
    ];
    }

    //ReportModeration.php
    <?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;

    class ReportModeration extends Model
    {
    use HasFactory;

    protected $table = 'reports';

       protected $fillable = [
    'reporter_id', 
    'food_name', 
    'category', 
    'donor_name', 
    'recipient_name', 
    'quantity', 
    'expiry_date', 
    'location', 
    'reason', 
    'status',
    'admin_comment'
    ];

    public function reporter()
    {
        return $this->belongsTo(User::class, 'reporter_id');
    }
    }

    //User.php 
    <?php

    namespace App\Models;

    // use Illuminate\Contracts\Auth\MustVerifyEmail;
    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Foundation\Auth\User as Authenticatable;
    use Illuminate\Notifications\Notifiable;

    class User extends Authenticatable
    {
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
       protected $fillable = [
    'name',
    'email',
    'password',
    'role',
    'matric_no',
    'email_verified_at', // Add this if missing
    'remember_token',    // Add this if missing
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'notify_claimed' => 'boolean', // Cast to boolean for checkboxes
            'notify_warning' => 'boolean',
            'notify_expiring' => 'boolean',
        ];
        }
    }

    

#### View
- admin.blade.php
- adminlogin.blade.php
- signup.blade.php
- claims.blade.php
- edit.blade.php
- food-detail.blade.php
- myposts.blade.php
- show.blade.php
- createpost.blade.php
- layout.blade.php
- mainfeed.blade.php
- profile.blade.php
- profileedit.blade.php
- report.blade.php
- reportmoderation.blade.php
- welcome.blade.php
  

## User Authentication System

### **Authentication Features**
- **Registration System**: Email validation, password confirmation, name
- **Login System**: Credential input, username and password
- **Profile Management**: Users can update their information and preferences
- **Role-Based Access**: Different dashboards for users and admin

### **Security Measures**
- Password encryption using Laravel's built-in hashing
- CSRF protection
- Use Middleware
  
## Installation and Setup
### Prerequisites: 
- PHP => 8.1
- Composer
- Node.js and NPM
- MySQL 8.0
- XAMPP

### Step-by-step Installation
1. Download Bootstrap template from https://bootstrapmade.com/demo/Logis/
Extract project folder to localserver directory C:/xampp/htdocs/shareameal
Open terminal and navigate to project folder
2. Install dependencies
   composer install
   npm install
3. Environment Configuration
4. Database setup
   Configure database in .env file
   Connect the database from phpmyadmin to the .env file
   php artisan migrate
5. Start development server
   php artisan serve

## Testing and Quality Assurance
### Functionality Testing
- Welcome page
- User registration and login system
- Feed display of available food donation
- Create post of food donation
- Display of food claim
- Admin user management
  
### Browser Compatibility
- Google Chrome
- Microsoft Edge
  
### Performance Testing
- Page load times under 3 seconds
- Database queries have been optimized for faster performance
- Images have been compressed to reduce size and improve loading speed
  
## Challenge faced and solutions
### Challenge 1: Handling Application Routing
- Problem: Handling application routing and implementing database seeding using PHP Artisan to ensure the system functioned correctly.
- Solution: Properly configuring the application routing to ensure all requests were correctly directed to their respective controllers.
  
### Challenge 2:  Corrupted Database
- Problem: Database has become corrupted, which may lead to data loss, errors in fetching records, or system crashes.
- Solution: Restore the database from the most recent backup, run integrity checks, and implement regular automated backups along with error detection mechanisms to prevent future corruption.

## Future Improvements
- **Real-time Notifications**: Push notifications for food donation available updates
- **Chatbox for communication**: Chatbox for users to ease communication between food recipient and food donor

  
## Learning Outcomes
### Technical Skills Gained
- Laravel Framework: Understanding of MVC architecture
- Database Design: Creating database schema and relationships
- Authentication: Implementing secure user authentication systems
- Frontend Development: Creating interface using Bootstrap

### Soft Skills Developed
- **Team Collaboration**: Working effectively as a group and distribute equal tasks and responsibilities
- **Project Management**: Planning and executing web application
- **Problem Solving**: Solving technical issue and debugging
- **Documentation**: Creating a report and documentation of the project
  
## Conclusion
### Key Achievements
- Successfully implemented all required Laravel components, including Routes, Controllers, Views, and Models
- Developed a fully functional food donor system
- Designed and implemented a responsive, user-friendly interface
- Demonstrated a strong understanding of database relationships and CRUD operations
- Applied security best practices for secure user authentication


### Project Impact
This project provides hands-on experience in developing real-world web applications and highlights the ability to collaborate effectively within a team environment. The skills and knowledge acquired through this project are directly applicable to professional web development contexts.

## References
1. https://bootstrapmade.com/demo/Logis/
2. https://getbootstrap.com/docs/4.1/getting-started/introduction/

Project Completion Date 16/1/2026
INFO 3305 Section 5
  
