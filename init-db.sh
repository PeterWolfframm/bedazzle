#!/bin/bash

# Database credentials
DB_USER="root"
DB_PASS="root"
DB_HOST="localhost"
DB_PORT="3306"

# Colors for output
GREEN='\033[0;32m'
RED='\033[0;31m'
NC='\033[0m'

echo "Starting database initialization..."

# Check if MySQL is running
if ! brew services list | grep -q "mysql.*started"; then
    echo -e "${RED}MySQL is not running. Starting MySQL...${NC}"
    brew services start mysql
    sleep 5  # Wait for MySQL to start
fi

# Initialize database
echo "Creating database structure..."
mysql -h"$DB_HOST" -P"$DB_PORT" -u"$DB_USER" --password="$DB_PASS" < init-db.sql
if [ $? -eq 0 ]; then
    echo -e "${GREEN}Database structure created successfully${NC}"
else
    echo -e "${RED}Error creating database structure${NC}"
    echo "If you're seeing an access denied error, please run these commands in MySQL:"
    echo "  mysql -u root"
    echo "  ALTER USER 'root'@'localhost' IDENTIFIED BY 'root';"
    echo "  FLUSH PRIVILEGES;"
    echo "  exit"
    echo "Then try running this script again."
    exit 1
fi

# Seed database
echo "Seeding database with initial data..."
mysql -h"$DB_HOST" -P"$DB_PORT" -u"$DB_USER" --password="$DB_PASS" bedazzle < seed-db.sql
if [ $? -eq 0 ]; then
    echo -e "${GREEN}Database seeded successfully${NC}"
else
    echo -e "${RED}Error seeding database${NC}"
    exit 1
fi

echo -e "${GREEN}Database initialization completed successfully!${NC}"
echo "You can now log in with:"
echo "Username: admin"
echo "Password: admin" 