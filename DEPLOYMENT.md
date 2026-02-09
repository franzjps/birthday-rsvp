# Aurie Day - Production Deployment Guide

## 📋 Prerequisites

### Server Requirements
- PHP 8.2 or higher
- Composer
- Node.js 18+ and npm
- MySQL 8.0+ or PostgreSQL
- Web server (Apache/Nginx)
- SSL certificate (recommended)

### Required PHP Extensions
```bash
php -m | grep -E "BCMath|Ctype|Fileinfo|JSON|Mbstring|OpenSSL|PDO|Tokenizer|XML"
```

---

## 🚀 Deployment Steps

### 1. Clone or Upload Project Files

```bash
# Clone from repository
git clone <your-repo-url> /var/www/aurieday
cd /var/www/aurieday

# OR upload via FTP/SFTP to your server
```

### 2. Install Dependencies

```bash
# Install PHP dependencies
composer install --optimize-autoloader --no-dev

# Install Node.js dependencies
npm ci --production
```

### 3. Environment Configuration

```bash
# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate
```

Edit `.env` file with production settings:

```env
APP_NAME="Aurie Day"
APP_ENV=production
APP_DEBUG=false
APP_URL=https://your-domain.com

# Database Configuration
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=aurieday_db
DB_USERNAME=your_db_user
DB_PASSWORD=your_secure_password

# Mail Configuration (if needed)
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=587
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="hello@yourdomain.com"
MAIL_FROM_NAME="${APP_NAME}"

# Session & Cache
SESSION_DRIVER=file
CACHE_DRIVER=file
QUEUE_CONNECTION=sync
```

### 4. Create Database

```bash
# Login to MySQL
mysql -u root -p

# Create database
CREATE DATABASE aurieday_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
CREATE USER 'aurieday_user'@'localhost' IDENTIFIED BY 'your_secure_password';
GRANT ALL PRIVILEGES ON aurieday_db.* TO 'aurieday_user'@'localhost';
FLUSH PRIVILEGES;
EXIT;
```

### 5. Run Database Migrations

```bash
# Run migrations
php artisan migrate --force

# (Optional) Seed initial data
php artisan db:seed --force
```

### 6. Build Frontend Assets

```bash
# Build for production (optimized)
npm run build

# This creates files in public/build/
```

### 7. Set File Permissions

```bash
# Set ownership (adjust user based on your web server)
sudo chown -R www-data:www-data /var/www/aurieday

# Set directory permissions
sudo find /var/www/aurieday -type d -exec chmod 755 {} \;
sudo find /var/www/aurieday -type f -exec chmod 644 {} \;

# Set storage and cache permissions
sudo chmod -R 775 /var/www/aurieday/storage
sudo chmod -R 775 /var/www/aurieday/bootstrap/cache
```

### 8. Optimize Application

```bash
# Clear and cache configuration
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Optimize autoloader
composer dump-autoload --optimize
```

---

## 🌐 Web Server Configuration

### Option A: Nginx Configuration

Create file: `/etc/nginx/sites-available/aurieday`

```nginx
server {
    listen 80;
    listen [::]:80;
    server_name your-domain.com www.your-domain.com;
    
    # Redirect to HTTPS
    return 301 https://$server_name$request_uri;
}

server {
    listen 443 ssl http2;
    listen [::]:443 ssl http2;
    server_name your-domain.com www.your-domain.com;
    
    root /var/www/aurieday/public;
    index index.php index.html;

    # SSL Configuration
    ssl_certificate /etc/ssl/certs/your-domain.crt;
    ssl_certificate_key /etc/ssl/private/your-domain.key;
    ssl_protocols TLSv1.2 TLSv1.3;
    ssl_ciphers HIGH:!aNULL:!MD5;

    # Logging
    access_log /var/log/nginx/aurieday-access.log;
    error_log /var/log/nginx/aurieday-error.log;

    # Security headers
    add_header X-Frame-Options "SAMEORIGIN" always;
    add_header X-Content-Type-Options "nosniff" always;
    add_header X-XSS-Protection "1; mode=block" always;

    # Character encoding
    charset utf-8;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    # Deny access to hidden files
    location ~ /\. {
        deny all;
    }

    # PHP-FPM Configuration
    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.2-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }

    # Cache static assets
    location ~* \.(jpg|jpeg|png|gif|ico|css|js|svg|woff|woff2|ttf|eot)$ {
        expires 365d;
        add_header Cache-Control "public, immutable";
    }
}
```

