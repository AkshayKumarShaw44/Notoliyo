<div align="center">

<!-- Animated Logo -->
<svg width="600" height="200" xmlns="http://www.w3.org/2000/svg">
  <defs>
    <!-- Gradient Definitions -->
    <linearGradient id="grad1" x1="0%" y1="0%" x2="100%" y2="100%">
      <stop offset="0%" style="stop-color:#667eea;stop-opacity:1">
        <animate attributeName="stop-color" values="#667eea;#764ba2;#f093fb;#4facfe;#667eea" dur="8s" repeatCount="indefinite"/>
      </stop>
      <stop offset="100%" style="stop-color:#764ba2;stop-opacity:1">
        <animate attributeName="stop-color" values="#764ba2;#f093fb;#4facfe;#667eea;#764ba2" dur="8s" repeatCount="indefinite"/>
      </stop>
    </linearGradient>
    
    <linearGradient id="textGrad" x1="0%" y1="0%" x2="100%" y2="0%">
      <stop offset="0%" style="stop-color:#667eea;stop-opacity:1">
        <animate attributeName="stop-color" values="#667eea;#f093fb;#4facfe;#00f2fe;#667eea" dur="6s" repeatCount="indefinite"/>
      </stop>
      <stop offset="50%" style="stop-color:#764ba2;stop-opacity:1">
        <animate attributeName="stop-color" values="#764ba2;#4facfe;#00f2fe;#667eea;#764ba2" dur="6s" repeatCount="indefinite"/>
      </stop>
      <stop offset="100%" style="stop-color:#f093fb;stop-opacity:1">
        <animate attributeName="stop-color" values="#f093fb;#00f2fe;#667eea;#764ba2;#f093fb" dur="6s" repeatCount="indefinite"/>
      </stop>
    </linearGradient>
    
    <!-- Glow Filter -->
    <filter id="glow">
      <feGaussianBlur stdDeviation="4" result="coloredBlur"/>
      <feMerge>
        <feMergeNode in="coloredBlur"/>
        <feMergeNode in="SourceGraphic"/>
      </feMerge>
    </filter>
  </defs>
  
  <!-- Animated Background -->
  <rect width="600" height="200" fill="url(#grad1)" rx="20">
    <animate attributeName="opacity" values="0.8;1;0.8" dur="4s" repeatCount="indefinite"/>
  </rect>
  
  <!-- Decorative Elements -->
  <circle cx="50" cy="50" r="30" fill="rgba(255,255,255,0.1)">
    <animate attributeName="cy" values="50;150;50" dur="8s" repeatCount="indefinite"/>
    <animate attributeName="opacity" values="0.1;0.3;0.1" dur="8s" repeatCount="indefinite"/>
  </circle>
  
  <circle cx="550" cy="150" r="40" fill="rgba(255,255,255,0.1)">
    <animate attributeName="cy" values="150;50;150" dur="10s" repeatCount="indefinite"/>
    <animate attributeName="opacity" values="0.1;0.3;0.1" dur="10s" repeatCount="indefinite"/>
  </circle>
  
  <!-- Icon - Note with Pen -->
  <g transform="translate(80, 60)">
    <!-- Note Paper -->
    <rect x="0" y="0" width="60" height="80" rx="5" fill="white" opacity="0.95" filter="url(#glow)">
      <animate attributeName="y" values="0;-5;0" dur="3s" repeatCount="indefinite"/>
    </rect>
    
    <!-- Lines on Paper -->
    <line x1="10" y1="20" x2="50" y2="20" stroke="#667eea" stroke-width="2" opacity="0.6"/>
    <line x1="10" y1="35" x2="50" y2="35" stroke="#764ba2" stroke-width="2" opacity="0.6"/>
    <line x1="10" y1="50" x2="40" y2="50" stroke="#f093fb" stroke-width="2" opacity="0.6"/>
    
    <!-- Pen -->
    <g transform="translate(45, 55) rotate(-45)">
      <rect x="0" y="0" width="8" height="35" rx="2" fill="#4facfe">
        <animate attributeName="fill" values="#4facfe;#00f2fe;#667eea;#4facfe" dur="4s" repeatCount="indefinite"/>
      </rect>
      <polygon points="0,35 8,35 4,42" fill="#2d3748"/>
    </g>
  </g>
  
  <!-- Main Title with Animation -->
  <text x="300" y="100" font-family="Arial, sans-serif" font-size="72" font-weight="bold" text-anchor="middle" fill="url(#textGrad)" filter="url(#glow)">
    Notoliyo
    <animate attributeName="opacity" values="1;0.8;1" dur="3s" repeatCount="indefinite"/>
  </text>
  
  <!-- Subtitle -->
  <text x="300" y="140" font-family="Arial, sans-serif" font-size="20" font-style="italic" text-anchor="middle" fill="white" opacity="0.9">
    Where Ideas Come to Life in Real-Time
    <animate attributeName="opacity" values="0.7;1;0.7" dur="4s" repeatCount="indefinite"/>
  </text>
  
  <!-- Sparkle Effects -->
  <circle cx="200" cy="70" r="3" fill="white">
    <animate attributeName="opacity" values="0;1;0" dur="2s" repeatCount="indefinite"/>
    <animate attributeName="r" values="2;4;2" dur="2s" repeatCount="indefinite"/>
  </circle>
  
  <circle cx="420" cy="90" r="3" fill="white">
    <animate attributeName="opacity" values="0;1;0" dur="2.5s" repeatCount="indefinite" begin="0.5s"/>
    <animate attributeName="r" values="2;4;2" dur="2.5s" repeatCount="indefinite" begin="0.5s"/>
  </circle>
  
  <circle cx="480" cy="120" r="3" fill="white">
    <animate attributeName="opacity" values="0;1;0" dur="3s" repeatCount="indefinite" begin="1s"/>
    <animate attributeName="r" values="2;4;2" dur="3s" repeatCount="indefinite" begin="1s"/>
  </circle>
  
  <!-- Floating Particles -->
  <circle cx="150" cy="160" r="2" fill="rgba(255,255,255,0.6)">
    <animate attributeName="cy" values="160;140;160" dur="5s" repeatCount="indefinite"/>
  </circle>
  
  <circle cx="450" cy="160" r="2" fill="rgba(255,255,255,0.6)">
    <animate attributeName="cy" values="160;140;160" dur="6s" repeatCount="indefinite"/>
  </circle>
