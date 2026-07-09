## Overview

Brief description of what this module does.

## Features

- Feature 1
- Feature 2
- Feature 3

## Installation

This module is part of the LaraDashboard ecosystem.

```bash
php artisan module:enable Blog
php artisan module:migrate Blog
php artisan module:seed Blog
```

## Configuration

Configuration options can be found in `config/config.php`.

## Usage

Describe how to use this module.

## Permissions

List the permissions this module provides:

- `blog.view` - View blog resources
- `blog.create` - Create blog resources
- `blog.edit` - Edit blog resources
- `blog.delete` - Delete blog resources

## Routes

| Method | URI | Name | Description |
|--------|-----|------|-------------|
| GET | `/blog` | `blog.index` | List all resources |
| GET | `/blog/create` | `blog.create` | Show create form |
| POST | `/blog` | `blog.store` | Store new resource |
| GET | `/blog/{id}` | `blog.show` | Show single resource |
| GET | `/blog/{id}/edit` | `blog.edit` | Show edit form |
| PUT | `/blog/{id}` | `blog.update` | Update resource |
| DELETE | `/blog/{id}` | `blog.destroy` | Delete resource |

## License

This module is proprietary software. See LICENSE file for details.