Enable the site:
```bash
sudo ln -s /etc/nginx/sites-available/aurieday /etc/nginx/sites-enabled/
sudo nginx -t
sudo systemctl reload nginx
```

### Option B: Apache Configuration

Create file: `/etc/apache2/sites-available/aurieday.conf`

```apache
<VirtualHost *:80>
    ServerName your-domain.com
    ServerAlias www.your-domain.com
    
    # Redirect to HTTPS
    Redirect permanent / https://your-domain.com/
</VirtualHost>

<VirtualHost *:443>
    ServerName your-domain.com
    ServerAlias www.your-domain.com
    DocumentRoot /var/www/aurieday/public

    # SSL Configuration
    SSLEngine on
    SSLCertificateFile /etc/ssl/certs/your-domain.crt
    SSLCertificateKeyFile /etc/ssl/private/your-domain.key

    <Directory /var/www/aurieday/public>
        Options -Indexes +FollowSymLinks
        AllowOverride All
        Require all granted
    </Directory>

    # Logging
    ErrorLog ${APACHE_LOG_DIR}/aurieday-error.log
    CustomLog ${APACHE_LOG_DIR}/aurieday-access.log combined
</VirtualHost>
```

Enable the site:
```bash
sudo a2ensite aurieday.conf
sudo a2enmod rewrite ssl
sudo systemctl reload apache2
```

---

## 🔒 Security Checklist