</svg>

<br/>

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


## 🚀 **Deployment Guide**

### 📋 **Production Checklist**

- [ ] Set `APP_ENV=production` in `.env`
- [ ] Set `APP_DEBUG=false` in `.env`
- [ ] Configure production MongoDB connection
- [ ] Run `composer install --optimize-autoloader --no-dev`
- [ ] Run `npm run build`
- [ ] Set up SSL certificate (HTTPS)
- [ ] Configure CORS for Socket.IO
- [ ] Set up PM2 for Socket.IO server
- [ ] Configure web server (Nginx/Apache)
- [ ] Set up monitoring and logging
- [ ] Configure backup strategy

### 🔌 **Deploy Socket.IO Server with PM2**

```bash
# Install PM2 globally
npm install -g pm2

# Start Socket.IO server
pm2 start socket-server.js --name notoliyo-socket

# Save PM2 configuration
pm2 save

# Set PM2 to start on boot
pm2 startup

# Monitor logs
pm2 logs notoliyo-socket

# Restart server
pm2 restart notoliyo-socket
```

### 🌐 **Nginx Configuration Example**

```nginx
server {
    listen 80;
    server_name notoliyo.com;
    root /var/www/notoliyo/public;

    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-Content-Type-Options "nosniff";

    index index.php;

    charset utf-8;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    error_page 404 /index.php;

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.4-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }
}

# Socket.IO Proxy
server {
    listen 80;
    server_name socket.notoliyo.com;

    location / {
        proxy_pass http://localhost:3000;
        proxy_http_version 1.1;
        proxy_set_header Upgrade $http_upgrade;
        proxy_set_header Connection "upgrade";
        proxy_set_header Host $host;
        proxy_cache_bypass $http_upgrade;
    }
}
```

---

## 📚 **API Documentation**

### 🔐 **Authentication Endpoints**

| Method | Endpoint | Description | Auth Required |
|--------|----------|-------------|---------------|
| `GET` | `/login` | Show login form | ❌ |
| `POST` | `/login` | Authenticate user | ❌ |
| `GET` | `/register` | Show registration form | ❌ |
| `POST` | `/register` | Register new user | ❌ |
| `POST` | `/logout` | Logout user | ✅ |

### 📝 **Note Endpoints**

| Method | Endpoint | Description | Auth Required |
|--------|----------|-------------|---------------|
| `GET` | `/dashboard` | Show dashboard | ✅ |
| `POST` | `/notes` | Create new note | ✅ |
| `GET` | `/notes/{id}` | Show note editor | ✅ |
| `POST` | `/notes/{id}/update` | Update note | ✅ |
| `DELETE` | `/notes/{id}` | Delete note | ✅ |
| `POST` | `/notes/{id}/toggle-favorite` | Toggle favorite | ✅ |
| `POST` | `/notes/{id}/toggle-pin` | Toggle pin status | ✅ |
| `POST` | `/notes/{id}/share` | Toggle public sharing | ✅ |

