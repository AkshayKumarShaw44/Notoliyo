<div align="center">

# 📝✨ Notoliyo

### *Where Ideas Come to Life in Real-Time*

<img src="https://img.shields.io/badge/Status-Active-success?style=for-the-badge" alt="Status">
<img src="https://img.shields.io/badge/Version-1.0.0-blue?style=for-the-badge" alt="Version">
<img src="https://img.shields.io/badge/License-MIT-yellow?style=for-the-badge" alt="License">

---

### 🚀 **Powered By Modern Tech Stack**

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-13-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" alt="Laravel 13">
  <img src="https://img.shields.io/badge/PHP-8.4-777BB4?style=for-the-badge&logo=php&logoColor=white" alt="PHP 8.4">
  <img src="https://img.shields.io/badge/MongoDB-47A248?style=for-the-badge&logo=mongodb&logoColor=white" alt="MongoDB">
  <img src="https://img.shields.io/badge/TailwindCSS-4-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white" alt="Tailwind CSS">
  <img src="https://img.shields.io/badge/Socket.IO-010101?style=for-the-badge&logo=socket.io&logoColor=white" alt="Socket.IO">
  <img src="https://img.shields.io/badge/Alpine.js-8BC0D0?style=for-the-badge&logo=alpine.js&logoColor=black" alt="Alpine.js">
  <img src="https://img.shields.io/badge/TipTap-000000?style=for-the-badge&logo=tiptap&logoColor=white" alt="TipTap">
  <img src="https://img.shields.io/badge/Vite-646CFF?style=for-the-badge&logo=vite&logoColor=white" alt="Vite">
</p>

---

### 💎 **A Premium Collaborative Note-Taking Experience**

*Notoliyo is not just another note-taking app. It's a beautifully crafted, real-time collaborative workspace with glassmorphism UI, live editing, and seamless team collaboration. Built with cutting-edge technologies and modern design principles.*

