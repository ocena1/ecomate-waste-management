# Eco-Waste Logistics Bridge (EcoMate Command Center)

## 1) Introduction / Background
EcoMate is a web-based controller for simulated logistics of waste collection. A map visualizes waste bins and their fill levels. The system computes route-based logistics analytics (distance/CO2 estimate) using the selected “active” bins.

## 2) Objectives
- Provide a working end-to-end web application with:
  - Live dashboard + map visualization
  - CRUD operations for bins (admin only)
  - Session-based login system (admin/user roles)
- Deliver a demo-ready environment with sample data.

## 3) Scope and Limitations
### Scope
- Users can log in.
- Admin can create/update/delete bins.
- App shows bins and updates dashboard/route when bin fill levels change.

### Limitations
- This is a demo/simulation (distance + CO2 estimation are simplified).
- No real-time streaming from sensors.
- Google Maps API key is stored directly in the frontend for demo purposes.

## 4) System Features
- **Authentication & Authorization**
  - Role-based access: `admin` can manage bins; `user` can view the map.
- **Bin Management (CRUD)**
  - Create bins with name and coordinates.
  - Update fill levels using a slider.
  - Delete bins.
- **Logistics Analytics**
  - Active bins are defined as `fill_level > 50`.
  - Route is calculated via Google Directions API among active bins.
  - CO2 saved estimate is simplified as `distance_km * 0.25`.

## 5) System Design
### ERD (Simplified)
- **users**(
  - id (PK)
  - username (UNIQUE)
  - password_hash
  - role (admin/user)
  - created_at
)

- **bins**(
  - id (PK)
  - location_name
  - lat
  - lng
  - fill_level (0-100)
  - last_updated
)

### Flow (High Level)
1. User loads `index.html`.
2. Frontend calls `whoami.php` to detect authentication.
3. Frontend fetches bins from `get_bins.php`.
4. Admin-only CRUD actions call `manage_bins.php` with an action parameter.
5. Dashboard uses active bins to request directions and compute analytics.

### UML (Text)
- `index.html` (UI)
  - `refreshData()` -> `get_bins.php`
  - `createBin()/updateBin()/deleteBin()` -> `manage_bins.php`
- `manage_bins.php` (API)
  - validates session and checks admin role
  - handles actions: create/update/delete

## 6) Demo / User Manual
### Test Accounts
- **Admin**: `admin` / `admin123`
- **User**: `user` / `user123`

### How to Run (Docker)
From repository root:
```bash
docker-compose up --build
```
Open:
- http://localhost:8080

### Demo Steps
1. Open http://localhost:8080 (shows login page).
2. Login as **user** (`user` / `user123`):
   - Redirected to main app with read-only access.
   - CRUD controls are hidden/disabled.
   - Can view the map and bin status.
3. Logout and login as **admin** (`admin` / `admin123`):
   - Redirected to main app with full access.
   - CRUD controls become available.
   - Can create, update, and delete bins.
4. Update bin fill levels and observe:
   - Marker colors change based on fill level.
   - Route and dashboard analytics update automatically.
5. Direct access to main app without login redirects to login page.

## 7) Project Structure
- `app/`
  - `login.html` - dedicated login interface
  - `index.html` - main frontend UI (requires authentication)
  - `get_bins.php` - bins fetch API
  - `manage_bins.php` - CRUD API (admin only)
  - `login.php`, `logout.php`, `whoami.php` - auth endpoints
  - `auth.php` - auth helper functions
  - `config.php` - configuration settings
  - `get_config.php` - configuration API endpoint
  - `admin.php` - admin-only manual controller page
- `db/`
  - `init.sql` - exported schema + sample data
- `docker-compose.yml` - docker orchestration