### 🤝 **Collaboration Endpoints**

| Method | Endpoint | Description | Auth Required |
|--------|----------|-------------|---------------|
| `POST` | `/notes/{id}/collaborators` | Invite collaborator | ✅ |
| `POST` | `/notes/{id}/collaborators/remove` | Remove collaborator | ✅ |

### 💬 **Comment Endpoints**

| Method | Endpoint | Description | Auth Required |
|--------|----------|-------------|---------------|
| `POST` | `/notes/{id}/comments` | Add comment | ✅ |

### 👤 **Profile Endpoints**

| Method | Endpoint | Description | Auth Required |
|--------|----------|-------------|---------------|
| `GET` | `/profile` | Show profile page | ✅ |
| `POST` | `/profile` | Update profile | ✅ |

### 🔔 **Notification Endpoints**

| Method | Endpoint | Description | Auth Required |
|--------|----------|-------------|---------------|
| `GET` | `/notifications` | Get all notifications | ✅ |
| `POST` | `/notifications/{id}/read` | Mark as read | ✅ |
| `POST` | `/notifications/read-all` | Mark all as read | ✅ |

---

## 🎓 **Usage Guide**

### 📝 **Creating Your First Note**

1. **Register/Login** to your account
2. Click **"Create Note"** button in dashboard
3. Enter a **title** and optional **category**
4. Start writing in the **rich text editor**
5. Your work is **auto-saved** every 2 seconds

### 🤝 **Collaborating in Real-Time**

1. Open a note you own
2. Click the **"Share"** button
3. Choose sharing method:
   - **Enable Public Link** - Anyone with link can edit
   - **Invite by Email** - Add specific collaborators with roles
4. Share the link with your team
5. Watch as everyone edits together in **real-time**!

### ⌨️ **Keyboard Shortcuts**

| Shortcut | Action |
|----------|--------|
| `Ctrl/Cmd + B` | **Bold** text |
| `Ctrl/Cmd + I` | *Italic* text |
| `Ctrl/Cmd + Shift + X` | ~~Strikethrough~~ |
| `Ctrl/Cmd + Shift + 7` | Ordered list |
| `Ctrl/Cmd + Shift + 8` | Bullet list |
| `Ctrl/Cmd + Shift + 9` | Blockquote |
| `Ctrl/Cmd + Alt + 1` | Heading 1 |
| `Ctrl/Cmd + Alt + 2` | Heading 2 |
| `Ctrl/Cmd + Alt + 3` | Heading 3 |

### 🗂️ **Organizing Notes**

- Use **categories/folders** to organize notes
- **Star** important notes for quick access
- **Pin** critical notes to dashboard top
- Add **tags** for better categorization
- Use **search** to find notes instantly
- Filter by ownership and sharing status

---

## 🐛 **Troubleshooting**

### ❌ **Common Issues**

<details>
<summary><b>Socket.IO Connection Failed</b></summary>

**Problem:** Real-time features not working

**Solution:**
```bash
# Check if Socket.IO server is running
pm2 status

# Restart Socket.IO server
pm2 restart notoliyo-socket

# Check logs
pm2 logs notoliyo-socket
```
</details>

<details>
<summary><b>Vite Manifest Error</b></summary>

**Problem:** "Unable to locate file in Vite manifest"

**Solution:**
```bash
# Rebuild assets
npm run build

# Or start dev server
npm run dev
```
</details>

<details>
<summary><b>MongoDB Connection Error</b></summary>

**Problem:** Cannot connect to MongoDB

**Solution:**
- Check MongoDB URI in `.env`
- Verify MongoDB Atlas IP whitelist
- Ensure database user has correct permissions
- Test connection with MongoDB Compass
</details>

<details>
<summary><b>Permission Denied Errors</b></summary>

**Problem:** Storage or cache permission errors

**Solution:**
```bash
# Fix storage permissions
chmod -R 775 storage bootstrap/cache

# Clear cache
php artisan cache:clear
php artisan config:clear
php artisan view:clear
```
</details>

---


## 🤝 **Contributing**

We welcome contributions from the community! Here's how you can help:

### 🌟 **Ways to Contribute**

- 🐛 Report bugs and issues
- 💡 Suggest new features
- 📝 Improve documentation
- 🔧 Submit pull requests
- ⭐ Star the repository
- 📢 Share with others

### 📝 **Contribution Guidelines**

