# Inikah Mai

A custom WordPress plugin for generating virtual featured images, Open Graph images, and Schema Markup images.

## Features

- Generate virtual featured image URLs.
- Generate featured image placeholders for posts without featured images.
- Generate Open Graph (OG) images.
- Generate Schema Markup images.
- Support selected WordPress post types.
- Integration support with SEO plugins such as Yoast SEO.

---

## Requirements

- WordPress 6.x or later
- PHP 8.x or later

---

# Usage Notes

## Generated Image URL

- Generated images are virtual and are not stored in the WordPress Media Library.
- Avoid using special characters in post titles, as they may affect the generated image URL.
- Changing a post title will also change the generated image URL.

---

## Featured Image Block

- A Featured Image block must be added to the post or page for the generated image to appear.
- This feature applies only to the selected post types.

---

## Featured Image Placeholder

- Placeholder images are generated only for posts that do not have a featured image.
- This feature applies only to the selected post types.

---

## Open Graph (OG) Image

- OG images are not generated for:
  - Homepage
  - Archive pages
  - Search result pages
  - Posts that already have a featured image

- This feature applies only to the selected post types.
- For the best compatibility, Yoast SEO is recommended.

---

## Schema Markup Image

- Schema Markup images are generated only for the selected post types.
- For the best compatibility, Yoast SEO is recommended.

---

# Important

⚠️ **Do not edit plugin files directly on the production server.**

Recommended workflow:

1. Make changes in your local development environment.
2. Test the changes locally.
3. Commit your changes.
4. Push them to the repository.
5. Deploy the updated plugin.

The Git repository should remain the single source of truth for the plugin code.
