# Laravel Deployment Script for Production (PowerShell)
# Usage: .\deploy.ps1

Write-Host "Starting Laravel Deployment Process..." -ForegroundColor Green

# Function to print colored output
function Write-Status {
    param([string]$Message)
    Write-Host "[INFO] $Message" -ForegroundColor Green
}

function Write-Warning {
    param([string]$Message)
    Write-Host "[WARNING] $Message" -ForegroundColor Yellow
}

function Write-Error {
    param([string]$Message)
    Write-Host "[ERROR] $Message" -ForegroundColor Red
}

# Check if .env file exists
if (-not (Test-Path ".env")) {
    Write-Error ".env file not found!"
    if (Test-Path ".env.example") {
        Write-Status "Copying .env.example to .env"
        Copy-Item ".env.example" ".env"
        Write-Warning "Please edit .env file with your production settings"
    } elseif (Test-Path "production.env") {
        Write-Status "Copying production.env to .env"
        Copy-Item "production.env" ".env"
        Write-Warning "Please edit .env file with your hosting settings"
    } else {
        Write-Error ".env.example not found! Please create .env file manually"
        exit 1
    }
}

# Check if composer is installed
try {
    composer --version | Out-Null
} catch {
    Write-Error "Composer is not installed!"
    exit 1
}

# Install/Update Composer dependencies
Write-Status "Installing Composer dependencies..."
try {
    composer install --optimize-autoloader --no-dev --no-interaction
    if ($LASTEXITCODE -ne 0) {
        throw "Composer install failed"
    }
} catch {
    Write-Error "Composer install failed!"
    exit 1
}

# Generate application key if not set
$envContent = Get-Content ".env" -Raw
if ($envContent -match "APP_KEY=\s*$") {
    Write-Status "Generating application key..."
    php artisan key:generate --force
}

# Run database migrations
Write-Status "Running database migrations..."
try {
    php artisan migrate --force
    if ($LASTEXITCODE -ne 0) {
        Write-Warning "Database migration failed! Please check your database configuration"
    }
} catch {
    Write-Warning "Database migration failed! Please check your database configuration"
}

# Seed database (optional)
$seedChoice = Read-Host "Do you want to seed the database? (y/N)"
if ($seedChoice -eq "y" -or $seedChoice -eq "Y") {
    Write-Status "Seeding database..."
    php artisan db:seed --force
}

# Clear and cache configurations
Write-Status "Clearing application cache..."
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

Write-Status "Caching configurations for production..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Create symbolic link for storage (if needed)
if (-not (Test-Path "public\storage")) {
    Write-Status "Creating storage symbolic link..."
    php artisan storage:link
}

# Final checks
Write-Status "Running final checks..."

# Check if APP_ENV is set to production
$envContent = Get-Content ".env" -Raw
if ($envContent -notmatch "APP_ENV=production") {
    Write-Warning "APP_ENV is not set to 'production' in .env file"
}

# Check if APP_DEBUG is set to false
if ($envContent -notmatch "APP_DEBUG=false") {
    Write-Warning "APP_DEBUG is not set to 'false' in .env file"
}

# Check if database connection works
Write-Status "Testing database connection..."
try {
    php artisan migrate:status | Out-Null
    if ($LASTEXITCODE -eq 0) {
        Write-Status "Database connection successful!"
    } else {
        Write-Warning "Database connection failed! Please check your database configuration"
    }
} catch {
    Write-Warning "Database connection failed! Please check your database configuration"
}

Write-Status "Deployment completed!"

# Get APP_URL from .env
$appUrl = (Get-Content ".env" | Where-Object { $_ -match "^APP_URL=" }) -replace "APP_URL=", ""
Write-Status "Your application should now be ready at: $appUrl"

Write-Host ""
Write-Status "Post-deployment checklist:"
Write-Host "   - Verify .env configuration"
Write-Host "   - Test database connection"
Write-Host "   - Check file permissions"
Write-Host "   - Test application functionality"
Write-Host "   - Monitor error logs"

Write-Status "Important files and folders:"
Write-Host "   - Configuration: .env"
Write-Host "   - Logs: storage/logs/"
Write-Host "   - Cache: bootstrap/cache/"
Write-Host "   - Public files: public/"

Write-Host ""
Write-Status "Deployment script completed successfully!"

Write-Host "Press Enter to continue..."
Read-Host