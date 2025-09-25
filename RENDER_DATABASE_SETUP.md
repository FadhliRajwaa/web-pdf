# Render Database Environment Variables Setup

## Required Environment Variables

Set these in your Render service dashboard under **Environment Variables**:

```
DB_HOST=[Your Aiven MySQL Host]
DB_PORT=[Your Aiven MySQL Port]  
DB_DATABASE=[Your Database Name]
DB_USERNAME=[Your Database Username]
DB_PASSWORD=[Your Database Password]
```

## Setup Instructions

1. Go to your Render service dashboard
2. Navigate to **Environment** tab
3. Add each environment variable above with your actual Aiven database credentials
4. Deploy the service

## Security Note

Database credentials are kept secure by setting them as environment variables in Render dashboard rather than hardcoding in repository files. This prevents GitHub push protection violations.