- [ ] Set `APP_DEBUG=false` in `.env`
- [ ] Set `APP_ENV=production` in `.env`
- [ ] Use strong database passwords
- [ ] Set proper file permissions (755 directories, 644 files)
- [ ] Install SSL certificate (Let's Encrypt recommended)
- [ ] Configure firewall (allow ports 80, 443, 22 only)
- [ ] Set up regular backups
- [ ] Remove `.git` folder in production (optional)
- [ ] Configure CSRF protection (enabled by default)
- [ ] Review allowed hosts/CORS settings

---

## 📦 Database Backup & Restore

### Backup Database
```bash
# Create backup
mysqldump -u aurieday_user -p aurieday_db > backup-$(date +%Y%m%d-%H%M%S).sql

# Backup with gzip compression
mysqldump -u aurieday_user -p aurieday_db | gzip > backup-$(date +%Y%m%d-%H%M%S).sql.gz
```

### Restore Database
```bash
# Restore from backup
mysql -u aurieday_user -p aurieday_db < backup-20260209-120000.sql

# Restore from compressed backup
gunzip < backup-20260209-120000.sql.gz | mysql -u aurieday_user -p aurieday_db
```

---

## 🔧 Maintenance Commands

### Clear Application Cache
```bash
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

### Re-optimize After Config Changes
```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### Database Operations
```bash
# Run new migrations
php artisan migrate --force

# Rollback last migration
php artisan migrate:rollback --step=1

# Check migration status
php artisan migrate:status
```

### Storage Operations
```bash
# Create symbolic link for storage
php artisan storage:link

# Clear application cache
php artisan cache:clear
```

---

## 📊 Monitoring & Logs

### View Laravel Logs
```bash
# Real-time log monitoring
tail -f storage/logs/laravel.log

# Last 100 lines
tail -n 100 storage/logs/laravel.log
```

### Web Server Logs
```bash
# Nginx
tail -f /var/log/nginx/aurieday-error.log
tail -f /var/log/nginx/aurieday-access.log

# Apache
tail -f /var/log/apache2/aurieday-error.log
tail -f /var/log/apache2/aurieday-access.log
```

---

## 🔄 Updating Application

```bash
# 1. Enable maintenance mode
php artisan down

# 2. Pull latest changes (if using Git)
git pull origin main

# 3. Update dependencies
composer install --optimize-autoloader --no-dev
npm ci --production

# 4. Run migrations
php artisan migrate --force

# 5. Clear and rebuild cache
php artisan cache:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache

# 6. Rebuild assets
npm run build

# 7. Disable maintenance mode
php artisan up
```

---

## 🆘 Troubleshooting

### Issue: 500 Internal Server Error

**Solutions:**
1. Check Laravel logs: `storage/logs/laravel.log`
2. Check web server error logs
3. Verify file permissions
4. Clear cache: `php artisan cache:clear`
5. Ensure `.env` file exists and is configured

### Issue: Assets Not Loading (CSS/JS)

**Solutions:**
1. Run `npm run build` again
2. Check if `public/build/` directory exists
3. Clear browser cache
4. Verify web server can serve static files
5. Check `@vite` directive in blade templates

### Issue: Database Connection Error

**Solutions:**
1. Verify database credentials in `.env`
2. Check database server is running
3. Test connection: `php artisan tinker` then `DB::connection()->getPdo();`
4. Check firewall allows database port

### Issue: Permission Denied Errors

**Solutions:**
```bash
sudo chown -R www-data:www-data /var/www/aurieday
sudo chmod -R 775 storage bootstrap/cache
```

---

## 📱 Testing Production Setup

### Manual Testing Checklist
- [ ] Homepage loads correctly
- [ ] All CSS styles applied
- [ ] JavaScript functionality working
- [ ] RSVP form submission works
- [ ] Love messages submission works
- [ ] Database entries created successfully
- [ ] Responsive design works on mobile
- [ ] SSL certificate valid (HTTPS)
- [ ] No console errors in browser

### Quick Test Commands
```bash
# Test database connection
php artisan tinker
>>> DB::connection()->getPdo();

# Test routes
php artisan route:list

# Check application status
php artisan about
```

---

## 📞 Quick Reference

### Important File Locations
- Application root: `/var/www/aurieday`
- Public files: `/var/www/aurieday/public`
- Logs: `/var/www/aurieday/storage/logs`
- Environment: `/var/www/aurieday/.env`
- Web server config: `/etc/nginx/sites-available/aurieday` or `/etc/apache2/sites-available/aurieday.conf`

### Database Tables
- `rsvp_submissions` - RSVP form submissions
- `love_messages` - Birthday love messages
- `users` - User accounts (if applicable)

### Key Artisan Commands
```bash
php artisan migrate          # Run migrations
php artisan cache:clear      # Clear cache
php artisan config:cache     # Cache config
php artisan down             # Maintenance mode
php artisan up               # Exit maintenance mode
php artisan about            # Application info
```

---

## 💡 Production Tips

1. **Use a Process Manager**: Consider using Supervisor for long-running processes
2. **Set Up Monitoring**: Use services like UptimeRobot or Pingdom
3. **Regular Backups**: Automate daily database and file backups
4. **Use CDN**: For better performance with static assets
5. **Enable OPcache**: Improve PHP performance
6. **Use Queue Workers**: If processing background jobs
7. **Set Up Log Rotation**: Prevent log files from growing too large

---

## 📝 Post-Deployment Checklist

- [ ] Application accessible via domain
- [ ] HTTPS working with valid certificate
- [ ] Database migrations completed
- [ ] Assets loading correctly (CSS/JS)
- [ ] Forms submitting successfully
- [ ] Email sending working (if configured)
- [ ] Error pages customized (404, 500)
- [ ] Backup system configured
- [ ] Monitoring set up
- [ ] Documentation updated
- [ ] Team notified of deployment

---

**Last Updated:** February 9, 2026
**Version:** 1.0
**Author:** Aurie Day Birthday Project Team