[🎯 Features](#-features) • [🎨 Screenshots](#-screenshots) • [⚡ Quick Start](#-quick-start) • [📚 Documentation](#-documentation) • [👨‍💻 Author](#-author)

---

</div>

## 🌟 **Why Notoliyo?**

<table>
<tr>
<td width="33%" align="center">
<img src="https://img.icons8.com/fluency/96/000000/lightning-bolt.png" width="60"/>
<h3>⚡ Lightning Fast</h3>
<p>Real-time synchronization with Socket.IO ensures instant updates across all devices</p>
</td>
<td width="33%" align="center">
<img src="https://img.icons8.com/fluency/96/000000/design.png" width="60"/>
<h3>🎨 Beautiful Design</h3>
<p>Premium glassmorphism UI with smooth animations and dark mode aesthetics</p>
</td>
<td width="33%" align="center">
<img src="https://img.icons8.com/fluency/96/000000/collaboration.png" width="60"/>
<h3>👥 Team Collaboration</h3>
<p>Work together seamlessly with live cursors, typing indicators, and role-based access</p>
</td>
</tr>
</table>

---

## 🎯 **Features**

### 🔐 **Authentication & Security**
```
✅ Secure user registration with unique avatar colors
✅ JWT-based authentication system
✅ Profile management (name, email, password, avatar)
✅ Activity tracking for audit trails
✅ CSRF protection on all forms
✅ XSS prevention with Blade escaping
```

### 📊 **Premium Dashboard**
```
✅ Analytics Cards - Total notes, shared notes, collaborators, categories
✅ Weekly Activity Stats - Track your productivity
✅ Recent Notes Widget - Quick access to latest work
✅ Pinned Notes Section - Keep important notes at the top
✅ Smart Notifications - Real-time updates with unread count
✅ Advanced Search - Find notes by title or content
✅ Category/Folder Organization - Keep everything organized
```

### 📝 **Rich Text Editor**
```
✅ TipTap Editor - Headless, extensible rich text editor
✅ Markdown Support - Write in markdown, see formatted text
✅ Formatting Toolbar - Bold, Italic, Headings, Lists, Code, Quotes
✅ Auto-Save - Never lose your work (2-second debounce)
✅ Distraction-Free Mode - Focus on writing
✅ Keyboard Shortcuts - Speed up your workflow
```


### 🤝 **Real-Time Collaboration**
```
✅ Live Editing - Multiple users edit simultaneously
✅ Cursor Tracking - See where teammates are working
✅ Typing Indicators - Know when someone is typing
✅ User Presence - See who's online in real-time
✅ Role-Based Access - Owner, Editor, Viewer permissions
✅ Email Invitations - Invite collaborators by email
✅ Public Sharing - Share with token-based links
✅ Guest Access - Allow anyone with link to edit
```

### 🎨 **Premium UI/UX**
```
✅ Glassmorphism Design - Modern glass-effect components
✅ Dark Mode Only - Sleek, always-on dark interface
✅ Responsive Layout - Works on mobile, tablet, desktop
✅ Smooth Animations - AOS (Animate On Scroll) library
✅ Glass Variants - Strong, Light, Card, Button, Frosted
✅ Custom Scrollbars - Beautiful, minimal scrollbars
✅ Toast Notifications - User-friendly feedback
✅ Empty States - Beautiful placeholders
```

### 🏷️ **Organization Features**
```
✅ Tags System - Add multiple tags to notes
✅ Pin Notes - Pin important notes to dashboard top
✅ Favorites/Stars - Mark notes as favorites
✅ Categories/Folders - Organize notes in folders
✅ Smart Filters - All, My Notes, Shared, Starred
✅ Search - Full-text search across all notes
```

### 💬 **Discussion & Comments**
```
✅ Threaded Comments - Add comments to notes
✅ Real-Time Updates - Comments sync instantly
✅ User Avatars - Visual user identification
✅ Timestamps - See when comments were added
✅ Collapsible Drawer - Keep workspace clean
```

### 🔔 **Notification System**
```
✅ Real-Time Notifications - Instant updates
✅ Unread Count Badge - See unread notifications
✅ Mark as Read - Individual or bulk actions
✅ Notification Types - Collaborator, Comment, Share
✅ Dropdown Interface - Clean, accessible design
✅ Pulse Animation - Visual attention grabber
```

---

## 📁 **Project Structure**

```
notoliyo/
│
├── 📂 app/
│   ├── 📂 Http/
│   │   ├── 📂 Controllers/
│   │   │   ├── 🎮 AuthController.php          # Authentication logic
│   │   │   ├── 🎮 NoteController.php          # Note CRUD operations
│   │   │   ├── 🎮 CommentController.php       # Comment management
│   │   │   ├── 🎮 DashboardController.php     # Dashboard & analytics
│   │   │   ├── 🎮 NotificationController.php  # Notification handling
│   │   │   └── 🎮 WorkspaceController.php     # Workspace management
│   │   └── 📂 Requests/
│   │       ├── 📋 LoginRequest.php            # Login validation
│   │       └── 📋 RegisterRequest.php         # Registration validation
│   │
│   ├── 📂 Models/
│   │   ├── 👤 User.php                        # User model
│   │   ├── 📝 Note.php                        # Note model
│   │   ├── 💬 Comment.php                     # Comment model
│   │   ├── 🤝 Collaboration.php               # Collaboration model
│   │   ├── 📊 Activity.php                    # Activity tracking
│   │   ├── 🔔 Notification.php                # Notifications
│   │   ├── 🏷️  Tag.php                         # Tags
│   │   └── 🗂️  Workspace.php                   # Workspaces
│   │
│   └── 📂 Services/
│       └── 🔧 NoteService.php                 # Business logic layer
│
├── 📂 resources/
│   ├── 📂 views/
│   │   ├── 📂 auth/
│   │   │   ├── 🔐 login.blade.php             # Login page
│   │   │   └── 📝 register.blade.php          # Registration page
│   │   ├── 📂 notes/
│   │   │   └── ✏️  editor.blade.php            # Note editor workspace
│   │   ├── 📂 layouts/
│   │   │   └── 🎨 layout.blade.php            # Base layout template
│   │   ├── 🏠 landing.blade.php               # Landing page
│   │   ├── 📊 dashboard.blade.php             # Main dashboard
│   │   └── 👤 profile.blade.php               # User profile
│   │
│   ├── 📂 js/
│   │   └── ⚡ app.js                          # Alpine, Socket.IO, TipTap
│   │
│   └── 📂 css/
│       └── 🎨 app.css                         # Tailwind + custom styles
│
├── 📂 routes/
│   └── 🛣️  web.php                            # Application routes
│
├── 📂 database/
│   └── 📂 migrations/                         # Database migrations
│
├── 📂 public/
│   ├── 📂 build/                              # Compiled assets
│   └── 🖼️  assets/                            # Static assets
│
├── 📂 tests/
│   ├── 📂 Feature/                            # Feature tests
│   └── 📂 Unit/                               # Unit tests
│
├── 🔌 socket-server.js                        # Real-time WebSocket server
├── ⚙️  vite.config.js                         # Vite configuration
├── 📦 composer.json                           # PHP dependencies
├── 📦 package.json                            # Node.js dependencies
└── 📖 README.md                               # You are here!
```

---


## ⚡ **Quick Start**

### 📋 **Prerequisites**

<table>
<tr>
<td align="center" width="25%">
<img src="https://img.icons8.com/color/96/000000/php.png" width="48"/><br/>
<b>PHP 8.4+</b>
</td>
<td align="center" width="25%">
<img src="https://img.icons8.com/color/96/000000/composer.png" width="48"/><br/>
<b>Composer</b>
</td>
<td align="center" width="25%">
<img src="https://img.icons8.com/color/96/000000/nodejs.png" width="48"/><br/>
<b>Node.js 18+</b>
</td>
<td align="center" width="25%">
<img src="https://img.icons8.com/color/96/000000/mongodb.png" width="48"/><br/>
<b>MongoDB</b>
</td>
</tr>
</table>

### 🚀 **Installation Steps**

#### **Step 1️⃣: Clone the Repository**
```bash
git clone https://github.com/AkshayKumarShaw44/Notoliyo.git
cd Notoliyo
```

#### **Step 2️⃣: Install Dependencies**
```bash
# Install PHP dependencies
composer install

# Install Node.js dependencies
npm install
```

#### **Step 3️⃣: Environment Setup**
```bash
# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate
```

#### **Step 4️⃣: Configure MongoDB**
Edit `.env` file:
```env
DB_CONNECTION=mongodb
MONGODB_URI=mongodb+srv://username:password@cluster.mongodb.net
MONGODB_DATABASE=notoliyo
```

#### **Step 5️⃣: Build Frontend Assets**
```bash
npm run build
```

#### **Step 6️⃣: Start Development Servers**
```bash
# Option 1: Start all services at once (recommended)
composer run dev

# Option 2: Start services individually
# Terminal 1: Laravel server
php artisan serve

# Terminal 2: Vite dev server
npm run dev

# Terminal 3: Socket.IO server
npm run socket
```

#### **Step 7️⃣: Access the Application**
```
🌐 Web Application: http://notoliyo.test (Herd) or http://localhost:8000
🔌 Socket.IO Server: http://localhost:3000
```

---

## 🎨 **Screenshots**

<div align="center">

### 🏠 **Landing Page**
*Beautiful hero section with glassmorphism effects and smooth animations*

---

### 📊 **Dashboard**
*Analytics cards, recent notes, pinned notes, and smart notifications*

---

### ✏️ **Editor**
*Real-time collaborative editing with formatting toolbar and comments*

---

### 🔗 **Share Modal**
*Advanced sharing options with public links and email invitations*

---

### 🔔 **Notifications**
*Real-time notification dropdown with mark as read functionality*

</div>

---

## 🗄️ **Database Schema**

### 📊 **MongoDB Collections**

<details>
<summary><b>👤 Users Collection</b></summary>

```javascript
{
  _id: ObjectId,
  name: String,                    // User's full name
  email: String,                   // Unique email address
  password: String,                // Bcrypt hashed password
  avatar_color: String,            // Hex color for avatar
  created_at: DateTime,
  updated_at: DateTime
}
```
</details>

<details>
<summary><b>📝 Notes Collection</b></summary>

```javascript
{
  _id: ObjectId,
  title: String,                   // Note title
  content: String,                 // HTML content from TipTap
  user_id: ObjectId,               // Owner reference
  category: String,                // Folder/category name
  tags: Array,                     // Array of tag strings
  is_favorite: Boolean,            // Starred status
  is_pinned: Boolean,              // Pinned to dashboard
  share_token: String,             // Public sharing token (nullable)
  created_at: DateTime,
  updated_at: DateTime
}
```
</details>

<details>
<summary><b>🤝 Collaborations Collection</b></summary>

```javascript
{
  _id: ObjectId,
  note_id: ObjectId,               // Note reference
  user_id: ObjectId,               // Collaborator reference
  role: String,                    // 'owner' | 'editor' | 'viewer'
  created_at: DateTime,
  updated_at: DateTime
}
```
</details>

<details>
<summary><b>💬 Comments Collection</b></summary>

```javascript
{
  _id: ObjectId,
  note_id: ObjectId,               // Note reference
  user_id: ObjectId,               // Commenter reference
  user_name: String,               // Cached user name
  content: String,                 // Comment text
  created_at: DateTime,
  updated_at: DateTime
}
```
</details>

<details>
<summary><b>🔔 Notifications Collection</b></summary>

```javascript
{
  _id: ObjectId,
  user_id: ObjectId,               // Recipient reference
  type: String,                    // 'collaborator' | 'comment' | 'share'
  title: String,                   // Notification title
  message: String,                 // Notification message
  read: Boolean,                   // Read status
  icon: String,                    // Font Awesome icon class
  color: String,                   // Badge color
  created_at: DateTime,
  updated_at: DateTime
}
```
</details>

<details>
<summary><b>📊 Activities Collection</b></summary>

```javascript
{
  _id: ObjectId,
  user_id: ObjectId,               // User reference
  note_id: ObjectId,               // Note reference (nullable)
  action: String,                  // Action type
  description: String,             // Human-readable description
  created_at: DateTime,
  updated_at: DateTime
}
```
</details>

---


## 🛠️ **Tech Stack Deep Dive**

### 🔙 **Backend Technologies**

| Technology | Version | Purpose |
|------------|---------|---------|
| ![Laravel](https://img.shields.io/badge/Laravel-13-FF2D20?logo=laravel&logoColor=white) | 13.x | PHP MVC Framework |
| ![PHP](https://img.shields.io/badge/PHP-8.4-777BB4?logo=php&logoColor=white) | 8.4+ | Server-side Language |
| ![MongoDB](https://img.shields.io/badge/MongoDB-7.0-47A248?logo=mongodb&logoColor=white) | 7.0+ | NoSQL Database |
| ![Pest](https://img.shields.io/badge/Pest-4-FF6B6B?logo=php&logoColor=white) | 4.x | Testing Framework |
| ![Pint](https://img.shields.io/badge/Pint-1-FF2D20?logo=laravel&logoColor=white) | 1.x | Code Formatter |

### 🎨 **Frontend Technologies**

| Technology | Version | Purpose |
|------------|---------|---------|
| ![TailwindCSS](https://img.shields.io/badge/Tailwind-4-38B2AC?logo=tailwind-css&logoColor=white) | 4.x | Utility-first CSS |
| ![Alpine.js](https://img.shields.io/badge/Alpine.js-3-8BC0D0?logo=alpine.js&logoColor=black) | 3.x | Lightweight JS Framework |
| ![Vite](https://img.shields.io/badge/Vite-8-646CFF?logo=vite&logoColor=white) | 8.x | Build Tool |
| ![TipTap](https://img.shields.io/badge/TipTap-2-000000?logo=tiptap&logoColor=white) | 2.x | Rich Text Editor |
| ![AOS](https://img.shields.io/badge/AOS-2-4FC08D?logo=javascript&logoColor=white) | 2.x | Scroll Animations |
| ![Font Awesome](https://img.shields.io/badge/Font_Awesome-6-339AF0?logo=font-awesome&logoColor=white) | 6.x | Icon Library |

### ⚡ **Real-Time Technologies**

| Technology | Version | Purpose |
|------------|---------|---------|
| ![Socket.IO](https://img.shields.io/badge/Socket.IO-4-010101?logo=socket.io&logoColor=white) | 4.x | WebSocket Library |
| ![Node.js](https://img.shields.io/badge/Node.js-18-339933?logo=node.js&logoColor=white) | 18+ | JavaScript Runtime |
| ![Express](https://img.shields.io/badge/Express-4-000000?logo=express&logoColor=white) | 4.x | Web Framework |

---

## 🏗️ **Architecture & Design Patterns**

### 🎯 **MVC Architecture**

```
┌─────────────────────────────────────────────────────────┐
│                      CLIENT LAYER                        │
│  (Browser - Blade Templates, Alpine.js, TailwindCSS)   │
└────────────────────┬────────────────────────────────────┘
                     │ HTTP Requests
                     ▼
┌─────────────────────────────────────────────────────────┐
│                   CONTROLLER LAYER                       │
│  (AuthController, NoteController, DashboardController)  │
└────────────────────┬────────────────────────────────────┘
                     │ Business Logic
                     ▼
┌─────────────────────────────────────────────────────────┐
│                    SERVICE LAYER                         │
│              (NoteService - Business Logic)              │
└────────────────────┬────────────────────────────────────┘
                     │ Data Operations
                     ▼
┌─────────────────────────────────────────────────────────┐
│                     MODEL LAYER                          │
│     (User, Note, Comment, Collaboration - Eloquent)     │
└────────────────────┬────────────────────────────────────┘
                     │ Database Queries
                     ▼
┌─────────────────────────────────────────────────────────┐
│                   DATABASE LAYER                         │
│              (MongoDB Atlas - NoSQL Database)            │
└─────────────────────────────────────────────────────────┘
```

### ⚡ **Real-Time Collaboration Flow**

```
┌──────────────┐         ┌──────────────┐         ┌──────────────┐
│   Client A   │         │   Client B   │         │   Client C   │
│  (Browser)   │         │  (Browser)   │         │  (Browser)   │
└──────┬───────┘         └──────┬───────┘         └──────┬───────┘
       │                        │                        │
       │ Socket.IO Connection   │                        │
       └────────────┬───────────┴────────────────────────┘
                    │
                    ▼
         ┌──────────────────────┐
         │  Socket.IO Server    │
         │    (Node.js)         │
         │  - Room Management   │
         │  - Event Broadcasting│
         │  - User Presence     │
         └──────────┬───────────┘
                    │
                    ▼
         ┌──────────────────────┐
         │   Laravel Backend    │
         │  - Data Persistence  │
         │  - Authentication    │
         │  - Authorization     │
         └──────────────────────┘
```

### 🔐 **Security Layers**

```
┌─────────────────────────────────────────────────────────┐
│  🛡️  CSRF Protection (All Forms)                        │
└─────────────────────────────────────────────────────────┘
┌─────────────────────────────────────────────────────────┐
│  🔒 XSS Prevention (Blade Escaping)                     │
└─────────────────────────────────────────────────────────┘
┌─────────────────────────────────────────────────────────┐
│  💉 SQL Injection Prevention (Eloquent ORM)             │
└─────────────────────────────────────────────────────────┘
┌─────────────────────────────────────────────────────────┐
│  🔑 Password Hashing (Bcrypt)                           │
└─────────────────────────────────────────────────────────┘
┌─────────────────────────────────────────────────────────┐
│  🎫 Token-Based Sharing (Secure Random Tokens)          │
└─────────────────────────────────────────────────────────┘
┌─────────────────────────────────────────────────────────┐
│  👥 Role-Based Access Control (Owner/Editor/Viewer)     │
└─────────────────────────────────────────────────────────┘
```

---

## 🧪 **Testing**

### Run Tests with Pest

```bash
# Run all tests
php artisan test

# Run with coverage
php artisan test --coverage

# Run specific test file
php artisan test tests/Feature/NoteTest.php

# Run with compact output
php artisan test --compact
```

### Test Coverage

```
✅ Authentication Tests
✅ Note CRUD Tests
✅ Collaboration Tests
✅ Comment Tests
✅ Dashboard Tests
✅ Notification Tests
```

---

## 🎨 **Customization Guide**

### 🌈 **Change Theme Colors**

Edit `resources/css/app.css`:

```css
@theme {
    --color-primary: #6366f1;      /* Indigo */
    --color-secondary: #8b5cf6;    /* Purple */
    --color-success: #10b981;      /* Green */
    --color-danger: #ef4444;       /* Red */
}
```

### 🔧 **Add TipTap Extensions**

Edit `resources/views/notes/editor.blade.php`:

```javascript
const editor = new window.Editor({
    extensions: [
        window.StarterKit,
        // Add more extensions
        window.Underline,
        window.TextAlign,
        window.Highlight,
    ],
});
```

### 🎭 **Customize Glass Effects**

Edit `resources/css/app.css`:

```css
.glass-custom {
    background: rgba(255, 255, 255, 0.9);
    backdrop-filter: blur(20px);
    -webkit-backdrop-filter: blur(20px);
    border: 1px solid rgba(255, 255, 255, 0.5);
}
```

---

