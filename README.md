#  Stc-MNGM Stock Management System v2.0

## 📊 System Architecture Diagrams

### 🏗️ Class Diagram (Database Schema)

```mermaid
classDiagram
    class Users {
        +int id
        +string username
        +string email
        +string password
        +string full_name
        +enum role
        +timestamp created_at
        +timestamp last_login
        +login()
        +logout()
        +isLoggedIn()
        +isAdmin()
    }

    class Article {
        +int id
        +string nom_article
        +int id_categorie
        +int quantite
        +int prix_unitaire
        +datetime date_fabrication
        +datetime date_expiration
        +string images
        +getArticle()
        +countArticle()
        +addArticle()
        +updateArticle()
        +deleteArticle()
    }

    class CategorieArticle {
        +int id
        +string libelle_categorie
        +getCategorie()
        +addCategorie()
        +updateCategorie()
    }

    class Client {
        +int id
        +string nom
        +string prenom
        +string telephone
        +string adresse
        +getClient()
        +addClient()
        +updateClient()
    }

    class Fournisseur {
        +int id
        +string nom
        +string prenom
        +string telephone
        +string adresse
        +getFournisseur()
        +addFournisseur()
        +updateFournisseur()
    }

    class Vente {
        +int id
        +int id_article
        +int id_client
        +int quantite
        +int prix
        +timestamp date_vente
        +enum etat
        +getVente()
        +addVente()
        +annulerVente()
        +getLastVente()
        +getMostVente()
    }

    class Commande {
        +int id
        +int id_article
        +int id_fournisseur
        +int quantite
        +int prix
        +timestamp date_commande
        +getCommande()
        +addCommande()
        +updateStock()
    }

    class Contact {
        +int id
        +string nom
        +string prenom
        +string email
        +string numero_de_telephone
    }

    class DatabaseConnection {
        +PDO connexion
        +connect()
        +disconnect()
    }

    class AuthManager {
        +login()
        +logout()
        +isLoggedIn()
        +requireLogin()
        +getUserInfo()
        +isAdmin()
        +requireAdmin()
    }

    class Dashboard {
        +getAllCommande()
        +getAllVente()
        +getAllArticle()
        +getCA()
        +getLastVente()
        +getMostVente()
    }

    %% Relationships
    Article --> CategorieArticle : belongs_to
    Vente --> Article : contains
    Vente --> Client : made_by
    Commande --> Article : orders
    Commande --> Fournisseur : from
    AuthManager --> Users : manages
    Dashboard --> Vente : displays
    Dashboard --> Commande : displays
    Dashboard --> Article : displays
```

### 🔄 Sequence Diagram (User Authentication Flow)

```mermaid
sequenceDiagram
    participant U as User
    participant L as Login Page
    participant A as Auth Manager
    participant D as Database
    participant S as Session
    participant H as Home Page

    U->>L: Access Login Page
    L->>U: Display Login Form
    
    U->>L: Enter Credentials
    L->>A: Submit Login Request
    A->>D: Query User by Username/Email
    D->>A: Return User Data
    
    alt Valid Credentials
        A->>A: Verify Password Hash
        A->>D: Update Last Login
        A->>S: Create Session
        A->>L: Return Success
        L->>H: Redirect to Dashboard
        H->>U: Display Dashboard
    else Invalid Credentials
        A->>L: Return Error
        L->>U: Display Error Message
    end

    Note over U,H: User is now authenticated
    U->>H: Navigate to Features
    H->>A: Check Session
    A->>S: Validate Session
    A->>H: Allow Access
    H->>U: Display Content
```

### 🔄 Sequence Diagram (Sales Process)

```mermaid
sequenceDiagram
    participant U as User
    participant S as Sales Page
    participant V as Vente Manager
    participant A as Article Manager
    participant D as Database
    participant R as Receipt

    U->>S: Access Sales Page
    S->>A: Get Available Articles
    A->>D: Query Articles
    D->>A: Return Articles List
    A->>S: Display Articles
    
    U->>S: Select Article & Quantity
    S->>A: Check Stock Availability
    A->>D: Query Current Stock
    D->>A: Return Stock Level
    
    alt Sufficient Stock
        S->>V: Create Sale
        V->>D: Insert Sale Record
        V->>A: Update Stock Level
        A->>D: Decrease Stock
        V->>R: Generate Receipt
        R->>U: Display Receipt
        S->>U: Show Success Message
    else Insufficient Stock
        S->>U: Show Stock Error
    end
```

