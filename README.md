# NEXUS CRM ✦ Enterprise Suite

![NEXUS CRM Banner](https://via.placeholder.com/1200x400/030303/ffffff?text=NEXUS+CRM+%E2%9C%A6+Enterprise+Control)

**NEXUS CRM** is a modern, high-velocity Customer Relationship Management system engineered for precision and speed. Built with Laravel 11 and styled with a custom, ultra-premium Tailwind CSS system, NEXUS provides a stunning Dark/Light mode UI with seamless glassmorphism and real-time data visualization.

---

## ✨ Key Features

- **🚀 Live Demo Ready (Portfolio Mode)**: Instant access auto-login system designed for recruiters and portfolio visitors to experience the dashboard without hurdles.
- **🎨 Ultra-Premium UI/UX**: Custom design system featuring CSS variables, advanced glassmorphism (backdrop filters), deep shadows, and meticulously crafted CSS micro-animations.
- **🌓 Dynamic Theming**: Full support for both **Dark Mode** and **Light Mode** across every single component and panel.
- **📋 Kanban Pipeline**: High-fidelity drag-and-drop style Kanban board for visualizing deal flow and lead status across multiple stages (New, Negotiation, Won, Lost).
- **🛡️ Role-Based Access Control (RBAC)**: 
  - **Admins**: Have global visibility over all data, agents, and metrics.
  - **Agents (Operatives)**: Have isolated access only to their assigned clients and leads.
- **📱 Mobile-First Architecture**: Fully responsive views with safe-area calculations to ensure native-like experiences on iOS and Android devices.
- **📊 Real-Time Analytics**: Dashboard panels instantly reflecting customer statuses, overall net deal values, and pipeline health.

---

## 🛠️ Technology Stack

- **Backend**: [Laravel 11](https://laravel.com/) (PHP 8.2+)
- **Database**: MySQL / SQLite (Development)
- **Frontend / Styling**: [Tailwind CSS 3+](https://tailwindcss.com/), Custom Vanilla CSS Variables for precise theme control.
- **Templating**: Laravel Blade Components

---

## 📂 System Modules

### 1. Command Center (Dashboard)
The central hub providing a bird's-eye view of your sales pipeline. It aggregates data, tracks net deal values, and categorizes leads by their current operational status.

### 2. Tactical Grid (Kanban)
A visual pipeline to track operatives (customers) from `New Lead` to `Mission Won`. 

### 3. Operative Dossiers
Detailed client pages featuring radar-scan animations, secure communication links, and an operational chronology timeline. 

### 4. Personnel Management (Admins Only)
Admins can invite new agents into the system, assign them specific leads, and revoke access instantly. 

---

## 🚀 Installation & Setup

Want to run NEXUS CRM locally? Follow these steps:

### Prerequisites
- PHP 8.2 or higher
- Composer
- Node.js & NPM
- MySQL or SQLite

### Steps

1. **Clone the repository**
   ```bash
   git clone https://github.com/your-username/nexus-crm.git
   cd nexus-crm
