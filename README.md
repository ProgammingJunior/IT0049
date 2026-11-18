# IT0049 Activity Showcase

The single-file static showcase is [Activities_Showcase.html](Activities_Showcase.html). It contains hardcoded sample screens for TFA1–TFA8, TSA1–TSA4, and the final POS project, with previous/next navigation. The root `index.html` redirects to it so the GitHub Pages site opens at its main URL.

## Enable GitHub Pages

In the repository, open **Settings → Pages**. Under **Build and deployment**, select **Deploy from a branch**, choose branch `main` and folder `/(root)`, then save. The project site URL is `https://progammingjunior.github.io/IT0049/`. GitHub Pages publishes the static showcase only.

## Laravel final POS

The working, database-backed POS is in [Final_Project](Final_Project/README.md). It uses Laravel, SQLite by default, and includes migrations and a demo seeder. GitHub Pages does not run the Laravel backend.