### 🔄 Sequence Diagram (Order Process)

```mermaid
sequenceDiagram
    participant U as User
    participant O as Order Page
    participant C as Commande Manager
    participant A as Article Manager
    participant F as Fournisseur Manager
    participant D as Database

    U->>O: Access Order Page
    O->>A: Get Articles List
    A->>D: Query Articles
    D->>A: Return Articles
    A->>O: Display Articles
    
    O->>F: Get Suppliers List
    F->>D: Query Suppliers
    D->>F: Return Suppliers
    F->>O: Display Suppliers
    
    U->>O: Select Article, Supplier & Quantity
    O->>C: Create Order
    C->>D: Insert Order Record
    C->>A: Update Stock Level
    A->>D: Increase Stock
    C->>O: Return Success
    O->>U: Show Success Message
```

### 📋 Activity Diagram (Main System Flow)

```mermaid
flowchart TD
    A[Start Application] --> B{User Authenticated?}
    B -->|No| C[Show Login Page]
    C --> D[Enter Credentials]
    D --> E{Valid Credentials?}
    E -->|No| C
    E -->|Yes| F[Create Session]
    F --> G[Show Dashboard]
    
    B -->|Yes| G
    
    G --> H{Select Action}
    
    H -->|Dashboard| I[Display Statistics]
    H -->|Articles| J[Article Management]
    H -->|Sales| K[Sales Management]
    H -->|Orders| L[Order Management]
    H -->|Clients| M[Client Management]
    H -->|Suppliers| N[Supplier Management]
    H -->|Logout| O[Destroy Session]
    
    J --> P{Article Action}
    P -->|Add| Q[Add New Article]
    P -->|Edit| R[Edit Article]
    P -->|Delete| S[Delete Article]
    P -->|View| T[View Articles]
    
    K --> U{Sales Action}
    U -->|New Sale| V[Create Sale]
    U -->|View Sales| W[View Sales History]
    U -->|Cancel Sale| X[Cancel Sale]
    
    L --> Y{Order Action}
    Y -->|New Order| Z[Create Order]
    Y -->|View Orders| AA[View Order History]
    
    M --> BB{Client Action}
    BB -->|Add| CC[Add New Client]
    BB -->|Edit| DD[Edit Client]
    BB -->|View| EE[View Clients]
    
    N --> FF{Supplier Action}
    FF -->|Add| GG[Add New Supplier]
    FF -->|Edit| HH[Edit Supplier]
    FF -->|View| II[View Suppliers]
    
    Q --> JJ[Update Database]
    R --> JJ
    S --> JJ
    V --> JJ
    Z --> JJ
    CC --> JJ
    DD --> JJ
    GG --> JJ
    HH --> JJ
    
    JJ --> G
    O --> A
    
    style A fill:#e1f5fe
    style G fill:#c8e6c9
    style O fill:#ffcdd2
```

### 🔐 Activity Diagram (Authentication Flow)

```mermaid
flowchart TD
    A[Access Application] --> B{Session Active?}
    B -->|Yes| C[Check User Role]
    B -->|No| D[Redirect to Login]
    
    C --> E{Is Admin?}
    E -->|Yes| F[Full Access]
    E -->|No| G[Limited Access]
    
    D --> H[Display Login Form]
    H --> I[Enter Username/Email]
    I --> J[Enter Password]
    J --> K[Submit Form]
    
    K --> L{Validate Credentials}
    L -->|Invalid| M[Show Error Message]
    M --> H
    
    L -->|Valid| N[Create Session]
    N --> O[Update Last Login]
    O --> P[Set User Role]
    P --> Q[Redirect to Dashboard]
    
    F --> R[Access All Features]
    G --> S[Access Basic Features]
    
    R --> T{User Action}
    S --> T
    
    T -->|Logout| U[Destroy Session]
    T -->|Continue| V[Perform Action]
    
    U --> D
    V --> T
    
    style A fill:#e1f5fe
    style F fill:#c8e6c9
    style G fill:#fff3e0
    style D fill:#ffcdd2
    style U fill:#ffcdd2
```

## 🚀 Enhanced Features

### ✨ New Features Added

1. **User Authentication System**
   - Secure login/logout functionality
   - Role-based access control (Admin/User)
   - Session management
   - Password hashing with bcrypt

2. **Enhanced UI/UX Design**
   - Modern gradient backgrounds
   - Glassmorphism effects with backdrop blur
   - Smooth animations and transitions
   - Responsive design for all devices
   - Enhanced color scheme with brand colors