1. **Fork** the repository
2. **Create** a feature branch
   ```bash
   git checkout -b feature/AmazingFeature
   ```
3. **Commit** your changes
   ```bash
   git commit -m 'Add some AmazingFeature'
   ```
4. **Push** to the branch
   ```bash
   git push origin feature/AmazingFeature
   ```
5. **Open** a Pull Request

### 📋 **Code Style**

- Follow **PSR-12** coding standards for PHP
- Use **Laravel Pint** for code formatting
- Write **meaningful commit messages**
- Add **tests** for new features
- Update **documentation** as needed

```bash
# Format code with Pint
./vendor/bin/pint

# Run tests before committing
php artisan test
```

---

## 📄 **License**

This project is licensed under the **MIT License**.

```
MIT License

Copyright (c) 2026 Akshay Kumar Shaw

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.
```

---

## 👨‍💻 **Author**

<div align="center">

### **Akshay Kumar Shaw**

<img src="https://img.icons8.com/fluency/96/000000/user-male-circle.png" width="100"/>

*Full Stack Developer | Laravel Enthusiast | Open Source Contributor*

---

### 🌐 **Connect With Me**

<p align="center">
  <a href="https://github.com/AkshayKumarShaw44">
    <img src="https://img.shields.io/badge/GitHub-181717?style=for-the-badge&logo=github&logoColor=white" alt="GitHub"/>
  </a>
  <a href="https://x.com/Akshaykrshaw">
    <img src="https://img.shields.io/badge/Twitter-1DA1F2?style=for-the-badge&logo=twitter&logoColor=white" alt="Twitter"/>
  </a>
  <a href="https://www.linkedin.com/in/akshaykumarshaw44">
    <img src="https://img.shields.io/badge/LinkedIn-0A66C2?style=for-the-badge&logo=linkedin&logoColor=white" alt="LinkedIn"/>
  </a>
  <a href="https://www.instagram.com/akshay_kr_shaw/">
    <img src="https://img.shields.io/badge/Instagram-E4405F?style=for-the-badge&logo=instagram&logoColor=white" alt="Instagram"/>
  </a>
  <a href="mailto:akshaykumarshaw44@gmail.com">
    <img src="https://img.shields.io/badge/Email-D14836?style=for-the-badge&logo=gmail&logoColor=white" alt="Email"/>
  </a>
</p>

---

### 📊 **GitHub Stats**

<p align="center">
  <img src="https://github-readme-stats.vercel.app/api?username=AkshayKumarShaw44&show_icons=true&theme=radical" alt="GitHub Stats" />
</p>

<p align="center">
  <img src="https://github-readme-streak-stats.herokuapp.com/?user=AkshayKumarShaw44&theme=radical" alt="GitHub Streak" />
</p>

---

### 💼 **Portfolio**

```
📧 Email: akshaykumarshaw44@gmail.com
🌐 GitHub: github.com/AkshayKumarShaw44
🐦 Twitter: @Akshaykrshaw
💼 LinkedIn: linkedin.com/in/akshaykumarshaw44
📸 Instagram: @akshay_kr_shaw
```

</div>

---

## 🙏 **Acknowledgments**

Special thanks to these amazing projects and communities:

<table>
<tr>
<td align="center" width="20%">
<img src="https://laravel.com/img/logomark.min.svg" width="48"/><br/>
<b>Laravel</b><br/>
<sub>PHP Framework</sub>
</td>
<td align="center" width="20%">
<img src="https://www.mongodb.com/assets/images/global/favicon.ico" width="48"/><br/>
<b>MongoDB</b><br/>
<sub>NoSQL Database</sub>
</td>
<td align="center" width="20%">
<img src="https://tailwindcss.com/favicons/favicon-32x32.png" width="48"/><br/>
<b>Tailwind CSS</b><br/>
<sub>CSS Framework</sub>
</td>
<td align="center" width="20%">
<img src="https://alpinejs.dev/alpine_long.svg" width="48"/><br/>
<b>Alpine.js</b><br/>
<sub>JS Framework</sub>
</td>
<td align="center" width="20%">
<img src="https://tiptap.dev/favicon.ico" width="48"/><br/>
<b>TipTap</b><br/>
<sub>Rich Text Editor</sub>
</td>
</tr>
<tr>
<td align="center" width="20%">
<img src="https://socket.io/images/favicon.png" width="48"/><br/>
<b>Socket.IO</b><br/>
<sub>Real-time Engine</sub>
</td>
<td align="center" width="20%">
<img src="https://vitejs.dev/logo.svg" width="48"/><br/>
<b>Vite</b><br/>
<sub>Build Tool</sub>
</td>
<td align="center" width="20%">
<img src="https://fontawesome.com/favicon.ico" width="48"/><br/>
<b>Font Awesome</b><br/>
<sub>Icon Library</sub>
</td>
<td align="center" width="20%">
<img src="https://michalsnik.github.io/aos/img/favicon.ico" width="48"/><br/>
<b>AOS</b><br/>
<sub>Scroll Animations</sub>
</td>
<td align="center" width="20%">
<img src="https://pestphp.com/www/favicon.ico" width="48"/><br/>
<b>Pest PHP</b><br/>
<sub>Testing Framework</sub>
</td>
</tr>
</table>

