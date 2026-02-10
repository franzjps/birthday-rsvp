# InfinityFree Deployment Guide for Aurie Day Project

## Step-by-Step Instructions

### Step 1: Prepare Your Project Locally

1. **Build your frontend assets:**
   ```bash
   npm run build
   ```
   This creates optimized CSS and JS files in the `public/build/` folder.

2. **Install production dependencies:**
   ```bash
   composer install --optimize-autoloader --no-dev
   ```

3. **Generate application key:**
   ```bash
   php artisan key:generate
   ```

### Step 2: Create InfinityFree Account & Get Hosting

1. Go to https://www.infinityfree.net/
2. Sign up for a free account
3. Create a new website
4. Note your **FTP credentials** (username, password, host)
5. Note your **MySQL database credentials** (host, database name, username, password)

### Step 3: Upload Project Files via FTP

1. **Download FTP Client** (e.g., FileZilla - https://filezilla-project.org/)

2. **Connect to InfinityFree FTP:**
   - Host: Your FTP host (from InfinityFree control panel)
   - Username: Your FTP username
   - Password: Your FTP password
   - Port: 21

3. **Upload project files:**
   - Navigate to the `htdocs` folder on the server (or public_html)
   - Upload all files EXCEPT:
     - `node_modules/` folder
     - `.git/` folder
     - `.env` file (create new one on server)
   - The server folder structure should look like:
     ```
     htdocs/
     ├── app/
     ├── bootstrap/
     ├── config/
     ├── database/
     ├── public/
     ├── resources/
     ├── routes/
     ├── storage/
     ├── vendor/
     ├── .htaccess
     ├── artisan
     ├── composer.json
     ├── package.json
     └── ... (other files)
     ```

### Step 4: Configure Environment Variables

1. **Create `.env` file on server via FTP:**
   - Create a new text file named `.env`
   - Add the following content and customize:
   ```
   APP_NAME="Aurie Day"
   APP_ENV=production
   APP_KEY=base64:[YOUR_APPLICATION_KEY_FROM_LOCAL_php_artisan_key:generate]
   APP_DEBUG=false
   APP_URL=https://your-infinityfree-domain.com

   DB_CONNECTION=mysql
   DB_HOST=your-mysql-host-from-infinityfree
   DB_PORT=3306
   DB_DATABASE=your-database-name
   DB_USERNAME=your-db-username
   DB_PASSWORD=your-db-password

   CACHE_DRIVER=file
   QUEUE_CONNECTION=sync
   SESSION_DRIVER=cookie
   ```

   **Replace placeholders with your actual values from InfinityFree control panel**

### Step 5: Set Up Database

1. **Access InfinityFree MySQL Tool:**
   - Go to InfinityFree Control Panel
   - Find "MySQL Databases" or "Database Manager"
   - Create a new database (if not already created)

2. **Run migrations via SSH (if available) or cPanel:**
   ```bash
   php artisan migrate --force
   ```
   
   **If SSH is not available**, ask InfinityFree support to run migrations or use a web-based tool.

### Step 6: Configure File Permissions

1. **Via FTP, set permissions (chmod)** for these folders:
   - `/storage` → 755 (or 777 if 755 doesn't work)
   - `/bootstrap/cache` → 755 (or 777 if 755 doesn't work)
   - `/storage/logs` → 755
   - `/storage/framework` → 755

2. If FTP doesn't show chmod options:
   - Right-click folder → Properties → change permissions
   - Or use cPanel File Manager if available

### Step 7: Configure Web Server

1. **Create/Update `.htaccess` file** in `public/` folder:
   ```apache
   <IfModule mod_rewrite.c>
       <IfModule mod_negotiation.c>
           Options -MultiViews -Indexes
       </IfModule>

       RewriteEngine On

       # Handle Authorization Header
       RewriteCond %{TYPE} ^application/x-www-form-urlencoded$
       RewriteCond %{REQUEST_METHOD} ^POST$
       RewriteRule .* - [E=HTTP_AUTHORIZATION:%{HTTP:Authorization}]

       # Redirect Trailing Slashes If Not A Folder...
       RewriteCond %{REQUEST_FILENAME} !-d
       RewriteCond %{REQUEST_URI} (.+)/$
       RewriteRule ^ %1 [L,R=301]

       # Send Requests To Front Controller...
       RewriteCond %{REQUEST_FILENAME} !-d
       RewriteCond %{REQUEST_FILENAME} !-f
       RewriteRule ^ index.php [L]
   </IfModule>
   ```

### Step 8: Clear Cache and Optimize

1. **Delete cache files** (via FTP):
   - Delete contents of `/bootstrap/cache/`
   - Delete contents of `/storage/framework/cache/`

2. **Run optimization commands** via SSH (if available):
   ```bash
   php artisan config:cache
   php artisan route:cache
   php artisan view:cache
   ```

### Step 9: Test Your Application

1. Visit your InfinityFree domain URL
2. Check if the page loads correctly
3. Test RSVP form submission
4. Test love message submission
5. Check browser console for any errors (F12)

### Step 10: Troubleshooting

| Issue | Solution |
|-------|----------|
| **Blank page / 500 error** | Check `/storage/logs/laravel.log` for errors. Enable APP_DEBUG=true temporarily to see errors. |
| **Images not loading** | Verify images are in `/public/images/` folder. Check file paths in carousel. |
| **Forms not submitting** | Check database connection in `.env`. Verify migrations ran successfully. |
| **Static files not loading** | Clear browser cache (Ctrl+Shift+Del). Verify `/public/build/` files exist. |
| **Database connection error** | Double-check DB credentials in `.env`. Verify MySQL is enabled. |
| **Permission denied errors** | Change folder permissions to 777 via FTP or cPanel File Manager. |

## Important Notes

- **Keep `.env` secure**: Never commit it to version control
- **Backup regularly**: Use FTP to backup your database and files periodically
- **Monitor storage**: InfinityFree has storage limits; monitor `/storage/logs/`
- **Use HTTPS**: InfinityFree supports free SSL certificates via their control panel
- **Test locally first**: Always test changes on your local machine before uploading

## Support Resources

- InfinityFree Support: https://forum.infinityfree.net/
- Laravel Documentation: https://laravel.com/docs
- FTP Tutorials: Search "FTP upload guide" for your FTP client

---

## Quick Reference: File Upload Checklist

- [ ] Frontend built (`npm run build`)
- [ ] Dependencies optimized (`composer install --no-dev`)
- [ ] All files uploaded via FTP (except node_modules, .git)
- [ ] `.env` created and configured on server
- [ ] Database migrations run
- [ ] File permissions set (storage, bootstrap/cache)
- [ ] `.htaccess` in public folder configured
- [ ] Cache cleared
- [ ] Domain tested and working