3. **Logo Integration**
   - Custom  Stc-MNGM logo in sidebar and profile
   - Professional branding throughout the application

4. **Improved Navigation**
   - Enhanced sidebar with better visual hierarchy
   - Active state indicators
   - Hover effects and animations
   - Role-based menu items

5. **Enhanced Footer**
   - "Made with ❤️ by Wissal" signature
   - Version information
   - Professional styling

6. **Better Form Styling**
   - Modern input fields with focus states
   - Enhanced button designs
   - Improved alert messages
   - Better table styling

## 🔐 Authentication

### Default Login Credentials
- **Username:** `admin` or `wissal`
- **Password:** `admin123`
- **Email:** `admin@dclic.com` or `wissal@dclic.com`

### User Roles
- **Admin:** Full access to all features
- **User:** Limited access (basic operations)

## 🎨 Design Enhancements

### Color Scheme
- Primary: `#0a2558` (Deep Blue)
- Secondary: `#1e3a8a` (Medium Blue)
- Accent: `#e05260` (Coral Red)
- Background: Gradient from `#f5f7fa` to `#c3cfe2`

### Visual Effects
- Glassmorphism cards with backdrop blur
- Smooth hover animations
- Gradient buttons and backgrounds
- Shadow effects for depth
- Animated heart icon in footer

## 📁 File Structure

```
gstock-dclic/
├── auth/
│   └── login.php              # Login page
├── model/
│   ├── auth.php               # Authentication functions
│   ├── connexion.php          # Database connection
│   ├── function.php           # Core functions
│   ├── logout.php             # Logout handler
│   └── [other model files]    # CRUD operations
├── public/
│   ├── css/
│   │   ├── style.css          # Main styles
│   │   └── auth.css           # Authentication styles
│   └── images/
│       └── logo.png           #  Stc-MNGM logo
├── vue/
│   ├── entete.php             # Header with auth
│   ├── pied.php               # Footer with signature
│   └── [other view files]     # Page templates
├── gestion_stock.sql          # Database schema
├── index.php                  # Entry point
└── README.md                  # This file
```

## 🛠️ Installation

1. **Database Setup**
   ```sql
   -- Import the gestion_stock.sql file to create the database
   -- Default users will be created automatically
   ```

2. **File Permissions**
   ```bash
   # Ensure the images directory is writable
   chmod 755 public/images/
   ```

3. **Configuration**
   - Update database credentials in `model/connexion.php`
   - Ensure PHP has required extensions (PDO, MySQL)

## 🔧 Technical Improvements

### Security
- Password hashing with bcrypt
- Session-based authentication
- SQL injection prevention with prepared statements
- XSS protection with htmlspecialchars()

### Performance
- Optimized CSS with modern properties
- Efficient database queries
- Responsive images and assets

### User Experience
- Intuitive navigation
- Clear visual feedback
- Consistent design language
- Mobile-friendly interface

## 🎯 Key Features

### Dashboard
- Real-time statistics
- Recent sales overview
- Top-selling products
- Beautiful data visualization

### Inventory Management
- Add/edit/delete articles
- Category management
- Image upload support
- Stock tracking

### Sales & Orders
- Sales recording
- Order management
- Client management
- Supplier management

### Reporting
- Sales reports
- Inventory reports
- Receipt generation
- Print functionality

## 🚀 Getting Started

1. **Access the Application**
   - Navigate to your web server
   - You'll be redirected to the login page

2. **Login**
   - Use the default credentials above
   - Or create new users in the database

3. **Explore Features**
   - Dashboard for overview
   - Articles for inventory management
   - Sales for transaction recording
   - Reports for analytics

## 📱 Responsive Design

The application is fully responsive and works on:
- Desktop computers
- Tablets
- Mobile phones
- All modern browsers

## 🔄 Version History

### v2.0 (Current)
- Added user authentication
- Enhanced UI/UX design
- Logo integration
- Improved styling
- Better navigation
- Footer signature

### v1.0 (Original)
- Basic stock management
- CRUD operations
- Simple interface

## 👨‍💻 Developer

**Made with ❤️ by Wissal**

- **Version:** 2.0
- **Framework:** PHP (Vanilla)
- **Database:** MySQL
- **Styling:** CSS3 with modern features
- **Icons:** Boxicons

## 📞 Support

For support or questions, please contact the development team.

---

** Stc-MNGM Stock Management System** - Professional inventory management solution 