---

## 🎯 **Roadmap**

### 🚀 **Upcoming Features**

- [ ] 📱 **Mobile Apps** - iOS and Android native apps
- [ ] 📄 **Export Options** - PDF, Markdown, DOCX export
- [ ] 📋 **Note Templates** - Pre-built templates for common use cases
- [ ] 🕐 **Version History** - Track changes and restore previous versions
- [ ] 🔒 **End-to-End Encryption** - Secure your sensitive notes
- [ ] 📎 **File Attachments** - Attach images, PDFs, and other files
- [ ] 🎤 **Voice Notes** - Record and transcribe voice notes
- [ ] 🤖 **AI Suggestions** - Smart writing suggestions and auto-complete
- [ ] 🌐 **Offline Mode** - Work offline with automatic sync
- [ ] 📊 **Advanced Analytics** - Detailed productivity insights
- [ ] 🎨 **Custom Themes** - Create and share custom themes
- [ ] 🔗 **API Access** - RESTful API for third-party integrations
- [ ] 🌍 **Internationalization** - Multi-language support
- [ ] 📧 **Email Notifications** - Get notified via email
- [ ] 🔍 **Advanced Search** - Full-text search with filters

---

## 💡 **Tips for Presentation**

### 🎤 **Key Points to Highlight**

1. **Real-Time Collaboration** 🤝
   - Show multiple browsers editing simultaneously
   - Demonstrate cursor tracking and typing indicators
   - Highlight instant synchronization

2. **Modern UI/UX** 🎨
   - Showcase glassmorphism design
   - Demonstrate smooth animations
   - Show responsive design on different devices

3. **Clean Architecture** 🏗️
   - Explain MVC pattern
   - Discuss service layer for business logic
   - Show separation of concerns

4. **MongoDB Integration** 🗄️
   - Discuss NoSQL benefits for this use case
   - Show flexible schema design
   - Explain scalability advantages

5. **Socket.IO Technology** ⚡
   - Explain WebSocket vs HTTP polling
   - Show room-based architecture
   - Demonstrate real-time event broadcasting

### 🎬 **Demo Flow**

1. **Landing Page** - Show features and design
2. **Registration** - Create a new account
3. **Dashboard** - Explore analytics and organization
4. **Create Note** - Demonstrate rich text editing
5. **Collaboration** - Share note and show real-time editing
6. **Comments** - Add and view comments
7. **Notifications** - Show real-time notifications
8. **Organization** - Demonstrate tags, pins, and categories
9. **Search** - Find notes quickly
10. **Profile** - Show user settings

---

## 📞 **Support**

### 🆘 **Need Help?**

- 📧 **Email:** akshaykumarshaw44@gmail.com
- 🐛 **Issues:** [GitHub Issues](https://github.com/AkshayKumarShaw44/Notoliyo/issues)
- 💬 **Discussions:** [GitHub Discussions](https://github.com/AkshayKumarShaw44/Notoliyo/discussions)
- 📖 **Documentation:** [Wiki](https://github.com/AkshayKumarShaw44/Notoliyo/wiki)

---

## ⭐ **Show Your Support**

If you found this project helpful, please consider:

- ⭐ **Starring** the repository
- 🍴 **Forking** for your own projects
- 📢 **Sharing** with others
- 💖 **Sponsoring** the development

<div align="center">

### **Made with ❤️ by [Akshay Kumar Shaw](https://github.com/AkshayKumarShaw44)**

---

<img src="https://img.shields.io/github/stars/AkshayKumarShaw44/Notoliyo?style=social" alt="Stars"/>
<img src="https://img.shields.io/github/forks/AkshayKumarShaw44/Notoliyo?style=social" alt="Forks"/>
<img src="https://img.shields.io/github/watchers/AkshayKumarShaw44/Notoliyo?style=social" alt="Watchers"/>

---

### **⭐ Star this repository if you find it helpful! ⭐**

<sub>Built with passion for the developer community 🚀</sub>

</div>
